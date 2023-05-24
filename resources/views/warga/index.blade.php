@extends('welcome')
@push('js')
    <script>

        var id;
        $('body').on('click','.edit-data',function(e) {
            id = $(this).data('id');
            $.ajax({
                url: "warga/edit",
                method: 'GET',
                data:{
                    id:id
                },
                success: function(data) {
                    $.map(data,function(i) {
                        $('#id').val(i.id);
                        $('#nama').val(i.name);
                        $('#nik').val(i.username);
                        $('#no_kk').val(i.no_kk);
                        $('#alamat').val(i.address);
                        $('#tempat').val(i.tempat_lahir);
                        $('#tgl').val(i.tgl_lahir);
                        $('#agama option[value="' + i.agama+ '"]').prop('selected', true);
                        $('#pekerjaan option[value="' + i.pekerjaan+ '"]').prop('selected', true);
                        $('#status_perkawinan option[value="' + i.status_perkawinan+ '"]').prop('selected', true);
                    })
                }
            })
        })
        $('#SubmitUpdateForm').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "warga/update",
                method: 'POST',
                data: {
                    id: $('#id').val(),
                    nama: $('#nama').val(),
                    nik: $('#nik').val(),
                    no_kk: $('#no_kk').val(),
                    alamat: $('#alamat').val(),
                    tempat: $('#tempat').val(),
                    tgl: $('#tgl').val(),
                    agama: $('#agama').val(),
                    pekerjaan: $('#pekerjaan').val(),
                    status_perkawinan: $('#status_perkawinan').val(),
                },
                success: function(result) {
                    console.log(result);
                    if (result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        // setInterval(() => {
                            // }, 2000);
                        // var refreshIntervalId = setInterval($('#EditArticleModal').hide(), 10000);
                        $(".alert-success").append(`<p id="">${result.message}</p>`);
                        setInterval(function(){
                            $('.alert-success').hide();
                        }, 15000);
                        location.reload();
                        $('#ModalEditData').modal('hide');
                    }
                }
            });
        })
    </script>
@endpush
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel Request Warga</h1>
    @include('components.notification')
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{session('status')}}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{session('error')}}
                </div>
            @endif
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">

            </div>
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">

            </div>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col d-flex justify-content-start mt-2">
                    <h6 class="m-0 font-weight-bold" style="color: #556898 !important">Data Tabel</h6>
                </div>
                <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-primary border-0" data-toggle="modal" data-target="#ModalCreate" style="background-color: #556898 !important">Tambah Data</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Warga</th>
                            <th>Username</th>
                            <th>Alamat</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>Status Perkawinan</th>
                            <th>No KK</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Warga</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>Status Perkawinan</th>
                            <th>No KK</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($data as $item)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucwords($item->name) }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->tempat_lahir }}</td>
                                <td>{{ $item->tgl_lahir }}</td>
                                <td>{{ $item->agama }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td>{{ $item->status_perkawinan }}</td>
                                <td>{{ $item->no_kk }}</td>
                                <td>
                                    {{-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ModalShow"><i class="fas fa-eye"></i></button> --}}
                                    <button type="button" class="btn btn-warning edit-data" data-toggle="modal" data-id="{{ $item->id }}" data-target="#ModalEdit"><i class="fas fa-edit"></i></button>
                                    {{-- <button type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button> --}}
                                </td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Create-->
    <div class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #556898;">Tambah Data Warga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('warga.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan NIK" name="nik">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">No KK</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan No KK" name="no_kk">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Alamat" name="alamat">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Tempat Lahir" name="tempat">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Tanggal Lahir" name="tgl">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Agama</label>
                        <select name="agama" id="" class="form-control">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Budha">Budha</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Konghuchu">Konghuchu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                        <select name="pekerjaan" id="" class="form-control">
                            <option value="BELUM / TIDAK BEKERJA">BELUM / TIDAK BEKERJA</option>
                            <option value="MENGURUS RUMAH TANGGA">MENGURUS RUMAH TANGGA</option>
                            <option value="PELAJAR / MAHASISWA">Katolik</option>
                            <option value="PENSIUNAN">PENSIUNAN</option>
                            <option value="PEGAWAI NEGERI SIPIL">PEGAWAI NEGERI SIPIL</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Status Perkawinan</label>
                        <select name="status_perkawinan" id="" class="form-control">
                            <option value="BELUM KAWIN">BELUM KAWIN</option>
                            <option value="KAWIN">KAWIN</option>
                            <option value="CERAI HIDUP">CERAI HIDUP</option>
                            <option value="CERAI MATI">CERAI MATI</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

            </div>
        </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #556898;">Edit Data Warga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" id="id" name="id" hidden>
                    <label for="exampleFormControlInput1" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" placeholder="Masukkan NIK" name="nik">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Password" name="password">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">No KK</label>
                    <input type="text" class="form-control" id="no_kk" placeholder="Masukkan No KK" name="no_kk">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat" name="alamat">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat" placeholder="Masukkan Tempat Lahir" name="tempat">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tgl" placeholder="Masukkan Tanggal Lahir" name="tgl">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Agama</label>
                    <select name="agama" id="agama" class="form-control">
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Budha">Budha</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Konghuchu">Konghuchu</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                    <select name="pekerjaan" id="pekerjaan" class="form-control">
                        <option value="BELUM / TIDAK BEKERJA">BELUM / TIDAK BEKERJA</option>
                        <option value="MENGURUS RUMAH TANGGA">MENGURUS RUMAH TANGGA</option>
                        <option value="PELAJAR / MAHASISWA">Katolik</option>
                        <option value="PENSIUNAN">PENSIUNAN</option>
                        <option value="PEGAWAI NEGERI SIPIL">PEGAWAI NEGERI SIPIL</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Status Perkawinan</label>
                    <select name="status_perkawinan" id="status_perkawinan" class="form-control">
                        <option value="BELUM KAWIN">BELUM KAWIN</option>
                        <option value="KAWIN">KAWIN</option>
                        <option value="CERAI HIDUP">CERAI HIDUP</option>
                        <option value="CERAI MATI">CERAI MATI</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="SubmitUpdateForm">Perbarui Data</button>
            </div>
        </div>
        </div>
    </div>
@endsection
