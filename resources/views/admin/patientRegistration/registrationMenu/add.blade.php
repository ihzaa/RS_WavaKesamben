@extends('admin.template.master')

@section('page_title', 'Tambah Layanan')

@section('breadcrumb')
    <li class="breadcrumb-item active">Pendaftaran Pasien</li>
    <li class="breadcrumb-item active"><a href="{{ route('admin.patientRegistration.registrationMenu.index') }}">Menu
            Pendaftaran</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('css_after')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.patientRegistration.registrationMenu.add.post') }}" method="POST"
                        enctype="multipart/form-data" id="main_form">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Menu Pendaftaran Baru</h3>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @csrf
                                <div class="form-group">
                                    <label>Judul <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Judul" name="judul" required
                                        value="{{ old('judul') }}">
                                    {{-- <small class="form-text text-muted">Disarankan kurang dari 100 karakter.</small> --}}
                                </div>
                                <label for="">Deskripsi <span class="text-danger">*</span></label>
                                <textarea id="summernote" name="deskripsi">{{ old('deskripsi') }}</textarea>
                            </div>
                            <!-- /.card-body -->
                            {{-- <div class="card-footer d-flex">

                            </div> --}}


                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Form Menu Pendaftaran (<span class="text-danger">Form yang sudah disimpan tidak dapat diubah</span>)</h3>
                            </div>
                            <div class="card-body">
                                <p class="card-text mb-0">
                                    Setiap menu pendaftaran otomatis memiliki form:
                                    <small>
                                        <ol>
                                            <li>Nomer Kartu RS Wava Husada</li>
                                            <li>Pemilihan klinik spesialis, dokter, dan jam</li>
                                        </ol>
                                    </small>
                                    <span class="text-danger">Minimal Memiliki 1 buah form</span>


                                </p>
                                <div id="input_form_wrapper">
                                    <div class="form-row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label for="">Nama Form</label>
                                                <input type="text" class="form-control" id="" placeholder="Nama Form"
                                                    name="nama_form[]" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputState">Jenis Form</label>
                                                <select id="inputState" class="form-control" name="jenis_form[]" required>
                                                    <option selected value="text">text</option>
                                                    <option value="email">email</option>
                                                    <option value="number">nomer</option>
                                                    <option value="file">file/berkas</option>

                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-1 d-flex">
                                            <button class="btn btn-sm btn-danger btn-block my-auto" data-toggle="tooltip"
                                                data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <a class="btn btn-primary" id="btn_tambah_form"><i class="fas fa-plus"></i> Tambah
                                        Form</a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <a class="btn btn-warning text-light"
                                href="{{ route('admin.patientRegistration.registrationMenu.index') }}"><i
                                    class="fas fa-arrow-left    "></i> Kembali</a>
                            <button class="ml-auto btn btn-primary" type="submit"><i class="fas fa-save"></i>
                                Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
@endsection

@section('js_after')
    <script src="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Masukkan Deskripsi disini',
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            });
        });
        $('[data-toggle="tooltip"]').tooltip()

        $("#btn_tambah_form").click(function() {
            $('#input_form_wrapper').append(`
                        <div class="form-row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="">Nama Form</label>
                                                            <input type="text" class="form-control" id="" placeholder="Nama Form"
                                                                name="nama_form[]" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="inputState">Jenis Form</label>
                                                            <select id="inputState" class="form-control" name="jenis_form[]" required>
                                                                <option selected value="text">text</option>
                                                                <option value="email">email</option>
                                                                <option value="number">nomer</option>
                                                                <option value="file">file/berkas</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 d-flex">
                                                        <a class="btn btn-sm btn-danger btn-block my-auto btn_delete_form" data-toggle="tooltip"
                                                            data-placement="top" title="Hapus"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </div>
                        `)
        })

        $(document).on('click', '.btn_delete_form', function() {
            $(this).parent().parent().remove()
        });

        $('#main_form').submit(function() {
            if ($('#summernote').summernote('isEmpty')) {
                event.preventDefault();
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Deskripsi Tidak Boleh Kosong",
                });
            }
        })

    </script>
@endsection
