@extends('user.template.master')

@section('page_title', 'Klinik Spesialis')

@section('content')
    <!-- offers_area_start -->
    <div class="our_department_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-55">
                        <h3>Klinik Spesialis</h3>
                    </div>
                </div>
            </div>
            <div class="card-columns">
                @foreach ($data['item'] as $item)
                    <div class="card single_department">
                        <img class="card-img-top" src="{{ $item->image }}" alt="Card image cap">
                        <div class="card-body p-0">
                            <div class="department_content">
                                <h3 class="card-title"><a
                                        href="{{ route('user.specialis.detail', [$item->id, $item->title]) }}">{{ $item->title }}</a>
                                </h3>
                                <p class="card-text">{{ $item->quotes }}</p>
                                <a href="{{ route('user.specialis.detail', [$item->id, $item->title]) }}"
                                    class="learn_more">Lihat</a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card">
                        <div class="single_department">
                            <div class="department_thumb">
                                <img src="{{ $item->image }}" alt="">
                            </div>
                            <div class="department_content">
                                <h3><a href="#">{{ $item->quotes }}</a></h3>
                                <p>{{ $item->description }}</p>
                                <a href="#" class="learn_more">Learn More</a>
                            </div>
                        </div>
                    </div> --}}
                @endforeach
            </div>
        </div>
    </div>
    <!-- offers_area_end -->
@endsection
