@extends('index')
<div class="container">
    <div class="row p-3">
        <div class="card shadow p-3">
            <h1 class="text-center">Informasi Umum</h1>
            <div class="card p-3 shadow">
                <h2>Agenda</h2>
                <div class="row">
                    @foreach ($agendas as $item)
                        <div class="card col-lg-4 mb-3">
                            <div class="card-body">
                                <img class="w-100" src="{{ asset($item->foto_cover) }}" alt="">
                                <h5 class="card-title">{{ $item->nama_agenda }}</h5>
                                <a class="btn btn-primary w-100" href="{{ route('web.informasi_umum.detail',['id' => $item->id]) }}">Selengkapnya</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@section('content')

@endsection
