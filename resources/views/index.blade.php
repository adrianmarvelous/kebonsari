    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Kebonsari</title>
    </head>
    <body>
        
        @if (Route::current()->getName() == '')
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('web.layanan.index') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="nama">
                                <label class="mt-3" for="">Alamat</label>
                                <input type="text" class="form-control" name="alamat">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
        <div class="p-3 m-3">
        <input type="text" id="searchBox" class="form-control" placeholder="Cari layanan...">
        <ul id="suggestions" class="list-group position-absolute w-100" style="z-index:1000;"></ul>
            <p class="text-center" style="margin-top: 100px;font-size:3rem">Kelurahan Kebonsari</p>
            <h4 class="text-center">Pemerintah Kota Surabaya</h4>

            <div class="position-fixed bottom-0 start-0 end-0 bg-white p-3 shadow">
                <div class="d-flex flex-column">
                    <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Pelayanan
                </button>

                    {{-- <a href="{{ route('web.layanan.index') }}" class="btn btn-primary mb-2">Pelayanan</a> --}}
                    <a href="" class="btn btn-primary mt-3 mb-2">Informasi Umum</a>
                </div>
            </div>
        </div>
        @endif
        @yield('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#searchBox').on('keyup', function () {
                let query = $(this).val();
                if (query.length > 1) {
                    $.ajax({
                        url: "{{ route('web.layanan.search') }}",
                        type: "GET",
                        data: { q: query },
                        success: function (data) {
                            $('#suggestions').empty();
                            if (data.length > 0) {
                                data.forEach(item => {
                                    $('#suggestions').append(
                                        `<li class="list-group-item suggestion-item" 
                                            data-id="${item.id}" 
                                            data-name="${item.nama_layanan}">
                                            ${item.nama_layanan} <small class="text-muted">(${item.sektor})</small>
                                        </li>`
                                    );
                                });
                            } else {
                                $('#suggestions').append('<li class="list-group-item text-muted">Tidak ditemukan</li>');
                            }
                        }
                    });
                } else {
                    $('#suggestions').empty();
                }
            });

            // Click suggestion → redirect to detail page
            $(document).on('click', '.suggestion-item', function () {
                let id = $(this).data('id');
                let url = "{{ route('web.layanan.detail', ':id') }}"; // route helper
                url = url.replace(':id', id); // replace placeholder with real id
                window.location.href = url;
            });
        });
    </script>


        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        -->
    </body>
    </html>