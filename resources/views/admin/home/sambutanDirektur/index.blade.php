@extends('admin.template.master')

@section('page_title', 'Sambutan Direktur')

@section('breadcrumb')
    <li class="breadcrumb-item active">Halaman Home</li>
    <li class="breadcrumb-item active">Sambutan Direktur</li>
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
                            Sambutan Direktur
                        </div>
                        <form action="{{ route('admin.home.sambutanDirektur.edit') }}" method="POST"
                            enctype="multipart/form-data" id="main_form">
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nama">Nama Direktur <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                id="nama" name="nama" required placeholder="Masukkan Nama Direktur"
                                                value="{{ $data['item']->name }}">
                                            @error('nama')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <img id="blah" src="{{ asset($data['item']->image) }}" class="img-fluid"
                                            alt="your image" />
                                    </div>
                                    <div class="col-md-8 d-flex">
                                        <div class="form-group col-md-12 my-auto">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('foto') is-invalid @enderror"
                                                    id="imgInp" name="foto">
                                                <label class="custom-file-label" for="imgInp" id="label_foto">Pilih
                                                    Untuk Merubah Foto</label>
                                                @error('foto')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">- Ukuran max 256KB</small>
                                                <small class="form-text text-muted">- Harus berupa gambar (format: jpg,
                                                    jpeg, svg,
                                                    png , dll)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi / Sambutan</label>
                                            <textarea type="text" class="form-control" id="summernote" name="deskripsi"
                                                placeholder="Masukkan deskripsi / sambutan">@php
                                                    echo $data['item']->description;
                                                @endphp</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-muted text-right">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js_after')
    <script src="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
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

        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Masukkan deskripsi / sambutan',
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

            $("#main_form").submit(function() {
                if ($('#summernote').summernote('isEmpty')) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Deskripsi / Sambutan Tidak Boleh Kosong",
                    });
                    event.preventDefault();
                }
            })
        });

    </script>
@endsection
