<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Info;
use App\Rules\SafeInput;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = Info::find(1);

        return view('admin.info.index',compact('info'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
        // Validasi ID
        $validator = Validator::make(
            ['id' => $id],
            ['id' => ['required', 'integer', new SafeInput]]
        )->validate(); // ✅ ini langsung return array hasil validasi

        // Validasi request body
        $validated = $request->validate([
            'info' => ['required', 'string', 'max:1000', new SafeInput],
        ]);
        $updated_at = date('Y-m-d H:i:s');

        DB::beginTransaction();
        try {
            // Cari data
            $info = Info::findOrFail($validator['id']);

            // Update data
            $info->update([
                'info' => $validated['info'],
                'updated_at' => $updated_at,
            ]);

            // ✅ Commit kalau sukses
            DB::commit();

            return redirect()
                ->route('info.index')
                ->with('success', 'Info updated successfully!');
        } catch (\Exception $e) {
            // ❌ Rollback kalau error
            DB::rollBack();

            return redirect()
                ->route('info.index')
                ->with('error', 'Failed to update info: ' . $e->getMessage());
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
