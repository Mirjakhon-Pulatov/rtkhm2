@extends('admin.layout.layout')
@section('header-links')
@endsection
@section('page-name')
    <h4 class="mb-sm-0 font-size-18">Альбомы</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" type="button">Добавить +
    </button>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <div class="row mt-2">


                        @foreach ($albums as $album)
                            @php
                                $COUNT = \Illuminate\Support\Facades\DB::select("  SELECT COUNT(id) FROM `gallerys` where album_id  = '$album->id' ");
                            @endphp

                            <div class="col-lg-2 col-md-12 col-sm-4 col-12 mt-3">
                                <a href="{{ route('showalbum', $album->id) }}">
                                    <div class="album_item">
                                        <img class="img-thumbnail gallery_img img-fluid" width="100%" height="auto"
                                            src="{{ asset('public/assets/admin/images/folder.png') }}" alt="folder">
                                        <p class=" w-100 text-center">{{ $album->title }}
                                            ({{ $COUNT[0]->{'COUNT(id)'} }})
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- ADD MENU MODAL -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('storealbum') }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Добавить Альбом</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Загаловок</label>
                            <input name="title" type="text" required class="form-control"
                                placeholder="Введите Загаловок">
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

    <style>
        .gallery_img {
            background: #f2f2f2;
            padding: 15px !important;
            margin: 0px !important;
        }

        .album_item {
            transition: all ease-in-out 0.3s;
            color: #000000;
        }

        .album_item:hover {
            transition: all ease-in-out 0.3s;
            border-radius: 7px;
            transform: scale(1.100);
        }
    </style>
@endsection

@section('footer-links')
    <script>
        $(document).ready(function() {

        });
    </script>

    @include('admin.blocks.tinymce')
@endsection
