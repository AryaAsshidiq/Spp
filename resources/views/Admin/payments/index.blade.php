@extends('layouts.admin.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-column flex-md-row">
            <h4 class="fw-bold py-3 mb-0 text-center text-md-start">Rekap Pembayaran SPP {{ $month_year }}</h4>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 flex-column flex-md-row">
            <div class="mb-3 mb-md-0">
                <form action="{{ route('payments.index') }}" method="GET" class="form-inline d-flex flex-column flex-md-row">
                    <div class="input-group mb-2 mb-md-0 me-md-2">
                        <label for="month_year" class="input-group-text"></label>
                        <input type="month" name="month_year" id="month_year" class="form-control" value="{{ $month_year ?? '' }}">
                    </div>
                    <div class="input-group mb-2 mb-md-0 me-md-2">
                        <label for="payment_status" class="input-group-text"></label>
                        <select name="payment_status" id="payment_status" class="form-select">
                            <option value="">Semua</option>
                            <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                            <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>
                        </select>
                    </div>
                    <div class="input-group mb-2 mb-md-0 me-md-2">
                        <label for="class" class="input-group-text"></label>
                        <select name="class" id="class" class="form-select">
                            <option value="">Semua Kelas</option>
                            <option value="7" {{ request('class') == '7' ? 'selected' : '' }}>Kelas 7</option>
                            <option value="8" {{ request('class') == '8' ? 'selected' : '' }}>Kelas 8</option>
                            <option value="9" {{ request('class') == '9' ? 'selected' : '' }}>Kelas 9</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <div>
                <a href="{{ route('payments.create') }}" class="btn btn-success">
                    <i class="fas fa-upload"></i> Unggah Pembayaran Baru
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                @if($payments->isEmpty())
                    <div class="alert alert-warning">Tidak ada data pembayaran</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-white">Nama Siswa</th>
                                    <th class="text-white">Kelas</th>
                                    <th class="text-white">Nama Tagihan</th>
                                    <th class="text-white">Jumlah Tagihan</th>
                                    <th class="text-white">Status Pembayaran</th>
                                    <th class="text-white">Jumlah Pembayaran</th>
                                    <th class="text-white">Sisa Pembayaran</th>
                                    <th class="text-white">Tanggal Pembayaran</th>
                                    <th class="text-white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->student_name }}</td>
                                        <td>{{ $payment->class }}</td>
                                        <td>{{ $payment->billing->billing_name }}</td>
                                        <td>Rp {{ number_format($payment->billing->billing_amount, 0) }}</td>
                                        <td>{{ $payment->status }}</td>
                                        <td>Rp {{ number_format($payment->amount, 0) }}</td>
                                        <td>Rp {{ number_format($payment->remaining_amount, 0) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($payment->payment_date)->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <div>
                                                <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning btn-sm mb-1 d-block">Update</a>
                                            </div>
                                            <div>
                                                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination">
                        {{ $payments->links() }}
                    </div>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('admin.payments.print', ['month_year' => $month_year, 'class' => $class, 'payment_status' => $paymentStatus]) }}" class="btn btn-primary">
                <i class="fas fa-print"></i> Cetak PDF
            </a>
        </div>
    </div>
@endsection