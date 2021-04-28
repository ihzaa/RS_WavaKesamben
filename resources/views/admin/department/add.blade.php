@extends('admin.template.master')

@section('page_title', 'Tambah Klinik Spesialis')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.department.index') }}">Spesialis</a></li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Klinik Spesialis</h3>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <form action="{{ route('admin.department.add.post') }}" enctype="multipart/form-data"
                            method="POST">
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
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Nama Klinik Spesialis</label>
                                            <input type="text" class="form-control" placeholder="Nama" name="nama">
                                        </div>
                                        <div class="form-group">
                                            <label for="quotes">Kutipan</label>
                                            <textarea class="form-control" name="quotes"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-7 d-flex">
                                        <div class="col-md-6">
                                            <img id="blah" class="img-fluid" src="{{ asset('images/picture.svg') }}"
                                                alt="your image" />
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group col-md-12 my-auto">
                                                <label>Logo Klinik Spesialis</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="imgInp" required
                                                        name="logo">
                                                    <label class="custom-file-label" for="imgInp">Logo Spesialis</label>
                                                    <small class="form-text text-muted">- Ukuran max 256KB</small>
                                                    <small class="form-text text-muted">- Harus berupa gambar (format: jpg,
                                                        jpeg, svg,
                                                        png , dll)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label for="deskripsi">Deskripsi</label>
                                <textarea id="summernote" name="deskripsi"></textarea>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer d-flex">
                                <button class="ml-auto btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js_after')
    <script src="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
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
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            });
        });
        bsCustomFileInput.init();

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });

    </script>
@endsection
