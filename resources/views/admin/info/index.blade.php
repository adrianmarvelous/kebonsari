@extends('admin.dashboard')


@section('content')

    <div class="container-fluid card shadow">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-4">Info</h1>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('info.update',['info' => 1]) }}" method="POST">
                @csrf
                @method('PUT') 
                <div class="col-md-12 mb-5">
                    <textarea id="summernote" name="info">{{ old('info', $info->info ?? '') }}</textarea>
                    
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
@endsection


