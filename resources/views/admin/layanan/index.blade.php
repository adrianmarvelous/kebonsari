@extends('admin.dashboard')


@section('content')

    <div class="container-fluid card shadow">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-4">Layanan</h1>
            </div>
            <div class="mb-4">
                <a class="btn btn-primary" href="{{ route('layanan.create') }}">Buat Layanan Baru</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="example">
                        <thead class="table-primary">
                            <th>No</th>
                            <th>Sektor</th>
                            <th>Layanan</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($layanan as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->sektor }}</td>
                                    <td>{{ $item->nama_layanan }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('layanan.show',['layanan' => $item->id]) }}">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection


