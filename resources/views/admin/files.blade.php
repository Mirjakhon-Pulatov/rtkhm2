@extends('admin.layout.layout')
@section('header-links')
    <!-- DataTables -->
    <link href="{{ asset('public/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('page-name')
    <h4 class="mb-sm-0 font-size-18">Добавить Файлы</h4>
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
                    <div class="table-responsive">
                        <table id="files-table" class=" table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Расширение</th>
                                    <th>Имя файла</th>
                                    <th>Размер файла</th>
                                    <th>Время</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle">{{ $key + 1 }}</td>
                                        <td style="text-align:  center">
                                            @if (file_exists(public_path('assets/admin/filetypes/' . $file->type . '.png')))
                                                <img src="{{ asset('public/assets/admin/filetypes/' . $file->type . '.png') }}"
                                                    alt="alt" style="width: 35px; height: auto; margin-right: 5px;">
                                                .{{ $file->type }}
                                            @else
                                                <img src="{{ asset('public/assets/admin/filetypes/file.png') }}"
                                                    alt="alt" style="width: 35px; height: auto; margin-right: 5px;">
                                                .{{ $file->type }}
                                            @endif

                                        </td>
                                        <td style="text-align:center">files/{{ $file->filename }}</td>

                                        <td style="text-align:  center">
                                            {{ $file->size }}
                                        </td>

                                        <td style="text-align:  center">{{ $file->created_at->format('H:i d.m.Y') }}</td>
                                        <td style="text-align:  center" class="d-flex justify-content-evenly">
                                            <a title="Скачать файл"
                                                href="{{ asset('public/uploads/files/' . $file->filename) }}"
                                                download="{{ $file->filename }}" class="btn btn-outline-primary"><i
                                                    class="bx bxs-download"></i></a>
                                            <button title="Копировать путь к файлу"
                                                class="btn btn-outline-success copy-button">
                                                <i class="bx bxs-copy"></i>
                                            </button>
                                            <button title="Удалить файл"
                                                onclick="OpenModalDelete( '{{ $file->id }}', '{{ $file->filename }}' )"
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
                            <label class="form-label mb-2">Ф а й л : </label>
                            <input name="filename" id="fileInput" class="form-control" type="file">
                            <span class="text-danger" id="errorText">

                            </span>
                        </div>
                        <div class="form-check form-check-primary mb-3">
                            <input name="original_name" class="form-check-input" type="checkbox" id="formCheckcolor1">
                            <label class="form-check-label" for="formCheckcolor1">
                                Загрузить с оригинальным именем
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" id="submitButton" class="btn btn-primary" disabled>Отправить</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <!-- delete modal content -->
    <div id="DELETE_MODAL" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Вы уверены, что хотите удалить элемент?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="m-2 d-inline-block" action="{{ route('file.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input id="delete_id" type="hidden" name="file_id" value="">
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

    <script>
        $(document).ready(function() {
            $(".copy-button").click(function() {
                // Find the previous sibling <a> element
                var linkElement = $(this).prev('a');

                if (linkElement.length > 0) {
                    // Get the href attribute value
                    var hrefValue = linkElement.attr('href');

                    // Create a temporary textarea element
                    var textarea = $('<textarea>').val(hrefValue).appendTo('body').select();

                    // Copy the selected text
                    document.execCommand('copy');

                    // Remove the temporary textarea
                    textarea.remove();

                    // Optionally, provide some visual feedback to the user
                    // alert('Copied the previous href: ' + hrefValue);
                    LocalCheck('success', 'Ссылка скопировано');

                } else {
                    LocalCheck('error', 'Ошибка')
                }
            });
        });
    </script>

    <script>
        var fileInput = document.getElementById("fileInput");
        var submitButton = document.getElementById("submitButton");
        var errorText = document.getElementById("errorText");

        fileInput.addEventListener("change", function() {
            // Проверяем, есть ли выбранный файл
            if (fileInput.files.length > 0) {
                var selectedFile = fileInput.files[0];

                // Выполняем валидацию расширения файла и размера файла
                if (isValidFileExtension(selectedFile) && isValidFileSize(selectedFile)) {
                    // Если файл подходит, включаем кнопку
                    submitButton.disabled = false;
                } else {
                    // Если файл не подходит, отключаем кнопку
                    submitButton.disabled = true;
                    errorText.textContent = "Неверный формат или размер файла более 30 МБ"; // Показать ошибку
                }
            } else {
                // Если файл не выбран, отключаем кнопку
                submitButton.disabled = true;
            }
        });

        function isValidFileExtension(file) {
            var allowedExtensions = ["avi", "doc", "jpg", "png", "docx", "xls", "xlsx", "mp3", "mp4", "txt", "ppt", "pptx",
                "zip", "pdf"
            ]; // Расширения, которые вы разрешаете

            // Получаем расширение файла
            var fileName = file.name;
            var fileExtension = fileName.split(".").pop().toLowerCase();

            // Проверяем, соответствует ли расширение разрешенным
            return allowedExtensions.includes(fileExtension);
        }

        function isValidFileSize(file) {
            var maxSizeInBytes = 30 * 1024 * 1024; // Максимальный размер файла в байтах (в данном случае, 30 MB)

            // Проверяем, не превышает ли размер файла максимальный
            return file.size <= maxSizeInBytes;
        }
    </script>
@endsection
