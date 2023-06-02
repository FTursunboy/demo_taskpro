@extends('admin.layouts.app')

@section('title')
    События
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <link rel="stylesheet" href="{{asset('assets/css/select/select2.min.css')}}" >
    <link rel="stylesheet" href="{{asset('assets/css/select/style.css')}}" >

@endsection

@section('content')

    <div id="page-heading">
        <div class="card-body">
            <div class="row">
                <div class="container">
                    <h2 class="h2 text-center mb-5 border-bottom pb-3"></h2>
                    <div id="calendar">
                        <div class="day">
                            <div class="icons">
                                <span class="create-event-icon"></span>
                                <span class="go-to-day-icon"></span>
                            </div>
                            <span class="day-number">1</span>
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
                        <select tabindex="3" id="themeEvent_id" name="themeEvent_id" class="form-select mt-3">
                            <option value="" tabindex="3" selected>Выберите тему событие</option>
                            @foreach($themeEvents as $themeEvent)
                                <option value="{{ $themeEvent->id }}">{{ $themeEvent->theme }}</option>
                            @endforeach
                        </select>
                        <span id="titleError" class="text-danger"></span>
                    </div>
                    <div class="form-group mt-1">
                        <label for="contact_id" class="mb-3">Контакт</label>
                        <select tabindex="3" id="contact_id" name="contact_id" class="form-select">
                            @foreach($contacts as $contact)
                                <option
                                    value="{{ $contact->id }}">{{ $contact->name . " " . $contact->surname . " - " . $contact->phone}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Тип</label>
                        <select id="type_event_id" name="type_event_id" tabindex="4" class="form-select mt-3" required>
                            <option value="" selected>Выберите тип</option>
                            @foreach($typeEvents as $typeEvent)
                                <option value="{{ $typeEvent->id }}">{{ $typeEvent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea id="description" name="description" class="form-control mt-3"
                                  tabindex="3">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Время</label>
                        <input id="time" type="time" name="time" class="form-control" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" id="save" class="btn btn-primary" data-bs-dismiss="modal">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

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
            var booking = @json($dates);

            var calendar = $('#calendar').fullCalendar({

                events: booking,
                selectable: true,
                locale: 'ru',
                eventLimit: 3,
                timeFormat: 'HH:mm',
                selectHelper: true,


                dayClick: function(start, end, allDay, jsEvent, view) {
                    var clickedDate = start.format('YYYY-MM-DD');
                    var lastClickTime = $(this).data('lastClickTime');
                    var doubleClickTimeout = $(this).data('doubleClickTimeout');

                    if (lastClickTime && new Date().getTime() - lastClickTime < 300) {
                        clearTimeout(doubleClickTimeout);

                        $.ajax({
                            url: "{{route('calendar.show')}}",
                            type: "post",
                            data: {
                                date: clickedDate
                            },
                            success: function(response) {

                                window.location.href = "{{ route('calendar.show.all',':date')}}".replace(':date', clickedDate)
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

                                let themeEvent_id = $('#themeEvent_id').val();
                                let contact_id = $('#contact_id').val();
                                let type_event_id = $('#type_event_id').val();
                                let description = $('#description').val();
                                let time = $('#time').val();

                                $.ajax({
                                    url: "{{route('calendar.store')}}",
                                    type: "POST",
                                    dataType: "json",
                                    data: {start_date, end_date, themeEvent_id, contact_id, type_event_id, description, time},
                                    success: function(response) {
                                        location.reload();
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
            $('.create-event-icon').click(function() {
                var day = $(this).closest('.day');
                var date = day.find('.day-number').text(); // Получение даты выбранного дня
                // Логика создания события для выбранной даты
                console.log('Создание события для дня ' + date);
            });

            $('.go-to-day-icon').click(function() {
                var day = $(this).closest('.day');
                var date = day.find('.day-number').text(); // Получение даты выбранного дня
                // Логика перехода на выбранный день
                console.log('Переход на день ' + date);
            });

        });




    </script>

@endsection
