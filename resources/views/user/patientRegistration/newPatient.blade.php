@extends('user.template.master')

@section('page_title', 'Daftar Pasien Baru')

@section('content')
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page_title">
                        <h3>
                            Daftar Pasien Baru
                        </h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('user.patientRegistration.newPatient.post') }}" method="POST"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            Informasi nomer kartu RS Wava Husada Kesamben akan dikirimkan melalui email yang anda inputkan.
                        </p>
                    </div>
                </div>
                <div class="row py-2">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="text-dark">Nama Lengkap</label>
                            <input value="{{ old('name') }}" name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Masukkan Nama Lengkap" required>
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="text-dark">Email</label>
                            <input value="{{ old('email') }}" name="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="Masukkan Email" required>
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone" class="text-dark">Nomer Telfon</label>
                            <input value="{{ old('phone') }}" name="phone" type="number" min="0"
                                class="form-control @error('phone') is-invalid @enderror" id="phone"
                                placeholder="Masukkan Nomer Telefon" required>
                        </div>
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-dark" for="ktp">Scan KTP <small>(Format png/jpg/jpeg | Ukuran max.
                                    256KB)</small></label>
                            <input type="file" class="form-control-file  @error('ktp') is-invalid @enderror" id="ktp"
                                name="ktp" required>
                        </div>
                        @error('ktp')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-dark" for="kk">Scan Kartu Keluarga <small>(Format png/jpg/jpeg | Ukuran max.
                                    256KB)</small></label>
                            <input type="file" class="form-control-file  @error('kk') is-invalid @enderror" id="kk"
                                name="kk" required>
                        </div>
                        @error('kk')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-12 mt-2">
                        <button type="submit" class="boxed-btn3">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('js_after')


    @if (Session::get('icon'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            Swal.fire({
                icon: "{{ Session::get('icon') }}",
                title: "{{ Session::get('title') }}",
                text: "{{ Session::get('text') }}",
            });

        </script>
    @endif
@endsection
