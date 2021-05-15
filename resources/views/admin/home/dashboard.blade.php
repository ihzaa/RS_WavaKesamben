@extends('admin.template.master')

@section('page_title', 'Beranda')

@section('css_after')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/loading.css@v2.0.0/dist/loading.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger @if ($data['newPatient']> 0) ld
                        ld-heartbeat @endif" id="box_new_patient">
                        <div class="inner">
                            <h3 class="d-flex"><span id="newPatientCount">{{ $data['newPatient'] }}</span>
                                <ion-icon id="refresh_new_patient" name="refresh-outline" size="small" class="ml-auto"
                                    style="cursor: pointer"></ion-icon>
                            </h3>
                            <p>Pasien Baru</p>

                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="overlay dark" id="loading_new_patient" style="display: none;">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div>
                        <a href="{{ route('admin.patientRegistration.listPatient.index') }}"
                            class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $data['total_patient'] }}</h3>

                            <p>Total Pasien</p>
                        </div>
                        <div class="icon">
                            <i class="fas fas fa-procedures"></i>
                        </div>
                        <a href="{{ route('admin.patientRegistration.patientRegistredList.index') }}"
                            class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $data['total_product'] }}</h3>

                            <p>Produk Unggulan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-people-carry"></i>
                        </div>
                        <a href="{{ route('admin.featuredproduct.index') }}" class="small-box-footer">Lihat <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $data['total_department'] }}</h3>

                            <p>Klinik Spesialis</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clinic-medical"></i>
                        </div>
                        <a href="{{ route('admin.department.index') }}" class="small-box-footer">Lihat <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $data['total_service'] }}</h3>

                            <p>Layanan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-smile-beam"></i>
                        </div>
                        <a href="{{ route('admin.services.index') }}" class="small-box-footer">Lihat <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $data['total_doctor'] }}</h3>

                            <p>Dokter</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-smile-beam"></i>
                        </div>
                        <div class="form-group small-box-footer">
                            {{-- <label>Minimal (.select2-danger)</label> --}}
                            <select class="form-control select2 bg-transparent border-transparent"
                                style="font-size:16px; padding:0px" data-dropdown-css-class="select2-danger"
                                style="width: 100%;">
                                <option></option>
                                @foreach ($data['doctor'] as $i)
                                    <option data-id="{{ $i->id }}" data-department="{{ $i->department_id }}">
                                        {{ $i->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mt-3">
                    <h4>Cari Dokter</h4>
                    <div class="form-group">
                        {{-- <label>Minimal (.select2-danger)</label> --}}
                        <select class="form-control select2" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option></option>
                            @foreach ($data['doctor'] as $i)
                                <option data-id="{{ $i->id }}" data-department="{{ $i->department_id }}">
                                    {{ $i->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Button trigger modal -->
@endsection

@section('js_after')
    <script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        const CONST_URL = {
            refresh: "{{ route('admin.getUnprocessedPatient') }}",
            doctor: "{{ route('admin.department.doctor.edit', ['id', 'dokter_id']) }}"
        }
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })

            // $('#promo').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": true,
            //     "ordering": true,
            //     "info": false,
            //     "autoWidth": false,
            //     "responsive": true,
            // });
        });
        $(document).on("click", "#refresh_new_patient", function() {
            $('#loading_new_patient').show();
            fetch(CONST_URL.refresh, {
                    headers: {
                        'Cache-Control': 'no-cache'
                    }
                }).then((result) => result.json())
                .then((data) => {
                    $("#newPatientCount").html(data)
                    if (data != 0) {
                        $("#box_new_patient").addClass('ld ld-heartbeat');
                    } else {
                        $("#box_new_patient").removeClass('ld ld-heartbeat');
                    }
                }).then(() => {
                    $('#loading_new_patient').hide();
                }).catch((err) => {
                    console.log(err);
                });
        })

        $(document).on('change', '.select2', function() {
            let temp = CONST_URL.doctor
            temp = temp.replace('dokter_id', $(this).find(':selected').data('id'))
            temp = temp.replace('id', $(this).find(':selected').data('department'))
            window.location.replace(temp)
        });

    </script>
@endsection
