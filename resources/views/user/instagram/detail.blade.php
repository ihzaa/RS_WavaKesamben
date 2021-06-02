@extends('user.template.master')

@section('page_title', 'Galeri Instagram')

@section('content')
    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img" style="text-align: center;">
                            <img class="img-fluid" src="{{ asset($data['content']->image) }}" alt="">
                        </div>
                        <div class="blog_details">
                            {{-- <h2>{{ $data['content']->title }} --}}
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#">
                                        <i class="fa fa-tags"></i> Instagram</a></li>
                                <li><a href="#"><i class="fa fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($data['content']->created_at)->translatedFormat('d M Y') }}</a>
                                </li>
                            </ul>
                            @php
                                echo $data['content']->description;
                            @endphp
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        {{-- <aside class="single_sidebar_widget search_widget">
                            <form action="{{ route('user.healthyPromotion.healthyInformation.index') }}" method="GET"
                                id="search_form">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" required name="keyword" class="form-control"
                                            placeholder='Cari Kata Kunci' onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Cari Kata Kunci'">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Cari</button>
                            </form>
                        </aside> --}}
                        <aside class="single_sidebar_widget instagram_feeds">
                            <h4 class="widget_title">Galeri Instagram</h4>
                            <ul class="instagram_row flex-wrap">
                                @foreach ($data['instagram'] as $item)
                                    <li>
                                        <a href="{{ route('user.instagram.index', ['id' => $item->id]) }}">
                                            <img class="img-fluid" src="{{ asset($item->image) }}" alt="">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Promosi Kesehatan</h4>
                            <ul class="list cat-list">
                                <li>
                                    <a href="{{ route('user.healthyPromotion.healthyInformation.index') }}"
                                        class="d-flex">
                                        <p>Info Kesehatan</p>
                                        <p> ({{ $data['count']->healthy_info_count }})</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.healthyPromotion.agendaActivity.index') }}" class="d-flex">
                                        <p>Agenda Kegiatan</p>
                                        <p> ({{ $data['count']->agenda_activities_count }})</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.healthyPromotion.testimoni.index') }}" class="d-flex">
                                        <p>Testimoni</p>
                                        <p> ({{ $data['count']->testimonials_count }})</p>
                                    </a>
                                </li>
                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Info Kesehatan Terbaru</h3>
                            @foreach ($data['recent'] as $item)
                                <div class="media post_item">
                                    <img style="object-fit: cover" src="{{ asset($item->image) }}" width="80" height="80"
                                        alt="post">
                                    <div class="media-body">
                                        <a href="#">
                                            <h3>{{ $item->title }}</h3>
                                        </a>
                                        <p>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection
