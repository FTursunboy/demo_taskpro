<?php $__env->startSection('content'); ?>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Задачи</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('client.offers.index')); ?>">Задачи</a></li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
        <section class="section">
            <?php if(session('mess')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('mess')); ?>

                </div>
            <?php endif; ?>

            <div class="row">
                <div class="row pt-4">
                    <div class="col-md-12">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger w-100 text-center">Заполните
                                все поля
                            </div>
                        <?php endif; ?>
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-1">
                                        <a href="<?php echo e(route('client.offers.index')); ?>" class="btn btn-danger">Назад</a>

                                    </div>
                                </div>
                            </div>
                            <?php if($settings?->has_access == false): ?>
                                <h4 style="margin-left: 30px; color: red" class="offcanvas-title" id="ProjectOfCanvas">Вы не можете создать задачу от имени клиента. Пополните баланс!</h4>
                            <?php endif; ?>

                            <?php if(\Session::has('err')): ?>
                                <div class="alert alert-danger mt-4">
                                    <?php echo e(\Session::get('err')); ?>

                                </div>
                            <?php endif; ?>


                            <div class="container my-5">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-9">
                                        <form method="post" action="<?php echo e(route('client.offers.store')); ?>"
                                              enctype="multipart/form-data"
                                              autocomplete="off">
                                            <?php echo csrf_field(); ?>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Название задачи</label>
                                                    <textarea <?php echo e($settings?->has_access ? '' : 'disabled'); ?> id="name" class="form-control"
                                                              name="name"
                                                              rows="5" required><?php echo e(old('name')); ?></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    
                                                    <div class="form-group mt-2">
                                                        <label class="form-label">Клиент</label>
                                                            <select  <?php echo e($settings?->has_access ? '' : 'disabled'); ?> id="client_id" name="client_id" class="form-control" required>
                                                                <option>Выберите клиента</option>
                                                                <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($offer->id); ?>"><?php echo e($offer->surname . " " . $offer->name . " " . $offer->lastname); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Ответственный сотрудник со стороны
                                                            компании</label>
                                                        <input <?php echo e($settings?->has_access ? '' : 'disabled'); ?> type="text"
                                                               class="form-control"
                                                               name="author_name" id="author_name"
                                                               value="<?php echo e(old('author_name')); ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Телефон ответсвенного сотрудника</label>
                                                    <input <?php echo e($settings?->has_access ? '' : 'disabled'); ?> type="text"
                                                           class="form-control"
                                                           name="author_phone" id="author_phone"
                                                           value="<?php echo e(old('author_phone')); ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Выберите файл</label>
                                                    <input <?php echo e($settings?->has_access ? '' : 'disabled'); ?> type="file"
                                                           class="form-control"
                                                           name="file">
                                                </div>
                                                <div class="col-12">
                                                    <label for="your-message" class="form-label">Описание
                                                        задачи</label>
                                                    <textarea <?php echo e($settings?->has_access ? '' : 'disabled'); ?> id="description" class="form-control"
                                                              name="description"
                                                              rows="5"><?php echo e(old('description')); ?></textarea>
                                                </div>
                                                <div class="col-md-6">

                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <button <?php echo e($settings?->has_access ? '' : 'disabled'); ?> type="submit" class="btn btn-success form-control"
                                                            id="btnSend" onclick="btnSendFn()">
                                                        Отправить
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        var counter = 0;

        function btnSendFn()
        {
            counter++

            if (counter === 2){
                var button = document.getElementById('btnSend')
                button.type = "button"
            }
        }


        $('#client_id').change(function () {
            let kpi = $(this).children('option:selected')

                $.get(`/getClientName/${kpi.val()}/`).then((res) => {
                    $('#author_name').val(res.name)
                    $('#author_phone').val(res.phone)
                });


        })

    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Khusrav\tasks\resources\views/admin/offers/create.blade.php ENDPATH**/ ?>