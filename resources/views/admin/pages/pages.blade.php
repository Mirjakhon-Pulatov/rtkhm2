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
    Добавить Страницы
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Static Backdrop modal Button -->
                    <div class="text-end mb-5">
                        <a href="{{ route('add-page') }}" class="btn btn-primary waves-effect waves-light">
                            Добавить +
                        </a>
                    </div>
                    <table id="files-table" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Родитель</th>
                                <th>Загаловок</th>
                                <th>Просмотры</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pages as $page)
                                <tr>
                                    <td>{{ $page->id }}</td>
                                    <td>{{ $page->menu ? $page->menu->title : '-' }}</td>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ $page->seen }}</td>
                                    <td>1</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
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
