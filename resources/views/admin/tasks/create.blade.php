@extends('admin.layouts.app')

@section('title')
    Создания новая задача
@endsection

@section('content')
    <div id="main">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Добавление задачу</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Список задач</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Добавление задачу</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('inc.messages')

        <div class="card">
            <div class="card-header">
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
                                <input type="text" id="name" name="name" class="form-control mt-3"
                                       placeholder="Имя" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="user_id">Кому это задача</label>
                                <select id="user_id" name="user_id" class="form-select mt-3">
                                    <option value="" selected>Выбирите сотрудник</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="from">Дата начала задача</label>
                                <input type="date" id="from" name="from" class="form-control mt-3"
                                       value="{{ old('from') }}" required>
                            </div>

                        </div>


                        <div class="col-4">

                            <div class="form-group">
                                <label for="time">Время</label>
                                <input type="number" id="time" name="time" class="form-control mt-3"
                                       value="{{ old('time') }}" placeholder="Время"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="project_id">Проект</label>
                                <select id="project_id" name="project_id" class="form-select mt-3">
                                    <option value="" selected>Выбирите проект</option>
                                    @foreach($projects as $project)
                                        <option
                                            value="{{ $project->id }}" {{ ($project->id === old('project_id')) ? 'selected' : '' }}>{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="to">Дата окончания задача</label>
                                <input type="date" id="to" name="to" class="form-control mt-3" value="{{ old('to') }}"
                                       required>
                            </div>

                        </div>


                        <div class="col-4">

                            <div class="form-group">
                                <label for="type_id">Тип</label>
                                <select id="type_id" name="type_id" class="form-select mt-3">
                                    <option value="" selected>Выбирите тип</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group d-none" id="type_id_group">
                                <label for="kpi_id">Вид KPI</label>
                                <select name="kpi_id" id="kpi_id" class="form-select mt-3"></select>
                            </div>

                            <div class="form-group">
                                <label for="comment">Комментария</label>
                                <textarea name="comment" id="comment"
                                          class="form-control mt-3">{{ old('comment') }}</textarea>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="file">Файл</label>
                                <input type="file" name="file" class="form-control mt-3" id="file">
                            </div>
                        </div>
                        <div class="col-6"></div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-outline-primary">Сохранить</button>
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
                $(this).addClass('border-danger')
                to.addClass('border-danger')
            } else {
                $(this).removeClass('border-danger')
                to.removeClass('border-danger')
            }
        })
        $('#to').change(function () {
            const from = $('#from')
            if ($(this).val() > from.val()) {
                $(this).addClass('border-danger')
                from.addClass('border-danger')
            } else {
                $(this).removeClass('border-danger')
                from.removeClass('border-danger')
            }
        })

        $('#type_id').change(function () {
            let kpi = $(this).children('option:selected')
            if (kpi.text().toLowerCase() === 'kpi') {
                let kpiType = $('#kpi_id').empty();
                $.get(`tasks/kpi/${kpi.val()}/`).then((res) => {
                    for (let i = 0; i < res.length; i++) {
                        const item = res[i]
                        console.log(item.name)
                        kpiType.append($('<option>').val(item.id).text(item.name))
                    }
                })
                $('#type_id_group').removeClass('d-none')
            } else {
                $('#type_id_group').addClass('d-none')
            }
        })
    </script>
@endsection