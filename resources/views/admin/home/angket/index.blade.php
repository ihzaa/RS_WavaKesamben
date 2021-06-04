@extends('admin.template.master')

@section('page_title', 'Angket')

@section('breadcrumb')
    <li class="breadcrumb-item active">Halaman Home</li>
    <li class="breadcrumb-item active">Angket</li>
@endsection

@section('css_after')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-4">
                        <div class="col-md-4 mx-auto">
                            <button class="btn btn-block btn-primary" id="btn_tambah_question"><i class="fas fa-plus"></i>
                                Tambah</button>
                        </div>
                    </div>
                    @if (count($data['angket']) == 0)
                        <h1 class="text-center">Tidak ada data angket.</h1>
                    @endif
                    @foreach ($data['angket'] as $item)
                        <div class="card collapsed-card" id="card{{ $item->id }}" data-id="{{ $item->id }}">
                            <div class="card-header">
                                <h3 class="card-title">{{ $item->pertanyaan }}</h3>

                                <div class="card-tools">
                                    <button class="btn btn-sm btn-success btn_edit_question" data-toggle="tooltip"
                                        data-placement="top" title="Edit" data-id="{{ $item->id }}"
                                        data-pertanyaan="{{ $item->pertanyaan }}">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger btn_delete" data-toggle="tooltip"
                                        data-placement="top" title="Hapus" data-id="{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip" data-placement="top" title="Detail Pertanyaan"><i
                                            class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="col-md-4 mx-auto text-center"><button data-id="{{ $item->id }}"
                                        class="mt-2 btn btn-sm btn-primary btn_tambah_jawaban"><i
                                            class="fas fa-plus"></i>Tambah Jawaban</button>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Jawaban</th>
                                            <th style="width: 20px">Jumlah Pengguna Menjawab</th>
                                            <th style="width: 10px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody{{ $item->id }}">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    @endforeach
                    {{-- <hr>
                    <h2>Hasil Angket</h2>
                    @if (count($data['angket']) == 0)
                        <h1 class="text-center">Tidak ada data angket.</h1>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Hasil Angket</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="main_table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    @endif --}}

                </div>
            </div>
        </div>
    </section>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="main_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">sm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="form_pertanyaan">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pertanyaan">Pertanyaan<span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control @error('pertanyaan') is-invalid @enderror"
                                id="pertanyaan" name="pertanyaan" required placeholder="Masukkan pertanyaan"></textarea>
                            @error('pertanyaan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_jawaban" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Tambah Jawaban</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="form_jawaban">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="jawaban">Jawaban<span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control" id="jawaban" name="jawaban" required
                                placeholder="Masukkan jawaban"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js_after')
    <script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        const URL = {
            addQuestion: "{{ route('admin.home.angket.add.question') }}",
            editQuestion: "{{ route('admin.home.angket.edit.question', ['__id']) }}",
            deleteQuestion: "{{ route('admin.home.angket.delete.question', ['__id']) }}",
            getAnsware: "{{ route('admin.home.angket.get.answare', ['__id']) }}",
            addAnsware: "{{ route('admin.home.angket.add.answare', ['__id']) }}",
            deleteAnsware: "{{ route('admin.home.angket.delete.answare', ['question', 'id']) }}"
        }

    </script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $("#btn_tambah_question").click(function() {
            $("#form_pertanyaan").attr('action', URL.addQuestion);
            $("#modal_title").html('Tambah Pertanyaan');
            $("#pertanyaan").val('')
            $("#main_modal").modal('show');
        });
        $(".btn_edit_question").click(function() {
            $("#form_pertanyaan").attr('action', URL.editQuestion.replace('__id', $(this).data('id')));
            $("#modal_title").html('Edit Pertanyaan');
            $("#pertanyaan").val($(this).data('pertanyaan'))
            $("#main_modal").modal('show');
        });
        $(document).on('click', '.btn_delete', function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Yakin menghapus?',
                text: "Anda tidak dapat mengembalikan setelah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal.'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader();
                    window.location.replace(URL.deleteQuestion.replace('__id', $(this).data('id')));
                }
            })
        });

        function getAnsware(id, tbodyEl) {
            var myHeaders = new Headers();
            myHeaders.append('pragma', 'no-cache');
            myHeaders.append('cache-control', 'no-cache');
            var myInit = {
                method: 'GET',
                headers: myHeaders,
            };
            fetch(URL.getAnsware.replace('__id', id), myInit)
                .then(resp => resp.json())
                .then(data => {
                    let tabel = '';
                    if (data.data.length != 0) {
                        for (let i in data.data) {
                            tabel +=
                                `<tr><td>${parseInt(i)+1}</td><td>${data.data[i].jawaban}</td><td>${data.data[i].jawaban_pengguna_count}</td><td class="text-center"><button data-id="${data.data[i].id}" data-card="${data.id}" class="btn btn-sm btn-danger btn_delete_answare"> <i class="fas fa-trash"></i></button></td></tr>`
                        }
                    } else {
                        tabel = `<tr><td colspan="3" class="text-center">Tidak Ada Jawaban.</td></tr>`
                    }
                    tbodyEl.html(tabel)

                }).then(() => {
                    $('#loading_card' + id).remove();
                })
        }

        $('.card').on('expanded.lte.cardwidget', function() {
            let id = $(this).data('id');
            $(this).append(
                `<div class="overlay dark" id="loading_card${id}"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>`
            )
            getAnsware(id, $(this).find('tbody'))
        });

        let cardId;
        $(".btn_tambah_jawaban").click(function() {
            $("#modal_jawaban").modal('show');
            $("#form_jawaban").attr('action', URL.addAnsware.replace('__id', $(this).data('id')))
            $("#form_jawaban").removeAttr('data-id')
            cardId = $(this).data('id');
        })

        $("#form_jawaban").submit(function() {
            $("#modal_jawaban").modal('hide');
            event.preventDefault()
            let id = cardId
            $("#card" + id).append(
                `<div class="overlay dark" id="loading_card${id}"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>`
            )
            fetch($(this).attr('action'), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        jawaban: $("#jawaban").val()
                    })
                })
                .then((resp) => resp.json())
                .then((data) => {
                    let tabel = '';
                    for (let i in data.data) {
                        tabel +=
                            `<tr><td>${parseInt(i)+1}</td><td>${data.data[i].jawaban}</td><td>${data.data[i].jawaban_pengguna_count}</td><td class="text-center"><button class="btn btn-sm btn-danger btn_delete_answare" data-id="${data.data[i].id}" data-card="${data.id}"> <i class="fas fa-trash"></i></button></td></tr>`
                    }
                    $("#tbody" + data.id).html(tabel);
                })
                .then(() => {
                    $('#loading_card' + id).remove();
                    $("#jawaban").val('')
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Berhasil Menambahkan!",
                    });
                })
        })

        $(document).on('click', '.btn_delete_answare', function() {
            const id = $(this).data('id');
            const card = $(this).data('card')
            Swal.fire({
                title: 'Yakin menghapus?',
                text: "Anda tidak dapat mengembalikan setelah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal.'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#card" + card).append(
                        `<div class="overlay dark" id="loading_card${card}"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>`
                    )
                    fetch((URL.deleteAnsware.replace('__id', id)).replace('question', card))
                        .then(resp => resp.json())
                        .then(data => {
                            let tabel = '';
                            if (data.data.length != 0) {
                                for (let i in data.data) {
                                    tabel +=
                                        `<tr><td>${parseInt(i)+1}</td><td>${data.data[i].jawaban}</td><td>${data.data[i].jawaban_pengguna_count}</td><td class="text-center"><button data-id="${data.data[i].id}" data-card="${data.id}" class="btn btn-sm btn-danger btn_delete_answare"> <i class="fas fa-trash"></i></button></td></tr>`
                                }
                            } else {
                                tabel =
                                    `<tr><td colspan="3" class="text-center">Tidak Ada Jawaban.</td></tr>`
                            }
                            $("#tbody" + data.id).html(tabel)
                        })
                        .then(() => {
                            $('#loading_card' + card).remove();
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: "Berhasil Menghapus!",
                            });
                        })
                }
            })
        })

        $('#main_table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

    </script>
@endsection
