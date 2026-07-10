@extends('admin.dashboard')


@section('content')

    <div class="card-modern">
        <div class="card-header-custom d-flex justify-content-between align-items-center flex-wrap">
            <h5><i class="fas fa-users text-primary me-2"></i>Manajemen User</h5>
            <a href="{{ route('users.create') }}" class="btn btn-admin btn-admin-primary">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>
        <div class="card-body-custom">
            <div class="table-responsive">
                <table class="table table-admin table-datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td class="fw-semibold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form action="{{ route('users.update_role', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <select name="role_id" class="form-control-modern" id="role_select_{{ $key }}" 
                                                onchange="if(confirm('Yakin ubah role?')) this.form.submit();">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" 
                                                    {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-admin btn-admin-warning btn-admin-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-admin btn-admin-danger btn-admin-sm" onclick="return confirm('Yakin hapus user {{ $user->name }}?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection


