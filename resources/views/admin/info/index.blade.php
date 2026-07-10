@extends('admin.dashboard')


@section('content')

    <div class="card-modern">
        <div class="card-header-custom">
            <h5><i class="fas fa-info-circle text-primary me-2"></i>Info Halaman</h5>
        </div>
        <div class="card-body-custom">
            <form action="{{ route('info.update',['info' => 1]) }}" method="POST">
                @csrf
                @method('PUT') 
                <div class="mb-3">
                    <label class="form-label-modern">Konten Info</label>
                    <textarea id="summernote" name="info">{{ old('info', $info->info ?? '') }}</textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-admin btn-admin-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


