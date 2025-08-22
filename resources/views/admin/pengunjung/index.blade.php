@extends('admin.dashboard')


@section('content')
    <div class="container-fluid card shadow">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="mt-4">Data Pengunjung</h1>
                </div>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-success mb-3" href="{{ route('pengunjung.export_excel',['bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank">Export Excel</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="nav-align-top nav-tabs-shadow">
                <ul class="nav nav-tabs" role="tablist">
                    @foreach ($tahun_visitor as $item_tahun)
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ $item_tahun->year == $tahun ? 'active' : '' }}" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-top-{{ $item_tahun->year }}" aria-controls="navs-top-{{ $item_tahun->year }}" aria-selected="true">
                                {{ $item_tahun->year }}
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                @foreach ($tahun_visitor as $item_tahun)
                    <div class="tab-pane fade show {{ $item_tahun->year == $tahun ? 'active' : '' }}" id="navs-top-{{ $item_tahun->year }}" role="tabpanel">
                        <div class="d-flex justify-content-between flex-wrap">
                            <div>
                                <h2> Bulan {{ bulan_indo($bulan) }} Tahun {{ $item_tahun->year }}</h2>
                            </div>
                            <div>
                                <form action="{{ route('pengunjung.index') }}" method="GET">
                                    <input type="hidden" name="tahun" value="{{ $item_tahun->year }}">
                                    <select name="bulan" class="form-select" onchange="this.form.submit()">
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                                {{ bulan_indo($i) }}
                                            </option>
                                        @endfor
                                    </select>
                                </form>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="example">
                                <thead>
                                    <tr class="table-primary">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Layanan</th>
                                        <th>created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item_tahun->pengunjung as $no => $item_pengunjung)
                                        <tr>
                                            <td>{{ $no+1 }}</td>
                                            <td>{{ $item_pengunjung->nama }}</td>
                                            <td>{{ $item_pengunjung->alamat }}</td>
                                            <td>{{ $item_pengunjung->layanan->nama_layanan }}</td>
                                            <td>{{ date('d-M-Y',strtotime($item_pengunjung->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
