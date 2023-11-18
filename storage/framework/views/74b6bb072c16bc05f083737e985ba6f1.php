<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/main/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/main/app-dark.css')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/logo/favicon.svg')); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/logo/favicon.png')); ?>" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/shared/iconly.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/widgets/chat.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/my-style.css')); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <?php echo $__env->yieldContent('css'); ?>
</head>

<body>

<div id="app">
        <?php echo $__env->make('user.incs.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="main" class='layout-navbar'>
        <?php echo $__env->make('user.incs.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div id="main-content" class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</div>


<script src="<?php echo e(asset('assets/js/bootstrap.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/app.js')); ?>"></script>
<script src="<?php echo e(asset('assets/extensions/apexcharts/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/pages/dashboard.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/my-script.js')); ?>"></script>
<script>


</script>
<?php echo $__env->yieldContent('script'); ?>
</body>

</html>
<?php /**PATH /home/c/cx34222/taskosonmarket/resources/views/user/layouts/app.blade.php ENDPATH**/ ?>