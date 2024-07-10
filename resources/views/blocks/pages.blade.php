@extends('layout.master')
@section('title', $contents[0]->title)

@section('description', 'Romitan tuman 2-son kasb-hunar maktabi'.", ".html_entity_decode($contents[0]->body))
@section('keywords', 'romitan, maktab'.", ".$contents[0]->slug)
@section('title-og', 'Romitan tuman 2-son kasb-hunar maktabi'.", ".$contents[0]->title)
@section('desc-og', 'Romitan tuman 2-son kasb-hunar maktabi'.", ".html_entity_decode($contents[0]->body))
@section('img-og',  url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('title-fb', 'Romitan tuman 2-son kasb-hunar maktabi'.", ".$contents[0]->title)
@section('desc-fb', 'Romitan tuman 2-son kasb-hunar maktabi'.", ".html_entity_decode($contents[0]->body))
@section('img-fb', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('card-tr', 'romitan, maktab'.", ".$contents[0]->slug)
@section('title-tr', 'Romitan tuman 2-son kasb-hunar maktabi'.", ".$contents[0]->title)
@section('desc-tw', 'Romitan tuman 2-son kasb-hunar maktabi'.", ".html_entity_decode($contents[0]->body))
@section('img-tr', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )

@section('top-css')
@endsection
@section('content')
    @foreach($contents as $content) @endforeach
    <!--======== banner =========-->
    <section class="banner" style="background-image:url({{ asset('public/asset/img/background-image.webp') }})">
        <div class="banner-heading">
            <h2 style="text-transform: uppercase!important;">{{ $content->title }}</h2>
        </div>
        <div class="banner-link">
            <ul>
                <li>
                    <a href="{{ url('/') }}">Asosiy</a>
                    <i class="fa fa-chevron-right"></i>
                </li>
                <li>
                    <a href="{{ url()->current() }}" class="active">{{ $content->title }}</a>
                </li>
            </ul>
        </div>
    </section>

    <!--======== blog detail =========-->
    <section class="sp-70-100">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="blog-detail mt-30">

                        <div class="det-content">


                            <p>
                                @php
                                    $body = $content->body;
                                    $body1 = html_entity_decode($body);
                                    echo $body1;
                                @endphp
                            </p>

                        </div>


                    </div>
                </div>
                @include('blocks.sidebar')
            </div>
        </div>
    </section>

@endsection
@section('bottom-script')
@endsection
