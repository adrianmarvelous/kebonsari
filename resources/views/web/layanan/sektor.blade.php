@extends('index')

@section('content')
<style>
    .custom-datalist {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        max-height: 220px;
        overflow-y: auto;
        display: none;
        z-index: 9999;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .custom-datalist div {
        padding: 12px 16px;
        cursor: pointer;
        transition: background 0.2s;
    }
    .custom-datalist div:hover {
        background: #f1f5f9;
    }
    .layanan-item {
        display: block;
        background: white;
        border-radius: 14px;
        padding: 18px 24px;
        margin-bottom: 12px;
        text-decoration: none;
        color: var(--dark);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .layanan-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        border-radius: 0 4px 4px 0;
    }
    .layanan-item:hover {
        transform: translateX(4px);
        box-shadow: 0 6px 20px rgba(26, 115, 232, 0.1);
        border-color: var(--primary);
        color: var(--dark);
        text-decoration: none;
    }
    .layanan-item h5 {
        font-weight: 600;
        margin: 0;
        font-size: 1.05rem;
    }
    .layanan-item i {
        color: var(--primary);
        margin-right: 12px;
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="mb-4">
            <a href="{{ route('web.layanan.index') }}" class="btn btn-outline-primary btn-sm px-3" style="border-radius: 10px;">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>

        {{-- SEARCH --}}
        <div class="position-relative mb-4" style="z-index: 10;">
            <input type="text" id="layananInput" class="form-control form-control-lg" placeholder="Cari layanan..." autocomplete="off" style="border-radius: 14px; padding-left: 48px;">
            <i class="fas fa-search" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--gray);"></i>
            <div id="datalistOptions" class="custom-datalist"></div>
        </div>

        <div class="text-center mb-4">
            <h2 class="fw-bold" style="color: var(--primary-dark);">Pilih Layanan {{ $sektor }}</h2>
            <p class="text-muted">Silakan pilih layanan yang Anda butuhkan</p>
        </div>

        @foreach ($layanan as $value)
            <a href="{{ route('web.layanan.detail',['id' => $value->id]) }}" class="layanan-item">
                <h5><i class="fas fa-file-alt"></i>{{ $value->nama_layanan }}</h5>
            </a>
        @endforeach
    </div>
</div>

<script>
    const data = @json($semua_layanan);
    const input = document.getElementById("layananInput");
    const datalist = document.getElementById("datalistOptions");

    input.addEventListener("input", function () {
        const value = this.value.toLowerCase();
        datalist.innerHTML = "";
        if (value === "") { datalist.style.display = "none"; return; }
        const filtered = data.filter(item => item.nama_layanan.toLowerCase().includes(value));
        if (filtered.length === 0) { datalist.style.display = "none"; return; }
        filtered.forEach(item => {
            const div = document.createElement("div");
            div.textContent = item.nama_layanan;
            div.onclick = () => {
                // Redirect ke halaman detail layanan
                let url = "{{ route('web.layanan.detail', ':id') }}";
                url = url.replace(':id', item.id);
                window.location.href = url;
            };
            datalist.appendChild(div);
        });
        datalist.style.display = "block";
    });
    document.addEventListener("click", function (e) {
        if (!input.contains(e.target)) datalist.style.display = "none";
    });
</script>
@endsection
