@extends('user.layouts.app')
@section('title')
    Моя команда
@endsection

@section('content')

    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Моя команда</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Панель</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Вписок задач</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @include('inc.messages')

        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="coil-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('my-command.index') }}" class="btn btn-danger">Назад</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Задача</th>
                                        <th>Проект</th>
                                        <th>Исполнитель</th>
                                        <th>Статус</th>
                                        <th>Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($TasksInQuery as $task)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Str::limit($task->name, 20) }}</td>
                                            <td>{{ $task->project->name }}</td>
                                            <td>{{ $task->user->surname . ' ' . $task->user->name }}</td>
                                            <td>На рассматрения у админа</td>
                                            <td>
                                                <a role="button" class="btn btn-success" data-bs-toggle="modal"
                                                   data-bs-target="#taskTeamLead{{ $task->id }}"><i
                                                        class="bi bi-eye"></i></a>
                                                <a role="button" class="btn btn-danger" data-bs-toggle="modal"
                                                   data-bs-target="#taskTeamLeadDelete{{ $task->id }}"><i
                                                        class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="taskTeamLeadDelete{{ $task->id }}"
                                             data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                             aria-labelledby="taskTeamLeadDelete{{ $task->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="taskTeamLeadDelete{{ $task->id }}">Информатция</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                        <div class="modal-body">
                                                            Точно хотите удалить задачу?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                Отмена
                                                            </button>
                                                            <a  href="{{ route('my-command.taskInQueryDelete', $task->slug) }}" class="btn btn-danger">
                                                                Да удалить
                                                            </a>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="modal fade" id="taskTeamLead{{ $task->id }}"
                                             data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                             aria-labelledby="taskTeamLead{{ $task->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="taskTeamLead{{ $task->id }}">
                                                            Информатция</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
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
                                                                              class="form-control mt-3">{{ $task->comment }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Отмена
                                                        </button>
                                                        {{--                                                            <button type="submit" class="btn btn-primary">Understood</button>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
