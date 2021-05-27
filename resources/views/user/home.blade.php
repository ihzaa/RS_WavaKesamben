@extends('user.template.master')

@section('page_title', 'Home')

@section('content')
    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="slider_active owl-carousel">
            @foreach ($data['carousel'] as $item)
                <div class="single_slider  d-flex align-items-center"
                    style="background-image: url('{{ asset($item->image) }}')">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="slider_text ">
                                    <h3>{{ $item->title }}</h3>
                                    <p>{{ $item->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- slider_area_end -->

    <!-- service_area_start -->
    <div class="service_area">
        <div class="container p-0">
            <div class="row no-gutters">
                <div class="col-xl-4 col-md-4">
                    <div class="single_service">
                        <div class="icon">
                            <i class="flaticon-electrocardiogram"></i>
                        </div>
                        <h3>Info Dokter</h3>
                        {{-- <p>Clinical excellence must be the priority for any health care service provider.</p> --}}
                        <a href="#" class="boxed-btn3-white">Lihat Detail</a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="single_service">
                        <div class="icon">
                            <i class="flaticon-emergency-call"></i>
                        </div>
                        <h3>IGD 24 Jam</h3>
                        <a href="#" class="boxed-btn3-white">+10 672 356 3567</a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="single_service">
                        <div class="icon">
                            <i class="flaticon-first-aid-kit"></i>
                        </div>
                        <h3>Daftar Pasien Baru</h3>
                        <a href="{{ route('user.patientRegistration.newPatient') }}"
                            class="mt-auto boxed-btn3-white">Mendaftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service_area_end -->

    <!-- welcome_docmed_area_start -->
    <div class="welcome_docmed_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="welcome_thumb text-center">
                        <img src="{{ asset($data['sambutan_direktur']->image) }}" alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="welcome_docmed_info">
                        <h2>Sambutan Direktur</h2>
                        <h3>{{ $data['sambutan_direktur']->name }}</h3>
                        <div id="desc_sambutan">
                            @php
                                echo strlen(strip_tags($data['sambutan_direktur']->description, '<br><a><span>')) > 1000 ? substr(strip_tags($data['sambutan_direktur']->description, '<br><a><span>'), 0, 1000) . '...' : $data['sambutan_direktur']->description;
                            @endphp
                        </div>

                        <a href="{{ route('user.profile.sambutan-direktur') }}" class="boxed-btn3-white-2 mt-4">Lihat
                            Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome_docmed_area_end -->

    {{-- Anket_start --}}
    @if (count($data['angket']) != 0)
        <div class="expert_doctors_area py-0">
            <div class="container">
                <div class="section-top-border pb-0">
                    <h3 class="mb-30">Angket</h3>
                    <div class="row">
                        <div class="col-lg-12">
                            <blockquote class="generic-blockquote">
                                <form action="{{ route('user.submit.angket') }}" method="POST">
                                    @csrf
                                    @foreach ($data['angket'] as $pertanyaan)
                                        <div class="mb-2">
                                            <h4>{{ $pertanyaan->pertanyaan }}</h4>
                                            @foreach ($data['jawaban_angket'] as $jawaban)
                                                @if ($jawaban->angket_id == $pertanyaan->id)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="pertanyaan_{{ $pertanyaan->id }}"
                                                            id="jawaban_{{ $pertanyaan->id }}_{{ $jawaban->id }}"
                                                            value="{{ $jawaban->id }}" required>
                                                        <label class="form-check-label"
                                                            for="jawaban_{{ $pertanyaan->id }}_{{ $jawaban->id }}">
                                                            {{ $jawaban->jawaban }}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach
                                    <div class="mt-3 d-flex">
                                        <button type="submit" class="btn btn-primary ml-auto">Kirim</button>
                                    </div>
                                </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- Angket_end --}}

    {{-- Galeri Start --}}
    {{-- <div class="container">
        <div class="section-top-border">
            <h3 class="mb-30">Galeri</h3>
            <div class="row d-flex justify-content-center owl-carousel">
                @foreach ($data['galeri'] as $item)
                    <div class="col-md-4 d-flex justify-content-center my-2" style="height: 200px;">
                        @php
                            echo $item->link;
                        @endphp
                    </div>
                @endforeach
                @if (count($data['galeri']) == 0)
                    <h3 class="text-center">Tidak Ada Data Galeri</h3>
                @endif
            </div>
        </div>
    </div> --}}

    <div class="expert_doctors_area pb-0">
        <div class="container">
            <div class="section-top-border">
                <div class="col-xl-12">
                    <div class="doctors_title mb-55">
                        <h3>Galeri</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    @if (count($data['galeri']) == 0)
                        <h3 class="text-center">Tidak Ada Data Galeri</h3>
                    @endif
                    <div class="expert_active owl-carousel">
                        @foreach ($data['galeri'] as $item)
                            <div class="single_expert">
                                <div class="experts_name text-justify">
                                    @php
                                        echo $item->link;
                                    @endphp
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Galeri End --}}

    <!-- Galeri Instagram Start -->
    <div class="expert_doctors_area pb-0">
        <div class="container">
            <div class="section-top-border">
                <div class="col-xl-12">
                    <div class="doctors_title mb-55">
                        <h3>Galeri Instagram</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    @if (count($data['instagram']) == 0)
                        <h3 class="text-center">Tidak Ada Galeri Instagram</h3>
                    @endif
                    <div class="expert_active owl-carousel">
                        @foreach ($data['instagram'] as $item)
                            <a href="">
                                <div class="single_expert">
                                    <div class="expert_thumb">
                                        <img class="img-250" src="{{ asset($item->image) }}" alt="">
                                    </div>
                                    <div class="experts_name p-2 text-justify">
                                        <h5 class="text-center">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y') }}
                                        </h5>
                                        <span>
                                            @php
                                                echo strlen(strip_tags($item->description)) > 150 ? substr(strip_tags($item->description), 0, 150) . '...' : strip_tags($item->description);
                                            @endphp
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Galeri Instagram nd -->

    <!-- Info Kesehatan start -->
    <div class="expert_doctors_area">
        <div class="container">
            <div class="section-top-border">
                <div class="col-xl-12">
                    <div class="doctors_title mb-55">
                        <h3>Info Kesehatan</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    @if (count($data['info_kesehatan']) == 0)
                        <h3 class="text-center">Tidak Ada Info Kesehatan</h3>
                    @endif
                    <div class="expert_active owl-carousel">
                        @foreach ($data['info_kesehatan'] as $item)
                            <a href="">
                                <div class="single_expert">
                                    <div class="expert_thumb">
                                        <img class="img-250" src="{{ asset($item->image) }}" alt="">
                                    </div>
                                    <div class="experts_name p-2 text-justify">
                                        <h3 class="text-center">
                                            {{ $item->title }}
                                        </h3>
                                        <h5 class="text-center">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y') }}
                                        </h5>
                                        <span>
                                            @php
                                                echo strlen(strip_tags($item->description)) > 150 ? substr(strip_tags($item->description), 0, 150) . '...' : strip_tags($item->description);
                                            @endphp
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Info Kesehatan end -->
@endsection

@section('js_after')


    @if (Session::get('icon'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            Swal.fire({
                icon: "{{ Session::get('icon') }}",
                title: "{{ Session::get('title') }}",
                text: "{{ Session::get('text') }}",
            });

        </script>
    @endif
@endsection
