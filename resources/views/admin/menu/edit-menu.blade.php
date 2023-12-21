@if(isset($menus_currnet))
    @foreach($menus_currnet as $ms)@endforeach
@endif

@extends('admin.layout.layout')
@section('header-links')
@endsection
@section('page-name')
    <h4 class="mb-sm-0 font-size-18">Добавить меню</h4>
    <div class="right">

        <a href="{{ route('pageUpdate', ['id' => $ms->id]) }}"
           class="btn @if(!isset($CurrentLang)) btn-success @endif  waves-effect waves-light"> <i
                class="bx bx-link-alt"></i></a>
        @foreach($Languages as $lang)
            <a href="{{ route('pageUpdate', ['id' => $ms->id]) }}/{{ $lang->slug }}/"
               class="btn @if(isset($CurrentLang)) @if($CurrentLang == $lang->slug) btn-success @else  @endif @endif  waves-effect waves-light">{{ $lang->lang }}</a>
        @endforeach


    </div>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(!isset($CurrentLang))
                        <form action="{{ route('menu.update', $ms->id) }}" method="POST"> @else
                                <form action="{{ route('menu.update', ['id' => $ms->id, 'lang' => $CurrentLang]) }}"
                                      method="POST"> @endif

                                    @csrf

                                    <input type="hidden" name="id" value="{{$ms->id}}">
                                    @if(isset($CurrentLang))
                                        <input type="hidden" name="lang" value="{{ $CurrentLang }}">
                                    @endif
                                    <div class="mb-3">
                                        <label class="form-label">Загаловок</label>
                                        <input name="title" type="text" required value="{{ $ms->title  }}"
                                               class="form-control"
                                               placeholder="Введите Загаловок">
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Родитель</label>
                                                <select name="parent_id" class="form-select">
                                                    <option value="0" selected>Не один</option>
                                                    @foreach ($menus as $menu)
                                                        <option @if($ms->id == $menu->id) disabled @endif
                                                        @if($ms->parent_id == $menu->id) selected @endif
                                                                value="{{ $menu->id }}">{{ $menu->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Ссылка</label>
                                                <input name="link" type="text" class="form-control"
                                                       value="{{ $ms->link  }}" placeholder="Ссылка">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Индекс</label>
                                                <input type="number" required name="index" class="form-control"
                                                       placeholder="Введите индекс" value="{{ $ms->index }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary" type="submit">Изменить</button>
                                        </div>
                                    </div>
                                </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-links')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
