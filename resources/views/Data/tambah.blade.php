@extends('layout.layout')

@section('content')
<h1 class="text-center">Masukan Data Siswa</h1>
<form action="{{ route('siswa.tambah.formulir') }}" method="POST">
    @csrf
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
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
        <label for="name" class="col-sm-2 col-form-label">Nama :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama" value="{{ old('name') }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="nis" class="col-sm-2 col-form-label">NIS :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nis" id="nis" placeholder="Masukan Nis" value="{{ old('nis') }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="rayon" class="col-sm-2 col-form-label">Rayon :</label>
        <div class="col-sm-10">
            {{--<input type="text" class="form-control" name="rayon" id="rayon" placeholder="Masukan Rayon" value="{{ old('rayon') }}">--}}
            <select id="rayon" name="rayon" class="form-select">
                <option selected disabled hidden>Pilih Rayon</option>
                @foreach($rayons as $rayon)
                    <option value="{{ $rayon }}" {{old('rayon') == $rayon ? 'selected' : '' }}>{{ $rayon }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="email" id="email" placeholder="Masukan Email" value="{{ old('email') }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endSection
