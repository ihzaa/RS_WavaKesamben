@extends('admin.template.master')

@section('page_title', 'Banner')

@section('breadcrumb')
    <li class="breadcrumb-item active">Halaman Home</li>
    <li class="breadcrumb-item active">Banner</li>
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
                            <h3 class="card-title">List Banner</h3>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <button class="btn btn-primary btn-sm" id="btn_tambah"><i class="fas fa-plus"></i>
                                    Tambah</button>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="main_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['item'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="title">{{ $item->title }}</td>
                                            <td class="desc">{{ $item->description ? $item->description : '-' }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-info mr-1 venobox"
                                                    href="{{ asset($item->image) }}" data-toggle="tooltip"
                                                    data-placement="top" title="Lihat Gambar">
                                                    <i class="fas fa-image" aria-hidden="true"></i>
                                                </a>
                                                <button class="btn btn-sm btn-success ml-1 mr-1 btn_edit"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"
                                                    data-id="{{ $item->id }}" data-img="{{ $item->image }}">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger ml-1 btn_delete" data-toggle="tooltip"
                                                    data-placement="top" title="Hapus" data-id="{{ $item->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>


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
                            <label for="judul">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="judul" name="judul" required
                                placeholder="Masukkan Judul">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea type="text" class="form-control" id="deskripsi" name="deskripsi"
                                placeholder="Masukkan deskripsi (opsional)"></textarea>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.9.3/venobox.min.js"
        integrity="sha512-zBTnX97k269iewUwROiWwO82A6uXO4lcjq0Z4xnvO+qAblC/RMQRUu8fQVKtSFhPNKD5Xzh9PMoZG7+LnmH1Hg=="
        crossorigin="anonymous"></script>


    <script>
        @error('foto')
            Swal.fire({
            icon: "error",
            title: "Gagal",
            text: "{{ $message }}",
            });
        @enderror
        const URL = {
            add: "{{ route('admin.home.carousel.add.post') }}",
            defaultImage: "{{ asset('images/default/picture.svg') }}",
            basePath: "{{ asset('') }}",
            edit: "{{ route('admin.home.carousel.edit.post', ['id']) }}",
            delete: "{{ route('admin.home.carousel.delete') }}"
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

        $("#btn_tambah").click(function() {
            $("#modal_title").html('Tambah Banner');
            $('#blah').attr('src', URL.defaultImage);
            $("#imgInp").attr('required', '')
            $("#judul").val('')
            $("#imgInp").val('')
            $("#deskripsi").val('')
            $("#label_foto").html('Pilih Foto')
            $("#modal_form").attr('action', URL.add);
            $("#main_modal").modal("show");
        });

        $(".btn_edit").click(function() {
            let id = $(this).data('id')
            let img = $(this).data('img')
            $("#modal_title").html('Edit Banner');
            $('#blah').attr('src', URL.basePath + img);
            $("#judul").val($($(this).parents()[1]).find('.title').html())
            let desc = $($(this).parents()[1]).find('.desc').html()
            $("#deskripsi").val(desc == '-' ? '' : desc)
            $("#label_foto").html('Pilih Foto Untuk Merubah Gambar Lama')
            $("#imgInp").val('')
            $("#imgInp").removeAttr('required')
            $("#modal_form").attr('action', URL.edit.replace('id', id));
            $("#main_modal").modal("show");
        });

        $(document).on('click', '.btn_delete', function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Yakin menghapus ' + $($(this).parents()[1]).find('.title').html() + ' ?',
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
                    fetch(URL.delete, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        })
                        .then((resp) => resp.json())
                        .finally(() => {
                            location.reload();
                        })
                }
            })
        });

        $(document).ready(function() {
            $('.venobox').venobox();
        });

    </script>
@endsection
