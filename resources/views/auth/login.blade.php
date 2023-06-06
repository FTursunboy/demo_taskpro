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
                <h2 class="auth-title">Вход</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    @include('inc.messages')
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" name="login" placeholder="Логин">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" name="password" placeholder="Пароль">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label text-gray-600" for="flexCheckDefault">
                            Запомнить
                        </label>
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <a href="{{ route('forgot.index') }}" class="text-danger">Забыли пароль?</a>
                    </div>

                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Вход</button>
                </form>

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
