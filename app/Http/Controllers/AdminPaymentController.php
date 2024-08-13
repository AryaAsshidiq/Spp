<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Billing;
use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\FinancialSummary;
use Illuminate\Support\Facades\DB;

class AdminPaymentController extends Controller
{
    public function index(Request $request)
    {
        $month_year = $request->input('month_year');
        $class = $request->input('class');
        $paymentStatus = $request->input('payment_status');
    
        $payments = Payment::query();
    
        if (!empty($month_year)) {
            $date = Carbon::parse($month_year);
            $payments->whereYear('payment_date', $date->year)
                    ->whereMonth('payment_date', $date->month);
        }
    
        if (!empty($class)) {
            $payments->where('class', $class);
        }
    
        if (!empty($paymentStatus) && in_array($paymentStatus, ['paid', 'unpaid'])) {
            $payments->where('payment_status', $paymentStatus);
        }
    
        $payments = $payments->with('billing')->paginate(10); // Mengatur pagination dengan 10 item per halaman
    
        return view('admin.payments.index', compact('payments', 'month_year', 'class', 'paymentStatus'));
    }    

    public function print(Request $request)
    {
        $month_year = $request->input('month_year');
        $class = $request->input('class');
        $paymentStatus = $request->input('payment_status');
    
        $payments = Payment::query();
    
        if (!empty($month_year)) {
            $date = Carbon::parse($month_year);
            $payments->whereYear('payment_date', $date->year)
                ->whereMonth('payment_date', $date->month);
        }
    
        if (!empty($class)) {
            $payments->where('class', $class);
        }
    
        if (!empty($paymentStatus) && in_array($paymentStatus, ['paid', 'unpaid'])) {
            $payments->where('payment_status', $paymentStatus);
        }
    
        $payments = $payments->with('billing')->get();
    
        // Customize the filename if needed
        $pdf = PDF::loadView('admin.payments.pdf', compact('payments', 'month_year', 'class', 'paymentStatus'));
        return $pdf->download('rekap_pembayaran_spp_' . ($month_year ? Carbon::parse($month_year)->format('F_Y') : 'all') . '.pdf');
    }    
    
    public function create()
    {
        $billings = Billing::all();
        return view('admin.payments.create', compact('billings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'class' => 'required|in:7,8,9',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'billing_id' => 'required|exists:billings,id',
        ]);

        $billing = Billing::findOrFail($request->billing_id);
        $remainingAmount = $billing->billing_amount - $request->amount;
        $paymentStatus = $remainingAmount <= 0 ? 'paid' : 'unpaid';

        $payment = new Payment([
            'student_name' => $request->student_name,
            'class' => $request->class,
            'amount' => $request->amount,
            'remaining_amount' => $remainingAmount,
            'payment_status' => $paymentStatus,
            'payment_date' => $request->payment_date,
            'billing_id' => $request->billing_id,
        ]);

        DB::transaction(function () use ($payment, $request) {
            $payment->save();
        });

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diunggah.');
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $billings = Billing::all();
        return view('admin.payments.edit', compact('payment', 'billings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'class' => 'required|in:7,8,9',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'billing_id' => 'required|exists:billings,id'
        ]);

        $payment = Payment::findOrFail($id);
        $billing = Billing::findOrFail($request->billing_id);

        DB::beginTransaction();

        try {
            $oldPayment = $payment->replicate();
            $oldPayment->save();

            if ($request->amount != $payment->amount) {
                $totalPaidBefore = Payment::where('student_name', $request->student_name)
                    ->where('billing_id', $request->billing_id)
                    ->where('id', '<>', $id)
                    ->sum('amount');
                $totalBillingAmount = $billing->billing_amount;
                $newRemainingAmount = $totalBillingAmount - ($totalPaidBefore + $request->amount);

                if ($newRemainingAmount < 0) {
                    throw new \Exception('Jumlah pembayaran melebihi total tagihan.');
                }

                $payment->update([
                    'student_name' => $request->student_name,
                    'class' => $request->class,
                    'amount' => $request->amount,
                    'remaining_amount' => $newRemainingAmount,
                    'payment_status' => $newRemainingAmount == 0 ? 'paid' : 'unpaid',
                    'payment_date' => $request->payment_date,
                    'billing_id' => $request->billing_id,
                ]);
            } else {
                $payment->update([
                    'student_name' => $request->student_name,
                    'class' => $request->class,
                    'payment_date' => $request->payment_date,
                    'billing_id' => $request->billing_id,
                ]);
            }

            DB::commit();

            return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui pembayaran: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->delete();

            return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus pembayaran: ' . $e->getMessage());
        }
    }
}
