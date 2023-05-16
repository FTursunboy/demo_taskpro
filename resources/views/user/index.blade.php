@extends('user.layouts.app')

@section('title')
    Панель
@endsection

@section('content')

    <div id="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Панел</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Панель /</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a href="{{ route('new-task.index') }}">
                                <div class="row">
                                    <div
                                        class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42"
                                                 fill="currentColor" class="bi bi-card-checklist text-white"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                <path
                                                    d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Новые задачи</h6>
                                        <h6 class="font-extrabold mb-0">{{ $task['new'] }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div
                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42"
                                             fill="currentColor" class="bi bi-calendar-check text-white fs-2"
                                             viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                            <path
                                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                            <path
                                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Про срочние</h6>
                                    <h6 class="font-extrabold mb-0">{{ $task['speed'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div
                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42"
                                             fill="currentColor" class="bi bi-check2-all text-white"
                                             viewBox="0 0 16 16">
                                            <path
                                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                            <path
                                                d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Готовые</h6>
                                    <h6 class="font-extrabold mb-0">{{$task['success']}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div
                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42"
                                             fill="currentColor" class="bi bi-x-lg text-white"
                                             viewBox="0 0 16 16">
                                            <path
                                                d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Отклоненные</h6>
                                    <h6 class="font-extrabold mb-0">{{ $task['unSuccess'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-9">
                    @include('inc.messages')
                    <h4>Список всех задач</h4>
                    <div class="my-4">
                        <span><i class="bi bi-circle-fill text-primary mx-2"></i>Принято</span>
                        <span><i class="bi bi-circle-fill text-info mx-2"></i>Просроченный</span>
                    </div>
                    @foreach($tasks as $task)
                        <p>
                            <button
                                class="btn btn-{{ ($task->status->name === "Принято") ? 'primary': 'info' }} w-100 collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseExample{{ $task->id }}" aria-expanded="false"
                                aria-controls="collapseExample"><span
                                    class="d-flex justify-content-start"><i
                                        class="bi bi-info-circle mx-2"></i> <span>{{ $task->name }}</span> </span>
                            </button>
                        </p>
                        <div class="collapse my-3" id="collapseExample{{ $task->id }}">
                            <div class="row p-3">
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
                                               value="{{ date('d-m-Y', strtotime($task->from)) }}" disabled>
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
                                               value="{{ date('d-m-Y', strtotime($task->to)) }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Комментария</label>
                                        <textarea type="text" id="comment" class="form-control" disabled
                                                  rows="1">{{ $task->comment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="sts">Статус</label>
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control  bg-{{($task->status->name === "Принято")?'success':'info'}} text-black"
                                                   id="sts" value="{{ $task->status->name }}" disabled>
                                        </div>


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
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-6">
                                    <a href="{{ route('task-list.show', $task->id) }}"
                                       class="btn btn-outline-info w-100">Подробнее</a>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-outline-success w-100" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop{{ $task->id }}">Я сделал задачу
                                    </button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop{{ $task->id }}" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1"
                                     aria-labelledby="staticBackdropLabel{{ $task->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('task-list.ready', $task->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5"
                                                        id="staticBackdropLabel{{ $task->id }}">{{ $task->name }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Еще раз проверьте, что вы сделали задачу правильно
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Нет, я шучу
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Да, конечна сделал
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-center mb-3">
                                <img src="{{ asset('assets/images/avatar-2.png') }}" alt="" width="100"
                                     height="100">
                            </div>

                            @switch($user->xp)
                                @case($user->xp > 0 && $user->xp <= 99 )
                                <div>
                                    <div class="d-flex justify-content-end">
                                        {{ $user->xp }} / 100
                                    </div>
                                </div>
                                <div class="progress mt-3">
                                    <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                         style="width: {{ $user->xp }}%" aria-valuenow="{{ $user->xp }}"
                                         aria-valuemin="0"
                                         aria-valuemax="300"></div>
                                </div>
                                @break
                                @case($user->xp > 99 && $user->xp < 299 )
                                <div>
                                    <div class="d-flex justify-content-end">
                                        {{ $user->xp }} / 300 (xp)
                                    </div>
                                </div>
                                <div class="progress mt-3">
                                    <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                         style="width: {{$user->xp/3}}%" aria-valuenow="{{ $user->xp }}"
                                         aria-valuemin="0"
                                         aria-valuemax="300"></div>
                                </div>
                                @break
                                @case($user->xp > 299 && $user->xp < 700 )
                                <div>
                                    <div class="d-flex justify-content-end">
                                        {{ $user->xp }}xp / 700 (xp)
                                    </div>
                                </div>
                                <div class="progress mt-3">
                                    <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                         style="width: {{$user->xp / 7}}%" aria-valuenow="{{ $user->xp }}"
                                         aria-valuemin="0"
                                         aria-valuemax="700"></div>
                                </div>
                                @break
                                @case($user->xp > 699 && $user->xp < 1000 )
                                <div>
                                    <div class="d-flex justify-content-end">
                                        {{ $user->xp }} / 1000 (xp)
                                    </div>
                                </div>
                                <div class="progress mt-3">
                                    <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                         style="width: {{$user->xp / 10}}%" aria-valuenow="{{ $user->xp }}"
                                         aria-valuemin="0"
                                         aria-valuemax="1000"></div>
                                </div>
                                @break
                            @endswitch

                        </div>
                        <div class="card-body">
                            <h5 class="text-center">{{ $user->surname . ' ' . $user->name .' '. $user->lastname}}</h5>
                            <div>
                                <table class="mt-3" cellpadding="5">
                                    <tr>
                                        <th>Задачи:</th>
                                        <th><span class="mx-2">{{ $user->taskCount($user->id) }}</span></th>
                                    </tr>
                                    <tr>
                                        <th>Готовые :</th>
                                        <th><span class="mx-2">{{ $user->taskSuccessCount($user->id) }}</span></th>
                                    </tr>
                                    <tr>
                                        <th>Идеи :</th>
                                        <th><span class="mx-2"> {{ $user->ideaCount($user->id) }}</span></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection


