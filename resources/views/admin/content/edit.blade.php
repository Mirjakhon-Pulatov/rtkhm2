@foreach($findContentTYpe as $content) @endforeach
@foreach($data as $datav) @endforeach
@extends('admin.layout.layout')
@section('header-links')@endsection
@php
    // link to  back

    $contnet = $content->dt;

    $position = strpos($contnet, "__");

if ($position !== false) {
    $contnet = substr($contnet, 0, $position);
} else {
    $contnet = $contnet;
}


@endphp

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mb-3"><a href="{{ route('contentTypePage', $contnet) }}"
                                                   class="btn btn-primary waves-effect btn-label btn-sm waves-light"><i
                                class="bx bx-arrow-back label-icon"></i> Назад в таблицу </a></h2>
                    <form action="{{ route('contentUpdate', $content->dt) }}" class="mt-4" method="POST">
                        <input id="code" type="hidden" name="code"
                               value="{{ $datav->code }}">

                        <input type="hidden" name="visited"
                               value="0">


                        @csrf
                        @foreach($findFeilds as $feilds)

                            @php
                                $value = \Illuminate\Support\Facades\DB::select(" SELECT $feilds->name FROM `$feilds->dt` WHERE code = '$datav->code' ");

                                    if (!$value){
                                        $text = $feilds->dt;
                                        $position = strpos($text, "__");
                                        $processedText = substr($text, 0, $position);
                                            $value = \Illuminate\Support\Facades\DB::select(" SELECT $feilds->name FROM `$processedText` WHERE code = '$datav->code' ");
                                         $value = $value[0]->{$feilds->name};

                                    }else{
                                        $value = $value[0]->{$feilds->name};
                                    }

                            @endphp

                            @if($feilds->is_slug == 1)
                                <input type="hidden" name="slug" value="{{ $datav->slug  }}" id="slug_hidden">
                            @endif

                            @if(strpos($feilds->type, 'dt_') !== false )

                                @if($feilds->type == "dt_menus")

                                    <div class="mb-4">
                                        <label for="menu" class="form-label">Меню</label>
                                        <select id="menu" name="{{ $feilds->name }}" class="form-select">
                                            @php
                                                $menus =  \Illuminate\Support\Facades\DB::select("select * from menus order by level ");
                                                foreach ($menus as $menu){
                                                    $spaces = "";
                                                     for ($i = 1; $i <= $menu->level; $i++) {
                                                    $spaces .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                                    }
                                                     if ($menu->id == $value){
                                                         echo "<option selected value='$menu->id'>$spaces$menu->title</option>";
                                                     }else{
                                                         echo "<option value='$menu->id'>$spaces$menu->title</option>";
                                                     }
                                                }
                                            @endphp
                                        </select>
                                    </div>
                                @else
                                    <div class="mb-4">
                                        <label for="{{ $feilds->label }}"
                                               class="form-label">{{ $feilds->label }}</label>
                                        <select id="{{ $feilds->label }}" name="{{ $feilds->name }}"
                                                class="form-select">
                                            @php
                                                $table = str_replace("dt_", "", $feilds->type);



                                              $categoryctye =  \Illuminate\Support\Facades\DB::select("select * from $table ");
                                              foreach ($categoryctye as $cat){

                                                  if ($cat->id == $value){
                                                      echo "<option  value='$cat->id' selected>$cat->title</option>";
                                                  }else{
                                                      echo "<option value='$cat->id'>$cat->title</option>";
                                                  }

                                                }
                                            @endphp

                                        </select>
                                    </div>
                                @endif

                            @endif

                            @switch($feilds->type)
                                @case('varchar')
                                @case('text')

                                    @if($feilds->max < 500)
                                        <div class="mb-4">
                                            <label class="form-label">{{ $feilds->label }}</label>
                                            <input value="{{ $value }}" name="{{ $feilds->name }}" type="text"

                                                   @if($feilds->is_slug == 1 ) id="slug_title"
                                                   @endif  name="{{ $feilds->name }}"
                                                   class="form-control" required>
                                        </div>
                                    @else
                                        @php
                                            $value = str_replace("\"../../public/", "\"../../../public/", $value);
                                        @endphp
                                        <div class="mb-4">
                                            <label class="form-label">{{ $feilds->label }}</label>
                                            <textarea name="{{ $feilds->name }}"
                                                      class="tinymce form-control">{{ $value }}</textarea>
                                        </div>
                                    @endif
                                    @break

                                @case('int')

                                    <div class="mb-4">
                                        <label class="form-label">{{ $feilds->label }}</label>
                                        <input type="number" value="{{ $value }}" name="{{ $feilds->name }}"
                                               class="form-control" required>
                                    </div>

                                    @break

                                @case('DATETIME')

                                    <div class="mb-4">
                                        <label for="{{ $feilds->label }}"
                                               class="col-md-2 col-form-label">{{ $feilds->label }}</label>

                                        <input class="form-control" name="{{ $feilds->name }}" type="datetime-local"
                                               value="{{ $value }}"
                                               id="{{ $feilds->label }}">

                                    </div>

                                    @break

                                @case('DATE')
                                    <div class="mb-4">
                                        <label for="{{ $feilds->label }}"
                                               class="col-md-2 col-form-label">{{ $feilds->label }}</label>

                                        <input class="form-control" name="{{ $feilds->name }}" type="date"
                                               value="{{ $value }}"
                                               id="{{ $feilds->label }}">

                                    </div>
                                    @break

                                @default

                            @endswitch

                        @endforeach


                        <div class="mb-4">
                            <button class="btn w-100 btn-primary" type="submit"><i class="bx bx-save"></i>
                                Изменить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <h2 class="card-title mb-3">Информация о контенте</h2>

                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <td>Создано:</td>
                                    <td>
                                        <strong>{{ \Carbon\Carbon::parse($datav->created_at)->format("H:i  d.m.Y") }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Обновлено:</td>
                                    <td>
                                        <strong>{{ \Carbon\Carbon::parse($datav->updated_at)->format("H:i  d.m.Y") }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Просмотры:</td>
                                    <td><strong>{{ $datav->visited }}</strong></td>
                                </tr>
                                </tbody>
                            </table>

                            <h2 class="card-title mb-3">
                                Языки контента
                            </h2>
                            <div class="languages w-100 mb-3">

                                @if(isset($CurrentLang))
                                    @php
                                        $dtChange = $content->dt;
                                        $position = strpos($dtChange, "__");
                                        $dtChange = substr($dtChange, 0, $position);


                                        // GetidParrentContent

                                       $IdParentCotnet =  \Illuminate\Support\Facades\DB::select("SELECT id FROM `$dtChange` where code = '$datav->code' ");
                                        $IdParentCotnet = $IdParentCotnet[0]->id;
//                                         echo ;

                                    @endphp
                                @else
                                    @php
                                        $dtChange = $content->dt;

                                        $IdParentCotnet =  \Illuminate\Support\Facades\DB::select("SELECT id FROM `$dtChange` where code = '$datav->code' ");
                                        $IdParentCotnet = $IdParentCotnet[0]->id;


                                    @endphp
                                @endif

                                <a href="{{ route('contentTypeEdit', [$dtChange, $IdParentCotnet]) }}"
                                   class="btn @if(!isset($CurrentLang)) btn-success @endif  waves-effect waves-light">
                                    <i class="bx bx-link-alt"></i></a>
                                @foreach($Languages as $lang)
                                    <a href="{{ route('contentTypeEdit', [$dtChange, $IdParentCotnet], ) }}/{{ $lang->slug }}"
                                       class="btn @if(isset($CurrentLang)) @if($CurrentLang == $lang->slug) btn-success @else  @endif @endif  waves-effect waves-light">{{ $lang->lang }}</a>
                                @endforeach

                            </div>


                            @foreach($findFeilds as $feilds)

                                @if($feilds->is_slug == "1")

                                    <h2 class="card-title mb-3">
                                        Slug контента
                                    </h2>

                                    <div class="mb-4">
                                        <textarea id="slug_visible" type="text"
                                                  class="form-control">{{ $datav->slug  }}</textarea>
                                    </div>

                                @endif

                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="photo">@if($FuturedImage)
                                    <img class="img-article" width="100%" height="auto"
                                         src="{{ asset("public/uploads/gallery/thumbnails/".  $FuturedImage) }}"/>
                                    <button onclick="DeleteImageCurent()" class="delete_image btn btn-sm btn-danger"
                                            type="button"><i class="bx bx-trash"></i></button>
                                @endif</div>
                            <h2 class="card-title mt-3 mb-3">Прикрепленное изображение</h2>
                            <button data-bs-toggle="modal" data-bs-target="#Gallerry" class="btn btn-primary w-100"><i
                                    class="bx bx-image-add"></i> Устанвить Изображение
                            </button>
                        </div>
                    </div>
                </div>


                @php

                    if (isset($CurrentLang)){
    //                    echo $datav->code ;
    //                    echo $content->dt;

                        $check_has = \Illuminate\Support\Facades\DB::select(" select code from `$content->dt`  where code = '$datav->code' ");

                        $check_has = count($check_has);

                        if ($check_has > 0){
                @endphp
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mt-3 mb-3">Дополнительные изображения </h2>
                            <button data-bs-toggle="modal" data-bs-target="#GallerryExtra"
                                    class="btn btn-primary w-100"><i
                                    class="bx bx-image-add"></i> Добавить Изображение
                            </button>

                            <div id="ExtraImagesList" class="row mt-4">@if($ExtraImages->count() > 0)

                                    @foreach($ExtraImages as $extra)
                                        @php
                                            $image = \App\Models\gallerys::select('file')->where('id', $extra->image_id)->first();

                                        @endphp
                                        <div class="col-md-12 extra_image mb-4" is_num="{{ $extra->s_num }}">
                                            <div is_num="{{ $extra->s_num }}" class=count_div
                                                 type=button>{{ $extra->s_num }}</div>
                                            <img height=auto
                                                 src='{{ asset("public/uploads/gallery/thumbnails/" . $image->file ) }}'
                                                 width=100%>
                                            <button
                                                onclick="DeleteExtraImage('{{ $extra->dt }}', '{{ $extra->code }}', {{ $extra->image_id }}, {{ $extra->s_num }})"
                                                class="btn btn-sm btn-danger delete_extra_image" type=button><i
                                                    class="bx bx-trash"></i></button>
                                            <button
                                                onclick="ChangeExtraInfo('{{ $extra->dt }}', '{{ $extra->code }}', {{ $extra->image_id }}, {{ $extra->s_num }})"
                                                class="btn btn-sm btn-primary edit_extra_image" type=button><i
                                                    class="bx bx-edit"></i></button>
                                        </div>
                                    @endforeach
                                @endif</div>
                        </div>
                    </div>
                </div>
                @php
                    }else{

                    }
                }else{

                @endphp
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mt-3 mb-3">Дополнительные изображения </h2>
                            <button data-bs-toggle="modal" data-bs-target="#GallerryExtra"
                                    class="btn btn-primary w-100"><i
                                    class="bx bx-image-add"></i> Добавить Изображение
                            </button>

                            <div id="ExtraImagesList" class="row mt-4">@if($ExtraImages->count() > 0)

                                    @foreach($ExtraImages as $extra)
                                        @php
                                            $image = \App\Models\gallerys::select('file')->where('id', $extra->image_id)->first();
                                        @endphp
                                        <div class="col-md-12 extra_image mb-4" is_num="{{ $extra->s_num }}">
                                            <div is_num="{{ $extra->s_num }}" class=count_div
                                                 type=button>{{ $extra->s_num }}</div>
                                                @if($image !== null)
                                            <img height=auto
                                                 src='{{ asset("public/uploads/gallery/thumbnails/" . $image->file ) }}'
                                                 width=100%>
                                                 @endif
                                            <button
                                                onclick="DeleteExtraImage('{{ $extra->dt }}', '{{ $extra->code }}', {{ $extra->image_id }}, {{ $extra->s_num }})"
                                                class="btn btn-sm btn-danger delete_extra_image" type=button><i
                                                    class="bx bx-trash"></i></button>
                                            <button
                                                onclick="ChangeExtraInfo('{{ $extra->dt }}', '{{ $extra->code }}', {{ $extra->image_id }}, {{ $extra->s_num }})"
                                                class="btn btn-sm btn-primary edit_extra_image" type=button><i
                                                    class="bx bx-edit"></i></button>
                                        </div>
                                    @endforeach
                                @endif</div>
                        </div>
                    </div>
                </div>

                @php

                    }


                @endphp


            </div>

        </div>

    </div>



    <!-- GALLERY -->
    <div class="modal fade" id="Gallerry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         role="dialog" aria-labelledby="Gallerry" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body modal-body-lg" style="min-height: 600px;">
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
                                    $albums = DB::select("SELECT * FROM `albums` ");
                                @endphp

                                @foreach($albums as $album)
                                    @php
                                        $id_album = $album->id;
                                        $results = DB::select("SELECT * FROM gallerys WHERE album_id = $id_album ");
                                        $count = count($results);
                                    @endphp

                                    <div class="album-item" onclick="loadModalGallery({{ $album->id }})">
                                        <img width="50%" height="auto"
                                             src="{{ asset('public/assets/admin/images/folder.png') }}">
                                        <p class="w-100 text-center card-title">{{ $album->title }} ({{ $count }})</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-md-9">
                            <div id="images-list" class="images-list">
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



    <!-- EXTRA GALLERY -->
    <div class="modal fade" id="GallerryExtra" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         role="dialog" aria-labelledby="GallerryExtra" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body modal-body-lg" style="min-height: 600px;">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="w-100 text-center card-title">Альбомы</p>
                        </div>
                        <div class="col-md-9">
                            <p class="w-100 text-center card-title" id="title_folder_extra">Фотографии</p>
                        </div>
                        <div class="col-12 border-top">

                        </div>
                        <div class="col-md-3">
                            <div class="albums">
                                @foreach($albums as $album)
                                    @php
                                        $id_album = $album->id;
                                        $results = DB::select("SELECT * FROM gallerys WHERE album_id = $id_album ");
                                        $count = count($results);
                                    @endphp

                                    <div class="album-item" onclick="loadModalGalleryExtra({{ $album->id }})">
                                        <img width="50%" height="auto"
                                             src="{{ asset('public/assets/admin/images/folder.png') }}">
                                        <p class="w-100 text-center card-title">{{ $album->title }} ({{ $count }})</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-md-9">
                            <div id="images-list-extra" class="images-list">
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
                    <button class="btn btn-danger" type="button" id="close_modal_extra">Закрыть</button>
                </div>
            </div>
        </div>
    </div>


    <!-- EXTRA EDIT INFO -->
    <div class="modal fade" id="GallerryExtraiNFO" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         role="dialog" aria-labelledby="GallerryExtraiNFO" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Редактировать дополнительное изображение</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="update_extra_info" class="row gy-2 gx-3 align-items-center" method="post"
                          action="{{ route('ExtraImagesDataUpdate') }}">
                        @csrf

                        <input name="codeValue" type="hidden" id="codeValue">
                        <input name="dtValue" type="hidden" id="dtValue">
                        <input name="imageIdValue" type="hidden" id="imageIdValue">
                        <input name="OldSerialNumber" type="hidden" id="OldSerialNumber">

                        <div class="col-md-5">
                            <label class="visually-hidden" for="SerialNumber">Порядковый Номер:</label>
                            <input type="number" name="SerialNumber" class="form-control" id="SerialNumber">
                        </div>
                        <div class="col-md-5">
                            <label class="visually-hidden" for="DescInfo">Описание:</label>
                            <input type="text" name="DescInfo" class="form-control" id="DescInfo">
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn w-100 btn-primary w-md">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <style>

        .modal-body-lg {
            min-height: 530px !important;
            max-height: 530px !important;
        }


        .images-list {
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

        .images-list img {
            padding: 5px;
            transition: all ease-in-out 0.3s;
        }

        .images-list img:hover {
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

        .extra_image {
            position: relative;
        }

        .count_div {
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.5);
            color: #FFFFFF;
            position: absolute;
            left: 12px;
            font-size: 30px;
            font-weight: 600;
            top: 0px;
            z-index: 55;

        }

        .delete_extra_image {
            position: absolute;
            right: 12px;
            top: 30px;
            z-index: 55 !important;
        }

        .edit_extra_image {
            position: absolute;
            right: 12px;
            top: 0px;
            z-index: 55 !important;
        }

    </style>
    @include('admin.blocks.tinymce')
@endsection

@section('footer-links')
    <script src="{{ asset('public\assets\admin\libs\custom\translate.js') }}"></script>

    <script>

        // document.addEventListener("DOMContentLoaded", function () {
        //     // Получаем все элементы с классом extra_image
        //     var extraImages = document.querySelectorAll('.extra_image');
        //
        //     // Перебираем каждый элемент и устанавливаем порядковый номер в count_div
        //     extraImages.forEach(function (element, index) {
        //         var countDiv = element.querySelector('.count_div');
        //         countDiv.textContent = index + 1; // индексы начинаются с 0, поэтому добавляем 1
        //
        //         element.setAttribute('is_num', index + 1);
        //     });
        // });

        const Gallerry = new bootstrap.Modal(document.getElementById('Gallerry'));
        const GallerryExtra = new bootstrap.Modal(document.getElementById('GallerryExtra'));
        const GallerryExtraiNFO = new bootstrap.Modal(document.getElementById('GallerryExtraiNFO'));


        $("#close_modal").on("click", function () {
            Gallerry.hide();
        });

        $("#close_modal_extra").on("click", function () {
            GallerryExtra.hide();
        });


        function setImage(id, src) {

            $.ajax({
                url: '{{ route('SetImage') }}',
                method: 'post',
                data: {
                    // Включение CSRF-токена в данные запроса
                    '_token': '{{ csrf_token() }}',
                    'id': id,
                    'article': '{{  $datav->code }}',
                    'dt': '{{ $content->dt }}'
                },
                dataType: "json",
                success: function (e) {

                    ShowError(e);

                    if ($('.photo').is(':empty')) {
                        // alert('asdasd');
                        // Вставка HTML, если div пустой
                        $('.photo').html('<img class="img-article"  width="100%" height="auto" src="' + src + '" /> <button onclick="DeleteImageCurent()" class="delete_image btn btn-sm btn-danger" type="button"><i class="bx bx-trash"></i></button> ');
                    } else {
                        $('.img-article').attr('src', src);
                    }
                },
                error: function (e) {

                    noConnet(xhr, error);
                    alert('Интернет отсутствует');
                }
            });


        }

        function DeleteImageCurent() {

            $.ajax({
                url: '{{ route('DeleteImageContent') }}',
                method: 'post',
                data: {
                    // Включение CSRF-токена в данные запроса
                    '_token': '{{ csrf_token() }}',
                    'article': '{{  $datav->code }}'

                },
                dataType: "json",
                success: function (e) {
                    $(".photo").empty();
                    ShowError(e);
                },
                error: function (e) {

                    noConnet(xhr, status, error);
                    alert('Ошибка при получении фотографий галереи:', error);
                }
            });

        }


        $("#Gallerry .album-item").click(function () {

            var paragraphValue = $(this).find("p").text();
            $("#title_folder").html(paragraphValue);
            // $("#title_folder_extra").html(paragraphValue);
            // Вывод значения в алерт
            // alert(paragraphValue);
            // Удаление класса "active_album" у всех элементов с классом "album"
            $(".album-item").removeClass("active-album");
            // Добавление класса "active_album" к текущему элементу
            $(this).addClass("active-album");
        });

        $("#GallerryExtra .album-item").click(function () {

            var paragraphValue = $(this).find("p").text();
            $("#title_folder_extra").html(paragraphValue);
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
                data: {gallery_id: id},
                success: function (response) {
                    $(".folder_loader").hide();
                    // Обновите содержимое вашей страницы с полученным HTML-кодом
                    $('#images-list').html(response);
                },
                error: function (error) {
                    $(".folder_loader").hide();
                    alert('Ошибка при получении фотографий галереи:', error);
                }
            });
        }

        function loadModalGalleryExtra(id) {
            $("#images-list-extra").children().not('.folder_loader').remove();

            $(".folder_loader").show();

            $.ajax({
                url: '{{ route('openfolderExtra') }}',
                method: 'GET',
                data: {gallery_id: id},
                success: function (response) {
                    $(".folder_loader").hide();
                    // Обновите содержимое вашей страницы с полученным HTML-кодом
                    $('#images-list-extra').html(response);
                },
                error: function (error) {
                    $(".folder_loader").hide();
                    alert('Ошибка при получении фотографий галереи:', error);
                }
            });
        }


        // var inputValue = $("#slug_title").val();
        $("#slug_title").on("input", function () {
            const inputValue = $(this).val();
            const slug = generateSlug(inputValue);
            $("#slug_visible").val(slug);
            $("#slug_hidden").val(slug);
            // alert("asdasd");
        });

        $("#slug_visible").on("input", function () {
            const inputValue = $(this).val();
            const slug = generateSlug(inputValue);
            $("#slug_hidden").val(slug);
            // alert(slug);
        });

        // function onWindowLoad() {
        //     const valueTitle = $("#slug_title").val();
        //     const slug = generateSlug(valueTitle);
        //     $("#slug_visible").val(slug);
        //     $("#slug_hidden").val(slug);
        // }
        //
        // setTimeout(onWindowLoad, 1);

        // const valueee = $("#slug_title").val();
        // $("#slug_visible").val(valueee);


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

        @php
            $big = \App\Models\extra_images::where('code', $datav->id)->max('s_num');

            if ($big >= 0){
                 $big = $big + 1;
            }else{
                $big = 0;
            }


        @endphp
        var numberOfElements = {{ $big }};

        function deleteChildDivByIsNum(isNumValue) {
            $('.extra_image').find('[is_num="' + isNumValue + '"]').parent().remove();

            numberOfElements = numberOfElements - 1;
        }

        let isFunctionExecuted = false;

        function setImageExtra(id, link) {

            if (!isFunctionExecuted) {
                // Ваш код здесь


                $.ajax({
                    url: '{{ route('SetImageExtra') }}',
                    method: 'post',
                    data: {
                        // Включение CSRF-токена в данные запроса
                        '_token': '{{ csrf_token() }}',
                        'id': id,
                        'article': '{{  $datav->id }}',
                        'dt': '{{ $content->dt }}',
                        's_num': numberOfElements
                    },
                    dataType: "json",
                    success: function (e) {

                        if ($('#ExtraImagesList').is(':empty')) {
                            $("#ExtraImagesList").html('<div class="col-md-12 extra_image mb-4"><div is_num="1" class=count_div type=button>1</div><img height=auto src=' + link + ' width=100%> <button onclick="DeleteExtraImage(\'<?php echo $content->dt ?>\', \'<?php echo $datav->id ?>\', ' + id + ', ' + numberOfElements + ')" class="btn btn-sm btn-danger delete_extra_image"type=button><i class="bx bx-trash"></i></button> <button onclick="ChangeExtraInfo(\'<?php echo $content->dt ?>\', \'<?php echo $datav->id ?>\', ' + id + ', ' + numberOfElements + ')" class="btn btn-sm btn-primary edit_extra_image"type=button><i class="bx bx-edit"></i></button></div>');
                        } else {

                            $("#ExtraImagesList").html($("#ExtraImagesList").html() + ' <div class="col-md-12 extra_image mb-4"><div is_num="' + numberOfElements + '" class=count_div type=button>' + numberOfElements + '</div><img height=auto src=' + link + ' width=100%> <button onclick="DeleteExtraImage(\'<?php echo $content->dt ?>\', \'<?php echo $datav->id ?>\', ' + id + ', ' + numberOfElements + ')" class="btn btn-sm btn-danger delete_extra_image"type=button><i class="bx bx-trash"></i></button> <button onclick="ChangeExtraInfo(\'<?php echo $content->dt ?>\', \'<?php echo $datav->id ?>\', ' + id + ', ' + numberOfElements + ')" class="btn btn-sm btn-primary edit_extra_image"type=button><i class="bx bx-edit"></i></button></div> ');
                        }


                        ShowError(e);

                        numberOfElements++;
                        isFunctionExecuted = false;

                    },
                    error: function (e) {

                        noConnet(xhr, status, error);
                        alert('Ошибка при получении фотографий галереи:', error);
                    }
                });

                isFunctionExecuted = true;
            }
        }


        function DeleteExtraImage(dt, code, image_id, s_num) {

            $.ajax({
                url: '{{ route('DeleteImageExtra') }}',
                method: 'post',
                data: {
                    // Включение CSRF-токена в данные запроса
                    '_token': '{{ csrf_token() }}',
                    'dt': dt,
                    'code': code,
                    'image_id': image_id,
                    's_num': s_num

                },
                dataType: "json",
                success: function (e) {
                    ShowError(e);
                    deleteChildDivByIsNum(s_num);
                },
                error: function (e) {
                    noConnet(xhr, status, error);
                    alert('Ошибка при получении фотографий галереи:', error);
                }
            });


        }

        function ChangeExtraInfo(dt, code, image_id, s_num) {

            $.ajax({
                url: '{{ route('GetDataExtra') }}',
                method: 'post',
                data: {
                    // Включение CSRF-токена в данные запроса
                    '_token': '{{ csrf_token() }}',
                    'dt': dt,
                    'code': code,
                    'image_id': image_id,
                    's_num': s_num

                },
                dataType: "json",
                success: function (response) {

                    var dataObject = response.data;
                    var dtValue = dataObject.dt;
                    var codeValue = dataObject.code;
                    var imageIdValue = dataObject.image_id;
                    var sNumValue = dataObject.s_num;
                    var infoText = dataObject.info;

                    $("#SerialNumber").val(sNumValue);
                    $("#OldSerialNumber").val(sNumValue);
                    $("#DescInfo").val(infoText);
                    $("#dtValue").val(dtValue);
                    $("#codeValue").val(codeValue);
                    $("#imageIdValue").val(imageIdValue);


                    // GallerryExtraiNFO.hide();

                    // SORTIROVKA QILISH


                    // alert(infoText);
                },
                error: function (e) {
                    noConnet(xhr, status, error);
                    alert('Ошибка при получении фотографий галереи:', error);
                }
            });

            GallerryExtraiNFO.show();
        }

        $("#update_extra_info").submit(function (e) {
            e.preventDefault();
            var t = $(this), a = t.attr("action");
            $.ajax({
                type: "POST",
                url: a,
                data: t.serialize(),
                dataType: "json",
                success: function (e) {

                    var OldSerialNumber = e.OldSerialNumber;
                    var NewSerialNumber = e.NewSerialNumber;


                    $.ajax({
                        url: '{{ route('ShowChangesExtraImagesList') }}',
                        method: 'GET',
                        data: {
                            dt: '{{ $content->dt }}',
                            code: '{{ $datav->id }}'
                        },
                        success: function (response) {

                            $('#ExtraImagesList').empty();
                            $('#ExtraImagesList').html(response);
                        },
                        error: function (error) {

                            alert('Ошибка при получении фотографий галереи:', error);
                        }
                    });


                    GallerryExtraiNFO.hide();
                    ShowError(e);

                },
                error: function (e) {

                }
            })
        })


    </script>
@endsection

