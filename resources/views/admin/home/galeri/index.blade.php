@extends('admin.template.master')

@section('page_title', 'Galeri')

@section('breadcrumb')
    <li class="breadcrumb-item active">Halaman Home</li>
    <li class="breadcrumb-item active">Galeri</li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="overlay dark" id="card_loading" style="display: none">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div>
                        <div class="card-header">
                            Galeri
                        </div>
                        <div class="card-body">
                            <h3>Tata Cara Menginputkan Link Video Youtube</h3>
                            <ol>
                                <li>Buka video yang ingin ditampilkan</li>
                                <li>Klik bagikan dibawah video</li>
                                <li>Pilih sematkan dan tekan tombol salin</li>
                                <li>Pastekan pada salah satu inputan dibawah dan simpan</li>
                            </ol>
                            <small><a href="https://support.google.com/youtube/answer/171780?hl=id">Tata cara juga dapat
                                    dilihat dilink ini.</a></small>
                            <hr>
                            <form action="{{ route('admin.home.galeri.add', [1]) }}">
                                <div class="form-group">
                                    <label for="video1">Galeri 1</label>
                                    <textarea required class="form-control" name="video1" id="video1" cols="30"
                                        placeholder="input disini" rows="3">{{ $data['item'][0]->link }}</textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-danger btn_remove"
                                            data-id="{{ $data['item'][0]->id }}">Hapus</button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('admin.home.galeri.add', [2]) }}">
                                <div class="form-group">
                                    <label for="video1">Galeri 2</label>
                                    <textarea required class="form-control" name="video2" id="video2" cols="30" rows="3"
                                        placeholder="input disini">{{ $data['item'][1]->link }}</textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-danger btn_remove"
                                            data-id="{{ $data['item'][1]->id }}">Hapus</button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('admin.home.galeri.add', [3]) }}">
                                <div class="form-group">
                                    <label for="video1">Galeri 3</label>
                                    <textarea required class="form-control" name="video3" id="video3" cols="30" rows="3"
                                        placeholder="input disini">{{ $data['item'][2]->link }}</textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-danger btn_remove"
                                            data-id="{{ $data['item'][2]->id }}">Hapus</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js_after')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        const URL = {
            add: "{{ route('admin.home.galeri.add', ['id']) }}",
            remove: "{{ route('admin.home.galeri.remove', ['id']) }}"
        }

    </script>
    <script>
        $("form").submit(function() {
            event.preventDefault()
            $("#card_loading").show();
            let addURL = $(this).attr('action')
            fetch(addURL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        link: $(this).find('textarea').val()
                    })
                })
                .then((resp) => resp.json())
                .finally(() => {
                    $("#card_loading").hide();
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Berhasil melakukan perubahan.",
                    });
                })
        })

        $(".btn_remove").click(function() {
            let id = $(this).data('id')
            Swal.fire({
                title: 'Yakin menghapus link?',
                text: "Anda tidak dapat mengembalikan setelah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal.'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#card_loading").show();
                    fetch(URL.remove.replace('id', id))
                        .then((resp) => resp.json())
                        .finally(() => {
                            $("#card_loading").hide();
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: "Berhasil melakukan perubahan.",
                            });
                            $("#video" + id).val('')
                        })
                }
            })
        })

    </script>
@endsection
