<style>
    #navigation li a {
        font-size: 11px;
    }

</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/loading.css@v2.0.0/dist/loading.min.css">
<div class="header-area ">
    {{-- <div class="header-top_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6 ">
                    <div class="social_media_links">
                        <a href="#">
                            <i class="fa fa-linkedin"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="short_contact_list">
                        <ul>
                            <li><a href="#"> <i class="fa fa-envelope"></i> info@docmed.com</a></li>
                            <li><a href="#"> <i class="fa fa-phone"></i> 160160</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div id="sticky-header" class="main-header-area">
        <div class="container-fluid px-5">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-2">
                    <div class="logo">
                        <a href="{{ route('user.home') }}">
                            <img class="img-fluid" src="{{ asset('images/default/logo-hijau.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-10">
                    <div class="main-menu  d-none d-lg-block">
                        <nav>
                            <ul id="navigation">
                                <li><a class="active">Profil <i class="ti-angle-down"></i></a>
                                    <ul class="submenu" id="profile_submenu">
                                        <li><a href="{{ route('user.profile.sambutan-direktur') }}">Sambutan
                                                Direktur</a></li>
                                        <li class="text-center loadingsubmenu">
                                            <div class="ld ld-hourglass ld-spin-fast">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('user.specialis.index') }}">Klinik Spesialis</a></li>
                                <li><a href="#">Produk Unggulan <i class="ti-angle-down"></i></a>
                                    <ul class="submenu" id="produk_unggulan_submenu">
                                        <li class="text-center loadingsubmenu">
                                            <div class="ld ld-hourglass ld-spin-fast">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#">Layanan <i class="ti-angle-down"></i></a>
                                    <ul class="submenu" id="service_submenu">
                                        <li class="text-center loadingsubmenu">
                                            <div class="ld ld-hourglass ld-spin-fast">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#">Pendaftaran Pasien <i class="ti-angle-down"></i></a>
                                    <ul class="submenu" id="pendaftaran_submenu">
                                        <li><a href="{{ route('user.patientRegistration.newPatient') }}">Daftar Pasien
                                                Baru</a></li>
                                        <li class="text-center loadingsubmenu">
                                            <div class="ld ld-hourglass ld-spin-fast">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('user.quality.index') }}">Kualitas Mutu</a>

                                </li>
                                <li><a href="{{ route('user.timMedis.index') }}">Tim Medis</a>
                                </li>
                                <li><a href="#">Promosi Kesehatan <i class="ti-angle-down"></i></a>
                                    <ul class="submenu">
                                        <li class="text-center loadingsubmenu">
                                            <div class="ld ld-hourglass ld-spin-fast">
                                            </div>
                                        </li>
                                        <li><a href="{{ route('user.healthyPromotion.healthyInformation.index') }}">Info
                                                Kesehatan</a></li>
                                        <li><a href="{{ route('user.healthyPromotion.agendaActivity.index') }}">Agenda
                                                Kegiatan</a></li>
                                        <li><a
                                                href="{{ route('user.healthyPromotion.testimoni.index') }}">Testimoni</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#">Kontak <i class="ti-angle-down"></i></a>
                                    <ul class="submenu">
                                        <li class="text-center loadingsubmenu">
                                            <div class="ld ld-hourglass ld-spin-fast">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>
</div>
