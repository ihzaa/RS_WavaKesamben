<style>
#navigation li a {
    font-size: 12px;
}
</style>
<div class="header-area ">
    <div class="header-top_area">
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
    </div>
    <div id="sticky-header" class="main-header-area">
        <div class="container-fluid px-5">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-2">
                    <div class="logo">
                        <a href="index.html">
                            <img src="{{ asset('user') }}/img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-10">
                    <div class="main-menu  d-none d-lg-block">
                        <nav>
                            <ul id="navigation">
                                <li><a class="active" href="index.html">Profil</a></li>
                                <li><a href="#">Klinik Spesialis</a>
                                    <ul class="submenu">
                                        <li><a href="blog.html">blog</a></li>
                                        <li><a href="single-blog.html">single-blog</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Produk Unggulan <i class="ti-angle-down"></i></a>
                                    <ul class="submenu" id="produk_unggulan_submenu">
                                    </ul>
                                </li>
                                <li><a href="#">Layanan <i class="ti-angle-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="blog.html">blog</a></li>
                                        <li><a href="single-blog.html">single-blog</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Pendaftaran Pasien <i class="ti-angle-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="blog.html">blog</a></li>
                                        <li><a href="single-blog.html">single-blog</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Kualitas Mutu <i class="ti-angle-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="blog.html">blog</a></li>
                                        <li><a href="single-blog.html">single-blog</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Tim Medis <i class="ti-angle-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="blog.html">blog</a></li>
                                        <li><a href="single-blog.html">single-blog</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Promosi Kesehatan <i class="ti-angle-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="blog.html">blog</a></li>
                                        <li><a href="single-blog.html">single-blog</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Kontak <i class="ti-angle-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="blog.html">blog</a></li>
                                        <li><a href="single-blog.html">single-blog</a></li>
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
        produkUnggulan: "{{ route('user.featuredproduct.index', ['id', 'title']) }}"
    }
    fetch("{{ route('getHeaderData') }}")
        .then((resp) => resp.json())
        .then((data) => {
            console.log($("#produk_unggulan_submenu").html());
            data.featuredProduct.forEach(item => {
                let tmpUrl = URL.produkUnggulan.replace('id', item.id)
                tmpUrl = tmpUrl.replace('title', item.title)
                console.log(tmpUrl);
                $("#produk_unggulan_submenu").html(
                    $("#produk_unggulan_submenu").html() + '<li><a href="' + tmpUrl +
                    '">' + item.title + '</a></li>')
            })
            console.log($("#produk_unggulan_submenu").html());
        })

</script>
