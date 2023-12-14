@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Настройки информации</h4>

                    <form action="{{ route('profile.update', \Illuminate\Support\Facades\Auth::user()->id ) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <label for="horizontal-login-input" class="col-sm-3 col-form-label">Логин</label>
                            <div class="col-sm-9">
                                <input value="{{ \Illuminate\Support\Facades\Auth::user()->login }}" name="login"
                                       type="text"
                                       class="form-control @error('login') is-invalid @enderror"
                                       id="horizontal-login-input">
                                @error('login')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Эл. Адрес</label>
                            <div class="col-sm-9">
                                <input value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" name="email"
                                       type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="horizontal-email-input">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-old-password-input" class="col-sm-3 col-form-label">Текущий Пароль</label>
                            <div class="col-sm-9">
                                <input type="password" name="old_password"
                                       class="form-control @error('old_password') is-invalid @enderror"
                                       id="horizontal-old-password-input" required>
                                @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-4">
                            <label for="horizontal-password-input" class="col-sm-3 col-form-label">Новый Пароль</label>
                            <div class="col-sm-9">
                                <input type="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       id="horizontal-password-input" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary w-md">Сохранить изменения</button>
                        </div>


                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
