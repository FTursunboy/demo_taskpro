@extends('admin.layouts.app')
@section('title')Список задач@endsection

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
                            @if(session('mess'))
                                <div class="alert alert-success">
                                    {{session('mess')}}
                                </div>
                            @endif
                            @include('inc.messages')
                        </div>
                        <div class="card-body">

                            <table class="table table-striped" id="example">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Название</th>
                                    <th>Oписание</th>
                                    <th>Исполнитель</th>
                                    <th>Проект</th>
                                    <th>Статус</th>
                                    <th class="text-center">Действие</th>
                                </tr>
                                </thead>

                                <tbody>

                                @forelse($offers as $offer)
                                    <tr>
                                        <td >{{$loop->iteration}}</td>
                                        <td width="20%">{{\Illuminate\Support\Str::limit($offer->name,60)}}</td>
                                        <td width="15%">{{\Illuminate\Support\Str::limit($offer->description, 20)}}</td>
                                        @if($offer->user_id)
                                            <td>{{$offer->username}}</td>
                                        @else
                                            <td class="text-danger text-bold">Не распределен</td>
                                        @endif
                                            <td>{{$offer->project_name}}</td>
                                        @if($offer->status == 1)
                                            <td><span class="badge bg-success p-2">{{$offer->status_name}}</span>
                                            </td>
                                        @elseif($offer->status == 2)
                                            <td><span class="badge bg-primary p-2">{{$offer->status_name}}</span>
                                            </td>
                                        @elseif($offer->status == 3)
                                            <td><span class="badge bg-success p-2">{{$offer->status_name}}</span>
                                            </td>
                                        @elseif($offer->status == 4)
                                            <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span>
                                            </td>
                                        @elseif($offer->status == 5)
                                            <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span>
                                            </td>
                                        @elseif($offer->status == 6)

                                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#send{{$offer->id}}"><span class="badge bg-primary p-2">В ожидании проверки администратора</span></a>

                                            </td>
                                        @elseif($offer->status == 7)
                                            <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span>
                                            </td>
                                        @elseif($offer->status == 8)
                                            <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span>
                                            </td>
                                        @elseif($offer->status == 9)
                                            <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span>
                                            </td>
                                        @elseif($offer->status == 10)
                                            <td><span class="badge bg-success p-2">{{$offer->status_name}}</span>
                                            </td>
                                        @elseif($offer->status == 11)
                                            <td><span class="badge bg-danger p-2">{{$offer->status_name}}</span>
                                            </td>
                                        @elseif($offer->status == 12)
                                            <td><a data-bs-target="#sendBack{{$offer->id}}" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">Отклонено (Сотрудник)</span></a>
                                            </td>
                                        @elseif($offer->status == 13)
                                            <td><a data-bs-target="#sendBack{{$offer->id}}" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">Отклонено (Клиент)</span></a>
                                            </td>
                                        @elseif($offer->status == 14)
                                            <td><a href="#" data-bs-target="#send{{$offer->id}}" data-bs-toggle="modal"><span class="badge bg-success p-2">Задача сделана, отправьте клиенту на проверку</span></a>
                                            </td>
                                        @endif
                                        @if($offer->user_id)
                                        <td>
                                            <a class="badge bg-success p-2" href="{{route('client.offers.show', $offer->id)}}"><i class="bi bi-eye"></i></a>
                                            <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$offer->id}}"><i class="bi bi-trash"></i></a>
                                            </td>
                                        @else
                                            <td class="text-center">
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
                                                <form action="{{route('client.offers.send.back', $offer->id)}}" method="post">
                                                    @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Отправление задачи на проверку</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Вы действительно хотите отправить задачу клиенту</p>
                                                    <textarea required name="reason" class="form-control" id="" cols="30" rows="2"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button  id="reason" type="submit" class="btn btn-danger">Отклонить, Отправить заново</button>
                                                    <a href="{{route('client.offers.send.client', $offer->id)}}" class="btn btn-success" >Отправить</a>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal" tabindex="-1" id="sendBack{{$offer->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('client.offers.send.back', $offer->id)}}" method="post">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Задача отклонена</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Вы действительно хотите отправить задачу обратно сотруднику <span style="font-size: 20px" class="text-success">{{$offer->username}}</span></p>
                                                    </div>
                                                    <div class="modal-footer" id="parent">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                                        <button type="submit" class="btn btn-success" >Отправить</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <td  colspan="7"><h1 class="text-center">Пока нет задач</h1></td>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
@endsection
@section('script')

    <script src="{{asset('assets/js/datatable.js')}}"></script>

    <script>
        $(document).ready(function () {

            var table = $('#example').DataTable({
                initComplete: function () {

                },
            });
        });



    </script>
@endsection


