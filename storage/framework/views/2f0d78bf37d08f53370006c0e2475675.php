<style>
    .highlight-icon {
        color: red; /* Цвет иконки */

        padding: 5px; /* Отступы вокруг иконки */
        border-radius: 50%; /* Задание круглой формы */
    }
</style>

<header>
    <nav style="margin-bottom: -20px" class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mr-2" id="navbarSupportedContent">



                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

                <ul class="navbar-nav ms-auto mb-lg-0">
                    <li class="nav-item" style="margin-top: -10px;" title="Создать задачу">
                        <a data-bs-toggle="offcanvas" data-bs-target="#TaskStore"
                           aria-controls="TaskStore" style="margin-left: 20px;"
                           role="button">
                            <i style="font-size: 31px;" class="bi bi-plus-circle"></i>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-top: -10px;" title="Планы сотрудников">
                        <a  data-bs-toggle="offcanvas" data-bs-target="#employeePlan" aria-controls="employeePlan" style="margin-left: 20px;"
                           role="button">
                            <i class="bi bi-card-list" style="font-size: 31px"></i>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-top: -10px;" title="Проекты">
                        <a data-bs-toggle="offcanvas" data-bs-target="#ProjectOfCanvas"
                           aria-controls="ProjectOfCanvas" style="margin-left: 20px;"
                           role="button"><i style="font-size: 31px;" class="bi bi-clipboard2-data"></i>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-top: -10px;" title="Статистика">
                        <a data-bs-toggle="offcanvas" data-bs-target="#Statistic"
                           aria-controls="Statistic" style="margin-left: 20px;"
                           role="button">
                            <i style="font-size: 29px"  class="bi bi-calendar-check"></i>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-top: -10px;" title="Статистика лидов">
                        <a data-bs-toggle="offcanvas" data-bs-target="#LeadStatistic"
                           aria-controls="LeadStatistic" style="margin-left: 20px;"
                           role="button">
                            <i style="font-size: 33px"  class="bi bi-card-checklist"></i>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-top: -10px;">
                        <?php if($command_task > 0): ?>
                            <a data-bs-toggle="offcanvas" data-bs-target="#TeamLeadOfCanvas"
                               aria-controls="TeamLeadOfCanvas" style="margin-left: 20px;"
                               role="button"><i id="commandCount" style="font-size: 33px;" class="bi bi-people"></i></a>
                        <?php else: ?>
                            <a data-bs-toggle="offcanvas" data-bs-target="#TeamLeadOfCanvas"
                               aria-controls="TeamLeadOfCanvas" style="margin-left: 20px;" role="button"><i
                                    style="font-size: 32px" class="bi bi-people"></i></a>
                        <?php endif; ?>
                        <style>
                            #commandCount {
                                animation: command 2s infinite;
                            }

                            @keyframes command {
                                0% {
                                    color: red;
                                }
                                50% {
                                    color: rgba(220, 12, 10, 0.2);
                                }
                                100% {
                                    color: red;
                                }
                            }
                        </style>
                    </li>

                    <li class="nav-item" style="margin-top: -10px; margin-right: 20px" title="Список идей">
                        <?php if($ideas_count > 0 || $system_idea_count > 0): ?>
                            <a  data-bs-toggle="offcanvas" data-bs-target="#ideasOfCanvas" aria-controls="ideasOfCanvas" style="margin-left: 20px;">

                                <i id="ideasCount" style="font-size: 30px;"  class="bi bi-lightbulb"></i>
                            </a>
                        <?php else: ?>
                            <a  data-bs-toggle="offcanvas" data-bs-target="#ideasOfCanvas" aria-controls="ideasOfCanvas" style="margin-left: 20px">
                                <i  style="font-size: 28px;"  class="bi bi-lightbulb"></i>
                            </a>
                        <?php endif; ?>
                        <style>
                            #ideasCount {
                                animation: ideasCount 2s infinite;
                            }

                            @keyframes ideasCount {
                                0% {
                                    color: red;
                                }
                                50% {
                                    color: rgba(220, 12, 10, 0.2);
                                }
                                100% {
                                    color: red;
                                }
                            }
                        </style>
                    </li>

                    <li class="nav-item" style="margin-top: -10px; margin-right: 30px">
                        <a data-bs-toggle="offcanvas" data-bs-target="#TelegramOfCanvas"
                           aria-controls="TelegramOfCanvas" style="color: #6C757D; font-size: 18px" role="button"><i
                                style="color: #269EDA; font-size: 30px" class="bi bi-telegram"></i></a>
                    </li>

                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600"><?php echo e(Auth::user()->surname.' '. Auth::user()->name); ?></h6>
                                <p class="mb-0 text-sm text-gray-600"><?php echo e(Auth::user()->getRoleNames()[0]); ?></p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <?php if(Auth::user()->avatar): ?>
                                        <img
                                            src="<?php echo e(asset('storage/'. Illuminate\Support\Facades\Auth::user()->avatar)); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('assets/images/avatar-2.png')); ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem;">
                        <li><a class="dropdown-item" href="<?php echo e(route('profile.index')); ?>"><i
                                    class="icon-mid bi bi-person me-2"></i>Мой профиль</a></li>
                        <?php if($settings?->invited_friends < 5): ?>
                            <li>
                                <a href="#" class="dropdown-item" data-bs-toggle="offcanvas"
                                   data-bs-target="#addFriend" aria-controls="addFriend">
                                    <i class="bi bi-person-plus me-2"></i>Добавить друзей</a>
                            </li>
                        <?php endif; ?>
                        <hr class="dropdown-divider">
                        <li><a role="button" class='dropdown-item' data-bs-toggle="modal"
                               data-bs-target="#staticBackdrop"><i
                                    class="icon-mid bi bi-box-arrow-left me-2"></i> Выход</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="offcanvas offcanvas-end" tabindex="-1" id="addFriend" aria-labelledby="addFriend">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="addFriend">Добавить друзей</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
    </div>
    <div class="offcanvas-body">
        <form action="<?php echo e(route('addFriendController')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <p>Количество добавленных друзей: <?php echo e($settings?->invited_friends); ?></p>
                <label for="name">Наименование клиента <span class="text-danger">*</span></label>
                <input type="text" id="client_name" name="client_name" tabindex="1" class="form-control mt-3"
                       value="<?php echo e(old('client_name')); ?>" required>
                <?php if($errors->has('client_name')): ?> <p
                    style="color: red;"><?php echo e($errors->first('client_name')); ?></p> <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="name">Телефон <span class="text-danger">*</span></label>
                <input type="text" id="phone" name="phone" tabindex="4" class="form-control mt-3"
                       value="<?php echo e(old('phone')); ?>" required>
                <?php if($errors->has('phone')): ?> <p
                    style="color: red;"><?php echo e($errors->first('phone')); ?></p> <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-success" style="width: 100%" tabindex="5">Добавить</button>
        </form>
    </div>
