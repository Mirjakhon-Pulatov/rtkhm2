@extends('layout.master')
@section('title', 'Romitan tuman 2-son kasb-hunar maktabi')

@section('description', 'Romitan tuman 2-son kasb-hunar maktabi, Avtomobillarni ta`mirlash va  ularga xizmat ko`rsatish, Axborot vositalari mashinalari va kompyuter tarmoqlari operatori, Tikuvchi, Oshpaz-qandolatchi')
@section('keywords', 'romitan, maktab, tikuvchi, oshpaz, qandolatchi, avtomobillarga xizmat ko`rsatish, operator')
@section('title-og', 'Romitan tuman 2-son kasb-hunar maktabi')
@section('desc-og', 'Romitan tuman 2-son kasb-hunar maktabi, Avtomobillarni ta`mirlash va  ularga xizmat ko`rsatish, Axborot vositalari mashinalari va kompyuter tarmoqlari operatori, Tikuvchi, Oshpaz-qandolatchi')
@section('img-og',  url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('title-fb', 'Romitan tuman 2-son kasb-hunar maktabi')
@section('desc-fb', 'Romitan tuman 2-son kasb-hunar maktabi, Avtomobillarni ta`mirlash va  ularga xizmat ko`rsatish, Axborot vositalari mashinalari va kompyuter tarmoqlari operatori, Tikuvchi, Oshpaz-qandolatchi')
@section('img-fb', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('card-tr', 'Romitan kasb-hunar maktabi')
@section('title-tr', 'Romitan tuman 2-son kasb-hunar maktabi')
@section('desc-tw', 'Romitan tuman 2-son kasb-hunar maktabi, Avtomobillarni ta`mirlash va  ularga xizmat ko`rsatish, Axborot vositalari mashinalari va kompyuter tarmoqlari operatori, Tikuvchi, Oshpaz-qandolatchi')
@section('img-tr', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )


@section('top-css')
    <style>
        .news_image {
            width: 360px;
            height: 265px;;
        }

        .about {
            width: 530px;
            height: 400px;
        }
    </style>
@endsection
@section('content')
    <!--======== main-slider =========-->
    @php
        $slides = \Illuminate\Support\Facades\DB::select("SELECT * from `slider` ")

    @endphp
    <section class="main-slider">
        <div class="corp-slider theme-2  owl-carousel owl-theme">
            @foreach($slides as $slide)
                @php
                    $item_id = $slide->code;
                    $photo = app('App\Http\Controllers\Featured_imagesController')->getImage('slider', $item_id);
                @endphp
                <div class="slide-item">

                    <img src="{{ asset('public/uploads/gallery/photos/'.$photo) }}" alt="slide">

                    <div class="slide-overlay">
                        <div class="slide-table">
                            <div class="slide-table-cell">
                                <div class="container">
                                    <div class="slide-content">
                                        <h2>Romitan tuman kasb-hunar maktabi</h2>
                                        <p>Romitan tuman kasb-hunar maktabi rasmiy veb saytiga xush kelibsiz. </p>
                                        <a href="{{ route('page', ['slug'=> 'maktab-haqida' ]) }}"
                                           class="btn btn-custom active">Maktab haqida</a>
                                        <a href="{{ url('/contact') }}" class="btn btn-custom active">Aloqa</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
    </section>

    <!--======== about =========-->
    <section class="sp-100 bg-w">
        <div class="container">
            <div class="row">
                <div class="all-title">
                    <h3 class="sec-title" style="margin-bottom: 40px">
                        <span>Maktab haqida</span>
                    </h3>

                </div>
                <div class="col-md-6">

                    <div class="lapi-holder">
                        <img src="{{ asset('public/asset/img/about.png') }}" alt="laptop" class="about">
                    </div>
                </div>

                <div class="col-md-6">
                    <p class="pb-15">Lorem ipsum dolor sit amet, consectadetudzdae rcquisc adipiscing elit. Aene commodo
                        ligauala eget
                        dolor. Aenean magsfssa. Cum socadaiis nato qfuae pent ibaus et magnsfis dis parturient mon tes,
                        nascqetur rsidicfulus mus. Donefc quamaem felis, ultriciddedes nec, pefflslen tesquwdfe eu, pr
                        etium quis, sem.
                    </p>
                    <p class="pb-15"> socadaiis nato qfuae pent ibaus et magnsfis dis parturient mon tes, nascqetur
                        rsidicfu lus muss enean
                        magsfssa. Cum socadaiis nato qfuae pent ibaus et magnsfis dis partur ient mon tes, nascqetur
                        rsidicfulus mus. Donefc quamaem felis, ultriciddedes nec, pef flslen tesquwdfe eu, pr etium
                        quis,
                        sem. Cum qfuae pent ibaus et magn sfis dis parturient mon tes, nascqetur rsidicfulus mus.
                    </p>
                    <p>Socadaiis nato qfuae pent ibaus et magnsfis dis partur ient mon tes, nascqetur rsidicfulus mus
                        onefc
                        qua maem.</p>
                </div>
            </div>

        </div>
    </section>

    <!--======== blog =========-->
    <section class="blog sp-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="all-title">
                        <h3 class="sec-title">
                            <span>Maktab yangiliklari</span>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">

                @php $news = \Illuminate\Support\Facades\DB::select("SELECT * from `news` where `type_of_news` = 1 order by `sana` desc"); @endphp
                @foreach($news as $new)
                    @php
                        $item_id = $new->code;
                        $photo = app('App\Http\Controllers\Featured_imagesController')->getImage('news', $item_id);
                    @endphp

                    <div class="col-md-4 col-sm-6">
                        <article class="blog-items">
                            <div class="blog-img">


                                <a href="{{ route('view', ['type' => 'news', 'slug' => $new->slug]) }}">
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

                                    <a href="{{ route('view', ['type' => 'news', 'slug' => $new->slug]) }}">
                                        <i class="fa fa-eye"></i>{{ $new->visited }} </a>
                                </div>
                                <h5>
                                    <a href="{{ route('view', ['type' => 'news', 'slug' => $new->slug]) }}"
                                       class="sarlavha">{{ $new->title }}</a>
                                </h5>


                                <a href="{{ route('view', ['type' => 'news', 'slug' => $new->slug]) }}"
                                   class="btn btn-blog">Batafsil
                                    <i class="fa fa-long-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!--======== services =========-->
    <section class="service-theme-2 sp-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="all-title white-title">
                        <h3 class="sec-title">
                            <span>Ta'lim yo'nalishlari</span>
                        </h3>

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6 col-sm-6">
                    <div class="service-col">
                        <div class="service-wrap">
                            <i class="fa-solid fa-car" style="height: 5em!important;"></i>
                            <h4 class="serv-head">Avtomobillarni ta'mirlash va <br> ularga xizmat ko'rsatish
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="service-col">
                        <div class="service-wrap">
                            <i class="fa-solid fa-computer" style="height: 5em!important;"></i>
                            <h4 class="serv-head">Axborot vositalari mashinalari va kompyuter tarmoqlari operatori</h4>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-sm-6">
                    <div class="service-col">
                        <div class="service-wrap">
                            <i class="fa-solid fa-utensils" style="height: 4.5em!important;"></i>
                            <h4 class="serv-head">Oshpaz-qandolatchi</h4>

                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="service-col">
                        <div class="service-wrap">
                            <i class="fa-solid fa-toilet-paper" style="height: 4.5em!important;"></i>
                            <h4 class="serv-head">Tikuvchi</h4>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!--======== counters =========-->
    <section class="counters counter-theme-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="counter-wrap">
                        @php $counts = \Illuminate\Support\Facades\DB::select("SELECT * from `counter`") @endphp
                        @foreach($counts as $count) @endforeach
                        <div class="c-icon">
                            <i class="flat flaticon-networking-group"></i>
                        </div>
                        <div class="count-outer">
                            <h4 class="count">{{$count->talabalar}}</h4>
                            <p>Talabalar soni</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="counter-wrap">
                        <div class="c-icon">
                            <i class="flat flaticon-trophy"></i>
                        </div>
                        <div class="count-outer">
                            <h4 class="count">{{$count->bitiruvchilar}}  </h4>
                            <p>Bitiruvchilar soni</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="counter-wrap">
                        <div class="c-icon">
                            <i class="flat flaticon-edit"></i>
                        </div>
                        <div class="count-outer">
                            <h4 class="count">{{$count->yunalishlar}}</h4>
                            <p>Yo'nalishlar soni</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

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
