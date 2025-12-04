<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Karyawan</title>
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
            background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
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
            border-left: 4px solid #7c3aed;
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
            background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
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
            background-color: #e7e5ff;
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
        
        .jabatan-badge {
            display: inline-block;
            padding: 4px 8px;
            background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
            color: white;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 600;
        }
        
        .age-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: 600;
        }
        
        .age-young {
            background: #d1fae5;
            color: #065f46;
        }
        
        .age-middle {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .age-senior {
            background: #fef3c7;
            color: #92400e;
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
        
        .date-text {
            font-size: 9px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>👥 LAPORAN DATA KARYAWAN</h1>
        <p>Human Resource Management System</p>
    </div>

    <div class="info-box">
        <p><strong>Tanggal Cetak:</strong> {{ now()->format('d F Y, H:i') }} WIB</p>
        <p><strong>Total Karyawan:</strong> {{ $karyawans->count() }} orang</p>
        <p><strong>Status:</strong> Aktif dan Terkini</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 12%;">Foto</th>
                <th style="width: 25%;">Nama</th>
                <th style="width: 20%;">Jabatan</th>
                <th style="width: 13%;">Umur</th>
                <th style="width: 25%;">Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawans as $karyawan)
                <tr>
                    <td style="text-align: center; font-weight: 600;">#{{ $karyawan->id }}</td>
                    <td style="text-align: center;">
                        @if ($karyawan->foto && file_exists(storage_path('app/public/' . $karyawan->foto)))
                            @php
                                $path = storage_path('app/public/' . $karyawan->foto);
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            @endphp
                            <img src="{{ $base64 }}" alt="{{ $karyawan->nama }}" width="50" height="50">
                        @else
                            <span class="no-img">No Image</span>
                        @endif
                    </td>
                    <td style="font-weight: 600; color: #212529;">{{ $karyawan->nama }}</td>
                    <td><span class="jabatan-badge">{{ $karyawan->jabatan }}</span></td>
                    <td style="text-align: center;">
                        @php
                            $age = $karyawan->umur;
                            $ageClass = 'age-young';
                            if ($age >= 40) $ageClass = 'age-senior';
                            elseif ($age >= 30) $ageClass = 'age-middle';
                        @endphp
                        <span class="age-badge {{ $ageClass }}">{{ $age }} tahun</span>
                    </td>
                    <td>
                        @if($karyawan->tanggal_masuk)
                            {{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('d M Y') }}
                            <br>
                            <span class="date-text">({{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->diffForHumans() }})</span>
                        @else
                            <span style="color: #adb5bd;">-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Human Resource Management System</strong> | Generated by System</p>
        <p>Dokumen ini dicetak secara otomatis dan sah tanpa tanda tangan</p>
    </div>
</body>
</html>