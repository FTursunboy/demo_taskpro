@extends('user.layouts.app')
@section('title')
    Новые задачи
@endsection

@section('content')

    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Новые задачи</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}"> Панель</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Новые задачи</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('inc.messages')
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"></div>
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
                                                <i class="bi bi-circle-fill text-warning mx-2"></i>
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
                                                            <label for="comment">Комментария</label>
                                                            <textarea type="text" id="comment" class="form-control"
                                                                      disabled rows="1">{{ $task->comment }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="sts">Статус</label>
                                                            <div class="form-group">
                                                                <input type="text"
                                                                       class="form-control  bg-warning text-black"
                                                                       id="sts" value="{{ $task->status->name }}"
                                                                       disabled>
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
                                                <div class="row mt-4">
                                                    <div class="col-6">
                                                        <form action="{{ route('new-task.accept',$task->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-success w-100">
                                                                <i class="bi bi-check-lg mx-2"></i>
                                                                Принят
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="col-6">

                                                        <button type="button" class="btn btn-outline-danger w-100"
                                                                data-bs-toggle="modal" data-bs-target="#cancel">
                                                            <i class="bi bi-x-circle mx-2"></i>
                                                            Отклонить
                                                        </button>

                                                        <div class="modal fade" id="cancel" data-bs-backdrop="static"
                                                             data-bs-keyboard="false" tabindex="-1"
                                                             aria-labelledby="cancel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form action="{{ route('new-task.decline',$task->id) }}"
                                                                          method="POST">
                                                                        @csrf
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="cancel">
                                                                                Предупреждение</h1>
                                                                            <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="cancel">Причина</label>
                                                                                <textarea name="cancel" id="cancel"
                                                                                          class="form-control"
                                                                                          required></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close
                                                                            </button>
                                                                            <button type="submit" class="btn btn-primary">
                                                                                Understood
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
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
        </section>

    </div>

@endsection


