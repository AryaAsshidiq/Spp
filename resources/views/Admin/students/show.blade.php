@extends('layouts.admin.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">{{ $student->name }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Nama:</strong> {{ $student->name }}
                            </li>
                            <li class="list-group-item">
                                <strong>Kelas:</strong> {{ $student->class }}
                            </li>
                            <li class="list-group-item">
                                <strong>NIS:</strong> {{ $student->nis }}
                            </li>
                            <li class="list-group-item">
                                <strong>NISN:</strong> {{ $student->nisn }}
                            </li>
                            <li class="list-group-item">
                                <strong>Jenis Kelamin:</strong> {{ $student->gender }}
                            </li>
                            <li class="list-group-item">
                                <strong>Alamat:</strong> {{ $student->address }}
                            </li>
                            <li class="list-group-item">
                                <strong>Tahun Ajaran:</strong> {{ $student->tahun_ajaran }}
                            </li>
                            <li class="list-group-item">
                                <strong>Username:</strong> {{ $student->user->username }}
                            </li>
                            <li class="list-group-item">
                                <strong>Email:</strong> {{ $student->user->email }}
                            </li>
                        </ul>
                        <div class="text-start mt-4">
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
