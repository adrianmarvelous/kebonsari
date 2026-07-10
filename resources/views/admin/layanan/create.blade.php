@extends('admin.dashboard')


@section('content')

    <div class="card-modern">
        <div class="card-header-custom">
            <h5><i class="fas {{ isset($layanan) ? 'fa-edit' : 'fa-plus-circle' }} text-primary me-2"></i>{{ isset($layanan) ? 'Edit' : 'Buat' }} Layanan</h5>
        </div>
        <div class="card-body-custom">
            <form action="{{ isset($layanan) ? route('layanan.update', $layanan->id) : route('layanan.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($layanan))
                    @method('PUT')
                @endif

                <div class="row mb-3">
                    <div class="col-lg-2"><label class="form-label-modern">Kategori</label></div>
                    <div class="col-lg-10">
                        <select name="kategori" class="form-control-modern w-100">
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

                <div class="row mb-3">
                    <div class="col-lg-2"><label class="form-label-modern">Sektor</label></div>
                    <div class="col-lg-10">
                        <select name="sektor" class="form-control-modern w-100">
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

                <div class="row mb-3">
                    <div class="col-lg-2"><label class="form-label-modern">Nama Layanan</label></div>
                    <div class="col-lg-10">
                        <input type="text" class="form-control-modern w-100" name="nama_layanan" 
                            value="{{ $layanan->nama_layanan ?? '' }}" placeholder="Masukkan nama layanan">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-2"><label class="form-label-modern">Google Drive Video</label></div>
                    <div class="col-lg-10">
                        <input type="text" class="form-control-modern w-100" name="video" 
                            value="{{ $layanan->video ?? '' }}" placeholder="URL Google Drive video">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-lg-2"><label class="form-label-modern">Poster</label></div>
                    <div class="col-lg-10">
                        <input type="file" class="form-control-modern w-100" name="poster" accept="image/*">
                        @if(isset($layanan->poster))
                            <img src="{{ asset('storage/'.$layanan->poster) }}" alt="Poster" class="img-fluid mt-2 rounded" style="max-width:150px;">
                        @endif
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-lg-2"><label class="form-label-modern">Persyaratan</label></div>
                    <div class="col-lg-10">
                        <div id="persyaratan-wrapper">
                            @if(isset($layanan) && $layanan->persyaratan->count())
                                @foreach($layanan->persyaratan as $syarat)
                                    <div class="input-group mb-2">
                                        <input type="text" name="persyaratan[]" class="form-control-modern flex-grow-1" value="{{ $syarat->syarat }}">
                                        <button class="btn btn-admin btn-admin-danger remove-persyaratan" type="button">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2">
                                    <input type="text" name="persyaratan[]" class="form-control-modern flex-grow-1" placeholder="Masukkan persyaratan">
                                    <button class="btn btn-admin btn-admin-danger remove-persyaratan" type="button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" id="tambah-persyaratan" class="btn btn-admin btn-admin-primary btn-admin-sm mt-2">
                            <i class="fas fa-plus"></i> Tambah Persyaratan
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button class="btn btn-admin btn-admin-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const wrapper = document.getElementById('persyaratan-wrapper');
        const addBtn = document.getElementById('tambah-persyaratan');

        // Add new input
        addBtn.addEventListener('click', () => {
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');

            div.innerHTML = `
                <input type="text" name="persyaratan[]" class="form-control-modern flex-grow-1" placeholder="Masukkan persyaratan">
                <button class="btn btn-admin btn-admin-danger remove-persyaratan" type="button">
                    <i class="fas fa-trash"></i>
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


