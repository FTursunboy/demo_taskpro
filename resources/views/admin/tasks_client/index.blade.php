@extends('admin.layouts.app')

@section('title')
    Задачи
@endsection
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
                            <li class="breadcrumb-item"><a href="{{route('tasks_client.index')}}">Задачи</a></li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    @if(session('mess'))
                        <div class="alert alert-success">
                            {{session('mess')}}
                        </div>
                    @endif
                    @include('inc.messages')
                            <a href="{{ route('tasks_client.create') }}" class="btn btn-outline-primary">
                                Добавить задачу
                            </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Клиент</th>
                            <th>Описание</th>
                            <th>Статус</th>
                            <th>Действие</th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse($tasks as $task)
                            <tr>

                                <td>{{$loop->iteration}}</td>
                                <td>{{$task->name}}</td>
                                <td>{{$task->client->name}}</td>
                                <td>{{\Illuminate\Support\Str::limit($task->description, 20)}}</td>
                                @if($task->status->id == 1)
                                    <td><a href="#" data-bs-target="#send{{$task->id}}" data-bs-toggle="modal"><span class="badge bg-warning p-2">Ожидается </span></a>
                                    </td>
                                @elseif($task->status->id == 2)
                                    <td><span class="badge bg-primary p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 3)
                                    <td><span class="badge bg-success p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 4)
                                    <td><span class="badge bg-success p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 5)
                                    <td><a data-bs-target="#sendBack{{$task->id}}" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">{{$task->status->name}}</span></a>
                                    </td>
                                @elseif($task->status->id == 6)
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#send{{$task->id}}"><span class="badge bg-primary p-2">Проверьте и отправьте клиенту</span></a>
                                    </td>
                                @elseif($task->status->id == 7)
                                    <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 8)
                                    <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 9)
                                    <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 10)
                                    <td><span class="badge bg-success p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 11)
                                    <td><span class="badge bg-danger p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 12)
                                    <td><a data-bs-target="#sendBack{{$task->id}}" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">{{$task->status->name}}</span></a>
                                    </td>
                                @elseif($task->status->id == 13)
                                    <td><a data-bs-target="#sendBack{{$task->id}}" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">{{$task->status->name}}</span></a>
                                    </td>
                                @elseif($task->status->id == 14)
                                    <td><a href="#" data-bs-target="#send{{$task->id}}" data-bs-toggle="modal"><span class="badge bg-success p-2">Задача сделана, отправьте клиенту на проверку</span></a>
                                    </td>
                                @endif
                                @if($task->user_id)
                                    <td>
                                        <a class="badge bg-success p-2" href="{{route('tasks_client.show', $task->id)}}"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('tasks_client.edit', $task->id) }}" class="badge bg-primary"><i class="bi bi-pencil"></i></a>
                                        <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$task->id}}"><i class="bi bi-trash"></i></a>
                                    </td>
                                @else
                                    <td>
                                        <a class="badge bg-success p-2" href="{{route('tasks_client.show', $task->id)}}"><i class="bi bi-eye"></i></a>
                                    </td>
                                @endif
                            </tr>

                            <div class="modal" tabindex="-1" id="delete{{$task->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Вы действительно хотите удалить задачу?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                            <a href="{{route('tasks_client.delete', $task->id)}}" class="btn btn-danger" >Удалить</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal" tabindex="-1" id="send{{$task->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Вы действительно хотите изменить задачу?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                            <a href="{{route('tasks_client.edit', $task->id)}}" class="btn btn-success">Изменить</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal" tabindex="-1" id="sendBack{{$task->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Задача отклонена</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Причина: {{$task->cancel}}</p>
                                            <p>Вы  хотите отправить задачу на перепроверку или удалить? <span style="font-size: 20px" class="text-success">{{$task->user?->name}}</span></p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{route('tasks_client.delete', $task->id)}}" class="btn btn-danger">Удалить</a>
                                            <form action="tasks_client/{{$task->id}}/sendBack" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <input type="submit" class="btn btn-success" value="Отправить">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <td  colspan="6"><h1 class="text-center">Пока нет задач</h1></td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
