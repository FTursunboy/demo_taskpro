<?php $__env->startSection('title'); ?>
    События
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/select/select2.min.css')); ?>" >
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/select/style.css')); ?>" >
<?php $__env->stopSection(); ?>
     
<?php $__env->startSection('content'); ?>

    <div id="page-heading">
        <div class="card-body">
            <div class="row">
                <div class="container">
                    <h2 class="h2 text-center mb-5 border-bottom pb-3"></h2>
                    <style>
                        .statuses {
                            display: flex;
                            align-items: center;
                        }

                        .status {
                            display: flex;
                            align-items: center;
                            margin-right: 20px;
                        }

                        .status .circle {
                            width: 10px;
                            height: 10px;
                            border-radius: 50%;
                            margin-right: 5px;
                        }

                        .scheduled .circle {
                            background-color: #580CF2;
                        }

                        .overdue .circle {
                            background-color: red;
                        }

                        .in-progress .circle {
                            background-color: green;
                        }
                    </style>

                    <div class="statuses">
                        <div class="status in-progress">
                            <span class="circle"></span>
                            В работе
                        </div>
                        <div class="status scheduled">
                            <span class="circle"></span>
                            Запланированный
                        </div>

                        <div class="status overdue">
                            <span class="circle"></span>
                            Просроченный
                        </div>

                    </div>



                    <div id="calendar">

                        <div class="day">
                            <div class="icons">
                                <span class="create-event-icon"></span>
                                <span class="go-to-day-icon"></span>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Выбранная дата</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="themeEvent_id">Тема событие</label>
                        <select required tabindex="3" id="themeEvent_id" name="themeEvent_id" class="form-select mt-3">
                            <option value="" tabindex="3" selected>Выберите тему событие</option>
                            <?php $__currentLoopData = $themeEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $themeEvent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($themeEvent->id); ?>"><?php echo e($themeEvent->theme); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span id="titleError" class="text-danger"></span>
                    </div>
                    <div class="form-group mt-1">
                        <label for="lead_id" class="mb-3">Лид</label>
                        <select required tabindex="3" id="lead_id" name="lead_id" class="form-select">
                            <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($lead->id); ?>"><?php echo e($lead->contact->fio); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group mt-1">
                        <label for="status_id" class="mb-3">Статус</label>
                        <select required tabindex="3" id="status_id" name="status_id" class="form-select">
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Тип</label>
                        <select required id="type_event_id" name="type_event_id" tabindex="4" class="form-select mt-3" required>
                            <option value="" selected>Выберите тип</option>
                            <?php $__currentLoopData = $typeEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeEvent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($typeEvent->id); ?>"><?php echo e($typeEvent->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea required id="description" name="description" class="form-control mt-3"
                                  tabindex="3"><?php echo e(old('description')); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Время</label>
                        <input required id="time" type="time" name="time" class="form-control" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" id="save" class="btn btn-primary" data-bs-dismiss="modal">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>

    <script>

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var booking = <?php echo json_encode($dates, 15, 512) ?>;

            var calendar = $('#calendar').fullCalendar({

                events: booking,
                selectable: true,
                locale: 'ru',
                eventLimit: 3,
                timeFormat: 'HH:mm',
                selectHelper: true,
                editable: true,

                eventContent: function(info) {

                    var status = info.event.extendedProps.status;
                    var backgroundColor = '';
                    console.log(status)

                    if (status === 1) {
                        backgroundColor = 'green';
                    } else if (status === 3) {
                        backgroundColor = 'yellow';
                    } else if (status === 4) {
                        backgroundColor = 'red';
                    }

                    return {
                        html: '<div class="fc-content" style="background-color: ' + backgroundColor + ';">' +
                            '<span class="fc-title">' + info.event.title + '</span>' +
                            '</div>'
                    };
                },

                eventDrop: function (event) {
                    var id = event.id;
                    var start_date = moment(start).format('YYYY-MM-DD');
                    var end_date = moment(end).format('YYYY-MM-DD');
                    $.ajax({
                        url: "<?php echo e(route('calendar.store')); ?>",
                        type: "DELETE",
                        dataType: "json",
                        data: {start_date, end_date},
                        success: function(response) {
                            location.reload()
                        },
                        error: function(xhr) {
                            if (xhr.responseJSON.errors) {
                                $('#titleError').html(xhr.responseJSON.errors.title);
                            }
                        }
                    });
                },
                dayClick: function(start, end, allDay, jsEvent, view) {
                    var clickedDate = start.format('YYYY-MM-DD');
                    var lastClickTime = $(this).data('lastClickTime');
                    var doubleClickTimeout = $(this).data('doubleClickTimeout');

                    if (lastClickTime && new Date().getTime() - lastClickTime < 300) {
                        clearTimeout(doubleClickTimeout);

                        $.ajax({
                            url: "<?php echo e(route('calendar.show')); ?>",
                            type: "post",
                            data: {
                                date: clickedDate
                            },
                            success: function(response) {

                                window.location.href = "<?php echo e(route('calendar.show.all',':date')); ?>".replace(':date', clickedDate)
                            },
                            error: function(xhr) {

                            }
                        });
                    } else {

                        $(this).data('lastClickTime', new Date().getTime());
                        var timeout = setTimeout(function() {
                            $('#myModal').modal('show');
                            $('#save').click(function() {
                                let start_date = moment(start).format('YYYY-MM-DD');
                                let end_date = moment(end).format('YYYY-MM-DD');
                               let  status_id = $('#status_id').val();
                                let themeEvent_id = $('#themeEvent_id').val();
                                let lead_id = $('#lead_id').val();
                                let type_event_id = $('#type_event_id').val();
                                let description = $('#description').val();
                                let time = $('#time').val();

                                $.ajax({
                                    url: "<?php echo e(route('calendar.store')); ?>",
                                    type: "POST",
                                    dataType: "json",
                                    data: {start_date, status_id, themeEvent_id, lead_id, type_event_id, description, time},
                                    success: function(response) {
                                        location.reload()
                                    },
                                    error: function(xhr) {
                                        if (xhr.responseJSON.errors) {
                                            $('#titleError').html(xhr.responseJSON.errors.title);
                                        }
                                    }
                                });
                            });
                        }, 300);

                        $(this).data('doubleClickTimeout', timeout);
                    }

                }

            });

            $('#myModal').on("hidden.bs.modal", function() {
                $('#save').unbind();
            });

        });




    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(auth()->user()->hasRole('crm') ? 'user.layouts.app' : 'admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tasks\resources\views/admin/CRM/calendar/index.blade.php ENDPATH**/ ?>