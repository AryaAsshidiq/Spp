@extends('layouts.admin.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Dashboard</h4>

        <!-- School Info Cards Row -->
        <div class="row mb-4">
            <!-- School Name -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-school fa-2x me-3 text-primary"></i>
                            <div>
                                <h5 class="card-title mb-0">SMP SMIP 3 Pangeran Antasari</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Principal Name -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-tie fa-2x me-3 text-secondary"></i>
                            <div>
                                <h5 class="card-title mb-0">Nama Kepala Sekolah</h5>
                                <p class="mb-0">Muhammad Hairullah ST</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-money-bill-wave fa-2x me-3"></i>
                            <div>
                                <h5 class="card-title">Total Jumlah Pembayaran</h5>
                                <p class="card-text">Rp {{ number_format($totalPayments, 0) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Info Cards Row -->

        </div>
    </div>
@endsection
