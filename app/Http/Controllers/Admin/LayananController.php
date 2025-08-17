<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Layanan;
use App\Models\Persyaratan;
use App\Rules\SafeInput;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $layanan = Layanan::with('persyaratan')->get(); // Returns a collection of all users
        // $roles = Roles::all();
        // Logic to retrieve and display a list of services (layanan)
        return view('admin.layanan.index',compact('layanan')); // Assuming you have a view for listing services
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Layanan::select('kategori')->distinct()->get();
        $sektor = Layanan::select('sektor')->distinct()->get();
        return view('admin.layanan.create',compact('kategori','sektor')); // Assuming you have a view for listing services
    }

    /**
     * Store a newly created resource in storage.d
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => ['required', 'string', 'max:255', new SafeInput],
            'sektor'   => ['required', 'string', 'max:255', new SafeInput],
            'nama_layanan'   => ['required', 'string', 'max:255', new SafeInput],
            'video'   => ['nullable', 'string', 'max:255', new SafeInput],
            'poster' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048', new SafeInput], // max 2MB
            // ✅ Persyaratan array validation
            'persyaratan'       => ['required', 'array', 'min:1'], // must be array and have at least 1 item
            'persyaratan.*'     => ['required', 'string', 'max:255', new SafeInput], // each item validation
        ]);

        DB::beginTransaction();

        $maxId = Layanan::max('id');
        $last_id = $maxId+1;

        $videoUrl = $validated['video']; // e.g. https://drive.google.com/file/d/1aBcD12345/view?usp=sharing

        preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $videoUrl, $matches);

        if(isset($matches[1])) {
            $videoId = $matches[1];
        } else {
            $videoId = null; // invalid URL
        }


        try {
            if($request->hasFile('poster')){
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $file = $request->file('poster');
                $extension = strtolower($file->getClientOriginalExtension());

                if (!in_array($extension, $allowedExtensions)) {
                    return redirect()->back()->with('error', 'Poster must be an image of type: ' . implode(', ', $allowedExtensions));
                }

                $fileName = time().'_'.$request->poster->getClientOriginalName();
                $path = $request->poster->storeAs('upload/poster', $fileName, 'public');
            }

            $layanan = Layanan::create([
                'id'           => $last_id,
                'kategori'     => $validated['kategori'],
                'sektor'       => $validated['sektor'],
                'nama_layanan' => $validated['nama_layanan'],
                'video'        => $videoId, // from earlier GDrive ID extraction
                'poster'       => $path ?? null,
            ]);


            // If you want to save persyaratan in another table
            foreach ($validated['persyaratan'] as $persyaratan) {
                $layanan = Persyaratan::create([
                    'id_layanan' => $last_id,
                    'syarat' => $persyaratan
                ]);
            }

            DB::commit();

            // ✅ Redirect to layanan.index on success
            return redirect()
                ->route('layanan.index')
                ->with('success', 'Layanan created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            // ✅ Redirect to layanan.index on error with message
            return redirect()
                ->route('layanan.index')
                ->with('error', 'Failed to create layanan: ' . $e->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $validator = Validator::make(
            ['id' => $id], // data to validate
            ['id' => ['required', 'integer', new SafeInput]] // rules
        );

        $layanan = Layanan::with('persyaratan')->findOrFail($id);
        $kategori = Layanan::select('kategori')->distinct()->get();
        $sektor = Layanan::select('sektor')->distinct()->get();

        return view('admin.layanan.detail', compact('layanan','kategori','sektor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $validator = Validator::make(
            ['id' => $id], // data to validate
            ['id' => ['required', 'integer', new SafeInput]] // rules
        );

        $layanan = Layanan::with('persyaratan')->findOrFail($id);

        $kategori = Layanan::select('kategori')->distinct()->get();
        $sektor = Layanan::select('sektor')->distinct()->get();
        return view('admin.layanan.create',compact('kategori','sektor','layanan','id')); // Assuming you have a view for listing services
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kategori' => ['required', 'string', 'max:255', new SafeInput],
            'sektor'   => ['required', 'string', 'max:255', new SafeInput],
            'nama_layanan'   => ['required', 'string', 'max:255', new SafeInput],
            'video'   => ['nullable', 'string', 'max:255', new SafeInput],
            'poster' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048', new SafeInput],
            'persyaratan'   => ['required', 'array', 'min:1'],
            'persyaratan.*' => ['required', 'string', 'max:255', new SafeInput],
        ]);

        $layanan = Layanan::with('persyaratan')->findOrFail($id);

        DB::beginTransaction();

        try {
            // Handle poster upload
            if ($request->hasFile('poster')) {
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $file = $request->file('poster');
                $extension = strtolower($file->getClientOriginalExtension());

                if (!in_array($extension, $allowedExtensions)) {
                    return redirect()->back()->with('error', 'Poster must be an image of type: ' . implode(', ', $allowedExtensions));
                }

                $fileName = time().'_'.$file->getClientOriginalName();
                $path = $request->poster->storeAs('upload/poster', $fileName, 'public');

                // Optionally delete old poster
                if ($layanan->poster && \Storage::disk('public')->exists($layanan->poster)) {
                    \Storage::disk('public')->delete($layanan->poster);
                }

                $layanan->poster = $path;
            }

            // Handle Google Drive video ID
            $videoUrl = $validated['video'];
            preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $videoUrl, $matches);
            $layanan->video = $matches[1] ?? null;

            // Update other fields
            $layanan->kategori     = $validated['kategori'];
            $layanan->sektor       = $validated['sektor'];
            $layanan->nama_layanan = $validated['nama_layanan'];
            $layanan->save();

            // Update persyaratan
            // Delete old ones first
            $layanan->persyaratan()->delete();

            // Insert new persyaratan
            foreach ($validated['persyaratan'] as $syarat) {
                $layanan->persyaratan()->create([
                    'syarat' => $syarat
                ]);
            }

            DB::commit();

            return redirect()
                ->route('layanan.index')
                ->with('success', 'Layanan updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('layanan.index')
                ->with('error', 'Failed to update layanan: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
