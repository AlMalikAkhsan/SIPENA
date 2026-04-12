<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan Warga - {{ date('d F Y') }}</title>
    <style>
        @page {
            margin: 24px 24px 28px 24px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 10pt;
            color: #1f2937;
            line-height: 1.35;
            position: relative;
        }

        .watermark {
            position: fixed;
            top: 46%;
            left: 52%;
            transform: translate(-50%, -50%) rotate(-33deg);
            font-size: 58pt;
            font-weight: 700;
            color: rgba(37, 99, 235, 0.06);
            z-index: -1;
            letter-spacing: 2px;
            white-space: nowrap;
        }

        .header {
            border-bottom: 2px solid #1d4ed8;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }

        .header-top {
            width: 100%;
        }

        .header-title {
            font-size: 18pt;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 3px;
        }

        .header-subtitle {
            font-size: 10pt;
            color: #475569;
        }

        .header-meta {
            margin-top: 6px;
            font-size: 8.8pt;
            color: #64748b;
        }

        .block {
            border: 1px solid #dbe3ef;
            border-radius: 8px;
            margin-bottom: 12px;
            overflow: hidden;
        }

        .block-title {
            background: #eff6ff;
            color: #1e3a8a;
            font-weight: 700;
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            padding: 8px 10px;
            border-bottom: 1px solid #dbe3ef;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 7px 10px;
            border-bottom: 1px solid #eef2f7;
            font-size: 9pt;
            vertical-align: top;
        }

        .info-table tr:last-child td {
            border-bottom: none;
        }

        .info-table td:first-child {
            width: 160px;
            color: #475569;
            font-weight: 700;
        }

        .stats-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .stats-table td {
            border-right: 1px solid #e2e8f0;
            padding: 12px 8px;
            text-align: center;
            background: #f8fafc;
        }

        .stats-table td:last-child {
            border-right: none;
        }

        .stats-number {
            display: block;
            font-size: 18pt;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 5px;
        }

        .stats-label {
            font-size: 8.4pt;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
        }

        .c-total { color: #1d4ed8; }
        .c-menunggu { color: #b45309; }
        .c-diproses { color: #1d4ed8; }
        .c-selesai { color: #047857; }
        .c-ditolak { color: #b91c1c; }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8.9pt;
        }

        .data-table thead th {
            background: #1e40af;
            color: #ffffff;
            text-align: left;
            font-size: 8.2pt;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding: 8px 7px;
            border: 1px solid #1e3a8a;
        }

        .data-table td {
            border: 1px solid #e2e8f0;
            padding: 7px;
            vertical-align: top;
        }

        .data-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .status {
            display: inline-block;
            font-size: 7.8pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border-radius: 999px;
            padding: 3px 8px;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .status.menunggu {
            color: #92400e;
            background: #ffedd5;
            border-color: #fed7aa;
        }

        .status.diproses {
            color: #1e3a8a;
            background: #dbeafe;
            border-color: #bfdbfe;
        }

        .status.selesai {
            color: #065f46;
            background: #d1fae5;
            border-color: #a7f3d0;
        }

        .status.ditolak {
            color: #991b1b;
            background: #fee2e2;
            border-color: #fecaca;
        }

        .muted {
            color: #64748b;
            font-size: 7.8pt;
        }

        .no-data {
            border: 1px dashed #cbd5e1;
            background: #f8fafc;
            border-radius: 8px;
            text-align: center;
            padding: 24px 14px;
            color: #64748b;
            font-size: 10pt;
        }

        .signature-wrap {
            margin-top: 18px;
            width: 100%;
        }

        .signature-box {
            width: 240px;
            margin-left: auto;
            text-align: center;
            font-size: 9pt;
            color: #334155;
        }

        .signature-space {
            height: 62px;
        }

        .footer {
            margin-top: 12px;
            border-top: 1px solid #dbe3ef;
            padding-top: 7px;
            text-align: center;
            font-size: 7.8pt;
            color: #64748b;
        }

        .data-table tr {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <div class="watermark">LAPOR AJA</div>

    <header class="header">
        <div class="header-top">
            <div class="header-title">Rekap Laporan Warga</div>
            <div class="header-subtitle">Sistem Pelaporan Aspirasi Warga (LaporAja)</div>
            <div class="header-meta">Dicetak: {{ date('d F Y H:i') }} WIB | Dicetak oleh: {{ auth()->user()->name ?? 'Admin' }}</div>
        </div>
    </header>

    <section class="block">
        <div class="block-title">Informasi Export</div>
        <table class="info-table">
            <tr>
                <td>Jumlah Data</td>
                <td>{{ $stats['total'] }} laporan</td>
            </tr>
            <tr>
                <td>Filter Status</td>
                <td>{{ $filters['status'] == '' ? 'Semua status' : ucfirst($filters['status']) }}</td>
            </tr>
            <tr>
                <td>Periode Tanggal</td>
                <td>
                    @if($filters['start_date'] != 'Semua' && $filters['end_date'] != 'Semua')
                        {{ date('d/m/Y', strtotime($filters['start_date'])) }} sampai {{ date('d/m/Y', strtotime($filters['end_date'])) }}
                    @else
                        Semua tanggal
                    @endif
                </td>
            </tr>
        </table>
    </section>

    <section class="block">
        <div class="block-title">Ringkasan Statistik</div>
        <table class="stats-table">
            <tr>
                <td>
                    <span class="stats-number c-total">{{ $stats['total'] }}</span>
                    <span class="stats-label">Total</span>
                </td>
                <td>
                    <span class="stats-number c-menunggu">{{ $stats['menunggu'] }}</span>
                    <span class="stats-label">Menunggu</span>
                </td>
                <td>
                    <span class="stats-number c-diproses">{{ $stats['diproses'] }}</span>
                    <span class="stats-label">Diproses</span>
                </td>
                <td>
                    <span class="stats-number c-selesai">{{ $stats['selesai'] }}</span>
                    <span class="stats-label">Selesai</span>
                </td>
                <td>
                    <span class="stats-number c-ditolak">{{ $stats['ditolak'] ?? 0 }}</span>
                    <span class="stats-label">Ditolak</span>
                </td>
            </tr>
        </table>
    </section>

    @if($laporans->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:30px; text-align:center;">No</th>
                    <th style="width:58px;">ID</th>
                    <th style="width:140px;">Pelapor</th>
                    <th style="width:145px;">Judul</th>
                    <th>Isi Laporan</th>
                    <th style="width:80px; text-align:center;">Status</th>
                    <th style="width:82px; text-align:center;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporans as $index => $item)
                    <tr>
                        <td style="text-align:center;">{{ $index + 1 }}</td>
                        <td>#{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <strong>{{ $item->user->name ?? 'Anonim' }}</strong><br>
                            <span class="muted">{{ $item->user->email ?? '-' }}</span>
                        </td>
                        <td>
                            <strong>{{ \Illuminate\Support\Str::limit($item->judul, 52) }}</strong>
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($item->isi, 120) }}</td>
                        <td style="text-align:center;">
                            <span class="status {{ $item->status }}">{{ ucfirst($item->status) }}</span>
                        </td>
                        <td style="text-align:center;">
                            {{ $item->created_at->format('d/m/Y') }}<br>
                            <span class="muted">{{ $item->created_at->format('H:i') }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">Tidak ada data laporan sesuai filter saat ini.</div>
    @endif

    <section class="signature-wrap">
        <div class="signature-box">
            <div>Mengetahui,</div>
            <div>Admin LaporAja</div>
            <div class="signature-space"></div>
            <div><strong>{{ auth()->user()->name ?? 'Admin' }}</strong></div>
        </div>
    </section>

    <footer class="footer">
        Dokumen ini dihasilkan otomatis oleh sistem pada {{ date('d F Y H:i') }} WIB.
    </footer>
</body>
</html>
