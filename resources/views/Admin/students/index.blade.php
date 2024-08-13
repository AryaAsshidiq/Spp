@extends('layouts.admin.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Tambah Siswa</a>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card">
            <h5 class="card-header">Daftar Siswa</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-white">No</th>
                            <th class="text-white">Nama</th>
                            <th class="text-white">Kelas</th>
                            <th class="text-white">NIS</th>
                            <th class="text-white">NISN</th>
                            <th class="text-white">Jenis Kelamin</th>
                            <th class="text-white">Tahun Ajaran</th>
                            <th class="text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->class }}</td>
                                <td>{{ $student->nis }}</td>
                                <td>{{ $student->nisn }}</td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->tahun_ajaran }}</td>
                                <td>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                                        <a class="btn btn-info btn-sm"
                                            href="{{ route('students.show', $student->id) }}">Show</a>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('students.edit', $student->id) }}">Edit</a>
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
