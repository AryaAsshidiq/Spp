<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class FinancialSummary extends Model
{
    use HasFactory;
    protected $fillable = [
        'summary_date', 'total_income'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    /**
     * Scope a query to only include the latest entry for each month and year.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatestPerMonthYear(Builder $query)
    {
        return $query->whereRaw('updated_at = (
            SELECT MAX(fs2.updated_at)
            FROM financial_summaries as fs2
            WHERE DATE_FORMAT(fs2.summary_date, "%Y-%m") = DATE_FORMAT(financial_summaries.summary_date, "%Y-%m")
        )');
    }
}
