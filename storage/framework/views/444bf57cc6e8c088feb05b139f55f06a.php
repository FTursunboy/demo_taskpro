<?php $__env->startSection('title'); ?>
    Лиды
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Лиды</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Лиды</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <?php echo $__env->make('.inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <a href="<?php echo e(route('lead.create')); ?>" class="btn btn-outline-primary">
                                Добавить лид
                            </a>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-select" name="month" id="mnth">
                                    <option value="пвыпвп">фильтр по месяцу</option>
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
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-select" name="status" id="status">
                                    <option value="0">фильтр по стадию</option>
                                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-select" name="status" id="source">
                                    <option value="0">фильтр по источнику</option>
                                    <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($source->id); ?>"><?php echo e($source->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-select" name="state" id="state">
                                    <option value="0">фильтр по состоянию</option>
                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card-body" style="overflow: auto;">
                    <table id="example" style="width: 100%" class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Дата создания</th>
                            <th data-td="td_one">ФИО<span class="btn btn-right">></span></th>
                            <th data-td="td_two">Стадие<span class="btn btn-right">></span></th>
                            <th data-td="td_three">Источник<span class="btn btn-right">></span></th>
                            <th data-td="td_four">Состояние<span class="btn btn-right">></span></th>
                            <th>Создал</th>

                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="tbody" >

                        <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($dateFormatted = date('d-m-Y', strtotime($lead->created_at))); ?></td>
                                <td>
                                    <?php if($lead->contact?->fio): ?>
                                             <?php echo e(Str::limit($lead->contact?->fio, 50)); ?>

                                    <?php else: ?>
                                        <span style='color: lightcoral;'>Удалённый аккаунт</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($lead->status?->id === 5): ?>
                                        <span style='color: lightcoral;'><?php echo e($lead->status?->name); ?></span>
                                    <?php else: ?>
                                        <?php echo e($lead->status?->name); ?>

                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(Str::limit($lead->leadSource?->name, 20)); ?></td>
                                <td><?php echo e(Str::limit($lead->state?->name, 20)); ?></td>
                                <td><?php echo e(Str::limit($lead->author, 20)); ?></td>

                                <td class="text-center">
                                    <a href="<?php echo e(route('lead.show', $lead->id)); ?>" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                    <a href="<?php echo e(route('lead.edit', $lead->id)); ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                       data-bs-target="#delete<?php echo e($lead->id); ?>"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>


                            <div class="modal fade text-left" id="delete<?php echo e($lead->id); ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="delete<?php echo e($lead->id); ?>" data-bs-backdrop="false" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <form action="<?php echo e(route('lead.destroy', $lead->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="delete<?php echo e($lead->id); ?>">Предупреждение</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    Точно хотите удалить лид?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Отмена</span>
                                                </button>
                                                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Удалить</span>
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
            window.onload = function() {
            var selectElement = document.getElementById("status");
            var optionElements = selectElement.getElementsByTagName("option");

            for (var i = 0; i < optionElements.length; i++) {
            var option = optionElements[i];
            if (option.value === "0" && option.selected) {
            option.style.color = "red";
        }
        }

            selectElement.addEventListener("change", function() {
            for (var i = 0; i < optionElements.length; i++) {
            var option = optionElements[i];
            if (option.value === "0") {
            option.style.color = option.selected ? "red" : "";
        }
        }
        });
        };
    </script>
    <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
    <script>

        $(document).ready(function () {

            var table = $('#example').DataTable({
                initComplete: function () {

                },
            });

            $(document).ready(function() {
                $('#mnth, #status, #state, #source').on('change', function() {
                    console.log($('#mnth').val());
                    filterLeads();
                });
            });

            function filterLeads() {
                let month = $('#mnth').val();
                let status = $('#status').val();
                let state = $('#state').val();
                let source = $('#source').val();

                $.get(`tasks/public/filter-leads/${month}/${status}/${state}/${source}`, function(responce) {
                    let table = $('#tbody').empty();
                    console.log(responce);
                    buildTable(responce.data, table);
                });


            }


            function formatDate(inputDate) {
                const dateObject = new Date(inputDate);
                const day = dateObject.getDate().toString().padStart(2, '0');
                const month = (dateObject.getMonth() + 1).toString().padStart(2, '0'); // Месяцы в JavaScript начинаются с 0
                const year = dateObject.getFullYear();
                return `${day}-${month}-${year}`;
            }

            function buildTable(data, table) {
                $.each(data, function(i, item) {
                    let show = route('lead.show', item.id);
                    let edit = route('lead.edit', item.id);

                    let formattedDate = formatDate(item.date); // Форматируем дату

                    let row = `<tr>
            <td>${i + 1}</td>
            <td>${formattedDate}</td> <!-- Используем переформатированную дату -->
            <td>${item.contact_name}</td>
            <td>${item.status}</td>
            <td>${item.source}</td>
            <td>${item.lead_state}</td>
            <td>${item.author}</td>
            <td class="text-center">
                <a href="${show}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                <a href="${edit}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                <a class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#delete${item.id}"><i class="bi bi-trash"></i></a>
            </td>
        </tr>`;
                    table.append(row);
                });
            }




        });

    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make(auth()->user()->hasRole('crm') ? 'user.layouts.app' : 'admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tasks\resources\views/admin/CRM/leads/index.blade.php ENDPATH**/ ?>