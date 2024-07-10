<div class="col-md-4">
    <div class="widget widget-search">
        <form class="side-form" action="{{ route('search') }}" method="POST">
            @csrf
            <input type="text" name="search" class="form-control" placeholder="Qidirish...">
            <button type="submit">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>

    <div class="widget">
        <div class="all-title">
            <h3 class="sec-title">
                <span>Yangiliklar</span>
            </h3>
        </div>
        <div class="widget-items">
            <div class="widget-slider owl-carousel owl-theme">
                @php $news = \Illuminate\Support\Facades\DB::select("SELECT * from `news` where `type_of_news` = 1 order by `sana` desc "); @endphp
                @foreach($news as $new)
                    @php
                        $item_id = $new->code;
                        $photo = app('App\Http\Controllers\Featured_imagesController')->getImage('news', $item_id);
                    @endphp
                    <a href="{{ route('view', ['type' => 'news', 'slug' => $new->slug]) }}">
                        <div class="w-slide">
                            <div id="rasm" style="
                                            background-image: url('{{ asset('public/uploads/gallery/photos/'.$photo) }}');
                                            background-size: cover;
                                            background-position: center;
                                            background-repeat: no-repeat;
                                            width: 300px!important;
                                            height: 155px!important;
                                            border-radius: 10px;">
                            </div>
                            <div class="w-slide-content">

                                <h5>
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

                                </h5>

                                <h6 class="sarlavha">{{ $new->title }}</h6>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="widget">
        <div class="all-title">
            <h3 class="sec-title">
                <span>Tadbirlar</span>
            </h3>
        </div>
        <div class="widget-items">
            <div class="widget-slider owl-carousel owl-theme">
                @php $news = \Illuminate\Support\Facades\DB::select("SELECT * from `news` where `type_of_news` = 3 order by `sana` desc "); @endphp
                @foreach($news as $new)
                    @php
                        $item_id = $new->code;
                        $photo = app('App\Http\Controllers\Featured_imagesController')->getImage('news', $item_id);
                    @endphp
                    <a href="{{ route('view', ['type' => 'tadbirlar', 'slug' => $new->slug]) }}">
                        <div class="w-slide">
                            <div id="rasm" style="
                                            background-image: url('{{ asset('public/uploads/gallery/photos/'.$photo) }}');
                                            background-size: cover;
                                            background-position: center;
                                            background-repeat: no-repeat;
                                            width: 300px!important;
                                            height: 155px!important;
                                            border-radius: 10px;">
                            </div>
                            <div class="w-slide-content">

                                <h5>
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

                                </h5>

                                <h6 class="sarlavha">{{ $new->title }}</h6>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="widget">
        <div class="all-title">
            <h3 class="sec-title">
                <span>E`lonlar</span>
            </h3>
        </div>
        <div class="widget-items">
            <div class="widget-slider owl-carousel owl-theme">
                @php $news = \Illuminate\Support\Facades\DB::select("SELECT * from `news` where `type_of_news` = 2 order by `sana` desc "); @endphp
                @foreach($news as $new)
                    @php
                        $item_id = $new->code;
                        $photo = app('App\Http\Controllers\Featured_imagesController')->getImage('news', $item_id);
                    @endphp
                    <a href="{{ route('view', ['type' => 'e\'lonlar', 'slug' => $new->slug]) }}">
                        <div class="w-slide">
                            <div id="rasm" style="
                                            background-image: url('{{ asset('public/uploads/gallery/photos/'.$photo) }}');
                                            background-size: cover;
                                            background-position: center;
                                            background-repeat: no-repeat;
                                            width: 300px!important;
                                            height: 155px!important;
                                            border-radius: 10px;">
                            </div>
                            <div class="w-slide-content">

                                <h5>
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

                                </h5>

                                <h6 class="sarlavha">{{ $new->title }}</h6>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@section('bottom-script')
    <script>
        $(".sarlavha").text(function (t, s) {
            if (s.length >= 30) {
                var n = (s = s.substring(0, 60)).lastIndexOf(" ");
                s = s.substring(0, n) + "..."
            }
            $(this).text(s)
        });
    </script>
@endsection
