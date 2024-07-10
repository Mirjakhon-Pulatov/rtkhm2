@extends('layout.master')
@section('title', 'Aloqa')
@section('description', 'Romitan tuman 2-son kasb-hunar maktabi, aloqa, murojaat, savollar uchun')
@section('keywords', 'romitan, maktab, tikuvchi, oshpaz, qandolatchi, avtomobillarga xizmat ko`rsatish, operator')
@section('title-og', 'Romitan tuman 2-son kasb-hunar maktabi, aloqa')
@section('desc-og', 'Romitan tuman 2-son kasb-hunar maktabi, aloqa, murojaat, savollar uchun')
@section('img-og',  url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('title-fb', 'Romitan tuman 2-son kasb-hunar maktabi, aloqa')
@section('desc-fb', 'Romitan tuman 2-son kasb-hunar maktabi, aloqa, murojaat, savollar uchun')
@section('img-fb', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('card-tr', 'Romitan kasb-hunar maktabi')
@section('title-tr', 'Romitan tuman 2-son kasb-hunar maktabi, aloqa')
@section('desc-tw', 'Romitan tuman 2-son kasb-hunar maktabi, aloqa, murojaat, savollar uchun')
@section('img-tr', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('content')
    <!--======== banner =========-->
    <section class="banner" style="background-image:url({{ asset('public/asset/img/background-image.webp') }})">
        <div class="banner-heading">
            <h2>Aloqa</h2>
        </div>
        <div class="banner-link">
            <ul>
                <li>
                    <a href="{{ url('/') }}">Asosiy</a>
                    <i class="fa fa-chevron-right"></i>
                </li>
                <li>
                    <a href="{{ url()->current() }}" class="active">Aloqa</a>
                </li>
            </ul>
        </div>
    </section>

    <!-- ====== map ====== -->
    <div id="theme-map" class="map">
        <iframe width="100%" height="500" id="gmap_canvas"
                src="https://maps.google.com/maps?q=39.92522862468795,%2064.37931981122037&t=k&z=17&ie=UTF8&iwloc=&output=embed"
                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
    </div>

    <!-- ====== contact info ====== -->
    <section class="sp-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="all-title mb-30">
                        <h3 class="sec-title">
                            <span>Aloqa</span>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row center-grid">
                        <div class="col-sm-4 col-xs-12">
                            <div class="con-info">
                                <i class="flat flaticon-location-pin"></i>
                                <h5>Manzil</h5>
                                <p>267-A , Street Name Park Sera Avenue , New York, NY 90210</p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="con-info">
                                <i class="flat flaticon-phone-call"></i>
                                <h5>Telefon raqam</h5>
                                <p>Phone 1 : (+098) 7654 3210 </p>
                                <p>Phone 2 : (+123) 4567 8901</p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="con-info">
                                <i class="flat flaticon-email"></i>
                                <h5>Elektron pochta</h5>
                                <p>support@company.com </p>
                                <p>info@company.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-80">
                <div class="col-sm-12">
                    <div class="all-title mb-30">
                        <h3 class="sec-title">
                            <span>Murojaat yuborish</span>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-12">
                    <form action="{{ route('send.email') }}" class="comment-form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-wrap">
{{--                                    <i class="fa fa-user-o"></i>--}}
                                    <input type="text" name="name" class="form-control"
                                           required placeholder="Ism Familiyangizni kiriting">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-wrap">
{{--                                    <i class="fa fa-envelope-o"></i>--}}
                                    <input type="email" name="email" class="form-control"
                                           required placeholder="Elektron pochtangizni kiriting">
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top: 25px;">
                                <div class="form-wrap">
                                    <i class="fa fa-phone"></i>
                                    <input type="text" name="phone" class="form-control"
                                           required placeholder="Telefon raqamingizni kirting">
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top: 25px;">
                                <div class="form-wrap">
                                    <i class="fa fa-pencil"></i>
                                    <input type="text" class="form-control"
                                           required placeholder="Murojaat sarlavhasini kiriting">
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 25px;">
                                <div class="form-wrap">
                                    <i class="fa fa-pencil"></i>
                                    <textarea name="message" placeholder="Murojaatingizni kiriting" class="form-control"
                                              rows="7" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-custom">Yuborish</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
