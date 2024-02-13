@extends('admin.layout.layout')
@section('header-links')
    <!-- DataTables -->
    <link href="{{ asset('public/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('page-name')
    <h4 class="mb-sm-0 font-size-18">Настройки сайта</h4>
    <a class="btn btn-success" href="{{ route('cache-clear') }}">Очистить кеш сайта</a>
@endsection

@section('content')
    @can('view-menu')
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('setting.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Имя</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ключ</label>
                            <input id="table_name" name="key" type="text" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Тип</label>
                            <select class="form-select" aria-label="Default select example" name="type" id="typeSelect">
                                <option selected value="text">Текст</option>
                                <option value="checkbox">Чекбокс кнопка</option>
                            </select>
                        </div>

                        <div id="GeneretInput"></div>


                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary w-md">Создать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan


    @if (count($settings) > 0)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($settings as $set)
                                <div class="col-md-12">
                                    <form action="{{ route('setting.update') }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="setting_id" value="{{ $set->id }}">

                                        @if ($set->type == 'text')
                                            <div class="mb-3">
                                                <label class="form-label">{{ $set->display_name }}</label>
                                                <input name="value" type="text" required class="form-control"
                                                    value="{{ $set->value }}">
                                            </div>
                                        @else
                                            <label class="form-label">{{ $set->display_name }}</label>
                                            <div class="mb-3 form-check">
                                                <input class=form-check-input
                                                    @if ($set->value == 'on') checked @endif name=value
                                                    type=checkbox><label class=form-check-label
                                                    for=formCheck1>Чекбокс</label>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                        </div>

                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
    @endif




    <!-- edit modal content -->
    <div class="modal fade" id="edit_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Изменить настройки</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('setting.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Имя</label>
                            <input name="name" type="text" disabled required class="form-control" id="edit_name">
                        </div>

                        <div class="row">


                            <div class="col-md-12">
                                <div id="GenereteInputModal"></div>
                            </div>
                        </div>
                        <input type="hidden" name="setting_id" id="id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
    <!-- /.modal -->

    <!-- delete modal content -->
    <div id="DELETE_MODAL" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Вы уверены, что хотите удалить элемент?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="m-2 d-inline-block" action="{{ route('setting.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input id="delete_id" type="hidden" name="setting_id" value="">
                    <div class="modal-body">
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Отмена
                            </button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Удалить</button>
                        </div>
                    </div>


                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection

@section('footer-links')
    <style>
        tr th {
            text-align: center;
            vertical-align: middle;
        }
    </style>
    <!-- Required datatable js -->
    <script src="{{ asset('public/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#files-table').DataTable();
        });

        function OpenModelEdit(id, name, key, type, value) {
            $('#edit_modal').modal('show');
            $("#edit_name").val(name);
            $("#edit_key").val(key);
            $("#edit_type").val(type);
            $("#edit_value").val(value);
            $("#id").val(id);


        }

        function OpenModalDelete(setting_id) {

            $('#DELETE_MODAL').modal('show');
            $("#delete_id").val(setting_id);

        }
    </script>
    typeSelect
    <script>
        var selectedValue = $("#typeSelect").val();

        if (selectedValue == "text") {
            $("#GeneretInput").html(
                ' <div class="mb-3"><label class="form-label">Текст</label><input name="value" type="text"  class="form-control"></div>'
                );
        } else {
            $("#GeneretInput").html(
                '<div class=mb-3><div class="mb-3 form-check"><input class=form-check-input id=formCheck1 name=value type=checkbox><label class=form-check-label for=formCheck1>Чекбокс</label></div></div>'
                );
        }


        $('#typeSelect').on('change', function() {
            const value = $(this).val();
            if (value == "text") {
                $("#GeneretInput").html(
                    ' <div class="mb-3"><label class="form-label">Текст</label><input name="value" type="text"  class="form-control"></div>'
                    );
            } else {
                $("#GeneretInput").html(
                    '<div class=mb-3><div class="mb-3 form-check"><input class=form-check-input id=formCheck1 name=value type=checkbox><label class=form-check-label for=formCheck1>Чекбокс</label></div></div>'
                    );
            }
        });
    </script>
@endsection
