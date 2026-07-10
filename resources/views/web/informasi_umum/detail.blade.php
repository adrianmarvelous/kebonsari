@extends('index')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="mb-3">
            <a href="{{ route('web.informasi_umum') }}" class="btn btn-outline-primary btn-sm px-3" style="border-radius: 10px;">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>

        <div class="card-modern card mb-4">
            <div class="card-body p-4">
                <h2 class="fw-bold text-center mb-3" style="color: var(--primary-dark);">{{ $agenda->nama_agenda }}</h2>

                @if($agenda->created_at)
                    <p class="text-muted text-center mb-4">
                        <i class="fas fa-calendar-alt me-1"></i>{{ $agenda->created_at->format('d F Y') }}
                    </p>
                @endif

                @if($agenda->foto_cover)
                    <div class="text-center mb-4">
                        <img class="img-fluid rounded-3" src="{{ asset($agenda->foto_cover) }}" alt="{{ $agenda->nama_agenda }}" style="max-height: 400px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    </div>
                @endif

                <div class="content-text" style="font-size: 1.05rem; line-height: 1.8;">
                    {!! $agenda->narasi !!}
                </div>

                @if($agenda->lampiran && count($agenda->lampiran) > 0)
                    <hr class="my-4">
                    <h4 class="fw-bold mb-3"><i class="fas fa-paperclip text-primary me-2"></i>Lampiran</h4>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach($agenda->lampiran as $item)
                            @php
                                $filename = strtolower(basename($item->file));
                                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                            @endphp

                            @if($isImage)
                                <div class="text-center" style="flex: 0 0 auto;">
                                    <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
                                        <img src="{{ asset($item->file) }}" style="max-width: 200px; max-height: 200px; object-fit: cover;" alt="{{ $item->nama }}">
                                    </div>
                                    <p class="text-center small fw-semibold mt-1 mb-0">{{ $item->nama }}</p>
                                </div>
                            @elseif($ext === 'pdf')
                                <a href="{{ asset($item->file) }}" target="_blank" class="btn btn-success" style="border-radius: 12px;">
                                    <i class="fas fa-file-pdf me-2"></i>{{ $item->nama }}
                                </a>
                            @else
                                <a href="{{ asset($item->file) }}" target="_blank" class="btn btn-outline-secondary" style="border-radius: 12px;">
                                    <i class="fas fa-file me-2"></i>{{ $item->nama }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
