<?php if($errors->any()): ?>
    <div class="alert alert-danger mt-2">
        <ol>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </div>
<?php endif; ?>

<?php if(\Session::has('create')): ?>
    <div class="alert alert-success" id="create">
        <?php echo e(\Session::get('create')); ?>

    </div>
    <script>
        setTimeout(() => {
            $('#create').remove()
        },4500)
    </script>
<?php elseif(\Session::has('update')): ?>
    <div class="alert alert-info" id="update">
        <?php echo e(\Session::get('update')); ?>

    </div>
    <script>
        setTimeout(() => {
            $('#update').remove()
        },4500)
    </script>
<?php elseif(\Session::has('delete')): ?>
    <div class="alert alert-danger" id="delete">
        <?php echo e(\Session::get('delete')); ?>

    </div>
    <script>
        setTimeout(() => {
            $('#delete').remove()
        },4500)
    </script>
<?php elseif(\Session::has('error')): ?>
    <div class="alert alert-danger" id="error">
        <?php echo e(\Session::get('error')); ?>

    </div>
    <script>
        setTimeout(() => {
            $('#error').remove()
        },4500)
    </script>
<?php elseif(\Session::has('warning')): ?>
    <div class="alert alert-warning" id="warning">
        <?php echo e(\Session::get('warning')); ?>

    </div>
    <script>
        setTimeout(() => {
            $('#warning').remove()
        },4500)
    </script>
<?php endif; ?>
<?php /**PATH C:\Users\Faiziev Tursunboy\Documents\GitHub\tasks\resources\views//inc/messages.blade.php ENDPATH**/ ?>