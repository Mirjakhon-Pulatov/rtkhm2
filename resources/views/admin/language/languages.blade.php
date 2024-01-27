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
    <h4 class="mb-sm-0 font-size-18">Добавить Язык</h4>
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
                    <table id="files-table" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Язык</th>
                                <th>Код языка</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($langs as $langitem)
                                <tr>
                                    <td>{{ $langitem->id }}</td>
                                    <td>{{ $langitem->lang }}</td>
                                    <td>{{ $langitem->slug }}</td>
                                    <td>
                                        <button
                                            onclick="OpenModalEdit('{{ $langitem->id }}', '{{ $langitem->lang }}', '{{ $langitem->slug }}')"
                                            type="button" class="btn btn-outline-warning"><i class="bx bx-pencil"></i>
                                        </button>
                                        <button onclick="OpenModalDelete( '{{ $langitem->id }}', '{{ $langitem->lang }}' )"
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
                    <h5 class="modal-title" id="staticBackdropLabel">Добавить новый язык</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store-lang') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Язык</label>
                            <input name="lang" type="text" required class="form-control"
                                placeholder="Введите название языка">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Код языка</label>
                            <input name="code_lang" type="text" required class="form-control"
                                placeholder="Введите код языка">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- EDIT MODAL -->
    <div class="modal fade" id="EDIT" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="EDIT" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Изменить язык</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update-lang') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label class="form-label">Язык</label>
                            <input name="lang" type="text" id="edit_lang" required class="form-control"
                                placeholder="Введите название языка">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Код языка</label>
                            <input disabled name="code_lang" id="code_edit" type="text" required class="form-control">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- DELETE MODAL -->
    <div class="modal fade" id="DELETE" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="DELETE" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Удалить язык</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('delete-lang') }}" method="POST">
                        @csrf

                        <h2>Вы действительно хотите удалить <span class="text-danger" id="current_lang"></span> этот
                            язык ?</h2>
                        <input type="hidden" name="deleteid" id="deleteid">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Удалить</button>
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
        const myModal = new bootstrap.Modal(document.getElementById('EDIT'));
        const myModal2 = new bootstrap.Modal(document.getElementById('DELETE'));


        $(document).ready(function() {
            $('#files-table').DataTable();


        });


        function OpenModalEdit(id, lang, slug) {

            myModal.show();

            $("#edit_lang").val(lang);
            $("#code_edit").val(slug);
            $("#id").val(id);

        }

        function OpenModalDelete(IdLang, lang) {

            myModal2.show();
            $("#current_lang").html(lang);
            $("#deleteid").val(IdLang);

        }
    </script>
@endsection
