@extends('admin.dashboard')


@section('content')
    <div class="container-fluid card shadow">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <h1 class="mt-4">Buat Agenda Baru</h1>
                </div>
            </div>
        </div>
        <div>
            <form action="{{ route('agenda.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="" class="fw-bold">Nama Agenda</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="nama_agenda">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="" class="fw-bold">Foto Cover</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="file" class="form-control" name="file" accept="image/*">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="" class="fw-bold">Narasi</label>
                    </div>
                    <div class="col-lg-9">
                        <textarea id="summernote" name="narasi"></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>

    </div>
@endsection
