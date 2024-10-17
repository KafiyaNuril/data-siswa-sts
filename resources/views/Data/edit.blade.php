@extends('layout.layout')
@section('content')
<h1 class="text-center">Edit Data Siswa</h1>
<form action="{{ route('siswa.edit.formulir', $siswa['id']) }}" method="POST" class="card p-5">
    @csrf
    @method('PATCH')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $errors)
                    <li>{{ $errors }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ $siswa['name'] }}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="nis" class="col-sm-2 col-form-label">NIS :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nis" id="nis" placeholder="Masukan Nis" value="{{ $siswa['nis'] }}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="rayon" class="col-sm-2 col-form-label">Rayon :</label>
        <div class="col-sm-10">
            <select id="rayon" name="rayon" class="form-select">
                <option selected disabled hidden>Pilih Rayon</option>
                @foreach($rayons as $rayon)
                    <option value="{{ $rayon }}" {{ $siswa['rayon']  == $rayon ? 'selected' : '' }}>{{ $rayon }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email:</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" value="{{ $siswa['email'] }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<a href="{{ route('siswa.data') }}" class="btn btn-success mt-2 me-5 position-absolute end-0"> Kembali </a>
@endsection
