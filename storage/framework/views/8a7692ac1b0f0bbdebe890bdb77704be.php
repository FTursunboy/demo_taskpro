<div class="card-body">

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <section class="row">
                <div class="row">
                    <div class="col-6 col-lg-4  col-md-">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <a href="<?php echo e(route('mon.all')); ?>">
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon purple mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42"
                                                     fill="currentColor" class="bi bi-card-checklist text-white"
                                                     viewBox="0 0 16 16">
                                                    <path
                                                        d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                    <path
                                                        d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Все задачи.</h6>
                                            <h6 class="font-extrabold mb-0"><?php echo e($task['all']); ?></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <a href="<?php echo e(route('admin.out_of_date')); ?>">
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon blue mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42"
                                                     fill="currentColor"
                                                     class="bi bi-calendar-check text-white fs-2"
                                                     viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                          d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                                    <path
                                                        d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                                    <path
                                                        d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Просроченные</h6>
                                            <h6 class="font-extrabold mb-0"><?php echo e($task['speed']); ?></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <a href="<?php echo e(route('admin.success')); ?>">
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon green mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42"
                                                     fill="currentColor" class="bi bi-check2-all text-white"
                                                     viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                                    <path
                                                        d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Архив</h6>
                                            <h6 class="font-extrabold mb-0"><?php echo e($task['success']); ?></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <a href="<?php echo e(route('admin.progress')); ?>">
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon mb-2" style="background: #eef511;">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     viewBox="0,0,256,256" width="32px" height="32px"
                                                     fill-rule="nonzero">
                                                    <g fill="#ffffff" fill-rule="nonzero" stroke="none"
                                                       stroke-width="1" stroke-linecap="butt"
                                                       stroke-linejoin="miter" stroke-miterlimit="10"
                                                       stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                       font-weight="none" font-size="none" text-anchor="none"
                                                       style="mix-blend-mode: normal">
                                                        <g transform="scale(8,8)">
                                                            <path
                                                                d="M16,4c-6.61719,0 -12,5.38281 -12,12c0,6.61719 5.38281,12 12,12c6.61719,0 12,-5.38281 12,-12c0,-6.61719 -5.38281,-12 -12,-12zM16,6c5.53516,0 10,4.46484 10,10c0,5.53516 -4.46484,10 -10,10c-5.53516,0 -10,-4.46484 -10,-10c0,-5.53516 4.46484,-10 10,-10zM15,8v9h7v-2h-5v-7z"/>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">В процессе</h6>
                                            <h6 class="font-extrabold mb-0"><?php echo e($task['inProgress']); ?></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <a href="<?php echo e(route('admin.clientVerification')); ?>">
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon mb-2" style="background: #ab9b93;">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     viewBox="0,0,256,256" width="32px" height="32px"
                                                     fill-rule="nonzero">
                                                    <g fill="#ffffff" fill-rule="nonzero" stroke="none"
                                                       stroke-width="1" stroke-linecap="butt"
                                                       stroke-linejoin="miter" stroke-miterlimit="10"
                                                       stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                       font-weight="none" font-size="none" text-anchor="none"
                                                       style="mix-blend-mode: normal">
                                                        <g transform="scale(8,8)">
                                                            <path
                                                                d="M16,4c-6.61719,0 -12,5.38281 -12,12c0,6.61719 5.38281,12 12,12c6.61719,0 12,-5.38281 12,-12c0,-6.61719 -5.38281,-12 -12,-12zM16,6c5.53516,0 10,4.46484 10,10c0,5.53516 -4.46484,10 -10,10c-5.53516,0 -10,-4.46484 -10,-10c0,-5.53516 4.46484,-10 10,-10zM15,8v9h7v-2h-5v-7z"/>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">На проверке (Клиент)</h6>
                                            <h6 class="font-extrabold mb-0"><?php echo e($task['clientVerification']); ?></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <a href="<?php echo e(route('admin.adminVerification')); ?>">
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon mb-2" style="background: #f17642;">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     viewBox="0,0,256,256" width="32px" height="32px"
                                                     fill-rule="nonzero">
                                                    <g fill="#ffffff" fill-rule="nonzero" stroke="none"
                                                       stroke-width="1" stroke-linecap="butt"
                                                       stroke-linejoin="miter" stroke-miterlimit="10"
                                                       stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                       font-weight="none" font-size="none" text-anchor="none"
                                                       style="mix-blend-mode: normal">
                                                        <g transform="scale(8,8)">
                                                            <path
                                                                d="M16,4c-6.61719,0 -12,5.38281 -12,12c0,6.61719 5.38281,12 12,12c6.61719,0 12,-5.38281 12,-12c0,-6.61719 -5.38281,-12 -12,-12zM16,6c5.53516,0 10,4.46484 10,10c0,5.53516 -4.46484,10 -10,10c-5.53516,0 -10,-4.46484 -10,-10c0,-5.53516 4.46484,-10 10,-10zM15,8v9h7v-2h-5v-7z"/>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">На проверке (Админ)</h6>
                                            <h6 class="font-extrabold mb-0"><?php echo e($task['adminVerification']); ?></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Список Тим-лидов</h5>
                                <div>
                                    <div>
                                        <table class="table mt-3"  cellpadding="5">
                                            <thead>
                                            <th>#</th>
                                            <th>ФИО</th>
                                            <th>Проекты</th>
                                            <th class="text-center">Кол-во задач</th>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $team_leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team_lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->index + 1); ?></td>
                                                    <td><?php echo e(Str::limit($team_lead->surname .' '. $team_lead->name . ' ' . $team_lead->lastname, 15)); ?></td>
                                                    <td>
                                                        <?php echo e(Str::limit($team_lead->pro_name, 15)); ?>

                                                    </td>
                                                    <td class="text-center"><?php echo e($team_lead->task_count); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-center">Лучшие сотрудники по оценке клиентов</h5>
                                    <div>
                                        <table class="table mt-4" cellpadding="5">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Фото</th>
                                                <th>ФИО</th>
                                                <th>Средняя оценка</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->index + 1); ?></td>
                                                    <td>
                                                        <?php if($user->avatar): ?>
                                                            <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" width="40" height="40" style="border-radius: 50%">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(asset('assets/images/avatar-2.png')); ?>" width="30">
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e(Str::limit($user->surname . " " . $user->name . " "  . $user->lastname, 15)); ?></td>
                                                    <td class="text-center"><?php echo e(round($user->average_rating, 1)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                        <p data-bs-toggle="offcanvas" data-bs-target="#RatingOfCanvas" aria-controls="RatingOfCanvas" role="button" class="text-primary text-end">
                                            Ещё..
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-center">Лучшие сотрудники по оценке админа</h5>
                                    <div>
                                        <table class="table mt-4" cellpadding="5">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Фото</th>
                                                <th>ФИО</th>
                                                <th>Средняя оценка</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $admin_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->index + 1); ?></td>
                                                    <td>
                                                        <?php if($user->avatar): ?>
                                                            <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" width="40" height="40" style="border-radius: 50%">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(asset('assets/images/avatar-2.png')); ?>" width="30">
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e(Str::limit($user->surname . " " . $user->name . " "  . $user->lastname, 15)); ?></td>
                                                    <td class="text-center"><?php echo e(round($user->average_rating, 1)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                        <p data-bs-toggle="offcanvas" data-bs-target="#AdminRatingOfCanvas" aria-controls="AdminRatingOfCanvas" role="button" class="text-primary text-end">
                                            Ещё..
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </section>
        </div>

    </div>
</div>



        <div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="RatingOfCanvas"
             aria-labelledby="RatingOfCanvas" style="width: 100%; height: 80%;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="RatingOfCanvas">Лучшие сотрудники по оценке клиентов</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <table class="table table-hover mt-4" cellpadding="5">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Фото</th>
                                    <th>Исполнитель</th>
                                    <th>Название задачи</th>
                                    <th>Клиент</th>
                                    <th class="text-center">Оценки клиента</th>
                                    <th>Причина</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->index+1); ?></td>
                                        <td>
                                            <?php if($user->avatar): ?>
                                                <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" width="40"
                                                     height="40" style="border-radius: 50%">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('assets/images/avatar-2.png')); ?>"
                                                     width="30">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($user->perfomer_surname . " " . $user->perfomer_name . " "  . $user->perfomer_lastname); ?></td>
                                        <td><?php echo e($user->task); ?></td>
                                        <td><?php echo e($user->surname . " " . $user->name . " "  . $user->lastname); ?></td>
                                        <td class="text-center"><?php echo e($user->rating); ?></td>
                                        <td ><?php echo e($user?->reason); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="AdminRatingOfCanvas"
             aria-labelledby="RatingOfCanvas" style="width: 100%; height: 80%;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="RatingOfCanvas">Лучшие сотрудники по оценке клиентов</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <table class="table table-hover mt-4" cellpadding="5">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Исполнитель</th>
                                    <th>Название задачи</th>
                                    <th class="text-center">Оценки админа</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $admin_ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->index+1); ?></td>
                                        <td><?php echo e($user->perfomer_surname . " " . $user->perfomer_name . " "  . $user->perfomer_lastname); ?></td>
                                        <td><?php echo e($user->task); ?></td>
                                        <td class="text-center"><?php echo e($user->rating); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php /**PATH /home/c/cx34222/taskosonmarket/resources/views/admin/index_page/panel.blade.php ENDPATH**/ ?>