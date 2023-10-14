<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма входа</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/main/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/pages/auth.css')); ?>">
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
                    <a href="#"><img src="<?php echo e(asset('assets/images/logo/logo 12.svg')); ?>" alt="Logo"></a>
                </div>
                <h2 class="auth-title">Вход</h2>
                <form action="<?php echo e(route('login')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                        <a href="<?php echo e(route('forgot.index')); ?>" class="text-primary">Забыли пароль?</a>
                    </div>

                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Вход</button>
                </form>

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
                            <span class="fs-5 text-white"><i class="bi bi-telegram mx-4"></i> <a target="_blank" href="https://t.me/FINGROUPParviz" class="text-white">Telegram</a></span>
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
<?php /**PATH E:\Xammp\htdocs\tasks\resources\views/auth/login.blade.php ENDPATH**/ ?>