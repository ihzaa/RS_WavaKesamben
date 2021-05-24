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
                                <li><a href="#">Kualitas Mutu <i class="ti-angle-down"></i></a>
                                    <ul class="submenu">
                                        <li class="text-center loadingsubmenu">
                                            <div class="ld ld-hourglass ld-spin-fast">
                                            </div>
                                        </li>
                                    </ul>
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
                                        <li><a href="">Testimoni</a></li>
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

<script>
    const URL = {
        produkUnggulan: "{{ route('user.featuredproduct.index', ['id', 'title']) }}",
        profile: "{{ route('user.profile.index', ['id', 'title']) }}",
        service: "{{ route('user.services.index', ['id', 'title']) }}",
        registration: "{{ route('user.patientRegistration.menuRegistration', ['id', 'title']) }}"
    }
    fetch("{{ route('getHeaderData') }}")
        .then((resp) => resp.json())
        .then((data) => {
            data.featuredProduct.forEach(item => {
                let tmpUrl = URL.produkUnggulan.replace('id', item.id)
                tmpUrl = tmpUrl.replace('title', item.title)
                $("#produk_unggulan_submenu").html(
                    $("#produk_unggulan_submenu").html() + '<li><a href="' + tmpUrl +
                    '">' + item.title + '</a></li>')
            })
            data.profile.forEach(item => {
                let tmpUrl = URL.profile.replace('id', item.id)
                tmpUrl = tmpUrl.replace('title', item.title)
                $("#profile_submenu").html(
                    $("#profile_submenu").html() + '<li><a href="' + tmpUrl +
                    '">' + item.title + '</a></li>')
            })
            data.service.forEach(item => {
                let tmpUrl = URL.service.replace('id', item.id)
                tmpUrl = tmpUrl.replace('title', item.title)
                $("#service_submenu").html(
                    $("#service_submenu").html() + '<li><a href="' + tmpUrl +
                    '">' + item.title + '</a></li>')
            })
            data.registration.forEach(item => {
                let tmpUrl = URL.registration.replace('id', item.id)
                tmpUrl = tmpUrl.replace('title', item.title)
                $("#pendaftaran_submenu").html(
                    $("#pendaftaran_submenu").html() + '<li><a href="' + tmpUrl +
                    '">' + item.title + '</a></li>')
            })

        })
        .finally(() => {
            $(".ld").remove();
            $(document).ready(function() {
                var menu = $('ul#navigation');
                if (menu.length) {
                    menu.slicknav({
                        prependTo: ".mobile_menu",
                        closedSymbol: '+',
                        openedSymbol: '-'
                    });
                };
            })
        })

</script>
