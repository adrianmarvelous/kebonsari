@extends('index')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="text-center mb-5">
            <div class="d-inline-flex align-items-center justify-content-center" style="width: 72px; height: 72px; border-radius: 18px; background: var(--primary-light); font-size: 2rem; color: var(--primary); margin-bottom: 16px;">
                <i class="fas fa-info-circle"></i>
            </div>
            <h2 class="fw-bold" style="color: var(--primary-dark);">Informasi Umum</h2>
            <p class="text-muted">Berita dan agenda terbaru Kelurahan Kebonsari</p>
        </div>

        <div class="row g-4">
            @foreach ($agendas as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card-modern card h-100">
                        <img src="{{ asset($item->foto_cover) }}" class="card-img-top" alt="{{ $item->nama_agenda }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-bold mb-2">{{ $item->nama_agenda }}</h5>
                            <p class="text-muted small mb-3">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $item->created_at ? $item->created_at->format('d F Y') : '' }}
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('web.informasi_umum.detail',['id' => $item->id]) }}" class="btn btn-primary w-100" style="border-radius: 12px; font-weight: 600;">
                                    <i class="fas fa-arrow-right me-1"></i>Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(count($agendas) == 0)
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada informasi umum saat ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection
