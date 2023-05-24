@extends('welcome')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Dashboard {{ auth()->user()->name }}</h1>
<!-- Begin Page Content -->
<!-- Content Row -->
<div class="row mt-4">

    @if (Auth::user()->role_id == 3)
    <!-- Total Permintaan -->
    <div class="col-xl-4 col-md-6">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Permintaan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_permintaan }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gambar -->
    <div class="col-xl-8 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Foto Desa</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <img src="{{ asset('storage') }}/profil-desa/{{$profil->foto}}" class="img-fluid rounded" alt="">
            </div>
        </div>
    </div>
    @else
    <!-- Total Permintaan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Permintaan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_permintaan }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Warga -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Warga</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_warga }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hands fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Surat Masuk -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Surat Masuk
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_surat_masuk }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hands-helping fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Surat Keluar -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Surat Keluar
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_surat_keluar }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hands-helping fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

    @if (Auth::user()->role_id != 3)
        <!-- Gambar -->
        <div class="row">
            <div class="col-xl-8 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Foto Desa</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <img src="{{ asset('storage') }}/profil-desa/{{$profil->foto}}" class="img-fluid rounded" alt="">
                    </div>
                </div>
            </div>
        </div>
    @endif

<!-- Content Row -->
@endsection
