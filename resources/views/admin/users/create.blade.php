@extends('admin.dashboard')

@section('content')
    <div class="card-modern">
        <div class="card-header-custom">
            <h5><i class="fas fa-user-plus text-primary me-2"></i>Tambah User Baru</h5>
        </div>
        <div class="card-body-custom">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label-modern">Nama</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" name="name" class="form-control-modern w-100" value="{{ old('name') }}" placeholder="Masukkan nama" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label-modern">Email</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="email" name="email" class="form-control-modern w-100" value="{{ old('email') }}" placeholder="Masukkan email" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label-modern">Password</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="password" name="password" class="form-control-modern w-100" placeholder="Minimal 6 karakter" required>
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label-modern">Role</label>
                    </div>
                    <div class="col-lg-9">
                        <select name="role_id" class="form-control-modern w-100" required>
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('users.index') }}" class="btn btn-admin" style="background:#e5e7eb;color:#333;">Batal</a>
                    <button type="submit" class="btn btn-admin btn-admin-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
