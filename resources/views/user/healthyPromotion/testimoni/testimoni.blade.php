@extends('user.template.master')

@section('page_title', 'Testimoni')

@section('content')
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="blog_details">
                <h2>Testimoni Sahabat Wava
                </h2>
                @if (count($data['item']) == 0)
                    <h3 class="text-center my-5">Tidak Ada Testimoni.</h3>
                @else
                    @foreach ($data['item'] as $item)
                        <div class="quote-wrapper">
                            <div class="quotes">
                                <strong>{{ $item->name }}</strong>
                                <br>
                                <br>
                                <q>{{ $item->description }}</q>
                            </div>
                        </div>
                    @endforeach
                @endif
                {{ $data['item']->links('user.template.pagination') }}
            </div>
        </div>
    </section>
@endsection
