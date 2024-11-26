@extends('layout.layout')
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="d-flex">
        <a href="{{ route('siswa.tambah') }}" class="btn btn-primary me-2"> + Tambah</a>
        <form action="{{ route('siswa.data') }}" role="search" class="d-flex me-2" method="GET">
            <input type="text" class="form-control me-1" name="search_data" placeholder="Search Data" aria-label="Search">
            <button class=" btn btn-success shadow" type="submit"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
        </form>
        <a href="{{ route('siswa.export') }}" class="btn btn-success me-2"><i class='fa-solid fa-print'></i>Export Excel</a>
        <a href="{{ route('siswa.export.pdf') }}" class="btn btn-warning"><i class="fa-solid fa-file-pdf"></i>PDF</a>

    </div>
    <div class="container">
        <table class="table table-bordered table-stripped mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Nis</th>
                    <th>Rayon</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (count($siswa) < 1)
                    <tr>
                        <td colspan="6" class="text-center">Data Siswa Kosong</td>
                    </tr>
                @else
                    @foreach ($siswa as $index => $item)
                        <tr>
                            <td>{{ ($siswa->currentPage()-1) * ($siswa->perPage()) + ($index+1) }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['nis'] }}</td>
                            <td>{{ $item['rayon'] }}</td>
                            <td>{{ $item['email'] }}</td>

                            <td class="d-flex">
                                <a href={{ route('siswa.edit', $item['id']) }} class="btn btn-primary me-2">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="showModal('{{ $item->id }}', '{{ $item->name }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-delete-data" method="POST">
                @csrf
                {{-- menimpa method="POST" diganti menjadi delete, sesuai dengan http
                method untul menghapus data---}}
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus data ini <span id="nama-data"></span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-danger" id="confirm-delete">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        {{-- links : memunculkan buttton pagination --}}
        {{ $siswa->links() }}
    </div>
@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        function showModal(id, name) {
            // ini untuk url deletenya (Route)
            let urlDelete = "{{ route('siswa.hapus', ':id') }}";
            urlDelete = urlDelete.replace(':id', id);
            // ini untuk actin attributenya
            $('#form-delete-data').attr('action', urlDelete);
            // ini untuk show Modalnya
            $('#exampleModal').modal('show');
            // ini untuk mengisi modalnya
            $('#nama-data').text(name);
        }
    </script>
@endpush
