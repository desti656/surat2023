@extends('welcome')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel Permintaan</h1>
    @include('components.notification')

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col d-flex justify-content-start mt-2">
                    <h6 class="m-0 font-weight-bold" style="color: #556898 !important">Data Tabel</h6>
                </div>
                <div class="col d-flex justify-content-end">
                    <a class="btn btn-primary border-0" href="{{ route('permintaan.create') }}" style="background-color: #556898 !important">Tambah Data</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Permintaan Surat</th>
                            <th>Nama Lengkap</th>
                            <th>Petugas</th>
                            <th>Berkas Persyaratan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->user }}</td>
                                <td>{{ $item->petugas ? $item->petugas : '-' }}</td>
                                <td>
                                    @foreach ($item->berkas_persyaratan as $berkas)
                                    <p>
                                        <a style="text-decoration: underline;" href="{{asset('storage')}}/persyaratan-surat/{{$berkas->file}}" target="_blank">{{$berkas->file}}</a>
                                    </p>
                                    @endforeach
                                </td>
                                <td>{{ $item->status }}</td>
                                <td class="form-inline">
                                    @if (Auth::user()->role_id != 3)
                                        @if ($item->status == 'pending')
                                        <form class="mx-2" action="{{ route('permintaan.confirm', $item->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="tipe" value="accepted">
                                            <button type="submit" onclick="return confirm('Anda yakin akan menerima permintaan ini?')" class="btn btn-success"><i class="fas fa-check"></i></button>
                                        </form>
                                        <button type="submit" class="btn btn-danger tolak-permintaan"
                                            data-id="{{$item->id}}" data-toggle="modal" data-target="#tolakModal"><i class="fas fa-times"></i></button>
                                        @endif
                                        @if ($item->status == 'onprogress')
                                        <button type="button"  class="btn btn-primary mx-2 upload-berkas"
                                            data-toggle="modal" data-target="#uploadBerkasModal"
                                            data-id="{{$item->id}}"><i class="fas fa-check-square"></i></button>
                                        @endif
                                        <form class="mx-2" action="{{ route('permintaan.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Anda yakin akan menghapus data?')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    @endif
                                    @if ($item->status == 'done')
                                        <a href="{{asset('storage')}}/permintaan-surat/{{$item->file}}" target="_blank" class="btn btn-secondary mx-2"><i class="fas fa-file-download"></i></a>
                                        <a href="{{ route('permintaan.print', $item->id) }}" target="_blank" class="btn btn-info mx-2"><i class="fas fa-print"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <span class="text-disabled">Maaf, data belum tersedia.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Permintaan Surat</th>
                            <th>Nama Lengkap</th>
                            <th>Petugas</th>
                            <th>Berkas Persyaratan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Upload Berkas-->
    <div class="modal fade" id="uploadBerkasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-berkas" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #556898;">Unggah berkas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="tipe" id="tipe" value="done">
                            <div class="mb-3">
                                <label for="berkas" class="form-label">Scan Berkas(pdf)</label>
                                <input type="file" accept="application/pdf" class="form-control" id="berkas" name="berkas" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal alasan penolakan-->
    <div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-tolak" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #556898;">Tolak permintaan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="tolak_id">
                        <input type="hidden" name="tipe" id="tipe" value="declined">
                        <textarea name="alasan_penolakan" id="alasan_penolakan" cols="30" rows="3" class="form-control" placeholder="Masukkan alasan penolakan disini..." required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $('.upload-berkas').on('click', function(e) {
                var data_id = $(this).data('id')
                $('#id').val(data_id)
                var url = "{{ url('/dashboard/permintaan') }}/" + data_id;
                $('#form-berkas').attr("action", url);
            })
            $('.tolak-permintaan').on('click', function(e) {
                var data_id = $(this).data('id')
                console.log(data_id)
                $('#tolak_id').val(data_id)
                var url = "{{ url('/dashboard/permintaan') }}/" + data_id;
                $('#form-tolak').attr("action", url);
            })
        </script>
    @endpush
@endsection