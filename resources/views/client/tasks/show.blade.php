@extends('client.layouts.app')
@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Задачи</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('offers.index')}}">Задачи</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row ">
                <div class="row pt-4">
                    <div class="col-md-12">
                        @if($errors->any())
                            <div class="alert alert-danger w-100 text-center">Заполните
                                все поля
                            </div>
                        @endif
                            <div class="card">
                                <div class="card-header">
                                    <a href="{{ route('tasks_client.index') }}" class="btn btn-outline-danger">
                                        Назад
                                    </a>
                                    <a role="button" class="btn btn-primary mx-2">
                                        Дата создания задачи: {{ date('d.m.Y', strtotime($task->created_at)) }}
                                    </a>
                                    @if($task->status_id == 1)
                                    <a role="button" href="{{route('client.tasks.accept', $task->id)}}" class="btn btn-success mx-2">
                                       Принять
                                    </a>
                                    <a role="button" href="#" data-bs-target="#send" data-bs-toggle="modal" class="btn btn-danger mx-2">
                                        Отклонить
                                    </a>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">

                                            <div class="form-group">
                                                <label for="name">Имя задачи</label>
                                                <input type="text" id="name" name="name" class="form-control mt-3"
                                                       placeholder="Имя проекта" value="{{ $task->name }}" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="start">Дата начала задачи</label>
                                                <input type="date" id="start" name="start" class="form-control mt-3" value="{{ $task->from }}" disabled>
                                            </div>

                                        </div>
                                        <div class="col-4">

                                            <div class="form-group">
                                                <label for="finish">Дата начала задачи</label>
                                                <input type="date" id="finish" name="finish" class="form-control mt-3" value="{{ $task->to }}"  disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="type">Статус</label>
                                                <input type="text" class="form-control mt-3 bg-light" id="type" value="{{ $task->status->name }}" disabled>
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

                            </div>
                        </div>
                    </div>


    <div class="modal" id="send" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('client.tasks.decline', $task->id)}}" method="post">
                    @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Отклонения задачи</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea name="cancel" id="" cols="30" rows="4"  class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection


