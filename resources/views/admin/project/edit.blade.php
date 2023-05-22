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


        @include('inc.messages')

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('project.index') }}" class="btn btn-outline-danger">
                        Назад
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('project.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-4">

                                <div class="form-group">
                                    <label for="name">Имя проекта</label>
                                    <input type="text" id="name" name="name" class="form-control mt-3"
                                           placeholder="Имя проекта" tabindex="1" value="{{ $project->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="start">Дата начала проекта</label>
                                    <input type="date" id="start" name="start" tabindex="4" class="form-control mt-3"
                                           value="{{ $project->start }}" required>
                                </div>

                            </div>
                            <div class="col-4">

                                <div class="form-group">
                                    <label for="time">Время</label>
                                    <input type="number" id="time" name="time" tabindex="2" class="form-control mt-3"
                                           value="{{ $project->time }}" placeholder="Время">
                                </div>

                                <div class="form-group">
                                    <label for="finish">Дата окончания проекта</label>
                                    <input type="date" id="finish" name="finish" tabindex="5" class="form-control mt-3"
                                           value="{{ $project->finish }}" required>
                                </div>

                            </div>
                            <div class="col-4">

                                <div class="form-group">
                                    <label for="type">Тип</label>
                                    <select id="type" name="type_id" tabindex="3" class="form-select mt-3">
                                        <option value="" selected>Выберите тип</option>
                                        @foreach($types as $type)
                                            <option
                                                value="{{ $type->id }}" {{($project->type_id === $type->id)? 'selected' : ''}}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="type">Тип</label>
                                    <select id="type" name="types_id" tabindex="6" class="form-select mt-3">
                                        <option value="" selected>Выберите тип</option>
                                        @foreach($types_project as $type)
                                            <option value="{{ $type->id }}" {{($project->types_id === $type->id)? 'selected' : ''}}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="comment">Комментария</label>
                                    <textarea name="comment" tabindex="7" id="comment"
                                              class="form-control mt-3">{{ $project->comment }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                @if($project->file !== null)
                                    <div class="col-md-6">
                                        <a href="{{ route('project.download', $project->id) }}" style="margin-left: 0px" download class="form-control text-bold">Просмотреть
                                            файл</a>
                                    </div>
                                @endif
                                <div class="col-6"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Выберите файл</label>
                                <input type="file" class="form-control" tabindex="8" name="file">
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" tabindex="9" id="button" class="btn btn-outline-primary">Обновить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

@endsection

@section('script')
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
@endsection
