@extends('layouts.admin.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Edit Siswa</h4>

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

        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" value="{{ $student->name }}" placeholder="Nama"
                        required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                    <input type="text" name="class" class="form-control" value="{{ $student->class }}"
                        placeholder="Kelas" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">NIS</label>
                <div class="col-sm-10">
                    <input type="text" name="nis" class="form-control" value="{{ $student->nis }}" placeholder="NIS"
                        required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">NISN</label>
                <div class="col-sm-10">
                    <input type="text" name="nisn" class="form-control" value="{{ $student->nisn }}"
                        placeholder="NISN" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select class="form-control" name="gender" required>
                        <option value="Laki-laki" {{ $student->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $student->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" style="height:150px" name="address" placeholder="Alamat" required>{{ $student->address }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" value="{{ $student->user->username }}"
                        placeholder="Username" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" value="{{ $student->user->email }}"
                        placeholder="Email" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tahun Ajaran</label>
                <div class="col-sm-10">
                    <input type="number" name="tahun_ajaran" class="form-control" value="{{ $student->tahun_ajaran }}"
                        placeholder="Tahun Ajaran" required>
                </div>
            </div>
            <div class="col text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
