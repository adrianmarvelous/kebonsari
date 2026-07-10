@extends('admin.dashboard')


@section('content')
    <div class="card-modern">
        <div class="card-header-custom d-flex justify-content-between align-items-center flex-wrap">
            <h5><i class="fas fa-calendar-alt text-primary me-2"></i>Agenda</h5>
            <a class="btn btn-admin btn-admin-primary" href="{{ route('agenda.create') }}">
                <i class="fas fa-plus"></i> Buat Agenda Baru
            </a>
        </div>
        <div class="card-body-custom">
            <div class="table-responsive">
                <table class="table table-admin table-datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Agenda</th>
                            <th>Foto</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendas as $agenda)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $agenda->nama_agenda }}</td>
                                <td>
                                    <img src="{{ asset($agenda->foto_cover) }}" alt="Lampiran" class="rounded" style="max-width:100px; max-height:60px; object-fit:cover;">
                                </td>
                                <td>{{ date('d M Y',strtotime($agenda->created_at)) }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a class="btn btn-admin btn-admin-info btn-admin-sm" href="{{ route('agenda.show', $agenda->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-admin btn-admin-warning btn-admin-sm" href="{{ route('agenda.edit', $agenda->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-admin btn-admin-danger btn-admin-sm" onclick="return confirm('Yakin ingin menghapus agenda ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
