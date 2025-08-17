@extends('admin.dashboard')


@section('content')

    <div class="container-fluid card shadow">
        @foreach (['success', 'error'] as $msg)
            @if (session($msg))
                <div class="alert alert-{{ $msg == 'success' ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
                    <i class="bx {{ $msg == 'success' ? 'bx-check-circle' : 'bx-error-circle' }} me-2"></i>
                    {{ session($msg) }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endforeach

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ isset($layanan) ? route('layanan.update', $layanan->id) : route('layanan.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($layanan))
                @method('PUT')
            @endif
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-4">Detail Layanan</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"><p class="fw-bold">Kategori</p></div>
                <div class="col-lg-10">
                    <select name="kategori" class="form-select">
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->kategori }}"
                                {{ isset($layanan) && $layanan->kategori == $item->kategori ? 'selected' : '' }}>
                                {{ $item->kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-2"><p class="fw-bold">Sektor</p></div>
                <div class="col-lg-10">
                    <select name="sektor" class="form-select">
                        <option value="" disabled selected>-- Pilih Sektor --</option>
                        @foreach ($sektor as $item)
                            <option value="{{ $item->sektor }}"
                                {{ isset($layanan) && $layanan->sektor == $item->sektor ? 'selected' : '' }}>
                                {{ $item->sektor }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-2"><p class="fw-bold">Nama Layanan</p></div>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="nama_layanan" 
                        value="{{ $layanan->nama_layanan ?? '' }}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-2"><p class="fw-bold">Google Drive Video</p></div>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="video" 
                        value="{{ $layanan->video ?? '' }}">
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-lg-2"><p class="fw-bold">Poster</p></div>
                <div class="col-lg-10">
                    <input type="file" class="form-control" name="poster" accept="image/*">
                    @if(isset($layanan->poster))
                        <img src="{{ asset('storage/'.$layanan->poster) }}" alt="Poster" class="img-fluid mt-2" style="max-width:150px;">
                    @endif
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-lg-2"><p class="fw-bold">Persyaratan</p></div>
                <div class="col-lg-10">
                    <div id="persyaratan-wrapper">
                        @if(isset($layanan) && $layanan->persyaratan->count())
                            @foreach($layanan->persyaratan as $syarat)
                                <div class="input-group mb-2">
                                    <input type="text" name="persyaratan[]" class="form-control" value="{{ $syarat->syarat }}">
                                    <button class="btn btn-danger remove-persyaratan" type="button">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="input-group mb-2">
                                <input type="text" name="persyaratan[]" class="form-control" placeholder="Masukkan persyaratan">
                                <button class="btn btn-danger remove-persyaratan" type="button">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        @endif
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


