@extends('welcome')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Buat Permintaan</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4 w-50">
        <div class="card-header py-3">
            <div class="row">
                <div class="col d-flex justify-content-start mt-2">
                    <h6 class="m-0 font-weight-bold" style="color: #556898 !important">Form Permintaan</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('permintaan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (Auth::user()->role_id != 3)
                    <div class="form-group">
                        <label for="id_warga">Warga</label>
                        <select class="form-control" id="id_warga" name="id_warga" required>
                            <option value="0">-- Pilih warga --</option>
                            @foreach ($warga as $item)
                                <option value="{{ $item->id }}" {{ old('id_warga') == $item->id ? 'selected' : '' }}>{{ $item->username .' - '. $item->name }}</option>                            
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <label for="id_jenis_surat">Jenis Surat</label>
                    <select class="form-control" id="id_jenis_surat" name="id_jenis_surat" required>
                        <option value="0">-- Pilih jenis surat --</option>
                        @foreach ($jenis_surat as $item)
                            <option value="{{ $item->id }}" {{ old('id_jenis_surat') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>                            
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required />
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan Keterangan" required>{{ old('keterangan') }}</textarea>
                </div>
                <hr>
                <p id="title-upload" style="display: none;">Upload Scan Berkas Persyaratan (pdf)</p>
                <div class="berkas">
                </div>
                <hr>
                <div class="col d-flex justify-content-end">
                    <a class="btn btn-secondary border-0 mx-2" href="{{ route('permintaan.index') }}">Batal</a>
                    <button type="submit" class="btn btn-primary border-0" href="" style="background-color: #556898 !important">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @push('js')
        <script>
            $('#id_jenis_surat').on('change', function(e) {
                const id = this.value
                $.ajax({
                    type: "GET",
                    url: "{{url('/dashboard/permintaan/persyaratan-surat')}}/"+id,
                    success: function(response) {
                        $('.berkas').empty()
                        var data = response
                        $('#title-upload').show()
                        for (var i=0;i<data.length;i++) {
                            var input = `<div class="form-group">
                                <label id="label[]" for="exampleFormControlFile1">Scan ${data[i].name} (pdf)</label>
                                <input type="hidden" name="id_persyaratan[]" value="${data[i].id}" />
                                <input type="hidden" name="berkas_name[]" value="${data[i].name}" />
                                <input type="file" class="form-control-file" name="berkas[]" id="berkas[]">
                            </div>`
                            $('.berkas').append(input)

                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            })
        </script>
    @endpush
@endsection