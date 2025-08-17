@extends('admin.dashboard')


@section('content')

    <div class="container-fluid card shadow">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-4">Detail Layanan</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <p class="fw-bold">Kategori</p>
            </div>
            <div class="col-lg-10">
                <p>{{ $layanan->kategori }}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-2">
                <p class="fw-bold">Sektor</p>
            </div>
            <div class="col-lg-10">
                <p>{{ $layanan->seoktor }}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-2">
                <p class="fw-bold">Nama Layanan</p>
            </div>
            <div class="col-lg-10">
                <p>{{ $layanan->nama_layanan }}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-2">
                <p class="fw-bold">Video</p>
            </div>
            <div class="col-lg-10">
                @if(!empty($layanan->video))
                    <iframe src="https://drive.google.com/file/d/<?= htmlentities($layanan['video']) ?>/preview"  width="auto" height="480" allow="autoplay" allowfullscreen>
                    </iframe>
                @endif
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-2">
                <p class="fw-bold">Poster</p>
            </div>
            <div class="col-lg-10">
                @if(!empty($layanan->poster))
                    <img src="" alt="">
                @endif
            </div>
        </div>
        <div class="d-flex justify-content-end m-3 p-3">
            <a href="{{ route('layanan.edit',['layanan' => $layanan->id]) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="bx bx-edit"></i></a>
        </div>
    </div>

@endsection


