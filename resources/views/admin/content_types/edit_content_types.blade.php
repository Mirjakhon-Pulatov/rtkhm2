@extends('admin.layout.layout')
@section('page-name')
    <h4 class="mb-sm-0 font-size-18">Изменить тип контента</h4>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('content_types_update', $content_types) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Название типа</label>
                        <input value="{{$content_types->name}}" name="name" type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Имя таблицы</label>
                        <input disabled value="{{$content_types->dt}}" id="table_name" name="dt" type="text"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Описание</label>
                        <input name="desc" value="{{$content_types->desc}}" type="text" class="form-control">
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary w-md">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Языки контента</h4>

                <div class="mt-3 table-responsive">
                    <table class="table mb-0">

                        <thead class="table-light">
                        <tr>
                            <th class="text-left">Язык</th>
                            <th class="text-left">Код языка</th>
                            <th class="text-left">Имя таблицы</th>
                            <th class="text-left">Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($langs as $lang)
                            <tr>
                                <td class="text-left">
                                    {{ $lang->lang }}
                                </td>
                                <td class="text-left">
                                    {{ $lang->slug }}
                                </td>
                                <td class="text-left">
                                    {{$content_types->dt.$lang->slug}}
                                </td>
                                <td class="text-left">
                                    <div class="form-check form-switch">
                                        <input
                                            onchange="Enable_lang('{{$content_types->dt}}', '{{ $content_types->id }}', '{{$lang->slug}}', this.checked)"
                                            name="enable_lang"
                                            class="childInput form-check-input form-switch-md"
                                            type="checkbox"
                                            @php
                                                $count = DB::table('lang_tags')->where('type_id', $content_types->id)->count();
                                                if ( $count > 0){
                                                    echo "checked";
                                                }



                                            @endphp

                                        >
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Поля типа контента&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#add_fields">Добавить
                    </button>
                </h4>

                <div class="mt-3 table-responsive">
                    <table id="fieldstable" class="table mb-0">

                        <thead class="table-light">
                        <tr>
                            <th class="text-left">Подсказка</th>
                            <th class="text-left">Поле</th>
                            <th class="text-left">Тип</th>
                            <th class="text-left">Макс. длина</th>
                            <th class="text-left">Мин. Длина</th>
                            <th class="text-left">Slug</th>
                            <th class="text-left">Индекс</th>
                            <th class="text-left">Показать в таблице</th>
                            <th class="text-left">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fields_list as $fielditem)
                            <tr>
                                <td class="text-left">{{ $fielditem->label }}</td>
                                <td class="text-left">{{ $fielditem->name }}</td>
                                <td class="text-left">{{ $fielditem->type }}</td>
                                <td class="text-left">{{ $fielditem->max }}</td>
                                <td class="text-left">{{ $fielditem->min }}</td>
                                <td class="text-left">
                                    <div class="form-check form-switch">
                                        <input onchange="Crate_slug('{{$fielditem->name}}', this.checked)"
                                               name="slug"
                                               class="childInput form-check-input form-switch-md"
                                               type="checkbox"
                                            @php if ($fielditem->is_slug == 1){echo "checked";} @endphp>
                                    </div>
                                </td>
                                <td class="text-left">
                                    <div class="form-check form-switch">
                                        <input onchange="isIndex('{{$fielditem->name}}', this.checked)" name="isindex"
                                               class="childInput form-check-input form-switch-md"
                                               type="checkbox"
                                            @php if ($fielditem->is_index == 1){echo "checked";} @endphp>
                                    </div>
                                </td>
                                <td class="text-left">
                                    <div class="form-check form-switch">
                                        <input onchange="ishead('{{$fielditem->name}}', this.checked)" name="ishead"
                                               class="childInput form-check-input form-switch-md"
                                               type="checkbox"
                                            @php if ($fielditem->is_head == 1){echo "checked";} @endphp>
                                    </div>
                                </td>
                                <td class="text-left">
                                    <button onclick="Deletefield('{{ $fielditem->name }}','{{ $fielditem->dt }}')"
                                            type="button"
                                            class="btn btn-outline-danger waves-effect waves-light"><i
                                            class="bx bxs-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- EDIT MENU MODAL -->
    <div class="modal fade modal-lg" id="add_fields" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         role="dialog" aria-labelledby="add_fields" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="Create_field" method="post" action="{{ route('add-fields') }}" class="row">
                        @csrf
                        <input type="hidden" name="c_id" value="{{$content_types->id}}">
                        <input type="hidden" name="dt" value="{{$content_types->dt}}">
                        <div class="mb-3 col-4">
                            <label for="field_name" class="col-form-label">Имя поля:</label>
                            <input type="text" pattern="[a-zA-Z_]+"
                                   title="Можно использовать только английские буквы и символ _" name="field_name"
                                   class="form-control" id="field_name">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="desc" class="col-form-label">Подсказка:</label>
                            <input type="text" class="form-control" id="desc" name="desc">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="after" class="col-form-label">После:</label>
                            <select name="after" class="form-select" onchange="setMaxMin();" id="after"
                                    aria-label="Default select example">
                                <option value="code">ID</option>
                                @foreach($fields_list as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="field_type" class="col-form-label">Тип поля:</label>
                            <select class="form-select" onchange="setMaxMin();" name="field_type" id="field_type"
                                    aria-label="Default select example">
                                <option value="text">TEXT</option>
                                <option value="int">INT</option>
                                <option value="varchar">VARCHAR</option>
                                <option value="DATE">DATE</option>
                                <option value="DATETIME">DATETIME</option>
                                <option value="dt_menus">Меню</option>

                                @foreach($AllContent_types as $listselect)
                                    <option value="dt_{{ $listselect->dt }}">Привязка к {{ $listselect->desc }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="max" class="col-form-label">Макс. длина:</label>
                            <input type="number" name="max" id="input_max" value="2147483647" class="form-control"
                            >
                        </div>
                        <div class="mb-3 col-4">
                            <label for="min" class="col-form-label">Мин. Длина:</label>
                            <input name="min" type="number" value="1" class="form-control" id="input_min">
                        </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
                </form>
            </div>
        </div>
    </div>




    <!-- DELETE FIELD MODAL -->
    <div class="modal fade" id="DELETE_MODAL" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         role="dialog" aria-labelledby="DELETE_MODAL" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <h2>Вы действительно хотите удалить поле " <span id="menu_name"></span> " ?</h2>

                    <form action="{{ route('destroyfields') }}" method="POST">
                        @csrf
                        <input id="fieldtitle" type="hidden" name="fieldtitle" value="">
                        <input type="hidden" name="c_id" value="{{ $content_types->id }}">
                        <input id="dbname" type="hidden" name="dbname" value="">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('footer-links')
    <script>
        const myModal2 = new bootstrap.Modal(document.getElementById('DELETE_MODAL'));


        $(document).ready(function () {


            $("#Create_field").submit(function (e) {
                e.preventDefault();
                const t = $(this),
                    o = t.attr("action");

                if ($('#field_name').val().length === 0) {
                    $("#field_name").addClass('input-error');
                } else if ($('#desc').val().length === 0) {
                    $("#desc").addClass('input-error');
                } else {

                    $("#field_name").removeClass('input-error');
                    $("#desc").removeClass('input-error');

                    $.ajax({
                        type: "POST",
                        url: o,
                        data: t.serialize(),
                        dataType: "json",

                        success: function (response) {

                            ShowError(response);
                            const CheckErrorconst = CheckError(response);

                            if (CheckErrorconst) {

                                const newOption = $('<option>', {
                                    value: $("#field_name").val(),
                                    text: $("#field_name").val(),
                                    selected: true
                                });

                                $('#after').append(newOption);

                                const field_name = $('#field_name').val();
                                const desc = $('#desc').val();
                                const input_max = $('#input_max').val();
                                const input_min = $('#input_min').val();
                                const field_type = $('#field_type').val();
                                const tablename = $('#table_name').val();

                                const newRow = $('<tr>').append(
                                    $("<td class='text-left'>").text(desc),
                                    $("<td class='text-left'>").text(field_name),
                                    $("<td class='text-left'>").text(field_type),
                                    $("<td class='text-left'>").text(input_max),
                                    $("<td class='text-left'>").text(input_min),
                                    $("<td class='text-left'>").html('<div class="form-check form-switch"><input onchange="Crate_slug(\'' + field_name + '\', this.checked)" name="isindex" class="childInput form-check-input form-switch-md" type="checkbox"></div>'),
                                    $("<td class='text-left'>").html('<div class="form-check form-switch"><input onchange="isIndex(\'' + field_name + '\', this.checked)" name="isindex" class="childInput form-check-input form-switch-md" type="checkbox"></div>'),
                                    $("<td class='text-left'>").html('<div class="form-check form-switch"><input onchange="ishead(\'' + field_name + '\', this.checked)" name="isindex" class="childInput form-check-input form-switch-md" type="checkbox"></div>'),
                                    $("<td class='text-left'>").html('<button onclick="Deletefield(\'' + field_name + '\', \'' + tablename + '\')"  type="button" class="btn btn-outline-danger waves-effect waves-light"> <i class="bx bxs-trash"></i> </button>'),

                                    // Дополнительные ячейки по необходимости
                                );

                                $('#fieldstable tbody').append(newRow);


                            }
                            $("#field_name").val("");
                            $("#desc").val("");
                            $("#input_max").val("2147483647");
                            $("#input_min").val("1");
                            t[0].reset();


                        },
                        error: function (xhr, status, error) {
                            noConnet(xhr, status);
                        }
                    })
                }

            });

        });

        function setMaxMin() {
            const type = $("#field_type").val();

            if (type.includes("dt")) {
                $("#input_max").val("18");
                $("#input_min").val("11");
            } else {
                switch (type) {
                    case "int": {
                        $("#input_max").val("18");
                        $("#input_min").val("11");
                    }
                        break;

                    case "varchar": {
                        $("#input_max").val("255");
                        $("#input_min").val("1");
                    }
                        break;

                    case "text": {
                        $("#input_max").val("2147483647");
                        $("#input_min").val("1");
                    }
                        break;

                    case "date":
                    case "file":
                    case "image": {
                        $("#input_max").val("0");
                        $("#input_min").val("0");
                    }
                        break;

                    case "decimal": {
                        $("#input_max").val("19");
                        $("#input_min").val("1");
                    }
                        break;
                    default:
                        $("#input_max").val("18");
                        $("#input_min").val("11");
                }
            }
        }

        function Deletefield(fieldtitle, dbname) {
            myModal2.show();
            $('#menu_name').text(fieldtitle);
            $("#fieldtitle").val(fieldtitle);
            $("#dbname").val(dbname);
        }


        function ishead(NaneHead, isChecked) {

            const resultinput = isChecked ? 1 : 0;
            const dt = $('#table_name').val();

            $.ajax({
                type: "POST",
                url: '{{ route('IS_head') }}',
                data: {
                    // Включение CSRF-токена в данные запроса
                    '_token': '{{ csrf_token() }}',
                    'NaneHead': NaneHead,
                    'isChecked': resultinput,
                    'dt': dt,
                    'c_id': {{ $content_types->id }}
                },
                dataType: "json",
                success: function (e) {
                    ShowError(e);
                },
                error: function (xhr, status, error) {
                    noConnet(xhr, status, error);
                }
            })
        }


        function isIndex(FeildName, InputValue) {
            const resultinput = InputValue ? 1 : 0;

            const dt = $('#table_name').val();

            $.ajax({
                type: "POST",
                url: '{{ route('is_index') }}',
                data: {
                    // Включение CSRF-токена в данные запроса
                    '_token': '{{ csrf_token() }}',
                    'FeildName': FeildName,
                    'InputValue': resultinput,
                    'dt': dt,
                    'c_id': {{ $content_types->id }}
                },
                dataType: "json",
                success: function (e) {
                    ShowError(e);
                },
                error: function (xhr, status, error) {
                    noConnet(xhr, status, error);
                }
            })
        }

        function Crate_slug(FeildName, InputValue) {

            const resultinput = InputValue ? 1 : 0;
            const dt = $('#table_name').val();

            $.ajax({
                type: "POST",
                url: '{{ route('is_slug') }}',
                data: {
                    // Включение CSRF-токена в данные запроса
                    '_token': '{{ csrf_token() }}',
                    'FeildName': FeildName,
                    'InputValue': resultinput,
                    'dt': dt,
                    'c_id': {{ $content_types->id }}
                },
                dataType: "json",
                success: function (e) {
                    ShowError(e);
                },
                error: function (xhr, status, error) {
                    noConnet(xhr, status, error);
                }
            })
        }

        function Enable_lang(ContentType, ContentTypeID, Lang_slug, InputValue) {
            const resultinput = InputValue ? 1 : 0;
            $.ajax({
                type: "POST",
                url: '{{ route('CrateLangForContentType') }}',
                data: {
                    // Включение CSRF-токена в данные запроса
                    '_token': '{{ csrf_token() }}',
                    'ContentType': ContentType,
                    'ContentTypeID': ContentTypeID,
                    'Lang_slug': Lang_slug,
                    'resultinput': resultinput
                },
                dataType: "json",
                success: function (e) {
                    ShowError(e);
                },
                error: function (xhr, status, error) {
                    noConnet(xhr, status, error);
                }
            })

        }
    </script>
@endsection

