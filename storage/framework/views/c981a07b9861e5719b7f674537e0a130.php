<div class="table-responsive">
    <div class="form-group col-3">
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
    <table id="example_1" class="table table-hover">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th data-td="td_one">Название<span class="btn btn-right">></span></th>
            <th data-td="td_two">Описание<span class="btn btn-right">></span></th>
            <th class="text-center" data-td="td_three">От<span class="btn btn-right">></span></th>
            <th class="text-center" data-td="td_four">До<span class="btn btn-right">></span></th>
            <th class="text-center">Время<span class="btn btn-right"></span></th>
            <th class="text-center">Проект</th>
            <th class="text-center">Автор</th>
            <th class="text-center">Тип</th>
            <th class="text-center">Статус</th>
            <th class="text-center">Действия</th>
        </tr>
        </thead>
        <tbody id="tableBodyMonitoring">
        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                <td ><?php echo e($task->name); ?></td>
                <td ><?php echo e(Str::limit($task->comment, 100)); ?></td>
                <td class="text-center"><?php echo e(date('d-m-Y', strtotime($task->from))); ?></td>
                <td class="text-center"><?php echo e(date('d-m-Y', strtotime($task->to))); ?></td>
                <td class="text-center"><?php echo e($task?->time); ?></td>
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
                        <td><span class="badge bg-warning p-2">Ожидаеться</span></td>
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
                <?php endswitch; ?>
                <td class="text-center">
                    <a href="<?php echo e(route('all-tasks.show', $task->slug)); ?>" class="btn btn-success"><i class="bi bi-eye"></i></a>


                </td>
            </tr>























        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <style>
        #month{
            background: #F2F7FF;
           }
    </style>
</div>
<?php /**PATH /home/c/cx34222/task_manager/public_html/tasks/resources/views/user/all-tasks/tasks.blade.php ENDPATH**/ ?>