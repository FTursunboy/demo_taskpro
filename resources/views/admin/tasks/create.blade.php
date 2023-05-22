@extends('admin.layouts.app')

@section('title')
    Создание новой задачи
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Добавление задачи</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Список задач</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Добавление задачи</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('inc.messages')

        <div class="card">
            <div class="card-header" id="header">
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-danger">
                    Назад
                </a>


            </div>
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">

                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input tabindex="1" type="text" id="name" name="name" class="form-control mt-3"
                                       placeholder="Имя" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="user_id">Кому это задача</label>

                                <select tabindex="4" id="user_id" name="user_id" class="form-select mt-3">

                                    <option value="" selected>Выберите сотрудник</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="from">Дата начала задачи</label>
                                <input disabled tabindex="7" type="date" id="from" name="from" class="form-control mt-3"
                                       value="{{ old('from') }}" required>
                            </div>

                        </div>


                        <div class="col-4">

                            <div class="form-group">
                                <label for="time">Время</label>
                                <input tabindex="2" type="number" id="time" name="time" class="form-control mt-3"
                                       value="{{ old('time') }}" placeholder="Время"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="project_id">Проект</label>

                                <select  tabindex="5" id="project_id" name="project_id" class="form-select mt-3">
                                    <option value="" selected>Выберите проект</option>
                                    @foreach($projects as $project)
                                        <option
                                            value="{{ $project->id }}" class="{{ date('Y-m-d', strtotime($project->finish)) }}" {{ ($project->id === old('project_id')) ? 'selected' : '' }}>{{ $project->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group">

                                <label for="to">Дата окончания задачи  <span  id="project_finish" style="color: red"></span> </label>
                                <input disabled tabindex="8" type="date" id="to" name="to" class="form-control mt-3" value="{{ old('to') }}"
                                       required>

                                  </div>

                        </div>


                        <div class="col-4">

                            <div class="form-group">
                                <label for="type_id">Тип</label>

                                <select tabindex="3" id="type_id" name="type_id" class="form-select mt-3">
                                    <option value="" tabindex="3" selected>Выберите тип</option>

                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group" id="type_id_group">
                                <label id="label" class="d-none" for="kpi_id">Вид KPI</label>
                                </div>
                            <div class="form-group"  id="percent">
                                <label id="label1" class="d-none" for="percent">Введите процент</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment">Комментария</label>
                            <textarea tabindex="10" name="comment" id="comment"
                                      class="form-control mt-3">{{ old('comment') }}</textarea>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="file">Файл</label>
                                <input tabindex="11" type="file"  name="file" class="form-control mt-3" id="file">
                            </div>
                        </div>
                        <div class="col-6"></div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button tabindex="12" type="button" id="button" class="btn btn-outline-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>


        $('#from').change(function () {
            const to = $('#to')
            if ($(this).val() > to.val()) {

                let selectedOption = $('#project_id option:selected');
                let selectedClass = selectedOption.attr('class');

                let selectedDate = new Date(selectedClass);
                let toDate = new Date($(this).val());

                if (toDate > selectedDate) {
                    $('#error-message').show();
                    $(this).addClass('border-danger')

                    let formattedDate = selectedDate.toISOString().split('T')[0];

                    $(this).val(formattedDate)
                }

                to.addClass('border-danger')
                $('#button').attr('type', 'button');




            } else {
                $(this).removeClass('border-danger')
                to.removeClass('border-danger')
                $('#button').attr('type', 'submit');
            }
        })


        $('#to').change(function () {
            const from = $('#from')
            if ($(this).val() < from.val()) {
                $(this).addClass('border-danger')
                from.addClass('border-danger')
                $('#button').attr('type', 'button');

            } else {
                $(this).removeClass('border-danger')
                from.removeClass('border-danger')
                $('#button').attr('type', 'submit');
            }
        })

        $('#type_id').change(function () {
            let kpi = $(this).children('option:selected')
            if (kpi.text().toLowerCase() === 'kpi') {
                let kpiType = $('#kpi_id').empty();

                $('#label').removeClass('d-none');
                let kpi_id = $('<select tabindex="6"  required name="kpi_id" class="form-select mt-3"><option value="">Выберите месяц</option></select>');
                $('#type_id_group').append(kpi_id);

                $('#label1').removeClass('d-none');
                let percent = $('<input tabindex="9"  required type="number" oninput="checkMaxValue(this)" id="percent" step="any" name="percent" class="form-control mt-3">');
                $('#percent').append(percent);



                $.get(`tasks/kpi/${kpi.val()}/`).then((res) => {
                    for (let i = 0; i < res.length; i++) {
                        const item = res[i];
                        console.log(item.name);
                        kpi_id.append($('<option>').val(item.id).text(item.name));
                    }
                });




            } else {
                $('#type_id_group').empty();

                $('#percent').empty();

            }
        })
        function checkMaxValue(input) {
            var maxValue = 150;
            if (input.value > maxValue) {
                input.value = maxValue;

            }
        }

        $('#project_id').change(function() {
            let selectedOption = $('#project_id option:selected');
            let selectedClass = selectedOption.attr('class');


        });
        function formatDate(date) {
            let year = date.getFullYear();
            let month = String(date.getMonth() + 1).padStart(2, '0');
            let day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
        function formatDate1(dateStr) {
            const [day, month, year] = dateStr.split('-');
            const date = new Date(`${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`);


            return `${date.getDate()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getFullYear()}`;
        }

        $('#to').on('input', function() {
            let project_finish = formatDate1($('#project_finish').text());

            let selectedOption = $('#project_id option:selected');
            let selectedClass = selectedOption.attr('class');

            let selectedDate = new Date(selectedClass);
            let toDate = new Date($(this).val());

            if (toDate > selectedDate) {
                $('#error-message').show();
                $(this).addClass('border-danger')


                let formattedDate = selectedDate.toISOString().split('T')[0];

                $(this).val(formattedDate)


            } else {
                $(this).removeClass('border-danger')
                $('#error-message').hide();
                $('#button').attr('type', 'submit');


            }
            let formattedDate = formatDate(toDate);
            console.log(formattedDate);
        });

        $('#project_id').change(function() {

            $('#from').removeAttr('disabled');
            $('#to').removeAttr('disabled');

            let selectedOption = $('#project_id option:selected');
            let selectedClass = selectedOption.attr('class');
            console.log(selectedClass)
            $('#project_finish').text(selectedClass);

        });

        $('#file').on('change', function () {
            const file = this.files[0]; // выбранный файл
            const fileSizeInBytes = file.size; // размер файла в байтах
            const fileSizeInMegabytes = fileSizeInBytes / (1024 * 100024); // размер файла в мегабайтах
            if (fileSizeInMegabytes > 50) { // проверка на максимальный размер файла в мегабайтах
                alert('Выбранный файл слишком большой. Максимальный размер файла - 50 МБ');
                $(this).val('');
            }
        });


    </script>

@endsection
