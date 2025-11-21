@extends('index')
@section('content')
    <div class="container">
        <div class="card shadow p-3">
            <h1>Hasil Pencairan</h1>
            <div class="mt-3">
                @foreach ($layanans as $item)
                    <a href="{{ route('web.layanan.detail',['id' => $item->id]) }}">
                        <div class="">
                            <div class="card card-secondary bg-secondary-gradient">
                            <div class="card-body bubble-shadow">
                                <h4 class="py-4 mb-0">{{ $item->nama_layanan }}</h4>
                            </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
