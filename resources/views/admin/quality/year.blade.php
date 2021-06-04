@extends('admin.template.master')

@section('page_title', 'Kualitas Mutu')

@section('breadcrumb')
    <li class="breadcrumb-item active">Kualitas</li>
@endsection

@section('css_after')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
                            <button class="btn btn-block btn-primary" id="btn_tambah_tahun"><i class="fas fa-plus"></i>
                                Tambah</button>
                        </div>
                    </div>
                    @if (count($data['quality']) == 0)
                        <h1 class="text-center">Data tidak ditemukan.</h1>
                    @endif
                    <div class="row">
                        @foreach ($data['quality'] as $item)
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box bg-gradient-success">
                                    <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Kualitas Mutu</span>
                                        <h3 class="info-box-number">{{ $item->year }}</h3>

                                        <div class="progress">
                                            <hr>
                                        </div>
                                        <span class="progress-description d-flex">
                                            <button class="btn btn-primary btn-edit btn-sm mx-auto"
                                                data-id="{{ $item->id }}" data-year="{{ $item->year }}"
                                                data-toggle="tooltip" data-placement="top" title="Edit Tahun"><i
                                                    class="fas fa-edit"></i>
                                            </button>
                                            <a class="btn btn-sm btn-info text-light mx-auto"
                                                href="{{ route('admin.kualitas.index.bulan', ['id' => $item->id]) }}"
                                                data-toggle="tooltip" data-placement="top" title="Lihat Bulan">
                                                <strong><i class="far fa-eye"></i></strong>
                                            </a>
                                            <button class="btn btn-sm btn-danger btn-hapus mx-auto"
                                                data-id="{{ $item->id }}" data-year="{{ $item->year }}"
                                                data-toggle="tooltip" data-placement="top" title="Hapus Tahun"><i
                                                    class="fa fa-trash"></i></button>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                        @endforeach
                    </div>

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
                <form method="POST" id="form_tahun">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            {{-- <input type="number" value="{{ $data['year']->id }}" id="year_id" name="year_id" hidden> --}}
                            <label for="year">Tahun<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" id="year"
                                name="year" required placeholder="Masukkan tahun">
                            @error('year')
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
    {{-- <div class="modal fade" id="modal_jawaban" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
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
    </div> --}}
@endsection

