<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $fillable = [
        'billing_name', 'billing_amount',
    ];
    protected $table = 'billings';

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}