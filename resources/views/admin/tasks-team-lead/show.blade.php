@extends('user.layouts.app')
@section('title')
    {{ \Str::limit($task->name,15) }}
@endsection

@section('content')

    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ \Str::limit($task->name,15) }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Панель</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tasks-team-leads.all-tasks') }}">Вписок задач</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ \Str::limit($task->name,15) }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @include('inc.messages')

        <section class="section">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('tasks-team-leads.all-tasks') }}" class=" btn btn-danger">Назад</a>
                        <a href="{{ route('tasks-team-leads.acceptTaskCommand', $task->slug) }}" class="btn btn-primary">Принять</a>
                        <a href="{{ route('tasks-team-leads.declineTaskCommand', $task->slug) }}" class="btn btn-danger">Откланить</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" class="form-control mt-3"
                                           value="{{ $task->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="user_id">Кому это задача</label>
                                    <input type="text" class="form-control mt-3"
                                           value="{{ $task->user->surname . ' ' . $task->user->name }}"
                                           disabled>
                                </div>
                                <div class="form-group">
                                    <label for="from">Дата начала задачи</label>
                                    <input type="text" class="form-control mt-3"
                                           value="{{ $task->from }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="time">Время</label>
                                    <input type="text" class="form-control mt-3"
                                           value="{{ $task->time }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="project_id">Проект</label>
                                    <input type="text" class="form-control mt-3"
                                           value="{{ $task->project->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="to">Дата окончания задачи <span
                                            id="project_finish"
                                            style="color: red"></span> </label>
                                    <input type="text" class="form-control mt-3"
                                           value="{{ $task->to }}" disabled>

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="type_id">Тип</label>
                                    <input type="text" class="form-control mt-3"
                                           value="{{ $task->type->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Комментария</label>
                                    <textarea tabindex="10" name="comment" id="comment"
                                              rows="4"
                                              class="form-control mt-3" disabled>{{ $task->comment }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
