<?php $__env->startSection('title'); ?>
    Проекты
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Добавить новый проект</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('project.index')); ?>">Список проектов</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Добавить новый проект</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card">
            <?php if($settings?->has_access == false): ?>
                <h4 style="margin-left: 30px; color: red" class="offcanvas-title" id="ProjectOfCanvas">Вы не можете создать проект. Пополните баланс!</h4>
            <?php endif; ?>
            <div class="card-header">
                <a href="<?php echo e(route('project.index')); ?>" class="btn btn-outline-danger">
                    Назад
                </a>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('project.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-4">

                            <div class="form-group">
                                <label for="name">Имя проекта</label>
                                <input <?php echo e($settings?->has_access ? '' : 'disabled'); ?> type="text" id="name" name="name" tabindex="1" class="form-control mt-3"
                                       placeholder="Имя проекта" value="<?php echo e(old('name')); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="start">Дата начала проекта</label>
                                <input <?php echo e($settings?->has_access ? '' : 'disabled'); ?> type="date" id="start" name="start" class="form-control mt-3" tabindex="4" value="<?php echo e(old('start')); ?>" required>
                            </div>

                        </div>
                        <div class="col-4">

                            <div class="form-group">
                                <label for="time">Время</label>
                                <input <?php echo e($settings?->has_access ? '' : 'disabled'); ?> type="number" id="time" name="time" class="form-control mt-3" tabindex="2" value="<?php echo e(old('time')); ?>" placeholder="Время">
                                <?php if($errors->has('time')): ?> <p
                                    style="color: red;"><?php echo e($errors->first('time')); ?></p> <?php endif; ?>
                            </div>


                            <div class="form-group">
                                <label for="finish">Дата окончания проекта</label>
                                <input <?php echo e($settings?->has_access ? '' : 'disabled'); ?> type="date" id="finish" name="finish" class="form-control mt-3" tabindex="5" value="<?php echo e(old('finish')); ?>" required>
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="type">Тип</label>
                                <select <?php echo e($settings?->has_access ? '' : 'disabled'); ?> id="type" name="type_id" tabindex="3" class="form-select mt-3" required>
                                    <option value="" selected>Выберите тип</option>
                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">Тип</label>
                                <select <?php echo e($settings?->has_access ? '' : 'disabled'); ?> id="type" name="types_id" tabindex="6" class="form-select mt-3" required>
                                    <option value="" selected>Выберите тип проекта</option>
                                    <?php $__currentLoopData = $typesOf; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="comment">Комментария</label>
                                <textarea <?php echo e($settings?->has_access ? '' : 'disabled'); ?> name="comment" id="comment" class="form-control mt-3" tabindex="7"><?php echo e(old('comment')); ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file">Файл</label>
                                    <input <?php echo e($settings?->has_access ? '' : 'disabled'); ?> tabindex="7" type="file"  name="file" class="form-control mt-3" id="file">
                                </div>
                            </div>
                            <div class="col-6"></div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button <?php echo e($settings?->has_access ? '' : 'disabled'); ?> type="submit" id="button" class="btn btn-outline-primary" tabindex="8">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>


    <script>
        const fromInput = document.getElementById('start');
        let prevValue = fromInput.value;

        fromInput.addEventListener('input', function() {
            const dateValue = new Date(this.value);
            const year = dateValue.getFullYear();
            const maxLength = 4;

            if (year.toString().length > maxLength) {
                this.value = prevValue; // Восстанавливаем предыдущее значение
            } else {
                prevValue = this.value; // Сохраняем текущее значение
            }
        });
    </script>
    <script>
        const toInput = document.getElementById('finish');
        let prevValue1 = toInput.value;

        toInput.addEventListener('input', function() {
            const dateValue = new Date(this.value);
            const year = dateValue.getFullYear();
            const maxLength = 4;

            if (year.toString().length > maxLength) {
                this.value = prevValue1; // Восстанавливаем предыдущее значение
            } else {
                prevValue1 = this.value; // Сохраняем текущее значение
            }
        });
    </script>



    <script>
        $('#start').change(function ()  {
            const finish = $('#finish')
            if ($(this).val() > finish.val()) {
                $(this).addClass('border-danger')
                finish.addClass('border-danger')
                $('#button').attr('type', 'button');
            } else {
                $(this).removeClass('border-danger')
                finish.removeClass('border-danger')
                $('#button').attr('type', 'submit');
            }
        })
        $('#finish').change(function ()  {
            const start = $('#start')
            if ($(this).val() < start.val()) {
                $(this).addClass('border-danger')
                start.addClass('border-danger')
                $('#button').attr('type', 'button');
            } else {
                $(this).removeClass('border-danger')
                start.removeClass('border-danger')
                $('#button').attr('type', 'submit');
            }
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/c/cx34222/taskosonmarket/resources/views/admin/project/create.blade.php ENDPATH**/ ?>