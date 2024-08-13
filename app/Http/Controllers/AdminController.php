<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPayments = Payment::sum('amount');

        // Menghitung jumlah yang lunas dan belum lunas
        $paidCount = Payment::where('payment_status', 'paid')->count();
        $unpaidCount = Payment::where('payment_status', 'unpaid')->count();

        return view('admin.dashboard', compact('totalPayments', 'paidCount', 'unpaidCount'));
    }
}