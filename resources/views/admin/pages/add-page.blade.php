@extends('admin.layout.layout')
@section('header-links')
@endsection
@section('page-name')
    Добавить Страницу
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Загаловок</label>
                            <input name="title" type="text" required="" class="form-control"
                                placeholder="Введите Загаловок">
                        </div>

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Родитель</label>
                                    <select name="parent_id" class="form-select">
                                        <option value="0" selected>Не один</option>
                                        {{--                                        @foreach ($menus as $menu) --}}
                                        {{--                                            @php --}}
                                        {{--                                                $spaces = ""; --}}
                                        {{--                                                for ($i=0; $i<=$menu['level']; $i++) --}}
                                        {{--                                                { --}}
                                        {{--                                                    $spaces .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; --}}
                                        {{--                                                } --}}
                                        {{--                                            @endphp --}}
                                        {{--                                            <option value="{{ $menu->id }}"><?= $spaces ?>{{ $menu->title }}</option> --}}
                                        {{--                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Опсиание</label>
                                    <textarea class="tinymce form-control" name="body" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">Создать</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Прикрепленное изображение</h5>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#Gallerry" class="btn mt-3 btn-primary"><i
                            class="bx bx-image-add"></i> Установить
                        изображение
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT MENU MODAL -->
    <div class="modal fade" id="Gallerry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="Gallerry" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="w-100 text-center card-title">Альбомы</p>
                        </div>
                        <div class="col-md-9">
                            <p class="w-100 text-center card-title">Фотографии</p>
                        </div>
                        <div class="col-12 border-top">

                        </div>
                        <div class="col-md-3">
                            <div class="albums">

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
                                asdasdasd
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .albums {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            max-height: 500px !important;
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
            /*transform: scale(1.110);*/
        }
    </style>
@endsection

@section('footer-links')
    <script>
        function loadModalGallery(id) {

            $("#images-list").empty();
        }

        $(document).ready(function() {

        });
    </script>
    @include('admin.blocks.tinymce')
@endsection
