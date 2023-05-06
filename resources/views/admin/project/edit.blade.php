@extends('admin.layouts.app')

@section('title')
{{ $project->name }}
@endsection

@section('content')
    <div id="main">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $project->name }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панел</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Срисок проектов</a></li>
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
            </div>
            <div class="card-body">
                <form action="{{ route('project.update', $project->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-4">

                            <div class="form-group">
                                <label for="name">Имя проекта</label>
                                <input type="text" id="name" name="name" class="form-control mt-3"
                                       placeholder="Имя проекта" value="{{ $project->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="start">Дата начала проекта</label>
                                <input type="date" id="start" name="start" class="form-control mt-3" value="{{ $project->start }}" required>
                            </div>

                        </div>
                        <div class="col-4">

                            <div class="form-group">
                                <label for="time">Время</label>
                                <input type="number" id="time" name="time" class="form-control mt-3" value="{{ $project->time }}" placeholder="Время"
                                       required>
                            </div>


                            <div class="form-group">
                                <label for="finish">Дата окончания проекта</label>
                                <input type="date" id="finish" name="finish" class="form-control mt-3" value="{{ $project->finish }}" required>
                            </div>

                        </div>
                        <div class="col-4">

                            <div class="form-group">
                                <label for="type">Тип</label>
                                <select id="type" name="type_id" class="form-select mt-3">
                                    <option value="" selected>Выбирите тип</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{($project->type_id === $type->id)? 'selected' : ''}}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="comment">Комментария</label>
                                <textarea name="comment" id="comment" class="form-control mt-3">{{ $project->comment }}</textarea>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                        </div>
                    </div>
                </form>
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
