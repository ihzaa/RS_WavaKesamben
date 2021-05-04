@extends('admin.template.master')

@section('page_title', 'Layanan')

@section('breadcrumb')
    <li class="breadcrumb-item active">Pendaftaran Pasien</li>
    <li class="breadcrumb-item active">Pasien</li>
@endsection

@section('css_after')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.9.3/venobox.min.css"
        integrity="sha512-e+0yqAgUQFoRrJ4pZigQXpOE0S7J9IGwmgH801h4H5ODqOCG8/GRfXHQ+9ab754NL79O7wDwdjwY3CcU8sEANg=="
        crossorigin="anonymous" />
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Pasien</h3>
                        </div>
                        <div class="card-body">
                            <table id="main_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>No. Kartu</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No. Telfon</th>
                                        <th style="width: 10%">KTP</th>
                                        <th style="width: 10%">KK</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['item'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nomer }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                <a class="venobox" href="{{ asset($item->ktp) }}" data-toggle="tooltip"
                                                    data-placement="top" title="Klik untuk Lihat Gambar">
                                                    <img data-src="{{ asset($item->ktp) }}" class="img-fluid lazyload"
                                                        alt="GAMBAR KTP TIDAK VALID!">
                                                </a>
                                            </td>
                                            <td>
                                                <a class="venobox" href="{{ asset($item->kk) }}" data-toggle="tooltip"
                                                    data-placement="top" title="Klik untuk Lihat Gambar">
                                                    <img data-src="{{ asset($item->kk) }}" class="img-fluid lazyload"
                                                        alt="GAMBAR KTP TIDAK VALID!">
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                @if (!$item->accepted)
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-success mr-1 btn_acc"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Terima Pendaftaran" data-id="{{ $item->id }}">
                                                            <i class=" fas fa-check"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger ml-1 btn_rej"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Tolak Pendaftaran" data-id="{{ $item->id }}">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>

                                                @else
                                                    <button class="btn btn-sm btn-primary btn_resend" data-toggle="tooltip"
                                                        data-placement="top" title="Kirim Ulang Email"
                                                        data-id="{{ $item->id }}">
                                                        <i class="fas fa-paper-plane"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>No. Kartu</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No. Telfon</th>
                                        <th>KTP</th>
                                        <th>KK</th>
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
    <script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.9.3/venobox.min.js"
        integrity="sha512-zBTnX97k269iewUwROiWwO82A6uXO4lcjq0Z4xnvO+qAblC/RMQRUu8fQVKtSFhPNKD5Xzh9PMoZG7+LnmH1Hg=="
        crossorigin="anonymous"></script>

    <script>
        const URL = {
            accept: "{{ route('admin.patientRegistration.listPatient.accept.registration', ['id']) }}",
            reject: "{{ route('admin.patientRegistration.listPatient.reject.registration', ['id']) }}"
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
        $(document).ready(function() {
            $('.venobox').venobox();
            lazyload()
        });

        function sendMail(url, title) {
            Swal.fire({
                title: title,
                text: 'Anda tidak dapat membatalkan jika sudah menakan "Ya!"',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal.'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader();
                    window.location.replace(url);
                }
            })
        }

        $(document).on('click', '.btn_acc', function() {
            let id = $(this).data('id')
            sendMail(URL.accept.replace('id', id), 'Yakin Menerima Pendaftaran?')
        });

        $(document).on('click', '.btn_resend', function() {
            let id = $(this).data('id')
            sendMail(URL.accept.replace('id', id), 'Yakin Mengirim Ulang Email?')

        });

        $(document).on('click', '.btn_rej', function() {
            let id = $(this).data('id')
            sendMail(URL.reject.replace('id', id), 'Yakin Menolak Pendaftaran?')

        })

    </script>
@endsection
