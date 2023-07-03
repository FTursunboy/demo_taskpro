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
        <section class="section">
            <div class="row ">
                <div class="row pt-4">
                    <div class="col-md-12">
                        @if($errors->any())
                            <div class="alert alert-danger w-100 text-center">Заполните
                                все поля
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-1">
                                        <a href="#" onclick="history.back()" class="btn btn-danger">Назад</a>
                                    </div>
                                    <div class="col-md-2">
                                        <button data-bs-target="#reports" data-bs-toggle="modal" class="btn btn-outline-success w-100 text-left">Отчеты</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button data-bs-target="#history" data-bs-toggle="modal" class="btn btn-outline-success w-100 text-left">История</button>
                                    </div>
                                    @if($offer->status_id == 10)
                                    <div class="col-md-2">
                                        <button data-bs-target="#send" data-bs-toggle="modal" class="btn btn-success w-100 text-left">Принять</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button data-bs-target="#decline" data-bs-toggle="modal" class="btn btn-danger w-100 text-left">Отклонить</button>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            @if(\Session::has('err'))
                                <div class="alert alert-danger mt-4">
                                    {{ \Session::get('err') }}
                                </div>
                            @endif

                            <div class="container">
                                <div class="row   d-flex justify-content-center align-items-center">
                                    <div class="col-lg-9">
                                        <form method="post" action="{{route('offers.store')}}"
                                              enctype="multipart/form-data"
                                              autocomplete="off">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Название
                                                        задачи</label>
                                                    <textarea id="description" class="form-control"
                                                              name="description"
                                                              rows="2" disabled>{{$offer->name}}</textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Ответственный
                                                        сотрудник</label>
                                                    <input placeholder="Сотрудник будет установлен"
                                                           disabled
                                                           type="text"
                                                           class="form-control"
                                                           name="user_id" id="name"
                                                           value="{{$offer->user?->name}}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Ответсвенный сотрудник
                                                                    со стороны
                                                                    компании</label>
                                                                <input value="{{$offer->author_name}}" disabled
                                                                       type="text"
                                                                       class="form-control"
                                                                       name="author_name" id="name" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Телефон ответсвенного
                                                                    сотрудника</label>
                                                                <input value="{{$offer->author_phone}}" disabled
                                                                       type="text"
                                                                       class="form-control"
                                                                       name="author_phone" id="name" required>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="form-label">От</label>
                                                                <input placeholder="Дата будет установлена"
                                                                       value="{{$offer->from}}" disabled
                                                                       type="date"
                                                                       class="form-control"
                                                                       name="from">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">До</label>
                                                                <input placeholder="Дата будет установлена"
                                                                       value="{{$offer->to}}" disabled
                                                                       type="date"
                                                                       class="form-control"
                                                                       name="to">
                                                            </div>
                                                            @if($offer->file !== null)
                                                                <div class="col-md-6">
                                                                    <a style="margin-left: 0px" download
                                                                       href="{{route('offers.download', $offer->id)}}">Просмотреть
                                                                        файл</a>
                                                                </div>
                                                            @endif

                                                            <div class="col-12">
                                                                <label for="your-message" class="form-label">Описание
                                                                    задачи</label>
                                                                <textarea disabled id="description"
                                                                          class="form-control"
                                                                          name="description"
                                                                          rows="3"
                                                                          required>{{$offer->description}} </textarea>
                                                            </div>

                                                            <div class="col-md-6">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-12">
                                                                <a href="{{route('offers.index')}}"
                                                                   class="btn btn-success form-control">
                                                                    Назад
                                                                </a>
                                                                <script>
                                                                    const btn = document.getElementById('btnSend')
                                                                    btn.addEventListener('click', function () {
                                                                        const name = document.getElementById('name').value
                                                                        const description = document.getElementById('description').value
                                                                        if (name !== '' && description !== '') {
                                                                            btn.type = 'submit';
                                                                            btn.click();
                                                                            btn.classList.add('disabled')
                                                                        } else {
                                                                            btn.classList.add('disabled')
                                                                        }
                                                                    })
                                                                </script>
                                                            </div>
                                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <div class="modal" tabindex="-1" id="reports">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Отчеты всех статусов</h5>

                </div>
                <div class="modal-body">
                    <div class="row p-3">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <table class="table mb-0 table-hover">
                                        <thead>
                                        <tr>
                                            <th class="">#</th>
                                            <th class="">Дата</th>
                                            <th class="">Совершил действия</th>
                                            <th class="">Статус</th>
                                            <th class="">Отчет</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($reports as $report)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{date('d.m.Y H:i:s', strtotime($report->created_at))}}</td>
                                                <td>{{$report->user->name }}</td>
                                                <td>
                                                    {{ $report->status?->name }}
                                                    @if ($report->user->hasRole('admin'))
                                                        (Админ)
                                                    @elseif ($report->user->hasRole('user'))
                                                        (Сотрудник)
                                                    @elseif ($report->user->hasRole('client') || $report->sender->hasRole('client-worker'))
                                                        (Клиент)
                                                    @else
                                                        (Система)
                                                    @endif
                                                </td>
                                                <td>{{$report->text}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="decline">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('offers.decline', $offer->id) }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Отклонения задачи</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label>Причина отклонения:</label>
                        <textarea class="form-control" name="reason" id="" cols="30" rows="4"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-danger" type="submit">Отклонить</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="send">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('offers.decline', $offer->id) }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Убедитесь, что задача выполнена</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label>Отчет:</label>
                        <textarea disabled class="form-control" name="cancel" id="" cols="30" rows="4">{{$offer->tasks->success_desc}}</textarea>
                    </div>
                    <div class="modal-footer">
                        <a href="#"  class="btn btn-success" role="button" data-bs-toggle="modal" data-bs-target="#ready{{ $offer->id }}">Завершить</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="ready{{ $offer->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ready{{ $offer->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ready{{ $offer->id }}">Поставте оценку исполнителю</h1>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">Поставьте оценку, за выполнение задачи!</h6>
                    <div class="gezdvu">
                        <div class="ponavues">
                            <label class="eysan">
                                <form id="scoreForm" action="{{route('score', $offer->id)}}" method="post">
                                    @csrf
                                    <input data-bs-toggle="modal" data-bs-target="#RatingOne" type="button"  class="star" value="1"  >
                                    <input data-bs-toggle="modal" data-bs-target="#RatingTwo" type="button"  class="star2" value="2" >
                                    <input data-bs-toggle="modal" data-bs-target="#RatingThree" type="button"  class="star3" value="3" >
                                    <input data-bs-toggle="modal" data-bs-target="#RatingFour" type="button"  class="star4" value="4" >
                                    <input data-bs-toggle="modal" data-bs-target="#RatingFive" type="button"  class="star5" value="5" >
                                </form>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="RatingOne" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="scoreForm" action="{{route('score', $offer->id)}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Подтверждение</h1>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="rating" value="1">
                        <div class="form-group">
                            <span style="font-size: 20px;">Подтверждаете оценку <span class="star p-2">1</span> ? </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-bs-target="#ready{{$offer->id}}" data-bs-toggle="modal" type="button" class="btn btn-danger">Нет</button>
                        <button data-bs-target="#RatingReason1" data-bs-toggle="modal" type="button" class="btn btn-success">Подтвердить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="RatingTwo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="scoreForm" action="{{route('score', $offer->id)}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Подтверждение</h1>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="rating" value="2">
                        <div class="form-group">
                            <span style="font-size: 20px;">Подтверждаете оценку <span class="star2 p-2">2</span> ?</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-bs-target="#ready{{$offer->id}}" data-bs-toggle="modal" type="button" class="btn btn-danger">Нет</button>
                        <button data-bs-target="#RatingReason2" data-bs-toggle="modal" type="button" class="btn btn-success">Подтвердить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="RatingThree" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="scoreForm" action="{{route('score', $offer->id)}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Подтверждение</h1>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="rating" value="3">
                        <div class="form-group">
                            <span style="font-size: 20px;">Подтверждаете оценку <span class="star3 p-2">3</span> ?</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-bs-target="#ready{{$offer->id}}" data-bs-toggle="modal" type="button" class="btn btn-danger">Нет</button>
                        <button data-bs-target="#RatingReason3" data-bs-toggle="modal" type="button" class="btn btn-success">Подтвердить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="RatingFour" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="scoreForm" action="{{route('score', $offer->id)}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Подтверждение</h1>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="rating" value="4">
                        <div class="form-group">
                            <span style="font-size: 20px;">Подтверждаете оценку <span class="star4 p-2">4</span> ?</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-bs-target="#ready{{$offer->id}}" data-bs-toggle="modal" type="button" class="btn btn-danger">Нет</button>
                        <button type="submit" class="btn btn-success">Подтвердить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="RatingFive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="scoreForm" action="{{route('score', $offer->id)}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Подтверждение</h1>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="rating" value="5">
                        <div class="form-group">
                            <span style="font-size: 20px;">Подтверждаете оценку <span class="star5 p-2">5</span> ?</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-bs-target="#ready{{$offer->id}}" data-bs-toggle="modal" type="button" class="btn btn-danger">Нет</button>
                        <button type="submit" class="btn btn-success">Подтвердить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--                        Начало: Причины низкой оценки --}}
    @php
        $i = 1;
        $totalIterations = 3;
    @endphp

    @while($i <= $totalIterations)
        <div class="modal fade" id="RatingReason{{$i}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="scoreForm" action="{{route('score', $offer->id)}}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Главной причиной неудовлетворения работой стало...</h1>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="rating" value="{{$i}}">
                            <div class="form-group">
                                <input type="radio" name="reason" class="form-check-input" value="Качество выполненной работы">
                                <label>Качество выполненной работы</label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="reason" class="form-check-input" value="Длительный срок исполнения задачи">
                                <label>Длительный срок исполнения задачи</label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="reason" class="form-check-input" value="Проблема  с коммуникацией / Не соблюдение делового этикета при общении">
                                <label>Проблема  с коммуникацией / Не соблюдение делового этикета при общении</label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="reason" class="form-check-input" value="Хотелось бы другого исполнителя">
                                <label>Хотелось бы другого исполнителя</label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="reason" class="form-check-input" value="Другое">
                                <label>Другое</label>
                            </div>
                            <div class="form-group" id="textareaContainer{{$i}}" style="display: none;">
                                <label>Пожалуйста, укажите причину:</label>
                                <textarea rows="3" class="form-control" id="reason{{$i}}"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button data-bs-target="#ready{{$offer->id}}" data-bs-toggle="modal" type="button" class="btn btn-danger">Отмена</button>
                            <button type="submit" class="btn btn-success">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @php
            $i++;
        @endphp

    @endwhile
    {{--                       Конец: Причины низкой оценки --}}

    <div class="modal" tabindex="-1" id="send{{$offer->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('offers.decline', $offer->id)}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Убедитесь что задача выполнена</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea disabled class="form-control" name="cancel" id="" cols="30" rows="4">{{$offer?->tasks?->success_desc}}</textarea>

                        <div style="display: none;" id="reason">
                            <label for="reason">Причина отклонения</label>
                            <textarea name="cancel" cols="30" rows="5" class="form-control" ></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="declineButton" class="btn btn-danger">Отправить заново</button>
                        <button type="submit" class="btn btn-danger" id="decline" style="display: none">Отправить
                            заново</button>
                        <a href="#" class="btn btn-success" role="button" id="end"  data-bs-toggle="modal" data-bs-target="#ready{{ $offer->id }}">Завершить</a>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <div class="modal"  tabindex="-1" id="history">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Вся история задачи</h5>

                </div>
                <div class="modal-body">
                    <div class="row p-3">

                        <table class="table table-striped" id="table1">
                            <thead>
                            <th>Дата</th>
                            <th>Совершил действия</th>
                            <th>Статус</th>
                            </thead>
                            <tbody>

                            @foreach($histories as $history)

                                <tr>
                                    <td>{{date('d.m.Y H:i:s', strtotime($history->created_at))}}</td>
                                    <td>{{$history->user->name }}</td>
                                    <td>
                                        {{ $history->status?->name }}

                                        @if ($history->user->hasRole('admin'))
                                            (Админ)
                                        @elseif ($history->user->hasRole('user'))
                                            (Сотрудник)
                                        @elseif ($history->user->hasRole('client') || $history->user->hasRole('client-worker'))
                                            (Клиент)
                                        @endif
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
@section('script')
    <script>
        const numModals = 3;

        for (let i = 1; i <= numModals; i++) {
            const modalId = `RatingReason${i}`;
            const textareaContainerId = `textareaContainer${i}`;
            const reasonId = `reason${i}`;

            const reasons = document.querySelectorAll(`#${modalId} input[name="reason"]`);
            const textareaContainer = document.querySelector(`#${textareaContainerId}`);
            const reasontext = document.querySelector(`#${reasonId}`);

            reasons.forEach(reason => {
                reason.addEventListener('change', function () {
                    if (reason.value === 'Другое' && reason.checked) {
                        textareaContainer.style.display = 'block';
                        reasontext.setAttribute('name', 'reason');
                        reasontext.setAttribute('required', 'required');
                    } else {
                        textareaContainer.style.display = 'none';
                        reasontext.removeAttribute('name');
                        reasontext.removeAttribute('required');
                    }
                });
            });
        }

    </script>
@endsection



