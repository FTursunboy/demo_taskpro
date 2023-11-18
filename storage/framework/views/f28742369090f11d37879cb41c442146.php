<?php $__env->startSection('title'); ?>
    Изменение сотрудника
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><?php echo e($user->surname .' '.$user->name.' '.$user->lastname); ?></h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('employee.index')); ?>">Список сотрудников</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e($user->surname .' '.$user->name.' '.$user->lastname); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="<?php echo e(route('employee.index')); ?>" class="btn btn-outline-danger">
                        Назад
                    </a>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('employee.update', $user->slug)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Имя <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" tabindex="1" class="form-control mt-3"
                                           value="<?php echo e($user->name); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="role">Роль<span class="text-danger">*</span></label>
                                    <select id="role" name="role" class="form-select mt-3" tabindex="4" required>
                                        <option value="" selected>Выбирите роль</option>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>" <?php echo e(($role->name === $user->getRoleNames()[0]) ? 'selected' : ''); ?>><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="login">Логин<span class="text-danger">*</span></label>
                                    <input type="text" id="login" name="login" class="form-control mt-3"
                                           value="<?php echo e($user->login); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="otdel_id">Отдел<span class="text-danger">*</span></label>
                                    <select id="otdel_id" name="otdel_id" tabindex="9" class="form-select mt-3" required>
                                        <option value="" selected>Выбирите отдел</option>
                                        <?php $__currentLoopData = $departs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $depart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($depart->id); ?>" <?php echo e(($depart->id === $user->otdel_id) ? 'selected' : ''); ?>><?php echo e($depart->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="birthday">День рождение</label>
                                    <input type="date" name="birthday" id="birthday" tabindex="13" class="form-control mt-3" value="<?php echo e($user->birthday); ?>">
                                </div>
                            </div>
                            <div class="col-4">

                                <div class="form-group">
                                    <label for="surname">Фамилия<span class="text-danger">*</span></label>
                                    <input type="text" id="surname" name="surname" tabindex="2" class="form-control mt-3" value="<?php echo e($user->surname); ?>"
                                           required>
                                </div>


                                <div class="form-group">
                                    <label for="phone">Телефон<span class="text-danger">*</span></label>
                                    <input type="text" id="phone" name="phone" tabindex="5" class="form-control mt-3" value="<?php echo e($user->phone); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Пароль (password)<span class="text-danger">*</span></label>
                                    <input type="password" id="password" name="password" tabindex="7" class="form-control mt-3" value="">
                                </div>

                                <div class="form-group">
                                    <label for="file">Изображение</label>
                                    <input type="file" name="avatar" tabindex="11" class="form-control mt-3" id="file">
                                </div>

                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="lastname">Отчество</label>
                                    <input type="text" id="lastname" name="lastname" tabindex="3" class="form-control mt-3" value="<?php echo e($user->lastname); ?>">
                                </div>


                                <div class="form-group">
                                    <label for="position">Должность<span class="text-danger">*</span></label>
                                    <input type="text" id="position" name="position" tabindex="6" class="form-control mt-3" value="<?php echo e($user->position); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="telegram_id">Телеграм ID<span class="text-danger">*</span></label>
                                    <input type="number" id="telegram_id" name="telegram_id" tabindex="8" class="form-control mt-3" value="<?php echo e($user->telegram_user_id); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="client_email" class="form-label">Почта</label>
                                    <input value="<?php echo e($user?->clientEmail?->email); ?>" tabindex="10" type="text" name="client_email"
                                           class="form-control mt-2" placeholder="Почта"
                                           id="client_email">
                                </div>

                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-outline-primary" tabindex="12">Изменить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/c/cx34222/taskosonmarket/resources/views/admin/employee/edit.blade.php ENDPATH**/ ?>