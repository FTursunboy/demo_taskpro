<?php $__env->startSection('title'); ?>
    Проекты
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Проекты</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Проекты</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <?php echo $__env->make('.inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="<?php echo e(route('project.create')); ?>" class="btn btn-outline-primary">
                        Добавить проект
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Время</th>
                            <th>Тип</th>
                            <th>От</th>
                            <th>До</th>
                            <th>Тип проекта</th>
                            <th>Статус</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($project->name); ?></td>
                                <td><?php echo e($project->time); ?></td>
                                <td><?php echo e($project->type->name); ?></td>
                                <td><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d', $project->start)->format('d-m-Y')); ?></td>
                                <td><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d', $project->finish)->format('d-m-Y')); ?></td>
                                <td><?php echo e($project->types?->name); ?></td>
                                <td><?php echo e($project->status->name); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('project.show', $project->id)); ?>" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                    <a href="<?php echo e(route('project.edit', $project->id)); ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                       data-bs-target="#delete<?php echo e($project->id); ?>"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade text-left" id="delete<?php echo e($project->id); ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="delete<?php echo e($project->id); ?>" data-bs-backdrop="false" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <form action="<?php echo e(route('project.destroy', $project->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="delete<?php echo e($project->id); ?>">Предупреждение</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    Точно хотите удалить проект?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Отмена</span>
                                                </button>
                                                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Да, точно</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/c/cx34222/taskosonmarket/resources/views/admin/project/index.blade.php ENDPATH**/ ?>