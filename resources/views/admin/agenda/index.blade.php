@extends('admin.dashboard')


@section('content')
    <div class="container-fluid card shadow">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between flex-wrap">
                <div class="">
                    <h1 class="mt-4">Agenda</h1>
                </div>
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{ route('agenda.create') }}">Buat Agenda Baru</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive mb-3">
                <table class="table table-striped mt-3">
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
                                <td>{{ $agenda->nama_agenda }}</td>
                                <td>
                                    <img src="{{ asset($agenda->foto_cover) }}" alt="Lampiran" class="img-thumbnail" style="max-width:150px;">
                                </td>
                                <td>{{ date('d-M-Y',strtotime($agenda->created_at)) }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('agenda.show', $agenda->id) }}">Lihat</a>
                                    <a class="btn btn-warning" href="{{ route('agenda.edit', $agenda->id) }}">Edit</a>
                                    <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
