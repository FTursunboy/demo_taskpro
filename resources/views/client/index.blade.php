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
                                    <td><span class="badge bg-primary p-2">На проверке (У админа)</span>
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
                                    <a class="badge bg-warning p-2" href="{{route('offers.chat', $task->id)}}"><i class="bi bi-chat"></i></a>

                                </td>
                            </tr>


                            <div class="modal" tabindex="-1" id="send{{$task->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Убедитесь что задача выполнена</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Вы действительно хотите закрыть задачу, если нет оптравьте заново</p>
                                            <hr>
                                            <h6 class="text-center">Поставьте оценку, за выполнение задачи!</h6>
                                            <div class="gezdvu">
                                                <div class="ponavues">
                                                    <label class="eysan">
                                                        <input type="radio" name="radio1" id="star1" value="star1">
                                                        <div class="face"></div>
                                                        <i class="far fa-star gasedun one-star"></i>
                                                    </label>
                                                    <label class="eysan">
                                                        <input type="radio" name="radio1" id="star2" value="star2">
                                                        <div class="face"></div>
                                                        <i class="far fa-star gasedun two-star"></i>
                                                    </label>
                                                    <label class="eysan">
                                                        <input type="radio" name="radio1" id="star3" value="star3">
                                                        <div class="face"></div>
                                                        <i class="far fa-star gasedun three-star"></i>
                                                    </label>
                                                    <label class="eysan">
                                                        <input type="radio" name="radio1" id="star4" value="star4">
                                                        <div class="face"></div>
                                                        <i class="far fa-star gasedun four-star"></i>
                                                    </label>
                                                    <label class="eysan">
                                                        <input type="radio" name="radio1" id="star5" value="star5">
                                                        <div class="face"></div>
                                                        <i class="far fa-star gasedun five-star"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{route('offers.decline', $task->id)}}" class="btn btn-danger">Отправить
                                                заново</a>
                                            <a href="{{route('offers.ready', $task->id)}}" class="btn btn-success">Завершить</a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        @empty
                            <td colspan="5"><h1 class="text-center">Пока нет завершенных задач</h1></td>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">

    <script>
        $(function() {
            $(document).on({
                mouseover: function(event) {
                    $(this).find('.far').addClass('star-over');
                    $(this).prevAll().find('.far').addClass('star-over');
                },
                mouseleave: function(event) {
                    $(this).find('.far').removeClass('star-over');
                    $(this).prevAll().find('.far').removeClass('star-over');
                }
            }, '.eysan');

            $(document).on('click', '.eysan', function() {
                if ( !$(this).find('.gasedun').hasClass('eysan-active') ) {
                    $(this).siblings().find('.star').addClass('far').removeClass('fas eysan-active');
                    $(this).find('.gasedun').addClass('eysan-active fas').removeClass('far star-over');
                    $(this).prevAll().find('.gasedun').addClass('fas').removeClass('far star-over');
                } else {
                    console.log('has');
                }
            });

        });
    </script>
@endsection


