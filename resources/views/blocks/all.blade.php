@extends('layout.master')

@if($type == 'news')
    @section('title', 'Yangiliklar')
@elseif($type == 'tadbirlar')
    @section('title', 'Tadbirlar')
@elseif($type == 'e\'lonlar')
    @section('title', 'E\'lonlar')
@endif

@section('description', 'Romitan tuman 2-son kasb-hunar maktabi, yangiliklar, tadbirlar, e`lonlar')
@section('keywords', 'romitan, maktab, yangilik, tadbir, e`lon ')
@section('title-og', 'Romitan tuman 2-son kasb-hunar maktabi, Yangiliklar, Tadbirlar, E`lonlar')
@section('desc-og', 'Romitan tuman 2-son kasb-hunar maktabi, yangiliklar, tadbirlar, e`lonlar ')
@section('img-og',  url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('title-fb', 'Romitan tuman 2-son kasb-hunar maktabi, Yangiliklar, Tadbirlar, E`lonlar')
@section('desc-fb', 'Romitan tuman 2-son kasb-hunar maktabi, yangiliklar, tadbirlar, e`lonlar')
@section('img-fb', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('card-tr', 'Romitan tuman 2-son kasb-hunar maktabi, yangiliklar, tadbirlar, e`lonlar')
@section('title-tr', 'Romitan tuman 2-son kasb-hunar maktabi, Yangiliklar, Tadbirlar, E`lonlar')
@section('desc-tw', 'Romitan tuman 2-son kasb-hunar maktabi, yangiliklar, tadbirlar, e`lonlar')
@section('img-tr', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )

@section('top-css')
    <style>
        .news_image {
            width: 360px;
            height: 265px;;
        }
    </style>
@endsection
@section('content')
    <!--======== banner =========-->
    <section class="banner" style="background-image:url({{ asset('public/asset/img/home/abt-ban.jpg') }})">

        <div class="banner-heading">
            @if($type == 'news')
                <h2>Yangiliklar</h2>
            @elseif($type == 'tadbirlar')
                <h2>Tadbirlar</h2>
            @elseif($type == 'e\'lonlar')
                <h2>E'lonlar</h2>
            @endif

        </div>
        <div class="banner-link">
            <ul>
                <li>
                    <a href="{{ url('/') }}">Asosiy</a>
                    <i class="fa fa-chevron-right"></i>
                </li>

                <li>
                    @if($type == 'news')

                        <a href="{{ url()->current() }}" class="active">Yangiliklar</a>
                    @elseif($type == 'tadbirlar')
                        <a href="{{ url()->current() }}" class="active">Tadbirlar</a>
                    @elseif($type == 'e\'lonlar')
                        <a href="{{ url()->current() }}" class="active">E'lonlar</a>
                    @endif

                </li>
            </ul>
        </div>
    </section>

    <!--======== banner =========-->
    <div class="bg-w sp-70-100">
        <div class="container">
            <div class="row blog-masonary">
                @foreach($news as $new)
                    @php
                        $item_id = $new->code;
                        $photo = app('App\Http\Controllers\Featured_imagesController')->getImage('news', $item_id);
                    @endphp
                    <div class="col-md-4 col-sm-6 col-xs-12 blog-mas">
                        <article class="blog-items">
                            <div class="blog-img">


                                <a href="{{ route('view', ['type' => $type, 'slug' => $new->slug]) }}">
                                    <div class="news_image"
                                         style="
                                     background-image: url({{ asset('public/uploads/gallery/photos/'.$photo) }});
                                     background-size: cover;
                                     background-position: center;
                                     background-repeat: no-repeat;
                                     "></div>
                                </a>

                            </div>
                            <div class="blog-content"
                                 style="padding-left: 20px !important;padding-right: 7px !important;">

                                <div class="blog-meta">


                                    <i class="fa fa-calendar"></i>
                                    @php
                                        // Получаем дату с дефисами из базы данных
                                        $date_with_dashes = $new->sana;

                                        // Разбиваем дату на элементы
                                        $date_parts = explode('-', $date_with_dashes);

                                        // Меняем порядок элементов на "день.месяц.год"
                                        $date_with_dots = implode('.', array_reverse($date_parts));

                                        // Выводим дату в нужном формате
                                        echo $date_with_dots;
                                    @endphp

                                    <a href="{{ route('view', ['type' => $type, 'slug' => $new->slug]) }}">
                                        <i class="fa fa-eye"></i>{{ $new->visited }} </a>
                                </div>
                                <h5>
                                    <a href="{{ route('view', ['type' => $type, 'slug' => $new->slug]) }}"
                                       class="sarlavha">{{ $new->title }}</a>
                                </h5>


                                <a href="{{ route('view', ['type' => $type, 'slug' => $new->slug]) }}"
                                   class="btn btn-blog">Batafsil
                                    <i class="fa fa-long-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            {{--            <div class="nobis-pagination">--}}
            {{--                <div class="row">--}}
            {{--                    <div class="col-sm-2 clearfix">--}}
            {{--                        <div class="page-prev">--}}
            {{--                            <a href="#"> prev </a>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="col-sm-8">--}}
            {{--                        <a href="#" class="pagination-item">01</a>--}}
            {{--                        <a href="#" class="active pagination-item">02</a>--}}
            {{--                        <a href="#" class="pagination-item">03</a>--}}
            {{--                        <a href="#" class="pagination-item"> . . .</a>--}}
            {{--                        <a href="#" class="pagination-item">04</a>--}}
            {{--                        <a href="#" class="pagination-item">05</a>--}}
            {{--                    </div>--}}
            {{--                    <div class="col-sm-2 clearfix">--}}
            {{--                        <div class="page-next">--}}
            {{--                            <a href="#"> next </a>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

        </div>
    </div>
@endsection
@section('bottom-script')
    <script>
        $(".sarlavha").text(function (t, s) {
            if (s.length >= 30) {
                var n = (s = s.substring(0, 65)).lastIndexOf(" ");
                s = s.substring(0, n) + "..."
            }
            $(this).text(s)
        });
    </script>
@endsection
