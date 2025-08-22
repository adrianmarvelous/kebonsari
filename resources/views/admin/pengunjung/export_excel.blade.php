<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Daftar Pengunjung Web Bulan {{ $bulan }} Tahun {{ $tahun }}</h1>
    <table border="1" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th style="border:1px solid black; padding:5px;">No</th>
            <th style="border:1px solid black; padding:5px;">Nama</th>
            <th style="border:1px solid black; padding:5px;">Alamat</th>
            <th style="border:1px solid black; padding:5px;">Pelayanan</th>
            <th style="border:1px solid black; padding:5px;">Klik Aplikasi</th>
            <th style="border:1px solid black; padding:5px;">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengunjung as $no => $item)
            <tr>
                <td style="border:1px solid black; padding:5px;">{{ $no+1 }}</td>
                <td style="border:1px solid black; padding:5px;">{{ $item->nama }}</td>
                <td style="border:1px solid black; padding:5px;">{{ $item->alamat }}</td>
                <td style="border:1px solid black; padding:5px;">{{ $item->layanan->nama_layanan }}</td>
                <td style="border:1px solid black; padding:5px;">
                    {{ $item->klik_app ? 'Iya' : 'Tidak' }}
                </td>
                <td style="border:1px solid black; padding:5px;">
                    {{ date('d-m-Y', strtotime($item->created_at)) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>