<div class="table-responsive">
    <table id="example" class="table table-hover">
        <thead>
        <tr class="text-center">
            <th>#</th>
            <th>Задача</th>
            <th>Статус</th>
            <th>Исполнитель</th>
            <th>Проект</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody id="tableBodyMonitoringCommand">
        <?php $__currentLoopData = $userListTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($task->task); ?></td>
                <?php switch($task->status_id):
                    case (1): ?>
                        <td><span class="badge bg-warning p-2">Ожидается</span></td>
                        <?php break; ?>
                    <?php case (2): ?>
                        <td><span class="badge bg-success p-2"><?php echo e($task->sts); ?></span></td>
                        <?php break; ?>
                    <?php case (3): ?>
                        <td><span class="badge bg-success p-2"><?php echo e($task->sts); ?></span></td>
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
                        <td><span class="badge bg-danger p-2"><?php echo e($task->sts); ?></span></td>
                        <?php break; ?>
                    <?php case (8): ?>
                        <td><span class="badge bg-warning p-2"><?php echo e($task->sts); ?></span></td>
                        <?php break; ?>
                    <?php case (9): ?>
                        <td><span class="badge bg-warning p-2">Ожид. (Сотруд)</span></td>
                        <?php break; ?>
                    <?php case (10): ?>
                        <td><span class="badge bg-success p-2">У клиента</span></td>
                        <?php break; ?>
                    <?php case (11): ?>
                        <td><span class="badge bg-danger p-2"><?php echo e($task->sts); ?></span></td>
                        <?php break; ?>
                    <?php case (12): ?>
                        <td><span class="badge bg-warning p-2"><?php echo e($task->sts); ?></span></td>
                        <?php break; ?>
                    <?php case (13): ?>
                        <td><span class="badge bg-danger p-2">Отклон.(клиент.)</span></td> <?php break; ?>
                    <?php case (14): ?>
                        <td><span class="badge bg-warning p-2"><?php echo e($task->sts); ?></span></td> <?php break; ?>
                    <?php case (15): ?>
                        <td><span class="badge bg-warning p-2"><?php echo e($task->sts); ?></span></td> <?php break; ?>
                    <?php case (16): ?>
                        <td><span class="badge bg-warning p-2"><?php echo e($task->sts); ?></span></td> <?php break; ?>

                <?php endswitch; ?>
                <td><?php echo e($task->surname . ' ' . $task->name. ' '. $task->lastname); ?></td>
                <td><?php echo e($task->group); ?></td>
                <td><a href="<?php echo e(route('my-command.show', $task->slug)); ?>" class="btn btn-success"><i class="bi bi-eye"></i></a></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>

<script src="<?php echo e(asset('assets/js/filter3.js')); ?>"></script>

<script>
    $(document).ready(function () {
        var table = $('#example').DataTable({
            "processing": true,
            "stateSave": true
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
            var filterColumns = ['Проект', 'Автор', 'Тип', 'Статус', 'Исполнитель'];

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
<?php /**PATH C:\xampp\htdocs\tasks\resources\views/user/my-command/my-command-tasks.blade.php ENDPATH**/ ?>