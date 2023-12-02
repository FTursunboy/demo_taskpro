<?php $__env->startSection('title'); ?>Клиенты<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="page-heading">


        <div class="row pt-4">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Проект</th>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($user->project); ?></td>
                        <td><?php echo e($user->surname . ' ' . $user->name .' '. $user->lastname); ?></td>
                        <td><?php echo e($user->phone); ?></td>
                        <td><?php if(Cache::has('user-is-online-' . $user?->id)): ?>
                                <span class="text-center text-success mx-2"><b>Online</b></span>
                            <?php else: ?>
                                <span class="text-center text-danger  mx-2"><b>Offline</b>
                                                     <?php if($user->last_seen !== null): ?>
                                        <span class="text-gray-600"> - <?php echo e(\Carbon\Carbon::parse($user?->last_seen)->diffForHumans()); ?></span>
                                    <?php endif; ?>
                                                </span>
                            <?php endif; ?></td>
                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>
        </div>


    </div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tasks\resources\views/user/clients/index.blade.php ENDPATH**/ ?>