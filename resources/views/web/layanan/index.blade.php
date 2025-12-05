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
                    <a class="btn btn-primary" href="{{ route($item['route'],$item['params']) }}">
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
         PELACAKAN
       ======================== --}}
    <div class="mt-4">
        <h1 class="text-center">Pelacakan</h1>
        <a class="btn btn-primary w-100" href="">PELACAKAN LAYANAN</a>
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

    input.addEventListener("input", function () {

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
    document.addEventListener("click", function (e) {
        if (!input.contains(e.target)) {
            datalist.style.display = "none";
        }
    });
</script>

@endsection
