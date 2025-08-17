<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Rules\SafeInput;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->get(); // Returns a collection of all users
        $roles = Roles::all();
        // dd($users);
        return view('admin.users.index',compact('users','roles')); // Assuming you have a view for listing services
    }
    public function updateRole(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', new SafeInput],
            'role_id' => ['required', new SafeInput],
        ]);
        $user_id = $validated['user_id'];
        $role_id = $validated['role_id'];

        DB::beginTransaction();
        
        try {
            $user = User::findOrFail($user_id);
            $user->role_id = $role_id;
            $user->save();

            DB::commit(); // commit transaction

            return redirect()
                ->route('users.index')
                ->with('success', 'Role updated successfully');
        } catch (\Exception $e) {
            DB::rollBack(); // rollback transaction

            return redirect()
                ->route('users.index')
                ->with('error', 'Failed to update role: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
