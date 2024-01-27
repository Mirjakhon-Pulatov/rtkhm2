@extends('admin.layout.layout')
@section('header-links')
    <!-- DataTables -->
    <link href="{{ asset('public/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- Responsive Table css -->
    <link href="{{ asset('public/assets/admin/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
@section('page-name')
    <h4 class="mb-sm-0 font-size-18">Добавить меню</h4>
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
                    <!-- Static Backdrop modal Button -->

                    <table id="files-table" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Загаловок</th>
                                <th>Родитель</th>
                                <th>Ссылка</th>
                                <th>Индекс</th>
                                <th>Действие</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>{{ $menu->id }}</td>
                                    <td>{{ $menu->title }}</td>
                                    @if ($menu->parent)
                                        <td>{{ $menu->parent->title }}</td>
                                    @else
                                        <td>Нет родителя</td>
                                    @endif
                                    <td>{{ $menu->link }}</td>
                                    <td>{{ $menu->index }}</td>
                                    <td>
                                        <a href="{{ route('pageUpdate', $menu->id) }}"
                                            class="btn btn-outline-warning waves-effect waves-light"><i
                                                class="bx bx-pencil"></i>
                                        </a>
                                        <button onclick="OpenModalDelete( '{{ $menu->id }}', '{{ $menu->title }}' )"
                                            type="button" class="btn btn-outline-danger waves-effect waves-light"><i
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



    <!-- ADD MENU MODAL -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Добавить Меню</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('menu.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Загаловок</label>
                            <input name="title" type="text" required class="form-control"
                                placeholder="Введите Загаловок">
                        </div>

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Родитель</label>
                                    <select name="parent_id" class="form-select">
                                        <option value="0" selected>Не один</option>
                                        @foreach ($menus as $menu)
                                            @php
                                                $spaces = '';
                                                for ($i = 0; $i <= $menu['level']; $i++) {
                                                    $spaces .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                                }
                                            @endphp
                                            <option value="{{ $menu->id }}"><?= $spaces ?>{{ $menu->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Ссылка</label>
                                    <input name="link" type="text" class="form-control" placeholder="Ссылка">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Индекс</label>
                                    <input type="number" required name="index" class="form-control"
                                        placeholder="Введите индекс">
                                </div>
                            </div>
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

    <!-- EDIT MENU MODAL -->
    <div class="modal fade" id="DELETE_MODAL" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="DELETE_MODAL" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <h2>Вы действительно хотите удалить меню " <span id="menu_name"></span> " ?</h2>

                    <form action="{{ route('menu.delete') }}" method="POST">
                        @csrf
                        <input id="delete_id" type="hidden" name="delete_id" value="">
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
    <!-- Required datatable js -->
    <script src="{{ asset('public/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#files-table').DataTable();
        });

        function OpenModalEdit() {
            $('#Edit_menu').modal('show');
        }

        function OpenModalDelete(MenuID, MenuTitle) {

            $('#DELETE_MODAL').modal('show');
            $('#menu_name').text(MenuTitle);
            $("#delete_id").val(MenuID);

        }
    </script>
@endsection
