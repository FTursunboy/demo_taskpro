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
                            <li class="breadcrumb-item"><a href="<?php echo e(route('employee.index')); ?>">Сотрудники </a></li>
                            <li class="breadcrumb-item active"
                                aria-current="page"><?php echo e($user->surname . ' ' . $user->name.' '. $user->lastname); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <a href="<?php echo e(route('employee.index')); ?>" class="btn btn-outline-danger mb-2">
            Назад
        </a>

        <?php if($user->getRoleNames()->contains('team-lead')): ?>

            

            <a role="button" class="btn btn-outline-danger mb-2 mx-2" data-bs-toggle="modal"
               data-bs-target="#deleteCommand">
                Удалить всю группу
            </a>
            <div class="modal fade" id="deleteCommand" data-bs-backdrop="static"
                 data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="deleteCommand" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteCommand">Предупреждение</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center"> Точно хотите удалить группу</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Отмена
                            </button>
                            <a href="<?php echo e(route('employee.deleteCommand', $user->id)); ?>" class="btn btn-danger">Да</a>
                        </div>
                    </div>
                </div>
            </div>

            





            


            <a role="button" class="btn btn-outline-success mb-2 " data-bs-toggle="modal"
               data-bs-target="#role">
                Сделать тимлидом каманды
            </a>
            <!-- Modal -->
            <div class="modal fade" id="role" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="role" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="role">Выберите роль</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <form action="<?php echo e(route('employee.teamLead', $user->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="project">Выберите проект</label>
                                    <select name="project" id="project" required class="form-select">
                                        <option value="">Выберите проект</option>
                                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group mt-4">
                                    <label for="role">Выберите роль</label>
                                    <select name="role" id="role" required class="form-select">
                                        <option value="">Выберите роль</option>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group mt-4">
                                    <div>
                                        <label for="users">Выберите участники команда <span
                                                    class="text-danger">*</span></label>
                                    </div>
                                    <div class="mt-4 w-100">
                                        <select multiple id="users" class="" name="users[]" class="form-select">
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($u->id !== \Illuminate\Support\Facades\Auth::user()->id): ?>
                                                    <option
                                                            value="<?php echo e($u->id); ?>"><?php echo e($u->surname . ' ' . $u->name . ' ' . $u->lastname); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена
                                </button>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            


        <?php else: ?>
            

            <a role="button" class="btn btn-outline-success mb-2 mx-2" data-bs-toggle="modal"
               data-bs-target="#role">
                Сделать тимлидом каманды
            </a>
            <!-- Modal -->
            <div class="modal fade" id="role" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="role" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="role">Выберите роль</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <form action="<?php echo e(route('employee.teamLead', $user->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="project">Выберите проект</label>
                                    <select name="project" id="project" required class="form-select">
                                        <option value="">Выберите проект</option>
                                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group mt-4">
                                    <label for="role">Выберите роль</label>
                                    <select name="role" id="role" required class="form-select">
                                        <option value="">Выберите роль</option>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group mt-4">
                                    <div>
                                        <label for="users">Выберите участники команда <span
                                                    class="text-danger">*</span></label>
                                    </div>
                                    <div class="mt-4 w-100">
                                        <select multiple id="users" class="" name="users[]" class="form-select">
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($u->id !== \Illuminate\Support\Facades\Auth::user()->id): ?>
                                                    <option
                                                            value="<?php echo e($u->id); ?>"><?php echo e($u->surname . ' ' . $u->name . ' ' . $u->lastname); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена
                                </button>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
        <?php endif; ?>


        <?php if(!$user->getRoleNames()->contains('crm')): ?>
            
            <a role="button" class="btn btn-outline-primary mb-2 ml-2" data-bs-toggle="modal"
               data-bs-target="#roleToCRM">
                Включить доступ к CRM
            </a>
            <!-- Modal -->
            <div class="modal fade" id="roleToCRM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="roleToCRM" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="roleToCRM">Включить доступ к CRM</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?php echo e(route('employee.roleToCrm', $user->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                Вы точно хотите включить доступ к CRM
                                на <?php echo e($user->surname. ' ' .$user->name. ' '. $user->lastname); ?>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                <button type="submit" class="btn btn-primary">Включить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            

        <?php else: ?>
            
            <a role="button" class="btn btn-outline-danger mb-2 mx-2" data-bs-toggle="modal"
               data-bs-target="#removeRoleCRM">
                Отключить доступ к CRM
            </a>
            <!-- Modal -->
            <div class="modal fade" id="removeRoleCRM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="removeRoleCRM" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="removeRoleCRM">Отключить доступ к CRM</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?php echo e(route('employee.removeRoleToCrm', $user->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                Вы точно хотите отключить доступ к CRM
                                на <?php echo e($user->surname. ' ' .$user->name. ' '. $user->lastname); ?>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                <button type="submit" class="btn btn-danger">Отключить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
        <?php endif; ?>

        <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <section class="section">
            <div class="row pt-4">
                <div class="col-9">
                    <?php if($user->getRoleNames()->contains('team-lead')): ?>
                        <h4>Группы</h4>

                        <table class="table table-hover bg-white rounded-4 mt-3">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Проект</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $userCommand->commandProjects($user->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $use): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="text-center">
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($use->name); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('employee.command-show', [$user->id,$use->project_id])); ?>" class="badge bg-success"><i class="bi bi-eye mr-2"></i></a>
                                        <a role="button" data-bs-toggle="modal"
                                           data-bs-target="#deleteFromCommand"
                                           class="badge bg-danger"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteFromCommand" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteFromCommand"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deleteFromCommand">Предупреждение</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form
                                                    action="<?php echo e(route('employee.delete-from-command', [$use->project_id,$user->id])); ?>"
                                                    method="POST">
                                                <?php echo csrf_field(); ?>
                                                <div class="modal-body">
                                                    Точно хотите удалить группу?
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
                    <?php endif; ?>


                    <div class="card">
                        <div class="card-header">
                            <a href="<?php echo e(route('mon.index')); ?>" class="btn btn-outline-primary">
                                Задачи
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Имя</th>
                                    <th>Тип</th>
                                    <th>От</th>
                                    <th>До</th>
                                    <th>Статус</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $project_tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project_task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($project_task->name); ?></td>
                                            <td><?php echo e(($project_task->type === null) ? "От клиента" : $project_task->type->name); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d', $project_task->from)->format('d-m-Y')); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d', $project_task->to)->format('d-m-Y')); ?></td>
                                        <?php switch($project_task->status->id):
                                            case ($project_task->status->id === 1): ?>
                                            <td><span
                                                        class="badge bg-warning"><?php echo e($project_task->status->name); ?></span>
                                            </td>
                                            <?php break; ?>
                                            <?php case ($project_task->status->id === 2): ?>
                                            <td><span
                                                        class="badge bg-success"><?php echo e($project_task->status->name); ?></span>
                                            </td>
                                            <?php break; ?>
                                            <?php case ($project_task->status->id === 3): ?>
                                            <td><span
                                                        class="badge bg-success"><?php echo e($project_task->status->name); ?></span>
                                            </td>
                                            <?php break; ?>
                                            <?php case ($project_task->status->id === 4): ?>
                                            <td><span
                                                        class="badge bg-primary"><?php echo e($project_task->status->name); ?></span>
                                            </td>
                                            <?php break; ?>
                                            <?php case ($project_task->status->id === 5): ?>
                                            <td><span
                                                        class="badge bg-danger"><?php echo e($project_task->status->name); ?></span>
                                            </td>
                                            <?php break; ?>
                                            <?php case ($project_task->status->id === 6): ?>
                                            <td>
                                                    <span
                                                            class="badge bg-light-info"><?php echo e($project_task->status->name); ?></span>
                                            </td>
                                            <?php break; ?>
                                            <?php case ($project_task->status->id === 7): ?>
                                            <td>
                                                    <span
                                                            class="badge bg-secondary"><?php echo e($project_task->status->name); ?></span>
                                            </td>
                                            <?php break; ?>
                                            <?php case ($project_task->status->id === 8): ?>
                                            <td><span
                                                        class="badge bg-warning"><?php echo e($project_task->status->name); ?></span>
                                            </td>
                                            <?php break; ?>
                                            <?php case ($project_task->status->id === 9): ?>
                                            <td><span
                                                        class="badge bg-warning"><?php echo e($project_task->status->name); ?></span>
                                            </td>
                                            <?php break; ?>
                                            <?php case ($project_task->status->id === 10): ?>
                                            <td>
                                                    <span
                                                            class="badge bg-light-info"><?php echo e($project_task->status->name); ?></span>
                                            </td>
                                            <?php break; ?>
                                            <?php case ($project_task->status->id === 11): ?>
                                            <td><span
                                                        class="badge bg-danger"><?php echo e($project_task->status->name); ?></span>
                                            </td>
                                            <?php break; ?>
                                            <?php case ($project_task->status->id === 12): ?>
                                            <td><span
                                                        class="badge bg-danger"><?php echo e($project_task->status->name); ?></span>
                                            </td>
                                            <?php break; ?>
                                            <?php case ($project_task->status->id === 13): ?>
                                            <td><span
                                                        class="badge bg-danger"><?php echo e($project_task->status->name); ?></span>
                                            </td>
                                            <?php break; ?>
                                            <?php case ($project_task->status->id === 14): ?>
                                            <td>
                                                    <span
                                                        class="badge bg-light-info"><?php echo e($project_task->status->name); ?></span>
                                                </td>
                                                <?php break; ?>
                                            <?php endswitch; ?>
                                            <td class="">
                                                <a href="<?php echo e(route('mon.show', $project_task->slug)); ?>" class="btn btn-success"><i class="bi bi-eye"></i></a>
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


                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Список задач</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Имя</th>
                                    <th>Статус</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $project_tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->index+1); ?></td>
                                        <td><?php echo e(\Str::limit($task->name,10)); ?></td>
                                        <td><?php echo e($task->status->name); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">

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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tasks\resources\views/admin/employee/show.blade.php ENDPATH**/ ?>