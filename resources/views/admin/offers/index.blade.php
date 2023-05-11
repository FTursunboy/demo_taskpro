@extends('admin.layouts.app')
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
                            @if(session('mess'))
                                <div class="alert alert-success">
                                    {{session('mess')}}
                                </div>
                            @endif
                            @include('inc.messages')
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Название</th>
                                    <th>Описание</th>
                                    <th>Исполнитель</th>
                                    <th>Статус</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>

                                <tbody>

                                @forelse($offers as $offer)
                                    <tr>

                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$offer->name}}</td>
                                        <td>{{\Illuminate\Support\Str::limit($offer->description, 20)}}</td>
                                        @if($offer->user_id)
                                            <td>{{$offer->user->name}}</td>
                                        @else
                                            <td class="text-danger text-bold">Задача еще не распределена</td>
                                        @endif
                                        @if($offer->status->id == 1)
                                            <td><span class="badge bg-success p-2">{{$offer->status->name}}</span>
                                            </td>
                                        @elseif($offer->status->id == 2)
                                            <td><span class="badge bg-warning p-2">{{$offer->status->name}}</span>
                                            </td>
                                        @elseif($offer->status->id == 3)
                                            <td><span class="badge bg-success p-2">{{$offer->status->name}}</span>
                                            </td>
                                        @elseif($offer->status->id == 4)
                                            <td><span class="badge bg-warning p-2">{{$offer->status->name}}</span>
                                            </td>
                                        @elseif($offer->status->id == 5)
                                            <td><span class="badge bg-warning p-2">{{$offer->status->name}}</span>
                                            </td>
                                        @elseif($offer->status->id == 6)
                                            <td><span class="badge bg-warning p-2">{{$offer->status->name}}</span>
                                            </td>
                                        @elseif($offer->status->id == 7)
                                            <td><span class="badge bg-warning p-2">{{$offer->status->name}}</span>
                                            </td>
                                        @elseif($offer->status->id == 8)
                                            <td><span class="badge bg-warning p-2">{{$offer->status->name}}</span>
                                            </td>
                                        @elseif($offer->status->id == 9)
                                            <td><span class="badge bg-warning p-2">{{$offer->status->name}}</span>
                                            </td>
                                        @elseif($offer->status->id == 10)
                                            <td><span class="badge bg-success p-2">{{$offer->status->name}}</span>
                                            </td>
                                        @elseif($offer->status->id == 11)
                                            <td><span class="badge bg-danger p-2">{{$offer->status->name}}</span>
                                            </td>
                                        @elseif($offer->status->id == 12)
                                            <td><span class="badge bg-danger p-2">{{$offer->status->name}}</span>
                                            </td>
                                        @elseif($offer->status->id == 13)
                                            <td><span class="badge bg-danger p-2">{{$offer->status->name}}</span>
                                            </td>
                                        @elseif($offer->status->id == 14)
                                            <td><a href="#" data-bs-target="#send{{$offer->id}}" data-bs-toggle="modal"><span class="badge bg-success p-2">Задача сделана, отправьте клиенту на проверку</span></a>
                                            </td>
                                        @endif
                                        @if($offer->user_id)
                                        <td>
                                            <a class="badge bg-success p-2" href="{{route('client.offers.show', $offer->id)}}"><i class="bi bi-eye"></i></a>
                                            <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$offer->id}}"><i class="bi bi-trash"></i></a>
                                        </td>
                                        @else
                                            <td>
                                                <a class="badge bg-success p-2" href="{{route('client.offers.show', $offer->id)}}"><i class="bi bi-eye"></i></a>
                                                <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$offer->id}}"><i class="bi bi-trash"></i></a>
                                            </td>
                                        @endif
                                    </tr>

                                    <div class="modal" tabindex="-1" id="delete{{$offer->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Вы действительно хотите удалить задачу</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                                    <a href="{{route('client.offers.delete', $offer->id)}}" class="btn btn-danger" >Удалить</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal" tabindex="-1" id="send{{$offer->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Отправление задачи на проверку</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Вы действительно хотите отправить задачу клиенту</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                                    <a href="{{route('client.offers.send.client', $offer->id)}}" class="btn btn-success" >Отправить</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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


