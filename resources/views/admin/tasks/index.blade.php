@extends('admin.layouts.app')

@section('title')
    Проекты
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
            @foreach($tasks as $task)
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header">
                                <h4 class="card-title">{{ $task->name }}</h4>
                            </div>
                            <div class="card-body">
                                <span>Время: {{ $task->time }}</span> <br>
                                <span>От: {{\Carbon\Carbon::createFromFormat('Y-m-d', $task->from)->format('d-m-Y') }}</span><br>
                                <span>До: {{\Carbon\Carbon::createFromFormat('Y-m-d', $task->to)->format('d-m-Y') }}</span><br>
                                <span>Тип: {{ $task->type->name }}</span><br>
                                <span>Проект: {{ $task->project->name }}</span><br>
                                <span>Сотрудник: {{ $task->user->name }}</span><br>
                                <span class="badge bg-warning">Статус: {{ $task->status->name }}</span><br>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mb-3">
                            <a href="" class="badge bg-success"><i class="bi bi-eye"></i></a>
                            <a href="" class="badge bg-primary mx-3"><i class="bi bi-pencil"></i></a>
                            <a href="" class="badge bg-danger" data-bs-toggle="modal"
                               data-bs-target="#delete{{$task->id}}"><i class="bi bi-trash"></i></a>
                        </div>
                    </div>
                </div>

                <div class="modal fade text-center" id="delete{{$task->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="delete{{$task->id}}" data-bs-backdrop="false" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <form action="{{ route('project.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="delete{{$task->id}}">Предупреждение</h4>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Точно хотите удалит проект?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary"
                                            data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Нет, я пошутил</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Да, точно</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            @endforeach
        </div>

@endsection
