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
            <div class="nav-align-top nav-tabs-shadow">
            </div>
        </div>

    </div>
@endsection
