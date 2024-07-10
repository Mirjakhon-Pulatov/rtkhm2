@extends('layout.master')
@section('title', 'Faq')

@section('description', 'Romitan tuman 2-son kasb-hunar maktabi, faq, чаво, Katta yoshdagi fuqarolarga kollejda o`qishlari uchun imkoniyat berilganmi, Kollejda o’qish muddatlari haqida, Men Oily ta’lim muassasasiga hujjat topshirdim, kollejga ham hujjat topshirib  qoysam bo`ladimi?, Kollejga 9-sinf bitiruvchilari ham hujjat topshirishi mumkinmi')
@section('keywords', 'romitan, maktab, kontrakt narx, uqish muddat, diplom')
@section('title-og', 'Romitan tuman 2-son kasb-hunar maktabi, faq, tez-tez so`raladigan savollar')
@section('desc-og', 'Romitan tuman 2-son kasb-hunar maktabi, faq, чаво, Katta yoshdagi fuqarolarga kollejda o`qishlari uchun imkoniyat berilganmi, Kollejda o’qish muddatlari haqida, Men Oily ta’lim muassasasiga hujjat topshirdim, kollejga ham hujjat topshirib  qoysam bo`ladimi?, Kollejga 9-sinf bitiruvchilari ham hujjat topshirishi mumkinmi')
@section('img-og',  url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('title-fb', 'Romitan tuman 2-son kasb-hunar maktabi, faq, tez-tez so`raladigan savollar')
@section('desc-fb', 'Romitan tuman 2-son kasb-hunar maktabi, faq, чаво, Katta yoshdagi fuqarolarga kollejda o`qishlari uchun imkoniyat berilganmi, Kollejda o’qish muddatlari haqida, Men Oily ta’lim muassasasiga hujjat topshirdim, kollejga ham hujjat topshirib  qoysam bo`ladimi?, Kollejga 9-sinf bitiruvchilari ham hujjat topshirishi mumkinmi')
@section('img-fb', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )
@section('card-tr', 'Romitan kasb-hunar maktabi')
@section('title-tr', 'Romitan tuman 2-son kasb-hunar maktabi, faq, tez-tez so`raladigan savollar')
@section('desc-tw', 'Romitan tuman 2-son kasb-hunar maktabi, faq, чаво, Katta yoshdagi fuqarolarga kollejda o`qishlari uchun imkoniyat berilganmi, Kollejda o’qish muddatlari haqida, Men Oily ta’lim muassasasiga hujjat topshirdim, kollejga ham hujjat topshirib  qoysam bo`ladimi?, Kollejga 9-sinf bitiruvchilari ham hujjat topshirishi mumkinmi')
@section('img-tr', url('/') . '/public/uploads/gallery/photos/slide1.jpg' )

@section('top-css')
@endsection
@section('content')
    <section class="sp-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="all-title">
                        <h3 class="sec-title">
                            <span>Tez-tez beriladigan savollar</span>
                        </h3>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <ul class="corp-accordion" id="accordion1">
                        @php $count = 0; $faqs = \Illuminate\Support\Facades\DB::select("SELECT * from `faq` order by `position`  ");  @endphp
                        @foreach($faqs as  $faq)
                            @php
                                $count++;
                            @endphp
                            <li class="panel">
                                <a class="panel-link collapsed" data-toggle="collapse" data-parent="#accordion1"
                                   href="#accord{{$count}}"> {{$faq->quest}}</a>
                                <div id="accord{{$count}}" class="collapse">
                                    <div class="acc-content">
                                        <p>
                                            @php
                                                $body = $faq->answer;
                                                $answer = html_entity_decode($body);
                                                echo $answer;
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('bottom-script')
@endsection
