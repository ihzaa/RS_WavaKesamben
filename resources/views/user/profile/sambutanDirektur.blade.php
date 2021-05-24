@extends('user.template.master')

@section('page_title', $data['item']->title)

@section('content')
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6 mx-auto mb-2">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{ asset($data['item']->image) }}" alt="">
                        </div>
                    </div>
                    <div class="page_title">
                        <h3>Sambutan {{ $data['item']->name }}</h3>
                    </div>
                    <ul class="blog-info-link mt-3 mb-4 border_bottom p-1">
                        {{-- <li><i class="fa fa-user"></i> Travel, Lifestyle</li> --}}
                        <li><i class="fa fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($data['item']->updated_at)->format('d.m.Y') }}</li>
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
