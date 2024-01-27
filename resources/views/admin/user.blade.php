@extends('admin.layout.layout')
@section('header-links')
    <!-- DataTables -->
    <link href="{{ asset('public/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('page-name')
    <h4 class="mb-sm-0 font-size-18 text-end">Настройки CMS</h4>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-5">

            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Быстрые ссылки на главную страницу</h4>
                    @php
                        $cts = \Illuminate\Support\Facades\DB::select("Select * from content_types where status = '1' ");
                    @endphp

                    @foreach ($cts as $ct)
                        <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                            <input onchange="ChangeisMenu('{{ $ct->id }}', this.checked)" class="form-check-input"
                                type="checkbox" @if ($ct->is_menu == 1) checked @endif id="SwitchCheckSizelg">
                            <label class="form-check-label" for="SwitchCheckSizelg">{{ $ct->name }}</label>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        @can('view-menu')
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">

                        <a href="" type="button" class="btn btn-outline-primary waves-effect waves-light mb-4"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop">Добавить пользователь</a>

                        <div class="table-responsive">
                            <table id="files-table" class=" table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle">№</th>
                                        <th style="text-align: center; vertical-align: middle">Логин</th>
                                        <th style="text-align: center; vertical-align: middle">Эл. почта</th>
                                        <th style="text-align: center; vertical-align: middle">Пароль</th>
                                        <th style="text-align: center; vertical-align: middle">Действия</th>
                                    </tr>
                                </thead>


                                <tbody>

                                    @foreach ($users as $user)
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle">{{ $user->id }}</td>
                                            <td style="text-align: center; vertical-align: middle">{{ $user->login }}</td>
                                            <td style="text-align: center; vertical-align: middle">{{ $user->email }}</td>
                                            <td style="text-align: center; vertical-align: middle">{{ $user->pwd_label }}</td>
                                            <td style="text-align: center; vertical-align: middle">
                                                <button title="Удалить пользователь"
                                                    onclick="OpenModalDelete( '{{ $user->id }}', '{{ $user->login }}' )"
                                                    type="button" class="btn btn-outline-danger waves-effect waves-light">
                                                    <i class="bx bxs-trash"></i>
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
        @endcan
    </div>




    <!-- Static Backdrop Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Добавить нового пользователя</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user_add') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="formlogin" class="form-label mb-2">Логин: </label>
                            <input name="login" class="form-control" type="text" id="formlogin" required
                                title="Поля должна быть не пустым">
                        </div>

                        <div class="mb-3">
                            <label for="formemail" class="form-label mb-2">Эл. почта: </label>
                            <input name="email" class="form-control" type="email" id="formemail" required>
                        </div>

                        <div class="mb-3">
                            <label for="formpassword" class="form-label mb-2">Пароль: </label>
                            <input name="password" value="@php echo generatePassword(20) @endphp" class="form-control"
                                type="text" id="formpassword">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- sample modal content -->
    <div id="DELETE_MODAL" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Вы уверены, что хотите удалить элемент?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="m-2 d-inline-block" action="{{ route('delete_user') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input id="delete_id" type="hidden" name="user_id" value="">
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
    @php
        function generatePassword($length = 12)
        {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_';
            $password = '';
            $charLength = strlen($characters) - 1;

            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[mt_rand(0, $charLength)];
            }

            return $password;
    } @endphp
    <style>
        tr th {
            text-align: center;
            vertical-align: middle;
        }
    </style>
    <script>
        function validateForm() {
            // Get the value of the username input
            var login = document.get('login').value;

            // Check if the username is not empty
            if (login.trim() !== '') {
                // If not empty, submit the form (you can replace this with your form submission logic)
                document.getElementById('myForm').submit();
            } else {
                // If empty, show an alert or handle it in some way
                errorText.textContent = 'Логин поля не должен быть пустым';
            }
        }

        function ChangeisMenu(id, status) {
            // alert(id + status);
            const resultinput = status ? 1 : 0;
            // alert(resultinput);
            $.ajax({
                type: "POST",
                url: '{{ route('changeIsMenu') }}',
                data: {
                    // Включение CSRF-токена в данные запроса
                    '_token': '{{ csrf_token() }}',
                    'InputValue': resultinput,
                    'id': id,
                },
                dataType: "json",
                success: function(e) {
                    ShowError(e);
                },
                error: function(xhr, status, error) {
                    noConnet(xhr, status, error);
                }
            })

        }
    </script>
    <!-- Required datatable js -->
    <script src="{{ asset('public/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#files-table').DataTable();
        });

        function OpenModalDelete(user_id, user_login) {
            $('#DELETE_MODAL').modal('show');
            $('#deletetarget').text(user_login);
            $("#delete_id").val(user_id);
        }
    </script>
@endsection
