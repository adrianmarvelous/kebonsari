@extends('admin.dashboard')


@section('content')

    <div class="container-fluid card shadow">
        <form action="{{ route('layanan.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-4">Detail Layanan</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <p class="fw-bold">Kategori</p>
                </div>
                <div class="col-lg-10">
                    <select name="kategori" class="form-select" id="kategori">
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach ($kategori as $item_kategori)
                            <option value="{{ $item_kategori->kategori }}" 
                                {{ isset($layanan) && $layanan->kategori == $item_kategori->kategori ? 'selected' : '' }}>
                                {{ $item_kategori->kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-2">
                    <p class="fw-bold">Sektor</p>
                </div>
                <div class="col-lg-10">
                    <select name="kategori" class="form-select" id="sektor">
                        <option value="" disabled selected>-- Pilih Sektor --</option>
                        @foreach ($sektor as $item_sektor)
                            <option value="{{ $item_sektor->sektor }}" 
                                {{ isset($layanan) && $layanan->sektor == $item_kategori->sektor ? 'selected' : '' }}>
                                {{ $item_sektor->sektor }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-2">
                    <p class="fw-bold">Nama Layanan</p>
                </div>
                <div class="col-lg-10">
                    <p>
                        <input type="text" class="form-control" name="nama_layanan" value="{{ isset($layanan) ? $layanan->nama_layanan : '' }}">
                    </p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-2">
                    <p class="fw-bold">Google Drive Video</p>
                </div>
                <div class="col-lg-10">
                    <input class="form-control" type="text" name="video">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-2">
                    <p class="fw-bold">Poster</p>
                </div>
                <div class="col-lg-10">
                    <input class="form-control" type="file" id="formFile" name="poster" accept="image/*">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-2">
                    <p class="fw-bold">Persyaratan</p>
                </div>
                <div class="col-lg-10">
                    <div id="persyaratan-wrapper">
                        <div class="input-group mb-2">
                            <input type="text" name="persyaratan[]" class="form-control" placeholder="Masukkan persyaratan">
                            <button class="btn btn-danger remove-persyaratan" type="button">
                                <i class="bx bx-trash"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" id="tambah-persyaratan" class="btn btn-sm btn-primary mt-2">
                        <i class="bx bx-plus"></i> Tambah Persyaratan
                    </button>
                </div>
            </div>


            <div class="d-flex justify-content-end m-5">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
    <script>
        const wrapper = document.getElementById('persyaratan-wrapper');
        const addBtn = document.getElementById('tambah-persyaratan');

        // Add new input
        addBtn.addEventListener('click', () => {
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');

            div.innerHTML = `
                <input type="text" name="persyaratan[]" class="form-control" placeholder="Masukkan persyaratan">
                <button class="btn btn-danger remove-persyaratan" type="button">
                    <i class="bx bx-trash"></i>
                </button>
            `;

            wrapper.appendChild(div);
        });

        // Remove input
        wrapper.addEventListener('click', function(e) {
            if(e.target.closest('.remove-persyaratan')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>



@endsection


