<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Warga - {{ date('d F Y') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #667eea;
        }

        .header h1 {
            color: #667eea;
            font-size: 24pt;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .header p {
            color: #666;
            font-size: 10pt;
            margin: 3px 0;
        }

        .info-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }

        .info-box table {
            width: 100%;
        }

        .info-box td {
            padding: 4px 0;
            font-size: 9pt;
        }

        .info-box td:first-child {
            font-weight: 600;
            width: 150px;
            color: #555;
        }

        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
            border-collapse: collapse;
        }

        .stat-card {
            display: table-cell;
            width: 20%;
            padding: 12px;
            text-align: center;
            border: 1px solid #e2e8f0;
            background: #f8f9fa;
        }

        .stat-card.total { border-left: 3px solid #667eea; }
        .stat-card.menunggu { border-left: 3px solid #ffc107; }
        .stat-card.diproses { border-left: 3px solid #17a2b8; }
        .stat-card.selesai { border-left: 3px solid #28a745; }
        .stat-card.ditolak { border-left: 3px solid #dc3545; }

        .stat-number {
            font-size: 22pt;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-card.total .stat-number { color: #667eea; }
        .stat-card.menunggu .stat-number { color: #ffc107; }
        .stat-card.diproses .stat-number { color: #17a2b8; }
        .stat-card.selesai .stat-number { color: #28a745; }
        .stat-card.ditolak .stat-number { color: #dc3545; }

        .stat-label {
            font-size: 9pt;
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 9pt;
        }

        table.data-table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        table.data-table th {
            padding: 10px 8px;
            text-align: left;
            font-weight: 600;
            font-size: 9pt;
            text-transform: uppercase;
        }

        table.data-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }

        table.data-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 8pt;
            font-weight: 600;
            text-align: center;
            white-space: nowrap;
        }

        .badge.menunggu {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge.diproses {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .badge.selesai {
            background-color: #d4edda;
            color: #155724;
        }

        .badge.ditolak {
            background-color: #f8d7da;
            color: #721c24;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #e2e8f0;
            text-align: center;
            font-size: 8pt;
            color: #666;
        }

        .footer p {
            margin: 3px 0;
        }

        .no-data {
            text-align: center;
            padding: 40px 20px;
            color: #999;
            font-style: italic;
        }

        table.data-table tr {
            page-break-inside: avoid;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 72pt;
            color: rgba(102, 126, 234, 0.05);
            font-weight: 700;
            z-index: -1;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    {{-- Watermark --}}
    <div class="watermark">LAPORAJA!</div>

    {{-- Header --}}
    <div class="header">
        <h1>📊 LAPORAN WARGA</h1>
        <p><strong>Sistem Pelaporan Aspirasi Warga</strong></p>
        <p style="font-size: 8pt; color: #999; margin-top: 5px;">
            Dicetak pada: {{ date('d F Y H:i') }}
        </p>
    </div>

    {{-- Info Export --}}
    <div class="info-box">
        <table>
            <tr>
                <td>Jumlah Data</td>
                <td>: {{ $stats['total'] }} Laporan</td>
            </tr>
            <tr>
                <td>Filter Status</td>
                <td>: {{ $filters['status'] == '' ? 'Semua Status' : ucfirst($filters['status']) }}</td>
            </tr>
            <tr>
                <td>Filter Tanggal</td>
                <td>: 
                    @if($filters['start_date'] != 'Semua' && $filters['end_date'] != 'Semua')
                        {{ date('d/m/Y', strtotime($filters['start_date'])) }} s/d {{ date('d/m/Y', strtotime($filters['end_date'])) }}
                    @else
                        Semua Tanggal
                    @endif
                </td>
            </tr>
            <tr>
                <td>Diekspor Oleh</td>
                <td>: {{ auth()->user()->name ?? 'Admin' }}</td>
            </tr>
        </table>
    </div>

    {{-- Statistics --}}
    <div class="stats-grid">
        <div class="stat-card total">
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Total</div>
        </div>
        <div class="stat-card menunggu">
            <div class="stat-number">{{ $stats['menunggu'] }}</div>
            <div class="stat-label">Menunggu</div>
        </div>
        <div class="stat-card diproses">
            <div class="stat-number">{{ $stats['diproses'] }}</div>
            <div class="stat-label">Diproses</div>
        </div>
        <div class="stat-card selesai">
            <div class="stat-number">{{ $stats['selesai'] }}</div>
            <div class="stat-label">Selesai</div>
        </div>
        <div class="stat-card ditolak">
            <div class="stat-number">{{ $stats['ditolak'] ?? 0 }}</div>
            <div class="stat-label">Ditolak</div>
        </div>
    </div>

    {{-- Data Table --}}
    @if($laporans->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th style="width: 60px;">ID</th>
                    <th style="width: 150px;">Pelapor</th>
                    <th>Judul Laporan</th>
                    <th style="width: 200px;">Isi Laporan</th>
                    <th style="width: 80px;">Status</th>
                    <th style="width: 90px;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporans as $index => $item)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>#{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <strong>{{ $item->user->name ?? 'Anonim' }}</strong><br>
                            <span style="font-size: 8pt; color: #666;">
                                {{ $item->user->email ?? '-' }}
                            </span>
                        </td>
                        <td><strong>{{ $item->judul }}</strong></td>
                        <td style="font-size: 8pt;">
                            {{ Str::limit($item->isi, 120) }}
                        </td>
                        <td style="text-align: center;">
                            <span class="badge {{ $item->status }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td style="font-size: 8pt; text-align: center;">
                            {{ $item->created_at->format('d/m/Y') }}<br>
                            <span style="color: #999;">{{ $item->created_at->format('H:i') }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <p>📭 Tidak ada data laporan yang sesuai dengan filter.</p>
        </div>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <p><strong>LaporAja!</strong> - Sistem Pelaporan Aspirasi Warga</p>
        <p>Dokumen ini digenerate secara otomatis oleh sistem</p>
        <p style="margin-top: 8px; font-size: 7pt; color: #999;">
            © {{ date('Y') }} LaporAja! All rights reserved.
        </p>
    </div>
</body>
</html>