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
            <div class="card">
                <div class="card-header">

                    @include('inc.messages')
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
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
                                <td>{{\Illuminate\Support\Str::limit($task->description, 20)}}</td>
                                @if($task->status->id == 1)
                                    <td><span class="badge bg-success p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 2)
                                    <td><span class="badge bg-primary p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 3)
                                    <td><span class="badge bg-success p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 4)
                                    <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 5)
                                    <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 6)
                                    <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
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
                                    <td><a href="#" data-bs-target="#send{{$task->id}}" data-bs-toggle="modal"><span
                                                class="badge bg-success p-2">Задача сделана, нажмите чтобы завершить</span></a>
                                    </td>
                                @elseif($task->status->id == 11)
                                    <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 12)
                                    <td><span class="badge bg-primary p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 13)
                                    <td><span class="badge bg-success p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 14)
                                    <td><span class="badge bg-success p-2">{{$task->status->name}}</span>
                                    </td>
                                @endif
                                <td>
                                    <a class="badge bg-success p-2" href="{{route('offers.show', $task->id)}}"><i
                                            class="bi bi-eye p-2"></i></a>
                                    <a class=" badge bg-primary p-2" href="{{route('offers.edit', $task->id)}}"><i
                                            class="bi bi-pencil"></i></a>
                                </td>
                            </tr>


                                    <div class="modal" tabindex="-1" id="send{{$task->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Убедитесь что задача выполнена</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Вы действительно хотите закрыть задачу, если нет оптравить заново</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('offers.decline', $task->id)}}" class="btn btn-danger" >Отправить заново</a>
                                                    <a href="{{route('offers.ready', $task->id)}}" class="btn btn-success" >Отправить</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                                @empty
                                    <td  colspan="5"><h1 class="text-center">Пока завершенных задач</h1></td>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>


                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection


