@extends('index')
<style>
    a:hover .cardd {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    .cardd {
        transition: transform 0.3s ease;
    }
</style>

<div class="container">
    <div class="row card shadow h-100">
        <div class="p-3">
    <input type="text" id="searchBox" class="form-control" placeholder="Cari layanan...">
    <ul id="suggestions" class="list-group position-absolute w-100" style="z-index:1000;"></ul>
            <p class="text-center" style="margin-top: 100px;font-size:3rem">Pilih Layanan</p>
            <!-- <h4 class="text-center">Pemerintah Kota Surabaya</h4> -->

            <?php
                foreach ($layanan as $key => $value) {
            ?>
                <a href="{{ route('web.layanan.detail',['id' => $value->id]) }}" style="text-decoration: none;color: black;">
                    <div class="card cardd shadow mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?=$value['nama_layanan']?></h5>
                        </div>
                    </div>
                </a>
            <?php }?>
        </div>
    </div>
</div>
@section('content')

@endsection
