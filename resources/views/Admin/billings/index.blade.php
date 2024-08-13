@extends('layouts.admin.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <a href="{{ route('billings.create') }}" class="btn btn-primary mb-3">Tambah Data Tagihan</a>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-white">Jumlah</th>
                            <th class="text-white">Nama Tagihan</th>
                            <th class="text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($billings as $billing)
                            <tr>
                                <td>Rp {{ number_format($billing->billing_amount, 0) }}</td>
                                <td>{{ $billing->billing_name }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('billings.edit', $billing->id) }}">Edit</a>
                                    <form action="{{ route('billings.destroy', $billing->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
