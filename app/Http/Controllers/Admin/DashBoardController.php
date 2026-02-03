<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin
     */
    public function index()
    {
        // ========================================
        // STATISTIK DASAR LAPORAN
        // ========================================
        $total = Laporan::count();
        $menunggu = Laporan::where('status', 'menunggu')->count();
        $diproses = Laporan::where('status', 'diproses')->count();
        $selesai = Laporan::where('status', 'selesai')->count();
        $ditolak = Laporan::where('status', 'ditolak')->count(); // TAMBAHAN

        // ========================================
        // LAPORAN TERBARU (5 terbaru)
        // ========================================
        $latest = Laporan::with('user')
                    ->latest()
                    ->take(5)
                    ->get();

        // ========================================
        // STATISTIK PERIODE
        // ========================================
        $todayReports = Laporan::whereDate('created_at', today())->count();
        
        $weekReports = Laporan::whereBetween('created_at', [
            now()->startOfWeek(), 
            now()->endOfWeek()
        ])->count();
        
        $monthReports = Laporan::whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)
                        ->count();

        // ========================================
        // DATA UNTUK CHART BATANG (6 Bulan Terakhir)
        // ========================================
        $monthlyChartData = $this->getMonthlyChartData();

        // ========================================
        // DATA UNTUK CHART DONUT (Status Distribution)
        // ========================================
        $statusChartData = [
            'menunggu' => $menunggu,
            'diproses' => $diproses,
            'selesai' => $selesai,
            'ditolak' => $ditolak  // TAMBAHAN
        ];

        return view('admin.dashboard', compact(
            'total',
            'menunggu',
            'diproses',
            'selesai',
            'ditolak',           // TAMBAHAN
            'latest',
            'todayReports',
            'weekReports',
            'monthReports',
            'monthlyChartData',  // Data untuk bar chart
            'statusChartData'    // Data untuk donut chart
        ));
    }

    /**
     * Ambil data laporan 6 bulan terakhir untuk chart batang
     */
    private function getMonthlyChartData()
    {
        // Ambil 6 bulan terakhir
        $months = [];
        $menungguData = [];
        $diprosesData = [];
        $selesaiData = [];
        $ditolakData = [];  // TAMBAHAN

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            
            // Format nama bulan (contoh: Jan 2026)
            $months[] = $date->locale('id')->isoFormat('MMM YYYY');
            
            // Hitung laporan per status untuk bulan ini
            $monthStart = $date->startOfMonth()->copy();
            $monthEnd = $date->endOfMonth()->copy();
            
            $menungguData[] = Laporan::where('status', 'menunggu')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
                
            $diprosesData[] = Laporan::where('status', 'diproses')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
                
            $selesaiData[] = Laporan::where('status', 'selesai')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
                
            // TAMBAHAN: Data ditolak
            $ditolakData[] = Laporan::where('status', 'ditolak')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
        }

        return [
            'labels' => $months,
            'menunggu' => $menungguData,
            'diproses' => $diprosesData,
            'selesai' => $selesaiData,
            'ditolak' => $ditolakData  // TAMBAHAN
        ];
    }

    /**
     * ALTERNATIF: Menggunakan Query Builder yang lebih efisien
     * Uncomment jika ingin menggunakan query yang lebih optimal
     */
    /*
    private function getMonthlyChartDataOptimized()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(5)->startOfMonth();
        
        $results = Laporan::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                'status',
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', $sixMonthsAgo)
            ->groupBy('month', 'status')
            ->orderBy('month', 'asc')
            ->get();

        // Format data untuk chart
        $months = [];
        $data = [
            'menunggu' => [],
            'diproses' => [],
            'selesai' => [],
            'ditolak' => []  // TAMBAHAN
        ];

        // Generate 6 bulan terakhir
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('Y-m');
            $months[] = $date->locale('id')->isoFormat('MMM YYYY');
            
            // Set default 0 untuk setiap status
            $data['menunggu'][] = 0;
            $data['diproses'][] = 0;
            $data['selesai'][] = 0;
            $data['ditolak'][] = 0;  // TAMBAHAN
        }

        // Isi data dari hasil query
        foreach ($results as $result) {
            $date = Carbon::createFromFormat('Y-m', $result->month);
            $label = $date->locale('id')->isoFormat('MMM YYYY');
            $index = array_search($label, $months);
            
            if ($index !== false && isset($data[$result->status])) {
                $data[$result->status][$index] = $result->count;
            }
        }

        return [
            'labels' => $months,
            'menunggu' => $data['menunggu'],
            'diproses' => $data['diproses'],
            'selesai' => $data['selesai'],
            'ditolak' => $data['ditolak']  // TAMBAHAN
        ];
    }
    */
}