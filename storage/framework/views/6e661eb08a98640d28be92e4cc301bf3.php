<?php $__env->startSection('title'); ?><?php echo e($user->surname . ' ' . $user->name.' '. $user->lastname); ?><?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div id="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><?php echo e($user->surname . ' ' . $user->name.' '. $user->lastname); ?></h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Профиль - <?php echo e($user->surname . ' ' . $user->name.' '. $user->lastname); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="row pt-4">
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h3>Список сотрудников</h3>
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ФИО</th>
                                <th>Должность</th>
                                <th>Статус</th>
                                <th>Последнее посещение</th>
                                <th>Телефон</th>
                                <th>Прогресс (макс: 1000)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->index+1); ?></td>
                                    <td><?php echo e(\Str::limit($employee->surname. ' '. $employee->name.' '. $employee->lastname, 20)); ?></td>
                                    <td><?php echo e($employee->position); ?></td>
                                    <td>
                                        <?php if(Cache::has('user-is-online-' . $employee?->id)): ?>
                                            <span class="text-center text-success mx-2"><b>Online</b></span>
                                        <?php else: ?>
                                            <span class="text-center text-danger  mx-2"><b>Offline</b></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($employee->last_seen === null || Cache::has('user-is-online-' . $employee?->id) === true ? " " : \Carbon\Carbon::parse($employee?->last_seen)->diffForHumans()); ?></td>
                                    <td><?php echo e($employee->phone); ?></td>
                                    <td>
                                        <?php switch($employee->xp):
                                            case ($employee->xp > 0 && $employee->xp <= 99 ): ?>
                                            <div class="progress progress-success progress-sm" title="<?php echo e($employee->xp); ?>xp">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo e($employee->xp / 10); ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <?php break; ?>
                                            <?php case ($employee->xp > 99 && $employee->xp < 299 ): ?>
                                            <div class="progress progress-success progress-sm" title="<?php echo e($employee->xp); ?>xp">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo e($employee->xp / 10); ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <?php break; ?>
                                            <?php case ($employee->xp > 299 && $employee->xp < 700 ): ?>
                                            <div class="progress progress-success progress-sm" title="<?php echo e($employee->xp); ?>xp">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo e($employee->xp / 10); ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <?php break; ?>
                                            <?php case ($employee->xp > 699 && $employee->xp < 1000 ): ?>
                                            <div class="progress progress-success progress-sm" title="<?php echo e($employee->xp); ?>xp">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo e($employee->xp / 10); ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <?php break; ?>
                                        <?php endswitch; ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-center mb-3">
                            <?php if(isset(Auth::user()->avatar)): ?>
                                <img style="border-radius: 50% " id="avatar" onclick="img()" src="<?php echo e(asset('storage/'.\Illuminate\Support\Facades\Auth::user()->avatar)); ?>" alt="" width="100" height="100">
                            <?php else: ?>
                                <img style="border-radius: 50% " id="avatar" onclick="img()" src="<?php echo e(asset('assets/images/logo/favicon.svg')); ?>" alt="" width="100" height="100">
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-center mb-3">
                        </div>

                    </div>
                    <div class="card-body">
                        <h5 class="text-center"><?php echo e($user->surname . ' ' .$user->name); ?></h5>
                        <div>
                            <table class="mt-3" cellpadding="5">
                                <tr>
                                    <th>Проекты: </th>
                                    <th><span class="mx-2"><?php echo e($user->projectCount()); ?></span></th>
                                </tr>
                                <tr>
                                    <th>Клиенты :</th>
                                    <th><span class="mx-2"><?php echo e($user->clientCount()); ?></span></th>
                                </tr>
                                <tr>
                                    <th>Идеи :</th>
                                    <th><span class="mx-2"> <?php echo e($user->ideaCountProfile()); ?></span></th>
                                </tr>
                                <tr>
                                    <th>Баланс :</th>
                                    <th><span class="mx-2"> <?php echo e($settings->balance??0); ?> </span></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            <a href="<?php echo e(route('profile.show')); ?>" class="btn btn-success"><i class="bi bi-eye"></i></a>
                            <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-primary mx-2"><i class="bi bi-pencil"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/c/cx34222/taskosonmarket/resources/views/admin/profile/index.blade.php ENDPATH**/ ?>