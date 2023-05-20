@extends('admin.layouts.app')

@section('title')
{{ $project->name }}
@endsection

@section('content')
    <div id="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $project->name }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панел</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Список проектов</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <a href="{{ route('project.index') }}" class="btn btn-outline-danger">
                    Назад
                </a>
                <a href="{{ route('project.edit', $project->id) }}" class="btn btn-outline-primary mx-2">
                    Изменить
                </a>
                <a role="button" class="btn btn-primary mx-2">
                    Дата создания проекта: {{ $project->created_at->format('d-m-Y') }}
                </a>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-4">

                            <div class="form-group">
                                <label for="name">Имя проекта</label>
                                <input type="text" id="name" name="name" class="form-control mt-3"
                                       placeholder="Имя проекта" value="{{ $project->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="start">Дата начала проекта</label>
                                <input type="date" id="start" name="start" class="form-control mt-3" value="{{ $project->start }}" disabled>
                            </div>

                        </div>
                        <div class="col-4">

                            <div class="form-group">
                                <label for="time">Время</label>
                                <input type="number" id="time" name="time" class="form-control mt-3" value="{{ $project->time }}" placeholder="Время"
                                       disabled>
                            </div>


                            <div class="form-group">
                                <label for="finish">Дата окончания проекта</label>
                                <input type="date" id="finish" name="finish" class="form-control mt-3" value="{{ $project->finish }}"  disabled>
                            </div>

                        </div>
                        <div class="col-4">

                            <div class="form-group">
                                <label for="type">Тип</label>
                                <input type="text" class="form-control mt-3" id="type" value="{{ $project->type->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="type">Тип</label>
                                <input type="text" class="form-control mt-3" id="type" value="{{ $project->types->name }}" disabled>
                            </div>
                        </div>
                    </div>
                <div class="row">
                            <div class="form-group">
                                <label for="comment">Комментария</label>
                                <textarea name="comment" id="comment" class="form-control mt-3" disabled>{{ $project->comment }}</textarea>
                            </div>
                </div>
                @if($project->file !== null)
                    <div class="form-group col-4">
                        <label for="file">Файл</label>
                        <a href="{{ route('project.download', $project->id) }}" download class="form-control text-bold">Просмотреть
                            файл</a>
                    </div>
                @else
                    <div class="form-group col-4">
                        <label for="to">Файл</label>
                        <input type="text" class="form-control" id="to"
                               value="Нет файл" disabled>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $('#start').change(function ()  {
            const finish = $('#finish')
            if ($(this).val() > finish.val()) {
                $(this).addClass('border-danger')
                finish.addClass('border-danger')
            } else {
                $(this).removeClass('border-danger')
                finish.removeClass('border-danger')
            }
        })
        $('#finish').change(function ()  {
            const start = $('#start')
            if ($(this).val() > start.val()) {
                $(this).addClass('border-danger')
                start.addClass('border-danger')
            } else {
                $(this).removeClass('border-danger')
                start.removeClass('border-danger')
            }
        })

    </script>
@endsection
