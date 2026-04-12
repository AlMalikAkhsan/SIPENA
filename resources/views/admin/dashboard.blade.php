@extends('layouts.app')

@section('content')
<div class="admin-page">
    <section class="admin-header">
        <div>
            <h1>Dashboard Admin</h1>
            <p class="admin-subtitle">Ringkasan laporan warga dan aktivitas terbaru.</p>
        </div>
        <div class="admin-actions">
            <a href="{{ route('admin.laporan.index') }}" class="admin-btn admin-btn-primary">
                <i class="fas fa-file-alt"></i>
                Kelola Laporan
            </a>
            <a href="{{ route('admin.saran.index') }}" class="admin-btn admin-btn-ghost">
                <i class="fas fa-lightbulb"></i>
                Kelola Saran
            </a>
        </div>
    </section>

    <section class="stat-grid">
        <article class="stat-card">
            <span class="stat-label">Total Laporan</span>
            <span class="stat-value">{{ $total }}</span>
        </article>
        <article class="stat-card">
            <span class="stat-label">Menunggu</span>
            <span class="stat-value">{{ $menunggu }}</span>
        </article>
        <article class="stat-card">
            <span class="stat-label">Diproses</span>
            <span class="stat-value">{{ $diproses }}</span>
        </article>
        <article class="stat-card">
            <span class="stat-label">Selesai</span>
            <span class="stat-value">{{ $selesai }}</span>
        </article>
        <article class="stat-card">
            <span class="stat-label">Ditolak</span>
            <span class="stat-value">{{ $ditolak }}</span>
        </article>
    </section>

    <section class="panel">
        <h2 class="panel-title">Periode Laporan</h2>
        <div class="stat-grid">
            <article class="stat-card">
                <span class="stat-label">Hari Ini</span>
                <span class="stat-value">{{ $todayReports }}</span>
            </article>
            <article class="stat-card">
                <span class="stat-label">Minggu Ini</span>
                <span class="stat-value">{{ $weekReports }}</span>
            </article>
            <article class="stat-card">
                <span class="stat-label">Bulan Ini</span>
                <span class="stat-value">{{ $monthReports }}</span>
            </article>
        </div>
    </section>

    <section class="panel">
        <h2 class="panel-title">Tren 6 Bulan Terakhir</h2>
        <div style="height: 320px;">
            <canvas id="monthlyChart"></canvas>
        </div>
        <p id="monthlyChartError" class="admin-subtitle" style="display:none; margin-top:.6rem;">
            Grafik gagal dimuat. Silakan refresh halaman.
        </p>
    </section>

    <section class="panel">
        <h2 class="panel-title">Laporan Terbaru</h2>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Pelapor</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latest as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->user->name ?? 'Anonim' }}</td>
                            <td>
                                <span class="badge-status badge-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a class="admin-btn admin-btn-ghost" href="{{ route('admin.laporan.show', $item->id) }}">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Belum ada laporan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const monthlyCtx = document.getElementById('monthlyChart');
    const chartErrorEl = document.getElementById('monthlyChartError');

    if (monthlyCtx && window.Chart) {
        try {
            new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: @json($monthlyChartData['labels']),
                datasets: [
                    {
                        label: 'Menunggu',
                        data: @json($monthlyChartData['menunggu']),
                        backgroundColor: '#f59e0b'
                    },
                    {
                        label: 'Diproses',
                        data: @json($monthlyChartData['diproses']),
                        backgroundColor: '#3b82f6'
                    },
                    {
                        label: 'Selesai',
                        data: @json($monthlyChartData['selesai']),
                        backgroundColor: '#10b981'
                    },
                    {
                        label: 'Ditolak',
                        data: @json($monthlyChartData['ditolak']),
                        backgroundColor: '#ef4444'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });
        } catch (error) {
            if (chartErrorEl) {
                chartErrorEl.style.display = 'block';
                chartErrorEl.textContent = 'Grafik gagal dimuat: ' + error.message;
            }
        }
    }
    if (monthlyCtx && !window.Chart && chartErrorEl) {
        chartErrorEl.style.display = 'block';
        chartErrorEl.textContent = 'Library chart tidak tersedia.';
    }
</script>
@endsection
