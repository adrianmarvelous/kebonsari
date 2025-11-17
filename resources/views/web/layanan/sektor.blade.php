@extends('index')

@section('content')
<style>
    a:hover .cardd {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
    .cardd {
        transition: transform 0.3s ease;
    }
/* ============================
   CUSTOM DATALIST (SUPPORT MOBILE)
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

<div class="container">
    <div class="row card shadow">
        <div class="p-3">
            {{-- <input type="text" id="searchBox" class="form-control" placeholder="Cari layanan..."> --}}
            
    {{-- SEARCH INPUT --}}
    <div class="position-relative mb-3">
        <input type="text" id="layananInput" class="form-control" placeholder="Cari layanan...">
        <div id="datalistOptions" class="custom-datalist"></div>
    </div>
            <ul id="suggestions" class="list-group position-absolute w-100" style="z-index:1000;"></ul>
            
            <p class="text-center" style="margin-top: 100px;font-size:3rem">Pilih Layanan {{ $sektor }}</p>

            @foreach ($layanan as $value)
                <a href="{{ route('web.layanan.detail',['id' => $value->id]) }}" style="text-decoration: none;color: black;">
                    {{-- <div class="card cardd shadow mb-3"> --}}
                    <div class="card card-secondary bg-secondary-gradient mb-3">
                        <div class="card-body bubble-shadow">
                        {{-- <div class="card-body"> --}}
                            <h5 class="card-title">{{ $value->nama_layanan }}</h5>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

{{-- ============================
     JAVASCRIPT AUTOCOMPLETE
   ============================ --}}
<script>
    const data = @json($semua_layanan);

const input = document.getElementById("layananInput");
const datalist = document.getElementById("datalistOptions");

input.addEventListener("input", function () {
    const value = this.value.toLowerCase();
    datalist.innerHTML = "";

    if (value === "") {
        datalist.style.display = "none";
        return;
    }

    // Filter berdasarkan nama_layanan
    const filtered = data.filter(item =>
        item.nama_layanan.toLowerCase().includes(value)
    );

    if (filtered.length === 0) {
        datalist.style.display = "none";
        return;
    }

    filtered.forEach(item => {
        const div = document.createElement("div");

        // Tampilkan NAMA layanan
        div.textContent = item.nama_layanan;

        // Simpan ID saat klik
        div.onclick = () => {
            input.value = item.nama_layanan;
            input.setAttribute("data-id", item.id); // <-- SIMPAN ID DI ATTRIBUTE
            datalist.style.display = "none";

            console.log("Selected ID:", item.id);
        };

        datalist.appendChild(div);
    });

    datalist.style.display = "block";
});

document.addEventListener("click", function (e) {
    if (!input.contains(e.target)) {
        datalist.style.display = "none";
    }
});

</script>
@endsection
