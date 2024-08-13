<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'student_name', 'class', 'payment_status', 'amount', 'remaining_amount', 'payment_date', 'billing_id',
    ];

    public function billing()
    {
        return $this->belongsTo(Billing::class, 'billing_id');
    }

    public function getStatusAttribute()
    {
    return $this->payment_status === 'paid' ? 'Lunas' : 'Belum lunas';
    }

}