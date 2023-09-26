<?php $__env->startSection('title'); ?>Сотрудники<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div id="page-heading">
        <a href="<?php echo e(route('employee.create')); ?>" class="btn btn-outline-primary mb-2">
            Добавить нового сотрудника
        </a>

        <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <section class="section">
            <div class="row pt-4">
                <table class="table table-hover">
                    <thead>
                        <th>#</th>
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Задачи</th>
                        <th>Готовыe</th>
                        <th>Статус</th>
                        <th>Действия</th>

                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($user->surname . ' ' . $user->name .' '. $user->lastname); ?></td>
                        <td><?php echo e($user->phone); ?></td>
                        <td><?php echo e($user->taskCount($user->id)); ?> </td>
                        <td><?php echo e($user->taskSuccessCount($user->id)); ?></td>
                        <td><?php if($user->deleted_at): ?>
                           <span style="color: red; font-weight: bold">Неактивен</span>
                            <?php else: ?>
                            <span style="color: green; font-weight: bold">Активен</span>
                            <?php endif; ?>
                        </td>
                        <?php if($user->deleted_at): ?>
                            <td></td>
                        <?php else: ?>
                            <td>
                                <a href="<?php echo e(route('employee.show', $user->slug)); ?>" class="btn btn-success"><i
                                        class="bi bi-eye"></i></a>
                                <a href="<?php echo e(route('employee.edit', $user->slug)); ?>" class="btn btn-primary mx-2"><i
                                        class="bi bi-pencil"></i></a>
                                <a role="button" class="btn btn-danger" data-bs-toggle="modal"
                                   data-bs-target="#delete<?php echo e($user->slug); ?>"><i class="bi bi-trash"></i></a>
                            </td>
                        <?php endif; ?>

                    </tr>
                    <div class="modal fade" id="delete<?php echo e($user->slug); ?>" tabindex="-1" aria-labelledby="delete<?php echo e($user->slug); ?>"
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tasks\resources\views/admin/employee/index.blade.php ENDPATH**/ ?>