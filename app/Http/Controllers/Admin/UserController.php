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
        $users = User::with('role')->get();
        $roles = Roles::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Roles::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255', new SafeInput],
            'email'    => ['required', 'email', 'max:255', 'unique:users', new SafeInput],
            'password' => ['required', 'string', 'min:6', new SafeInput],
            'role_id'  => ['required', 'integer', 'exists:roles,id', new SafeInput],
        ]);

        DB::beginTransaction();
        try {
            User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => bcrypt($validated['password']),
                'role_id'  => $validated['role_id'],
                'email_verified_at' => now(),
            ]);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambah user: ' . $e->getMessage());
        }
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
        $user = User::findOrFail($id);
        $roles = Roles::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255', new SafeInput],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email,' . $id, new SafeInput],
            'password' => ['nullable', 'string', 'min:6', new SafeInput],
            'role_id'  => ['required', 'integer', 'exists:roles,id', new SafeInput],
        ]);

        DB::beginTransaction();
        try {
            $user->name    = $validated['name'];
            $user->email   = $validated['email'];
            $user->role_id = $validated['role_id'];
            if (!empty($validated['password'])) {
                $user->password = bcrypt($validated['password']);
            }
            $user->save();
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->delete();
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }

    public function updateRole(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id', new SafeInput],
            'role_id' => ['required', 'integer', 'exists:roles,id', new SafeInput],
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($validated['user_id']);
            $user->role_id = $validated['role_id'];
            $user->save();
            DB::commit();
            return redirect()->route('users.index')->with('success', 'Role berhasil diubah.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')->with('error', 'Gagal mengubah role: ' . $e->getMessage());
        }
    }
}
