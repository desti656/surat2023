@extends('welcome')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel Surat Keluar</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col d-flex justify-content-start mt-2">
                    <h6 class="m-0 font-weight-bold" style="color: #556898 !important">Data Tabel</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengaju</th>
                            <th>Jenis Surat</th>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->jenis_surat }}</td>
                                <td>{{ $item->nomor }}</td>
                                <td>{{ $item->tanggal }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Pengaju</th>
                            <th>Jenis Surat</th>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection