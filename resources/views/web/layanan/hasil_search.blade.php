@extends('index')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-4">
                <a href="javascript:history.back()" class="btn btn-outline-primary btn-sm px-3" style="border-radius: 10px;">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>

            <div class="card-modern card mb-4">
                <div class="card-body">
                    <h3 class="fw-bold mb-1"><i class="fas fa-search text-primary me-2"></i>Hasil Pencarian</h3>
                    <p class="text-muted mb-3">Ditemukan {{ count($layanans) }} layanan</p>

                    @forelse ($layanans as $item)
                        <a href="{{ route('web.layanan.detail',['id' => $item->id]) }}" class="layanan-item" style="display: block; background: white; border-radius: 14px; padding: 18px 24px; margin-bottom: 12px; text-decoration: none; color: var(--dark); border: 1px solid #e5e7eb; transition: all 0.3s ease; position: relative; overflow: hidden;">
                            <h5 class="fw-semibold mb-0"><i class="fas fa-file-alt text-primary me-2"></i>{{ $item->nama_layanan }}</h5>
                        </a>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Tidak ada layanan ditemukan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
