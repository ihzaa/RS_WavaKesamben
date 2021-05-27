<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} | @yield('page_title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('user') }}/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->
    @yield('css_before')
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('user') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('user') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('user') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('user') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('user') }}/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('user') }}/css/nice-select.css">
    <link rel="stylesheet" href="{{ asset('user') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('user') }}/css/gijgo.css">
    <link rel="stylesheet" href="{{ asset('user') }}/css/animate.css">
    <link rel="stylesheet" href="{{ asset('user') }}/css/slicknav.css">
    <link rel="stylesheet" href="{{ asset('user') }}/css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    @yield('css_after')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

    </style>
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
    <div style="
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 99999999;
        background-color: rgba(122, 117, 117,0.5);
        " id="page_loader" class="justify-content-center align-items-center">
        <div class="loader mx-auto justify-content-center align-items-center"></div>
    </div>
    <!-- header-start -->
    <header class="shadow ">
        @include('user.template.header')
    </header>
    <!-- header-end -->
    @yield('content')
    <!-- footer start -->
    <footer class="footer">
        @include('user.template.footer')
    </footer>
    <!-- footer end  -->


    @yield('js_before')
    <!-- JS here -->
    <script src="{{ asset('user') }}/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="{{ asset('user') }}/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('user') }}/js/popper.min.js"></script>
    <script src="{{ asset('user') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('user') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('user') }}/js/isotope.pkgd.min.js"></script>
    <script src="{{ asset('user') }}/js/ajax-form.js"></script>
    <script src="{{ asset('user') }}/js/waypoints.min.js"></script>
    <script src="{{ asset('user') }}/js/jquery.counterup.min.js"></script>
    <script src="{{ asset('user') }}/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('user') }}/js/scrollIt.js"></script>
    <script src="{{ asset('user') }}/js/jquery.scrollUp.min.js"></script>
    <script src="{{ asset('user') }}/js/wow.min.js"></script>
    <script src="{{ asset('user') }}/js/nice-select.min.js"></script>
    <script src="{{ asset('user') }}/js/jquery.slicknav.min.js"></script>
    <script src="{{ asset('user') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('user') }}/js/plugins.js"></script>
    <script src="{{ asset('user') }}/js/gijgo.min.js"></script>
    <!--contact js-->
    <script src="{{ asset('user') }}/js/contact.js"></script>
    <script src="{{ asset('user') }}/js/jquery.ajaxchimp.min.js"></script>
    <script src="{{ asset('user') }}/js/jquery.form.js"></script>
    <script src="{{ asset('user') }}/js/jquery.validate.min.js"></script>
    <script src="{{ asset('user') }}/js/mail-script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const URL = {
            produkUnggulan: "{{ route('user.featuredproduct.index', ['id', 'title']) }}",
            profile: "{{ route('user.profile.index', ['id', 'title']) }}",
            service: "{{ route('user.services.index', ['id', 'title']) }}",
            registration: "{{ route('user.patientRegistration.menuRegistration', ['id', 'title']) }}",
            asset: "{{ asset('') }}",
            agendaActivity: "{{ route('user.healthyPromotion.agendaActivity.detail', ['id', 'title']) }}"
        }

        const truncateStringWithThreeDots = (data, size = 50) => {
            return data.length > size ? data.substring(0, size) + '...' : data
        }

        fetch("{{ route('getHeaderAndFooterData') }}")
            .then((resp) => resp.json())
            .then(async (data) => {
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

                const agendaActivityWrapper = "#footer_agenda_activity_wrapper";
                if (data.agendaActivity.length == 0) {
                    $(agendaActivityWrapper).html(
                        `<div class="col"><p class="text-center">Tidak ada data.</p></div>`)
                } else {
                    data.agendaActivity.forEach(item => {
                        let tmpUrl = URL.agendaActivity.replace('id', item.id)
                        tmpUrl = tmpUrl.replace('title', item.title)
                        $(agendaActivityWrapper).html(
                            $(agendaActivityWrapper).html() +
                            `
                                <div class="col-4 py-2" style="max-height:100px;">
                                <a href="${tmpUrl}">
                                    <img  class="img_fit-cover" src="${URL.asset+item.image}" alt=""></div>
                                </a>
                        <div class="col-8 py-2">
                            <a href="${tmpUrl}">
                                <p>${truncateStringWithThreeDots(item.title)}</p>
                            <p><small>${moment(item.created_at).format("D.M.YYYY")}</small></p>
                            </a>
                        </div>
                        `
                        )
                    })
                }

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
    <script src="{{ asset('user') }}/js/main.js"></script>
    @yield('js_after')
    <script>
        $(document).ready(function() {
            // $("img").addClass("img-responsive");
            $("img").css("max-width", "100%");
        });

    </script>
</body>

</html>
