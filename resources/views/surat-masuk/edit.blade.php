@extends('welcome')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Data Surat Masuk</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4 w-50">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    @include('components.notification')
                </div>
            </div>
            <form action="{{ route('surat-masuk.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nomor">Nomor</label>
                    <input class="form-control @error('nomor') is-invalid @enderror" type="number" name="nomor" id="nomor" value="{{ old('nomor', $data->nomor) }}" required>
                    @error('nomor')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="datepicker">Tanggal</label>
                    <input class="form-control @error('tanggal') is-invalid @enderror" type="date" name="tanggal" data-date-format="dd/mm/yyyy" id="datepicker" value="{{ old('tanggal', $data->tanggal) }}" required>
                    @error('tanggal')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pengirim">Pengirim</label>
                    <input class="form-control @error('pengirim') is-invalid @enderror" type="text" name="pengirim" id="pengirim" value="{{ old('pengirim', $data->pengirim) }}" required>
                    @error('pengirim')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="perihal">Perihal</label>
                    <input class="form-control @error('perihal') is-invalid @enderror" type="text" name="perihal" id="perihal" value="{{ old('perihal', $data->perihal) }}" required>
                    @error('perihal')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="disposisi">Disposisi</label>
                    <input class="form-control @error('disposisi') is-invalid @enderror" type="text" name="disposisi" id="disposisi" value="{{ old('disposisi', $data->disposisi) }}" required>
                    @error('disposisi')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-5">
                    <label for="berkas">Scan berkas (pdf)</label>
                    <p>
                        <a href="{{ asset('storage') }}/surat-masuk/{{ $data->file }}" target="_blank">Lihat berkas</a>
                    </p>
                    <input type="file" class="form-control-file @error('berkas') is-invalid @enderror" id="berkas" name="berkas">
                    @error('berkas')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><hr>
                <div class="col d-flex justify-content-end">
                    <a class="btn btn-secondary border-0 mx-2" href="{{ route('surat-masuk.index') }}">Batal</a>
                    <button type="submit" class="btn btn-primary border-0" href="" style="background-color: #556898 !important">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection