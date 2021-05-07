@extends('admin.template.master')

@section('page_title', 'Kualitas Mutu ' . $data['date']->name . ' ' . $data['date']->year)

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('admin.kualitas.index.tahun') }}">Kualitas</a>
    <a class="breadcrumb-item"
        href="{{ route('admin.kualitas.index.bulan', ['id' => $data['date']->kualitas_mutu_tahun_id]) }}">Bulan</a>
    <li class="breadcrumb-item active">Data</li>
@endsection

@section('css_after')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
                <div class="col-md-12">
                    <div class="row mb-4">
                        <div class="col-md-4 mx-auto">
                            <button class="btn btn-block btn-primary" id="btn_tambah_data"
                                data-month_id="{{ $data['date']->id }}"><i class="fas fa-plus"></i>
                                Tambah</button>
                        </div>
                    </div>
                    @if (count($data['data']) == 0)
                        <h1 class="text-center">Data tidak ditemukan.</h1>
                    @endif
                    <div class="row">
                        @foreach ($data['data'] as $item)
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="card card-danger shadow-lg">
                                    <div class="card-header">
                                        <h3 class="card-title"><strong>Kualitas Mutu</strong></h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                                    class="fas fa-chart-bar"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body text-center">
                                        <div>
                                            <h2>{{ $item->name }}</h2>
                                        </div>
                                        <div class="d-flex">
                                            <a class="btn btn-sm btn-info mr-1 venobox mx-auto"
                                                href="{{ asset($item->image) }}" data-toggle="tooltip"
                                                data-placement="top" title="Lihat Data">
                                                <i class="fas fa-image" aria-hidden="true"></i>
                                            </a>
                                            <button class="btn btn-sm btn-success ml-1 mr-1 btn_edit mx-auto"
                                                data-toggle="tooltip" data-placement="top" title="Edit"
                                                data-id="{{ $item->id }}" data-title="{{ $item->name }}"
                                                data-img="{{ $item->image }}" data-month_id="{{ $data['date']->id }}">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-hapus mx-auto"
                                                data-id="{{ $item->id }}" data-title="{{ $item->name }}"
                                                data-month_id="{{ $data['date']->id }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="main_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Judul</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="modal_form" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" required name="judul"
                                placeholder="Masukkan Judul">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <img id="blah" class="img-fluid" alt="your image" />
                            </div>
                            <div class="col-md-8 d-flex">
                                <div class="form-group col-md-12 my-auto">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imgInp" name="foto">
                                        <label class="custom-file-label" for="imgInp" id="label_foto">Pilih Foto</label>
                                        <small class="form-text text-muted">- Ukuran max 256KB</small>
                                        <small class="form-text text-muted">- Harus berupa gambar (format: jpg, jpeg, svg,
                                            png , dll)</small>
                                    </div>
                                </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.9.3/venobox.min.js"
        integrity="sha512-zBTnX97k269iewUwROiWwO82A6uXO4lcjq0Z4xnvO+qAblC/RMQRUu8fQVKtSFhPNKD5Xzh9PMoZG7+LnmH1Hg=="
        crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        @error('foto')
            Swal.fire({
            icon: "error",
            title: "Gagal",
            text: "{{ $message }}",
            });

            $("#judul").val("{{ old('judul') }}")
            $("#main_modal").modal("show");
        @enderror
        const URL = {
            add: "{{ route('admin.kualitas.add.data', ['month_id']) }}",
            defaultImage: "{{ asset('images/default/picture.svg') }}",
            basePath: "{{ asset('') }}",
            edit: "{{ route('admin.kualitas.edit.data', ['month_id', 'id']) }}",
            delete: "{{ route('admin.kualitas.delete.data', ['month_id', 'id']) }}"
        }

    </script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

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

        $(document).on('click', "#btn_tambah_data", function() {
            $("#modal_title").html('Tambah Data');
            $('#blah').attr('src', URL.defaultImage);
            $("#imgInp").attr('required', '')
            $("#judul").val('')
            $("#imgInp").val('')
            $("#label_foto").html('Pilih Foto')
            $("#modal_form").attr('action', URL.add.replace('month_id', $(this).data('month_id')));
            $("#main_modal").modal("show");
        });

        $(document).on('click', ".btn_edit", function() {
            let id = $(this).data('id')
            let img = $(this).data('img')
            $("#modal_title").html('Edit Data');
            $('#blah').attr('src', URL.basePath + img);
            $("#judul").val($(this).data('title'))
            $("#label_foto").html('Pilih Foto Untuk Merubah Gambar Lama')
            $("#imgInp").val('')
            $("#imgInp").removeAttr('required')
            $("#modal_form").attr('action', URL.edit.replace('month_id', $(this).data('month_id')).replace('id', $(
                this).data('id')));
            $("#main_modal").modal("show");
        });

        $(document).on('click', '.btn-hapus', function() {
            const id = $(this).data('id');
            const month_id = $(this).data('month_id');
            Swal.fire({
                title: 'Yakin menghapus data ' + $(this).data('title') + ' ?',
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
                    let temp = URL.delete.replace('month_id', $(this).data('month_id')).replace(
                        'id', $(this).data('id'));
                    window.location.replace(temp);

                }
            })
        });

        $(document).ready(function() {
            $('.venobox').venobox();
        });

    </script>
@endsection
