<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Barang</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Laporan Data Barang</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
                <tr>
                    <td>{{ $barang->id }}</td>
                    <td>
                        @if ($barang->foto && file_exists(storage_path('app/public/' . $barang->foto)))
                            @php
                                $path = storage_path('app/public/' . $barang->foto);
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            @endphp
                            <img src="{{ $base64 }}" alt="{{ $barang->nama }}" width="60">
                        @else
                            <span>No Img</span>
                        @endif
                    </td>
                    <td>{{ $barang->nama }}</td>
                    <td>{{ $barang->kategori }}</td>
                    <td>{{ $barang->stok }}</td>
                    <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
