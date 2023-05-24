@extends('welcome')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Profile</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-body">
            <div class="mb-3">
                <h3>Edit Profile</h3>
            </div>
            @include('components.notification')
            <hr>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" name="id" value="{{ $data->id }}" hidden>
                            <label for="exampleFormControlInput1" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Nama" name="nama" value="{{ old('nama',$data->name) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            @if (auth()->user()->role_id == 3)
                            <label for="exampleFormControlInput1" class="form-label">NIK</label>
                            @else
                            <label for="exampleFormControlInput1" class="form-label">Username</label>
                            @endif
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan NIK" name="nik" value="{{ old('nama',$data->username) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Masukkan password" name="password">
                        </div>
                    </div>
                    @if (auth()->user()->role_id == 3)
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">No KK</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan No KK" name="no_kk" value="{{ old('no_kk',$data->no_kk) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Alamat" name="alamat" value="{{ old('alamat',$data->address) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Tempat Lahir" name="tempat" value="{{ old('tempat',$data->tempat_lahir) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Tanggal Lahir" name="tgl" value="{{ old('tgl',$data->tgl_lahir) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="" class="form-control">
                                <option value="0">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ $data->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Agama</label>
                            <select name="agama" id="" class="form-control">
                                <option value="Islam" {{ $data->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ $data->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ $data->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Budha" {{ $data->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                                <option value="Hindu" {{ $data->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Konghuchu" {{ $data->agama == 'Konghuchu' ? 'selected' : '' }}>Konghuchu</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                            <select name="pekerjaan" id="" class="form-control">
                                <option value="BELUM / TIDAK BEKERJA" {{ $data->pekerjaan == 'BELUM / TIDAK BEKERJA' ? 'selectd' : '' }}>BELUM / TIDAK BEKERJA</option>
                                <option value="MENGURUS RUMAH TANGGA" {{ $data->pekerjaan == 'MENGURUS RUMAH TANGGA' ? 'selectd' : '' }}>MENGURUS RUMAH TANGGA</option>
                                <option value="PELAJAR / MAHASISWA" {{ $data->pekerjaan == 'PELAJAR / MAHASISWA' ? 'selectd' : '' }}>Katolik</option>
                                <option value="PENSIUNAN" {{ $data->pekerjaan == 'PENSIUNAN' ? 'selectd' : '' }}>PENSIUNAN</option>
                                <option value="PEGAWAI NEGERI SIPIL" {{ $data->pekerjaan == 'PEGAWAI NEGERI SIPIL' ? 'selectd' : '' }}>PEGAWAI NEGERI SIPIL</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Status Perkawinan</label>
                            <select name="status_perkawinan" id="" class="form-control">
                                <option value="BELUM KAWIN" {{ $data->status_perkawinan == 'BELUM KAWIN' ? 'selected' : '' }}>BELUM KAWIN</option>
                                <option value="KAWIN" {{ $data->status_perkawinan == 'KAWIN' ? 'selected' : '' }}>KAWIN</option>
                                <option value="CERAI HIDUP" {{ $data->status_perkawinan == 'CERAI HIDUP' ? 'selected' : '' }}>CERAI HIDUP</option>
                                <option value="CERAI MATI" {{ $data->status_perkawinan == 'CERAI MATI' ? 'selected' : '' }}>CERAI MATI</option>
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary border-0" href="" style="background-color: #556898 !important">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
