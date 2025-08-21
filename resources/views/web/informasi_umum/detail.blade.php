@extends('index')
<div class="container">
    <div class="row p-3">
        <div class="card shadow p-3">
            <h1 class="text-center">{{ $agenda->nama_agenda }}</h1>
            <img class="w-100" src="{{ asset($agenda->foto_cover) }}" alt="">
            <p>{!! $agenda->narasi !!}</p>
            <h5 class="mt-4">Lampiran:</h5>
            <div class="d-flex flex-wrap gap-3">
                @foreach($agenda->lampiran as $item)
                    @php
                        $filename = strtolower(basename($item->file));
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                    @endphp

                    @if($isImage)
                        <div>
                            <img src="{{ asset($item->file) }}" class="img-thumbnail" style="max-width:300px;" alt="{{ $item->nama }}">
                            <p class="text-center">{{ $item->nama }}</p>
                        </div>
                    @elseif($ext === 'pdf')
                        <div>
                            <a href="{{ asset($item->file) }}" target="_blank" class="btn btn-success btn-sm">
                                {{ $item->nama }} (PDF)
                            </a>
                        </div>
                    @else
                        <div>
                            <a href="{{ asset($item->file) }}" target="_blank" class="btn btn-secondary btn-sm">
                                {{ $item->nama }} (File)
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
    </div>

</div>
@section('content')

@endsection
