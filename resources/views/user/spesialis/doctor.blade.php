@extends('user.template.master')

@section('page_title', $data['item']->name)

@section('content')
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6 mx-auto mb-2">
                        <div class="feature-img text-center">
                            <img class="img-fluid" src="{{ asset($data['item']->image) }}" alt="">
                        </div>
                    </div>
                    <div class="page_title">
                        <h3>{{ $data['item']->name }} | {{ $data['item']->department->title }}</h3>

                    </div>
                    <ul class="blog-info-link mt-3 mb-4 border_bottom p-1">
                        <li>
                            @if ($data['item']->isLeave == 0)
                                <span class="badge badge-primary mr-0">Aktif</span>
                            @else
                                <span class="badge badge-danger">Cuti</span>
                            @endif
                        </li>
                        <li><i class="fa fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($data['item']->updated_at)->format('d.m.Y') }}</li>
                    </ul>
                    <div class="border_bottom p-1">
                        @php
                            echo $data['item']->description;
                        @endphp
                    </div>
                    @if (count($data['item']->schedule) != 0 && $data['item']->isLeave == 0)
                        <div class="border_bottom p-1 mt-2">
                            <h3>Jadwal Dokter</h3>
                            <ul class="unordered-list">
                                @foreach ($data['item']->schedule as $schedule)
                                    <li>
                                        <p>{{ $schedule->days }},
                                            {{ \Carbon\Carbon::parse($schedule->start)->format('H:i') . ' - ' . \Carbon\Carbon::parse($schedule->end)->format('H:i') }}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
            <!-- expert_doctors_area_start -->
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
                            @if (count($data['dokter']) == 0)
                                <h3 class="text-center">Tidak ada data dokter.</h3>
                            @endif
                            <div class="expert_active owl-carousel">
                                @foreach ($data['dokter'] as $item)

                                    <div class="single_expert">
                                        <div class="expert_thumb">
                                            <a href="{{ route('user.specialis.doctor', [$item->id, $item->name]) }}"><img
                                                    src="{{ asset($item->image) }}" alt=""></a>
                                        </div>
                                        <div class="experts_name text-center">
                                            <a href="{{ route('user.specialis.doctor', [$item->id, $item->name]) }}">
                                                <h3>{{ $item->name }}</h3>
                                            </a>
                                            <span>{{ $data['item']->department->title }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- expert_doctors_area_end -->
        </div>
    </section>
@endsection
