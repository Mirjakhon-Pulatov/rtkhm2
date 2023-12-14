<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">


                <li class="menu-title" key="t-menu">Основное</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-dashboards">Структура</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('add-menu') }}">Меню</a></li>
                        @can('view-menu')
                            <li><a href="{{ route('content_types') }}">Тип Контента</a></li>
                            <li><a href="{{ route('languages') }}">Языки контента</a></li>
                        @endcan
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-book-content"></i>
                        <span key="t-dashboards">Контент</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @php
                            $content_types = DB::select("SELECT * FROM `content_types` WHERE status = 1");
                        @endphp
                        @foreach($content_types as $content_types_item)
                            <li>
                                <a href="{{ route('contentTypePage', $content_types_item->dt) }}">{{ $content_types_item->name  }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                @php
                    $content_typesvasya = \Illuminate\Support\Facades\DB::select("SELECT * FROM `content_types` WHERE is_menu = '1' AND status = '1' ");
                @endphp
                @if(count($content_typesvasya) > 0)
                <li class="menu-title" key="t-apps">Быстрые ссылки</li>
                @foreach($content_typesvasya as $ct)
                    <li>
                        <a href="{{ route('contentTypePage', [$ct->dt, "fast-link"]) }}" class="waves-effect">
                            <i class="bx bxs-comment-add"></i>
                            <span key="t-dashboards">{{ $ct->name }}</span>
                        </a>
                    </li>
                @endforeach

                @endif

                <li class="menu-title" key="t-apps">Дополнительное</li>

                <li>
                    <a href="{{ route('files.index') }}" class="waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-dashboards">Файлы</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('albums') }}" class="waves-effect">
                        <i class="bx bx-images"></i>
                        <span key="t-chat">Галерея</span>
                    </a>
                </li>

                <li class="menu-title" key="t-apps">Настройки CMS</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-cog"></i>
                        <span key="">Настройки</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('users.index') }}">Настройки CMS</a></li>
                        <li><a href="{{ route('settings') }}">Настройки сайта</a></li>
                    </ul>


                </li>

                @can('view-menu')
                    <!-- Показать меню для администратора -->
                    <li>
                        <a href="{{ route('backups') }}" class="waves-effect">
                            <i class="bx bxs-data fa-4x"></i>
                            <span key="t-messages">Резервы базы данных</span>
                        </a>
                    </li>
                @endcan


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
