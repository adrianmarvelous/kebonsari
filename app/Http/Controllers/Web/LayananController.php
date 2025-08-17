<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    public function index()
    {
        $sektor = Layanan::select('sektor')->distinct()->get();
        return view('web.layanan.index', compact('sektor'));
    }
    public function sektor($sektor)
    {
        $layanan = Layanan::with('persyaratan')->where('sektor', $sektor)->get();
        return view('web.layanan.sektor', compact('layanan', 'sektor'));
    }
    public function detail($id)
    {
        $layanan = Layanan::with('persyaratan')->findOrFail($id);
        return view('web.layanan.detail', compact('layanan'));
    }
    public function search(Request $request)
    {
        try {
            $query = $request->get('q');

            $layanans = Layanan::where('nama_layanan', 'LIKE', "%{$query}%")
                                ->limit(10)
                                ->get(['id', 'nama_layanan','sektor']);

            return response()->json($layanans);
        } catch (\Exception $e) {
            \Log::error("Search error: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
