@extends('user.template.master')

@section('page_title', 'Kualitas Mutu')

@section('content')
    <!-- Emergency_contact start -->
    <div class="container">
        <div class="row">
            <div class="col-xl-12 z-index-1">
                <div class="section_title text-center mt-5 mb-55">
                    <h3>Kualitas Mutu - Tahun {{ $data['year'] }}</h3>
                </div>
            </div>
        </div>
        @if ($data['count'] == 0)
            <h1 class="text-center mb-55">Data kualiatas mutu belum tersedia</h1>
        @endif
        <div class="Emergency_contact mb-55">
            <div class="conatiner-fluid p-0">
                <div class="row no-gutters">
                    @foreach ($data['quality'] as $d)
                        @if ($loop->iteration % 2 == 0)
                            <div class="col-xl-4">
                                <div class="single_emergency align-items-center   text-center overlay_skyblue">
                                    <div class="info mx-auto">
                                        <h1 style="color:white">{{ $d->name }}</h1>
                                        {{-- <p>Esteem spirit temper too say adieus.</p> --}}
                                    </div>
                                    <div class="info_button">
                                        <a href="#" class="boxed-btn3-white">Lihat selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-xl-4">
                                <div class="single_emergency align-items-center   text-center emergency_bg_2">
                                    <div class="info mx-auto">
                                        <h1 style="color:white">{{ $d->name }}</h1>
                                        {{-- <p>Esteem spirit temper too say adieus.</p> --}}
                                    </div>
                                    <div class="info_button">
                                        <a href="{{ route('user.quality.data', ['id' => $data['year_id'], 'year' => $data['year'], 'month_id' => $d->id, 'month' => $d->name]) }}"
                                            class="boxed-btn3-white">Lihat selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="info_button mb-55">
            <a href="{{ route('user.quality.index') }}" class="genric-btn success circle">
                <i class="fa fa-arrow-left"></i> Kembali ke halaman sebelumnya
            </a>
        </div>
    </div>
    <!-- Emergency_contact end -->
@endsection
