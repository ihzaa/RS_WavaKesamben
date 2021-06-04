@extends('admin.template.master')

@section('page_title', 'Kualitas Mutu ' . $data['year']->year)

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('admin.kualitas.index.tahun') }}">Kualitas</a>
    <li class="breadcrumb-item active">Bulan</li>
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
                            <button class="btn btn-block btn-primary" id="btn_tambah_bulan"
                                data-year="{{ $data['year']->id }}"><i class="fas fa-plus"></i>
                                Tambah</button>
                        </div>
                    </div>
                    @if (count($data['month']) == 0)
                        <h1 class="text-center">Data tidak ditemukan.</h1>
                    @endif
                    <div class="row">
                        @foreach ($data['month'] as $item)
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="info-box bg-gradient-warning text-light">
                                    <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Kualitas Mutu</span>
                                        <h2 class="info-box-number">{{ $item->name }}</h2>

                                        <div class="progress">
                                            <hr>
                                        </div>
                                        <span class="progress-description d-flex">
                                            <button class="btn btn-primary btn-edit btn-sm mx-auto"
                                                data-id="{{ $item->id }}" data-month="{{ $item->name }}"
                                                data-toggle="tooltip" data-placement="top" title="Edit Bulan"><i
                                                    class="fas fa-edit"></i>
                                            </button>
                                            <a class="btn btn-sm btn-info text-light mx-auto"
                                                href="{{ route('admin.kualitas.index.data', ['month_id' => $item->id]) }}"
                                                data-toggle="tooltip" data-placement="top" title="Lihat Data">
                                                <strong><i class="far fa-eye"></i></strong>
                                            </a>
                                            <button class="btn btn-sm btn-danger btn-hapus mx-auto"
                                                data-id="{{ $item->id }}" data-month="{{ $item->name }}"
                                                data-year="{{ $data['year']->year }}" data-toggle="tooltip"
                                                data-placement="top" title="Hapus Bulan"><i
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
                <form method="POST" id="form_bulan">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="judul">Bulan</label>
                            <input type="text" class="form-control" id="month" name="month" placeholder="Masukkan Bulan">
                            <span class="text-danger">*Contoh : Januari - Maret</span>
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
            addMonth: "{{ route('admin.kualitas.add.bulan', ['__id']) }}",
            editMonth: "{{ route('admin.kualitas.edit.bulan', ['__id']) }}",
            deleteMonth: "{{ route('admin.kualitas.delete.bulan', ['__id']) }}"
        }

    </script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        })

        $("#btn_tambah_bulan").click(function() {
            $("#form_bulan").attr('action', URL.addMonth.replace('__id', $(this).data('year')));
            $("#modal_title").html('Tambah Bulan');
            $("#month").val('')
            $("#main_modal").modal('show');
        });
        $(".btn-edit").click(function() {
            $("#form_bulan").attr('action', URL.editMonth.replace('__id', $(this).data('id')));
            $("#modal_title").html('Edit Bulan');
            $("#month").val($(this).data('month'))
            $("#main_modal").modal('show');
        });
        $(document).on('click', '.btn-hapus', function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Yakin menghapus data kualitas mutu ' + $(this).data('month') + ' ' + $(this).data(
                    'year') + '?',
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
                    window.location.replace(URL.deleteMonth.replace('__id', $(this).data('id')));
                }
            })
        });

    </script>
@endsection
