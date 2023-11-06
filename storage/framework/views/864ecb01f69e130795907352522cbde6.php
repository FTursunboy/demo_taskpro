 

<?php $__env->startSection('title'); ?>
    <?php echo e($task->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

        <div id="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3><?php echo e($task->name); ?></h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.index')); ?>">Панель</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo e(route('mon.index')); ?>">Мониторинг</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Просмотр задачи</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <?php if(session('mess')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('mess')); ?>

                </div>
            <?php endif; ?>
            <div class="page-content">
                <div class="row my-4">
                    <div class="col-1">
                        <a href="#" onclick="history.back()" class="btn btn-outline-danger">Назад</a>
                    </div>
                    <div class="col-md-2">
                        <button data-bs-target="#history" data-bs-toggle="modal" class="btn btn-outline-success w-100 text-left">История задачи</button>
                    </div>
                    <div class="col-md-2">
                        <button data-bs-target="#reports" data-bs-toggle="modal" class="btn btn-outline-success w-100 text-left">Отчеты</button>
                    </div>
                    <?php if($task->user_id == \Illuminate\Support\Facades\Auth::id()): ?>
                        <div class="col-md-2">
                            <button data-bs-target="#admin<?php echo e($task->id); ?>" data-bs-toggle="modal" class="btn btn-success w-100 text-left">Завершить задачу</button>
                        </div>
                    <?php endif; ?>
                    <?php if($task?->status?->id == 6 || $task?->status?->id == 16): ?>
                        <div class="col-md-2">
                            <button data-bs-target="#check<?php echo e($task->id); ?>" data-bs-toggle="modal" class="btn btn-success w-100 text-left">Проверить задачу</button>
                        </div>
                    <?php endif; ?>
                    <?php if($task?->status?->id == 5): ?>
                        <div class="col-md-2">
                            <button data-bs-target="#sendBack<?php echo e($task->id); ?>" data-bs-toggle="modal" class="btn btn-danger w-100 text-left">Отклонено (Сотрудник)</button>
                        </div>
                    <?php endif; ?>
                    <?php if($task?->status?->id == 3): ?>
                        <div class="col-md-2">
                            <button data-bs-target="#otkat<?php echo e($task->id); ?>" data-bs-toggle="modal" class="btn btn-danger w-100 text-left">Откатить</button>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-4 ms-auto d-flex justify-content-end">
                        <button data-bs-target="#delete<?php echo e($task->id); ?>" data-bs-toggle="modal" class="btn btn-outline-danger me-2">Удалить</button>
                        <a href="<?php echo e(route('mon.edit', $task->slug)); ?>" class="btn btn-outline-primary">Изменить</a>
                    </div>

                </div>

                <div class="row">
                    <p>
                        <button
                            class="btn btn-primary w-100 collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseExample<?php echo e($task->id); ?>" aria-expanded="false"
                            aria-controls="collapseExample"><span
                                class="d-flex justify-content-start"><i
                                    class="bi bi-info-circle mx-2"></i> <span><?php echo e($task->name); ?></span> </span>
                        </button>
                    </p>
                    <div class="collapse my-3 show" id="collapseExample<?php echo e($task->id); ?>">
                        <div class="row p-3">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" id="name" class="form-control"
                                           value="<?php echo e($task->name); ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="user">Сотрудник</label>
                                    <input type="text" id="user" class="form-control"
                                           value="<?php echo e($task?->user?->name); ?> <?php echo e($task?->user?->surname); ?>"
                                           disabled>
                                </div>

                                <div class="form-group">
                                    <label for="from">От</label>
                                    <input type="text" id="from" class="form-control"
                                           value="<?php echo e(date('d-m-Y', strtotime($task->from))); ?>" disabled>
                                </div>


                                <?php if($task->file !== null): ?>
                                    <div class="form-group">
                                        <label for="file">Файл</label>
                                        <a href="<?php echo e(route('tasks.download', $task->id)); ?>" download class="form-control text-bold">Просмотреть
                                            файл</a>
                                    </div>
                                <?php else: ?>
                                    <div class="form-group">
                                        <label for="to">Файл</label>
                                        <input type="text" class="form-control" id="to"
                                               value="Нет файл" disabled>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="time">Время</label>
                                    <input type="text" id="time" class="form-control"
                                           value="<?php echo e($task->time); ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="project">Проект</label>
                                    <input type="text" id="project" class="form-control"
                                           value="<?php echo e($task?->project?->name); ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="to">До</label>
                                    <input type="text" id="to" class="form-control"
                                           value="<?php echo e(date('d-m-Y', strtotime($task->to))); ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Коментария</label>
                                    <textarea type="text" id="comment" class="form-control" disabled
                                              rows="1"><?php echo e($task->comment); ?></textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="sts">Статус</label>
                                    <?php switch($task?->status?->id):
                                        case ($task?->status?->id === 1): ?>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-warning text-black"
                                                       id="sts" value="<?php echo e($task?->status?->name); ?>"
                                                       disabled>
                                            </div>
                                            <?php break; ?>
                                        <?php case ($task?->status?->id === 2): ?>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-success text-white"
                                                       id="sts" value="<?php echo e($task?->status?->name); ?>"
                                                       disabled>
                                            </div>
                                            <?php break; ?>
                                        <?php case ($task->status->id === 3): ?>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-success text-white"
                                                       id="sts" value="<?php echo e($task?->status?->name); ?>"
                                                       disabled>
                                            </div>
                                            <?php break; ?>
                                        <?php case ($task->status->id === 4): ?>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-primary text-white"
                                                       id="sts" value="<?php echo e($task?->status?->name); ?>"
                                                       disabled>
                                            </div>
                                            <?php break; ?>
                                        <?php case ($task?->status?->id === 5): ?>
                                            <div class="form-group">
                                                <input type="text" class="form-control text-white" id="sts"
                                                       value="<?php echo e($task?->status?->name); ?>" disabled
                                                       style="background-color: #fc0404">
                                            </div>
                                            <?php break; ?>
                                        <?php case ($task?->status?->id === 6): ?>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-secondary text-white"
                                                       id="sts" value="<?php echo e($task?->status?->name); ?>"
                                                       disabled>
                                            </div>
                                            <?php break; ?>
                                        <?php case ($task?->status?->id === 7): ?>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="<?php echo e($task?->status?->name); ?>" disabled>
                                            </div>
                                            <?php break; ?>
                                        <?php case ($task->status->id === 8): ?>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="<?php echo e($task?->status?->name); ?>" disabled>
                                            </div>
                                            <?php break; ?>
                                        <?php case ($task?->status?->id === 9): ?>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-warning text-black" id="sts"
                                                       value="<?php echo e($task?->status?->name); ?>" disabled>
                                            </div>
                                            <?php break; ?>
                                        <?php case ($task?->status?->id === 10): ?>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="<?php echo e($task?->status?->name); ?>" disabled>
                                            </div>
                                            <?php break; ?>
                                        <?php case ($task?->status?->id === 11): ?>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="<?php echo e($task?->status?->name); ?>" disabled>
                                            </div>
                                            <?php break; ?>
                                        <?php case ($task?->status?->id === 12): ?>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="<?php echo e($task?->status?->name); ?>" disabled>
                                            </div>
                                            <?php break; ?>
                                        <?php case ($task?->status?->id === 13): ?>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="<?php echo e($task?->status?->name); ?>" disabled>
                                            </div>
                                            <?php break; ?>
                                        <?php case ($task?->status?->id === 14): ?>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="<?php echo e($task?->status?->name); ?>" disabled>
                                            </div>
                                            <?php break; ?>
                                    <?php endswitch; ?>

                                    <div class="form-group">
                                        <label for="type">Тип</label>
                                        <input type="text" id="type" class="form-control"
                                               value="<?php echo e($task?->type?->name); ?> <?php echo e((isset($task?->typeType?->name)) ? '- '.$task?->typeType?->name . ' - ' . $task->percent . ' %' : ''); ?>"
                                               disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Автор</label>
                                        <input type="text" id="author" class="form-control"
                                               value="<?php echo e($task?->author?->name .' '. $task?->author?->surname); ?>"
                                               disabled>
                                    </div>
                                    <?php if($task->status_id === 5 || $task->status_id === 12): ?>
                                        <div class="form-group">
                                            <label for="reason">Причина</label>
                                            <textarea
                                                id="reason"
                                                class="form-control"
                                                style="color: white;
                                                background: red;"
                                                disabled
                                            ><?php echo e($task->cancel); ?></textarea>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                    <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="media d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <?php if($task?->user?->avatar): ?>
                                            <img
                                                src="<?php echo e(asset('storage/'. $task?->user?->avatar)); ?>">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/images/avatar-2.png')); ?>">
                                        <?php endif; ?>
                                        <span class="avatar-status <?php echo e(Cache::has('user-is-online-' . $task?->user?->id) ? 'bg-success' : 'bg-danger'); ?>"></span>
                                    </div>
                                    <div class="name me-3">
                                        <h6 class="mb-0"><?php echo e($task?->user?->name); ?> <?php echo e($task?->user?->surname); ?></h6>
                                        <span class="text-xs">
                                             <?php if(Cache::has('user-is-online-' . $task?->user?->id)): ?>
                                                <span class="text-center text-success mx-2"><b>Online</b></span>
                                            <?php else: ?>
                                                <span class="text-center text-danger  mx-2"><b>Offline</b>
                                                    <?php if($task?->user?->last_seen !== null): ?>
                                                        <span class="text-gray-600"> - <?php echo e(\Carbon\Carbon::parse($task?->user?->last_seen)->diffForHumans()); ?></span>
                                                    <?php endif; ?>
                                                </span>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                    <?php if($task?->author?->id !== \Illuminate\Support\Facades\Auth::id() ): ?>
                                        <div class="avatar me-3">
                                            <?php if($task?->author?->avatar): ?>
                                                <img
                                                    src="<?php echo e(asset('storage/'. $task?->author?->avatar)); ?>">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('assets/images/avatar-2.png')); ?>">
                                            <?php endif; ?>
                                            <span class="avatar-status <?php echo e(Cache::has('user-is-online-' . $task?->author?->id) ? 'bg-success' : 'bg-danger'); ?>"></span>
                                        </div>
                                        <div class="name me-3">
                                            <h6 class="mb-0"><?php echo e($task?->author?->name); ?> <?php echo e($task?->author?->surname); ?></h6>
                                            <span class="text-xs">
                                             <?php if(Cache::has('user-is-online-' . $task?->author?->id)): ?>
                                                    <span class="text-center text-success mx-2"><b>Online</b></span>
                                                <?php else: ?>
                                                    <span class="text-center text-danger  mx-2"><b>Offline</b>
                                                         <?php if($task?->author?->last_seen !== null): ?>
                                                            <span class="text-gray-600"> - <?php echo e(\Carbon\Carbon::parse($task?->author?->last_seen)->diffForHumans()); ?></span>
                                                        <?php endif; ?>
                                                </span>
                                                <?php endif; ?>
                                        </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-body pt-4 bg-grey">
                                <div class="chat-content" style="overflow-y: scroll; height: 320px;" id="block">
                                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mess): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php if($mess->sender_id === \Illuminate\Support\Facades\Auth::id()): ?>
                                            <div class="chat">
                                                <div class="chat-body" style="margin-right: 10px">
                                                    <div class="chat-message">
                                                        <p>
                                                        <span style="display: flex; justify-content: space-between;">
                                                            <b><?php echo e($mess?->sender?->name); ?></b>
                                                            <a style="color: red" href="<?php echo e(route('tasks.messages.delete', $mess->id)); ?>"><i class="bi bi-trash"></i></a>
                                                        </span>
                                                            <span style="margin-top: 10px"><?php echo e($mess->message); ?></span>
                                                        <?php if($mess->file !== null): ?>
                                                            <div class="form-group">
                                                                <a href="<?php echo e(route('tasks.messages.download', $mess)); ?>" download class="form-control text-bold">Просмотреть файл</a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <span class="d-flex justify-content-end" style="font-size: 10px; margin-left: 100px; margin-top: 15px; margin-bottom: -25px">
                                                            <?php echo e(date('d.m.Y H:i:s', strtotime($mess->created_at))); ?>

                                                        </span>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="chat chat-left">
                                                <div class="chat-body">
                                                    <div class="chat-message">
                                                        <p>
                                                            <span><b><?php echo e($mess?->sender?->name); ?></b><br></span>
                                                            <span style="margin-top: 10px"><?php echo e($mess->message); ?></span>
                                                        <?php if($mess->file !== null): ?>
                                                            <div class="form-group">
                                                                <a href="<?php echo e(route('tasks.messages.download', $mess)); ?>" download class="form-control text-bold">Просмотреть
                                                                    файл</a>
                                                            </div>
                                                        <?php endif; ?>
                                                            <span class="d-flex justify-content-end" style="font-size: 10px; margin-left: 100px; margin-top: 15px;margin-bottom: -25px">
                                                                <?php echo e(date('d.m.Y H:i:s', strtotime($mess->created_at))); ?>

                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                        <script>
                                            let block = document.getElementById("block");
                                            block.scrollTop = block.scrollHeight;
                                        </script>
                            </div>
                            <div class="card-footer">
                                <div class="message-form d-flex flex-direction-column align-items-center">
                                    <form id="formMessage" class="w-100" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="d-flex flex-grow-1 ml-4">
                                            <div class="input-group mb-3">
                                                <input type="text" id="message" name="message" class="form-control" placeholder="Сообщение..." required>
                                                <div class="col-3">
                                                    <input type="file" name="file" class="form-control" id="file">
                                                </div>
                                                <button type="submit" class="btn btn-primary" id="messageBTN">
                                                    Отправить
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal" tabindex="-1" id="reports">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Отчеты всех статусов</h5>

                    </div>
                    <div class="modal-body">
                        <div class="row p-3">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <table class="table mb-0 table-hover">
                                            <thead>
                                            <tr>
                                                <th class="">#</th>
                                                <th class="">Дата</th>
                                                <th class="">Совершил действия</th>
                                                <th class="">Статус</th>
                                                <th class="">Отчет</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td><?php echo e(date('d.m.Y H:i:s', strtotime($report->created_at))); ?></td>
                                                        <td><?php echo e($report?->user?->name); ?></td>
                                                        <td>
                                                            <?php echo e($report?->status?->name); ?>

                                                            <?php if($report?->user?->hasRole('admin')): ?>
                                                                (Админ)
                                                            <?php elseif($report?->user?->hasRole('user')): ?>
                                                                (Сотрудник)
                                                            <?php elseif($report?->user?->hasRole('client') || $report?->user?->hasRole('client-worker')): ?>
                                                                (Клиент)
                                                            <?php else: ?>
                                                                (Система)
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e($report->text); ?></td>
                                                    </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

        <div class="modal" tabindex="-1" id="history">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Вся история задачи</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row p-3">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="home" data-bs-toggle="tab" data-bs-target="#home-tab" role="tab"
                                           aria-controls="home-tab" aria-selected="true">История</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab"
                                           aria-controls="profile-tab" aria-selected="false">Потраченное время</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home-tab" role="tabpanel" aria-labelledby="home-tab">
                                        <table class="table mb-0 table-hover">
                                            <thead>
                                            <tr>
                                                <th class="">#</th>
                                                <th class="">Дата</th>
                                                <th class="">Совершил действия</th>
                                                <th class="">Статус</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(isset($histories)): ?>
                                                <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td><?php echo e(date('d.m.Y H:i:s', strtotime($history?->created_at))); ?></td>
                                                        <td><?php echo e($history?->user?->name); ?></td>
                                                        <td>
                                                            <?php echo e($history?->status?->name); ?>











                                                        </td>

                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php elseif(isset($histories_task)): ?>
                                                <?php $__currentLoopData = $histories_task; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <tr>
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td><?php echo e(date('d.m.Y H:i:s', strtotime($history?->created_at))); ?></td>
                                                        <td><?php echo e($history?->sender?->name); ?></td>
                                                        <td>
                                                            <?php echo e($history?->status?->name); ?>











                                                        </td>

                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <table class="table mb-0 table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Дата начала задачи</th>
                                                <th class="text-center">Дата окончание задачи</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="text-center"><?php echo e($task->created_at); ?></td>
                                                <td class="text-center"><?php echo e($task->finish); ?></td>
                                            </tr>
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
        <div class="modal" tabindex="-1" id="otkat<?php echo e($task->id); ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo e(route('mon.otkat', $task->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="modal-header">
                            <h5 class="modal-title">Откат</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="">Вы действительно хотите откатить задачу?</label>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-success">Подтвердить!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="admin<?php echo e($task->id); ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo e(route('mytasks.done', $task->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="modal-header">
                            <h5 class="modal-title">Подтверждение</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="">Отчет проделанной работы</label>
                            <textarea name="report" id="" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-success">Подтвердить!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="check<?php echo e($task->id); ?>" data-bs-backdrop="static"
             data-bs-keyboard="false" tabindex="-1" style="z-index: 9994"
             aria-labelledby="check<?php echo e($task->id); ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="<?php echo e(route('tasks.sendBack1', $task->id,)); ?>"
                          method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <div class="modal-header">
                            <h1>Проверка</h1>
                            <button type="button" class="btn-close"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="employee">Отчёт о проделанной работе</label>
                                <textarea class="form-control"
                                          disabled><?php echo e($task->success_desc); ?> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="employee">Исполнителя</label>
                                <select name="employee" id="employee"
                                        class="form-control">
                                    <option disabled value="0" selected>Выберите
                                        исполнителя
                                    </option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($user?->id); ?>"><?php echo e($user?->surname .' ' . $user?->name .' '.$user?->lastname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group" id="reasonId" style="display: none">
                                <label>Причина отклонения</label>
                                <textarea name="reason" cols="30" rows="5" class="form-control" ></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" id="redirectButton" class="btn btn-warning">Перенаправить</button>
                            <button type="submit" id="redirect" onclick="redirectFn()" class="btn btn-warning" style="display: none">Перенаправить</button>
                            <button type="submit" class="btn btn-success" id="end" onclick="endFn()">Готово
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal" id="reason<?php echo e($task->id); ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Отклонения задачи</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <a href="<?php echo e(route('mon.delete', $task->id)); ?>" class="btn btn-danger" >Удалить задачу</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="delete<?php echo e($task->id); ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Удаление задачи</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Действительно хотите удалить задачу</p>
                    </div>
                    <div class="modal-footer">
                        <a href="<?php echo e(route('mon.delete', $task->id)); ?>" class="btn btn-danger" >Удалить задачу</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="sendBack<?php echo e($task->id); ?>" data-bs-backdrop="static"
             data-bs-keyboard="false" tabindex="-1" style="z-index: 9992"
             aria-labelledby="editRight<?php echo e($task->id); ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="<?php echo e(route('tasks.sendBack', $task->id,)); ?>"
                          method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editRight<?php echo e($task->id); ?>">
                                Предупреждение</h1>
                            <button type="button" class="btn-close"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="form-group">
                                    <label for="user">Сотрудник</label>
                                    <select name="user_id" id="user_id"
                                            class="form-select">
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value="<?php echo e($user?->id); ?>" <?php echo e(($user?->id === old('user_id') or $user?->id === $task?->user?->id ) ? 'selected' : ''); ?>><?php echo e($user?->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">
                                Перенаправить
                            </button>
                            <a href="<?php echo e(route('mon.archive', $task->slug)); ?>"
                               class="btn btn-warning">
                                Архивировать
                            </a>
                            <a href="<?php echo e(route('mon.edit', $task->slug)); ?>"
                               class="btn btn-primary">
                                Изменить
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ready<?php echo e($task->id); ?>" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ready<?php echo e($task->id); ?>" aria-hidden="true">
            <div class="modal-dialog" style=" box-shadow: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ready<?php echo e($task->id); ?>">Поставте оценку исполнителю</h1>
                    </div>
                    <div class="modal-body">
                        <h6 class="text-center">Поставьте оценку, за выполнение задачи!</h6>
                        <div class="gezdvu">
                            <div class="ponavues">
                                <label class="eysan">

                                    <form id="scoreForm" action="<?php echo e(route('tasks.score')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" value="<?php echo e(session('task1')); ?>" name="session">
                                        <input type="submit" name="rating" class="star" value="1">
                                        <input type="submit" name="rating" class="star2" value="2">
                                        <input type="submit" name="rating" class="star3" value="3">
                                        <input type="submit" name="rating" class="star4" value="4">
                                        <input type="submit" name="rating" class="star5" value="5">
                                    </form>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php if(session('mess') == 'Успешно завершено'): ?>

            <script>
                window.addEventListener('DOMContentLoaded', function() {
                    var modal = new bootstrap.Modal(document.getElementById('ready<?php echo e($task->id); ?>'));
                    modal.show();
                });
            </script>
        <?php endif; ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
    <script>
        const redirect = document.getElementById('redirect');
        const redirectButton = document.getElementById('redirectButton');
        const reasonField = document.getElementById('reasonId');
        const end = document.getElementById('end');
        let isReasonFieldVisible = false;

        redirectButton.addEventListener('click', function(event) {
            reasonField.style.display = 'block';
            redirect.style.display = 'block';
            redirectButton.style.display = 'none';
            end.style.display = 'none';
            isReasonFieldVisible = true;
        });
    </script>



    <script>
        $(document).ready(function() {
            $('#file').change(function() {
                const selectedFile = $(this).prop('files')[0];
                if (selectedFile) {
                    $('#message').val('Файл');
                } else {
                    $('#message').val('');
                }
            });
        });

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#formMessage').submit(function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let fileInput = $('#file')[0];
                let selectedFile = fileInput.files[0];
                formData.append('file', selectedFile);

                $.ajax({
                    url: "<?php echo e(route('tasks.message', $task->id)); ?>",
                    method: "POST",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response)
                        $('#message').val('');
                        $('#file').val('');

                        let fileUrl = route('tasks.messages.download', { mess: response.messages.id });
                        let del = route('tasks.messages.delete', { mess: response.messages.id });
                        let newMessage = `
                                <div class="chat">
                                    <div class="chat-body" style="margin-right: 10px">
                                        <div class="chat-message">
                                            <p>
                                                <span style="display: flex; justify-content: space-between;">
                                                            <b>${response.name}</b>
                                                            <a style="color: red" href="${del}"><i class="bi bi-trash"></i></a>
                                                        </span>
                                                <span style="margin-top: 10px">${response.messages.message}</span>
                                                ${response.messages.file !== null ? `
                                                        <div class="form-group">
                                                            <a href="${fileUrl}" download class="form-control text-bold">Просмотреть файл</a>
                                                        </div>
                                                    ` : ''}
                                                <span class="d-flex justify-content-end" style="font-size: 10px; margin-left: 100px; margin-top: 15px;margin-bottom: -25px">
                                                    ${response.created_at}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        `;

                        $('#block').append(newMessage);



                        let block = document.getElementById("block");
                        block.scrollTop = block.scrollHeight;

                    },
                    error: function (xhr, status, error) {
                        console.log(xhr, status)
                        alert('Ошибка при отправке сообщения' + status + xhr);
                    }
                });
            });
        });
    </script>
    <script>
        var counter = 0;

        function redirectFn()
        {
            counter++

            if (counter === 2){
                var button = document.getElementById('redirect')
                button.type = "button"
            }
        }

        function endFn()
        {
            counter++

            if (counter === 2){
                var button = document.getElementById('end')
                button.type = "button"
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Khusrav\tasks\resources\views/admin/monitoring/show.blade.php ENDPATH**/ ?>