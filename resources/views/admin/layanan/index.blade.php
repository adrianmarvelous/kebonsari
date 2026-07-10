@extends('admin.dashboard')


@section('content')

    <div class="card-modern">
        <div class="card-header-custom d-flex justify-content-between align-items-center flex-wrap">
            <h5><i class="fas fa-handshake text-primary me-2"></i>Layanan</h5>
            <a class="btn btn-admin btn-admin-primary" href="{{ route('layanan.create') }}">
                <i class="fas fa-plus"></i> Buat Layanan Baru
            </a>
        </div>
        <div class="card-body-custom">
            <div class="table-responsive">
                <table class="table table-admin table-datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sektor</th>
                            <th>Layanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($layanan as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->sektor }}</td>
                                <td class="fw-semibold">{{ $item->nama_layanan }}</td>
                                <td>
                                    <a class="btn btn-admin btn-admin-primary btn-admin-sm" href="{{ route('layanan.show',['layanan' => $item->id]) }}">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection


