@extends('admin.dashboard')


@section('content')

    <div class="card-modern">
        <div class="card-header-custom d-flex justify-content-between align-items-center flex-wrap">
            <h5><i class="fas fa-info-circle text-primary me-2"></i>Detail Layanan</h5>
            <div class="d-flex gap-1">
                <a href="{{ route('layanan.edit',['layanan' => $layanan->id]) }}" class="btn btn-admin btn-admin-warning btn-admin-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('layanan.destroy', $layanan->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-admin btn-admin-danger btn-admin-sm" onclick="return confirm('Yakin hapus layanan {{ $layanan->nama_layanan }}?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body-custom">
            <div class="row mb-3">
                <div class="col-lg-2">
                    <p class="form-label-modern">Kategori</p>
                </div>
                <div class="col-lg-10">
                    <p class="fw-semibold">{{ $layanan->kategori }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-2">
                    <p class="form-label-modern">Sektor</p>
                </div>
                <div class="col-lg-10">
                    <p class="fw-semibold">{{ $layanan->sektor }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-2">
                    <p class="form-label-modern">Nama Layanan</p>
                </div>
                <div class="col-lg-10">
                    <p class="fw-semibold">{{ $layanan->nama_layanan }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-2">
                    <p class="form-label-modern">Video</p>
                </div>
                <div class="col-lg-10">
                    @if(!empty($layanan->video))
                        <iframe src="https://drive.google.com/file/d/<?= htmlentities($layanan['video']) ?>/preview" width="100%" height="480" allow="autoplay" allowfullscreen style="border-radius: 12px;">
                        </iframe>
                    @else
                        <p class="text-muted">Tidak ada video.</p>
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-2">
                    <p class="form-label-modern">Poster</p>
                </div>
                <div class="col-lg-10">
                    @if(!empty($layanan->poster))
                        <img src="{{ $layanan->poster ? asset('storage/' . $layanan->poster) : 'https://via.placeholder.com/150' }}" alt="Poster" class="img-fluid rounded" style="max-width: 500px;">
                    @else
                        <p class="text-muted">Tidak ada poster.</p>
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-2">
                    <p class="form-label-modern">Persyaratan</p>
                </div>
                <div class="col-lg-10">
                    @if($layanan->persyaratan->isEmpty())
                        <p class="text-muted">Tidak ada persyaratan.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($layanan->persyaratan as $persyaratan)
                                <li class="list-group-item px-0"><i class="fas fa-check-circle text-success me-2"></i>{{ $persyaratan->syarat }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection


