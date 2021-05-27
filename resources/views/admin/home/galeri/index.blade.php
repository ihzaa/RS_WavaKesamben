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
                            <h3>Tata Cara Menginputkan Video Youtube</h3>
                            <ol>
                                <li>Buka video yang ingin ditampilkan</li>
                                <li>Klik bagikan dibawah video</li>
                                <li>Pilih sematkan dan tekan tombol salin</li>
                                <li>Pastekan pada salah satu inputan dibawah dan simpan</li>
                            </ol>
                            <small><a href="https://support.google.com/youtube/answer/171780?hl=id">Tata cara juga dapat
                                    dilihat dilink ini.</a></small>
                            <p>nb: hanya 10 data terbaru yang ditampilan pada halaman user</p>
                            <hr>
                            <div class="row d-flex mb-3">
                                <div class="col-md-4 mx-auto">
                                    <button id="btn_tambah" class="btn btn-primary btn-block"><i class="fa fa-plus"
                                            aria-hidden="true"></i>
                                        Tambah</button>
                                </div>

                            </div>
                            {{-- <form action="{{ route('admin.home.galeri.add', [1]) }}">
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
                            </form> --}}
                            <table id="main_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 15%">Video</th>
                                        <th>Dibuat Pada</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['item'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>@php
                                                echo $item->link;
                                            @endphp</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('H:i l,d M Y') }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-danger ml-1 btn_remove"
                                                        data-toggle="tooltip" data-placement="top" title="Hapus"
                                                        data-id="{{ $item->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Video</th>
                                        <th style="width: 10%">Dibuat Pada</th>
                                        <th style="width: 5%">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="main_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Link Youtube</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.home.galeri.add') }}" method="POST" id="form_add">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="link">Link</label>
                            <textarea required class="form-control" id="link" rows="3" name="link"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js_after')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        const URL = {
            add: "{{ route('admin.home.galeri.add') }}",
            remove: "{{ route('admin.home.galeri.remove', ['id']) }}"
        }

    </script>
    <script>
        $("#btn_tambah").click(function() {
            $("#main_modal").modal('show')
        })
        // $("form").submit(function() {
        //     event.preventDefault()
        //     $("#card_loading").show();
        //     let addURL = $(this).attr('action')
        //     fetch(addURL, {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             body: JSON.stringify({
        //                 link: $(this).find('textarea').val()
        //             })
        //         })
        //         .then((resp) => resp.json())
        //         .finally(() => {
        //             $("#card_loading").hide();
        //             Swal.fire({
        //                 icon: "success",
        //                 title: "Berhasil",
        //                 text: "Berhasil melakukan perubahan.",
        //             });
        //         })
        // })

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
                            }).then(() => {
                                location.reload()
                            })
                            $("#video" + id).val('')
                        })
                }
            })
        })

        function isHTML(str) {
            var a = document.createElement('div');
            a.innerHTML = str;

            for (var c = a.childNodes, i = c.length; i--;) {
                if (c[i].nodeType == 1) return true;
            }

            return false;
        }

        $("#form_add").submit(function() {
            if (!isHTML($("#link").val())) {
                event.preventDefault()
                Swal.fire({
                    title: 'Kesalahan!',
                    icon: 'error',
                    text: 'Input tidak valid, silahkan ikuti tata cara dihalaman ini'
                })
                return
            }
        })

    </script>
@endsection
