@extends('layout.master')
@section('title', 'Rahbariyat')

@section('description', 'Romitan tuman 2-son kasb-hunar maktabi, rahbariyat, direktor, Ishlab chiqarish ta’limi bo’yicha direktor o’rinbosari, O`quv ishlari bo`yicha drektor o`rinbosari')
@section('keywords', 'romitan, maktab, rahbar, rahbariyat, direktor, direktor o`rinbosari')
@section('title-og', 'Romitan tuman 2-son kasb-hunar maktabi, Rahbariyat')
@section('desc-og', 'Romitan tuman 2-son kasb-hunar maktabi, rahbariyat, direktor, Ishlab chiqarish ta’limi bo’yicha direktor o’rinbosari, O`quv ishlari bo`yicha drektor o`rinbosari')
@section('img-og',  url('/') . '/public/uploads/gallery/photos/12-50-26_-_03-07-2024_668502c225a11.png' )
@section('title-fb', 'Romitan tuman 2-son kasb-hunar maktabi, Rahbariyat')
@section('desc-fb', 'Romitan tuman 2-son kasb-hunar maktabi, rahbariyat, direktor, Ishlab chiqarish ta’limi bo’yicha direktor o’rinbosari, O`quv ishlari bo`yicha drektor o`rinbosari')
@section('img-fb', url('/') . '/public/uploads/gallery/photos/12-50-26_-_03-07-2024_668502c225a11.png' )
@section('card-tr', 'Romitan kasb-hunar maktabi')
@section('title-tr', 'Romitan tuman 2-son kasb-hunar maktabi, Rahbariyat')
@section('desc-tw', 'Romitan tuman 2-son kasb-hunar maktabi, rahbariyat, direktor, Ishlab chiqarish ta’limi bo’yicha direktor o’rinbosari, O`quv ishlari bo`yicha drektor o`rinbosari')
@section('img-tr', url('/') . '/public/uploads/gallery/photos/12-50-26_-_03-07-2024_668502c225a11.png' )

@section('top-css')
    <style>
        .datas li {
            margin-bottom: 25px;;
        }
    </style>
@endsection
@section('content')

    <!--======== team-detail =========-->
    <section class="bg-w sp-100">
        <div class="container">
            <div class="col-sm-12" style="margin-bottom: 70px;">
                <div class="all-title">
                    <h3 class="sec-title">
                        <span>Rahbariyat</span>
                    </h3>

                </div>
            </div>
            <div class="team-detail">

                <div class="row"
                     style="display: flex; align-items: center; justify-content: space-between; align-content: center; flex-direction: row; flex-wrap: nowrap">
                    <div class="col-md-12" style="margin-left: 140px;">
                        @foreach($leaders as $leader)
                            <div class="row" style="margin-top: 50px; display: flex; align-items: center;">


                                <div class="col-lg-4">
                                    @php
                                        $item_id = $leader->code;
                                        $photo = app('App\Http\Controllers\Featured_imagesController')->getImage('leaders', $item_id);
                                    @endphp
                                    <div class="m-detail-img" style="width: 250px; !important; ">
                                        <div id="rasm" style="
                                            background-image: url('{{ asset('public/uploads/gallery/photos/'.$photo) }}');
                                            background-size: cover;
                                            background-position: center;
                                            background-repeat: no-repeat;
                                            height: 300px!important;">

                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-8">
                                    <div class="member-detail">
                                        <h3 class="text-center">
                                            {{ $leader->name }}
                                        </h3>
                                        <ul class="datas">
                                            <li>
                                                <span
                                                    style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif !important;">Lavozim : </span>
                                                <p style="margin-left: 20px; font-size: 15px;">{{ $leader->lavozim }}</p>
                                            </li>
                                            <li>
                                                <span>Xizmat telefoni : </span>
                                                <p style="margin-left: 20px; font-size: 15px;">{{ $leader->jobphone }}</p>
                                            </li>
                                            <li>
                                                <span>Telefon raqami : </span>
                                                <p style="margin-left: 20px; font-size: 15px;">{{ $leader->phone }}</p>
                                            </li>
                                            <li>
                                                <span>Email : </span>
                                                <p style="margin-left: 20px; font-size: 15px;">{{ $leader->email }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
@section('bottom-script')
@endsection
