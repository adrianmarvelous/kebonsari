@extends('admin.dashboard')

@section('content')
    <div class="card-modern">
        <div class="card-header-custom">
            <h5><i class="fas fa-edit text-primary me-2"></i>Edit Agenda</h5>
        </div>
        <div class="card-body-custom">
            <form action="{{ route('agenda.update', $agenda->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label-modern">Nama Agenda</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control-modern w-100" name="nama_agenda" value="{{ old('nama_agenda', $agenda->nama_agenda) }}" placeholder="Masukkan nama agenda">
                        @error('nama_agenda') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label-modern">Foto Cover</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="file" class="form-control-modern w-100" name="file" accept="image/*">
                        @if($agenda->foto_cover)
                            <div class="mt-2">
                                <img src="{{ asset($agenda->foto_cover) }}" alt="Current cover" class="rounded" style="max-height:100px;">
                                <small class="text-muted d-block">Kosongkan jika tidak ingin mengganti foto</small>
                            </div>
                        @endif
                        @error('file') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label-modern">Narasi</label>
                    </div>
                    <div class="col-lg-9">
                        <textarea id="summernote" name="narasi">{{ old('narasi', $agenda->narasi) }}</textarea>
                        @error('narasi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('agenda.show', $agenda->id) }}" class="btn btn-admin" style="background:#e5e7eb;color:#333;">Batal</a>
                    <button type="submit" class="btn btn-admin btn-admin-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
