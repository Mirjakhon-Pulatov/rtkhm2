@extends('admin.layout.layout')
@section('header-links')
    <!-- DataTables -->
    <link href="{{ asset('public/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('page-name')
    <h4 class="mb-sm-0 font-size-18">Резервы базы данных</h4>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('export_database') }}" type="button"
                        class="btn btn-outline-primary waves-effect waves-light mb-4">Создать новую резервную копию</a>
                    <div class="table-responsive">
                        <table id="files-table" class=" table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle">Время копирования</th>
                                    <th style="text-align: center; vertical-align: middle">Размер файла</th>
                                    <th style="text-align: center; vertical-align: middle">Действия</th>
                                </tr>
                            </thead>


                            <tbody>

                                @foreach ($backups as $backup)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle">{{ $backup->time_name }}</td>
                                        <td style="text-align: center; vertical-align: middle">{{ $backup->size }}</td>
                                        <td style="text-align: center; vertical-align: middle">
                                            <a style="margin-right: 10px;" title="Скачать файл"
                                                href="{{ route('download_database', $backup->time_name) }}"
                                                class="btn btn-outline-primary"><i class="bx bxs-download"></i>
                                            </a>
                                            <button title="Удалить файл"
                                                onclick="OpenModalDelete( '{{ $backup->id }}', '{{ $backup->time_name }}' )"
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
    </div>

    <!-- Static Backdrop Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Добавить файлы</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label class="form-label mb-2">Файл: </label>
                            <input name="filename" class="form-control @error('filename') is-invalid @enderror"
                                type="file" id="formFileMultiple">
                            @error('filename')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-check form-check-primary mb-3">
                            <input name="original_name" class="form-check-input" type="checkbox" id="formCheckcolor1">
                            <label class="form-check-label" for="formCheckcolor1">
                                Загрузить с оригинальным именем
                            </label>
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

    <!-- sample modal content -->
    <div id="DELETE_MODAL" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Вы уверены, что хотите удалить элемент?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="m-2 d-inline-block" action="{{ route('delete_backups') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input id="delete_id" type="hidden" name="backup_id" value="">
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

        function OpenModalDelete(file_id, filename) {
            $('#DELETE_MODAL').modal('show');
            $('#deletetarget').text(filename);
            $("#delete_id").val(file_id);
        }
    </script>
@endsection
