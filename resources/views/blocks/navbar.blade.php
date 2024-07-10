<!--======== header=========-->
<header class="header-theme-1">
    {{--    <div class="head-top">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-7">--}}
    {{--                    <ul class="head-social">--}}
    {{--                        <li>--}}
    {{--                            <a href="#">--}}
    {{--                                <i class="fa fa-facebook"></i>--}}
    {{--                            </a>--}}
    {{--                        </li>--}}
    {{--                        <li>--}}
    {{--                            <a href="#">--}}
    {{--                                <i class="fa fa-twitter"></i>--}}
    {{--                            </a>--}}
    {{--                        </li>--}}
    {{--                        <li>--}}
    {{--                            <a href="#">--}}
    {{--                                <i class="fa fa-linkedin"></i>--}}
    {{--                            </a>--}}
    {{--                        </li>--}}
    {{--                        <li>--}}
    {{--                            <a href="#">--}}
    {{--                                <i class="fa fa-instagram"></i>--}}
    {{--                            </a>--}}
    {{--                        </li>--}}
    {{--                        <li>--}}
    {{--                            <a href="#">--}}
    {{--                                <i class="fa fa-google-plus"></i>--}}
    {{--                            </a>--}}
    {{--                        </li>--}}
    {{--                    </ul>--}}
    {{--                    <ul class="head-locate">--}}
    {{--                        <li>--}}
    {{--                            <i class="flat flaticon-location-pin"></i>--}}
    {{--                            <p>267 Park Avenue New York, NY 90210</p>--}}
    {{--                        </li>--}}
    {{--                    </ul>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-5">--}}
    {{--                    <ul class="mail-con">--}}
    {{--                        <li>--}}
    {{--                            <i class="flat flaticon-email"></i>--}}
    {{--                            <p>Quick Email</p>--}}
    {{--                        </li>--}}
    {{--                        <li>--}}
    {{--                            <i class="flat flaticon-phone-call"></i>--}}
    {{--                            <p>+1 (409) 987–5874</p>--}}
    {{--                        </li>--}}
    {{--                    </ul>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="menu-header">
        <div class="theme-header clearfix">
            <div class="container" style="width: 1455px !important;">
                <div class="row" style="display: flex; align-content: center; align-items: center;">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                {{--                                <img src="{{ asset('public/asset/img/logo.png') }}" alt="nobis" style="width: 167px; height: 70px;">--}}
                                <div style="
                                width: 170px;
                                height: 85px;
                                background-image: url('{{ asset('public/asset/img/logo.png') }}');
                                background-size: cover;
                                background-position: center;
                                background-repeat: no-repeat;
                                "></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div id="menu" class="main-menu">
                            <ul class="menu-wrap clearfix">
                                @php $menus = \Illuminate\Support\Facades\DB::select("SELECT * from `menus` where `parent_id` = 0 order by `index` ") @endphp
                                @foreach($menus as $menu)

                                    <li class="menu-item">
                                        @php
                                            $child_menus = \Illuminate\Support\Facades\DB::select("SELECT * from `menus` where `parent_id` = '$menu->id' ");
                                            if (count($child_menus)>0){
                                                $class_child = 'class=has-drop menu-link';
                                            }else{
                                                $class_child = '';
                                            }
                                        @endphp

                                        <a href="{{$menu->link}}"
                                           {{$class_child}} style="font-weight: bold; color: black;">{{$menu->title}}</a>

                                        @if(count($child_menus)>0)
                                            <ul class="dropdown">
                                                @foreach($child_menus as $child_menu)

                                                    <li class="menu-item">
                                                        @php $childs3 = \Illuminate\Support\Facades\DB::select("SELECT * from `menus` where `parent_id` = '$child_menu->id' ");

                                                            if (count($childs3) > 0){
                                                                $has_children_class = 'has-drop';
                                                            }else{
                                                                $has_children_class = '';
                                                            }
                                                        @endphp

                                                        @php
                                                            $slugs = \Illuminate\Support\Facades\DB::select("Select * from `pages` where `parent` = $child_menu->id ");
                                                        @endphp
                                                        @if($slugs)
                                                            @php
                                                                $link = $slugs[0]->slug;
                                                            @endphp
                                                            <a href="{{ route('page', ['slug'=> $link ]) }}"
                                                               class="menu-link {{$has_children_class}}">{{$child_menu->title}}</a>
                                                        @else
                                                            <a href="{{ $child_menu->link }}"
                                                               class="menu-link {{$has_children_class}}">{{$child_menu->title}}</a>

                                                            @if(count($childs3) > 0)
                                                                <ul class="dropdown">
                                                                    @foreach($childs3 as $child3)
                                                                        <li class="menu-item">
                                                                            @php
                                                                                $slugs1 = \Illuminate\Support\Facades\DB::select("Select * from `pages` where `parent` = $child_menu->id ");
                                                                            @endphp
                                                                            @if($slugs1)
                                                                                @php
                                                                                    $link3 = $slugs1[0]->slug;
                                                                                @endphp
                                                                                <a href="{{ route('page', ['slug'=> $link3 ]) }}"
                                                                                   class="menu-link">{{ $child3->title }}</a>
                                                                            @else
                                                                                <a href="{{ $child3->link }}"
                                                                                   class="menu-link">{{ $child3->title }}</a>
                                                                        </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                    </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif

                                    </li>

                                @endforeach


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu" data-logo="{{ asset('public/asset/img/home/logo-mobile.png') }}">
        </div>
    </div>
</header>
