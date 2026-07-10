@extends('admin.dashboard')


@section('content')
    <div class="card-modern">
        <div class="card-header-custom">
            <h5><i class="fas fa-plus-circle text-primary me-2"></i>Buat Agenda Baru</h5>
        </div>
        <div class="card-body-custom">
            <form action="{{ route('agenda.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label-modern">Nama Agenda</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control-modern w-100" name="nama_agenda" placeholder="Masukkan nama agenda">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label-modern">Foto Cover</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="file" class="form-control-modern w-100" name="file" accept="image/*">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label-modern">Narasi</label>
                    </div>
                    <div class="col-lg-9">
                        <textarea id="summernote" name="narasi"></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-admin btn-admin-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
