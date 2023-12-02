<?php $__env->startSection('title'); ?>
    Контакты
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Контакты</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Контакты</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <?php echo $__env->make('.inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="section">
            <div class="card">
                <div class="card-header">
                        <a href="<?php echo e(route('contact.create')); ?>" class="btn btn-outline-primary">
                        Добавить контакт
                    </a>
                </div>
                <div class="card-body" style="overflow: auto;">
                    <table id="example" style="width: 100%" class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th data-td="td_one">ФИО<span class="btn btn-right">></span></th>
                            <th data-td="td_two">Телефон<span class="btn btn-right">></span></th>
                            <th data-td="td_three">Адрес<span class="btn btn-right">></span></th>
                            <th data-td="td_four">Лид<span class="btn btn-right">></span></th>

                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(Str::limit($contact?->fio, 50)); ?></td>
                                <td><?php echo e($contact?->phone); ?></td>
                                <td><?php echo e($contact?->address); ?></td>
                                <td><?php echo e(Str::limit($contact?->fio, 50)); ?></td>

                                <td class="text-center">
                                    <a href="<?php echo e(route('contact.show', $contact->id)); ?>" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                    <a href="<?php echo e(route('contact.edit', $contact->id)); ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                       data-bs-target="#delete<?php echo e($contact->id); ?>"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade text-left" id="delete<?php echo e($contact->id); ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="delete<?php echo e($contact->id); ?>" data-bs-backdrop="false" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <form action="<?php echo e(route('contact.destroy', $contact->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="delete<?php echo e($contact->id); ?>">Предупреждение</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    Точно хотите удалить контакт?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Нет</span>
                                                </button>
                                                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Да</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/search.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable.js')); ?>"></script>
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
                initComplete: function () {

                },
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make(auth()->user()->hasRole('crm') ? 'user.layouts.app' : 'admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tasks\resources\views/admin/CRM/contacts/index.blade.php ENDPATH**/ ?>