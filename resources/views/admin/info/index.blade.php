@extends('admin.dashboard')


@section('content')

    <div class="container-fluid card shadow">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-4">Info</h1>
            </div>
        </div>
        <div class="row">
            <form action="" method="post">
                <div class="col-md-12 mb-5">
                    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
                    <textarea id="editor"></textarea>

                    <script>
                    ClassicEditor
                        .create(document.querySelector('#editor'))
                        .catch(error => console.error(error));
                    </script>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
@endsection


