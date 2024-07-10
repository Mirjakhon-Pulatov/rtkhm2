@extends('layout.master')
@section('title', 'Video galereya')

@section('description', 'Romitan tuman 2-son kasb-hunar maktabi, galereya, video galereya')
@section('keywords', 'romitan, maktab, video')
@section('title-og', 'Romitan tuman 2-son kasb-hunar maktabi, Video galereya')
@section('desc-og', 'Romitan tuman 2-son kasb-hunar maktabi, galereya, video galereya')
@section('img-og',  url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('title-fb', 'Romitan tuman 2-son kasb-hunar maktabi, Video galereya')
@section('desc-fb', 'Romitan tuman 2-son kasb-hunar maktabi, galereya, video galereya')
@section('img-fb', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('card-tr', 'Romitan kasb-hunar maktabi')
@section('title-tr', 'Romitan tuman 2-son kasb-hunar maktabi, Video galereya')
@section('desc-tw', 'Romitan tuman 2-son kasb-hunar maktabi, galereya, video galereya')
@section('img-tr', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )

@section('top-css')

@endsection
@section('content')

    <!--======== banner =========-->
    <section class="banner" style="background-image:url({{ asset('public/asset/img/background-image.webp') }})">
        <div class="banner-heading">
            <h2>Video Galereya</h2>
        </div>
        <div class="banner-link">
            <ul>
                <li>
                    <a href="{{ url('/') }}">Asosiy</a>
                    <i class="fa fa-chevron-right"></i>
                </li>

                <li>
                    <a href="{{ url()->current() }}" class="active">Video Galereya</a>
                </li>
            </ul>
        </div>
    </section>

    <div class="bg-w sp-70-100">
        <div class="container">
            <div class="row blog-masonary">

                @php
                    $videos = \Illuminate\Support\Facades\DB::select("Select * from `videos` order by `position` asc");
                @endphp
                @foreach($videos as $video)

                    <div class="col-sm-6 col-xs-12 blog-mas">
                        <article class="blog-items">
                            <iframe src="{{ $video->link }}"
                                    allowfullscreen=""></iframe>
                        </article>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

@endsection
@section('bottom-script')

@endsection
