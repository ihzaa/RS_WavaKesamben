@extends('user.template.master')

@section('page_title', $data['post']->title)

@section('content')
    <section class="blog_area single-post-area section-padding pb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $data['post']->title }}</h2>
                    <ul class="blog-info-link mt-3 mb-4 border_bottom p-1">
                        {{-- <li><i class="fa fa-user"></i> Travel, Lifestyle</li> --}}
                        <li><i class="fa fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($data['post']->created_at)->format('d.m.Y') }}</li>
                    </ul>
                    <div class="border_bottom p-1">
                        @php
                            echo $data['post']->description;
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- expert_doctors_area_start -->
    @if (count($data['list']) != 0)
        <div class="expert_doctors_area pt-2 mt-2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="mb-55">
                            <h3>Halaman Terkait</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="expert_active owl-carousel">
                            @foreach ($data['list'] as $item)
                                <div class="single_expert">
                                    <div class="experts_name text-center">
                                        <a href="{{ route('user.services.index', [$item->id, $item->title]) }}">
                                            <h3>{{ $item->title }}</h3>
                                        </a>
                                        <span>
                                            @php
                                                echo strlen(strip_tags($item->description, '<br><a><span>')) > 400 ? substr(strip_tags($item->description, '<br><a><span>'), 0, 400) . '...' : $item->description;
                                            @endphp
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- expert_doctors_area_end -->
@endsection
