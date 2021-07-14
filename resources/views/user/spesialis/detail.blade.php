@extends('user.template.master')

@section('page_title', $data['item']->title)

@section('content')
    <!-- offers_area_start -->
    <div class="our_department_area pb-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 z-index-1">
                    <div class="section_title text-center mb-55">
                        <h3>{{ $data['item']->title }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offers_area_end -->
    {{-- <div class="bradcam_area bradcam_overlay" style="background-image: url('{{ asset($data['item']->image) }}')"> --}}
    <div class="bradcam_area bradcam_overlay">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $data['item']->quotes }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="blog_area single-post-area section-padding pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex my-2">
                    <img src="{{ asset($data['item']->image) }}" alt="" class="img-fluid mx-auto">
                </div>
                <div class="col-md-12">
                    <div class="border_bottom p-1">
                        <h3>Tentang {{ $data['item']->title }}</h3>

                        @php
                            echo $data['item']->description;
                        @endphp
                    </div>
                    @if (count($data['schedule']) != 0)
                        <div class="border_bottom p-1 mt-2">
                            <h3>Jadwal Dokter</h3>
                            <ul class="unordered-list">
                                @foreach ($data['schedule'] as $schedule)
                                    @if (count($schedule->schedule) != 0)
                                        <li>
                                            <p>{{ $schedule->name }}</p>
                                            <ul>
                                                @foreach ($schedule->schedule as $item)
                                                    <li>
                                                        <p>{{ $item->days }},
                                                            {{ \Carbon\Carbon::parse($item->start)->format('H:i') . ' - ' . \Carbon\Carbon::parse($item->end)->format('H:i') }}
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- expert_doctors_area_start -->
        <div class="expert_doctors_area pt-2 mt-2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="mb-55">
                            <h3>Dokter</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        @if (count($data['schedule']) == 0)
                            <h3 class="text-center">Tidak ada data dokter.</h3>
                        @endif
                        <div class="expert_active owl-carousel">
                            @foreach ($data['schedule'] as $item)

                                <div class="single_expert">
                                    <div class="expert_thumb">
                                        <a href="{{ route('user.specialis.doctor', [$item->id, $item->name]) }}">
                                            <img class="lazy" data-src="{{ asset($item->image) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="experts_name text-center">
                                        <a href="{{ route('user.specialis.doctor', [$item->id, $item->name]) }}">
                                            <h3>{{ $item->name }}</h3>
                                        </a>
                                        <span>{{ $data['item']->title }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- expert_doctors_area_end -->
    </section>
@endsection

@section('js_after')
    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.3.1/dist/lazyload.min.js"></script>
    <script>
        var lazyLoadInstance = new LazyLoad();
    </script>
@endsection
