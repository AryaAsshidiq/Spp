@extends('layouts.admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Rekap Keuangan</h4>
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('financial-summaries.index') }}">
                <div class="mb-3">
                    <label for="month_year" class="form-label">Pilih Bulan dan Tahun</label>
                    <input type="month" name="month_year" id="month_year" class="form-control" value="{{ $monthYear }}" onchange="this.form.submit()">
                </div>
            </form>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th class="text-white">Bulan dan Tahun</th>
                        <th class="text-white">Total Pemasukan</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($financialSummaries->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data untuk periode ini.</td>
                        </tr>
                    @else
                        @foreach($financialSummaries as $summary)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($summary->summary_date)->translatedFormat('F Y') }}</td>
                                <td>{{ number_format($summary->total_income, 0) }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('financial.print', ['month_year' => $monthYear]) }}" class="btn btn-primary">
            <i class="fas fa-print"></i> Cetak PDF
        </a>
    </div> 
</div>
@endsection
