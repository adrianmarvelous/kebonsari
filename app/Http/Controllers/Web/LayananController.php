<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Visitor;
use App\Rules\SafeInput;


class LayananController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', new SafeInput],
            'alamat' => ['required', 'string', 'max:255', new SafeInput],
        ]);
          // simpan ke DB tanpa id_layanan dulu
        // $visitor = Visitor::create($validated);

        // // simpan visitor_id ke session
        // session(['visitor_id' => $visitor->id]);
        session(['visitor_nama' => $validated['nama']]);
        session(['visitor_alamat' => $validated['alamat']]);

        
        $sektor = Layanan::select('sektor')->distinct()->get();
        return view('web.layanan.index', compact('sektor'));
    }
    public function sektor($sektor)
    {
        if (!Session::has('visitor_nama')) {
            // Redirect to a specific route if session does not exist
            return redirect()->route('index');
        }
        $layanan = Layanan::with('persyaratan')->where('sektor', $sektor)->get();
        return view('web.layanan.sektor', compact('layanan', 'sektor'));
    }
    public function detail($id)
    {
        if (!Session::has('visitor_nama')) {
            // Redirect to a specific route if session does not exist
            return redirect()->route('index');
        }
        $layanan = Layanan::with('persyaratan')->findOrFail($id);
        
        DB::beginTransaction();

        try {
                Visitor::create([
                    'nama' => session('visitor_nama'),
                    'alamat' => session('visitor_alamat'),
                    'id_layanan' => $id,
                ]);

            DB::commit();

                return view('web.layanan.detail', [
                    'layanan' => $layanan,
                    'success' => 'Visitor updated successfully!'
                ]);

        } catch (\Exception $e) {
            DB::rollBack();

            // ✅ Redirect to layanan.index on error with message
            return back()->with('error', 'Failed to update visitor: ' . $e->getMessage());
        }

        // return view('web.layanan.detail', compact('layanan'));
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
    public function klik_app($id)
    {
        $layanan = Layanan::with('persyaratan')->findOrFail($id);
        if($layanan['kategori'] == "SSW ALFA"){
            $url = 'https://sswalfa.surabaya.go.id/login';
        }else{
            $url = 'https://wargaklampid-dispendukcapil.surabaya.go.id/app/login';
        }
        try {
            $nama = session('visitor_nama');
            $alamat = session('visitor_alamat');
            $visitor = Visitor::where('nama', $nama)
                                ->where('alamat', $alamat)
                                ->where('id_layanan', $id)
                                ->firstOrFail();


            $visitor->update([
                'klik_app' => 1,
            ]);

            DB::commit();
            return redirect()->away($url);

        } catch (\Exception $e) {
            DB::rollBack();

            // ✅ Redirect to layanan.index on error with message
            return back()->with('error', 'Failed to update visitor: ' . $e->getMessage());
        }
    }

}
