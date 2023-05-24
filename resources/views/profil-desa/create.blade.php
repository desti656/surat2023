@extends('welcome')
@push('js')
    <script>
        $(document).ready(function() {
            $('#gambar_konten').change(function () {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function (event) {
                        $('#photosPreview')
                        .attr("src",event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            })
        })
    </script>
@endpush

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Profil Desa</h1>
    @include('components.notification')
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4 w-50">
        <div class="card-header py-3">
            <div class="row">
                <div class="col d-flex justify-content-start mt-2">
                    <h6 class="m-0 font-weight-bold" style="color: #556898 !important">Edit Data</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('profil-desa.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group ">
                        <label for="gambar" class="font-weight-bold">Foto : </label>
                        <div class="img__data mb-4 ">
                            <center>
                                <img src="{{ $data->foto != null ? asset('storage').'/profil-desa/'.$data->foto: asset('template/img/noimage.png') }}" alt="" class="img-fluid w-50"  id="photosPreview">
                            </center>
                        </div>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="gambar_konten" name="gambar_konten" value="{{ old('gambar_konten') }}">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                        @error('gambar_konten')
                        <div class="help-block form-text text-danger">
                            {{$message}}
                        </div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama Desa</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Nama Desa" name="nama_desa" value="{{ old('nama_desa', $data->name) }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Kecamatan</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Kecamatan" name="kecamatan" value="{{ old('kecamatan',$data->kecamatan) }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Kabupaten</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Kabupaten" name="kabupaten" value="{{ old('kabupaten',$data->kabupaten) }}">
                </div>
                <div class="form-group">
                    <label for="nama_kades">Nama Kades</label>
                    <input type="text" class="form-control" id="nama_kades" placeholder="Masukkan Nama Kepala Desa" name="nama_kades" value="{{ old('nama_kades', $data->nama_kades) }}">
                </div>
                <hr>
                <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary border-0" href="" style="background-color: #556898 !important">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
