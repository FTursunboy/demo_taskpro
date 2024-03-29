<?php $__env->startSection('title'); ?>
    Задачи
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Мои задачи</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Мои задачи</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <?php if(session('mess')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('mess')); ?>

                </div>
            <?php endif; ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <table id="example" class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th data-td="td_one">Название<span class="btn btn-right">></span></th>
                                <th data-td="td_two">Описание<span class="btn btn-right">></span></th>
                                <th class="text-center">До</th>
                                <th class="text-center">Проект</th>
                                <th class="text-center">Статус</th>
                                <th class="text-center">КПД</th>
                                <th class="text-center">Сотрудник</th>
                                <th class="text-center">Действия</th>
                            </tr>
                            </thead>
                            <tbody id="tableBodyMonitoring">
                            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e(\Illuminate\Support\Str::limit($task->name, 50)); ?></td>
                                    <td><?php echo e(\Illuminate\Support\Str::limit($task->comment, 100)); ?></td>
                                    <td class="text-center"><?php echo e(date('d-m-Y', strtotime($task->to))); ?></td>
                                    <td class="text-center"><?php echo e($task->project->name); ?></td>
                                    <?php switch($task->status->id):
                                        case (1): ?>
                                        <td><span class="badge bg-warning p-2"><?php echo e($task->status->name); ?></span></td>
                                        <?php break; ?>
                                        <?php case (2): ?>
                                        <td><span class="badge bg-primary p-2"><?php echo e($task->status->name); ?></span></td>
                                        <?php break; ?>
                                        <?php case (3): ?>
                                        <td><span class="badge bg-success p-2"><?php echo e($task->status->name); ?></span></td>
                                        <?php break; ?>
                                        <?php case (4): ?>
                                        <td><span class="badge bg-success p-2"><?php echo e($task->status->name); ?></span></td>
                                        <?php break; ?>
                                        <?php case (5): ?>
                                        <td><span class="badge bg-danger p-2"><?php echo e($task->status->name); ?></span></td>
                                        <?php break; ?>
                                        <?php case (6): ?>
                                        <td><a href="#" data-bs-toggle="modal"
                                               data-bs-target="#check<?php echo e($task->id); ?>"><span class="badge bg-primary p-2">На проверку</span></a>
                                        </td>
                                        <?php break; ?>
                                        <?php case (7): ?>
                                        <td><span class="badge bg-danger p-2"><?php echo e($task->status->name); ?></span></td>
                                        <?php break; ?>
                                        <?php case (8): ?>
                                        <td><span class="badge bg-warning p-2"><?php echo e($task->status->name); ?></span></td>
                                        <?php break; ?>
                                        <?php case (9): ?>
                                        <td><span class="badge bg-warning p-2"><?php echo e($task->status->name); ?></span></td>
                                        <?php break; ?>
                                        <?php case (10): ?>
                                        <td><span class="badge bg-success p-2"><?php echo e($task->status->name); ?></span></td>
                                        <?php break; ?>
                                        <?php case (11): ?>
                                        <td><span class="badge bg-danger p-2"><?php echo e($task->status->name); ?></span></td>
                                        <?php break; ?>
                                        <?php case (12): ?>
                                        <td><a data-bs-target="#sendBack<?php echo e($task->id); ?>" data-bs-toggle="modal" href="#"><span
                                                        class="badge bg-danger p-2">Отклонено (Сотрудник)</span></a>
                                        </td>
                                        <?php break; ?>
                                        <?php case (13): ?>
                                        <td><a data-bs-target="#sendBack<?php echo e($task->id); ?>" data-bs-toggle="modal" href="#"><span
                                                        class="badge bg-danger p-2">Отклонено (Клиент)</span></a></td>
                                        <?php break; ?>
                                        <?php case (14): ?>
                                        <td><a href="#" data-bs-target="#send<?php echo e($task->id); ?>"
                                               data-bs-toggle="modal"><span class="badge bg-success p-2"></span>На
                                                проверку</a></td>
                                        <?php break; ?>
                                    <?php endswitch; ?>
                                    <td class="text-center"><?php echo e($task->checkDate?->count); ?></td>
                                    <td class="text-center"><?php echo e($task->user?->surname . ' ' . $task->user?->name); ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('mon.show', $task->slug)); ?>" class="btn btn-success"><i
                                                    class="bi bi-eye"></i></a>
                                        <a href="<?php echo e(route('mon.edit', $task->slug)); ?>" class="btn btn-primary"><i
                                                    class="bi bi-pencil"></i></a>

                                    </td>
                                </tr>


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

                                <div class="modal fade" id="delete<?php echo e($task->id); ?>" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1"
                                     aria-labelledby="delete<?php echo e($task->id); ?>" aria-hidden="true"
                                     style="z-index: 9990">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="<?php echo e(route('tasks.delete', $task->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="delete<?php echo e($task->id); ?>">
                                                        Предупреждение</h1>
                                                    <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <?php if($task->status_id === 5): ?>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="cancel">Причина</label>
                                                            <textarea id="cancel" class="form-control"
                                                                      disabled><?php echo e($task->cancel); ?></textarea>
                                                        </div>
                                                        <div class="modal-body">
                                                            Точно хотите удалить задачу?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Нет
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Да, удалить
                                                            </button>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="editWrong<?php echo e($task->id); ?>" data-bs-backdrop="static"
                                     style="z-index: 9991"
                                     data-bs-keyboard="false" tabindex="-1"
                                     aria-labelledby="editWrong<?php echo e($task->id); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editWrong<?php echo e($task->id); ?>">
                                                    Предупреждение</h1>
                                                <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-5">
                                                    Вы не можете изменить это задание!
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Закрыть
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="editRight<?php echo e($task->id); ?>" data-bs-backdrop="static"
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
                                                                            value="<?php echo e($user->id); ?>" <?php echo e(($user->id === old('user_id') or $user->id === $task->user->id ) ? 'selected' : ''); ?>><?php echo e($user->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">
                                                        Перенаправить
                                                    </button>
                                                    <a href="<?php echo e(route('tasks.edit', $task->id)); ?>"
                                                       class="btn btn-primary">
                                                        Изменить
                                                    </a>
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
                                                        <label for="employee">Исполнители</label>
                                                        <select name="employee" id="employee"
                                                                class="form-control">
                                                            <option disabled value="0" selected>Выберите
                                                                исполнители
                                                            </option>
                                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option
                                                                        value="<?php echo e($user->id); ?>"><?php echo e($user->surname .' ' . $user->name .' '.$user->lastname); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-warning">
                                                        <Пере></Пере>направить
                                                    </button>
                                                    <button type="submit" class="btn btn-success">Готово
                                                    </button>
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
        </div>
    </div>
    </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/filter3.js')); ?>"></script>
    <script type="text/javascript">
        "use strict";

        let tMouse = {
            // isMouseDown
            // tMouse.target
            // tMouse.targetWidth
            // targetPosX
        };
        const eventNames = ["mousedown", "mouseup", "mousemove"];
        eventNames.forEach((e) => window.addEventListener(e, handle));

        function handle(e) {
            if (e.type === eventNames[0]) {
                tMouse.isMouseDown = true;
                let element = e.target.parentElement;
                if (!element.dataset[`td`]) return false;
                let th = document.querySelector(`th[data-td='${element.dataset[`td`]}']`);
                tMouse.target = th;
                tMouse.targetWidth = th.clientWidth;
                tMouse.targetPosX = th.getBoundingClientRect().x;
            }
            if (e.type === eventNames[1]) tMouse = {};
            if (e.type === eventNames[2]) {
                if (!tMouse.target || !tMouse.isMouseDown) return false;
                let size = (e.clientX - tMouse.targetWidth) - tMouse.targetPosX;
                tMouse.target.style.width = tMouse.targetWidth + size + "px";
            }
        }
    </script>



    <script>
        $(document).ready(function () {

            var table = $('#example').DataTable({
                "processing": true,
                "stateSave": true // Включаем сохранение состояния
            });
            // Apply filters from localStorage on page load
            var filters = JSON.parse(localStorage.getItem('datatableFilters'));
            if (filters) {
                for (var i = 0; i < filters.length; i++) {
                    var filter = filters[i];
                    table.column(filter.columnIndex).search(filter.value);
                }
                table.draw();
            }

            // Add event listeners to update filters and save them in localStorage
            $("#example thead th").each(function (i) {
                var th = $(this);
                var filterColumns = ['Сотрудник', 'Проект', 'Статус']; // Columns to add filters for

                if (filterColumns.includes(th.text().trim())) {
                    var select = $('<select></select>')
                        .appendTo(th.empty())
                        .addClass('form-control')
                        .on('change', function () {
                            var columnIndex = i;
                            var value = $(this).val();
                            table.column(columnIndex).search(value).draw();

                            // Save filters in localStorage
                            var filters = [];
                            $("#example thead select").each(function () {
                                var filter = {
                                    columnIndex: $(this).closest('th').index(),
                                    value: $(this).val()
                                };
                                filters.push(filter);
                            });
                            localStorage.setItem('datatableFilters', JSON.stringify(filters));
                        });

                    // Add default option of "Все" (All)
                    $('<option value="" selected>Все</option>').appendTo(select);

                    // Get unique options for the column
                    var options = table.column(i).data().unique().sort().toArray();

                    // Remove HTML tags from options
                    options = options.map(function (option) {
                        var tempElement = $('<div>').html(option);
                        return tempElement.text();
                    });

                    // Remove duplicate options
                    var uniqueOptions = [];
                    options.forEach(function (option) {
                        if (!uniqueOptions.includes(option)) {
                            uniqueOptions.push(option);
                            var optionText = option === null ? 'Нет данных' : option;
                            var optionElement = $('<option></option>').attr('value', option).text(optionText);
                            select.append(optionElement);
                        }
                    });


                    var storedFilters = JSON.parse(localStorage.getItem('datatableFilters'));
                    if (storedFilters) {
                        var storedFilter = storedFilters.find(function (filter) {
                            return filter.columnIndex === i;
                        });
                        if (storedFilter) {
                            select.val(storedFilter.value);
                        }
                    }
                }
            });
            var resetButton = $('<button></button>')
                .addClass('btn btn-primary')
                .text('X')
                .on('click', function () {
                    // Сбрасываем фильтры и поиск
                    table
                        .search('')
                        .columns()
                        .search('')
                        .draw();


                    localStorage.removeItem('datatableFilters');

                    $("#example thead select").val('');


                    $('#example_filter input').val('');
                });

            var searchWrapper = $('#example_filter');
            searchWrapper.addClass('d-flex align-items-center');
            resetButton.addClass('ml-2');
            resetButton.appendTo(searchWrapper);
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/c/cx34222/task_manager/public_html/tasks/resources/views/admin/tasks/index.blade.php ENDPATH**/ ?>