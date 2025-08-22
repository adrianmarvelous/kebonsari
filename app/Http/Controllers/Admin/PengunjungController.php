<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;

class PengunjungController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

       $tahun_visitor = Visitor::selectRaw('YEAR(created_at) as year')
                                ->distinct()
                                ->orderBy('year', 'desc')
                                ->pluck('year') // hasil: [2025, 2024, 2023]
                                ->map(function ($year) use ($bulan) {
                                    $pengunjung = Visitor::with('layanan')
                                        ->whereMonth('created_at', $bulan)
                                        ->whereYear('created_at', $year)
                                        ->get();

                                    return (object)[
                                        'year' => $year,
                                        'pengunjung' => $pengunjung,
                                    ];
                                });
        
        return view('admin.pengunjung.index',compact('tahun_visitor','bulan','tahun'));
    }
    public function export_excel($bulan,$tahun)
    {
        $pengunjung = Visitor::with('layanan')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=export_pengunjung.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        return view('admin.pengunjung.export_excel',compact('pengunjung', 'bulan', 'tahun'));
    }
}
