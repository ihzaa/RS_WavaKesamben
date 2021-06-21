@extends('admin.template.master')

@section('page_title', 'Menu Pendaftaran')

@section('breadcrumb')
    <li class="breadcrumb-item active">Pendaftaran Pasien</li>
    <li class="breadcrumb-item active">Pendaftaran</li>
@endsection

@section('css_after')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="overlay dark" id="main_loading" style="display: none;">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div>
                        <div class="overlay dark" id="card_loading" style="display: none">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">List Pendaftaran</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Jenis Pendaftaran</label>
                                        <select class="form-control select2" style="width: 100%;" id="jenis_pendaftaran">
                                            <option value="def">Semua</option>
                                            @foreach ($data['listTipe'] as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $data['category']['tipe'] == $item->id ? 'selected="selected"' : '' }}>
                                                    {{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Klinik Spesialis</label>
                                        <select class="form-control select2" style="width: 100%;" id="spesialis">
                                            <option value="def">Semua</option>
                                            @foreach ($data['listKlinik'] as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $data['category']['klinik'] == $item->id ? 'selected="selected"' : '' }}>
                                                    {{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="main_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Jenis Pendaftaran</th>
                                        <th>Kode Pendaftaran</th>
                                        <th>Nama Pendaftar</th>
                                        <th>Klinik Spesialis</th>
                                        <th>Nama Dokter</th>
                                        <th>Waktu Praktik</th>
                                        <th>Waktu Mendaftar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['item'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tipe }}</td>
                                            <td>{{ $item->kode_daftar }}</td>
                                            <td>{{ $item->pasien }}</td>
                                            <td>{{ $item->spesialis }}</td>
                                            <td>{{ $item->dokter }}</td>
                                            <td>{{ $item->days . ', ' . \Carbon\Carbon::parse($item->start)->format('H:i') . ' - ' . \Carbon\Carbon::parse($item->end)->format('H:i') }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('H:i - l, d M Y') }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-success ml-1 btn_detail"
                                                        data-toggle="tooltip" data-placement="top" title="Lihat Detail"
                                                        data-kode="{{ $item->kode_daftar }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pendaftaran</th>
                                        <th>Kode Pendaftaran</th>
                                        <th>Nama Pendaftar</th>
                                        <th>Klinik Spesialis</th>
                                        <th>Nama Dokter</th>
                                        <th>Waktu Praktik</th>
                                        <th>Waktu Mendaftar</th>
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
    <div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pendaftaran <span class="text-danger text-strong" id="kode">()</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">Jenis Pendaftaran </div>
                        <div class="col-md-9" id="jenis"></div>
                        <div class="col-md-3">Klinik Spesialis </div>
                        <div class="col-md-9" id="modal_spesialis"></div>
                        <div class="col-md-3">Nama Dokter </div>
                        <div class="col-md-9" id="dokter"></div>
                        <div class="col-md-3">Waktu Praktik</div>
                        <div class="col-md-9" id="waktu"></div>
                        <div class="col-md-12">
                            <hr>
                            <h5> Detail Pasien</h5>
                        </div>
                        <div class="col-md-3">Nomer Kartu</div>
                        <div class="col-md-9" id="nomer_kartu"></div>
                        <div class="col-md-3">Nama Pasien</div>
                        <div class="col-md-9" id="nama_pasien"></div>
                        <div class="col-md-3">Nomer Telfon</div>
                        <div class="col-md-9" id="nomer_telfon"></div>
                        <div class="col-md-12">
                            <hr>
                            <h5>Detail Form Pendaftaran</h5>
                        </div>
                    </div>
                    <div class="row" id="detail_form_pendaftaran">
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="action_button">
                        <button class="btn btn-primary" id="accept_registration_button">Terima Pendaftaran</button>
                        <button class="btn btn-danger" id="reject_registration_button">Tolak dan Hapus Data
                            Pendaftaran</button>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
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
    <script src="{{ asset('admin') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous"></script>
    <script>
        const URL = {
            current: "{{ route('admin.patientRegistration.patientRegistredList.index') }}",
            detail: "{{ route('admin.patientRegistration.patientRegistredList.get.detail', ['kode']) }}",
            asset: "{{ asset('/') }}",
            download: "{{ route('admin.patientRegistration.patientRegistredList.download.file', ['__id']) }}",
            accept: "{{ route('admin.patientRegistration.patientRegistredList.accept', ['__kode']) }}",
            reject: "{{ route('admin.patientRegistration.patientRegistredList.reject', ['__kode']) }}"

        }
    </script>

    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
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

        const search = () => {
            let searchParams = new URLSearchParams(window.location.search);
            if ($('#spesialis').val() != "def")
                searchParams.set('klinik', $('#spesialis').val())
            else
                searchParams.delete('klinik')
            if ($('#jenis_pendaftaran').val() != "def")
                searchParams.set('tipe', $('#jenis_pendaftaran').val())
            else
                searchParams.delete('tipe')
            let newParams = searchParams.toString()
            window.location.href = URL.current + '/?' + newParams
        }

        $(document).on("change", '#jenis_pendaftaran', search)

        $(document).on("change", '#spesialis', search)

        $(document).on("click", '.btn_detail', function() {
            let kode = $(this).data('kode')
            $("#main_loading").show()
            fetch(URL.detail.replace('kode', kode))
                .then((resp) => resp.json())
                .then(data => {
                    $("#kode").html(`(${data.main_info.kode_daftar})`)
                    $("#jenis").html(data.main_info.menu_name)
                    $("#modal_spesialis").html(data.main_info.department_name)
                    $("#dokter").html(data.main_info.doctor_name)
                    $("#accept_registration_button").attr("data-id", data.main_info.kode_daftar);
                    $("#reject_registration_button").attr("data-id", data.main_info.kode_daftar);
                    let time = '';
                    if (data.main_info.end == null) {
                        time = data.main_info.days + ', ' + moment(data.main_info.start, "HH:mm:ss").format(
                                "HH:mm") +
                            ' - selesai'
                    } else {
                        time = data.main_info.days + ', ' + moment(data.main_info.start, "HH:mm:ss").format(
                                "HH:mm") +
                            ' - ' + moment(data.main_info.end, "HH:mm:ss").format("HH:mm")
                    }
                    $("#waktu").html(time)
                    $("#nomer_kartu").html(data.main_info.nomer)
                    $("#nama_pasien").html(data.main_info.patient_name)
                    $("#nomer_telfon").html(data.main_info.phone)
                    let answare = ""
                    for (const i in data.detail) {
                        if (data.detail[i].type == 'file') {
                            answare +=
                                `<div class="col-md-3">${data.detail[i].name}</div><div class="col-md-9 text-left"><a target="_blank" href="${URL.download.replace('__id',data.detail[i].id_data)}"><img src="${URL.asset+data.detail[i].answare}" style="max-height: 100px" alt="Tidak dapat menampilkan, klik untuk mengunduh"><a/></div>`
                        } else {
                            answare +=
                                `<div class="col-md-3">${data.detail[i].name}</div><div class="col-md-9">${data.detail[i].answare}</div>`
                        }
                    }
                    $("#detail_form_pendaftaran").html(answare)
                    if (data.main_info.is_accept) {
                        $("#action_button").hide()
                    } else {
                        $("#action_button").show()
                    }
                }).then(() => {
                    $('#modal_detail').modal('show')
                    $("#main_loading").hide()

                })
        })

        @if (Session::get('kode_daftar'))
            function showModal(){
            let kode = "{{ Session::get('kode_daftar') }}"
            $("#main_loading").show()
            fetch(URL.detail.replace('kode', kode))
            .then((resp) => resp.json())
            .then(data => {
            $("#kode").html(`(${data.main_info.kode_daftar})`)
            $("#jenis").html(data.main_info.menu_name)
            $("#modal_spesialis").html(data.main_info.department_name)
            $("#dokter").html(data.main_info.doctor_name)
            $("#accept_registration_button").attr("data-id", data.main_info.kode_daftar);
            $("#reject_registration_button").attr("data-id", data.main_info.kode_daftar);
            let time = '';
            if (data.main_info.end == null) {
            time = data.main_info.days + ', ' + moment(data.main_info.start, "HH:mm:ss").format(
            "HH:mm") +
            ' - selesai'
            } else {
            time = data.main_info.days + ', ' + moment(data.main_info.start, "HH:mm:ss").format(
            "HH:mm") +
            ' - ' + moment(data.main_info.end, "HH:mm:ss").format("HH:mm")
            }
            $("#waktu").html(time)
            $("#nomer_kartu").html(data.main_info.nomer)
            $("#nama_pasien").html(data.main_info.patient_name)
            $("#nomer_telfon").html(data.main_info.phone)
            let answare = ""
            for (const i in data.detail) {
            if (data.detail[i].type == 'file') {
            answare +=
            `<div class="col-md-3">${data.detail[i].name}</div>
            <div class="col-md-9 text-left"><a target="_blank"
                    href="${URL.download.replace('__id',data.detail[i].id_data)}"><img src="${URL.asset+data.detail[i].answare}"
                        style="max-height: 100px" alt="Tidak dapat menampilkan, klik untuk mengunduh"><a /></div>`
            } else {
            answare +=
            `<div class="col-md-3">${data.detail[i].name}</div>
            <div class="col-md-9">${data.detail[i].answare}</div>`
            }
            }
            $("#detail_form_pendaftaran").html(answare)
            if (data.main_info.is_accept) {
            $("#action_button").hide()
            } else {
            $("#action_button").show()
            }
            }).then(() => {
            $('#modal_detail').modal('show')
            $("#main_loading").hide()

            })
            }
            showModal();
        @endif


        $(document).on('click', '#accept_registration_button', function() {
            const kode = $(this).data('id');
            Swal.fire({
                title: 'Yakin menerima pendaftaran pasien?',
                text: "Anda tidak dapat mengembalikan setelah menyetujui!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal.'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader();
                    window.location.replace(URL.accept.replace('__kode', kode));
                }
            })
        })

        $(document).on('click', '#reject_registration_button', function() {
            const kode = $(this).data('id');
            Swal.fire({
                title: 'Yakin menolak pendaftaran pasien?',
                text: "Anda tidak dapat mengembalikan setelah menyetujui!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal.'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader();
                    window.location.replace(URL.reject.replace('__kode', kode));

                }
            })
        })
    </script>
@endsection
