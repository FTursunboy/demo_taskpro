<?php $__env->startSection('title'); ?>Список задач<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/filter.css')); ?>">
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style>
        .content{
            padding: 40px 0;
        }
        /*
        .filter-wrapper{
          padding: 30px 0;
        }*/

        .filter-checkbox{
            margin-left: 30px
        }
        .filter-checkbox:first-child{
            margin-left:0
        }
    </style>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Список задач клиентов</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('client.offers.index')); ?>">Список задач клиентов</a></li>

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <?php if(isset($mess)): ?>
                                <div class="alert alert-success">
                                    <?php echo e($mess); ?>

                                </div>
                            <?php endif; ?>
                                <?php if(session('mess')): ?>
                                    <div class="alert alert-success">
                                        Успешно отправлено
                                    </div>
                                <?php endif; ?>
                            <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div>
                                <a href="<?php echo e(route( 'client.offers.create')); ?>" class="btn btn-outline-primary">Добавить задачу</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-responsive" id="example">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Описание</th>
                                    <th>Исполнитель</th>
                                    <th>Проект</th>
                                    <th>Статус</th>
                                    <th class="text-center">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td width="20%"><?php echo e(\Illuminate\Support\Str::limit($offer->name, 35)); ?></td>
                                        <td width="15%"><?php echo e(\Illuminate\Support\Str::limit($offer->description, 35)); ?></td>
                                        <?php if($offer->user_id): ?>
                                            <td><?php echo e($offer->username); ?></td>
                                        <?php else: ?>
                                            <td class="text-danger text-bold">Не распределен</td>
                                        <?php endif; ?>

                                        <td><?php echo e($offer->project_name); ?></td>

                                        <?php switch($offer->status):
                                            case (1): ?>
                                            <td><span class="badge bg-success p-2"><?php echo e($offer->status_name); ?></span></td>
                                            <?php break; ?>
                                            <?php case (2): ?>
                                            <td><span class="badge bg-primary p-2"><?php echo e($offer->status_name); ?></span></td>
                                            <?php break; ?>
                                            <?php case (3): ?>
                                            <td><span class="badge bg-success p-2"><?php echo e($offer->status_name); ?></span></td>
                                            <?php break; ?>
                                            <?php case (4): ?>
                                            <td><span class="badge bg-warning p-2"><?php echo e($offer->status_name); ?></span></td>
                                            <?php break; ?>
                                            <?php case (5): ?>
                                            <td><span class="badge bg-warning p-2"><?php echo e($offer->status_name); ?></span></td>
                                            <?php break; ?>
                                            <?php case (6): ?>
                                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#send<?php echo e($offer->id); ?>"><span class="badge bg-primary p-2">В ожидании проверки администратора</span></a></td>
                                            <?php break; ?>
                                            <?php case (7): ?>
                                            <td><span class="badge bg-warning p-2"><?php echo e($offer->status_name); ?></span></td>
                                            <?php break; ?>
                                            <?php case (8): ?>
                                            <td><span class="badge bg-warning p-2"><?php echo e($offer->status_name); ?></span></td>
                                            <?php break; ?>
                                            <?php case (9): ?>
                                            <td><span class="badge bg-warning p-2"><?php echo e($offer->status_name); ?></span></td>
                                            <?php break; ?>
                                            <?php case (10): ?>
                                            <td><span class="badge bg-success p-2"><?php echo e($offer->status_name); ?></span></td>
                                            <?php break; ?>
                                            <?php case (11): ?>
                                            <td><span class="badge bg-danger p-2"><?php echo e($offer->status_name); ?></span></td>
                                            <?php break; ?>
                                            <?php case (12): ?>
                                            <td><a data-bs-target="#sendBack<?php echo e($offer->id); ?>" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">Отклонено (Сотрудник)</span></a></td>
                                            <?php break; ?>
                                            <?php case (13): ?>
                                            <td><a data-bs-target="#sendBack<?php echo e($offer->id); ?>" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">Отклонено (Клиент)</span></a></td>
                                            <?php break; ?>
                                            <?php case (14): ?>
                                            <td><a href="#" data-bs-target="#send<?php echo e($offer->id); ?>" data-bs-toggle="modal"><span class="badge bg-success p-2">Задача сделана, отправьте клиенту на проверку</span></a></td>
                                            <?php break; ?>
                                        <?php endswitch; ?>


                                    <?php if($offer->user_id): ?>
                                            <?php if(isset($search)): ?>

                                                <td class="text-center">
                                                    <a class="badge bg-success p-2" href="<?php echo e(route('client.offers.show.search', ['offer' => $offer->slug, 'search' => $search])); ?>">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete<?php echo e($offer->id); ?>"><i class="bi bi-trash"></i></a>
                                                </td>
                                            <?php else: ?>
                                                <td class="text-center">
                                                    <a class="badge bg-success p-2" href="<?php echo e(route('client.offers.show', $offer->slug)); ?>"><i class="bi bi-eye"></i></a>
                                                    <a class="badge bg-primary p-2" href="<?php echo e(route('client.offers.edit', $offer->id)); ?>"><i class="bi bi-pencil"></i></a>
                                                    <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete<?php echo e($offer->id); ?>"><i class="bi bi-trash"></i></a>
                                                </td>
                                            <?php endif; ?>

                                        <?php else: ?>
                                            <?php if(isset($search)): ?>

                                            <td class="text-center">
                                                <a class="badge bg-success p-2" href="<?php echo e(route('client.offers.show.search', ['offer' => $offer->slug, 'search' => $search])); ?>">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete<?php echo e($offer->id); ?>"><i class="bi bi-trash"></i></a><a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete<?php echo e($offer->id); ?>"><i class="bi bi-trash"></i></a>
                                                                                           </td>
                                            <?php else: ?>
                                                <td class="text-center">
                                                    <a class="badge bg-success p-2" href="<?php echo e(route('client.offers.show', $offer->slug)); ?>"><i class="bi bi-eye"></i></a>
                                                    <a class="badge bg-primary p-2" href="<?php echo e(route('client.offers.edit', $offer->id)); ?>"><i class="bi bi-pencil"></i></a>
                                                    <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete<?php echo e($offer->id); ?>"><i class="bi bi-trash"></i></a>
                                                </td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </tr>

                                    <div class="modal" tabindex="-1" id="delete<?php echo e($offer->id); ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Вы действительно хотите удалить задачу</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                                    <a href="<?php echo e(route('client.offers.delete', $offer->id)); ?>" class="btn btn-danger" >Удалить</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal" tabindex="-1" id="send<?php echo e($offer->id); ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?php echo e(route('client.offers.send.back', $offer->id)); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Отправление задачи на проверку</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" id="reasonSend" style="display: none">
                                                        <p>Вы действительно хотите отклонить задачу</p>
                                                        <textarea required name="reason" class="form-control" id="" cols="30" rows="2"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button  id="reason" type="button" class="btn btn-danger">Отклонить, Отправить заново</button>
                                                        <button  id="reasonButton" type="submit" class="btn btn-danger" style="display: none">Отклонить, Отправить заново</button>
                                                        <a href="<?php echo e(route('client.offers.send.client', $offer->id)); ?>" class="btn btn-success" id="sendButton">Отправить</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal" tabindex="-1" id="sendBack<?php echo e($offer->id); ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?php echo e(route('client.offers.send.back', $offer->id)); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Задача отклонена</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Вы действительно хотите отправить задачу обратно сотруднику <span style="font-size: 20px" class="text-success"><?php echo e($offer->username); ?></span></p>
                                                        <label for="reason1">
                                                            <textarea required name="reason1" class="form-control" id="" cols="60" rows="2"></textarea>
                                                        </label>
                                                    </div>
                                                    <div class="modal-footer" id="parent">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                                        <button type="submit" class="btn btn-success" >Отправить</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <td  colspan="7"><h1 class="text-center">Пока нет задач</h1></td>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/filter3.js')); ?>"></script>

    <script>
        $(document).ready(function(){
            $('#reason').on('click', function() {
                $('#reason').hide();
                $('#reasonButton').show();
                $('#reasonSend').show();
                $('#sendButton').hide();
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                "processing": true,
                "stateSave": true // Включаем сохранение состояния
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
                var filterColumns = ['Проект', 'Статус', 'Исполнитель'];

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
                    // Сбрасываем фильтры и поиск
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



<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tasks\resources\views/admin/offers/index.blade.php ENDPATH**/ ?>