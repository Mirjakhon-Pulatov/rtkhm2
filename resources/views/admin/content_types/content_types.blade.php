@extends('admin.layout.layout')
@section('header-links')
    <!-- DataTables -->
    <link href="{{ asset('public/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('page-name')
    <h4 class="mb-sm-0 font-size-18">Тип Контента</h4>
    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
        data-bs-target="#staticBackdrop">
        Добавить +
    </button>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="files-table" class=" table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название Типа</th>
                                <th>Имя таблицы</th>
                                <th>Описание</th>
                                <th>Действие</th>
                            </tr>
                        </thead>


                        <tbody>

                            @foreach ($Content_types as $type)
                                <tr>
                                    <td>{{ $type->id }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ $type->dt }}</td>
                                    <td>{{ $type->desc }}</td>
                                    <td>
                                        <a href="{{ route('content_types_edit', $type) }}"
                                            class="btn btn-outline-warning"><i class="bx bx-pencil"></i></a>
                                        <button onclick="OpenModalDelete( '{{ $type->id }}', '{{ $type->name }}' )"
                                            class="btn btn-outline-danger"><i class="bx bx-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Create content_type -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Добавить новый тип контента</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('content_types_add') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Название Типа:</label>
                            <input name="type_name" type="text" required class="form-control"
                                placeholder="Введите Название">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Имя таблицы:</label>
                            <input pattern="[A-Za-z_]*" name="table_name" type="text" required class="form-control"
                                placeholder="Введите Имя таблицы">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Описание:</label>
                            <input name="type_desc" type="text" required class="form-control"
                                placeholder="Введите Описание">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <!-- Edit content_type -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Добавить новый тип контента</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('content_types_add') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Название Типа:</label>
                            <input name="type_name" type="text" required class="form-control"
                                placeholder="Введите Название">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Имя таблицы:</label>
                            <input pattern="[A-Za-z_]*" name="table_name" type="text" required class="form-control"
                                placeholder="Введите Имя таблицы">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Описание:</label>
                            <input name="type_desc" type="text" required class="form-control"
                                placeholder="Введите Описание">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <!-- Delete content_type -->
    <div class="modal fade" id="DELETE_MODAL" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="DELETE_MODAL" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <h2>Вы действительно хотите удалить тип контента " <span id="content_name"></span> " ?</h2>

                    <form action="{{ route('content_types_delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input id="delete_id" type="hidden" name="delete_id" value="">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('footer-links')
    <!-- Required datatable js -->
    <script src="{{ asset('public/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#files-table').DataTable();
        });

        function OpenModalDelete(type_id, type_name) {

            $('#DELETE_MODAL').modal('show');
            $('#content_name').text(type_name);
            $("#delete_id").val(type_id);

        }
    </script>
@endsection
