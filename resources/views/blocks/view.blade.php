@extends('layout.master')
@section('title', $views[0]->title)

@foreach($views as $view)@endforeach
@php
    $item_id = $view->code;
    $photo = app('App\Http\Controllers\Featured_imagesController')->getImage('news', $item_id);
    $get_visited = \Illuminate\Support\Facades\DB::select("SELECT `visited` FROM `news` WHERE `slug` = '$view->slug'");
    $current_visited = $get_visited[0]->visited;
    $visited_update = $current_visited + 1;
  \Illuminate\Support\Facades\DB::select("UPDATE `news` SET `visited` = '$visited_update' WHERE `news`.`slug` = '$view->slug'");
@endphp

@section('description', $views[0]->slug)
@section('keywords', $views[0]->slug)
@section('title-og', $views[0]->title)
@section('desc-og', $views[0]->slug)
@section('img-og',   asset('public/uploads/gallery/photos/'. $photo))
@section('title-fb', $views[0]->title)
@section('desc-fb', $views[0]->slug)
@section('img-fb', asset('public/uploads/gallery/photos/'. $photo))
@section('card-tr', $views[0]->slug)
@section('title-tr', $views[0]->title)
@section('desc-tw', $views[0]->slug)
@section('img-tr', asset('public/uploads/gallery/photos/'. $photo))

@section('top-css')
@endsection
@section('content')

    <!--======== banner =========-->
    <section class="banner" style="background-image:url({{ asset('public/asset/img/background-image.webp') }})">
        <div class="banner-heading">
            <h2>{{ $view->title }}</h2>
        </div>

    </section>

    <!--======== blog detail =========-->
    <section class="sp-70-100">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="blog-detail mt-30">
                        <div class="b-det-img">
                            <img src="{{ asset('public/uploads/gallery/photos/'. $photo) }}" alt="blog"
                                 style="width: 100%; height: auto;">
                        </div>
                        <div class="det-content" style="margin-top: 15px;">

                            <div class="det-meta">


                                <i class="fa fa-calendar"></i>
                                @php
                                    // Получаем дату с дефисами из базы данных
                                    $date_with_dashes = $view->sana;

                                    // Разбиваем дату на элементы
                                    $date_parts = explode('-', $date_with_dashes);

                                    // Меняем порядок элементов на "день.месяц.год"
                                    $date_with_dots = implode('.', array_reverse($date_parts));

                                    // Выводим дату в нужном формате
                                    echo $date_with_dots;
                                @endphp

                                <i class="fa fa-eye"></i>
                                {{ $view->visited }}

                            </div>
                            <p>
                                @php
                                    $body = $view->body;
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
