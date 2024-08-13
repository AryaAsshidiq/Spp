@extends('layouts.admin.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Update Pembayaran</h4>
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="student_name" class="form-label">Nama Siswa</label>
                        <input type="text" name="student_name" id="student_name" class="form-control" value="{{ $payment->student_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">Kelas</label>
                        <select name="class" id="class" class="form-select" required>
                            <option value="7" {{ $payment->class == '7' ? 'selected' : '' }}>7</option>
                            <option value="8" {{ $payment->class == '8' ? 'selected' : '' }}>8</option>
                            <option value="9" {{ $payment->class == '9' ? 'selected' : '' }}>9</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="billing_id" class="form-label">Nama Tagihan</label>
                        <select name="billing_id" id="billing_id" class="form-select" required>
                            @foreach($billings as $billing)
                                <option value="{{ $billing->id }}" {{ $billing->id == $payment->billing_id ? 'selected' : '' }}>
                                    {{ $billing->billing_name }} ({{ $billing->billing_amount }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah Pembayaran</label>
                        <input type="number" name="amount" id="amount" class="form-control" step="0.01" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_date" class="form-label">Tanggal Pembayaran</label>
                        <input type="date" name="payment_date" id="payment_date" class="form-control" value="" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
