@extends('admin.template.master')

@section('page_title', 'Testimoni')

@section('breadcrumb')
    <li class="breadcrumb-item active">Promosi Kesehatan</li>
    <li class="breadcrumb-item active">Testimoni</li>
@endsection

@section('css_after')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Testimoni</h3>
                            <div class="card-tools">
                                <button class="btn btn-primary btn-sm" id="btn_tambah">
                                    <i class="fas fa-plus"></i>
                                    Tambah
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="main_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 10%">Nama</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 15%">Tanggal Dibuat</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['item'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td class="desc">@php
                                                echo strlen($item->description) > 150 ? substr($item->description, 0, 150) . '...' : $item->description;
                                            @endphp</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                            </td>
                                            <td class="text-center">
                                                @if ($item->creator_id != null)
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-success mr-1 btn_edit"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Lihat atau Edit" data-id="{{ $item->id }}"
                                                            data-name="{{ $item->name }}"
                                                            data-desc="{{ $item->description }}">
                                                            <i class="far fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger ml-1 btn_delete"
                                                            data-toggle="tooltip" data-placement="top" title="Hapus"
                                                            data-id="{{ $item->id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="btn-group">
                                                        @if ($item->is_accepted == 0)
                                                            <button class="btn btn-sm btn-success mr-1 btn_accept"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Terima Testimoni" data-id="{{ $item->id }}">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        @endif
                                                        <button class="btn btn-sm btn-danger ml-1 btn_delete"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Tolak dan Hapus" data-id="{{ $item->id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form action="" id="modal_form" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Masukkan Nama Pengguna" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Testimoni <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                                placeholder="Masukan Deskripsi" required></textarea>
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
            add: "{{ route('admin.healthyPromotion.testimonial.add.post') }}",
            edit: "{{ route('admin.healthyPromotion.testimonial.edit.post', ['__id']) }}",
            delete: "{{ route('admin.healthyPromotion.testimonial.delete', ['__id']) }}",
            accept: "{{ route('admin.healthyPromotion.testimonial.accept', ['__id']) }}"
        }

    </script>

    <script>
        $('#main_table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $(document).on('click', '.btn_delete', function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Yakin menghapus ?',
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
                    window.location.replace(URL.delete.replace('__id', id));
                }
            })
        });

        function openModal(...data) {
            data = data[0]
            $("#modal_title").html(data.title)
            $("#modal_form").attr('action', data.url)
            $("#nama").val(data.name)
            $("#deskripsi").val(data.description)
            $("#main_modal").modal("show")

        }

        $("#btn_tambah").click(function() {
            openModal({
                title: "Tambah Testimoni",
                url: URL.add
            });
        });

        $(document).on("click", ".btn_edit", function() {
            openModal({
                title: "Edit Testimoni",
                url: URL.edit.replace('__id', $(this).data('id')),
                name: $(this).data('name'),
                description: $(this).data('desc')
            })
        });

        $(document).on('click', '.btn_accept', function() {
            let id = $(this).data('id')
            Swal.fire({
                title: 'Yakin menerima testimoni ?',
                text: "Anda tidak dapat mengembalikan setelah diterima!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal.'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader();
                    window.location.replace(URL.accept.replace('__id', id));
                }
            })
        })

    </script>
@endsection
