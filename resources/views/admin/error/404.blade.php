@extends('admin.layout.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h1 class="display-2 fw-medium">4<i class="bx bx-buoy bx-spin text-primary display-3"></i>4</h1>
                    <h4 class="text-uppercase">Извините страница не найдена</h4>
                    <div class="mt-4 text-center">
                        <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard') }}">Вернутся на
                            главную</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-xl-6">
                <div>
                    <img src="{{ asset('public/assets/admin/images/error-img.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection
