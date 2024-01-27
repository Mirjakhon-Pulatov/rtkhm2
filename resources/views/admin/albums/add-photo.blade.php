@extends('admin.layout.layout')
@section('header-links')
    <!-- Plugins css -->
    <link href="{{ asset('public/assets/admin/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-name')
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Редактировать альбом</h5>
                    <br>
                    <form action="{{ route('update_album', $CurrentAlbum->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <input name="name" type="text" value="{{ $CurrentAlbum->title }}" class="form-control"
                                    id="AlbumName">
                            </div>
                            <hr>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Изменить</button>
                                <a title="Удалить альбом" onclick="OpenModalDelete( '{{ $CurrentAlbum->id }}' )"
                                    type="button" class="btn btn-danger waves-effect waves-light d-inline-block">
                                    Удалить альбом
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Галерея</h5>

                    <div class="photos">
                        @foreach ($AlbumPhotos as $photo)
                            <div class="photo" style="margin:  5px;">
                                <img onclick="showImage('{{ url('/') }}/public/uploads/gallery/photos/{{ $photo->file }}')"
                                    src="{{ url('/') }}/public/uploads/gallery/thumbnails/{{ $photo->file }}"
                                    width="150" height="auto">
                                <button
                                    onclick="DeleteImage('{{ url('/') }}/public/uploads/gallery/thumbnails/{{ $photo->file }}')"
                                    class="delete_image btn btn-sm btn-danger" type="button"><i class="bx bx-trash"></i>
                                </button>


                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Добавить Фото</h5>
                    <br>

                    <form action="{{ route('addPhoto') }}" method="post" enctype="multipart/form-data" class="dropzone">
                        @csrf
                        <input type="hidden" name="album_id" value="{{ $CurrentAlbum->id }}">
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- delete_image MENU MODAL -->
    <div class="modal fade" id="delete_image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="DELETE_IMAGE" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

                    <div class="w-100 d-flex justify-content-center flex-column">
                        <h2>Удалить это изображение ?</h2>

                        <img id="deleteImg" class="mb-2" style="margin: 0px auto;" src="" width="50%"
                            height="auto">
                    </div>


                    <form action="{{ route('delete-photo') }}" method="POST">
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
    </div>


    <!-- show MODAL -->
    <div class="modal fade modal-xl" id="show_image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="show_image" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

                    <div class="w-100 d-flex justify-content-center flex-column">
                        <img id="showImg" class="mb-2" style="margin: 0px auto;" src="" width="100%"
                            height="auto">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- delete album modal content -->
    <div id="DELETE_MODAL" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Вы уверены, что хотите удалить этот альбом?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="m-2 d-inline-block" action="{{ route('delete_album') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input id="delete_id" type="hidden" name="album_id" value="{{ $CurrentAlbum->id }}">
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
    <!-- Plugins js -->
    <script src="{{ asset('public/assets/admin/libs/dropzone/min/dropzone.min.js') }}"></script>

    <script>
        function OpenModalDelete(album_id) {

            $('#DELETE_MODAL').modal('show');
            $("#delete_id").val(album_id);
            // alert(album_id);

        }

        function showImage(img) {
            var myModalshow = new bootstrap.Modal(document.getElementById('show_image'));
            $('#showImg').attr('src', img);
            myModalshow.show();
        }

        function DeleteImage(img) {

            var myModal = new bootstrap.Modal(document.getElementById('delete_image'));
            $('#deleteImg').attr('src', img);
            $('#delete_id').attr('value', img);
            myModal.show();
        }

        $(document).ready(function() {
            new Dropzone(".dropzone", {
                thumbnailWidth: 200,
                maxFilesize: 4,
                acceptedFiles: ".jpg, .jpeg, .png"
            })


        });
    </script>
@endsection
