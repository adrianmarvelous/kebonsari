@extends('index')
<style>
  .ratio-9x16 {
    --bs-aspect-ratio: calc(16 / 9 * 100%); /* Portrait: height > width */
  }
</style>

<div class="container">
    <div class="row p-3">
        <div class="card shadow p-3">
            <h1 class="text-center"><?=$layanan['nama_layanan']?></h1>
            <div class="d-flex justify-content-center">
            </div>

            <h2>Persyaratan</h2>
            <ol>
                <?php
                    foreach ($layanan->persyaratan as $key => $value) {
                ?>
                <li><?=$value['syarat']?></li>
                <?php }?>
            </ol>
            <h2>Tutorial {{ $layanan->kategori }}</h2>
            <div class="d-flex mb-3 overflow-auto" style="gap: 10px; white-space: nowrap;">
                <?php if(isset($layanan['video']) && $layanan['video'] != '') { ?>
                    <div class="ratio ratio-9x16" style="min-width: 250px; max-width: 300px;">
                        <iframe src="https://drive.google.com/file/d/<?= htmlentities($layanan['video']) ?>/preview"
                                allow="autoplay" allowfullscreen></iframe>
                    </div>
                <?php } ?>

                @if ($layanan->kategori == 'SSW ALFA')
                    <div class="ratio ratio-9x16" style="min-width: 250px; max-width: 300px;">
                        <iframe src="https://drive.google.com/file/d/1pXcm3Idrq8TPbMgy-KgWo1gV_LXbOQux/preview"
                                allow="autoplay" allowfullscreen></iframe>
                    </div>
                @else
                    <div class="ratio ratio-9x16" style="min-width: 250px; max-width: 300px;">
                        <iframe src="https://drive.google.com/file/d/1Ffg9k7672cdwgKYkGEo4UryZBO_YYBXF/preview"
                                allow="autoplay" allowfullscreen></iframe>
                    </div>
                @endif
            </div>


            {{-- <a class="btn btn-primary" 
                href="{{ $layanan->kategori == 'SSW ALFA' ? 'https://sswalfa.surabaya.go.id/' : 'https://klampid-dispendukcapil.surabaya.go.id/' }}"
                target="_blank">
                {{ $layanan->kategori }}
            </a> --}}
            <a class="btn btn-primary" 
                href="{{ route('web.layanan.klik_app',['id' => $layanan->id]) }}"
                target="_blank">
                {{ $layanan->kategori }}
            </a>
            {{-- <form action="{{ route('visitor.session.destroy') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">
                    Hapus Session Visitor
                </button>
            </form> --}}

        </div>
    </div>

</div>
@section('content')

@endsection
