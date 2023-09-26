<?php $__env->startSection('title'); ?><?php echo e($user->surname . ' ' . $user->name.' '. $user->lastname); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
    <div id="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><?php echo e($user->surname . ' ' . $user->name.' '. $user->lastname); ?></h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('employee.index')); ?>">Соотрудники </a></li>
                            <li class="breadcrumb-item active"
                                aria-current="page"><?php echo e($user->surname . ' ' . $user->name.' '. $user->lastname); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </div>
    <div class="mb-2">
        <a href="<?php echo e(route('employee.show', $user->slug)); ?>" class="btn btn-outline-danger ">
            Назад
        </a>

        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addUser">
            Добавить сотрудник в камандой
        </button>
        <div class="modal fade" id="addUser" data-bs-backdrop="static"
             data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="addUser" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addUser">Выберите
                            сотрудник</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <form action="<?php echo e(route('employee.addUserInCommand', [$user->id, $project->id])); ?>"
                          method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group mt-4">
                                <label for="select_users_command">Выберите участники команда <span
                                            class="text-danger">*</span></label>
                                <select multiple id="users" class="" name="users[]"
                                        class="form-select">
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $isInCommand = false;
                                        ?>

                                        <?php $__currentLoopData = $commands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $use): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($u->id === $use->id): ?>
                                                <?php
                                                    $isInCommand = true;
                                                    break;
                                                ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php if($u->id !== $user->id && !$isInCommand): ?>
                                            <option value="<?php echo e($u->id); ?>"><?php echo e($u->surname . ' ' . $u->name . ' ' . $u->lastname); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Отмена
                            </button>
                            <button type="submit" class="btn btn-primary">Добавить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="section">
        <div class="row pt-4">
            <div class="col-9">
                <h4 class="mb-3">Учатсники</h4>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="40px">#</th>
                                <th>ФИО</th>
                                <th width="100px">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $commands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $use): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="text-center">
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($use->surname . ' ' . $use->name . ' ' . $use->lastname); ?><?php echo e(($use->id === $user->id) ? ' - (Тимлид)' : ''); ?></td>
                                    <td>
                                        <a role="button" data-bs-toggle="modal"
                                           data-bs-target="#deleteFromCommand<?php echo e($use->id); ?>"
                                           class="badge bg-danger"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteFromCommand<?php echo e($use->id); ?>" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteFromCommand<?php echo e($use->id); ?>"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deleteFromCommand<?php echo e($use->id); ?>">Modal
                                                    title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form
                                                    action="<?php echo e(route('employee.deleteUserInGroup', [$user->id, $use->pro_id, $use->id])); ?>"
                                                    method="POST">
                                                <?php echo csrf_field(); ?>
                                                <div class="modal-body">
                                                    Точно хотите удалить из камандой?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Отмена
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">Да</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                            <?php if(isset($user->avatar)): ?>
                                <img style="border-radius: 50% " id="avatar" onclick="img()"
                                     src="<?php echo e(asset('storage/'.$user->avatar)); ?>" alt="" width="100" height="100">
                            <?php else: ?>
                                <img style="border-radius: 50% " id="avatar" onclick="img()"
                                     src="<?php echo e(asset('assets/images/logo/favicon.svg')); ?>" alt="" width="100"
                                     height="100">
                            <?php endif; ?>
                        </div>

                        <?php switch($user->xp):
                            case ($user->xp > 0 && $user->xp <= 99 ): ?>
                            <div>
                                <div class="d-flex justify-content-end">
                                    <?php echo e($user->xp); ?> / 100
                                </div>
                            </div>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                     style="width: <?php echo e($user->xp); ?>%" aria-valuenow="<?php echo e($user->xp); ?>"
                                     aria-valuemin="0"
                                     aria-valuemax="300"></div>
                            </div>
                            <?php break; ?>
                            <?php case ($user->xp > 99 && $user->xp < 299 ): ?>
                            <div>
                                <div class="d-flex justify-content-end">
                                    <?php echo e($user->xp); ?> / 300 (xp)
                                </div>
                            </div>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                     style="width: <?php echo e($user->xp/3); ?>%" aria-valuenow="<?php echo e($user->xp); ?>"
                                     aria-valuemin="0"
                                     aria-valuemax="300"></div>
                            </div>
                            <?php break; ?>
                            <?php case ($user->xp > 299 && $user->xp < 700 ): ?>
                            <div>
                                <div class="d-flex justify-content-end">
                                    <?php echo e($user->xp); ?>xp / 700 (xp)
                                </div>
                            </div>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                     style="width: <?php echo e($user->xp / 7); ?>%" aria-valuenow="<?php echo e($user->xp); ?>"
                                     aria-valuemin="0"
                                     aria-valuemax="700"></div>
                            </div>
                            <?php break; ?>
                            <?php case ($user->xp > 699 && $user->xp < 1000 ): ?>
                            <div>
                                <div class="d-flex justify-content-end">
                                    <?php echo e($user->xp); ?> / 1000 (xp)
                                </div>
                            </div>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                     style="width: <?php echo e($user->xp / 10); ?>%" aria-valuenow="<?php echo e($user->xp); ?>"
                                     aria-valuemin="0"
                                     aria-valuemax="1000"></div>
                            </div>
                            <?php break; ?>
                        <?php endswitch; ?>

                    </div>
                    <div class="card-body">
                        <h5 class="text-center"><?php echo e($user->surname . ' ' .$user->name .' '. $user->lastname); ?></h5>
                        <div>
                            <table class="mt-3" cellpadding="5">
                                <tr>
                                    <th>Задачи:</th>
                                    <th><span class="mx-2"><?php echo e($user->taskCount($user->id)); ?></span></th>
                                </tr>
                                <tr>
                                    <th>Завершенный :</th>
                                    <th><span class="mx-2"><?php echo e($user->taskSuccessCount($user->id)); ?></span></th>
                                </tr>
                                <tr>
                                    <th>Идеи :</th>
                                    <th><span class="mx-2"> <?php echo e($user->ideaCount($user->id)); ?></span></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            <a href="<?php echo e(route('employee.edit', $user->slug)); ?>" class="btn btn-primary mx-2"><i
                                        class="bi bi-pencil"></i></a>
                            <a role="button" class="btn btn-danger" data-bs-toggle="modal"
                               data-bs-target="#delete<?php echo e($user->slug); ?>"><i class="bi bi-trash"></i></a>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="delete<?php echo e($user->slug); ?>" tabindex="-1"
                     aria-labelledby="delete<?php echo e($user->slug); ?>"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="<?php echo e(route('employee.destroy', $user->slug)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="delete<?php echo e($user->slug); ?>">Предупреждение</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Точно хотите удалить
                                    <b>'<?php echo e($user->surname.' '. $user->name.' '. $user->lastname); ?>'</b>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет
                                    </button>
                                    <button type="submit" class="btn btn-danger">Да, хочу удалить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('users', {
            rounded: true,    // default true
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tasks\resources\views/admin/employee/command/command_show.blade.php ENDPATH**/ ?>