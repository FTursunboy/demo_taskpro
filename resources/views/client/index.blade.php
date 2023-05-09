@extends('client.layouts.app')
@section('content')
    <div id="app">

        <div id="main">

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
                            <a href="{{route('offers.create')}}"  class="btn btn-primary">Добавить</a>
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
                                        @if($task->status->name == "Принято")
                                            <td><span class="badge bg-success p-2">Принят</span>
                                            </td>
                                        @elseif($task->status->name == "Ожидается")
                                            <td><span class="badge bg-warning p-2">На рассмотрении</span>
                                            </td>
                                        @elseif($task->status->name == "Отклонено")
                                            <td><span class="badge bg-danger p-2">Отклонен</span>
                                            </td>
                                        @elseif($task->status->name == "На доработку")
                                            <td><span class="badge bg-primary p-2">На доработку</span>
                                            </td>
                                        @elseif($task->status->name == "На проверку")
                                            <td><span class="badge bg-primary p-2">На проверку</span>
                                            </td>
                                        @endif
                                        <td>
                                            <a class="badge bg-success p-2" href="{{route('offers.show', $task->id)}}"><i class="bi bi-eye p-2"></i></a>
                                            <a class=" badge bg-primary p-2" href="{{route('offers.edit', $task->id)}}"><i class="bi bi-pencil"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <td  colspan="5"><h1 class="text-center">Пока нет задач</h1></td>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">

                </div>
            </footer>
        </div>
    </div>


@endsection


