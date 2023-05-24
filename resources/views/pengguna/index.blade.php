@extends('welcome')

@push('js')
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
    <script>
        $('.modelClose').on('click',function() {
            $('#ModalEditData').hide();
        });
        var id_user;
        $('body').on('click','.edit-data',function(e) {
            id_user = $(this).data('id');
            console.log(id_user);
            $.ajax({
                url: "pengguna/"+id_user+"/edit",
                method: 'GET',
                success: function(data) {
                    $.map(data,function(i) {
                        console.log(i);
                        $('#nama_pengguna_edit').val(i.name);
                        $('#username_edit').val(i.username);
                        $('#level_edit option[value="' + i.role_id+ '"]').prop('selected', true);
                    })
                }
            })
        })
        var id;
        $('body').on('click','.show-data',function(e) {
            id = $(this).data('id');
            $.ajax({
                url: `pengguna/${id}`,
                method: 'GET',
                success: function(data) {
                    $.map(data,function(i) {
                        $('#nama_pengguna').val(i.name);
                        $('#username').val(i.username);
                        $('#level option[value="' + i.role_id+ '"]').prop('selected', true);
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
                url: "pengguna/"+id_user,
                method: 'PUT',
                data: {
                    name: $('#nama_pengguna_edit').val(),
                    username: $('#username_edit').val(),
                    role_id: $('#level_edit').val(),
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
    <h1 class="h3 mb-2 text-gray-800">Data Pengguna</h1>
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
                    <h6 class="m-0 font-weight-bold" style="color: #556898 !important; font-weight: bold">Data Tabel</h6>
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
                            <th>Nama </th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->role->name }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-secondary show-data mx-1" data-toggle="modal" data-target="#ModalShow" data-id="{{ $item->id }}"><i class="fas fa-eye"></i></button>
                                        <button type="button" class="btn btn-warning edit-data mx-1" data-toggle="modal" data-target="#ModalEditData" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                        @if ($item->id != auth()->user()->id)
                                        <form action="{{ route('pengguna.destroy',$item->id) }}" class="p-0 m-0" method="POST" onsubmit="return confirm('Move data to trash? ')">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger mx-1"><i class="fas fa-trash"></i></button>
                                        </form>
                                        @endif
                                    </div>
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
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #556898;">Tambah Data Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengguna.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama </label>
                        <input type="text" class="form-control @error('nama_pengguna') is-invalid @enderror" name="nama_pengguna" id="exampleFormControlInput1" placeholder="Masukkan Nama">
                        @error('nama_pengguna')
                            <small class="text-danger">
                                {{$message}}.
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="exampleFormControlInput1" placeholder="Masukkan Username">
                        @error('username')
                            <small class="text-danger">
                                {{$message}}.
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="exampleFormControlInput1" placeholder="Masukkan Password">
                        @error('password')
                            <small class="text-danger">
                                {{$message}}.
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sel1" class="form-label">Level (Pilih 1):</label><br>
                        <select class="form-control @error('level') is-invalid @enderror" id="level" name="level">
                            <option value="1">Admin</option>
                            <option value="2">Petugas</option>
                            <option value="3">Warga</option>
                        </select>
                        @error('level')
                            <small class="text-danger">
                                {{$message}}.
                            </small>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="simpanData">Simpan</button>
                </form>

            </div>
        </div>
        </div>
    </div>

    <!-- Modal Show-->
    <div class="modal fade" id="ModalShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #556898;">Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama </label>
                        <input type="text" class="form-control" id="nama_pengguna" placeholder="Masukkan Nama" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Username</label>
                        <input type="email" class="form-control" id="username" placeholder="Masukkan Email" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="sel1" class="form-label">Level (Pilih 1):</label><br>
                        <select class="form-control" id="level" name="sellist1" disabled>
                            <option>Admin</option>
                            <option>Warga</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                {{-- <button type="button" class="btn btn-primary">Simpan</button> --}}
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div class="modal fade" id="ModalEditData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #556898;">Edit Data Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama_pengguna_edit" name="nama_pengguna" placeholder="Masukkan Nama">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username_edit" name="username" placeholder="Masukkan Username">
                </div>

                <div class="mb-3">
                    <label for="sel1" class="form-label">Level (Pilih 1):</label><br>
                    <select class="form-control" id="level_edit" name="level">
                        <option value="1">Admin</option>
                        <option value="2">Petugas</option>
                        <option value="3">Warga</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modelClose" data-dismiss="modal">Batal</button>
                <button type="button" id="SubmitUpdateForm" class="btn btn-primary">Perbarui Data</button>
            </div>
        </div>
        </div>
    </div>
@endsection
