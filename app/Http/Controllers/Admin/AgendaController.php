<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\agenda;
use App\Models\agenda_lampiran;
use App\Rules\SafeInput;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendas = agenda::with('lampiran')->orderBy('created_at', 'desc')->get();
        return view('admin.agenda.index',compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_agenda' => ['required', 'string', 'max:255', new SafeInput],
            'file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048', new SafeInput], // max 2MB
            'narasi'   => ['required', 'string', 'max:50000'],
        ]);
        DB::beginTransaction();

        try {
            // ✅ Handle file upload
            $fileName = null;
            if ($request->hasFile('file')) {
                $mime = $request->file('file')->getMimeType();
                if (!str_starts_with($mime, 'image/')) {
                    return back()->with('error', 'File harus berupa gambar!');
                }

                $fileName = time() . '.' . $request->file('file')->extension();
                $request->file('file')->move(public_path('uploads/agenda/cover'), $fileName);
                $filePath = 'uploads/agenda/cover/' . $fileName;
            }


            // ✅ Insert to DB
            $agenda = Agenda::create([
                'nama_agenda' => $validated['nama_agenda'],
                'narasi'      => $validated['narasi'],
                'foto_cover'  => $filePath,
            ]);

            DB::commit(); // ✅ Commit transaction
            // ✅ Redirect ke show dengan ID agenda
            return redirect()
                ->route('agenda.show', $agenda->id)
                ->with('success', 'Agenda berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack(); // ❌ Rollback if error

            // (Optional) Delete uploaded file if DB fails
            if (isset($fileName) && file_exists(public_path('uploads/agenda/' . $fileName))) {
                unlink(public_path('uploads/agenda/' . $fileName));
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function upload_lampiran(Request $request)
    {
        
        // ✅ Validation
        $request->validate([
            'agenda_id' => 'required|numeric',
            'nama' => 'required|string|max:255',
            'lampiran' => 'required|mimes:jpg,jpeg,png,gif,webp,pdf|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $filename = null;
            if ($request->hasFile('lampiran')) {
                $file = $request->file('lampiran');
                $filename = time() . '_' . $file->getClientOriginalName();

                // folder tujuan
                $destinationPath = 'uploads/agenda/lampiran';
                $file->move(public_path($destinationPath), $filename);

                // simpan path relatif ke public
                $filepath = $destinationPath . '/' . $filename;
            }

            // ✅ Save to Database
            $lampiran = new Agenda_lampiran();
            $lampiran->id_agenda = $request->agenda_id;
            $lampiran->nama = $request->nama;
            $lampiran->file = $filepath ?? null; // simpan path, bukan cuma nama
            $lampiran->save();

            DB::commit(); // ✅ kalau semua sukses
            return redirect()->back()->with('success', 'Lampiran berhasil diupload!');
        } catch (\Exception $e) {
            DB::rollBack(); // ❌ kalau ada error, rollback

            // Kalau sempat upload file, hapus biar nggak nyangkut di folder
            if (!empty($filename) && file_exists(public_path('uploads/agenda/lampiran/' . $filename))) {
                unlink(public_path('uploads/agenda/lampiran/' . $filename));
            }

            Log::error('Upload Lampiran Error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Gagal upload lampiran. Silakan coba lagi.');
        }
    }
    public function update_lampiran(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'id_lampiran' => 'required|numeric',
            'nama' => 'required|string|max:255',
            'lampiran' => 'nullable|mimes:jpg,jpeg,png,gif,webp,pdf|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $lampiran = agenda_lampiran::findOrFail($request->id_lampiran);
            $lampiran->nama = $request->nama;

            if ($request->hasFile('lampiran')) {
                // Hapus file lama jika ada
                if ($lampiran->file && file_exists(public_path($lampiran->file))) {
                    unlink(public_path($lampiran->file));
                }

                $file = $request->file('lampiran');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = 'uploads/agenda/lampiran';
                $file->move(public_path($destinationPath), $filename);
                $lampiran->file = $destinationPath . '/' . $filename;
            }

            $lampiran->save();

            DB::commit(); // ✅ Commit transaction
            return redirect()->back()->with('success', 'Lampiran berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack(); // ❌ Rollback if error

            return redirect()->back()->with('error', 'Gagal memperbarui lampiran: ' . $e->getMessage());
        }
    }
    public function hapus_lampiran($id_lampiran)
    {
        DB::beginTransaction();
        try {
            $lampiran = Agenda_lampiran::findOrFail($id_lampiran);
            $filePath = public_path($lampiran->file);

            // Hapus file dari storage
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Hapus record dari database
            $lampiran->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Lampiran berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus lampiran: ' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agenda = agenda::with('lampiran')->findOrFail($id);

        return view('admin.agenda.show',compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
