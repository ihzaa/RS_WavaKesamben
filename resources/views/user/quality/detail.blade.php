@extends('user.template.master')

@section('page_title', 'Kualitas Mutu')
@section('css_before')
    <style>
        .nav {
            justify-content: center !important
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
                    <h3>Kualitas Mutu - Tahun {{ $data['year'] }} - {{ $data['month'] }}</h3>
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
                        <ul class="nav" style="background-color: #01acc6;" id="myTab" role="tablist">
                            @foreach ($data['quality'] as $d)
                                <li class="nav-item">
                                    <a class="nav-link" style="font-size: 14px;" id="{{ $d->id }}" data-toggle="tab"
                                        href="#{{ str_replace(' ', '', $d->name) }}" role="tab"
                                        aria-controls="{{ str_replace(' ', '', $d->name) }}"
                                        aria-selected="false">{{ $d->name }}</a>
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
                            <div class="tab-pane fade show" id="{{ str_replace(' ', '', $d->name) }}" role="tabpanel"
                                aria-labelledby="{{ $d->id }}">
                                <div class="text-center">
                                    <h1>{{ $d->name }}</h1>
                                    <hr>
                                    <img src="{{ asset($d->image) }}" class="img-fluid" alt="">
                                </div>
                            </div>
                        @endforeach

                        {{-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row align-items-center">
                                <div class="col-xl-6 col-md-6">
                                    <div class="business_info">
                                        <div class="icon">
                                            <i class="flaticon-first-aid-kit"></i>
                                        </div>
                                        <h3>Leading edge care for Your family</h3>
                                        <p>Esteem spirit temper too say adieus who direct esteem.
                                            It esteems luckily picture placing drawing. Apartments frequently or motionless
                                            on
                                            reasonable projecting expression.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="business_thumb">
                                        <img src="img/about/business.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row align-items-center">
                                <div class="col-xl-6 col-md-6">
                                    <div class="business_info">
                                        <div class="icon">
                                            <i class="flaticon-first-aid-kit"></i>
                                        </div>
                                        <h3>Leading edge care for Your family</h3>
                                        <p>Esteem spirit temper too say adieus who direct esteem.
                                            It esteems luckily picture placing drawing. Apartments frequently or motionless
                                            on
                                            reasonable projecting expression.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="business_thumb">
                                        <img src="img/about/business.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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
