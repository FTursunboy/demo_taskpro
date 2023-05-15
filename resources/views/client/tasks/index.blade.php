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
                @include('inc.messages')
                <section class="section">
                    <div class="card">
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
                                            <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                            </td>
                                        @elseif($task->status->id == 2)
                                            <td><span class="badge bg-primary p-2">{{$task->status->name}}</span>
                                            </td>
                                        @elseif($task->status->id == 3)
                                            <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                            </td>
                                        @elseif($task->status->id == 4)
                                            <td><span class="badge bg-success p-2">{{$task->status->name}}</span>
                                            </td>
                                        @elseif($task->status->id == 5)
                                            <td><span class="badge bg-danger p-2">{{$task->status->name}}</span>
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
                                            <td><span class="badge bg-danger p-2">{{$task->status->name}}</span>
                                            </td>
                                        @elseif($task->status->id == 11)
                                            <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                            </td>
                                        @elseif($task->status->id == 12)
                                            <td><span class="badge bg-danger p-2">{{$task->status->name}}</span>
                                            </td>
                                        @elseif($task->status->id == 13)
                                            <td><span class="badge bg-danger p-2">{{$task->status->name}}</span>
                                            </td>
                                        @elseif($task->status->id == 14)
                                            <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                            </td>
                                        @endif
                                    <td>

                                        <a class="badge bg-success p-2" href="{{route('client.tasks.show', $task->id)}}"><i class="bi bi-eye"></i></a>



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


@endsection


