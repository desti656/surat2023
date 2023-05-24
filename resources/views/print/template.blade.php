<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SKCK</title>
    <style>
        body {
            margin-left: 1.8cm;
            margin-right: 1.8cm;
        }
        .kop h3{
            margin: 0;
        }
    </style>
    @stack('css')
</head>
<body onload="window.print()">
    <table width="100%">
        <tr>
            <td width="80">
                <img src="{{ asset('img/garuda.jpg') }}" width="80px" height="80px">
            </td>
            <td class="kop" style="text-align: center;">
                <h3>Pemerintah Kabupaten Lumajang</h3>
                <h3>Kecamatan Sumbersuko</h3>
                <h3>Desa Kebonsari</h3>
            </td>
            <td width="80"></td>
        </tr>
    </table>
    <hr color="black">
    @yield('content')
</body>
</html>
