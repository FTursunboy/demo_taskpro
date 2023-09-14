<?php $__env->startSection('title'); ?>
    <?php echo e($offer?->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style>
        .centered-span {
            display: flex;
            justify-content: center;
            font-size: 24px;
        }

    </style>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Задачи</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('client.offers.index')); ?>">Новые задачи</a></li>
                            <li class="breadcrumb-item"><a href="#"><?php echo e($offer->name); ?></a></li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <section class="section">
            <div class="card">

                <div class="card-body">
                    <div class="row ">
                        <?php if(session('mess')): ?>
                            <div class="alert alert-success">
                                Успешно отправлено!
                            </div>
                        <?php endif; ?>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="#" onclick="history.back()"
                                       class="btn btn-outline-danger">Назад</a>
                                    <a role="button" data-bs-target="#send" data-bs-toggle="modal"
                                       class="btn btn-outline-success text-left">История
                                        задачи
                                    </a>
                                    <a role="button" data-bs-target="#reports" data-bs-toggle="modal" class="btn btn-outline-success text-left">
                                        Отчеты
                                    </a>
                                    <?php if($offer->status->id == 6): ?>
                                        <a href="#" data-bs-target="#send<?php echo e($offer->id); ?>" data-bs-toggle="modal"
                                           class="btn btn-success">Принять и отправить клиенту</a>
                                    <?php endif; ?>

                                    <span class="centered-span" id="info_danger" style="color: red"></span>
                                </div>
                                <?php if(\Session::has('err')): ?>
                                    <div class="alert alert-danger mt-4">
                                        <?php echo e(\Session::get('err')); ?>

                                    </div>
                                <?php endif; ?>

                                <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="container">
                                                <div class="row">
                                                    <p>
                                                        <button
                                                            class="btn btn-primary w-100 collapsed"
                                                            type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseExample" aria-expanded="false"
                                                            aria-controls="collapseExample"><span
                                                                class="d-flex justify-content-start"><i
                                                                    class="bi bi-info-circle mx-2"></i> <span><?php echo e(\Illuminate\Support\Str::limit($offer->name, 15)); ?></span> </span>
                                                        </button>
                                                    </p>
                                                    <?php if(isset($search)): ?>

                                                        <form method="post"
                                                              action="<?php echo e(route('client.offers.send.user.search', ['offer' => $offer->id, 'search' => $search])); ?>"
                                                              enctype="multipart/form-data" autocomplete="off">
                                                            <?php else: ?>
                                                                <form method="post"
                                                                      action="<?php echo e(route('client.offers.send.user', ['offer' => $offer->id])); ?>"
                                                                      enctype="multipart/form-data" autocomplete="off">
                                                                    <?php endif; ?>


                                                                    <?php echo csrf_field(); ?>
                                                                    <div class="collapse my-3 show"
                                                                         id="collapseExample">
                                                                        <div class="row g-3">
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Название
                                                                                    задачи</label>
                                                                                <input disabled type="text"
                                                                                       class="form-control"
                                                                                       name="name" id="name"
                                                                                       value="<?php echo e($offer->name); ?>"
                                                                                       required>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Проект</label>
                                                                                <input type="text" class="form-control"
                                                                                       value="<?php echo e($project->projects?->name); ?>"
                                                                                       disabled name="project">
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <label class="form-label"> Сотрудник
                                                                                    со
                                                                                    стороны компании</label>
                                                                                <input value="<?php echo e($offer->author_name); ?>"
                                                                                       disabled
                                                                                       type="text"
                                                                                       class="form-control"
                                                                                       name="author_name" id="name"
                                                                                       required>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Телефон
                                                                                    ответственного
                                                                                    сотрудника</label>
                                                                                <input value="<?php echo e($offer->author_phone); ?>"
                                                                                       disabled
                                                                                       type="text"
                                                                                       class="form-control"
                                                                                       name="author_phone" id="name"
                                                                                       required>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">От</label>
                                                                                <input required
                                                                                       id="from_1"
                                                                                       value="<?php echo e($offer->from); ?>"
                                                                                       type="date"
                                                                                       class="form-control"
                                                                                       name="from">

                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">До</label>
                                                                                <input required
                                                                                       id="to_1"
                                                                                       value="<?php echo e($offer->to); ?>"
                                                                                       type="date"
                                                                                       class="form-control"
                                                                                       name="to">

                                                                                <span id="error-message"
                                                                                      class="d-none text-center mt-3"
                                                                                      style="color: red">Дата окончания задачи не может превышать дату начало задачи</span>

                                                                            </div>


                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Ответственный
                                                                                    исполнитель</label>
                                                                                <select required class="form-select"
                                                                                        name="user_id" id="user_id_1">
                                                                                    <option value="">Выберите
                                                                                        исполнителя
                                                                                    </option>
                                                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <?php if($user->login !== 'z1ntel2001'): ?>
                                                                                            <option
                                                                                                value="<?php echo e($user->id); ?>" <?php echo e($user->id === $offer->user_id ? 'selected' : ''); ?> ><?php echo e($user->surname .' ' . $user->name .' '.$user->lastname); ?></option>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </select>

                                                                                <label class="form-label">Тип</label>
                                                                                <select name="type_id"
                                                                                        class="form-control"
                                                                                        id="id_type">
                                                                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <option
                                                                                            value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </select>

                                                                                <div class="form-group" id="1_percent">
                                                                                    <label id="label_1"
                                                                                           class="d-none mb-2"
                                                                                           for="percent">Введите
                                                                                        процент</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Время</label>
                                                                                <input
                                                                                    value="<?php echo e($offer->time); ?>"
                                                                                    type="number"
                                                                                    class="form-control"
                                                                                    name="time"
                                                                                    id="time_1"
                                                                                    placeholder="Введите время">

                                                                                <label class="form-label">Клиент</label>
                                                                                <input
                                                                                    value="<?php echo e($offer->client->surname . " " . $offer->client->name . " " . $offer->client->lastname); ?>"
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    disabled
                                                                                >

                                                                                <div class="form-group"
                                                                                     id="2_type_group">
                                                                                    <label id="label_2"
                                                                                           class="d-none mb-2"
                                                                                           for="2_kpi_id">Вид KPI</label>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">


                                                                                <span id="error-message"
                                                                                      class="d-none text-center mt-3"
                                                                                      style="color: red">Дата окончания задачи не может превышать дату начало задачи</span>

                                                                            </div>


                                                                            <?php if($offer->file !== null): ?>
                                                                                <div class="col-md-6">
                                                                                    <a style="margin-left: 0px" download
                                                                                       href="<?php echo e(route('offer.file.download', $offer->id)); ?>">Просмотреть
                                                                                        файл</a>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <?php if($offer->status_id === 6): ?>
                                                                                <div class="col-md-6">
                                                                                    <label
                                                                                        class="form-label">Отчёт</label>
                                                                                    <textarea
                                                                                        class="form-control"
                                                                                        style="background-color: #208d20; color: white"
                                                                                    ><?php echo e($offer->tasks->success_desc); ?></textarea>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <div class="col-md-6">

                                                                            </div>

                                                                            <div class="col-12">
                                                                                <label for="your-message"
                                                                                       class="form-label">Описание
                                                                                    задачи</label>
                                                                                <textarea disabled id="description"
                                                                                          class="form-control"
                                                                                          name="description"
                                                                                          rows="5"
                                                                                          required><?php echo e($offer->description); ?> </textarea>
                                                                            </div>

                                                                            <?php if($offer->cancel): ?>
                                                                                <div class="col-md-12">
                                                                                    <label for="">Причина отклонениня
                                                                                    </label>
                                                                                    <textarea disabled id="description"
                                                                                              class="form-control"
                                                                                              name="description"
                                                                                              rows="1"
                                                                                              required><?php echo e($offer->cancel); ?> </textarea>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>

                                                </div>
                                                <div class="row   d-flex justify-content-center align-items-center">
                                                    <div class="col-lg-9">

                                                        <div class="row mt-4">
                                                            <?php if(!$offer->user_id): ?>
                                                                <div class="col-6">
                                                                    <button name="action" value="accept"
                                                                            class="btn btn-success form-control"
                                                                            type="submit" id="button" onclick="buttonFn()">

                                                                        Отправить
                                                                    </button>
                                                                </div>
                                                                <div class="col-6">
                                                                    <a data-bs-target="#decline<?php echo e($offer->id); ?>"
                                                                       data-bs-toggle="modal" value="decline"
                                                                       class="btn btn-danger form-control">
                                                                        Отклонить
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <script>
                                                                const btn = document.getElementById('btnSend')
                                                                btn.addEventListener('click', function () {
                                                                    const name = document.getElementById('name').value
                                                                    const description = document.getElementById('description').value
                                                                    if (name !== '' && description !== '') {
                                                                        btn.type = 'submit';
                                                                        btn.click();
                                                                        btn.classList.add('disabled')
                                                                    }
                                                                })
                                                            </script>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid gray">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="media d-flex align-items-center">
                                        <?php if($offer->user_id !== null && Auth::id() !== $offer->user_id): ?>
                                            <div class="avatar me-2">
                                                <?php if($offer?->user?->avatar): ?>
                                                    <img src="<?php echo e(asset('storage/'. $offer?->user?->avatar)); ?>">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('assets/images/avatar-2.png')); ?>">
                                                <?php endif; ?>
                                                    <span
                                                        class="avatar-status <?php echo e(Cache::has('user-is-online-' . $offer?->user?->id) ? 'bg-success' : 'bg-danger'); ?>"></span>
                                            </div>
                                            <div class="name me-2">
                                                <h6 class="mb-0"><?php echo e($offer?->user?->name); ?> <?php echo e($offer?->user?->surname); ?></h6>
                                                <span class="text-xs">
                                                    <?php if(Cache::has('user-is-online-' . $offer?->user?->id)): ?>
                                                        <span class="text-center text-success mx-2"><b>Online</b></span>
                                                    <?php else: ?>
                                                        <span class="text-center text-danger  mx-2"><b>Offline</b>
                                                            <?php if(isset($admin)): ?>
                                                             <?php if($admin?->last_seen !== null): ?>
                                                                <span class="text-gray-600"> - <?php echo e(\Carbon\Carbon::parse($offer?->user?->last_seen)->diffForHumans()); ?></span>
                                                            <?php endif; ?>
                                                            <?php endif; ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="avatar ms-2 me-2">
                                            <?php if($offer->client?->avatar): ?>
                                                <img src="<?php echo e(asset('storage/'. $offer?->client?->avatar)); ?>">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('assets/images/avatar-2.png')); ?>">
                                            <?php endif; ?>
                                            <span
                                                class="avatar-status <?php echo e(Cache::has('user-is-online-' . $offer->client?->id) ? 'bg-success' : 'bg-danger'); ?>"></span>
                                        </div>
                                        <div class="name me-2">
                                            <h6 class="mb-0"><?php echo e($offer->client?->name); ?> <?php echo e($offer->client?->surname); ?> </h6>
                                            <span class="text-xs">
                                                 <?php if(Cache::has('user-is-online-' . $offer->client?->id)): ?>
                                                    <span class="text-center text-success mx-2"><b>Online</b></span>
                                                <?php else: ?>
                                                    <span class="text-center text-danger  mx-2"><b>Offline</b>
                                                        <?php if(isset($admin)): ?>
                                                         <?php if($admin?->last_seen !== null): ?>
                                                            <span class="text-gray-600"> - <?php echo e(\Carbon\Carbon::parse($offer->client?->last_seen)->diffForHumans()); ?></span>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                    </span>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-4 bg-grey">
                                    <div class="chat-content" style="overflow-y: scroll; height: 320px;" id="block">
                                        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mess): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($mess->sender_id === \Illuminate\Support\Facades\Auth::id()): ?>
                                                <div class="chat id">
                                                    <div class="chat-body" style="margin-right: 10px">
                                                        <div class="chat-message">
                                                            <p>
                                                                 <span
                                                                     style="display: flex; justify-content: space-between;">
                                                            <b><?php echo e($mess->sender?->name); ?></b>
                                                            <a style="color: red"
                                                               href="<?php echo e(route('tasks.messages.delete', $mess->id)); ?>"><i
                                                                    class="bi bi-trash"></i></a>
                                                        </span>
                                                                <span
                                                                    style="margin-top: 10px"><?php echo e($mess->message); ?></span>
                                                            <?php if($mess->file !== null): ?>
                                                                <div class="form-group">
                                                                    <a href="<?php echo e(route('client.offers.messages.download', $mess)); ?>"
                                                                       download class="form-control text-bold">Просмотреть
                                                                        файл</a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <span class="d-flex justify-content-end"
                                                                  style="font-size: 10px; margin-left: 100px; margin-top: 15px;margin-bottom: -25px">
                                                                <?php echo e(date('d.m.Y H:i:s', strtotime($mess->created_at))); ?>

                                                            </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="chat chat-left id">
                                                    <div class="chat-body">
                                                        <div class="chat-message">
                                                            <p>
                                                                <span><b><?php echo e($mess->sender?->name); ?></b><br></span>
                                                                <span
                                                                    style="margin-top: 10px"><?php echo e($mess->message); ?></span>
                                                            <?php if($mess->file !== null): ?>
                                                                <div class="form-group">
                                                                    <a href="<?php echo e(route('client.offers.messages.download', $mess)); ?>"
                                                                       download class="form-control text-bold">Просмотреть
                                                                        файл</a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <span class="d-flex justify-content-end"
                                                                  style="font-size: 10px; margin-left: 100px; margin-top: 15px;margin-bottom: -25px">
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

                                <?php if($offer->status_id != 3): ?>
                                    <div class="card-footer">
                                        <div class="message-form d-flex flex-direction-column align-items-center">
                                            <form class="w-100" id="formMessage"
                                                  method="POST" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="d-flex flex-grow-1 ml-4">
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="message" class="form-control"
                                                               placeholder="Сообщение..." id="message" required>
                                                        <div class="col-3">
                                                            <input type="file" name="file" class="form-control"
                                                                   id="file">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary" id="messageBTN">
                                                            Отправить
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal" tabindex="-1" id="send">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Вся история задачи</h5>

                </div>
                <div class="modal-body">
                    <div class="row p-3">
                        <div class="card-header p-0 pt-1">
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
                        </div>

                        <div class="card-body">
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

                                            <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e(date('d.m.Y H:i:s', strtotime($history?->created_at))); ?></td>
                                                    <td><?php echo e($history?->user->name); ?></td>
                                                    <td>
                                                        <?php echo e($history?->status?->name); ?>

                                                    </td>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                            <td class="text-center"><?php echo e($offer->created_at); ?></td>
                                            <td class="text-center"><?php echo e($offer->finish); ?></td>
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
    <div class="modal" tabindex="-1" id="send<?php echo e($offer->id); ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo e(route('client.offers.send.back', $offer->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title">Отправление задачи на проверку</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="reasonSend" style="display: none">
                        <p>Вы действительно хотите отправить задачу клиенту</p>
                        <textarea required name="reason" class="form-control" id="" cols="30" rows="2"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button  id="reason" type="button" class="btn btn-danger">Отклонить, Отправить заново</button>
                        <button  id="reasonButton" type="submit" class="btn btn-danger" style="display: none">Отклонить, Отправить заново</button>
                        <a href="<?php echo e(route('client.offers.send.client', $offer->id)); ?>" class="btn btn-success" id="sendButton">Отправить</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="decline<?php echo e($offer->id); ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo e(route('client.offers.decline', $offer->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title">Вы действительно хотите отклонить задачу</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea name="reason" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="rejectBtn" onclick="rejectBtnFn()" class="btn btn-success">Отправить</button>
                    </div>
                </form>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/control_offers.js')); ?>" ></script>
    <script>

        $('#id_type').change(function () {

            let kpi = $(this).children('option:selected')
            if (kpi.text().toLowerCase() === 'kpi') {
                let kpiType = $('#2_kpi_id').empty();

                $('#label_2').removeClass('d-none');
                let kpi_id = $('<select  tabindex="6"  required name="kpi_id" class="form-select mt-3"><option value="">Выберите месяц</option></select>');
                $('#2_type_group').append(kpi_id);

                $('#label_1').removeClass('d-none');
                let percent = $('<input tabindex="9"  required type="number" oninput="checkMaxValue(this)" id="percent" step="any" name="percent" class="form-control mt-3">');
                $('#1_percent').append(percent);



                $.get(`/tasks/public/kpil/${kpi.val()}/`).then((res) => {
                    for (let i = 0; i < res.length; i++) {
                        const item = res[i];
                        console.log(item.name);
                        kpi_id.append($('<option>').val(item.id).text(item.name));
                    }
                });




            } else {
                $('#2_type_group').empty();

                $('#1_percent').empty();

            }
        })

        function checkMaxValue(input) {
            var maxValue = 150;
            if (input.value > maxValue) {
                input.value = maxValue;

            }
        }



    </script>

    <script>
            const fromInput_1 = document.getElementById('from_1');
        let prevValue_1 = fromInput_1.value;

        fromInput_1.addEventListener('input', function () {
            const dateValue_2 = new Date(this.value);
            const year_2 = dateValue_2.getFullYear();
            const maxLength_1 = 4;

            if (year_2.toString().length > maxLength_1) {
                this.value = prevValue_1;
            } else {
                prevValue_1 = this.value;
            }
        });

                const toInput_1 = document.getElementById('to_1');
                let prevValue1_1 = toInput_1.value;

                toInput_1.addEventListener('input', function () {
                const dateValue_1 = new Date(this.value);
                const year_1 = dateValue_1.getFullYear();
                const maxLength_1 = 4;

                if (year_1.toString().length > maxLength_1) {
                this.value = prevValue1_1; // Восстанавливаем предыдущее значение
            } else {
                prevValue1_1 = this.value; // Сохраняем текущее значение
            }
            });
    </script>

    <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>

    <script>
        $(document).ready(function () {
            $('#fileInput').change(function () {
                const selectedFile = $(this).prop('files')[0];
                if (selectedFile) {
                    $('#message').val('Файл');
                } else {
                    $('#message').val('');
                }
            });
        });
    </script>

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
                    url: "<?php echo e(route('offers.chat.message.store', $offer->id)); ?>",
                    method: "POST",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        $('#message').val(' ');
                        $('#file').val('');

                        let fileUrl = route('user.downloadChat', {task: response.messages.id});
                        let del = route('tasks.messages.delete', {mess: response.messages.id});
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

    <script>
        $('#from_1').change(function () {
            const to_1 = $('#to_1');
            if ($(this).val() > to_1.val()) {

                let selectedOption = $('#project_id option:selected');
                let selectedClass = selectedOption.attr('class');

                let selectedDate_1 = new Date(selectedClass);
                let toDate_1 = new Date($(this).val());

                if (toDate_1 > selectedDate_1) {
                    $('#error-message').show();
                    $(this).addClass('border-danger');

                    let formattedDate_1 = selectedDate_1.toISOString().split('T')[0];

                    $(this).val(formattedDate_1);
                }

                to_1.addClass('border-danger');
                $('#button_1').attr('type', 'button');
            } else {
                $(this).removeClass('border-danger');
                to_1.removeClass('border-danger');
                $('#button_1').attr('type', 'submit');
            }
            updateErrorMessageVisibility();
        });

        $('#to_1').change(function () {
            const from_1 = $('#from_1');
            if ($(this).val() < from_1.val()) {
                $(this).addClass('border-danger');
                from_1.addClass('border-danger');
                $('#button_1').attr('type', 'button');
            } else {
                $(this).removeClass('border-danger');
                from_1.removeClass('border-danger');
                $('#button_1').attr('type', 'submit');
            }
            updateErrorMessageVisibility();
        });

        function formatDate_1(date) {
            let year_1 = date.getFullYear();
            let month_1 = String(date.getMonth() + 1).padStart(2, '0');
            let day_1 = String(date.getDate()).padStart(2, '0');
            return `${year_1}-${month_1}-${day_1}`;
        }

        function formatDate1(dateStr_1) {
            const [day_1, month_1, year_1] = dateStr_1.split('-');
            const date_1 = new Date(`${year_1}-${month_1.toString().padStart(2, '0')}-${day_1.toString().padStart(2, '0')}`);
            return `${date_1.getDate()}-${(date_1.getMonth() + 1).toString().padStart(2, '0')}-${date_1.getFullYear()}`;
        }

        $('#to_1').on('input', function () {
            let project_finish_1 = formatDate1($('#project_finish').text());

            let selectedOption_1 = $('#project_id option:selected');
            let selectedClass_1 = selectedOption_1.attr('class');

            let selectedDate_1 = new Date(selectedClass_1);
            let toDate_1 = new Date($(this).val());

            if (toDate_1 > selectedDate_1) {
                $('#error-message').show();
                $(this).addClass('border-danger');

                let formattedDate_1 = selectedDate_1.toISOString().split('T')[0];

                $(this).val(formattedDate_1);
            } else {
                $(this).removeClass('border-danger');
                $('#error-message').hide();
                $('#button_1').attr('type', 'submit');
            }
            updateErrorMessageVisibility();
            let formattedDate_1 = formatDate_1(toDate_1);
            console.log(formattedDate_1);
        });

        function updateErrorMessageVisibility() {
            const errorMessage_1 = $('#error-message');
            const from_1 = $('#from_1');
            const to_1 = $('#to');
            if (from_1.hasClass('border-danger') || to_1.hasClass('border-danger')) {
                errorMessage_1.removeClass('d-none');
            } else {
                errorMessage_1.addClass('d-none');
            }
        }
    </script>

    <script>
        $(document).ready(function(){
            $('#reason').on('click', function() {
                $('#reason').hide();
                $('#reasonButton').show();
                $('#reasonSend').show();
                $('#sendButton').hide();
            });
        });
    </script>

    <script>
        var counter = 0;

        function buttonFn() {
            counter++;

            if (counter === 1) {
                var button = document.getElementById('button');
                button.type = "button";
            }
        }

        function rejectBtnFn()
        {
            counter++

            if (counter === 2){
                var button = document.getElementById('rejectBtn')
                button.type = "button"
            }
        }
    </script>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Faiziev Tursunboy\Documents\GitHub\tasks\resources\views/admin/offers/show.blade.php ENDPATH**/ ?>