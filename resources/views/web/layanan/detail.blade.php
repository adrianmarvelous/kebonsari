@extends('index')
@section('content')
    <style>
        .video-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .video-col {
            flex: 1 1 100%;
        }
        @media (min-width: 768px) {
            .video-col {
                flex: 1 1 45%;
            }
        }
        .syarat-item {
            padding: 12px 16px;
            border-left: 3px solid var(--primary);
            background: #f8fafc;
            border-radius: 0 10px 10px 0;
            margin-bottom: 8px;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="mb-3">
                <a href="javascript:history.back()" class="btn btn-outline-primary btn-sm px-3" style="border-radius: 10px;">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>

            <div class="card-modern card mb-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center" style="width: 72px; height: 72px; border-radius: 18px; background: var(--primary-light); font-size: 2rem; color: var(--primary); margin-bottom: 16px;">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <h2 class="fw-bold" style="color: var(--primary-dark);">{{ $layanan['nama_layanan'] }}</h2>
                        <span class="badge" style="background: var(--primary-light); color: var(--primary); font-weight: 500; padding: 6px 16px; border-radius: 50px;">
                            <i class="fas fa-tag me-1"></i>{{ $layanan->kategori }}
                        </span>
                    </div>

                    {{-- PERSYARATAN --}}
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3"><i class="fas fa-list-check text-primary me-2"></i>Persyaratan</h4>
                        @if(count($layanan->persyaratan) > 0)
                            @foreach ($layanan->persyaratan as $value)
                                <div class="syarat-item">
                                    <span>{{ $value['syarat'] }}</span>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">Tidak ada persyaratan khusus.</p>
                        @endif
                    </div>

                    {{-- FLYER --}}
                    @if ($layanan->flyer)
                        @php
                            if($layanan->kategori == 'SSW ALFA'){
                                $flyerPath = asset('upload/FLYER/SSWALFA/' . $layanan->flyer->file);
                            } else {
                                $flyerPath = asset('upload/FLYER/KNG/' . $layanan->flyer->file);
                            }
                        @endphp
                        <div class="mb-4">
                            <h4 class="fw-bold mb-3"><i class="fas fa-image text-primary me-2"></i>Flyer Informasi</h4>
                            <div class="text-center">
                                <img src="{{ $flyerPath }}" alt="Flyer {{ $layanan->nama_layanan }}" class="img-fluid rounded-3" style="max-height: 500px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                            </div>
                        </div>
                    @endif

                    {{-- VIDEO TUTORIAL --}}
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3"><i class="fas fa-video text-primary me-2"></i>Tutorial</h4>
                        <div class="video-row">
                            @if ($layanan->kategori == 'SSW ALFA')
                                <div class="video-col" style="flex: 1 1 100%;">
                                    <h5 class="fw-semibold mb-2">Tutorial {{ $layanan->kategori }}</h5>
                                    <div style="border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb;">
                                        <iframe src="https://drive.google.com/file/d/1pXcm3Idrq8TPbMgy-KgWo1gV_LXbOQux/preview" 
                                            style="width: 100%; height: 500px; border: none;" 
                                            allow="autoplay">
                                        </iframe>
                                    </div>
                                    <p class="text-muted small mt-2">
                                        <i class="fas fa-info-circle me-1"></i>Jika PDF tidak tampil,
                                        <a href="https://drive.google.com/file/d/1pXcm3Idrq8TPbMgy-KgWo1gV_LXbOQux/view" target="_blank" class="text-primary">buka di Google Drive</a>
                                    </p>
                                </div>
                            @else
                                <div class="video-col">
                                    <h5 class="fw-semibold mb-2">Tutorial Pembuatan Akun Pemula</h5>
                                    <div style="border-radius: 12px; overflow: hidden; background: #000;">
                                        <video controls style="width: 100%; display: block;" preload="metadata">
                                            <source src="{{ route('video.proxy', ['fileId' => '1Ffg9k7672cdwgKYkGEo4UryZBO_YYBXF']) }}" type="video/mp4">
                                            Browser tidak mendukung pemutar video.
                                        </video>
                                    </div>
                                    <p class="text-muted small mt-2">
                                        <i class="fas fa-info-circle me-1"></i>Jika video tidak muncul,
                                        <a href="{{ route('video.proxy', ['fileId' => '1Ffg9k7672cdwgKYkGEo4UryZBO_YYBXF']) }}" target="_blank" class="text-primary">buka di tab baru</a>
                                        atau <a href="https://drive.google.com/uc?export=download&confirm=t&id=1Ffg9k7672cdwgKYkGEo4UryZBO_YYBXF" target="_blank" class="text-primary">download</a>
                                    </p>
                                </div>
                            @endif
                            @if(isset($layanan['video']) && $layanan['video'] != '')
                                <div class="video-col">
                                    <h5 class="fw-semibold mb-2">Tutorial Teknis Pengajuan</h5>
                                    <div style="border-radius: 12px; overflow: hidden; background: #000;">
                                        <video controls style="width: 100%; display: block;" preload="metadata">
                                            <source src="{{ route('video.proxy', ['fileId' => $layanan['video']]) }}" type="video/mp4">
                                            Browser tidak mendukung pemutar video.
                                        </video>
                                    </div>
                                    <p class="text-muted small mt-2">
                                        <i class="fas fa-info-circle me-1"></i>Jika video tidak muncul,
                                        <a href="{{ route('video.proxy', ['fileId' => $layanan['video']]) }}" target="_blank" class="text-primary">buka di tab baru</a>
                                        atau <a href="https://drive.google.com/uc?export=download&confirm=t&id={{ $layanan['video'] }}" target="_blank" class="text-primary">download</a>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- TOMBOL AKSES --}}
                    <div class="text-center mt-4">
                        <a class="btn btn-primary btn-lg px-5 py-3" href="{{ route('web.layanan.klik_app', ['id' => $layanan->id]) }}" target="_blank" style="border-radius: 14px; font-weight: 600;">
                            <i class="fas fa-external-link-alt me-2"></i>Akses {{ $layanan->kategori }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
