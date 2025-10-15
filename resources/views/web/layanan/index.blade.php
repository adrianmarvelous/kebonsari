@extends('index')

@section('content')
    <div class="p-3 card shadow m-3">
    <input type="text" id="searchBox" class="form-control" placeholder="Cari layanan...">
    <ul id="suggestions" class="list-group position-absolute w-100" style="z-index:1000;"></ul>
        <p class="text-center" style="margin-top: 100px;font-size:3rem">Pilih Sektor Pelayanan</p>
        <!-- <h4 class="text-center">Pemerintah Kota Surabaya</h4> -->

        <div class="p-3">
            <div class="d-flex flex-column">
                <?php
                    foreach ($sektor as $key => $value) {
                ?>
                <a href="{{ route('web.layanan.sektor',['sektor' => $value->sektor]) }}" class="btn btn-primary mb-2"><?=$value['sektor']?></a>
                <?php }?>
            </div>
        </div>
    </div>

@endsection
