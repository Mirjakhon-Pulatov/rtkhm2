@foreach ($findContentTYpe as $content)
@endforeach
@extends('admin.layout.layout')
@section('header-links')
@endsection

@section('content')
    @php
        $codeArticle = uniqid() . '____' . \Illuminate\Support\Carbon::now();
    @endphp

    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mb-3">Добавить {{ $content->name }}</h2>
                    <form action="{{ route('content-add', $content->dt) }}" class="mt-4" method="POST">
                        <input id="code" type="hidden" name="code" value="{{ $codeArticle }}">

                        <input type="hidden" name="visited" value="0">


                        @csrf
                        @foreach ($findFeilds as $feilds)
                            @if ($feilds->is_slug == 1)
                                <input type="hidden" name="slug" id="slug_hidden">
                            @endif

                            @if (strpos($feilds->type, 'dt_') !== false)
                                @if ($feilds->type == 'dt_menus')
                                    <div class="mb-4">
                                        <label for="menu" class="form-label">Меню</label>
                                        <select id="menu" name="{{ $feilds->name }}" class="form-select">
                                            @php
                                                $menus = \Illuminate\Support\Facades\DB::select('select * from menus order by level ');
                                                foreach ($menus as $menu) {
                                                    $spaces = '';
                                                    for ($i = 1; $i <= $menu->level; $i++) {
                                                        $spaces .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                                    }
                                                    echo "<option value='$menu->id'>$spaces$menu->title</option>";
                                                }

                                            @endphp

                                        </select>
                                    </div>
                                @else
                                    <div class="mb-4">
                                        <label for="{{ $feilds->label }}" class="form-label">{{ $feilds->label }}</label>
                                        <select id="{{ $feilds->label }}" name="{{ $feilds->name }}" class="form-select">
                                            @php

                                                $table = str_replace('dt_', '', $feilds->type);
                                                $categoryctye = \Illuminate\Support\Facades\DB::select("select * from $table ");
                                                foreach ($categoryctye as $cat) {
                                                    echo "<option value='$cat->id'>$cat->title</option>";
                                                }

                                            @endphp

                                        </select>
                                    </div>
                                @endif
                            @endif

                            @switch($feilds->type)
                                @case('varchar')
                                @case('text')
                                    @if ($feilds->max < 500)
                                        <div class="mb-4">
                                            <label class="form-label">{{ $feilds->label }}</label>
                                            <input name="{{ $feilds->name }}" type="text"
                                                @if ($feilds->is_slug == 1) id="slug_title" @endif name="{{ $feilds->name }}"
                                                class="form-control" required>
                                        </div>
                                    @else
                                        <div class="mb-4">
                                            <label class="form-label">{{ $feilds->label }}</label>
                                            <textarea name="{{ $feilds->name }}" class="tinymce form-control"></textarea>
                                        </div>
                                    @endif
                                @break

                                @case('int')
                                    <div class="mb-4">
                                        <label class="form-label">{{ $feilds->label }}</label>
                                        <input type="number" name="{{ $feilds->name }}" class="form-control" required>
                                    </div>
                                @break

                                @case('DATETIME')
                                    <div class="mb-4">
                                        <label for="{{ $feilds->label }}"
                                            class="col-md-2 col-form-label">{{ $feilds->label }}</label>

                                        <input class="form-control" name="{{ $feilds->name }}" type="datetime-local"
                                            value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}" id="{{ $feilds->label }}">

                                    </div>
                                @break

                                @case('DATE')
                                    <div class="mb-4">
                                        <label for="{{ $feilds->label }}"
                                            class="col-md-2 col-form-label">{{ $feilds->label }}</label>

                                        <input class="form-control" name="{{ $feilds->name }}" type="date"
                                            value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="{{ $feilds->label }}">

                                    </div>
                                @break

                                @default
                            @endswitch
                        @endforeach


                        <div class="mb-4">
                            <button class="btn w-100 btn-primary" type="submit"><i class="bx bxs-plus-square"></i>
                                Добавить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="row">

                @foreach ($findFeilds as $feilds)
                    @if ($feilds->is_slug == '1')
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">


                                    <h2 class="card-title mb-3">
                                        Slug контента
                                    </h2>

                                    <div class="mb-4">
                                        <textarea id="slug_visible" type="text" class="form-control"></textarea>
                                    </div>


                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="photo"></div>
                            <h2 class="card-title mt-3 mb-3">Прикрепленное изображение</h2>
                            <button data-bs-toggle="modal" data-bs-target="#Gallerry" class="btn btn-primary w-100"><i
                                    class="bx bx-image-add"></i> Устанвить Изображение
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>



    <!-- EDIT MENU MODAL -->
    <div class="modal fade" id="Gallerry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="Gallerry" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body" style="min-height: 600px;">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="w-100 text-center card-title">Альбомы</p>
                        </div>
                        <div class="col-md-9">
                            <p class="w-100 text-center card-title" id="title_folder">Фотографии</p>
                        </div>
                        <div class="col-12 border-top">

                        </div>
                        <div class="col-md-3">
                            <div class="albums">
                                @php
                                    $albums = DB::select('SELECT * FROM `albums` ');
                                @endphp

                                @foreach ($albums as $album)
                                    @php
                                        $id_album = $album->id;
                                        $results = DB::select("SELECT * FROM gallerys WHERE album_id = $id_album ");
                                        $count = count($results);
                                    @endphp

                                    <div class="album-item" onclick="loadModalGallery({{ $album->id }})">
                                        <img width="50%" height="auto"
                                            src="{{ asset('public/assets/admin/images/folder.png') }}">
                                        <p class="w-100 text-center card-title">{{ $album->title }} ({{ $count }})
                                        </p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-md-9">
                            <div id="images-list">
                                <div class="folder_loader" style="display: none">
                                    <div class="spinner-grow text-primary m-1" role="status">
                                        <span class="sr-only">Загрузка ...</span>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" id="close_modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>



    <style>
        .modal-body {
            min-height: 530px !important;
            max-height: 530px !important;
        }


        #images-list {
            height: 100%;
            padding: 10px;
            display: flex;
            flex-flow: wrap;
            justify-content: flex-start;
            align-items: flex-start;
            flex-direction: row;
            min-height: 475px !important;
            max-height: 475px !important;
            overflow-x: hidden;
            overflow-y: scroll;
            box-sizing: border-box;
        }

        #images-list img {
            padding: 5px;
            transition: all ease-in-out 0.3s;
        }

        #images-list img:hover {
            transition: all ease-in-out 0.3s;
            transform: scale(1.110);
            z-index: 40;
            cursor: pointer;
        }

        .albums {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            min-height: 475px !important;
            max-height: 475px !important;
            overflow-x: hidden;
            overflow-y: scroll;
            box-sizing: border-box;
            display: block;
        }

        .album-item {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            transition: all ease-in-out 0.3s;
        }

        .album-item:hover {
            transition: all ease-in-out 0.3s;
        }

        .active-album {
            background: #f2f2f2;
        }

        .folder_loader {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    @include('admin.blocks.tinymce')
@endsection

@section('footer-links')
    <script src="{{ asset('public\assets\admin\libs\custom\translate.js') }}"></script>

    <script>
        const Gallerry = new bootstrap.Modal(document.getElementById('Gallerry'));


        $("#close_modal").on("click", function() {
            Gallerry.hide();
        });

        function setImage(id, src) {

            $.ajax({
                url: '{{ route('SetImage') }}',
                method: 'post',
                data: {
                    // Включение CSRF-токена в данные запроса
                    '_token': '{{ csrf_token() }}',
                    'id': id,
                    'article': '{{ $codeArticle }}',
                    'dt': '{{ $content->dt }}'
                },
                dataType: "json",
                success: function(e) {

                    ShowError(e);
                },
                error: function(e) {

                    noConnet(xhr, status, error);
                    alert('Ошибка при получении фотографий галереи:', error);
                }
            });


            if ($('.photo').is(':empty')) {
                // alert('asdasd');
                // Вставка HTML, если div пустой
                $('.photo').html('<img class="img-article"  width="100%" height="auto" src="' + src +
                    '" /> <button onclick="DeleteImageCurent()" class="delete_image btn btn-sm btn-danger" type="button"><i class="bx bx-trash"></i></button> '
                    );
            } else {
                $('.img-article').attr('src', src);
            }


        }

        function DeleteImageCurent() {

            $.ajax({
                url: '{{ route('DeleteImageContent') }}',
                method: 'post',
                data: {
                    // Включение CSRF-токена в данные запроса
                    '_token': '{{ csrf_token() }}',
                    'article': '{{ $codeArticle }}'

                },
                dataType: "json",
                success: function(e) {
                    $(".photo").empty();
                    ShowError(e);
                },
                error: function(e) {

                    noConnet(xhr, status, error);
                    alert('Ошибка при получении фотографий галереи:', error);
                }
            });

        }


        $(".album-item").click(function() {

            var paragraphValue = $(this).find("p").text();
            $("#title_folder").html(paragraphValue);
            // Вывод значения в алерт
            // alert(paragraphValue);
            // Удаление класса "active_album" у всех элементов с классом "album"
            $(".album-item").removeClass("active-album");
            // Добавление класса "active_album" к текущему элементу
            $(this).addClass("active-album");
        });


        function loadModalGallery(id) {
            $("#images-list").children().not('.folder_loader').remove();

            $(".folder_loader").show();

            $.ajax({
                url: '{{ route('OpenFolder') }}',
                method: 'GET',
                data: {
                    gallery_id: id
                },
                success: function(response) {
                    $(".folder_loader").hide();
                    // Обновите содержимое вашей страницы с полученным HTML-кодом
                    $('#images-list').html(response);
                },
                error: function(error) {
                    $(".folder_loader").hide();
                    alert('Ошибка при получении фотографий галереи:', error);
                }
            });


        }


        // var inputValue = $("#slug_title").val();
        $("#slug_title").on("input", function() {
            const inputValue = $(this).val();
            const slug = generateSlug(inputValue);
            $("#slug_visible").val(slug);
            $("#slug_hidden").val(slug);

            // alert("asdasd");
        });


        function generateSlug(text) {

            var text = transliterateCustom(text, customReplacements);

            return text
                .toString()
                .replace(/ /g, '-')
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase() // Преобразуем в нижний регистр
                .trim()
                .replace(/[^\w\-]+/g, '') // Удаляем все символы, кроме букв, цифр и дефисов
                .replace(/\-\-+/g, '-') // Удаляем последовательности дефисов
                .replace(/^-+/, '') // Удаляем дефисы в начале строки
                .replace(/-+$/, '') // Удаляем дефисы в конце строки
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }
    </script>
@endsection
