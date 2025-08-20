<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;
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
        return view('admin.agenda.index');
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
            'narasi'   => ['required', 'string', 'max:10000', new SafeInput],
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agenda = Agenda::with('lampiran')->findOrFail($id);

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
