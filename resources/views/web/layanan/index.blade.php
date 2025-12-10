@extends('index')

@section('content')
    <style>
        /* ============================
               CUSTOM DATALIST (MOBILE)
               ============================ */
        .custom-datalist {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            border-radius: 6px;
            max-height: 220px;
            overflow-y: auto;
            display: none;
            z-index: 9999;
        }

        .custom-datalist div {
            padding: 10px 12px;
            cursor: pointer;
        }

        .custom-datalist div:hover {
            background: #eee;
        }
    </style>
    <style>
        #reader video {
            width: 100% !important;
            height: auto !important;
        }
    </style>

    <div class="p-3 card shadow m-3">

        {{-- ========================
         FORM SEARCH
       ======================== --}}
        <form id="formLayanan" action="{{ route('web.layanan.search') }}" method="GET">
            <div class="position-relative mb-3">
                <input type="text" id="layananInput" name="layanan" class="form-control" placeholder="Cari layanan...">
                <div id="datalistOptions" class="custom-datalist"></div>
            </div>
        </form>

        {{-- ========================
         PELAYANAN TERPOPULER
       ======================== --}}
        <div>
            <h1 class="text-center">Pelayanan Terpopuler</h1>
            <div class="d-flex justify-content-center flex-wrap">
                @foreach ($layanan_populer as $item)
                    <div class="text-center m-1">
                        <a class="btn btn-primary" href="{{ route($item['route'], $item['params']) }}">
                            <i class="{{ $item['icon'] }} fa-3x"></i>
                        </a>
                        <div style="width: 100px">
                            <p class="text-wrap small fs-md-6 fs-lg-5">{{ $item['judul'] }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        {{-- ========================
    PELACAKAN TANPA KAMERA
======================== --}}
        <div class="mt-4">
            <h1 class="text-center">Pelacakan</h1>

            <button class="btn btn-primary w-100" id="scanBtn">PELACAKAN LAYANAN</button>

            <div id="uploadArea" style="display:none; text-align:center; margin-top:15px;">
                <input type="file" id="qrImage" accept="image/*" style="display:none;">
                <input type="file" id="qrPdf" accept="application/pdf" style="display:none;">

                <button class="btn btn-secondary btn-sm m-1" id="btnImage">Upload Gambar QR</button>
                {{-- <button class="btn btn-info btn-sm m-1" id="btnPdf">Upload PDF QR</button> --}}
            </div>

            <p class="mt-2">Result: <span id="result"></span></p>
        </div>


        {{-- ========================
         SEKTOR
       ======================== --}}
        <div class="mt-4">
            <h1 class="text-center">Pilih Sektor Pelayanan</h1>

            <div class="d-flex flex-column mt-3">
                @foreach ($sektor as $value)
                    <a href="{{ route('web.layanan.sektor', ['sektor' => $value->kategori]) }}"
                        class="btn btn-primary mb-2">
                        {{ $value->kategori }}
                    </a>
                @endforeach
            </div>
        </div>

    </div>

    {{-- ============================
     JAVASCRIPT AUTOCOMPLETE
   ============================ --}}
    <script>
        // Data layanan dari backend
        const data = @json($semua_layanan);

        const input = document.getElementById("layananInput");
        const datalist = document.getElementById("datalistOptions");
        const form = document.getElementById("formLayanan");

        input.addEventListener("input", function() {

            const value = this.value.toLowerCase();
            datalist.innerHTML = "";

            if (value === "") {
                datalist.style.display = "none";
                return;
            }

            // FILTER: hanya berdasarkan 'nama_layanan' layanan
            const filtered = data.filter(item =>
                item.nama_layanan.toLowerCase().includes(value)
            );

            if (filtered.length === 0) {
                datalist.style.display = "none";
                return;
            }

            filtered.forEach(item => {
                const div = document.createElement("div");
                div.textContent = item.nama_layanan;

                // Jika dipilih → isi input → submit form
                div.onclick = () => {
                    input.value = item.nama_layanan;
                    datalist.style.display = "none";
                    form.submit();
                };

                datalist.appendChild(div);
            });

            datalist.style.display = "block";
        });

        // Klik luar → hide dropdown
        document.addEventListener("click", function(e) {
            if (!input.contains(e.target)) {
                datalist.style.display = "none";
            }
        });
    </script>
    <script src="https://unpkg.com/html5-qrcode"></script>
<script type="module">
import * as pdfjsLib from "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.1.392/pdf.min.mjs";

// DOM Elements
const scanBtn   = document.getElementById("scanBtn");
const uploadArea = document.getElementById("uploadArea");

const qrImage = document.getElementById("qrImage");
const qrPdf   = document.getElementById("qrPdf");

const btnImage = document.getElementById("btnImage");
const btnPdf   = document.getElementById("btnPdf");

const resultBox = document.getElementById("result");

// Instance html5-qrcode (wajib punya div)
let html5QrCode = new Html5Qrcode("hiddenReaderDiv");


// ===========================
// TOGGLE TOMBOL UPLOAD
// ===========================
scanBtn.addEventListener("click", () => {
    uploadArea.style.display =
        uploadArea.style.display === "none" ? "block" : "none";
});


// ===========================
// UPLOAD GAMBAR
// ===========================
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
