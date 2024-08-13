@extends('layouts.admin.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Kwitansi Pembayaran SPP</h4>
        <div class="card">
            <div class="card-body">
                <p><strong>Nama Siswa:</strong> {{ $payment->student->name }}</p>
                <p><strong>Jumlah:</strong> {{ $payment->amount }}</p>
                <p><strong>Tanggal Pembayaran:</strong> {{ $payment->payment_date }}</p>
                <p><strong>Status:</strong> {{ $payment->confirmed ? 'Dikonfirmasi' : 'Belum Dikonfirmasi' }}</p>
                <p><strong>Bukti Pembayaran:</strong></p>
                <div>
                    <img src="{{ asset($payment->receipt_path) }}" alt="Bukti Pembayaran"
                        style="max-width: 100%; height: auto;">
                </div>
                <a href="{{ route('admin.payments.printReceipt', $payment->id) }}" class="btn btn-primary mt-3">Cetak PDF</a>
            </div>
        </div>
        <a href="{{ route('admin.payments.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
