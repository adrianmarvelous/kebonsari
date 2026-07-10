@extends('admin.dashboard')


@section('content')
    <div class="card-modern">
        <div class="card-header-custom d-flex justify-content-between align-items-center flex-wrap">
            <h5><i class="fas fa-calendar-alt text-primary me-2"></i>Detail Agenda</h5>
            <a href="{{ route('agenda.index') }}" class="btn btn-admin btn-admin-primary btn-admin-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body-custom">
            <!-- Info Agenda -->
            <div class="row mb-4">
                <div class="col-lg-3">
                    <label class="form-label-modern">Nama Agenda</label>
                </div>
                <div class="col-lg-9">
                    <p class="fw-semibold">{{ $agenda->nama_agenda }}</p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-3">
                    <label class="form-label-modern">Foto Cover</label>
                </div>
                <div class="col-lg-9">
                    <img class="img-fluid rounded" src="{{ asset($agenda->foto_cover) }}" alt="Cover" style="max-height: 400px;">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-3">
                    <label class="form-label-modern">Narasi</label>
                </div>
                <div class="col-lg-9">
                    <div class="p-3 bg-light rounded">
                        {!! $agenda->narasi !!}
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <!-- Lampiran -->
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h5 class="fw-bold mb-0"><i class="fas fa-paperclip text-primary me-2"></i>Lampiran</h5>
                <button type="button" class="btn btn-admin btn-admin-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="fas fa-upload"></i> Upload Lampiran
                </button>
            </div>

            <!-- Upload Modal -->
            <div class="modal fade modal-modern" id="uploadModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fas fa-upload me-2"></i>Upload Lampiran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('agenda.upload_lampiran') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label-modern">Nama Lampiran</label>
                                    <input class="form-control-modern w-100" type="text" name="nama" placeholder="Masukkan nama lampiran">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label-modern">File Lampiran</label>
                                    <input class="form-control-modern w-100" type="file" name="lampiran" accept="image/*,.pdf">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="agenda_id" value="{{ $agenda->id }}">
                                <button type="button" class="btn btn-admin btn-admin-secondary" data-bs-dismiss="modal" style="background:#e5e7eb;color:#333;">Tutup</button>
                                <button type="submit" class="btn btn-admin btn-admin-primary">
                                    <i class="fas fa-upload"></i> Upload
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-admin">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama File</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agenda->lampiran as $no => $item)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td class="fw-semibold">{{ $item->nama }}</td>
                                <td>
                                    @if ($item->file)
                                    @php
                                        $filename = strtolower(basename($item->file));
                                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                        $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                                    @endphp

                                    @if($isImage)
                                        <img src="{{ asset($item->file) }}" alt="Lampiran" class="rounded" style="max-width:100px; max-height:60px; object-fit:cover;">
                                    @elseif($ext === 'pdf')
                                        <a href="{{ asset($item->file) }}" class="btn btn-admin btn-admin-success btn-admin-sm" target="_blank">
                                            <i class="fas fa-file-pdf"></i> Lihat PDF
                                        </a>
                                    @else
                                        <a href="{{ asset($item->file) }}" class="btn btn-admin btn-admin-info btn-admin-sm" target="_blank">
                                            <i class="fas fa-file"></i> Lihat File
                                        </a>
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <!-- Edit Lampiran -->
                                        <button type="button" class="btn btn-admin btn-admin-warning btn-admin-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Edit Modal -->
                                        <div class="modal fade modal-modern" id="editModal{{$item->id}}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Lampiran</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('agenda.update_lampiran') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label-modern">Nama Lampiran</label>
                                                                <input class="form-control-modern w-100" type="text" name="nama" value="{{ $item->nama }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label-modern">File Lampiran</label>
                                                                <input class="form-control-modern w-100" type="file" name="lampiran" accept="image/*,.pdf">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id_lampiran" value="{{ $item->id }}">
                                                            <button type="button" class="btn btn-admin" style="background:#e5e7eb;color:#333;" data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-admin btn-admin-primary">
                                                                <i class="fas fa-save"></i> Update
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Hapus Lampiran -->
                                        <button type="button" class="btn btn-admin btn-admin-danger btn-admin-sm" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <!-- Hapus Modal -->
                                        <div class="modal fade modal-modern" id="hapusModal{{$item->id}}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background: linear-gradient(135deg, #ea4335, #d33426);">
                                                        <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('agenda.hapus_lampiran',['id_lampiran' => $item->id]) }}" method="GET">
                                                        <div class="modal-body">
                                                            <p class="mb-0">Apakah anda yakin ingin menghapus lampiran <strong>{{ $item->nama }}</strong>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="agenda_id" value="{{ $agenda->id }}">
                                                            <button type="button" class="btn btn-admin" style="background:#e5e7eb;color:#333;" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-admin btn-admin-danger">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
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
