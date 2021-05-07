@extends('admin.template.master')

@section('page_title', 'Tambah Dokter')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.department.index') }}">Spesialis</a></li>
    <li class="breadcrumb-item"><a
            href="{{ route('admin.department.doctor.index', ['id' => $data['department']->id]) }}">Dokter</a>
    </li>
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
                            <h3 class="card-title">Tambah Dokter Spesialis {{ $data['department']->title }}</h3>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <form action="{{ route('admin.department.doctor.add.post', ['id' => $data['department']->id]) }}"
                            enctype="multipart/form-data" method="POST">
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
                                    <div class="col-md-6 d-flex">
                                        <img id="blah" class="img-fluid" src="{{ asset('images/picture.svg') }}"
                                            alt="your image" />
                                    </div>
                                    <div class="col-md-6 d-flex">
                                        <div class="form-group col-md-12 my-auto">
                                            <label>Foto</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="imgInp" required
                                                    name="image">
                                                <label class="custom-file-label" for="imgInp">Foto Dokter</label>
                                                <small class="form-text text-muted">- Ukuran max 256KB</small>
                                                <small class="form-text text-muted">- Harus berupa gambar (format: jpg,
                                                    jpeg, svg,
                                                    png , dll)</small>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" value="{{ old('nama') }}"
                                                    placeholder="Nama" name="nama">
                                            </div>
                                            <div class="form-group">
                                                <label>Cuti?</label><br>
                                                <input type="checkbox" name="isLeave" data-bootstrap-switch
                                                    data-off-color="danger" data-off-text="Tidak" data-on-text="Ya"
                                                    data-on-color="success">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label for="deskripsi">Deskripsi</label>
                                <textarea id="summernote" name="deskripsi">{{ old('deskripsi') }}</textarea>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer d-flex">
                                <a class="btn btn-warning text-light"
                                    href="{{ route('admin.department.doctor.index', ['id' => $data['department']->id]) }}">Kembali</a>
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
    <script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
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

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    </script>
@endsection
