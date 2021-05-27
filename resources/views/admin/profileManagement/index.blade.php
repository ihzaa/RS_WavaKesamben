@extends('admin.template.master')

@section('page_title', 'Pengaturan Profile')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info" id="card_pass">
                    <div class="card-header">
                        <h3 class="card-title">Kelola Password</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Password Lama</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="pass1" placeholder="Password Lama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-4 col-form-label">Password Baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="pass2" placeholder="Password Baru">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="pass3"
                                    placeholder="Konfirmasi Password Baru">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-info" id="btn-simpan-pass">Simpan</button>
                    </div>
                    <!-- /.card-footer -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_after')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        const URL = {
            changePassword: "{{ route('admin.manageProfile.changePassword') }}"
        }

    </script>
    <script>
        $("#btn-simpan-pass").on("click", function() {
            let pass1 = $("#pass1").val();
            let pass2 = $("#pass2").val();
            let pass3 = $("#pass3").val();

            if (pass1 == "" || pass2 == "" || pass3 == "") {
                Swal.fire(
                    "Maaf!",
                    "Tidak boleh ada form password yang kosong!",
                    "error"
                );
                return;
            }

            if (pass2 != pass3) {
                Swal.fire("Maaf!", "Password konfirmasi tidak sama!", "error");
                return;
            }

            if(pass2.length < 6 || pass3.length < 6){
                Swal.fire("Maaf!", "Password minimal 6 digit!", "error");
                return
            }
            $("#card_pass").append(
                `<div class="overlay dark" id="pass_load"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>`);
            fetch(URL.changePassword, {
                    method: 'POST',
                    body: JSON.stringify({
                        old: pass1,
                        new: pass2
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                })
                .then(resp => resp.json())
                .then(response => {
                    if (response.status) {
                        Swal.fire("Berhasil!", "Password berhasil diubah!", "success");
                    } else {
                        Swal.fire("Maaf!", "Password lama tidak benar!", "error");
                    }
                })
                .catch(function(error) {
                    console.log(error);
                })
                .finally(function() {
                    $("#pass1").val("");
                    $("#pass2").val("");
                    $("#pass3").val("");
                    $("#pass_load").remove();
                });
        });

    </script>
@endsection