</div>


<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="TelegramOfCanvas"
     aria-labelledby="TelegramOfCanvas" style="width: 1000px">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="TelegramOfCanvas">Телеграм</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php if($settings?->has_access == false): ?>
            <h4 style="margin-left: 30px; color: red" class="offcanvas-title" id="ProjectOfCanvas">Вы не можете отправить сообщение. Пополните баланс!</h4>
        <?php endif; ?>
        <a role="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#telegramAll">
            Написать всем сразу
        </a>
        <div class="modal fade" id="telegramAll" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="telegramAll" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="<?php echo e(route('telegram.sendAll')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="telegramAll">Написать всем</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="CMC">СМС</label><textarea name="message" id="CMC" class="form-control"
                                                                      rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                            <button <?php echo e($settings?->has_access ? '' : 'disabled'); ?> type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>ФИО</th>
                <th width="150">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $usersTelegram; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($user->surname .' '.$user->name.' '. $user->lastname); ?></td>
                    <td>
                        <button <?php echo e($settings?->has_access ? '' : 'disabled'); ?> type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#onePerson<?php echo e($user->id); ?>">Написать
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="onePerson<?php echo e($user->id); ?>" data-bs-backdrop="static"
                     data-bs-keyboard="false" tabindex="-1"
                     aria-labelledby="onePerson<?php echo e($user->id); ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="<?php echo e(route('telegram.sendOne', $user->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="onePerson<?php echo e($user->id); ?>">Написать
                                        на <?php echo e($user->surname .' '.$user->name); ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="CMC">СМС</label><textarea name="message" id="CMC"
                                                                              class="form-control"
                                                                              rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Отменить
                                    </button>
                                    <button type="submit" class="btn btn-primary">Отправить</button>
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






<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="TeamLeadOfCanvas"
     aria-labelledby="TeamLeadOfCanvas" style="width: 100%; height: 80%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="TelegramOfCanvas">Список задач</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Задача</th>
                        <th>Проект</th>
                        <th>Исполнитель</th>
                        <th>Тимлид</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($tasksTeamLeads)>0): ?>
                        <?php $__currentLoopData = $tasksTeamLeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="text-center">
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(\Str::limit($task->task_name, 20)); ?></td>
                                <td><?php echo e($task->project); ?></td>
                                <td><?php echo e($task->author_task_surname . ' ' . $task->author_task_name); ?></td>
                                <td><?php echo e($task->author_surname . ' ' . $task->author_name); ?></td>
                                <td>
                                    <a role="button" class="btn btn-success" data-bs-toggle="modal"
                                       data-bs-target="#taskTeamLead<?php echo e($task->task_id); ?>"><i
                                            class="bi bi-eye"></i></a>
                                    
                                    <a href="<?php echo e(route('tasks-team-leads.acceptTaskCommand', $task->task_slug)); ?>"
                                       class="btn btn-primary"><i class="bi bi-check"></i></a>
                                    <a href="<?php echo e(route('tasks-team-leads.declineTaskCommand', $task->task_slug)); ?>" class="btn btn-danger"><i class="bi bi-x"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="taskTeamLead<?php echo e($task->task_id); ?>"
                                 data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                 aria-labelledby="taskTeamLead<?php echo e($task->task_id); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="taskTeamLead<?php echo e($task->task_id); ?>">
                                                Информация
                                                <a href="<?php echo e(route('tasks-team-leads.acceptTaskCommand', $task->task_slug)); ?>" class="btn btn-primary">Принять</a>
                                                <a href="<?php echo e(route('tasks-team-leads.declineTaskCommand', $task->task_slug)); ?>" class="btn btn-danger">Отклонить</a>
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="name">Имя</label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="<?php echo e($task->task_name); ?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="user_id">Кому это задача</label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="<?php echo e($task->author_surname . " " . $task->author_name); ?>"
                                                               disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="from">Дата начала задачи</label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="<?php echo e($task->from); ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="time">Время</label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="<?php echo e($task->time); ?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="project_id">Проект</label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="<?php echo e($task->project); ?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="to">Дата окончания задачи <span
                                                                id="project_finish"
                                                                style="color: red"></span> </label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="<?php echo e($task->to); ?>" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="type_id">Тип</label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="<?php echo e($task->type); ?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="comment">Комментария</label>
                                                        <textarea tabindex="10" name="comment" id="comment"
                                                                  rows="4"
                                                                  class="form-control mt-3"
                                                                  disabled><?php echo e($task->comment); ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Отмена
                                            </button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <td colspan="7" class="bg-secondary"><h3 class="text-center text-white">Пока нет задач</h3></td>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>






<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="ideasOfCanvas"
     aria-labelledby="TeamLeadOfCanvas" style="width: 100%; height: 80%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="TelegramOfCanvas">Список идей</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <div class="card-body">
                <div class="row p-3">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist" style="border-radius: 20px">
                            <li class="nav-item">
                                <a style="border-radius: 5px; margin-top: -4px" class="nav-link active"
                                   id="custom-tabs-one-home-tab" data-bs-toggle="pill" href="#custom-tabs-one-home"
                                   role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Идея <span style="color:#ff0000;"><?php echo e(($ideas_count > 0) ? '- ('.$ideas_count.')' : ''); ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="margin-top: -4px" id="custom-tabs-one-profile-tab"
                                   data-bs-toggle="pill" href="#custom-tabs-one-profile" role="tab"
                                   aria-controls="custom-tabs-one-profile" aria-selected="false">Системная идея <span style="color:#ff0000;"><?php echo e(($system_idea_count > 0) ? '- ('.$system_idea_count.')' : ''); ?></span></a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-home-tab">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Название</th>
                                        <th>От</th>
                                        <th>До</th>
                                        <th>Описание</th>
                                        <th>Статус</th>
                                        <th>Автор</th>
                                        <th>Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $ideasOfDashboard; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e(\Str::limit($idea->title, 20)); ?></td>
                                            <td><?php echo e($idea->from); ?></td>
                                            <td><?php echo e($idea->to); ?></td>
                                            <td><?php echo e(\Illuminate\Support\Str::limit($idea->description, 20)); ?></td>
                                            <td>
                                                <?php switch($idea->status->id):
                                                    case ($idea->status->id === 1): ?>
                                                    <?php echo e($idea->status->name); ?>

                                                    <?php break; ?>

                                                    <?php case ($idea->status->id === 2): ?>
                                                    <?php echo e($idea->status->name); ?>

                                                    <?php break; ?>

                                                    <?php case ($idea->status->id === 3): ?>
                                                    <?php echo e($idea->status->name); ?>

                                                    <?php break; ?>

                                                    <?php case ($idea->status->id === 4): ?>
                                                    <?php echo e($idea->status->name); ?>

                                                    <?php break; ?>

                                                    <?php case ($idea->status->id === 5): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 6): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 7): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 8): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 9): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 10): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 11): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 12): ?>
                                                    <?php echo e($idea->status->name); ?> <?php break; ?>

                                                    <?php case ($idea->status->id === 13): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 14): ?>
                                                    <?php echo e($idea->status->name); ?> <?php break; ?>
                                                    <?php case ($idea->status->id === 15): ?>
                                                    <?php echo e($idea->status->name); ?> <?php break; ?>
                                                <?php endswitch; ?>
                                            </td>
                                            <td><?php echo e($idea->user?->surname . ' '.$idea->user?->name); ?></td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#ideasShowDashboard<?php echo e($idea->id); ?>" class="badge bg-primary" role="button"><i class="bi bi-eye"></i></a>
                                                <a data-bs-toggle="modal" data-bs-target="#ideasShowDashboardUserDelete<?php echo e($idea->id); ?>"
                                                   class="badge bg-danger" role="button"><i class="bi bi-trash"></i></a>
                                            </td>

                                        </tr>

                                        <div class="modal fade" id="ideasShowDashboardUserDelete<?php echo e($idea->id); ?>"
                                             data-bs-backdrop="static"
                                             data-bs-keyboard="false" tabindex="-1"
                                             aria-labelledby="ideasShowDashboardUserDelete<?php echo e($idea->id); ?>"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="ideasShowDashboardUserDelete<?php echo e($idea->id); ?>">
                                                            Названия: <?php echo e(\Str::limit($idea->title, 60)); ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" action="<?php echo e(route('admin.idea.delete', $idea->id)); ?>"
                                                          enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <div class="modal-body">
                                                            <p class="text-center">Точно хотите удалить идею?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                Назад
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">
                                                                Удалить идею
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="ideasShowDashboard<?php echo e($idea->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ideasShowDashboard<?php echo e($idea->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="ideasShowDashboard<?php echo e($idea->id); ?>">Названия: <?php echo e(\Str::limit($idea->title, 60)); ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="<?php echo e(route('admin.ideas.update', $idea->id)); ?>"
                                                              enctype="multipart/form-data" autocomplete="off">
                                                            <?php echo csrf_field(); ?>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <!-- textarea -->
                                                                    <div class="form-group">
                                                                        <label>Идея</label>
                                                                        <textarea disabled name="title" class="form-control" rows="3"
                                                                                  placeholder="Введите имя идеи ..."><?php echo e($idea->title); ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <!-- textarea -->
                                                                    <div class="form-group">
                                                                        <label>Бюджет</label>
                                                                        <textarea disabled name="budget" class="form-control" rows="3"
                                                                                  placeholder="Введите бюджет ..."><?php echo e($idea->budget); ?></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Плюсы</label>
                                                                        <textarea disabled name="pluses" class="form-control" rows="3"
                                                                                  placeholder="Введите плюсы идеи ..."><?php echo e($idea->pluses); ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Минусы</label>
                                                                        <textarea disabled name="minuses" class="form-control" rows="3"
                                                                                  placeholder="Введите минусы идеи ..."><?php echo e($idea->minuses); ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Описание</label>
                                                                        <textarea disabled name="description" class="form-control" rows="5"
                                                                                  placeholder="Введите описание идеи ..."><?php echo e($idea->description); ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Срок от:</label>
                                                                    <div class="input-group date" id="reservationdate"
                                                                         data-target-input="nearest">
                                                                        <input disabled name="from" value="<?php echo e($idea->from); ?>" type="text" class="form-control"/>

                                                                    </div>
                                                                    <?php if($idea->file !== null): ?>
                                                                        <div style="margin-top: 30px" class="col md-3">
                                                                            <i class="bi bi-paperclip">
                                                                                <a style="margin-left: 0px" href="<?php echo e(route('admin.ideas.downloadFile', $idea->id)); ?>" download>Просмотреть файл</a>
                                                                            </i>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-md-3">

                                                                    <label>До:</label>
                                                                    <div class="input-group date" id="reservationdated"
                                                                         data-target-input="nearest">
                                                                        <input type="text" disabled name="to" value="<?php echo e($idea->to); ?>" class="form-control"/>


                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Комментарий</label>
                                                                        <textarea name="comment" class="form-control" rows="5"
                                                                                  placeholder="Напишите комментарий ..."><?php echo e($idea->comments); ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php if($idea->status->id ==1): ?>
                                                                <div class="float-right">
                                                                    <button typeof="button" class="btn btn-success" name="action" value="accept" type="submit"
                                                                            id="accept">Принять
                                                                    </button>
                                                                    <button typeof="button" class="btn btn-danger" name="action" value="decline" type="submit"
                                                                            id="decline">Отклонить
                                                                    </button>
                                                                    <button typeof="button" class="btn btn-warning" name="action" value="update" type="submit"
                                                                            id="inWork">На доработку
                                                                    </button>
                                                                </div>
                                                            <?php endif; ?>
                                                            <script>
                                                                const btn = document.getElementById('accept')
                                                                btn.addEventListener('click', function () {
                                                                    btn.type = 'submit';
                                                                    btn.click();
                                                                    btn.classList.add('disabled')
                                                                })
                                                                const decline = document.getElementById('decline')
                                                                decline.addEventListener('click', function () {
                                                                    decline.type = 'submit';
                                                                    decline.click();
                                                                    decline.classList.add('disabled')

                                                                })
                                                                const inWork = document.getElementById('inWork')
                                                                inWork.addEventListener('click', function () {
                                                                    inWork.type = 'submit';
                                                                    inWork.click();
                                                                    inWork.classList.add('disabled')
                                                                })
                                                            </script>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Назад</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <td colspan="8" class="text-center ">Пока нет идей</td>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-profile-tab">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Название</th>
                                        <th>Описание</th>
                                        <th>Статус</th>
                                        <th>Автор</th>
                                        <th>Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $systemIdeasOfDashboard; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e(\Str::limit($idea->name, 20)); ?></td>
                                            <td><?php echo e(\Illuminate\Support\Str::limit($idea->description, 20)); ?></td>
                                            <td>
                                                <?php switch($idea->status->id):
                                                    case ($idea->status->id === 1): ?>
                                                    <?php echo e($idea->status->name); ?>

                                                    <?php break; ?>

                                                    <?php case ($idea->status->id === 2): ?>
                                                    <?php echo e($idea->status->name); ?>

                                                    <?php break; ?>

                                                    <?php case ($idea->status->id === 3): ?>
                                                    <?php echo e($idea->status->name); ?>

                                                    <?php break; ?>

                                                    <?php case ($idea->status->id === 4): ?>
                                                    <?php echo e($idea->status->name); ?>

                                                    <?php break; ?>

                                                    <?php case ($idea->status->id === 5): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 6): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 7): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 8): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 9): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 10): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 11): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 12): ?>
                                                    <?php echo e($idea->status->name); ?> <?php break; ?>

                                                    <?php case ($idea->status->id === 13): ?>
                                                    <?php echo e($idea->status->name); ?><?php break; ?>

                                                    <?php case ($idea->status->id === 14): ?>
                                                    <?php echo e($idea->status->name); ?> <?php break; ?>
                                                    <?php case ($idea->status->id === 15): ?>
                                                    <?php echo e($idea->status->name); ?> <?php break; ?>
                                                <?php endswitch; ?>
                                            </td>
                                            <td><?php echo e($idea->user?->surname . ' '.$idea->user->name); ?></td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#SystemIdeasShowDashboard<?php echo e($idea->id); ?>" class="badge bg-primary" role="button"><i class="bi bi-eye"></i></a>
                                                <a data-bs-toggle="modal" data-bs-target="#SystemIdeasDelete<?php echo e($idea->id); ?>" class="badge bg-danger" role="button"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="SystemIdeasDelete<?php echo e($idea->id); ?>"
                                             data-bs-backdrop="static"
                                             data-bs-keyboard="false" tabindex="-1"
                                             aria-labelledby="ideasShowDashboardUserDelete<?php echo e($idea->id); ?>"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="ideasShowDashboardUserDelete<?php echo e($idea->id); ?>">
                                                            Названия: <?php echo e(\Str::limit($idea->name, 60)); ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" action="<?php echo e(route('admin.system-ideas.delete', $idea->id)); ?>"
                                                          enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <div class="modal-body">
                                                            <p class="text-center">Точно хотите удалить идею?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                Назад
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">
                                                                Удалить идею
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="SystemIdeasShowDashboard<?php echo e($idea->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="SystemIdeasShowDashboard<?php echo e($idea->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="SystemIdeasShowDashboard<?php echo e($idea->id); ?>">Названия: <?php echo e(\Str::limit($idea->title, 60)); ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="<?php echo e(route('admin.system-ideas.update', $idea->id)); ?>"
                                                              enctype="multipart/form-data" autocomplete="off">
                                                            <?php echo csrf_field(); ?>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <!-- textarea -->
                                                                    <div class="form-group">
                                                                        <label>Название</label>
                                                                        <input disabled name="name" class="form-control"
                                                                               placeholder="Введите имя идеи ..." value="<?php echo e($idea->name); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Комментарий</label>
                                                                        <textarea name="comment"  class="form-control" rows="5"
                                                                        ><?php echo e($idea->comment); ?></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Описание</label>
                                                                        <textarea disabled name="description" class="form-control"
                                                                                  rows="5"
                                                                                  placeholder="Введите описание идеи ..." ><?php echo e($idea->description); ?></textarea>
                                                                    </div>
                                                                    <div style="margin-top: 30px" class="col md-3">
                                                                        <i class="bi bi-paperclip">
                                                                            <a style="margin-left: 0px" href="<?php echo e(route('admin.system-ideas.downloadFile', $idea->id)); ?>" download>Просмотреть файл</a>
                                                                        </i>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <?php if($idea->status->id == 1): ?>
                                                                <div class="float-right">

                                                                    <button typeof="button" class="btn btn-success" name="action" value="accept" type="submit"
                                                                            id="accept">Принять
                                                                    </button>
                                                                    <button typeof="button" class="btn btn-danger" name="action" value="decline" type="submit"
                                                                            id="decline">Отклонить
                                                                    </button>
                                                                    <button typeof="button" class="btn btn-warning" name="action" value="update" type="submit"
                                                                            id="inWork">На доработку
                                                                    </button>
                                                                </div>
                                                            <?php endif; ?>
                                                            <script>
                                                                const btn = document.getElementById('accept')
                                                                btn.addEventListener('click', function () {
                                                                    btn.type = 'submit';
                                                                    btn.click();
                                                                    btn.classList.add('disabled')
                                                                })
                                                                const decline = document.getElementById('decline')
                                                                decline.addEventListener('click', function () {
                                                                    decline.type = 'submit';
                                                                    decline.click();
                                                                    decline.classList.add('disabled')

                                                                })
                                                                const inWork = document.getElementById('inWork')
                                                                inWork.addEventListener('click', function () {
                                                                    inWork.type = 'submit';
                                                                    inWork.click();
                                                                    inWork.classList.add('disabled')
                                                                })
                                                            </script>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Назад</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <td colspan="6" class="text-center ">Пока нет идей</td>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="ProjectOfCanvas"
     aria-labelledby="ProjectOfCanvas" style="width: 100%; height: 80%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="ProjectOfCanvas">Проекты</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <div class="card-body overflow-hidden">
                <div>
                    <table class="table table-hover mt-3 " cellpadding="5">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Название</th>
                            <th class="text-center">Количество задач</th>
                            <th class="text-center">Готовые</th>
                            <th class="text-center">В процессе</th>
                            <th class="text-center" style="width: 130px;">На проверке (У клиента)</th>
                            <th class="text-center" style="width: 130px;">На проверке (У админа)</th>
                            <th class="text-center" style="width: 130px;">Просроченное</th>
                            <th class="text-center" style="width: 130px;">Прочее</th>
                            <th class="text-center" style="width: 130px;">Подробнее</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $projectTasksOfDashboardAdmin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="">
                                <td><?php echo e($loop->index+1); ?></td>
                                <td><?php echo e($task->name); ?></td>
                                <td class="text-center"><?php echo e($task->count_task()); ?></td>
                                <td class="text-center"><?php echo e($task->count_ready()); ?></td>
                                <td class="text-center"><?php echo e($task->count_process()); ?></td>
                                <td class="text-center"><?php echo e($task->count_verificateClient()); ?></td>
                                <td class="text-center"><?php echo e($task->count_verificateAdmin()); ?></td>
                                <td class="text-center"><?php echo e($task->count_outOfDate()); ?></td>
                                <td class="text-center"><?php echo e($task->count_other()); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('admin.statisticProject', $task->id)); ?>" class="btn btn-success">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="Statistic" aria-labelledby="Statistic" style="width: 100%; height: 100%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="Statistic">Статистика</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body overflow-auto">
                    <div class="row">
                        <div class="col-9"></div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-select" name="month" id="month">
                                    <option value="0">фильтр по месяцу</option>
                                    <option value="1">Январь</option>
                                    <option value="2">Февраль</option>
                                    <option value="3">Март</option>
                                    <option value="4">Апрель</option>
                                    <option value="5">Май</option>
                                    <option value="6">Июнь</option>
                                    <option value="7">Июль</option>
                                    <option value="8">Август</option>
                                    <option value="9">Сентябрь</option>
                                    <option value="10">Октябрь</option>
                                    <option value="11">Ноябрь</option>
                                    <option value="12">Декабрь</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" style="height: 900px; overflow-y: scroll;">
                        <table id="example1" class="table table-border table-hover">
                            <thead style="position: sticky; top: 0; z-index: 1; background-color: #fff;">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">ФИО</th>
                                <th class="text-center">Все задачи</th>
                                <th class="text-center">Задача прошлых месяцов</th>
                                <th class="text-center">В процессе</th>
                                <th class="text-center">Готово</th>
                                <th class="text-center">Просроченное</th>
                                <th class="text-center">Ожидается (Сотрудник)</th>
                                <th class="text-center">На проверке (У админа)</th>
                                <th class="text-center">На проверке (У клиента)</th>
                                <th class="text-center">Отклонено (Администратором)</th>
                                <th class="text-center">Отклонено (Клиентом)</th>
                            </tr>
                            </thead>
                            <tbody id="tableBodyMonitoring">
                            <?php $__currentLoopData = $statistics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e(\Illuminate\Support\Str::limit($user->name . " " . $user->surname, 50)); ?></td>
                                    <td class="text-center"><?php echo e($user->usersCountTasks($user->id)['total']); ?></td>
                                    <td class="text-center"><?php echo e($user->debt_tasks($user->id)); ?></td>
                                    <td class="text-center"><?php echo e($user->usersCountTasks($user->id)['process']); ?></td>
                                    <td class="text-center"><?php echo e($user->usersCountTasks($user->id)['ready']); ?></td>
                                    <td class="text-center"><?php echo e($user->usersCountTasks($user->id)['speed']); ?></td>
                                    <td class="text-center"><?php echo e($user->usersCountTasks($user->id)['expectedUser']); ?></td>
                                    <td class="text-center"><?php echo e($user->usersCountTasks($user->id)['forVerificationAdmin']); ?></td>
                                    <td class="text-center"><?php echo e($user->usersCountTasks($user->id)['forVerificationClient']); ?></td>
                                    <td class="text-center"><?php echo e($user->usersCountTasks($user->id)['rejectedAdmin']); ?></td>
                                    <td class="text-center"><?php echo e($user->usersCountTasks($user->id)['rejectedClient']); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
        <script>
            $(document).ready(function () {
                var table = $('#example1').DataTable({
                    initComplete: function () {
                    },
                });

                $('#month').on('change', function () {
                    filterStatistic()
                });

                function filterStatistic() {
                    let month = $('#month').val();

                    $.get(`/tasks/public/monitoring-statistics-filter/${month}`, function (response) {
                        let tableBody = $('#tableBodyMonitoring');
                        table.clear().draw();
                        tableBody.empty()

                        if (response.statistics.length > 0) {
                            buildTable(response.statistics, tableBody);
                        }

                    });
                }

                function buildTable(data, tableBody) {
                    $.each(data, function (i, item) {
                        let row = `
                <tr>
                    <td class="text-center">${i + 1}</td>
                    <td>${item.user}</td>
                    <td class="text-center">${item.total !== null ? item.total : 0}</td>
                    <td class="text-center">${item.debt !== null ? item.debt : 0}</td>
                    <td class="text-center">${item.process !== null ? item.process : 0}</td>
                    <td class="text-center">${item.ready !== null ? item.ready : 0}</td>
                    <td class="text-center">${item.speed !== null ? item.speed : 0}</td>
                    <td class="text-center">${item.expectedUser !== null ? item.expectedUser : 0}</td>
                    <td class="text-center">${item.forVerificationAdmin !== null ? item.forVerificationAdmin : 0}</td>
                    <td class="text-center">${item.forVerificationClient !== null ? item.forVerificationClient : 0}</td>
                    <td class="text-center">${item.rejectedAdmin !== null ? item.rejectedAdmin : 0}</td>
                    <td class="text-center">${item.rejectedClient !== null ? item.rejectedClient : 0}</td>
                </tr>`;

                        tableBody.append(row);
                    });
                }


            });
        </script>
    </div>
