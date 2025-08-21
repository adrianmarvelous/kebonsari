@extends('admin.dashboard')


@section('content')
    <div class="container-fluid card shadow">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <h1 class="mt-4">Detail Agenda</h1>
                </div>
            </div>
        </div>
        <div class="border border-3 rounded p-3 mt-3 mb-3">
            <div class="row mb-3">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Nama Agenda</label>
                </div>
                <div class="col-lg-9">
                    <p>{{ $agenda->nama_agenda }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Foto Cover</label>
                </div>
                <div class="col-lg-9">
                    <img class="w-100" src="{{ asset($agenda->foto_cover) }}" alt="">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Narasi</label>
                </div>
                <div class="col-lg-9">
                    <p>{!! $agenda->narasi !!}</p>
                </div>
            </div>
        </div>
        <div class="border border-3 rounded p-3 mt-3 mb-3">
            <div class="d-flex justify-content-between flex-wrap">
                <div><h2>Lampiran</h2></div>
                <div class="d-flex align-items-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Upload Lampiran
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload Lampiran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                                <form action="{{ route('agenda.upload_lampiran') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                            <label for="">Nama Lampiran</label>
                                            <input class="form-control" type="text" name="nama">
                                            <label class="mt-3" for="">Lampiran</label>
                                            <input class="form-control" type="file" name="lampiran" accept="image/*,.pdf">
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="agenda_id" value="{{ $agenda->id }}">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Upload Lampiran</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- <button class="btn btn-primary">Upload Lampiran</button> --}}
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-primary">
                            <td>No</td>
                            <td>Nama File</td>
                            <td>File</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agenda->lampiran as $no => $item)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    @if ($item->file)
                                    @php
                                        // Get the filename only, in lowercase
                                        $filename = strtolower(basename($item->file));

                                        // Extract extension
                                        $ext = pathinfo($filename, PATHINFO_EXTENSION);

                                        // Check if image
                                        $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                                    @endphp

                                    @if($isImage)
                                            <img src="{{ asset($item->file) }}" alt="Lampiran" class="img-thumbnail" style="max-width:150px;">
                                        @elseif($ext === 'pdf')
                                            <a href="{{ asset($item->file) }}" class="btn btn-success btn-sm" target="_blank">Lihat PDF</a>
                                        @else
                                            <a href="{{ asset($item->file) }}" class="btn btn-secondary btn-sm" target="_blank">Lihat File</a>
                                        @endif
                                    @endif

                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Lampiran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                            </div>
                                                <form action="{{ route('agenda.update_lampiran') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                            <label for="">Nama Lampiran</label>
                                                            <input class="form-control" type="text" name="nama">
                                                            <label class="mt-3" for="">Lampiran</label>
                                                            <input class="form-control" type="file" name="lampiran" accept="image/*,.pdf">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="id_lampiran" value="{{ $item->id }}">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Update Lampiran</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalHapus{{ $item->id }}">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalHapus{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Lampiran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                            </div>
                                                <form action="{{ route('agenda.hapus_lampiran',['id_lampiran' => $item->id]) }}" method="GET">
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus Lampiran ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="agenda_id" value="{{ $agenda->id }}">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            

        </div>

    </div>
@endsection
