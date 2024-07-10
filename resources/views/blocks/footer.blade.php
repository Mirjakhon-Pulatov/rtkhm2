<footer class="footer">
    <div class="foot-top">
        <div class="container">
            <div class="row"
                 style="display: flex; justify-content: space-between; align-items: center; align-content: center;">
                <div class="col-md-4 col-sm-6 mb-30">
                    <div class="company-details">
{{--                        <a href="{{ url('/') }}"><img src="{{ asset('public/asset/img/home/logo-foot.png') }}"--}}
{{--                                                      class="foot-logo" alt="nobis"></a>--}}

                        <a href="{{ url('/') }}">
                            {{--                                <img src="{{ asset('public/asset/img/logo.png') }}" alt="nobis" style="width: 167px; height: 70px;">--}}
                            <div style="
                                width: 190px;
                                height: 85px;
                                background-image: url('{{ asset('public/asset/img/logo.png') }}');
                                background-size: cover;
                                background-position: center;
                                background-repeat: no-repeat;
                                margin-bottom: 10px;"></div>
                        </a>

                        <p>Lorem ipsum dolor sit, consecteteur adipi amet adipiscing elit. Aefnean commodo ligula eget
                            dolor.
                        </p>
                        <ul class="address">
                            <li>
                                <i class="flat flaticon-location-pin"></i>
                                <p>267 Park Avenue NY 90210</p>
                            </li>
                            <li>
                                <i class="flat flaticon-phone-call"></i>
                                <p>+1 (409) 987–5874</p>
                            </li>
                            <li>
                                <i class="flat flaticon-email"></i>
                                <p>info@demolink.org</p>
                            </li>
                        </ul>
{{--                        <ul class="foot-social">--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fa fa-facebook"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fa fa-twitter"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fa fa-linkedin"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fa fa-instagram"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fa fa-google-plus"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-30" style="margin-left: 80px; margin-top: -100px!important;">
                    <div class="useful-links">
                        <h3 class="foot-title">Sahifalar</h3>
                        <ul class="quick-link">
                            @php
                                $pages = \Illuminate\Support\Facades\DB::select("SELECT * FROM `pages` ORDER BY visited limit 4");
                            @endphp
                            @foreach($pages as $page)
                            <li>
                                <a href="{{ route('page', ['slug' => $page->slug]) }}">{{$page->title}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-30" style="margin-top: -60px!important;">
                    <div class="recent-post">
                        <h3 class="foot-title">Yangiliklar</h3>
                        <ul>
                            @php $news = \Illuminate\Support\Facades\DB::select("SELECT * from `news` where `type_of_news` = 1 order by `sana` desc "); @endphp
                            @foreach($news as $new)
                                @php
                                    $item_id = $new->code;
                                    $photo = app('App\Http\Controllers\Featured_imagesController')->getImage('news', $item_id);
                                @endphp
                                <li class="news-post">
                                    <figure class="thumb">
                                        <a href="{{ route('view', ['type' => 'news', 'slug' => $new->slug]) }}">
                                            <div id="rasm" style="
                                            background-image: url('{{ asset('public/uploads/gallery/photos/'.$photo) }}');
                                            background-size: cover;
                                            background-position: center;
                                            background-repeat: no-repeat;
                                            width: 80px!important;
                                            height: 80px!important;
                                            border-radius: 10px;">
                                            </div>
                                        </a>
                                    </figure>
                                    <div class="news-content">
                                        <a href="{{ route('view', ['type' => 'news', 'slug' => $new->slug]) }}">{{ $new->title }} </a>
                                        <p>
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
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="foot-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p>
                        <a href="https://bizzone.uz" target="_blank"> Bizzone Group </a> © 2024
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
