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
                                    <td>{{$idea->title}}</td>
                                    <td>{{$idea->from}}</td>
                                    <td>{{$idea->to}}</td>
                                    <td>{{\Illuminate\Support\Str::limit($idea->description, 20)}}</td>
                                        @if($idea->status->name == "Принято")
                                            <td><span class="badge badge-success p-2">Принят</span>
                                            </td>
                                        @elseif($idea->status->name == "Ожидается")
                                            <td><span class="badge badge-warning p-2">На рассмотрении</span>
                                            </td>
                                        @elseif($idea->status->name == "Отклонено")
                                            <td><span class="badge badge-danger p-2">Отклонен</span>
                                            </td>
                                        @elseif($idea->status->name == "На доработку")
                                            <td><span class="badge badge-primary p-2">На доработку</span>
                                            </td>
                                        @endif
                                    <td>
                                        <a class="text-success" href="{{route('idea.ideas.show', $idea->id)}}"><i class="bi bi-eye p-2"></i></a>
                                        <a class="text-primary" href="{{route('idea.idea.edit', $idea->id)}}"><i class="bi bi-pencil"></i></a>
                                    </td>
                                    </tr>
                                @empty
                                    <td colspan="6">Пока нет идей</td>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>

@endsection


