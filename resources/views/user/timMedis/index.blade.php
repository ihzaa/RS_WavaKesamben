@extends('user.template.master')

@section('page_title', 'Tim Medis')

@section('content')
    <!-- offers_area_start -->
    <div class="our_department_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-55">
                        <h3>Tim Medis</h3>
                    </div>
                </div>
                {{-- @if (count($data['item']) == 0)
                    <div class="col-md-12">
                        <h2 class="text-center">Tidak ada data klinik spesialis.</h2>
                    </div>
                @endif --}}
            </div>

            <!-- expert_doctors_area_start -->
            @foreach ($data['department'] as $department)
                <div class="expert_doctors_area doctor_page border_bottom pb-2 pt-4">
                    <div class="container">
                        <a href="{{ route('user.specialis.detail', [$department->id, $department->title]) }}">
                            <h4 class="mb-3">{{ $department->title }}</h4>
                        </a>
                        <div class="row">
                            @if (count($department->doctors) == 0)
                                <div class="col-md-12">
                                    <h5 class="text-center">{{ $department->title }} belum memiliki dokter.</h5>
                                </div>
                            @endif
                            @foreach ($department->doctors as $doctor)

                                <div class="col-md-6 col-lg-3">
                                    <a href="{{ route('user.specialis.doctor', [$doctor->id, $doctor->name]) }}">
                                        <div class="single_expert mb-40">
                                            <div class="expert_thumb">
                                                <img class="lazy" data-src="{{ asset($doctor->image) }}" alt="">
                                            </div>
                                            <div class="experts_name text-center">
                                                <h3>{{ $doctor->name }}</h3>
                                                <span>{{ $department->title }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- expert_doctors_area_end -->

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
