@extends('user.template.master')

@section('page_title', $data['item']->title)

@section('content')
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page_title">
                        <h3>{{ $data['item']->title }}</h3>
                    </div>
                    <ul class="blog-info-link mt-3 mb-4 border_bottom p-1">
                        {{-- <li><i class="fa fa-user"></i> Travel, Lifestyle</li> --}}
                        <li><i class="fa fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($data['item']->created_at)->format('d.m.Y') }}</li>
                    </ul>
                    <div class="p-1">
                        @php
                            echo $data['item']->description;
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
