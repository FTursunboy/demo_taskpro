@extends('admin.layouts.app')

@section('title')
    Задачи
@endsection
@section('content')
    <div id="main">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Список задач</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Список задач</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('inc.messages')

        <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary mb-4">
            Добавить задачу
        </a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span><i class="bi bi-circle-fill text-warning mx-2"></i>Ожидается</span>
                        <span><i class="bi bi-circle-fill text-success mx-2"></i>Принято</span>
                        <span><i class="bi bi-circle-fill text-danger mx-2"></i>Отклонено</span>
                        <span><i class="bi bi-circle-fill text-primary mx-2"></i>В процессе</span>
                        <span><i class="bi bi-circle-fill text-info mx-2"></i>Просроченный</span>
                        <span><i class="bi bi-circle-fill text-secondary mx-2"></i>На проверку</span>
                        <span><i class="bi bi-circle-fill mx-2" style="color: #00ff80"></i>Готов</span>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">
                                    @foreach($tasks as $task)
                                        <a class="nav-link {{ ($loop->index === 0) ? 'active': ''}}"
                                           id="v-pills-home-tab{{ $task->id }}" data-bs-toggle="pill"
                                           href="#v-pills-home{{ $task->id }}" role="tab"
                                           aria-controls="v-pills-home{{ $task->id }}"
                                           aria-selected="true">
                                            @switch($task->status->name)
                                                @case($task->status->name === "Ожидается")
                                                <i class="bi bi-circle-fill text-warning mx-2"></i>
                                                @break
                                                @case($task->status->name === "Принято")
                                                <i class="bi bi-circle-fill text-success mx-2"></i>
                                                @break
                                                @case($task->status->name === "Отклонено")
                                                <i class="bi bi-circle-fill text-danger mx-2"></i>
                                                @break
                                                @case($task->status->name === "В процессе")
                                                <i class="bi bi-circle-fill text-primary mx-2"></i>
                                                @break
                                                @case($task->status->name === "Готов")
                                                <i class="bi bi-circle-fill mx-2" style="color: #00ff80"></i>
                                                @break
                                                @case($task->status->name === "На проверку")
                                                <i class="bi bi-circle-fill text-secondary mx-2"></i>
                                                @break
                                                @case($task->status->name === "Просроченный")
                                                <i class="bi bi-circle-fill text-info mx-2"></i>
                                                @break
                                            @endswitch
                                            {{ $task->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    @foreach($tasks as $task)
                                        <div class="tab-pane fade {{( $loop->index === 0) ? 'active show' : '' }}"
                                             id="v-pills-home{{ $task->id }}" role="tabpanel"
                                             aria-labelledby="v-pills-home-tab{{ $task->id }}">

                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="name">Имя</label>
                                                        <input type="text" id="name" class="form-control"
                                                               value="{{ $task->name }}" disabled>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="user">Сотрудник</label>
                                                        <input type="text" id="user" class="form-control"
                                                               value="{{ $task->user->name }} {{ $task->user->surname }}"
                                                               disabled>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="from">От</label>
                                                        <input type="text" id="from" class="form-control"
                                                               value="{{ date('d-m-Y', strtotime($task->from)) }}"
                                                               disabled>
                                                    </div>


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
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="time">Время</label>
                                                        <input type="text" id="time" class="form-control"
                                                               value="{{$task->time}}" disabled>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="project">Проект</label>
                                                        <input type="text" id="project" class="form-control"
                                                               value="{{$task->project?->name}}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="to">До</label>
                                                        <input type="text" id="to" class="form-control"
                                                               value="{{ date('d-m-Y', strtotime($task->to)) }}"
                                                               disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="comment">Коментария</label>
                                                        <textarea type="text" id="comment" class="form-control" disabled
                                                                  rows="1">{{ $task->comment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="sts">Статус</label>
                                                        @switch($task->status->name)
                                                            @case($task->status->name === "Ожидается")
                                                            <div class="form-group">
                                                                <input type="text"
                                                                       class="form-control  bg-warning text-black"
                                                                       id="sts" value="{{ $task->status->name }}"
                                                                       disabled>
                                                            </div>
                                                            @break
                                                            @case($task->status->name === "Принято")
                                                            <div class="form-group">
                                                                <input type="text"
                                                                       class="form-control  bg-success text-white"
                                                                       id="sts" value="{{ $task->status->name }}"
                                                                       disabled>
                                                            </div>
                                                            @break
                                                            @case($task->status->name === "Отклонено")
                                                            <div class="form-group">
                                                                <input type="text"
                                                                       class="form-control  bg-danger text-white"
                                                                       id="sts" value="{{ $task->status->name }}"
                                                                       disabled>
                                                            </div>
                                                            @break
                                                            @case($task->status->name === "В процессе")
                                                            <div class="form-group">
                                                                <input type="text"
                                                                       class="form-control  bg-primary text-white"
                                                                       id="sts" value="{{ $task->status->name }}"
                                                                       disabled>
                                                            </div>
                                                            @break
                                                            @case($task->status->name === "Готов")
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="sts"
                                                                       value="{{ $task->status->name }}" disabled
                                                                       style="background-color: #00ff80">
                                                            </div>
                                                            @break
                                                            @case($task->status->name === "На проверку")
                                                            <div class="form-group">
                                                                <input type="text"
                                                                       class="form-control  bg-secondary text-white"
                                                                       id="sts" value="{{ $task->status->name }}"
                                                                       disabled>
                                                            </div>
                                                            @break
                                                            @case($task->status->name === "Просроченный")
                                                            <div class="form-group">
                                                                <input type="text"
                                                                       class="form-control  bg-info text-black" id="sts"
                                                                       value="{{ $task->status->name }}" disabled>
                                                            </div>
                                                            @break
                                                        @endswitch

                                                        <div class="form-group">
                                                            <label for="type">Тип</label>
                                                            <input type="text" id="type" class="form-control"
                                                                   value="{{ $task->type?->name }} {{  (isset($task->typeType->name)) ? '- '.$task->typeType->name : '' }}"
                                                                   disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="author">Автор</label>
                                                            <input type="text" id="author" class="form-control"
                                                                   value="{{ $task->author->name .' '. $task->author->surname}}"
                                                                   disabled>
                                                        </div>

                                                        @if($task->status->name === "Отклонено")
                                                            <div class="form-group">
                                                                <label for="cancel" class="text-danger">Причина</label>
                                                                <textarea type="text" id="cancel"
                                                                          class="form-control border-danger" disabled
                                                                          rows="1">{{ $task->cancel }}</textarea>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @switch($task->status->name)
                                                    @case($task->status->name === "Ожидается")
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-success w-100">
                                                            <i class="bi bi-eye mx-2"></i>
                                                            Просмотреть
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-primary w-100">
                                                            <i class="bi bi-pencil mx-2"></i>
                                                            Изменить
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-danger w-100">
                                                            <i class="bi bi-trash mx-2"></i>
                                                            Удалить
                                                        </a>
                                                    </div>
                                                    @break
                                                    @case($task->status->name === "Принято")
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-success w-100">
                                                            <i class="bi bi-eye mx-2"></i>
                                                            Просмотреть
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-primary w-100 disabled">
                                                            <i class="bi bi-pencil mx-2"></i>
                                                            Изменить
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-danger w-100 disabled">
                                                            <i class="bi bi-trash mx-2"></i>
                                                            Удалить
                                                        </a>
                                                    </div>
                                                    @break
                                                    @case($task->status->name === "Отклонено")
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-info w-100">
                                                            <i class="bi bi-eye mx-2"></i>
                                                            Отправить занова
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-primary w-100">
                                                            <i class="bi bi-pencil mx-2"></i>
                                                            Отправить в другой сотрудник
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-danger w-100">
                                                            <i class="bi bi-trash mx-2"></i>
                                                            Удалить
                                                        </a>
                                                    </div>
                                                    @break
                                                    @case($task->status->name === "В процессе")
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-success w-100">
                                                            <i class="bi bi-eye mx-2"></i>
                                                            Просмотреть
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-primary w-100 disabled">
                                                            <i class="bi bi-pencil mx-2"></i>
                                                            Изменить
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-danger w-100 disabled">
                                                            <i class="bi bi-trash mx-2"></i>
                                                            Удалить
                                                        </a>
                                                    </div>
                                                    @break
                                                    @case($task->status->name === "Готов")
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-success w-100">
                                                            <i class="bi bi-eye mx-2"></i>
                                                            Просмотреть
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-primary w-100 disabled">
                                                            <i class="bi bi-pencil mx-2"></i>
                                                            Изменить
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-danger w-100 disabled">
                                                            <i class="bi bi-trash mx-2"></i>
                                                            Удалить
                                                        </a>
                                                    </div>
                                                    @break
                                                    @case($task->status->name === "На проверку")
                                                    <div class="col-4">
                                                        <form action="{{ route('tasks.ready', $task) }}" class="w-100"
                                                              method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-info w-100">
                                                                Проверте задачу
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-primary w-100 disabled">
                                                            <i class="bi bi-pencil mx-2"></i>
                                                            Изменить
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-danger w-100">
                                                            <i class="bi bi-trash mx-2"></i>
                                                            Удалить
                                                        </a>
                                                    </div>
                                                    @break
                                                    @case($task->status->name === "Просроченный")
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-success w-100">
                                                            <i class="bi bi-eye mx-2"></i>
                                                            Просмотреть
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-primary w-100 disabled">
                                                            <i class="bi bi-pencil mx-2"></i>
                                                            Изменить
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="" class="btn btn-outline-danger w-100 disabled">
                                                            <i class="bi bi-trash mx-2"></i>
                                                            Удалить
                                                        </a>
                                                    </div>
                                                    @break
                                                @endswitch
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
