@extends('layouts.admin.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Unggah Pembayaran Baru</h4>
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="student_name" class="form-label">Nama Siswa</label>
                        <input type="text" name="student_name" id="student_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">Kelas</label>
                        <select name="class" id="class" class="form-select" required>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="billing_id" class="form-label">Nama Tagihan</label>
                        <select name="billing_id" id="billing_id" class="form-select" required>
                            @foreach($billings as $billing)
                                <option value="{{ $billing->id }}">{{ $billing->billing_name }} ({{ $billing->billing_amount }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah Pembayaran</label>
                        <input type="number" name="amount" id="amount" class="form-control" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_date" class="form-label">Tanggal Pembayaran</label>
                        <input type="date" name="payment_date" id="payment_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Unggah Pembayaran</button>
                </form>
            </div>
        </div>
    </div>
@endsection
