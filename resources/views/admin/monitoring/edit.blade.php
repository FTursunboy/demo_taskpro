@extends('admin.layouts.app')

@section('title')
    Обновление задач
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Обновление задачи</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('mon.index') }}">Мониторинг</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Обновление задачи</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('inc.messages')

        <div class="card">
            <div class="card-header">
                <a href="{{ route('mon.index') }}" class="btn btn-outline-danger">
                    Назад
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('mon.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-4">

                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" id="name" name="name" tabindex="1" class="form-control mt-3"
                                       placeholder="Имя" value="{{ $task->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="user_id">Кому это задача</label>
                                <select id="user_id" name="user_id" tabindex="4" class="form-select mt-3" required>
                                    <option value="" selected>Выбирите сотрудник</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ ($user->id === old('user_id') or $user->id === $task->user_id ) ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="from">Дата начала задача</label>
                                <input type="date" id="from" name="from" tabindex="7" class="form-control mt-3"
                                       value="{{ $task->from }}" required>
                            </div>

                        </div>


                        <div class="col-4">

                            <div class="form-group">
                                <label for="time">Время</label>
                                <input type="number" id="time" name="time" tabindex="2" class="form-control mt-3"
                                       value="{{ $task->time }}" placeholder="Время"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="project_id">Проект</label>
                                <select id="project_id" name="project_id" tabindex="5" class="form-select mt-3" required>
                                    <option value="" selected disabled>Выбирите проект</option>
                                    @foreach($projects as $project)
                                        <option
                                            value="{{ $project->id }}" {{ ($project->id === old('project_id') or $project->id === $task->project_id ) ? 'selected' : '' }} class="{{ date('Y-m-d', strtotime($project->finish)) }}" {{ ($project->id === old('project_id')) ? 'selected' : '' }}>{{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="to">Дата окончания задача <span  id="project_finish" style="display: none; color: red">({{ date('d-m-Y', strtotime($project->finish)) }})</span></label>
                                <input type="date" id="to" name="to" class="form-control mt-3" tabindex="8" value="{{ $task->to }}"
                                       required>
                            </div>

                        </div>


                        <div class="col-4">

                            <div class="form-group">
                                <label for="type_id">Тип</label>
                                <select id="type_id" name="type_id" tabindex="3" class="form-select mt-3" required>
                                    <option value="" selected>Выбирите тип</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ ($type->id === old('type_id') or $type->id === $task->type_id ) ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if(isset($task->kpi_id))
                                <div class="form-group  {{ $task->kpi_id ? '' : 'd-none'  }} " id="type_id_group">
                                    <label for="kpi_id">Вид KPI</label>
                                    <select name="kpi_id" id="kpi_id" tabindex="6" class="form-select mt-3">
                                        @foreach($type_kpi as $types_kpi)
                                            <option value="{{ $types_kpi->id }}" {{ ($types_kpi->id === $task->typeType->id) ? 'selected' : '' }}>
                                                {{ $types_kpi->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group {{ $task->kpi_id ? '' : 'd-none'  }}" style="margin-top: 27px" id="percent">
                                    <label for="percent">Введите процент</label>
                                    <input  type="number" step="any" max="150" class="form-control" id="percent" tabindex="9" name="percent" value="{{ $task->percent }}" oninput="checkMaxValue(this)">
                                </div>
                            @elseif($task->kpi_id === null)
                                <div class="form-group" id="type_id_group" style="margin-top: 51px">

                                </div>
                                <div class="form-group" style="margin-top: 50px" id="percent">

                                </div>
                            @endif


                        </div>
                        <div class="form-group">
                            <label for="comment">Комментария</label>
                            <textarea name="comment" id="comment"
                                      tabindex="10" class="form-control mt-3">{{ $task->comment }}</textarea>
                        </div>

                    </div>

                    <div class="row">
                        @if($task->file !== null)
                            <div class="col-md-6">
                                <a href="{{ route('tasks.download', $task->id) }}" style="margin-left: 0px" download class="form-control text-bold">Просмотреть
                                    файл</a>
                            </div>
                        @endif
                        <div class="col-6"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Выберите файл</label>
                        <input type="file"
                               class="form-control"
                               name="file">
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <input type="submit" id="button" class="btn btn-outline-primary" tabindex="12" value="Обновить">
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



            $.get(`/kpi/${kpi.val()}/`).then((res) => {
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

        $('#project_finish').show();
    });

    $('#file').on('change', function () {
        const file = this.files[0]; // выбранный файл
        const fileSizeInBytes = file.size; // размер файла в байтах
        const fileSizeInMegabytes = fileSizeInBytes / (1024 * 1024); // размер файла в мегабайтах
        if (fileSizeInMegabytes > 50) { // проверка на максимальный размер файла в мегабайтах
            alert('Выбранный файл слишком большой. Максимальный размер файла - 50 МБ');
            $(this).val('');
        }
    });


</script>

@endsection
