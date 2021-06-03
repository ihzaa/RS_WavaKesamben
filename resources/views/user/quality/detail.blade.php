@extends('user.template.master')

@section('page_title', 'Kualitas Mutu')
@section('css_before')
    <style>
        .nav {
            justify-content: space-evenly !important
        }

        .nav-item a {
            color: white !important;
            text-align: center !important
        }

        .nav-item .active {
            color: black !important
        }

    </style>
@endsection
@section('content')
    <!-- Emergency_contact start -->
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mt-5 mb-55">
                    <h3>Kualitas Mutu - {{ $data['month'] }} {{ $data['year'] }} </h3>
                </div>
            </div>
        </div>
        @if ($data['count'] == 0)
            <h1 class="text-center mb-55">Data kualiatas mutu belum tersedia</h1>
        @endif
        <!-- business_expert_area_start  -->
        <div class="business_expert_area">
            <div class="business_tabs_area">
                <div class="row">
                    <div class="col-xl-12">
                        <ul class="nav" style="background-color: #17a2b8;" id="myTab" role="tablist">
                            @foreach ($data['quality'] as $d)
                                <li class="nav-item">
                                    @if ($loop->first)
                                        <a class="nav-link active show" style="font-size: 14px;"
                                            id="{{ $d->id }}-tab" data-toggle="tab"
                                            href="#{{ str_replace(' ', '', $d->name) }}-content" role="tab"
                                            aria-controls="{{ str_replace(' ', '', $d->name) }}-content"
                                            aria-selected="false">{{ $d->name }}</a>
                                    @else
                                        <a class="nav-link" style="font-size: 14px;" id="{{ $d->id }}-tab"
                                            data-toggle="tab" href="#{{ str_replace(' ', '', $d->name) }}-content"
                                            role="tab" aria-controls="{{ str_replace(' ', '', $d->name) }}-content"
                                            aria-selected="false">{{ $d->name }}</a>
                                    @endif

                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="border_bottom">
                    <div class="tab-content" id="myTabContent">
                        @foreach ($data['quality'] as $d)
                            @if ($loop->first)
                                <div class="tab-pane fade show active" id="{{ str_replace(' ', '', $d->name) }}-content"
                                    role="tabpanel" aria-labelledby="{{ $d->id }}-tab">
                                    <div class="text-center">
                                        <h1>{{ $d->name }}</h1>
                                        <hr>
                                        <img data-src="{{ asset($d->image) }}" class="lozad img-fluid" alt="">
                                    </div>
                                </div>
                            @else
                                <div class="tab-pane fade" id="{{ str_replace(' ', '', $d->name) }}-content"
                                    role="tabpanel" aria-labelledby="{{ $d->id }}-tab">
                                    <div class="text-center">
                                        <h1>{{ $d->name }}</h1>
                                        <hr>
                                        <img data-src="{{ asset($d->image) }}" class="lozad img-fluid" alt="">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- business_expert_area_end  -->

        <div class="info_button mb-55">
            <a href="{{ route('user.quality.month', ['id' => $data['year_id'], 'year' => $data['year']]) }}"
                class="genric-btn success circle">
                <i class="fa fa-arrow-left"></i> Kembali ke halaman sebelumnya
            </a>
        </div>
    </div>
@endsection
@section('js_after')
    <script src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
    <script>
        const observer = lozad();
        observer.observe();

    </script>
@endsection
