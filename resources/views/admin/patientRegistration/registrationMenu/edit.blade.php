@extends('admin.template.master')

@section('page_title', 'Tambah Layanan')

@section('breadcrumb')
    <li class="breadcrumb-item active">Pendaftaran Pasien</li>
    <li class="breadcrumb-item active"><a href="{{ route('admin.patientRegistration.registrationMenu.index') }}">Menu
            Pendaftaran</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('css_after')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.patientRegistration.registrationMenu.edit.post', [$data['item']->id]) }}"
                        method="POST" enctype="multipart/form-data" id="main_form">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Menu Pendaftaran Baru</h3>
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
                                        value="{{ $data['item']->title }}">
                                    {{-- <small class="form-text text-muted">Disarankan kurang dari 100 karakter.</small> --}}
                                </div>
                                <label for="">Deskripsi <span class="text-danger">*</span></label>
                                <textarea id="summernote" name="deskripsi">{{ $data['item']->description }}</textarea>
                            </div>
                            <!-- /.card-body -->
                            {{-- <div class="card-footer d-flex">

                            </div> --}}


                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Form Menu Pendaftaran</h3>
                            </div>
                            <div class="card-body">
                                <div id="input_form_wrapper">
                                    @foreach ($data['form'] as $item)
                                        <div class="form-row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="">Nama Form</label>
                                                    <input type="text" class="form-control" id="" placeholder="Nama Form"
                                                        disabled value="{{ $item->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="inputState">Jenis Form</label>
                                                    <select id="inputState" class="form-control" disabled>
                                                        <option {{ $item->type == 'text' ? 'selected' : '' }} value="text">text
                                                        </option>
                                                        <option {{ $item->type == 'email' ? 'selected' : '' }} value="email">
                                                            email</option>
                                                        <option {{ $item->type == 'number' ? 'selected' : '' }} value="number">
                                                            nomer</option>
                                                        <option {{ $item->type == 'file' ? 'selected' : '' }} value="file">
                                                            file/berkas</option>

                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-1 d-flex">
                                            <button class="btn btn-sm btn-danger btn-block my-auto" data-toggle="tooltip"
                                                data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                                        </div> --}}
                                        </div>
                                    @endforeach

                                </div>
                                {{-- <div class="col-md-12 text-center">
                                    <a class="btn btn-primary" id="btn_tambah_form"><i class="fas fa-plus"></i> Tambah
                                        Form</a>
                                </div> --}}
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
