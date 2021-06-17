@extends('user.template.master')

@section('page_title', $data['item']->title)

@section('css_after')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page_title">
                        <h3>
                            {{ $data['item']->title }}
                        </h3>
                    </div>
                </div>
            </div>
            <form id="main_form"
                action="{{ route('user.patientRegistration.menuRegistration.post', [$data['item']->id]) }}" method="POST"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            Pendaftaran hanya dapat dilakukan 1 hari sebelumnya. Informasi pendaftaran akan dikirimkan
                            melalui email yang sama saat melakukan pendaftaran pasien.
                        </p>
                        <p>
                            @php
                                echo $data['item']->description;
                            @endphp
                        </p>
                    </div>
                    @csrf
                    <input type="hidden" name="nomer" id="nomerHidden">
                    <div class="col-md-12 card mb-3">
                        <div class="row mt-2">
                            <div class="col-md-12 mt-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Nomer Kartu</span>
                                    </div>
                                    <input type="text" class="form-control" id="nomer"
                                        placeholder="Nomer kartu RS Wava Husada" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" id="cek" type="button">Cek</button>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-12">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">Nomer Kartu</div>
                                    <div class="col-6 my-1">
                                        <input type="text" class="form-control" id="nomer"
                                            placeholder="Nomer kartu RS Wava Husada" required>
                                    </div>
                                    <div class="col-3 my-1">
                                        <button id="cek" type="button" class="genric-btn primary radius">Cek Nomer</button>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <hr>
                                <div class="form-group">
                                    <label for="name" class="text-dark">Nama Lengkap</label>
                                    <input value="" name="name" type="text" class="form-control " id="name"
                                        placeholder="Nama Lengkap" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="text-dark">Email</label>
                                    <input value="" name="email" type="email" class="form-control" id="email"
                                        placeholder="Email" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="text-dark">Nomer Telfon</label>
                                    <input name="phone" type="number" min="0" class="form-control" id="phone"
                                        placeholder="Nomer Telfon" readonly>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @foreach ($data['item']->form as $item)
                            @if ($item->type == 'text')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="{{ $item->id }}" class="text-dark">{{ $item->name }}</label>
                                        <input value="{{ old($item->id) }}" name="{{ $item->id }}" type="text"
                                            class="form-control @error($item->id) is-invalid @enderror"
                                            id="{{ $item->id }}" placeholder="Masukkan {{ $item->name }}" required>
                                    </div>
                                    @error($item->id)
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            @if ($item->type == 'email')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="{{ $item->id }}" class="text-dark">{{ $item->name }}</label>
                                        <input value="{{ old($item->id) }}" name="{{ $item->id }}" type="email"
                                            class="form-control @error($item->id) is-invalid @enderror"
                                            id="{{ $item->id }}" placeholder="Masukkan {{ $item->name }}" required>
                                    </div>
                                    @error($item->id)
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            @if ($item->type == 'number')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="{{ $item->id }}" class="text-dark">{{ $item->name }}</label>
                                        <input value="{{ old($item->id) }}" name="{{ $item->id }}" type="number"
                                            class="form-control @error($item->id) is-invalid @enderror"
                                            id="{{ $item->id }}" placeholder="Masukkan {{ $item->name }}" required>
                                    </div>
                                    @error($item->id)
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            @if ($item->type == 'file')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark" for="{{ $item->id }}">{{ $item->name }}</label>
                                        <input type="file" class="form-control-file  @error($item->id) is-invalid @enderror"
                                            id="{{ $item->id }}" name="{{ $item->id }}" required>
                                    </div>
                                    @error($item->id)
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                        @endforeach
                        <div class="col-md-12">
                            <hr>
                            <div class="row">
                                <div class="col-md-4 my-2">
                                    Klinik Spesialis
                                    <select class="select2 w-100" name="spesialis" id="spesialis" required>
                                        <option value="xx">Pilih Klinik Spesialis</option>
                                        @foreach ($data['spesialis'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 my-2">
                                    Dokter
                                    <select class="select2 w-100" name="dokter" id="dokter" disabled required>
                                        <option value="xx">Pilih Dokter</option>
                                    </select>
                                </div>
                                <div class="col-md-4 my-2">
                                    Waktu Praktik
                                    <select class="select2 w-100" name="time" id="time" disabled required>
                                        <option value="xx">Pilih Waktu Praktik</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 mt-2 mb-2">
                            <button type="submit" class="boxed-btn3">Kirim</button>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </section>
@endsection

@section('js_after')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @if (Session::get('icon'))
        <script>
            Swal.fire({
                icon: "{{ Session::get('icon') }}",
                title: "{{ Session::get('title') }}",
                text: "{{ Session::get('text') }}",
            });

        </script>
    @endif

    <script>
        URL.getPatientData = "{{ route('user.patientRegistration.getPatientData', ['nomer']) }}"
        URL.getDoctorPerDepartment = "{{ route('user.patientRegistration.getDoctorPerDepartment', ['__id']) }}"
        URL.getDoctorSchedule = "{{ route('user.patientRegistration.getDoctorSchedule', ['__id']) }}"

        $("#cek").click(function() {
            if ($("#nomer").val() != '') {
                fetch(URL.getPatientData.replace('nomer', $("#nomer").val()))
                    .then(resp => {
                        if (resp.status == 500) {
                            throw resp.statusText
                        }
                        return resp.json()
                    })
                    .then(data => {
                        Swal.fire({
                            icon: "success",
                            title: "Nomer Kartu Ditemukan!",
                        });
                        $("#nomerHidden").val(data.data.nomer)
                        $('#name').val(data.data.name)
                        $("#email").val(data.data.email)
                        $("#phone").val(data.data.phone)
                    })
                    .catch(err => {
                        Swal.fire({
                            icon: "error",
                            title: "Nomer Kartu Tidak Ditemukan!",
                        });
                    })
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Mohon isi nomer kartu terlebih dahulu!",
                });
            }
        })
        $(document).ready(function() {
            $('.select2').select2();

            $('#spesialis').on('change', function(e) {
                $("#page_loader").show();
                let val = $(this).val()
                if (val != '') {
                    fetch(URL.getDoctorPerDepartment.replace('__id', val))
                        .then(resp => resp.json())
                        .then(data => {
                            let select2Element = "#dokter"
                            $(select2Element).html('<option value="xx">Pilih Dokter</option>')
                            data.data.forEach(el => {
                                $(select2Element).append(
                                    `<option value="${el.id}">${el.name}</option>`)
                            });
                            if (data.data.length == 0) {
                                $(select2Element).append(`<option disabled>Tidak ada data.</option>`)
                            }
                            $(select2Element).removeAttr('disabled')
                        })
                        .then(() => {
                            $("#page_loader").hide();
                        })
                }
            })

            $("#dokter").on('change', function(e) {
                $("#page_loader").show();
                let val = $(this).val()
                if (val != '') {
                    fetch(URL.getDoctorSchedule.replace('__id', val))
                        .then(resp => resp.json())
                        .then(data => {
                            let select2Element = "#time"
                            $(select2Element).html('<option value="xx">Pilih Waktu Praktik</option>')
                            data.data.forEach(el => {
                                $(select2Element).append(
                                    `<option value="${el.id}">${el.days}, ${moment(el.start,"hh:mm:ss").format("HH:mm")} - ${moment(el.end,"hh:mm:ss").format("HH:mm")}</option>`
                                )
                            });
                            if (data.data.length == 0) {
                                $(select2Element).append(`<option disabled>Tidak ada data.</option>`)
                            }
                            $(select2Element).removeAttr('disabled')
                        })
                        .then(() => {
                            $("#page_loader").hide();
                        })
                }
            })

            $("#main_form").submit(function() {
                if ($("#nomerHidden").val() == "") {
                    event.preventDefault()
                    Swal.fire({
                        icon: "error",
                        title: "Mohon isi nomer kartu terlebih dahulu dan tekan tombol Cek Nomer!",
                    });
                    return
                }
                if ($("#spesialis").val() == "xx") {
                    event.preventDefault()
                    Swal.fire({
                        icon: "error",
                        title: "Mohon pilih klinik spesialis!",
                    });
                    return
                }
                if ($("#dokter").val() == "xx") {
                    event.preventDefault()
                    Swal.fire({
                        icon: "error",
                        title: "Mohon pilih dokter!",
                    });
                    return
                }
                if ($("#time").val() == "xx") {
                    event.preventDefault()
                    Swal.fire({
                        icon: "error",
                        title: "Mohon pilih waktu praktik!",
                    });
                    return
                }
                $("#page_loader").show();
            })
        });

    </script>
@endsection
