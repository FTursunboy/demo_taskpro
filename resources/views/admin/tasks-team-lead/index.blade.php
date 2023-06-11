@extends('admin.layouts.app')

@section('title')
    Задача с тимлидом
@endsection

@section('content')
    <div id="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Задача с тилидом</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Панел</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Задача с тилидом</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        @include('inc.messages')

        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr  class="text-center">
                        <th>#</th>
                        <th>Задача</th>
                        <th>Проект</th>
                        <th>Исполнитель</th>
                        <th>Тимлид</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Str::limit($task->task_name, 20) }}</td>
                            <td>{{ $task->project }}</td>
                            <td>{{ $task->author_task_surname . ' ' . $task->author_task_name }}</td>
                            <td>{{ $task->author_surname . ' ' . $task->author_name }}</td>
                            <td>
                                <a href="{{ route('tasks-team-leads.show', $task->task_slug) }}" class="btn btn-success "><i class="bi bi-eye"></i></a>
                                <a href="{{ route('tasks-team-leads.acceptTaskCommand', $task->task_slug) }}" class="btn btn-primary"><i class="bi bi-check"></i></a>
                                <a href="{{ route('tasks-team-leads.declineTaskCommand', $task->task_slug) }}" class="btn btn-danger"><i class="bi bi-x"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
