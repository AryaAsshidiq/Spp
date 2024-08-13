<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;

class BillingInformationController extends Controller
{

    public function index()
    {
        $billings = Billing::all();
        return view('admin.billings.index', compact('billings'));
    }

    public function create()
    {
        return view('admin.billings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'billing_name' => 'required|string|max:255',
            'billing_amount' => 'required|numeric|min:0',
        ]);

        Billing::create($request->all());
        return redirect()->route('billings.index')->with('success', 'Data tagihan berhasil ditambahkan.');
    }

    public function edit(Billing $billing)
    {
        return view('admin.billings.edit', compact('billing'));
    }

    public function update(Request $request, Billing $billing)
    {
        $request->validate([
            'billing_name' => 'required|string|max:255',
            'billing_amount' => 'required|numeric|min:0',
        ]);

        $billing->update($request->all());
        return redirect()->route('billings.index')->with('success', 'Data tagihan berhasil diupdate.');
    }

    public function destroy(Billing $billing)
    {
        $billing->delete();
        return redirect()->route('billings.index')->with('success', 'Data tagihan berhasil dihapus.');
    }
}
