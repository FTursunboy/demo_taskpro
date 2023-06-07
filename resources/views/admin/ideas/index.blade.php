@extends('admin.layouts.app')

@section('title')
    Идеи
@endsection
@section('content')
    <div id="page-heading">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Идеи сотрудников</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.ideas')}}">Идеи</a></li>

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
                                    @if($idea->status == 1)
                                        <td><span class="badge bg-success p-2">{{$offer->status_name}}</span>
                                        </td>
                                    @elseif($idea->status == 2)
                                        <td><span class="badge bg-primary p-2">{{$offer->status_name}}</span>
                                        </td>
                                    @elseif($idea->status == 3)
                                        <td><span class="badge bg-success p-2">{{$offer->status_name}}</span>
                                        </td>
                                    @elseif($idea->status == 4)
                                        <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span>
                                        </td>
                                    @elseif($idea->status == 5)
                                        <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span>
                                        </td>
                                    @elseif($idea->status == 6)

                                        <td><a href="#" data-bs-toggle="modal" data-bs-target="#send{{$offer->id}}"><span class="badge bg-primary p-2">В ожидании проверки администратора</span></a>

                                        </td>
                                    @elseif($idea->status == 7)
                                        <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span>
                                        </td>
                                    @elseif($idea->status == 8)
                                        <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span>
                                        </td>
                                    @elseif($idea->status == 9)
                                        <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span>
                                        </td>
                                    @elseif($idea->status == 10)
                                        <td><span class="badge bg-success p-2">{{$offer->status_name}}</span>
                                        </td>
                                    @elseif($idea->status == 11)
                                        <td><span class="badge bg-danger p-2">{{$offer->status_name}}</span>
                                        </td>
                                    @elseif($idea->status == 12)
                                        <td><a data-bs-target="#sendBack{{$offer->id}}" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">Отклонено (Сотрудник)</span></a>
                                        </td>
                                    @elseif($idea->status == 13)
                                        <td><a data-bs-target="#sendBack{{$offer->id}}" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">Отклонено (Клиент)</span></a>
                                        </td>
                                    @elseif($idea->status == 14)
                                        <td><a href="#" data-bs-target="#send{{$offer->id}}" data-bs-toggle="modal"><span class="badge bg-success p-2">Задача сделана, отправьте клиенту на проверку</span></a>
                                        </td>
                                    @endif
                                    @if($idea->user_id)
                                        <td>
                                            <a class="badge bg-success p-2" href="{{route('client.offers.show', $offer->id)}}"><i class="bi bi-eye"></i></a>
                                            <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$offer->id}}"><i class="bi bi-trash"></i></a>
                                            <a class="badge bg-primary p-2" href="{{route('client.offers.chat', $offer->id)}}"><i class="bi bi-chat"></i></a>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <a class="badge bg-success p-2" href="{{route('client.offers.show', $offer->id)}}"><i class="bi bi-eye"></i></a>
                                            <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$offer->id}}"><i class="bi bi-trash"></i></a>
                                            <a class="badge bg-primary p-2" href="{{route('client.offers.chat', $offer->id)}}"><i class="bi bi-chat"></i></a>

                                        </td>
                                    @endif
                                    <td>
                                        <a class="text-primary" href="{{route('admin.idea.show', $idea->id)}}"><i
                                                class="bi bi-pencil"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="7" class="text-center ">Пока нет идей</td>
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

    <div class="modal" id="store" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить тип</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('settings.project.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <div>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection


