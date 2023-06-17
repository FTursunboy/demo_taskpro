<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма входа</title>
    <link rel="stylesheet" href="{{asset('assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/pages/auth.css')}}">
    <style>
        .centered-div {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Adjust as needed */
            background:linear-gradient(90deg,#2d499d,#3f5491)
        }
    </style>
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
            <div class="centered-div">
                <div>
                    <h1 class="text-white text-center mb-3">FIN Group</h1>
                    <div class="row">
                        <div class="col-12">
                            <span class="fs-5 text-white"><i class="bi bi-telephone mx-4"></i> (+992) 92 - 555 - 63 - 63</span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12">
                            <span class="fs-5 text-white"><i class="bi bi-globe mx-4"></i> <a target="_blank" href="https://fingroup.tj/" class="text-white">fingroup.tj</a></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <span class="fs-5 text-white"><i class="bi bi-telegram mx-4"></i> <a target="_blank" href="https://t.me/shahobovN" class="text-white">Telegram</a></span>
                        </div>
                    </div>

                    <div class="row my-2" >
                        <div class="col-12">
                            <span class="fs-5 text-white"><i class="bi bi-envelope mx-4"></i> <a target="_blank" href="mailto: info@fingroup.tj" class="text-white">info@fingroup.tj</a></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
</body>

</html>
