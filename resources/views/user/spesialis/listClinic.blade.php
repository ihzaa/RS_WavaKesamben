@extends('user.template.master')

@section('page_title', 'Klinik Spesialis')

@section('css_after')
    <style>


    </style>
@endsection

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
                @if (count($data['item']) == 0)
                    <div class="col-md-12">
                        <h2 class="text-center">Tidak ada data klinik spesialis.</h2>
                    </div>
                @endif
            </div>
            <div class="">
                <div class="card-columns">
                    @foreach ($data['item'] as $item)
                        <div class="card single_department">
                            <img class="card-img-top lazy" data-src="{{ $item->image }}" alt="Card image cap">
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- offers_area_end -->
@endsection

@section('js_after')
    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.3.1/dist/lazyload.min.js"></script>
    <script>
        var lazyLoadInstance = new LazyLoad();
    </script>
@endsection
