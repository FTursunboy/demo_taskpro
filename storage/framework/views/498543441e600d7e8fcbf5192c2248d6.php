<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="verAdmin"
     aria-labelledby="verAdmin" style="width: 100%; height: 100%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="ProjectOfCanvas">На проверке (Админ)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <div class="card-body overflow-hidden">
                <div>
                    <table id="verAdminTable" class="table table-hover mt-3 " cellpadding="5">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th class="text-center">Время</th>
                            <th class="text-center">От</th>
                            <th class="text-center">До</th>
                            <th class="text-center">Проект</th>
                            <th class="text-center">Автор</th>
                            <th class="text-center">Тип</th>
                            <th class="text-center">Статус</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $tasksVerAdmin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                <td ><?php echo e($task->name); ?></td>
                                <td ><?php echo e(Str::limit($task->comment, 100)); ?></td>
                                <td class="text-center"><?php echo e($task->time); ?></td>
                                <td class="text-center"><?php echo e(date('d-m-Y', strtotime($task->from))); ?></td>
                                <td class="text-center"><?php echo e(date('d-m-Y', strtotime($task->to))); ?></td>
                                <td class="text-center"><?php echo e($task->project->name); ?></td>
                                <td class="text-center"><?php echo e($task->author->name); ?></td>
                                <td class="text-center">
                                    <?php if($task->type === null): ?>
                                        От клиента
                                    <?php elseif($task->type !== null): ?>
                                        <?php echo e($task->type?->name); ?> <?php echo e((isset($task->typeType?->name)) ? ' - '.$task->typeType?->name : ''); ?>

                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><?php echo e($task->status->name); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('all-tasks.show', $task->slug)); ?>" class="btn btn-success"><i class="bi bi-eye"></i></a>
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
        var table = $('#verAdminTable').DataTable({
            "processing": true,
            "stateSave": true
        });

        var statusParam = decodeURIComponent(window.location.pathname.split('/').pop());

        $("#verAdminTable thead th").each(function(i) {
            var th = $(this);
            var filterColumns = ['Проект', 'Автор', 'Тип', 'Статус', 'Сотрудник'];

            if (filterColumns.includes(th.text().trim())) {
                if (th.text().trim() === 'Статус') {
                    var select = th.find('select');
                    select.val(statusParam);
                    select.trigger('change');
                }
            }
        });

        var filters = JSON.parse(localStorage.getItem('datatableFilters'));
        if (filters) {
            for (var i = 0; i < filters.length; i++) {
                var filter = filters[i];
                table.column(filter.columnIndex).search(filter.value);
            }
            table.draw();
        }

        $("#verAdminTable thead th").each(function (i) {
            var th = $(this);
            var filterColumns = ['Проект', 'Автор', 'Тип', 'Статус', 'Сотрудник'];

            if (filterColumns.includes(th.text().trim())) {
                var select = $('<select></select>')
                    .appendTo(th.empty())
                    .addClass('form-control')
                    .on('change', function () {
                        var columnIndex = i;
                        var value = $(this).val();
                        table.column(columnIndex).search(value).draw();
                    });

                $('<option value="" selected>Все</option>').appendTo(select);

                var options = table.column(i).data().unique().sort().toArray();

                options = options.map(function (option) {
                    var tempElement = $('<div>').html(option);
                    return tempElement.text();
                });

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

                table
                    .search('')
                    .columns()
                    .search('')
                    .draw();


                localStorage.removeItem('datatableFilters');

                $("#verAdminTable thead select").val('');

                $('#verAdminTable_filter input').val('');
            });

        var searchWrapper = $('#verAdminTable_filter');
        searchWrapper.addClass('d-flex align-items-center');
        resetButton.addClass('ml-2');
        resetButton.appendTo(searchWrapper);


    });



</script>

<script src="<?php echo e(asset('assets/ajax/monitoring.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/search.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable.js')); ?>"></script>
<?php /**PATH C:\xampp\htdocs\tasks\resources\views/user/pages/verAdmin.blade.php ENDPATH**/ ?>