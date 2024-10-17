@extends('layout.layout')
@section('content')
<div class="Jumbotron py-4 px-5 mb-3">
    <h1 class="display-4">
        Selamat Datang !
    </h1>
    <hr class="my-4">
    <p>Aplikasi ini untuk mengelola data siswa</p>
</div>
<div class="container mt-4">
    <div class="row">
        <!-- Menampilkan total siswa -->
        <div class="col-md-4" style="cursor: pointer">
            <a href="{{ route('siswa.data') }}" class="text-white text-decoration-none">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">Total Siswa</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalSiswa }}</h5>
                        <p class="card-text">Jumlah total siswa yang terdaftar.</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- Menampilkan siswa terbaru -->
        <div class="col-md-12">
            <div class="card bg-light mb-3">
                <div class="card-header">Siswa Terbaru</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($recentSiswa as $siswa)
                            <li class="list-group-item">{{ $siswa->name }} (Rayon: {{ $siswa->rayon }})</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