</div>


<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="LeadStatistic"
     aria-labelledby="leadStatisticTitle" style="width: 100%; height: 90%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="leadStatisticTitle">Статистика лидов</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body overflow-auto">
                    <table id="leadStatistic" class="table table-border table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Месяц</th>
                            <th class="text-center">Лиды</th>
                            <?php $__currentLoopData = $leadStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th class="text-center"><?php echo e($lead->name); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        </thead>
                        <tbody id="tableBodyMonitoring">
                        <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($key); ?></td>
                                <td class="text-center"><?php echo e($dataByMonth[$month]['count']); ?></td>
                                <td class="text-center"><?php echo e($dataByMonth[$month]['first_meet']); ?></td>
                                <td class="text-center"><?php echo e($dataByMonth[$month]['potential_client']); ?></td>
                                <td class="text-center"><?php echo e($dataByMonth[$month]['treaty']); ?></td>
                                <td class="text-center"><?php echo e($dataByMonth[$month]['payment']); ?></td>
                                <td class="text-center"><?php echo e($dataByMonth[$month]['unquality_lead']); ?></td>
                                <td class="text-center"><?php echo e($dataByMonth[$month]['test_stage']); ?></td>
                                <td class="text-center"><?php echo e($dataByMonth[$month]['kp']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="TaskStore"
     aria-labelledby="TaskStore" style="width: 100%; height: 80%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="ProjectOfCanvas">Создать</h5>
        <?php if($settings?->has_access == false): ?>
        <h4 style="margin-left: 30px; color: red" class="offcanvas-title" id="ProjectOfCanvas">Вы не можете создать задачу. Пополните баланс!</h4>
        <?php endif; ?>
        <span class="centered-span" id="info_danger" style="color: red"></span>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('tasks.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input <?php echo e($settings?->has_access ? '' : 'disabled'); ?> tabindex="1" type="text" id="name" name="name" class="form-control mt-3"
                                       placeholder="Имя" value="<?php echo e(old('name')); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="user_id">Кому это задача</label>

                                <select tabindex="4" id="user_id" name="user_id" class="form-select mt-3" required <?php echo e($settings?->has_access ? '' : 'disabled'); ?>>

                                    <option value="" selected>Выберите сотрудник</option>
                                    <?php $__currentLoopData = $users1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->surname .' ' . $user->name .' '.$user->lastname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="from">Дата начала задачи</label>
                                <input disabled tabindex="7" type="date" id="from" name="from" class="form-control mt-3"
                                       value="<?php echo e(old('from')); ?>" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="time">Время</label>
                                <input <?php echo e($settings?->has_access ? '' : 'disabled'); ?> tabindex="2" type="number" id="time" name="time" class="form-control mt-3"
                                       value="<?php echo e(old('time')); ?>" placeholder="Время"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="project_id">Проект</label>
                                <select  tabindex="5" id="project_id" name="project_id" <?php echo e($settings?->has_access ? '' : 'disabled'); ?> class="form-select mt-3">
                                    <option value="" selected disabled>Выберите проект</option>
                                    <?php $__currentLoopData = $projects1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($project->id); ?>" class="<?php echo e(date('Y-m-d', strtotime($project->finish))); ?>" <?php echo e(($project->id === old('project_id')) ? 'selected' : ''); ?>><?php echo e($project->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="to">Дата окончания задачи  <span  id="project_finish" style="color: red"></span> </label>
                                <input disabled tabindex="8" type="date" id="to" name="to" class="form-control mt-3" value="<?php echo e(old('to')); ?>"
                                       required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="type_id">Тип</label>
                                <select tabindex="3" id="type_id" name="type_id" class="form-select mt-3" required <?php echo e($settings?->has_access ? '' : 'disabled'); ?>>
                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group" id="type_id_group">
                                <label id="label" class="d-none" for="kpi_id">Вид KPI</label>
                            </div>
                            <div class="form-group"  id="percent">
                                <label id="label1" class="d-none" for="percent">Введите процент</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Комментария</label>
                            <textarea tabindex="10" name="comment" <?php echo e($settings?->has_access ? '' : 'disabled'); ?> id="comment"
                                      class="form-control mt-3"><?php echo e(old('comment')); ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="file">Файл</label>
                                <input tabindex="11" type="file"  name="file" class="form-control mt-3" id="file" <?php echo e($settings?->has_access ? '' : 'disabled'); ?>>
                            </div>
                        </div>
                        <div class="col-6"></div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button tabindex="12" type="button" id="button" class="btn btn-outline-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="<?php echo e(asset('assets/js/control.js')); ?>" ></script>


        <script>
            const fromInput = document.getElementById('from');
            let prevValue = fromInput.value;

            fromInput.addEventListener('input', function() {
                const dateValue = new Date(this.value);
                const year = dateValue.getFullYear();
                const maxLength = 4;

                if (year.toString().length > maxLength) {
                    this.value = prevValue; // Восстанавливаем предыдущее значение
                } else {
                    prevValue = this.value; // Сохраняем текущее значение
                }
            });
        </script>
        <script>
            const toInput = document.getElementById('to');
            let prevValue1 = toInput.value;

            toInput.addEventListener('input', function() {
                const dateValue = new Date(this.value);
                const year = dateValue.getFullYear();
                const maxLength = 4;

                if (year.toString().length > maxLength) {
                    this.value = prevValue1; // Восстанавливаем предыдущее значение
                } else {
                    prevValue1 = this.value; // Сохраняем текущее значение
                }
            });
        </script>



        <script>
            $('#from').change(function () {
                const to = $('#to')
                if ($(this).val() > to.val()) {

                    let selectedOption = $('#project_id option:selected');
                    let selectedClass = selectedOption.attr('class');

                    let selectedDate = new Date(selectedClass);
                    let toDate = new Date($(this).val());

                    if (toDate > selectedDate) {
                        $('#error-message').show();
                        $(this).addClass('border-danger')

                        let formattedDate = selectedDate.toISOString().split('T')[0];

                        $(this).val(formattedDate)
                    }

                    to.addClass('border-danger')
                    $('#button').attr('type', 'button');




                } else {
                    $(this).removeClass('border-danger')
                    to.removeClass('border-danger')
                    $('#button').attr('type', 'submit');
                }
            })


            $('#to').change(function () {
                const from = $('#from')
                if ($(this).val() < from.val()) {
                    $(this).addClass('border-danger')
                    from.addClass('border-danger')
                    $('#button').attr('type', 'button');

                } else {
                    $(this).removeClass('border-danger')
                    from.removeClass('border-danger')
                    $('#button').attr('type', 'submit');
                }
            })

            $('#type_id').change(function () {
                let kpi = $(this).children('option:selected')
                if (kpi.text().toLowerCase() === 'kpi') {
                    let kpiType = $('#kpi_id').empty();

                    $('#label').removeClass('d-none');
                    let kpi_id = $('<select tabindex="6"  required name="kpi_id" class="form-select mt-3"><option value="">Выберите месяц</option></select>');
                    $('#type_id_group').append(kpi_id);

                    $('#label1').removeClass('d-none');
                    let percent = $('<input tabindex="9"  required type="number" oninput="checkMaxValue(this)" id="percent" step="any" name="percent" class="form-control mt-3">');
                    $('#percent').append(percent);



                    $.get(`/tasks/public/kpil/${kpi.val()}/`).then((res) => {
                        for (let i = 0; i < res.length; i++) {
                            const item = res[i];
                            console.log(item.name);
                            kpi_id.append($('<option>').val(item.id).text(item.name));
                        }
                    });




                } else {
                    $('#type_id_group').empty();

                    $('#percent').empty();

                }
            })
            function checkMaxValue(input) {
                var maxValue = 150;
                if (input.value > maxValue) {
                    input.value = maxValue;

                }
            }

            $('#project_id').change(function() {
                let selectedOption = $('#project_id option:selected');
                let selectedClass = selectedOption.attr('class');


            });
            function formatDate(date) {
                let year = date.getFullYear();
                let month = String(date.getMonth() + 1).padStart(2, '0');
                let day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }
            function formatDate1(dateStr) {
                const [day, month, year] = dateStr.split('-');
                const date = new Date(`${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`);


                return `${date.getDate()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getFullYear()}`;
            }

            $('#to').on('input', function() {
                let project_finish = formatDate1($('#project_finish').text());

                let selectedOption = $('#project_id option:selected');
                let selectedClass = selectedOption.attr('class');

                let selectedDate = new Date(selectedClass);
                let toDate = new Date($(this).val());

                if (toDate > selectedDate) {
                    $('#error-message').show();
                    $(this).addClass('border-danger')


                    let formattedDate = selectedDate.toISOString().split('T')[0];

                    $(this).val(formattedDate)


                } else {
                    $(this).removeClass('border-danger')
                    $('#error-message').hide();
                    $('#button').attr('type', 'submit');


                }
                let formattedDate = formatDate(toDate);
                console.log(formattedDate);
            });

            $('#project_id').change(function() {

                $('#from').removeAttr('disabled');
                $('#to').removeAttr('disabled');
                const today = new Date();

                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const day = String(today.getDate()).padStart(2, '0');
                const formattedDate = `${year}-${month}-${day}`;

                $('#from').val(formattedDate);


                let selectedOption = $('#project_id option:selected');
                let selectedClass = selectedOption.attr('class');
                console.log(selectedClass)
                $('#project_finish').text("Дата окончания выбранного проекта " +  selectedClass);

            });


        </script>
    </div>
</div>


<div class="offcanvas offcanvas-bottom" tabindex="-1" id="employeePlan" aria-labelledby="employeePlan" style="height: 100%">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">Планы сотрудников</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
    </div>
    <div class="offcanvas-body large">
        <form id="employeePlanForm">
            <?php echo csrf_field(); ?>

            <div class="row">
                <div class="col-3">
                    <label>Выберите сотрудника</label>
                    <select name="employee" id="employee" class="form-control mt-3">
                        <option disabled selected>Выберите сотрудника</option>
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($employee->id); ?>"><?php echo e($employee->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-3">
                    <label for="day">Выберите дату</label>
                    <input id="dayPlan" type="date" name="day" class="form-control mt-3">
                </div>

            </div>
        </form>
        <hr>
        <table class="table table-hover mt-5" id="">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Имя</th>
                <th>Описание</th>
                <th>Статус</th>
                <th>Время (в часах)</th>
            </tr>
            </thead>
            <tbody id="plan_table">

            </tbody>
        </table>
    </div>
</div>

    <script>
        $(document).ready(function() {
            $('#employee, #dayPlan').on('change', function() {
                filterLeads()
            });

            function filterLeads() {
                let employee = $('#employee').val();
                let days = $('#dayPlan').val();


                $.get(`employee/plan/${employee}/${days}`, function(responce) {
                    let table = $('#plan_table').empty();
                    console.log(responce);
                    buildTable(responce.plans, table);

                });
            }

            function formatDate(date) {
                const d = new Date(date);
                const year = d.getFullYear();
                const month = String(d.getMonth() + 1).padStart(2, '0');
                const day = String(d.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            function buildTable(data, table) {
                $.each(data, function(i, item) {
                    const formattedDate = formatDate(item.created_at);
                    const statusText = (item.status === 1) ? 'Завершен' : 'Не завершен';

                    let row = `<tr>
                  <td>${(formattedDate)}</td>
                  <td>${item.name}</td>
                  <td>${item.description}</td>
                  <td>${statusText}</td>
                  <td>${item.hour}</td>
                </tr>`;
                    table.append(row);
                });
            }
        });
</script>

<?php /**PATH /home/c/cx34222/task_manager/public_html/tasks/resources/views/admin/incs/header.blade.php ENDPATH**/ ?>