@extends('admin.layouts.app')

@section('title')
    {{ $task->name }}
@endsection

@section('content')
    <div id="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $task->name }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tasks_client.index') }}">Список задач</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $task->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <a href="{{ route('tasks_client.index') }}" class="btn btn-outline-danger">
                    Назад
                </a>
                <a role="button" class="btn btn-primary mx-2">
                    Дата создания проекта: {{ $task->created_at->format('d-m-Y') }}
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">

                        <div class="form-group">
                            <label for="name">Имя проекта</label>
                            <input type="text" id="name" name="name" class="form-control mt-3"
                                   placeholder="Имя проекта" value="{{ $task->name }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="start">Дата начала проекта</label>
                            <input type="date" id="start" name="start" class="form-control mt-3" value="{{ $task->from }}" disabled>
                        </div>

                    </div>
                    <div class="col-4">

                        <div class="form-group">
                            <label for="finish">Дата окончания проекта</label>
                            <input type="date" id="finish" name="finish" class="form-control mt-3" value="{{ $task->finish }}"  disabled>
                        </div>

                        <div class="form-group">
                            <label for="type">Статус</label>
                            <input type="text" class="form-control mt-3 bg-warning" id="type" value="{{ $task->status->name }}" disabled>
                        </div>

                    </div>
                    <div class="col-4">

                        @if($task->file !== null)
                            <div class="form-group">
                                <label for="file">Файл</label>
                                <a href="#" download class="form-control text-bold">Просмотреть
                                    файл</a>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="to">Файл</label>
                                <input type="text" class="form-control" id="to"
                                       value="Нет файл" disabled>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="comment">Комментария</label>
                        <textarea name="description" id="comment" class="form-control mt-3" disabled>{{ $task->description }}</textarea>
                    </div>
                </div>
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
