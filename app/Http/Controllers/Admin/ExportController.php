<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    /**
     * Export laporan ke PDF
     */
    public function laporanPdf(Request $request)
    {
        $query = Laporan::with('user');

        // ================= FILTER =================
        $filters = [
            'status'     => $request->status ?? '',
            'start_date' => $request->start_date ?? 'Semua',
            'end_date'   => $request->end_date ?? 'Semua',
        ];

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59',
            ]);
        }

        $laporans = $query->latest()->get();

        // ================= STATISTIK =================
        $stats = [
            'total'    => $laporans->count(),
            'menunggu' => $laporans->where('status', 'menunggu')->count(),
            'diproses' => $laporans->where('status', 'diproses')->count(),
            'selesai'  => $laporans->where('status', 'selesai')->count(),
            'ditolak'  => $laporans->where('status', 'ditolak')->count(),
        ];

        // ================= PDF =================
        $pdf = Pdf::loadView('admin.laporan.export-pdf', [
            'laporans' => $laporans,
            'stats'    => $stats,
            'filters'  => $filters,
        ])->setPaper('A4', 'portrait');

        return $pdf->download('laporan-warga.pdf');
    }


}
