<p>Здравствуйте, Вам поступила новая задача.</p>
<p>Номер : <?php echo e($task->id); ?></p>
<p>Название : <?php echo e($task->name); ?></p>
<p>Время в часах: <?php echo e($task->time); ?></p>
<p>От : <?php echo e($task->from); ?></p>
<p>До : <?php echo e($task->to); ?></p>
<p>Тип : <?php echo e($task->type->name); ?></p>
<?php /**PATH /home/c/cx34222/taskosonmarket/resources/views/mail/send_task_to_user.blade.php ENDPATH**/ ?>