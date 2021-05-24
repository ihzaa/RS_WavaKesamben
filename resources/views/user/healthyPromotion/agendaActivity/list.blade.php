@extends('user.template.master')

@section('page_title', 'Info Kesehatan')

@section('content')
    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @foreach ($data['item'] as $item)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="{{ asset($item->image) }}" alt="">
                                    <a href="#" class="blog_item_date">
                                        <h3>{{ \Carbon\Carbon::parse($item->created_at)->format('d') }}</h3>
                                        <p>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('M') }}</p>
                                    </a>
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="single-blog.html">
                                        <h2>{{ $item->title }}</h2>
                                    </a>
                                    <p>
                                        @php
                                            echo strlen(strip_tags($item->description)) > 200 ? substr(strip_tags($item->description), 0, 200) . '...' : strip_tags($item->description);
                                        @endphp
                                    </p>
                                    {{-- <ul class="blog-info-link">
                                        <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                                        <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                    </ul> --}}
                                </div>
                            </article>
                        @endforeach
                        {{ $data['item']->links('user.template.pagination') }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btn" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Search</button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Promosi Kegiatan</h4>
                            <ul class="list cat-list">
                                <li>
                                    <a href="{{ route('user.healthyPromotion.healthyInformation.index') }}"
                                        class="d-flex">
                                        <p>Info Kesehatan</p>
                                        <p> ({{ $data['count']->healthy_info_count }})</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Agenda Kegiatan</p>
                                        <p> ({{ $data['count']->agenda_activities_count }})</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Testimoni</p>
                                        <p> ({{ $data['count']->testimonials_count }})</p>
                                    </a>
                                </li>
                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Agenda Kegiatan Terbaru</h3>
                            @foreach ($data['recent'] as $item)
                                <div class="media post_item">
                                    <img style="object-fit: cover" src="{{ asset($item->image) }}" width="80" height="80" alt="post">
                                    <div class="media-body">
                                        <a href="#">
                                            <h3>{{ $item->title }}</h3>
                                        </a>
                                        <p>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </aside>
                        {{-- <aside class="single_sidebar_widget tag_cloud_widget">
                            <h4 class="widget_title">Tag Clouds</h4>
                            <ul class="list">
                                <li>
                                    <a href="#">project</a>
                                </li>
                                <li>
                                    <a href="#">love</a>
                                </li>
                                <li>
                                    <a href="#">technology</a>
                                </li>
                                <li>
                                    <a href="#">travel</a>
                                </li>
                                <li>
                                    <a href="#">restaurant</a>
                                </li>
                                <li>
                                    <a href="#">life style</a>
                                </li>
                                <li>
                                    <a href="#">design</a>
                                </li>
                                <li>
                                    <a href="#">illustration</a>
                                </li>
                            </ul>
                        </aside> --}}


                        <aside class="single_sidebar_widget instagram_feeds">
                            <h4 class="widget_title">Galeri Instagram</h4>
                            <ul class="instagram_row flex-wrap">
                                @foreach ($data['instagram'] as $item)
                                    <li>
                                        <a href="">
                                            <img class="img-fluid" src="{{ asset($item->image) }}" alt="">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection
