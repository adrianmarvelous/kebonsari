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
                    <img src="{{ asset($agenda->file) }}" alt="">
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
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <label for="">Lampiran</label>
                                <input class="mt-3 form-control" type="file" name="lampiran" accept="image/*,.pdf">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary">Upload Lampiran</button>
                        </div>
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
                            <td>Aksi</td>
                        </tr>
                    </thead>
                </table>
            </div>
            

        </div>

    </div>
@endsection
