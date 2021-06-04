@extends('admin.template.master')

@section('page_title', 'Jadwal Praktek')

@section('breadcrumb')
    <li class="breadcrumb-item active"><a
            href="{{ route('admin.department.doctor.index', ['id' => $data['dokter']->department_id]) }}">Dokter</a></li>
    <li class="breadcrumb-item active">Jadwal</li>
@endsection

@section('css_after')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('admin') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <style>
    </style>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Jadwal Praktek {{ $data['dokter']->name }}</h3>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <button class="btn btn-block btn-primary" id="btn_tambah_jadwal"><i
                                        class="fas fa-plus"></i>Tambah</button>

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="main_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Hari</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['list'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->days }}</td>
                                            <td>{{ $item->start }}</td>
                                            <td>
                                                @if ($item->end != null)
                                                    {{ $item->end }}
                                                @else
                                                    Selesai
                                                @endif
                                            </td>
                                            <td class="d-flex">
                                                <button class="btn btn-sm btn-success mx-auto btn_edit_schedule"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"
                                                    data-id="{{ $item->id }}" data-days="{{ $item->days }}"
                                                    data-start="{{ $item->start }}" data-end="{{ $item->end }}">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger mx-auto btn_delete"
                                                    data-toggle="tooltip" data-placement="top" title="Hapus"
                                                    data-id="{{ $item->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Hari</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
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
                <form method="POST" id="form_schedule">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" hidden class="form-control" id="dokter_id" name="dokter_id" required
                                value="{{ $data['dokter']->id }}">
                            <label for="days">Hari<span class="text-danger">*</span></label>
                            <select class="select2" multiple="multiple" data-placeholder="Pilih hari" style="width: 100%;"
                                @error('days') is-invalid @enderror" id="days" name="days[]" required>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                            {{-- <textarea type="text" class="form-control @error('days') is-invalid @enderror" id="days"
                                name="days" required placeholder="Masukkan hari"></textarea> --}}
                            @error('days')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Mulai</label>
                                            <span class="text-danger">*</span>
                                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" @error('start')
                                                    is-invalid @enderror" id="start" name="start" required
                                                    data-target="#timepicker" placeholder="Masukkan jam mulai" />
                                                @error('start')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                                <div class="input-group-append" data-target="#timepicker"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Selesai</label>
                                            <div class="input-group date" id="timepicker-end" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" @error('end')
                                                    is-invalid @enderror" id="end" name="end" data-target="#timepicker-end"
                                                    placeholder="Masukkan jam berakhir" />
                                                @error('end')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                                <div class="input-group-append" data-target="#timepicker-end"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                    </div>
                                </div>
                                <span class="text-danger">*Kosongi kolom 'Selesai' apabila tidak ada jam selesai praktek
                                    yang spesifik</span>
                            </div>
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
    <script src="{{ asset('admin') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        const URL = {
            addSchedule: "{{ route('admin.jadwal.add') }}",
            editSchedule: "{{ route('admin.jadwal.edit', ['__id']) }}",
            deleteSchedule: "{{ route('admin.jadwal.delete', ['__id']) }}"
        }

    </script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            $('[data-toggle="tooltip"]').tooltip()
        })
        $("#btn_tambah_jadwal").click(function() {
            $('#days').select2({
                multiple: true,
                allowClear: true
            });
            $("#form_schedule").attr('action', URL.addSchedule);
            $("#modal_title").html('Tambah Jadwal Praktek');
            $("#days").attr('name', 'days[]')
            // $("#days").val(null);
            $("#days").val('').trigger('change')
            $("#start").val('');
            $("#end").val('');
            $("#main_modal").modal('show');
        });
        $(".btn_edit_schedule").click(function() {
            $('#days').select2({
                multiple: false,
                theme: 'bootstrap4'
            });
            $("#form_schedule").attr('action', URL.editSchedule.replace('__id', $(this).data('id')));
            $("#modal_title").html('Edit Jadwal Praktek');
            $('#days').val($(this).data('days'));
            $('#days').trigger('change.select2');
            $("#days").attr('name', 'days')
            $("#start").val($(this).data('start'))
            $("#end").val($(this).data('end'))
            $("#main_modal").modal('show');
        });
        $(document).on('click', '.btn_delete', function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Yakin ingin menghapus jadwal ini?',
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
                    window.location.replace(URL.deleteSchedule.replace('__id', $(this).data('id')));
                }
            })
        });

        $('#main_table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'HH:mm:ss',
        })
        $('#timepicker-end').datetimepicker({
            format: 'HH:mm:ss'
        })

    </script>
@endsection
