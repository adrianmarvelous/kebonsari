<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Visitor;
use App\Models\Flyer;
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

        $layanan_populer = [
            [
                'route' => 'web.layanan.detail',
                'params' => ['id' => 1],
                'icon' => 'fa fa-user',
                'judul' => 'Akta Kelahiran'
            ],
            [
                'route' => 'web.layanan.detail',
                'params' => ['id' => 45],
                'icon' => 'fa fa-id-card',
                'judul' => 'Pendaftaran KTP Elektronik',
            ],
            [
                'route' => 'web.layanan.detail',
                'params' => ['id' => 47],
                'icon' => 'fa fa-file',
                'judul' => 'Perubahan Biodata',
            ],
            [
                'route' => 'web.layanan.detail',
                'params' => ['id' => 2],
                'icon' => 'fa fa-envelope',
                'judul' => 'Surat Pengantar Nikah',
            ],
            [
                'route' => 'web.layanan.detail',
                'params' => ['id' => 4],
                'icon' => 'fa fa-envelope',
                'judul' => 'Surat Belum Pernah Nikah',
            ],
        ];

        
        $sektor = Layanan::select('kategori')->distinct()->get();
        // $semua_layanan = Layanan::pluck('nama_layanan')->toArray();
        $semua_layanan = Layanan::select('id','nama_layanan')->get();

        return view('web.layanan.index', compact('sektor','layanan_populer','semua_layanan'));
    }
    public function sektor($sektor)
    {
        if (!Session::has('visitor_nama')) {
            // Redirect to a specific route if session does not exist
            return redirect()->route('index');
        }
        $layanan = Layanan::with('persyaratan')->where('kategori', $sektor)->get();
        $semua_layanan = Layanan::pluck('nama_layanan')->toArray();
        return view('web.layanan.sektor', compact('layanan', 'sektor','semua_layanan'));
    }
    public function detail($id)
    {
        if (!Session::has('visitor_nama')) {
            // Redirect to a specific route if session does not exist
            return redirect()->route('index');
        }
        $layanan = Layanan::with('persyaratan','flyer')->findOrFail($id);
        dd($layanan);
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
        $validated = $request->validate([
            'layanan' => ['required', 'string', 'max:255', new SafeInput],
        ]);
        try {
            $find_layanan = Layanan::where('nama_layanan',$validated['layanan'])
                                ->first();
            if($find_layanan){
                return redirect()->route('web.layanan.detail', ['id' => $find_layanan->id]);
            }else{
                $layanans = Layanan::with('persyaratan')
                                    ->where('nama_layanan', 'LIKE', "%{$validated['layanan']}%")
                                    ->limit(10)
                                    ->get();
                // dd($layanan);
                // return response()->json($layanans);
                return view('web.layanan.hasil_search',compact('layanans'));
            }

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
