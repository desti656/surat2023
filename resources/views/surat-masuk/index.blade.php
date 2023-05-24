@extends('welcome')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel Surat Masuk</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col d-flex justify-content-start mt-2">
                    <h6 class="m-0 font-weight-bold" style="color: #556898 !important">Data Tabel</h6>
                </div>
                <div class="col d-flex justify-content-end">
                    <a class="btn btn-primary border-0" href="{{ route('surat-masuk.create') }}" style="background-color: #556898 !important">Tambah Data</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    @include('components.notification')
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pengirim</th>
                            <th>Perihal</th>
                            <th>Disposisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->pengirim }}</td>
                            <td>{{ $item->perihal }}</td>
                            <td>{{ $item->disposisi }}</td>
                            <td class="form-inline">
                                <a href="{{ route('surat-masuk.edit', $item->id) }}" class="btn btn-warning m-1"><i class="fas fa-edit"></i></a>
                                <a href="{{ asset('storage') }}/surat-masuk/{{ $item->file }}" target="_blank" class="btn btn-secondary m-1"><i class="fas fa-file-download"></i></a>
                                <form action="{{ route('surat-masuk.destroy', $item->id) }}" class="m-1" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Anda yakin akan menghapus data ini?')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pengirim</th>
                            <th>Perihal</th>
                            <th>Disposisi</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection