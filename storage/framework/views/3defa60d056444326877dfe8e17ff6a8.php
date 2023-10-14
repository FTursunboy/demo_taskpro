<?php $__env->startSection('title'); ?>
    Мониторинг
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Мониторинг</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.index')); ?>">Панель</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Мониторинг</li>
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
        <div class="row mt-4">
            <div class="col-md-3">

                <a href="#" id="exportButton" class="btn btn-danger mb-4"> Excel</a>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table id="example" class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th data-td="td_one">Имя<span class="btn btn-right">></span></th>
                            <th data-td="td_four">Описание<span class="btn btn-right">></span></th>
                            <th data-td="td_two">От<span class="btn btn-right">></span></th>
                            <th data-td="td_three">До<span class="btn btn-right">></span></th>
                            <th>Проект</th>
                            <th class="text-center">Автор</th>
                            <th class="text-center">Тип</th>
                            <th class="text-center">Статус</th>
                            <th class="text-center">КПД</th>
                            <th class="text-center">Сотрудник</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="tableBodyMonitoring">
                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($task->id + 1000); ?></td>
                                <td><?php echo e(\Illuminate\Support\Str::limit($task->name, 50)); ?></td>
                                <td><?php echo e($task->comment); ?></td>
                                <td  ><?php echo e(date('d-m-Y', strtotime($task->from))); ?></td>
                                <td  ><?php echo e(date('d-m-Y', strtotime($task->to))); ?></td>
                                <td class="text-center"><?php echo e($task->project->name); ?></td>
                                <td class="text-center"><?php echo e($task->author->name); ?></td>
                                <td class="text-center">
                                    <?php if($task->type === null): ?>
                                        От клиента
                                    <?php elseif($task->type !== null): ?>
                                        <?php echo e($task->type?->name); ?> <?php echo e((isset($task->typeType?->name)) ? ' - '.$task->typeType?->name : ''); ?>

                                    <?php endif; ?>
                                </td>

                                <?php switch($task->status->id):
                                    case (1): ?>
                                    <td><span class="badge bg-warning p-2">Ожид. (Сотруд)</span></td>
                                    <?php break; ?>
                                    <?php case (2): ?>
                                    <td><span class="badge bg-success p-2"><?php echo e($task->status->name); ?></span></td>
                                    <?php break; ?>
                                    <?php case (3): ?>
                                    <td><span class="badge bg-success p-2"><?php echo e($task->status->name); ?></span></td>
                                    <?php break; ?>
                                    <?php case (4): ?>
                                    <td><span class="badge bg-success p-2">В процессе</span></td>
                                    <?php break; ?>
                                    <?php case (5): ?>
                                    <td><span class="badge bg-warning p-2">Отклон.(сотруд.)</span></td>
                                    <?php break; ?>
                                    <?php case (6): ?>
                                    <td><span class="badge bg-success p-2">На проверке (Адм)</span></td>
                                    <?php break; ?>
                                    <?php case (7): ?>
                                    <td><span class="badge bg-danger p-2"><?php echo e($task->status->name); ?></span></td>
                                    <?php break; ?>
                                    <?php case (8): ?>
                                    <td><span class="badge bg-warning p-2"><?php echo e($task->status->name); ?></span></td>
                                    <?php break; ?>
                                    <?php case (9): ?>
                                    <td><span class="badge bg-warning p-2">Ожид. (Сотруд)</span></td>
                                    <?php break; ?>
                                    <?php case (10): ?>
                                    <td><span class="badge bg-success p-2">У клиента</span></td>
                                    <?php break; ?>
                                    <?php case (11): ?>
                                    <td><span class="badge bg-danger p-2"><?php echo e($task->status->name); ?></span></td>
                                    <?php break; ?>
                                    <?php case (12): ?>
                                   <td><span class="badge bg-warning p-2"><?php echo e($task->status->name); ?></span></td>
                                    <?php break; ?>
                                    <?php case (13): ?>
                                    <td><span class="badge bg-danger p-2">Отклон.(клиент.)</span></td> <?php break; ?>
                                    <?php case (14): ?>
                                    <td><span class="badge bg-warning p-2"><?php echo e($task->status->name); ?></span></td> <?php break; ?>
                                    <?php case (15): ?>
                                        <td><span class="badge bg-green p-2"><?php echo e($task->status->name); ?></span></td> <?php break; ?>
                                    <?php case (16): ?>
                                        <td><span class="badge bg-success p-2"><?php echo e($task->status->name); ?></span></td>
                                        <?php break; ?>
                                <?php endswitch; ?>
                                <td class="text-center"><?php echo e($task->checkDate?->count); ?></td>
                                <?php if($task->user && $task->user?->deleted_at): ?>
                                    <td class="text-center">Удаленный аккаунт</td>
                                <?php else: ?>
                                    <td class="text-center"><?php echo e($task->user ? $task->user->surname . ' ' . $task->user->name : ''); ?></td>
                                <?php endif; ?>

                                <td class="text-center">
                                    <a href="<?php echo e(route('mon.show', $task->slug)); ?>" class="btn btn-success"><i
                                            class="bi bi-eye"></i></a>
                                </td>
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>


<!-- Подключение библиотеки exceljs через CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>

    <script>
        // Function to export HTML table to Excel using exceljs
        function exportToExcel() {
            const table = document.getElementById('example');

            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet('Sheet 1');

            // Iterate through table rows and cells and add data to the worksheet
            table.querySelectorAll('tr').forEach((row) => {
                const rowData = [];
                row.querySelectorAll('td, th').forEach((cell) => {
                    rowData.push(cell.textContent);
                });
                worksheet.addRow(rowData);
            });

            // Create a blob from the workbook and save it as a .xlsx file
            workbook.xlsx.writeBuffer().then((buffer) => {
                const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                const url = window.URL.createObjectURL(blob);

                const a = document.createElement('a');
                a.href = url;
                a.download = 'table-export.xlsx';

                // Trigger a click event on the link to download the file
                a.click();

                // Clean up
                window.URL.revokeObjectURL(url);
            });
        }
        // Attach the exportToExcel function to the button click event
        const exportButton = document.getElementById('exportButton');
        exportButton.addEventListener('click', exportToExcel);

    </script>







    <script src="<?php echo e(asset('assets/js/filter3.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/table2excel.js')); ?>" ></script>
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
            document.getElementById('excel').addEventListener('click', function () {
                var table2excel = new Table2Excel();
                table2excel.export(document.querySelectorAll('#example'));
            })

        });

    </script>
    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                "processing": true,
                "stateSave": true
            });

            var statusParam = decodeURIComponent(window.location.pathname.split('/').pop());

            $("#example thead th").each(function(i) {
                var th = $(this);
                var filterColumns = ['Проект', 'Автор', 'Тип', 'Статус', 'Сотрудник'];


            });

            var filters = JSON.parse(localStorage.getItem('datatableFilters'));
            if (filters) {
                for (var i = 0; i < filters.length; i++) {
                    var filter = filters[i];
                    table.column(filter.columnIndex).search(filter.value);
                }
                table.draw();
            }

            $("#example thead th").each(function (i) {
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Xammp\htdocs\tasks\resources\views/admin/monitoring/index.blade.php ENDPATH**/ ?>