@section('js_after')
    <script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        const URL = {
            addYear: "{{ route('admin.kualitas.add.tahun') }}",
            editYear: "{{ route('admin.kualitas.edit.tahun', ['__id']) }}",
            deleteYear: "{{ route('admin.kualitas.delete.tahun', ['__id']) }}",
            // getAnsware: "{{ route('admin.home.angket.get.answare', ['__id']) }}",
            // addAnsware: "{{ route('admin.home.angket.add.answare', ['__id']) }}",
            // deleteAnsware: "{{ route('admin.home.angket.delete.answare', ['question', 'id']) }}"
        }

    </script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $("#btn_tambah_tahun").click(function() {
            $("#form_tahun").attr('action', URL.addYear);
            $("#modal_title").html('Tambah Tahun');
            $("#year").val('')
            $("#main_modal").modal('show');
        });
        $(".btn-edit").click(function() {
            $("#form_tahun").attr('action', URL.editYear.replace('__id', $(this).data('id')));
            $("#modal_title").html('Edit Tahun');
            $("#year").val($(this).data('year'))
            $("#main_modal").modal('show');
        });
        $(document).on('click', '.btn-hapus', function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Yakin menghapus data kualitas mutu tahun ' + $(this).data('year') + '?',
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
                    window.location.replace(URL.deleteYear.replace('__id', $(this).data('id')));
                }
            })
        });

        // function getAnsware(id, tbodyEl) {
        //     var myHeaders = new Headers();
        //     myHeaders.append('pragma', 'no-cache');
        //     myHeaders.append('cache-control', 'no-cache');
        //     var myInit = {
        //         method: 'GET',
        //         headers: myHeaders,
        //     };
        //     fetch(URL.getAnsware.replace('__id', id), myInit)
        //         .then(resp => resp.json())
        //         .then(data => {
        //             let tabel = '';
        //             if (data.data.length != 0) {
        //                 for (let i in data.data) {
        //                     tabel +=
        //                         `<tr><td>${parseInt(i)+1}</td><td>${data.data[i].jawaban}</td><td>${data.data[i].jawaban_pengguna_count}</td><td class="text-center"><button data-id="${data.data[i].id}" data-card="${data.id}" class="btn btn-sm btn-danger btn_delete_answare"> <i class="fas fa-trash"></i></button></td></tr>`
        //                 }
        //             } else {
        //                 tabel = `<tr><td colspan="3" class="text-center">Tidak Ada Jawaban.</td></tr>`
        //             }
        //             tbodyEl.html(tabel)

        //         }).then(() => {
        //             $('#loading_card' + id).remove();
        //         })
        // }

        // $('.card').on('expanded.lte.cardwidget', function() {
        //     let id = $(this).data('id');
        //     $(this).append(
        //         `<div class="overlay dark" id="loading_card${id}"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>`
        //     )
        //     getAnsware(id, $(this).find('tbody'))
        // });

        // let cardId;
        // $(".btn_tambah_jawaban").click(function() {
        //     $("#modal_jawaban").modal('show');
        //     $("#form_jawaban").attr('action', URL.addAnsware.replace('__id', $(this).data('id')))
        //     $("#form_jawaban").removeAttr('data-id')
        //     cardId = $(this).data('id');
        // })

        // $("#form_jawaban").submit(function() {
        //     $("#modal_jawaban").modal('hide');
        //     event.preventDefault()
        //     let id = cardId
        //     $("#card" + id).append(
        //         `<div class="overlay dark" id="loading_card${id}"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>`
        //     )
        //     fetch($(this).attr('action'), {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             body: JSON.stringify({
        //                 jawaban: $("#jawaban").val()
        //             })
        //         })
        //         .then((resp) => resp.json())
        //         .then((data) => {
        //             let tabel = '';
        //             for (let i in data.data) {
        //                 tabel +=
        //                     `<tr><td>${parseInt(i)+1}</td><td>${data.data[i].jawaban}</td><td>${data.data[i].jawaban_pengguna_count}</td><td class="text-center"><button class="btn btn-sm btn-danger btn_delete_answare" data-id="${data.data[i].id}" data-card="${data.id}"> <i class="fas fa-trash"></i></button></td></tr>`
        //             }
        //             $("#tbody" + data.id).html(tabel);
        //         })
        //         .then(() => {
        //             $('#loading_card' + id).remove();
        //             $("#jawaban").val('')
        //             Swal.fire({
        //                 icon: "success",
        //                 title: "Berhasil",
        //                 text: "Berhasil Menambahkan!",
        //             });
        //         })
        // })

        // $(document).on('click', '.btn_delete_answare', function() {
        //     const id = $(this).data('id');
        //     const card = $(this).data('card')
        //     Swal.fire({
        //         title: 'Yakin menghapus?',
        //         text: "Anda tidak dapat mengembalikan setelah dihapus!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Ya, Hapus!',
        //         cancelButtonText: 'Batal.'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $("#card" + card).append(
        //                 `<div class="overlay dark" id="loading_card${card}"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>`
        //             )
        //             fetch((URL.deleteAnsware.replace('__id', id)).replace('question', card))
        //                 .then(resp => resp.json())
        //                 .then(data => {
        //                     let tabel = '';
        //                     if (data.data.length != 0) {
        //                         for (let i in data.data) {
        //                             tabel +=
        //                                 `<tr><td>${parseInt(i)+1}</td><td>${data.data[i].jawaban}</td><td>${data.data[i].jawaban_pengguna_count}</td><td class="text-center"><button data-id="${data.data[i].id}" data-card="${data.id}" class="btn btn-sm btn-danger btn_delete_answare"> <i class="fas fa-trash"></i></button></td></tr>`
        //                         }
        //                     } else {
        //                         tabel =
        //                             `<tr><td colspan="3" class="text-center">Tidak Ada Jawaban.</td></tr>`
        //                     }
        //                     $("#tbody" + data.id).html(tabel)
        //                 })
        //                 .then(() => {
        //                     $('#loading_card' + card).remove();
        //                     Swal.fire({
        //                         icon: "success",
        //                         title: "Berhasil",
        //                         text: "Berhasil Menghapus!",
        //                     });
        //                 })
        //         }
        //     })
        // })

        // $('#main_table').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": true,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        // });

    </script>
@endsection
