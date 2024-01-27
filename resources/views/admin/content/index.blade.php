@foreach ($findContentTYpe as $content)
@endforeach
@php
    $cols = [];
@endphp
@extends('admin.layout.layout')
@section('header-links')
    <!-- DataTables -->
    <link href="{{ asset('public/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('page-name')
    <h4 class="mb-sm-0 font-size-18">Добавить {{ $content->name }}</h4>
    <a href="{{ route('contentTypePageAdd', $content->dt) }}" class="btn btn-primary waves-effect waves-light"> Добавить
        + </a>
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
                                    <th>id</th>
                                    @foreach ($findFeilds as $feild)
                                        <th>{{ $feild->label }}</th>
                                        @php
                                            array_push($cols, $feild->name);
                                        @endphp
                                    @endforeach
                                    <th>Действия</th>
                                </tr>
                            </thead>


                            <tbody>

                                @php
                                    $count = count($cols);
                                    $contForech = 0;
                                    $ColsQuery = 'SELECT id,  ';
                                    foreach ($cols as $col) {
                                        $contForech++;
                                        if ($contForech == $count) {
                                            $ColsQuery .= $col . ' ';
                                        } else {
                                            $ColsQuery .= $col . ', ';
                                        }
                                    }
                                    $ColsQuery .= "FROM `$content->dt`";
                                    $ColsQuery = DB::select("$ColsQuery");
                                @endphp
                                @foreach ($ColsQuery as $colsShow)
                                    <tr>


                                        @foreach ($colsShow as $keyss)
                                            <td class="text_limit text-center">{{ $keyss }}</td>
                                        @endforeach


                                        <td class="text-center">
                                            <a href="{{ route('contentTypeEdit', [$content->dt, $colsShow->id]) }}"
                                                class="btn btn-outline-warning"><i class="bx bx-pencil"></i></a>
                                            <button type="button"
                                                onclick="DleteContent('{{ $content->dt }}','{{ $colsShow->id }}', {{ $content->id }})"
                                                class="btn btn-outline-danger">
                                                <i class="bx bx-trash"></i> </button>
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

    <!-- DELETE MODAL -->
    <div class="modal fade" id="DELETE" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="DELETE" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('contentTypeDelete') }}" method="POST">
                        @csrf
                        <h2>Вы действительно хотите удалить <span class="text-danger" id="current_lang"></span> этот
                            конент ?</h2>
                        <input type="hidden" name="delete_id" id="deleteid">
                        <input type="hidden" name="delete_table" id="delete_table">
                        <input type="hidden" name="content_id" id="content_id">
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
        const myModal2 = new bootstrap.Modal(document.getElementById('DELETE'));

        function DleteContent(dt, id, content_id) {
            myModal2.show();
            $("#delete_table").val(dt);
            $("#deleteid").val(id);
            $("#content_id").val(content_id);
        }

        $(document).ready(function() {

            $('#files-table').DataTable({
                "order": [
                    [0, 'desc']
                ]
            });

            $(".text_limit").text(function(i, text) {
                if (text.length >= 150) {
                    text = text.substring(0, 130);
                    var lastIndex = text.lastIndexOf(" ");
                    text = text.substring(0, lastIndex) + '...';
                }
                $(this).text(text);
            });


        });
    </script>
@endsection
