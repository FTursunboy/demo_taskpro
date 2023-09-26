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
                            <li class="breadcrumb-item"><a href="<?php echo e(route('user.index')); ?>">Панель</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('my-command.index')); ?>">Моя команда</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Просмотр задачи</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
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

                <?php if($is_teamlead): ?>
                <div class="col-md-2 ">
                    <a href="<?php echo e(route('my-command.accept', $task->slug)); ?>" class="btn btn-outline-success w-100 text-left">Проверить задачу</a>
                </div>
                <?php endif; ?>

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
                                                            <td><?php echo e($report->user->name); ?></td>
                                                            <td>
                                                                <?php echo e($report->status?->name); ?>

                                                                <?php if($report->user->hasRole('admin')): ?>
                                                                    (Админ)
                                                                <?php elseif($report->user->hasRole('user')): ?>
                                                                    (Сотрудник)
                                                                <?php elseif($report->user->hasRole('client') || $report->user->hasRole('client-worker')): ?>
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


                <div class="modal fade" id="resend<?php echo e($task->id); ?>" data-bs-backdrop="static"
                     data-bs-keyboard="false" tabindex="-1"
                     aria-labelledby="staticBackdropLabel<?php echo e($task->id); ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="<?php echo e(route('all-tasks.resend', $task->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5"
                                        id="staticBackdropLabel<?php echo e($task->id); ?>"><?php echo e($task->name); ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <textarea class="form-control" name="success_desc" placeholder="Отчёт проделанной работы" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Отмена
                                    </button>
                                    <button type="submit" class="btn btn-primary">Отправить!
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="staticBackdrop<?php echo e($task->id); ?>" data-bs-backdrop="static"
                     data-bs-keyboard="false" tabindex="-1"
                     aria-labelledby="staticBackdropLabel<?php echo e($task->id); ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="<?php echo e(route('task-list.ready', $task->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5"
                                        id="staticBackdropLabel<?php echo e($task->id); ?>"><?php echo e($task->name); ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <textarea class="form-control" name="success_desc" placeholder="Отчёт проделанной работы" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Отмена
                                    </button>
                                    <button type="submit" class="btn btn-primary">Отправить!
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="declineTask<?php echo e($task->id); ?>" data-bs-backdrop="static"
                     data-bs-keyboard="false" tabindex="-1"
                     aria-labelledby="declineTask<?php echo e($task->id); ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="<?php echo e(route('task-list.decline', $task->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="cancel">Предупреждение</h1>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="cancel">Причина</label>
                                        <textarea name="cancel" id="cancel" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
                                       value="<?php echo e($task->user->name); ?> <?php echo e($task->user->surname); ?>"
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
                                    <a href="<?php echo e(route('user.download', $task->id)); ?>" download class="form-control text-bold">Просмотреть
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
                                       value="<?php echo e($task->project?->name); ?>" disabled>
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
                                <?php switch($task->status->id):
                                    case ($task->status->id === 1): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-warning text-black"
                                                   id="sts" value="<?php echo e($task->status->name); ?>"
                                                   disabled>
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 2): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-success text-white"
                                                   id="sts" value="<?php echo e($task->status->name); ?>"
                                                   disabled>
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 3): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-success text-white"
                                                   id="sts" value="<?php echo e($task->status->name); ?>"
                                                   disabled>
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 4): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-primary text-white"
                                                   id="sts" value="<?php echo e($task->status->name); ?>"
                                                   disabled>
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 5): ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control text-white" id="sts"
                                                   value="<?php echo e($task->status->name); ?>" disabled
                                                   style="background-color: #fc0404">
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 6): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-secondary text-white"
                                                   id="sts" value="<?php echo e($task->status->name); ?>"
                                                   disabled>
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 7): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-info text-black" id="sts"
                                                   value="<?php echo e($task->status->name); ?>" disabled>
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 8): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-info text-black" id="sts"
                                                   value="<?php echo e($task->status->name); ?>" disabled>
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 9): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-warning text-black" id="sts"
                                                   value="<?php echo e($task->status->name); ?>" disabled>
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 10): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-info text-black" id="sts"
                                                   value="<?php echo e($task->status->name); ?>" disabled>
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 11): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-info text-black" id="sts"
                                                   value="<?php echo e($task->status->name); ?>" disabled>
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 12): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-info text-black" id="sts"
                                                   value="<?php echo e($task->status->name); ?>" disabled>
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 13): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-info text-black" id="sts"
                                                   value="<?php echo e($task->status->name); ?>" disabled>
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 14): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-info text-black" id="sts"
                                                   value="<?php echo e($task->status->name); ?>" disabled>
                                        </div>
                                        <?php break; ?>
                                    <?php case ($task->status->id === 16): ?>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-info text-black" id="sts"
                                                   value="<?php echo e($task->status->name); ?>" disabled>
                                        </div>
                                        <?php break; ?>
                                <?php endswitch; ?>

                                <div class="form-group">
                                    <label for="type">Тип</label>
                                    <input type="text" id="type" class="form-control"
                                           value="<?php echo e($task->type?->name); ?> <?php echo e((isset($task->typeType?->name)) ? '- '.$task->typeType?->name : ''); ?> <?php echo e((isset($task?->percent)) ? '- '.$task?->percent : ''); ?>"
                                           disabled>
                                </div>
                                <div class="form-group">
                                    <label for="author">Автор</label>
                                    <input type="text" id="author" class="form-control"
                                           value="<?php echo e($task->author?->name .' '. $task->author->surname); ?>"
                                           disabled>
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
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist" style="border-radius: 20px">
                                <li class="nav-item">
                                    <a style="border-radius: 5px; margin-top: -4px" class="nav-link active"
                                       id="custom-tabs-one-home-tab" data-bs-toggle="pill" href="#custom-tabs-one-home"
                                       role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">История задачи</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" style="margin-top: -4px" id="custom-tabs-one-profile-tab"
                                       data-bs-toggle="pill" href="#custom-tabs-one-profile" role="tab"
                                       aria-controls="custom-tabs-one-profile" aria-selected="false">Время задачи</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                     aria-labelledby="custom-tabs-one-home-tab">
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
                                        <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e(date('d.m.Y H:i:s', strtotime($history->created_at))); ?></td>
                                                <td><?php echo e($history->sender?->name); ?>

                                                    <?php if($history->sender->hasRole('admin')): ?>
                                                        (Админ)
                                                    <?php elseif($history->sender->hasRole('user')): ?>
                                                        (Сотрудник)
                                                    <?php elseif($history->sender->hasRole('client') || $history->sender->hasRole('client-worker')): ?>
                                                        (Клиент)
                                                    <?php else: ?>
                                                        Роль не определена
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($history->status?->name); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                     aria-labelledby="custom-tabs-one-profile-tab">
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



<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
    <script>
        $(document).ready(function () {
            $('#file').change(function () {
                const selectedFile = $(this).prop('files')[0];
                if (selectedFile) {
                    $('#message').val('Файл');
                } else {
                    $('#message').val('');
                }
            });
        });

        $(document).ready(function () {
            $('#formMessage').submit(function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let fileInput = $('#file')[0];
                let selectedFile = fileInput.files[0];
                formData.append('file', selectedFile);

                $.ajax({
                    url: "<?php echo e(route('messages.messages', $task->id)); ?>",
                    method: "POST",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response)
                        $('#message').val('');
                        $('#file').val('');

                        let fileUrl = "<?php echo e(route('all-tasks.download', 'mess')); ?>/" + response.messages.id;
                        let del = route('messages.delete', { mess: response.messages.id });
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
                        alert('Ошибка при отправке сообщения');
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tasks\resources\views/user/my-command/show.blade.php ENDPATH**/ ?>