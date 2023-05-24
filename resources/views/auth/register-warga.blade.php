<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        .text-center-satu h1{
            color: #556898 !important;
            font-weight: bold;
            font-size: 38px;
        }

        .login {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("{{asset('storage')}}/profil-desa/{{$profil->foto}}");
        }
    </style>

</head>

<body class="login">

    <div class="container-fluid">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="card o-hidden border-0 shadow-lg my-5" style="width: 50%">
                <div class="card-body p-3">

                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center-satu text-center">
                                    <h1 class="fw-bold">{{$profil->name}}</h1>
                                </div><hr>
                                <div class="text-center-satu text-center mt-5">
                                    <h3 class="mb-4">Register</h3>
                                </div>
                                @include('components.notification')
                                <form action="{{ route('post-warga') }}" method="POST" class="form-user">
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
                                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Password" name="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">No KK</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan No KK" name="no_kk">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Alamat" name="alamat">
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary mx-2">Simpan</button>
                </form>
                </div>
            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('template/js/sb-admin-2.min.js')}}"></script>

</body>

</html>
