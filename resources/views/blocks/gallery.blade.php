@extends('layout.master')
@section('title', 'Foto galereya')

@section('description', 'Romitan tuman 2-son kasb-hunar maktabi, galereya, foto galereya, photo, rasmlar, albom')
@section('keywords', 'romitan, maktab, video')
@section('title-og', 'Romitan tuman 2-son kasb-hunar maktabi, Foto galereya')
@section('desc-og', 'Romitan tuman 2-son kasb-hunar maktabi, galereya, foto galereya, photo, rasmlar, albom')
@section('img-og',  url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('title-fb', 'Romitan tuman 2-son kasb-hunar maktabi, Foto galereya')
@section('desc-fb', 'Romitan tuman 2-son kasb-hunar maktabi, galereya, foto galereya, photo, rasmlar, albom')
@section('img-fb', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('card-tr', 'Romitan kasb-hunar maktabi')
@section('title-tr', 'Romitan tuman 2-son kasb-hunar maktabi, Foto galereya')
@section('desc-tw', 'Romitan tuman 2-son kasb-hunar maktabi, galereya, foto galereya, photo, rasmlar, albom')
@section('img-tr', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )

@section('top-css')
    <style>
        .news_image {
            width: 360px;
            height: 300px;
        }
    </style>
@endsection
@section('content')

    <!--======== banner =========-->
    <section class="banner" style="background-image:url({{ asset('public/asset/img/background-image.webp') }})">
        <div class="banner-heading">
            <h2>Galereya</h2>
        </div>
        <div class="banner-link">
            <ul>
                <li>
                    <a href="{{ url('/') }}">Asosiy</a>
                    <i class="fa fa-chevron-right"></i>
                </li>

                <li>
                    <a href="{{ url()->current() }}" class="active">Galereya</a>
                </li>
            </ul>
        </div>
    </section>

    <section class="portfolio sp-100">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <div class="row portfolio-items port-theme-2">
                        @php
                            $galleries = \Illuminate\Support\Facades\DB::select("SELECT * FROM `gallerys` WHERE album_id = 4 ORDER BY `id` ");

                        @endphp
                        @foreach($galleries as $gallery)
                            <a href="{{ asset('public/uploads/gallery/photos/'. $gallery->file) }}"
                               class="sb pop-btn">
                                <div class="col-md-4 col-sm-6 col-xs-12 port-item graphic developement">
                                    <div class="project">
                                        <div class="proj-img">
                                            <div class="news_image"
                                                 style="
                                     background-image: url({{ asset('public/uploads/gallery/photos/'. $gallery->file) }});
                                     background-size: cover;
                                     background-position: center;
                                     background-repeat: no-repeat;
                                     "></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('bottom-script')

@endsection
