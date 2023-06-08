@extends('admin.layouts.app')

@section('title')
    Задачи
@endsection
@section('content')
    <div id="page-heading">
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
                    <div class="card-header"></div>
                    <div class="card-body">
                        <div class="row">
                            <table id="example" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th >Имя</th>
                                    <th class="text-center">От</th>
                                    <th class="text-center">До</th>
                                    <th class="text-center">Проект</th>
                                    <th class="text-center">Тип</th>
                                    <th class="" >Статус</th>
                                    <th class="text-center">Сотрудник</th>
                                    <th class="text-center">Действия</th>
                                </tr>
                                </thead>
                                <tbody id="tableBodyMonitoring">
                                @foreach($tasks as $task)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td >{{ $task->name }}</td>
                                        <td class="text-center">{{ date('d-m-Y', strtotime($task->from))  }}</td>
                                        <td class="text-center">{{ date('d-m-Y', strtotime($task->to))  }}</td>
                                        <td class="text-center">{{ $task->project->name  }}</td>
                                        <td class="text-center">
                                            @if($task->type === null)
                                                От клиента
                                            @elseif($task->type !== null)
                                                {{ $task->type?->name }} {{  (isset($task->typeType?->name)) ? ' - '.$task->typeType?->name : '' }}
                                            @endif
                                        </td>
                                        @switch($task->status->id)
                                            @case(1)
                                            <td><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                                            @break
                                            @case(2)
                                            <td><span class="badge bg-primary p-2">{{$task->status->name}}</span></td>
                                            @break
                                            @case(3)
                                            <td><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                                            @break
                                            @case(4)
                                            <td><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                            @break
                                            @case(5)
                                            <td><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                            @break
                                            @case(6)
                                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#send{{$task->id}}"><span class="badge bg-primary p-2">В ожидании проверки администратора</span></a></td>
                                            @break
                                            @case(7)
                                            <td><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                            @break
                                            @case(8)
                                            <td><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                            @break
                                            @case(9)
                                            <td><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                            @break
                                            @case(10)
                                            <td><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                                            @break
                                            @case(11)
                                            <td><span class="badge bg-danger p-2">{{$task->status->name}}</span></td>
                                            @break
                                            @case(12)
                                            <td><a data-bs-target="#sendBack{{$task->id}}" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">Отклонено (Сотрудник)</span></a></td>
                                            @break
                                            @case(13)
                                            <td><a data-bs-target="#sendBack{{$task->id}}" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">Отклонено (Клиент)</span></a></td>
                                            @break
                                            @case(14)
                                            <td><a href="#" data-bs-target="#send{{$task->id}}" data-bs-toggle="modal"><span class="badge bg-success p-2">Задача сделана, отправьте клиенту на проверку</span></a></td>
                                            @break
                                        @endswitch
                                        <td class="text-center">{{ $task->user?->surname . ' ' . $task->user?->name}}</td>
                                        <td class="text-center">
                                            <a href="{{ route('mon.show', $task->id) }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('mon.edit', $task->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
