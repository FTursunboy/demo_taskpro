@extends('user.layouts.app')
@section('title')
    Идеи
@endsection
@section('content')


            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Идеи</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('idea.ideas')}}">Идеи</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    @if(session('mess'))
                        <div class="alert alert-success">
                            {{session('mess')}}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('idea.idea.create')}}"  class="btn btn-primary">Добавить</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Название</th>
                                    <th>От</th>
                                    <th>До</th>
                                    <th>Описание</th>
                                    <th>Статус</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($ideas as $idea)
                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ \Str::limit($idea->title, 60)}}</td>
                                    <td>{{$idea->from}}</td>
                                    <td>{{$idea->to}}</td>
                                    <td>{{\Illuminate\Support\Str::limit($idea->description, 20)}}</td>
                                        @if($idea->status->id == 1)
                                            <td><span class="badge bg-warning p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @elseif($idea->status->id == 2)
                                            <td><span class="badge bg-primary p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @elseif($idea->status->id == 3)
                                            <td><span class="badge bg-warning p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @elseif($idea->status->id == 4)
                                            <td><span class="badge bg-warning p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @elseif($idea->status->id == 5)
                                            <td><span class="badge bg-warning p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @elseif($idea->status->id == 6)
                                            <td><span class="badge bg-success p-2">На проверке (У админа)</span>
                                            </td>
                                        @elseif($idea->status->id == 7)
                                            <td><span class="badge bg-warning p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @elseif($idea->status->id == 8)
                                            <td><span class="badge bg-warning p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @elseif($idea->status->id == 9)
                                            <td><span class="badge bg-warning p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @elseif($idea->status->id == 10)
                                            <td><span class="badge bg-danger p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @elseif($idea->status->id == 11)
                                            <td><span class="badge bg-warning p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @elseif($idea->status->id == 12)
                                            <td><span class="badge bg-danger p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @elseif($idea->status->id == 13)
                                            <td><span class="badge bg-danger p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @elseif($idea->status->id == 14)
                                            <td>
                                                <span class="badge bg-warning p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @elseif($idea->status->id == 15)
                                            <td>
                                                <span class="badge bg-primary p-2">{{$idea->status->name}}</span>
                                            </td>
                                        @endif
                                    <td>
                                        <a class="text-success" href="{{route('idea.ideas.show', $idea->id)}}"><i class="bi bi-eye p-2"></i></a>
                                        <a class="text-primary" href="{{route('idea.idea.edit', $idea->id)}}"><i class="bi bi-pencil"></i></a>
                                    </td>
                                    </tr>
                                @empty
                                    <td colspan="7" class="text-center">Пока нет идей</td>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>

@endsection


