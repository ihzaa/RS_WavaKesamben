@extends('user.template.master')

@section('page_title', 'Kontak')

@section('content')
    <!-- ================ contact section start ================= -->
    <section class="contact-section">
        <div class="container">
            <div class="d-sm-block mb-5 pb-4">
                <div class="section_title text-center mb-55">
                    <h3>Kontak Kami</h3>
                </div>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.533646780913!2d112.36390735054083!3d-8.148864394105573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78965b1809ced3%3A0x908fc5ca191a747b!2sRS.%20WAVA%20HUSADA%20KESAMBEN!5e0!3m2!1sen!2sid!4v1622635632588!5m2!1sen!2sid"
                    width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Pesan dan Kesan</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="{{ route('user.contact.add') }}" method="POST"
                        id="contactForm">
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                                    @error('message') is-invalid @enderror" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Masukkan kesan pesan'"
                                    placeholder="Maskukkan kesan pesan"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control valid" name="name" id="name" type="text" @error('name')
                                    is-invalid @enderror" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Masukkan nama anda'" placeholder="Masukkan nama anda">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Kirim</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="fa fa-home"></i></span>
                        <div class="media-body">
                            <h3>Jalan Kesamben Jugo No. 1, Kesamben, Kec. Kesamben, Blitar, Jawa Timur 66191</h3>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="fa fa-phone"></i></span>
                        <div class="media-body">
                            <h3><a href="{{ env('WA_link') }}"> 0813 1951 0008
                                </a></h3>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="fa fa-facebook-f"></i></span>
                        <div class="media-body">
                            <h3><a href="{{ env('FB_link') }}">
                                    @WAVAHUSADAKESAMBEN
                                </a></h3>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="fa fa-instagram"></i></span>
                        <div class="media-body">
                            <h3><a href="{{ env('IG_link') }}"> RSWAVAKESAMBEN
                                </a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
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
