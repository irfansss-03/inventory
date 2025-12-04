<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Barang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body { 
            font-family: 'Arial', sans-serif;
            padding: 30px;
            background: linear-gradient(to bottom, #f8f9fa 0%, #e9ecef 100%);
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .header p {
            font-size: 12px;
            opacity: 0.9;
        }
        
        .info-box {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #667eea;
        }
        
        .info-box p {
            font-size: 11px;
            color: #495057;
            line-height: 1.6;
        }
        
        .info-box strong {
            color: #212529;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        
        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        th { 
            text-align: left; 
            padding: 12px 10px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        td { 
            border-bottom: 1px solid #e9ecef;
            padding: 10px;
            font-size: 10px;
            color: #495057;
        }
        
        tbody tr {
            transition: background-color 0.2s;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tbody tr:hover {
            background-color: #e7f1ff;
        }
        
        img {
            border-radius: 6px;
            border: 2px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .no-img {
            display: inline-block;
            padding: 5px 10px;
            background: #f8d7da;
            color: #721c24;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 600;
        }
        
        .price {
            color: #28a745;
            font-weight: 600;
        }
        
        .stock-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: 600;
        }
        
        .stock-high {
            background: #d4edda;
            color: #155724;
        }
        
        .stock-medium {
            background: #fff3cd;
            color: #856404;
        }
        
        .stock-low {
            background: #f8d7da;
            color: #721c24;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #6c757d;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .category-badge {
            display: inline-block;
            padding: 4px 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📦 LAPORAN DATA BARANG</h1>
        <p>Inventory Management System</p>
    </div>

    <div class="info-box">
        <p><strong>Tanggal Cetak:</strong> {{ now()->format('d F Y, H:i') }} WIB</p>
        <p><strong>Total Barang:</strong> {{ $barangs->count() }} item</p>
        <p><strong>Status:</strong> Aktif dan Terkini</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 12%;">Foto</th>
                <th style="width: 28%;">Nama Barang</th>
                <th style="width: 18%;">Kategori</th>
                <th style="width: 12%;">Stok</th>
                <th style="width: 25%;">Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
                <tr>
                    <td style="text-align: center; font-weight: 600;">#{{ $barang->id }}</td>
                    <td style="text-align: center;">
                        @if ($barang->foto && file_exists(storage_path('app/public/' . $barang->foto)))
                            @php
                                $path = storage_path('app/public/' . $barang->foto);
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            @endphp
                            <img src="{{ $base64 }}" alt="{{ $barang->nama }}" width="50" height="50">
                        @else
                            <span class="no-img">No Image</span>
                        @endif
                    </td>
                    <td style="font-weight: 600; color: #212529;">{{ $barang->nama }}</td>
                    <td><span class="category-badge">{{ $barang->kategori }}</span></td>
                    <td style="text-align: center;">
                        @php
                            $stockClass = 'stock-high';
                            if ($barang->stok < 10) $stockClass = 'stock-low';
                            elseif ($barang->stok < 30) $stockClass = 'stock-medium';
                        @endphp
                        <span class="stock-badge {{ $stockClass }}">{{ $barang->stok }} unit</span>
                    </td>
                    <td class="price">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Inventory Management System</strong> | Generated by System</p>
        <p>Dokumen ini dicetak secara otomatis dan sah tanpa tanda tangan</p>
    </div>
</body>
</html>