@extends('layout.master')
@section('title', 'Error Page')
@section('content')
    <!--======== page404 =========-->
    <section class="page404 sp-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text">
                        <img src="{{ asset('public/asset/img/home/text404.png') }}" alt="not-found">
                    </div>
                    <h2>Sahifa topilmadi</h2>
                    <a href="{{ url('/') }}" class="btn btn-custom">Asosiy sahifa</a>
                </div>
            </div>
        </div>
    </section>
@endsection
