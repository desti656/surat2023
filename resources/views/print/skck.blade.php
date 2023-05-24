@extends('print.template')
@section('content')
@push('css')
    <style>
        .ml-1 {
            margin-left: 1.5cm;
        }
        .enter {
            margin-top: 20px;
        }
        p {
            margin: 0;
        }
        .text-indent50 {
            text-indent: 50px;
        }
    </style>
@endpush
<p style="float: right;">{{ $profil_desa->name.', '.date('d M Y') }}</p>
<table width="100%">
    <tr>
        <td>
            <table>
                <tr>
                    <td width="80">Nomor</td>
                    <td>:</td>
                    <td>730/     /D1/20</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td style="text-decoration: underline;">Pengantar untuk membuat SKCK</td>
                </tr>
            </table>
        </td>
        <td width="40%">
            <center>
                <table style="text-align: center;">
                    <tr>
                        <td>Kepada Yth</td>
                    </tr>
                    <tr>
                        <td>Bp. Kapolsek ASD</td>
                    </tr>
                    <tr>
                        <td>Di -</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: underline;">{{$profil_desa->name}}</td>
                    </tr>
                </table>
            </center>
        </td>
    </tr>
</table>
<p class="ml-1 enter">Dengan hormat,</p>
<p class="enter text-indent50">Yang bertandatangan dibawah ini Kepala Desa {{$profil_desa->name}} Kecamata {{$profil_desa->kecamatan}} Kabupaten {{$profil_desa->kabupaten}}, menerangkan bahwa :</p>
<table width="100%" class="ml-1 enter" border="0">
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{$warga->name}}</td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{$warga->username}}</td>
    </tr>
    <tr>
        <td>Tempat, Tanggal Lahir</td>
        <td>:</td>
        <td>{{"$warga->tempat_lahir, $warga->tgl_lahir"}}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>{{$warga->jenis_kelamin}}</td>
    </tr>
    <tr>
        <td>Agama</td>
        <td>:</td>
        <td>{{$warga->agama}}</td>
    </tr>
    <tr>
        <td>Status Perkawinan</td>
        <td>:</td>
        <td>{{$warga->status_perkawinan}}</td>
    </tr>
    <tr>
        <td>Pekerjaan</td>
        <td>:</td>
        <td>{{$warga->pekerjaan}}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{$warga->address}}</td>
    </tr>
</table>
<p class="enter text-indent50">Sepanjang dalam sepengetahuan kami orang tersebut diatas berlakuan baik, dan tidak terlibat dalam tindakan kriminal.</p>
<p class="enter text-indent50">Orang tersebut diatas bermaksud membuat SKCK, untuk memenuhi persyaratan :</p>
<center>
    <h3>"{{$data->keterangan}}"</h3>
</center>
<p class="enter text-indent50">Demikian surat pengantar ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
<table class="enter" style="float: right;">
    <tr>
        <td style="text-align: center;">
            Kepala Desa {{$profil_desa->name}}
        </td>
    </tr>
    <tr height="50"></tr>
    <tr>
        <td style="text-align: center;text-decoration: underline;">{{strtoupper($profil_desa->nama_kades)}}</td>
    </tr>
</table>
<center>
    <p class="enter">Mengetahui,</p>
</center>
<table class="enter" width="100%">
    <tr>
        <td>
            <center>
                <table class="enter">
                    <tr>
                        <td style="text-align: center;">
                            Camat {{$profil_desa->kecamatan}}
                        </td>
                    </tr>
                    <tr height="50"></tr>
                    <tr>
                        <td style="text-align: center;">
                            ..........................
                        </td>
                    </tr>
                </table>
            </center>
        </td>
        <td width="250"></td>
        <td>
            <center>
                <table class="enter">
                    <tr>
                        <td style="text-align: center;">
                            Kepala Desa {{$warga->name}}
                        </td>
                    </tr>
                    <tr height="50"></tr>
                    <tr>
                        <td style="text-align: center;">
                            ..........................
                        </td>
                    </tr>
                </table>
            </center>
        </td>
    </tr>
</table>
@endsection