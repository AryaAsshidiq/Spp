@extends('layouts.admin.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Tambah Data Tagihan</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Ada masalah dengan inputan Anda.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('billings.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Tagihan</label>
                <div class="col-sm-10">
                    <input type="text" name="billing_name" class="form-control" placeholder="Nama Tagihan" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="number" name="billing_amount" class="form-control" placeholder="Jumlah" required>
                </div>
            </div>
            <div class="col text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
