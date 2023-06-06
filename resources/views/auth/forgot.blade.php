<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма входа</title>
    <link rel="stylesheet" href="{{asset('assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/pages/auth.css')}}">
</head>

<body>
<div id="auth">

    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="#"><img src="{{ asset('assets/images/logo/logo2.svg')}}" alt="Logo"></a>
                </div>
                <h1 class="auth-title">Забыли пароль</h1>
                <p class="auth-subtitle mb-5">Для восстановление пароля введите логин </p>
                @if(\Session::has('error'))
                    <div class="alert alert-danger">
                        <p class="text-center">{{ \Session::get('error') }}</p>
                    </div>
                @endif
                <form action="{{ route('forgot.update') }}" method="POST">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Логин" required name="login"   value="{{ old('login') }}">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Изменить</button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'><a href="{{ route('login') }}" class="font-bold">Вход</a>.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>

</div>
</body>

</html>
