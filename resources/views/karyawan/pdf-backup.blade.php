<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Karyawan</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Laporan Data Karyawan</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Umur</th>
                <th>Tgl Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawans as $karyawan)
                <tr>
                    <td>{{ $karyawan->id }}</td>
                    <td>
                        @if ($karyawan->foto && file_exists(storage_path('app/public/' . $karyawan->foto)))
                            @php
                                $path = storage_path('app/public/' . $karyawan->foto);
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            @endphp
                            <img src="{{ $base64 }}" alt="{{ $karyawan->nama }}" width="60">
                        @else
                            <span>No Img</span>
                        @endif
                    </td>
                    <td>{{ $karyawan->nama }}</td>
                    <td>{{ $karyawan->jabatan }}</td>
                    <td>{{ $karyawan->umur }}</td>
                    <td>{{ $karyawan->tanggal_masuk ? \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('d M Y') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
