@extends('admin.template.master')

@section('page_title', 'Menu Pendaftaran')

@section('breadcrumb')
    <li class="breadcrumb-item active">Pendaftaran Pasien</li>
    <li class="breadcrumb-item active">Menu Pendaftaran</li>
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
                        <div class="overlay dark" id="card_loading" style="display: none">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">List Menu Pendaftaran</h3>
                            <div class="card-tools">
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.patientRegistration.registrationMenu.add') }}">
                                    <i class="fas fa-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="main_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 14%">Aktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['item'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td class="desc">@php
                                                echo strlen(strip_tags($item->description)) > 150 ? substr(strip_tags($item->description), 0, 150) . '...' : strip_tags($item->description);
                                            @endphp</td>
                                            <td>
                                                <input type="checkbox" class="isActive"
                                                    {{ $item->isActive ? 'checked' : '' }} data-bootstrap-switch
                                                    data-off-color="danger" data-on-color="success" data-on-text="Ya"
                                                    data-off-text="Tidak" data-id="{{ $item->id }}">

                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a class="btn btn-sm btn-success ml-1 mr-1" data-toggle="tooltip"
                                                        data-placement="top" title="Lihat atau Edit"
                                                        href="{{ route('admin.patientRegistration.registrationMenu.edit', [$item->id]) }}">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-sm btn-danger ml-1 btn_delete"
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
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Aktif</th>
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
@endsection

@section('js_after')
    <script src="{{ asset('admin') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        const URL = {
            changeStatus: "{{ route('admin.patientRegistration.registrationMenu.changeStatus', ['id']) }}",
            delete: "{{ route('admin.patientRegistration.registrationMenu.delete', ['id']) }}"
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
                    window.location.replace(URL.delete.replace('id', id));
                }
            })
        });
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
        $(document).on('switchChange.bootstrapSwitch', '.isActive', function() {
            $("#card_loading").show()
            fetch(URL.changeStatus.replace('id', $(this).data('id')))
                .then(data => data.json()).then(() => {
                    $("#card_loading").hide()

                })
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
                    window.location.replace(URL.delete.replace('id', id));
                }
            })
        });

    </script>
@endsection
