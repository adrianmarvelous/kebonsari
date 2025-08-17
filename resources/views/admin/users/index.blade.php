@extends('admin.dashboard')


@section('content')

    <div class="container-fluid card shadow">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-4">Users</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <form action="{{ route('users.update_role', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <select name="role_id" class="form-select" id="role_select_{{ $key }}" 
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection


