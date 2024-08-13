<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER update_financial_summary_after_insert AFTER INSERT ON payments
            FOR EACH ROW
            BEGIN
                DECLARE summaryDate DATE;
                DECLARE totalIncome DECIMAL(10,2) DEFAULT 0;

                SET summaryDate = DATE_FORMAT(NEW.payment_date, "%Y-%m-01");

                SELECT IFNULL(SUM(amount), 0) INTO totalIncome
                FROM payments
                WHERE DATE_FORMAT(payment_date, "%Y-%m") = DATE_FORMAT(NEW.payment_date, "%Y-%m");

                INSERT INTO financial_summaries (summary_date, total_income, created_at, updated_at)
                VALUES (summaryDate, totalIncome, NOW(), NOW())
                ON DUPLICATE KEY UPDATE total_income = totalIncome, updated_at = NOW();
            END
        ');

        DB::unprepared('
            CREATE TRIGGER update_financial_summary_after_update AFTER UPDATE ON payments
            FOR EACH ROW
            BEGIN
                DECLARE summaryDate DATE;
                DECLARE totalIncome DECIMAL(10,2) DEFAULT 0;

                SET summaryDate = DATE_FORMAT(NEW.payment_date, "%Y-%m-01");

                SELECT IFNULL(SUM(amount), 0) INTO totalIncome
                FROM payments
                WHERE DATE_FORMAT(payment_date, "%Y-%m") = DATE_FORMAT(NEW.payment_date, "%Y-%m");

                INSERT INTO financial_summaries (summary_date, total_income, created_at, updated_at)
                VALUES (summaryDate, totalIncome, NOW(), NOW())
                ON DUPLICATE KEY UPDATE total_income = totalIncome, updated_at = NOW();
            END
        ');

        DB::unprepared('
            CREATE TRIGGER update_financial_summary_after_delete AFTER DELETE ON payments
            FOR EACH ROW
            BEGIN
                DECLARE summaryDate DATE;
                DECLARE totalIncome DECIMAL(10,2) DEFAULT 0;

                SET summaryDate = DATE_FORMAT(OLD.payment_date, "%Y-%m-01");

                SELECT IFNULL(SUM(amount), 0) INTO totalIncome
                FROM payments
                WHERE DATE_FORMAT(payment_date, "%Y-%m") = DATE_FORMAT(OLD.payment_date, "%Y-%m");

                IF totalIncome = 0 THEN
                    DELETE FROM financial_summaries WHERE summary_date = summaryDate;
                ELSE
                    INSERT INTO financial_summaries (summary_date, total_income, created_at, updated_at)
                    VALUES (summaryDate, totalIncome, NOW(), NOW())
                    ON DUPLICATE KEY UPDATE total_income = totalIncome, updated_at = NOW();
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_financial_summary_after_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS update_financial_summary_after_update');
        DB::unprepared('DROP TRIGGER IF EXISTS update_financial_summary_after_delete');
    }
};
