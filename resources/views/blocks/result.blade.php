@extends('layout.master')
@section('title', 'Qidiruv paneli')
@section('top-css')
    <style>
        .link:hover {
            color: #0c65ed;
            text-decoration: underline;
        }
    </style>
@endsection
@section('content')
    <!--======== blog detail =========-->
    <section class="sp-70-100">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="content-list">
                        <h3 class="dis" style="color: black; font-weight: bold; margin-bottom: 10px;"> "{{ $search }}"
                            uchun qidiruv
                            natijalari: </h3>
                        @if($query->isEmpty())
                            <p style="font-size: 17px;">Ushbu so'rov bo'yicha hech narsa topilmadi.</p>
                        @else
                            <ul>
                                @foreach ($query as $item)
                                    <li style="font-size: 15px; padding-bottom: 10px;">
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href="{{route('page', ['slug'=>$item->slug])}}"
                                           class="link">{{ $item->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                </div>
                @include('blocks.sidebar')
            </div>
        </div>
    </section>
@endsection
@section('bottom-script')
@endsection
