@extends('user.template.master')

@section('page_title', 'Kualitas Mutu')

@section('content')
    <!-- Emergency_contact start -->
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mt-5 mb-55">
                    <h3>Kualitas Mutu</h3>
                </div>
            </div>
        </div>
        <div class="Emergency_contact mb-55">
            <div class="conatiner-fluid p-0">
                <div class="row no-gutters">
                    @foreach ($data['quality'] as $d)
                        @if ($loop->iteration % 2 == 0)
                            <div class="col-lg-4">
                                <div class="single_emergency align-items-center   text-center overlay_skyblue">
                                    <div class="info mx-auto">
                                        <h1 style="color:white"> Tahun {{ $d->year }}</h1>
                                        {{-- <p>Esteem spirit temper too say adieus.</p> --}}
                                    </div>
                                    <div class="info_button">
                                        <a href="{{ route('user.quality.month', ['id' => $d->id, 'year' => $d->year]) }}"
                                            class="boxed-btn3-white">Lihat selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-4">
                                <div class="single_emergency align-items-center   text-center emergency_bg_2">
                                    <div class="info mx-auto">
                                        <h1 style="color:white"> Tahun {{ $d->year }}</h1>
                                        {{-- <p>Esteem spirit temper too say adieus.</p> --}}
                                    </div>
                                    <div class="info_button">
                                        <a href="{{ route('user.quality.month', ['id' => $d->id, 'year' => $d->year]) }}"
                                            class="boxed-btn3-white">Lihat
                                            selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @if ($data['count'] == 0)
                        <h1>Data kualiatas mutu belum tersedia</h1>
                    @endif
                    {{-- <div class="col-xl-6">
                        <div class="single_emergency d-flex align-items-center justify-content-center  overlay_skyblue">
                            <div class="info">
                                <h3>Make an Online Appointment</h3>
                                <p>Esteem spirit temper too say adieus.</p>
                            </div>
                            <div class="info_button">
                                <a href="#" class="boxed-btn3-white">Make an Appointment</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div
                            class="single_emergency d-flex align-items-center justify-content-center emergency_bg_1 overlay_skyblue">
                            <div class="info">
                                <h3>For Any Emergency Contact</h3>
                                <p>Esteem spirit temper too say adieus.</p>
                            </div>
                            <div class="info_button">
                                <a href="#" class="boxed-btn3-white">+10 378 4673 467</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div
                            class="single_emergency d-flex align-items-center justify-content-center emergency_bg_2 overlay_skyblue">
                            <div class="info">
                                <h3>Make an Online Appointment</h3>
                                <p>Esteem spirit temper too say adieus.</p>
                            </div>
                            <div class="info_button">
                                <a href="#" class="boxed-btn3-white">Make an Appointment</a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Emergency_contact end -->
@endsection
