<?php $__env->startSection('title'); ?>
    Задачи
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Список задач клиентам</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('tasks_client.index')); ?>">Список задач клиентам</a></li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
                    <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php if(session('mess')): ?>
            <div class="alert alert-success">
                <?php echo e(session('mess')); ?>

            </div>
        <?php endif; ?>
        <section class="section">
            <div class="card">
                <div class="card-header">

                            <a href="<?php echo e(route('tasks_client.create')); ?>" class="btn btn-outline-primary">
                                Добавить задачу
                            </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Клиент</th>
                            <th>Описание</th>
                            <th>Статус</th>
                            <th>Действие</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>

                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($task->name); ?></td>
                                <td><?php echo e($task->client->name); ?></td>
                                <td><?php echo e(\Illuminate\Support\Str::limit($task->description, 20)); ?></td>
                                <?php if($task->status->id == 1): ?>
                                    <td><a href="#" data-bs-target="#send<?php echo e($task->id); ?>" data-bs-toggle="modal"><span class="badge bg-warning p-2">Ожидается </span></a>
                                    </td>
                                <?php elseif($task->status->id == 2): ?>
                                    <td><span class="badge bg-primary p-2"><?php echo e($task->status->name); ?></span>
                                    </td>
                                <?php elseif($task->status->id == 3): ?>
                                    <td><span class="badge bg-success p-2"><?php echo e($task->status->name); ?></span>
                                    </td>
                                <?php elseif($task->status->id == 4): ?>
                                    <td><span class="badge bg-success p-2"><?php echo e($task->status->name); ?></span>
                                    </td>
                                <?php elseif($task->status->id == 5): ?>
                                    <td><a data-bs-target="#sendBack<?php echo e($task->id); ?>" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2"><?php echo e($task->status->name); ?></span></a>
                                    </td>
                                <?php elseif($task->status->id == 6): ?>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#send<?php echo e($task->id); ?>"><span class="badge bg-primary p-2">Проверьте и отправьте клиенту</span></a>
                                    </td>
                                <?php elseif($task->status->id == 7): ?>
                                    <td><span class="badge bg-warning p-2"><?php echo e($task->status->name); ?></span>
                                    </td>
                                <?php elseif($task->status->id == 8): ?>
                                    <td><span class="badge bg-warning p-2"><?php echo e($task->status->name); ?></span>
                                    </td>
                                <?php elseif($task->status->id == 9): ?>
                                    <td><span class="badge bg-warning p-2"><?php echo e($task->status->name); ?></span>
                                    </td>
                                <?php elseif($task->status->id == 10): ?>
                                    <td><span class="badge bg-success p-2"><?php echo e($task->status->name); ?></span>
                                    </td>
                                <?php elseif($task->status->id == 11): ?>
                                    <td><span class="badge bg-danger p-2"><?php echo e($task->status->name); ?></span>
                                    </td>
                                <?php elseif($task->status->id == 12): ?>
                                    <td><a data-bs-target="#sendBack<?php echo e($task->id); ?>" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2"><?php echo e($task->status->name); ?></span></a>
                                    </td>
                                <?php elseif($task->status->id == 13): ?>
                                    <td><a data-bs-target="#sendBack<?php echo e($task->id); ?>" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2"><?php echo e($task->status->name); ?></span></a>
                                    </td>
                                <?php elseif($task->status->id == 14): ?>
                                    <td><a href="#" data-bs-target="#send<?php echo e($task->id); ?>" data-bs-toggle="modal"><span class="badge bg-success p-2">Задача сделана, отправьте клиенту на проверку</span></a>
                                    </td>
                                <?php endif; ?>
                                    <td>
                                        <a class="badge bg-success p-2" href="<?php echo e(route('tasks_client.show', $task->id)); ?>"><i class="bi bi-eye"></i></a>
                                        <a href="<?php echo e(route('tasks_client.edit', $task->id)); ?>" class="badge bg-primary p-2"><i class="bi bi-pencil"></i></a>
                                        <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete<?php echo e($task->id); ?>"><i class="bi bi-trash"></i></a>
                                    </td>
                            </tr>

                            <div class="modal" tabindex="-1" id="delete<?php echo e($task->id); ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><?php echo e($task->name); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Вы действительно хотите удалить задачу?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                            <a href="<?php echo e(route('tasks_client.delete', $task->id)); ?>" class="btn btn-danger" >Удалить</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal" tabindex="-1" id="send<?php echo e($task->id); ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Вы действительно хотите изменить задачу?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                            <a href="<?php echo e(route('tasks_client.edit', $task->id)); ?>" class="btn btn-success">Изменить</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal" tabindex="-1" id="sendBack<?php echo e($task->id); ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Задача отклонена</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Причина: <?php echo e($task->cancel); ?></p>
                                            <p>Вы  хотите отправить задачу на перепроверку или удалить? <span style="font-size: 20px" class="text-success"><?php echo e($task->user?->name); ?></span></p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?php echo e(route('tasks_client.delete', $task->id)); ?>" class="btn btn-danger">Удалить</a>
                                            <form action="tasks_client/<?php echo e($task->id); ?>/sendBack" method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <input type="submit" class="btn btn-success" value="Отправить">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <td  colspan="6"><h1 class="text-center">Пока нет задач</h1></td>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/c/cx34222/task_manager/public_html/tasks/resources/views/admin/tasks_client/index.blade.php ENDPATH**/ ?>