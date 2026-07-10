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
    #reader video {
        width: 100% !important;
        height: auto !important;
    }
    .populer-card {
        background: white;
        border-radius: 16px;
        padding: 20px 16px;
        text-align: center;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--dark);
        display: block;
        min-width: 110px;
    }
    .populer-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(26, 115, 232, 0.1);
        color: var(--primary);
        text-decoration: none;
    }
    .populer-card .icon-wrap {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-size: 1.4rem;
        color: white;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    }
    .sector-btn {
        display: block;
        width: 100%;
        padding: 16px 24px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 1rem;
        text-align: left;
        background: white;
        color: var(--dark);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
        text-decoration: none;
        margin-bottom: 12px;
    }
    .sector-btn:hover {
        background: var(--primary-light);
        color: var(--primary);
        border-color: var(--primary);
        transform: translateX(4px);
        text-decoration: none;
    }
    .sector-btn i {
        margin-right: 12px;
        color: var(--primary);
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-10">

        {{-- SEARCH --}}
        <div class="card-modern card mb-4" style="position: relative; z-index: 10;">
            <div class="card-body">
                <h4 class="fw-bold mb-1"><i class="fas fa-search text-primary me-2"></i>Cari Layanan</h4>
                <p class="text-muted mb-3">Ketik nama layanan yang Anda cari</p>
                <form id="formLayanan" action="{{ route('web.layanan.search') }}" method="GET">
                    <div class="position-relative">
                        <input type="text" id="layananInput" name="layanan" class="form-control form-control-lg" placeholder="Cari layanan..." style="border-radius: 14px; padding-left: 48px;">
                        <i class="fas fa-search" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--gray);"></i>
                        <div id="datalistOptions" class="custom-datalist"></div>
                    </div>
                </form>
            </div>
        </div>

        {{-- PELAYANAN TERPOPULER --}}
        <div class="card-modern card mb-4">
            <div class="card-body">
                <h4 class="fw-bold mb-1"><i class="fas fa-star text-warning me-2"></i>Pelayanan Terpopuler</h4>
                <p class="text-muted mb-4">Layanan yang paling sering diakses</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    @foreach ($layanan_populer as $item)
                        <a class="populer-card" href="{{ route($item['route'], $item['params']) }}">
                            <div class="icon-wrap">
                                <i class="{{ $item['icon'] }}"></i>
                            </div>
                            <p class="fw-semibold mb-0" style="font-size: 0.85rem;">{{ $item['judul'] }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- PELACAKAN --}}
        <div class="card-modern card mb-4">
            <div class="card-body">
                <h4 class="fw-bold mb-1"><i class="fas fa-qrcode text-success me-2"></i>Pelacakan Layanan</h4>
                <p class="text-muted mb-3">Scan QR code untuk melacak status layanan Anda</p>
                <button class="btn btn-success w-100 py-3" id="scanBtn" style="border-radius: 14px; font-weight: 600;">
                    <i class="fas fa-camera me-2"></i>PELACAKAN LAYANAN
                </button>
                <div id="uploadArea" style="display:none; text-align:center; margin-top:16px;">
                    <input type="file" id="qrImage" accept="image/*" style="display:none;">
                    <button class="btn btn-outline-secondary px-4" id="btnImage" style="border-radius: 12px;">
                        <i class="fas fa-upload me-2"></i>Upload Gambar QR
                    </button>
                    <p class="mt-3">Result: <span id="result" class="fw-semibold"></span></p>
                </div>
            </div>
        </div>

        {{-- SEKTOR --}}
        <div class="card-modern card mb-4">
            <div class="card-body">
                <h4 class="fw-bold mb-1"><i class="fas fa-tags text-primary me-2"></i>Pilih Sektor Pelayanan</h4>
                <p class="text-muted mb-3">Pilih kategori layanan yang Anda butuhkan</p>
                @foreach ($sektor as $value)
                    <a href="{{ route('web.layanan.sektor', ['sektor' => $value->kategori]) }}" class="sector-btn">
                        <i class="fas fa-folder-open"></i>{{ $value->kategori }}
                    </a>
                @endforeach
            </div>
        </div>

    </div>
</div>

<script>
    const data = @json($semua_layanan);
    const input = document.getElementById("layananInput");
    const datalist = document.getElementById("datalistOptions");
    const form = document.getElementById("formLayanan");

    input.addEventListener("input", function() {
        const value = this.value.toLowerCase();
        datalist.innerHTML = "";
        if (value === "") { datalist.style.display = "none"; return; }
        const filtered = data.filter(item => item.nama_layanan.toLowerCase().includes(value));
        if (filtered.length === 0) { datalist.style.display = "none"; return; }
        filtered.forEach(item => {
            const div = document.createElement("div");
            div.textContent = item.nama_layanan;
            div.onclick = () => { input.value = item.nama_layanan; datalist.style.display = "none"; form.submit(); };
            datalist.appendChild(div);
        });
        datalist.style.display = "block";
    });
    document.addEventListener("click", function(e) {
        if (!input.contains(e.target)) datalist.style.display = "none";
    });
</script>
<script src="https://unpkg.com/html5-qrcode"></script>
<script type="module">
import * as pdfjsLib from "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.1.392/pdf.min.mjs";

const scanBtn   = document.getElementById("scanBtn");
const uploadArea = document.getElementById("uploadArea");
const qrImage = document.getElementById("qrImage");
const btnImage = document.getElementById("btnImage");
const resultBox = document.getElementById("result");
let html5QrCode = new Html5Qrcode("hiddenReaderDiv");

scanBtn.addEventListener("click", () => {
    uploadArea.style.display = uploadArea.style.display === "none" ? "block" : "none";
});

btnImage.onclick = () => qrImage.click();

qrImage.addEventListener("change", async function () {
    if (this.files.length === 0) return;
    const file = this.files[0];

    try {
        const result = await html5QrCode.scanFile(file, true);
        resultBox.innerText = result;

        // === AUTO BUKA TAB JIKA URL ===
        if (result.startsWith("http")) {
            window.open(result, "_blank");
        }

    } catch (err) {
        alert("QR tidak terbaca dari gambar!");
    }
});


// ===========================
// UPLOAD PDF (SCALE 4X)
// ===========================
btnPdf.onclick = () => qrPdf.click();

qrPdf.addEventListener("change", async function () {
    if (this.files.length === 0) return;

    const file = this.files[0];

    try {
        // Load PDF
        const pdf = await pdfjsLib.getDocument(URL.createObjectURL(file)).promise;

        // Ambil halaman 1
        const page = await pdf.getPage(1);

        // Perbesar kualitas render agar QR terbaca
        const viewport = page.getViewport({ scale: 4 });

        const canvas = document.createElement("canvas");
        const ctx = canvas.getContext("2d");

        canvas.width  = viewport.width;
        canvas.height = viewport.height;

        // Render PDF → Canvas
        await page.render({
            canvasContext: ctx,
            viewport
        }).promise;

        // Convert canvas → image blob
        canvas.toBlob(async (blob) => {
            try {
                const result = await html5QrCode.scanFile(blob, true);
                resultBox.innerText = result;

                // === AUTO BUKA TAB JIKA URL ===
                if (result.startsWith("http")) {
                    window.open(result, "_blank");
                }

            } catch (err) {
                alert("QR tidak terbaca di PDF!");
            }
        });

    } catch (err) {
        alert("File PDF rusak atau tidak bisa dibaca!");
    }
});
</script>

<!-- html5-qrcode membutuhkan div meskipun tidak tampil -->
<div id="hiddenReaderDiv" style="display:none;"></div>

@endsection
