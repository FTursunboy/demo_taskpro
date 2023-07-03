@extends('admin.layouts.app')
@section('title')
    {{$offer?->name}}
@endsection
@section('content')
    <style>
        .centered-span {
            display: flex;
            justify-content: center;
            font-size: 24px;
        }

    </style>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Задачи</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('client.offers.index')}}">Новые задачи</a></li>
                            <li class="breadcrumb-item"><a href="#">{{$offer->name}}</a></li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <section class="section">
            <div class="card">

                <div class="card-body">
                    <div class="row ">
                        @if(session('mess'))
                            <div class="alert alert-success">
                                Успешно отправлено!
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="#" onclick="history.back()"
                                       class="btn btn-outline-danger">Назад</a>
                                    <a role="button" data-bs-target="#send" data-bs-toggle="modal"
                                       class="btn btn-outline-success text-left">История
                                        задачи
                                    </a>
                                    <a role="button" data-bs-target="#reports" data-bs-toggle="modal" class="btn btn-outline-success text-left">
                                        Отчеты
                                    </a>
                                    @if($offer->status->id == 6)
                                        <a href="#" data-bs-target="#send{{$offer->id}}" data-bs-toggle="modal"
                                           class="btn btn-success">Принять и отправить клиенту</a>
                                    @endif

                                    <span class="centered-span" id="info_danger" style="color: red"></span>
                                </div>
                                @if(\Session::has('err'))
                                    <div class="alert alert-danger mt-4">
                                        {{ \Session::get('err') }}
                                    </div>
                                @endif

                                @include('inc.messages')

                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="container">
                                                <div class="row">
                                                    <p>
                                                        <button
                                                            class="btn btn-primary w-100 collapsed"
                                                            type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseExample" aria-expanded="false"
                                                            aria-controls="collapseExample"><span
                                                                class="d-flex justify-content-start"><i
                                                                    class="bi bi-info-circle mx-2"></i> <span>{{ \Illuminate\Support\Str::limit($offer->name, 15) }}</span> </span>
                                                        </button>
                                                    </p>
                                                    @if(isset($search))

                                                        <form method="post"
                                                              action="{{ route('client.offers.send.user.search', ['offer' => $offer->id, 'search' => $search]) }}"
                                                              enctype="multipart/form-data" autocomplete="off">
                                                            @else
                                                                <form method="post"
                                                                      action="{{ route('client.offers.send.user', ['offer' => $offer->id]) }}"
                                                                      enctype="multipart/form-data" autocomplete="off">
                                                                    @endif


                                                                    @csrf
                                                                    <div class="collapse my-3 show"
                                                                         id="collapseExample">
                                                                        <div class="row g-3">
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Название
                                                                                    задачи</label>
                                                                                <input disabled type="text"
                                                                                       class="form-control"
                                                                                       name="name" id="name"
                                                                                       value="{{$offer->name}}"
                                                                                       required>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Проект</label>
                                                                                <input type="text" class="form-control"
                                                                                       value="{{$project->projects?->name}}"
                                                                                       disabled name="project">
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <label class="form-label"> Сотрудник
                                                                                    со
                                                                                    стороны компании</label>
                                                                                <input value="{{$offer->author_name}}"
                                                                                       disabled
                                                                                       type="text"
                                                                                       class="form-control"
                                                                                       name="author_name" id="name"
                                                                                       required>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Телефон
                                                                                    ответственного
                                                                                    сотрудника</label>
                                                                                <input value="{{$offer->author_phone}}"
                                                                                       disabled
                                                                                       type="text"
                                                                                       class="form-control"
                                                                                       name="author_phone" id="name"
                                                                                       required>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">От</label>
                                                                                <input required
                                                                                       id="from"
                                                                                       value="{{$offer->from}}"
                                                                                       type="date"
                                                                                       class="form-control"
                                                                                       name="from">

                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">До</label>
                                                                                <input required
                                                                                       id="to_1"
                                                                                       value="{{$offer->to}}"
                                                                                       type="date"
                                                                                       class="form-control"
                                                                                       name="to">

                                                                                <span id="error-message"
                                                                                      class="d-none text-center mt-3"
                                                                                      style="color: red">Дата окончания задачи не может превышать дату начало задачи</span>

                                                                            </div>


                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Ответственный
                                                                                    исполнитель</label>
                                                                                <select required class="form-select"
                                                                                        name="user_id" id="user_id">
                                                                                    <option value="">Выберите
                                                                                        исполнителя
                                                                                    </option>
                                                                                    @foreach($users as $user)
                                                                                        @if($user->login !== 'z1ntel2001')
                                                                                            <option
                                                                                                value="{{$user->id}}" {{$user->id === $offer->user_id ? 'selected' : ''}} >{{$user->surname .' ' . $user->name .' '.$user->lastname}}</option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </select>

                                                                                <label class="form-label">Тип</label>
                                                                                <select name="type_id"
                                                                                        class="form-control"
                                                                                        id="type_id_2">
                                                                                    @foreach($types as $type)
                                                                                        <option
                                                                                            value="{{$type->id}}">{{$type->name}}</option>
                                                                                    @endforeach
                                                                                </select>

                                                                                <div class="form-group" id="percent">
                                                                                    <label id="label1"
                                                                                           class="d-none mb-2"
                                                                                           for="percent">Введите
                                                                                        процент</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Время</label>
                                                                                <input
                                                                                    value="{{$offer->time}}"
                                                                                    type="number"
                                                                                    class="form-control"
                                                                                    name="time"
                                                                                    id="time_1"
                                                                                    placeholder="Введите время">

                                                                                <label class="form-label">Клиент</label>
                                                                                <input
                                                                                    value="{{$offer->client->surname . " " . $offer->client->name . " " . $offer->client->lastname}}"
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    disabled
                                                                                >

                                                                                <div class="form-group"
                                                                                     id="type_id_group_2">
                                                                                    <label id="label"
                                                                                           class="d-none mb-2"
                                                                                           for="kpi_id_2">Вид KPI</label>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">


                                                                                <span id="error-message"
                                                                                      class="d-none text-center mt-3"
                                                                                      style="color: red">Дата окончания задачи не может превышать дату начало задачи</span>

                                                                            </div>


                                                                            @if($offer->file !== null)
                                                                                <div class="col-md-6">
                                                                                    <a style="margin-left: 0px" download
                                                                                       href="{{route('offer.file.download', $offer->id)}}">Просмотреть
                                                                                        файл</a>
                                                                                </div>
                                                                            @endif

                                                                            @if($offer->status_id === 6)
                                                                                <div class="col-md-6">
                                                                                    <label
                                                                                        class="form-label">Отчёт</label>
                                                                                    <textarea
                                                                                        class="form-control"
                                                                                        style="background-color: #208d20; color: white"
                                                                                    >{{$offer->tasks->success_desc}}</textarea>
                                                                                </div>
                                                                            @endif

                                                                            <div class="col-md-6">

                                                                            </div>

                                                                            <div class="col-12">
                                                                                <label for="your-message"
                                                                                       class="form-label">Описание
                                                                                    задачи</label>
                                                                                <textarea disabled id="description"
                                                                                          class="form-control"
                                                                                          name="description"
                                                                                          rows="5"
                                                                                          required>{{$offer->description}} </textarea>
                                                                            </div>

                                                                            @if($offer->cancel)
                                                                                <div class="col-md-12">
                                                                                    <label for="">Причина отклонениня
                                                                                    </label>
                                                                                    <textarea disabled id="description"
                                                                                              class="form-control"
                                                                                              name="description"
                                                                                              rows="1"
                                                                                              required>{{$offer->cancel}} </textarea>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                </div>
                                                <div class="row   d-flex justify-content-center align-items-center">
                                                    <div class="col-lg-9">

                                                        <div class="row mt-4">
                                                            @if(!$offer->user_id)
                                                                <div class="col-6">
                                                                    <button name="action" value="accept"
                                                                            class="btn btn-success form-control"
                                                                            type="submit" id="button">
                                                                        Отправить
                                                                    </button>
                                                                </div>
                                                                <div class="col-6">
                                                                    <a data-bs-target="#decline{{$offer->id}}"
                                                                       data-bs-toggle="modal" value="decline"
                                                                       class="btn btn-danger form-control">
                                                                        Отклонить
                                                                    </a>
                                                                </div>
                                                            @endif
                                                            <script>
                                                                const btn = document.getElementById('btnSend')
                                                                btn.addEventListener('click', function () {
                                                                    const name = document.getElementById('name').value
                                                                    const description = document.getElementById('description').value
                                                                    if (name !== '' && description !== '') {
                                                                        btn.type = 'submit';
                                                                        btn.click();
                                                                        btn.classList.add('disabled')
                                                                    }
                                                                })
                                                            </script>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid gray">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="media d-flex align-items-center">
                                        @if($offer->user_id !== null && Auth::id() !== $offer->user_id)
                                            <div class="avatar me-2">
                                                @if($offer?->user?->avatar)
                                                    <img src="{{ asset('storage/'. $offer?->user?->avatar)}}">
                                                @else
                                                    <img src="{{asset('assets/images/avatar-2.png')}}">
                                                @endif
                                                    <span
                                                        class="avatar-status {{ Cache::has('user-is-online-' . $offer?->user?->id) ? 'bg-success' : 'bg-danger' }}"></span>
                                            </div>
                                            <div class="name me-2">
                                                <h6 class="mb-0">{{ $offer?->user?->name }} {{ $offer?->user?->surname }}</h6>
                                                <span class="text-xs">
                                                    @if(Cache::has('user-is-online-' . $offer?->user?->id))
                                                        <span class="text-center text-success mx-2"><b>Online</b></span>
                                                    @else
                                                        <span class="text-center text-danger  mx-2"><b>Offline</b>
                                                            @if(isset($admin))
                                                             @if($admin?->last_seen !== null)
                                                                <span class="text-gray-600"> - {{ \Carbon\Carbon::parse($offer?->user?->last_seen)->diffForHumans() }}</span>
                                                            @endif
                                                            @endif
                                                        </span>
                                                    @endif
                                                </span>
                                            </div>
                                        @endif
                                        <div class="avatar ms-2 me-2">
                                            @if($offer->client?->avatar)
                                                <img src="{{ asset('storage/'. $offer?->client?->avatar)}}">
                                            @else
                                                <img src="{{asset('assets/images/avatar-2.png')}}">
                                            @endif
                                            <span
                                                class="avatar-status {{ Cache::has('user-is-online-' . $offer->client?->id) ? 'bg-success' : 'bg-danger' }}"></span>
                                        </div>
                                        <div class="name me-2">
                                            <h6 class="mb-0">{{ $offer->client?->name }} {{ $offer->client?->surname }} </h6>
                                            <span class="text-xs">
                                                 @if(Cache::has('user-is-online-' . $offer->client?->id))
                                                    <span class="text-center text-success mx-2"><b>Online</b></span>
                                                @else
                                                    <span class="text-center text-danger  mx-2"><b>Offline</b>
                                                        @if(isset($admin))
                                                         @if($admin?->last_seen !== null)
                                                            <span class="text-gray-600"> - {{ \Carbon\Carbon::parse($offer->client?->last_seen)->diffForHumans() }}</span>
                                                        @endif
                                                        @endif
                                                    </span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-4 bg-grey">
                                    <div class="chat-content" style="overflow-y: scroll; height: 320px;" id="block">
                                        @foreach($messages as $mess)
                                            @if($mess->sender_id === \Illuminate\Support\Facades\Auth::id())
                                                <div class="chat id">
                                                    <div class="chat-body" style="margin-right: 10px">
                                                        <div class="chat-message">
                                                            <p>
                                                                 <span
                                                                     style="display: flex; justify-content: space-between;">
                                                            <b>{{$mess->sender?->name}}</b>
                                                            <a style="color: red"
                                                               href="{{route('tasks.messages.delete', $mess->id)}}"><i
                                                                    class="bi bi-trash"></i></a>
                                                        </span>
                                                                <span
                                                                    style="margin-top: 10px">{{ $mess->message }}</span>
                                                            @if($mess->file !== null)
                                                                <div class="form-group">
                                                                    <a href="{{ route('client.offers.messages.download', $mess) }}"
                                                                       download class="form-control text-bold">Просмотреть
                                                                        файл</a>
                                                                </div>
                                                            @endif
                                                            <span class="d-flex justify-content-end"
                                                                  style="font-size: 10px; margin-left: 100px; margin-top: 15px;margin-bottom: -25px">
                                                                {{date('d.m.Y H:i:s', strtotime($mess->created_at))}}
                                                            </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="chat chat-left id">
                                                    <div class="chat-body">
                                                        <div class="chat-message">
                                                            <p>
                                                                <span><b>{{$mess->sender?->name}}</b><br></span>
                                                                <span
                                                                    style="margin-top: 10px">{{ $mess->message }}</span>
                                                            @if($mess->file !== null)
                                                                <div class="form-group">
                                                                    <a href="{{ route('client.offers.messages.download', $mess) }}"
                                                                       download class="form-control text-bold">Просмотреть
                                                                        файл</a>
                                                                </div>
                                                            @endif
                                                            <span class="d-flex justify-content-end"
                                                                  style="font-size: 10px; margin-left: 100px; margin-top: 15px;margin-bottom: -25px">
                                                                {{date('d.m.Y H:i:s', strtotime($mess->created_at))}}
                                                            </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <script>
                                        let block = document.getElementById("block");
                                        block.scrollTop = block.scrollHeight;
                                    </script>
                                </div>

                                @if($offer->status_id != 3)
                                    <div class="card-footer">
                                        <div class="message-form d-flex flex-direction-column align-items-center">
                                            <form class="w-100" id="formMessage"
                                                  method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="d-flex flex-grow-1 ml-4">
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="message" class="form-control"
                                                               placeholder="Сообщение..." id="message" required>
                                                        <div class="col-3">
                                                            <input type="file" name="file" class="form-control"
                                                                   id="file">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary" id="messageBTN">
                                                            Отправить
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal" tabindex="-1" id="send">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Вся история задачи</h5>

                </div>
                <div class="modal-body">
                    <div class="row p-3">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist"
                                style="border-radius: 20px">
                                <li class="nav-item">
                                    <a style="border-radius: 5px; margin-top: -4px" class="nav-link active"
                                       id="custom-tabs-one-home-tab" data-bs-toggle="pill" href="#custom-tabs-one-home"
                                       role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">История
                                        задачи</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" style="margin-top: -4px" id="custom-tabs-one-profile-tab"
                                       data-bs-toggle="pill" href="#custom-tabs-one-profile" role="tab"
                                       aria-controls="custom-tabs-one-profile" aria-selected="false">Время задачи</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                     aria-labelledby="custom-tabs-one-home-tab">
                                    <table class="table mb-0 table-hover">
                                        <thead>
                                        <tr>
                                            <th class="">#</th>
                                            <th class="">Дата</th>
                                            <th class="">Совершил действия</th>
                                            <th class="">Статус</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($histories as $history)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{date('d.m.Y H:i:s', strtotime($history->created_at))}}</td>
                                                <td>{{$history->user?->name }}
                                                    @if ($history?->user?->hasRole('admin'))
                                                        (Админ)
                                                    @elseif ($history?->user?->hasRole('user'))
                                                        (Сотрудник)
                                                    @elseif ($history?->user?->hasRole('client') || $history?->user?->hasRole('client-worker'))
                                                        (Клиент)
                                                    @else
                                                        Роль не определена
                                                    @endif
                                                </td>
                                                <td>{{$history->status?->name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                     aria-labelledby="custom-tabs-one-profile-tab">
                                    <table class="table mb-0 table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Дата начала задачи</th>
                                            <th class="text-center">Дата окончание задачи</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center">{{$offer->created_at}}</td>
                                            <td class="text-center">{{$offer->finish}}</td>
                                        </tr>
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
    <div class="modal" tabindex="-1" id="send{{$offer->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('client.offers.send.back', $offer->id)}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Отправление задачи на проверку</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="reasonSend" style="display: none">
                        <p>Вы действительно хотите отправить задачу клиенту</p>
                        <textarea required name="reason" class="form-control" id="" cols="30" rows="2"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button  id="reason" type="button" class="btn btn-danger">Отклонить, Отправить заново</button>
                        <button  id="reasonButton" type="submit" class="btn btn-danger" style="display: none">Отклонить, Отправить заново</button>
                        <a href="{{route('client.offers.send.client', $offer->id)}}" class="btn btn-success" id="sendButton">Отправить</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="decline{{$offer->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('client.offers.decline', $offer->id)}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Вы действительно хотите отклонить задачу</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea name="reason" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
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
                                                    @elseif ($report->user->hasRole('client') || $report->user->hasRole('client-worker'))
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
@endsection

@section('script')
    <script src="{{asset('assets/js/control_offers.js')}}" ></script>
    <script>

        $('#type_id_2').change(function () {
            let kpi = $(this).children('option:selected')
            if (kpi.text().toLowerCase() === 'kpi') {
                console.log(1);
                let kpiType = $('#kpi_id_2').empty();

                $('#label_2').removeClass('d-none');
                let kpi_id = $('<select tabindex="6"  required name="kpi_id" class="form-select"><option value="">Выберите месяц</option></select>');
                $('#type_id_group_2').append(kpi_id);

                $('#label1').removeClass('d-none');
                let percent = $('<input tabindex="9"  required type="number" oninput="checkMaxValue(this)" id="percent" step="any" name="percent" class="form-control">');
                $('#percent').append(percent);


                $.get(`/tasks/publ1ic/kpi/${kpi.val()}/`).then((res) => {
                    for (let i = 0; i < res.length; i++) {
                        const item = res[i];
                        console.log(item.name);
                        kpi_id.append($('<option>').val(item.id).text(item.name));
                    }
                });


            } else {
                $('#type_id_group_2').empty();

                $('#percent').empty();

            }
        })

        function checkMaxValue(input) {
            var maxValue = 150;
            if (input.value > maxValue) {
                input.value = maxValue;

            }
        }


        const fromInput = document.getElementById('from');
        let prevValue = fromInput.value;

        fromInput.addEventListener('input', function () {
            const dateValue = new Date(this.value);
            const year = dateValue.getFullYear();
            const maxLength = 4;

            if (year.toString().length > maxLength) {
                this.value = prevValue; // Восстанавливаем предыдущее значение
            } else {
                prevValue = this.value; // Сохраняем текущее значение
            }
        });
    </script>
    <script>
        const toInput = document.getElementById('to');
        let prevValue1 = toInput.value;

        toInput.addEventListener('input', function () {
            const dateValue = new Date(this.value);
            const year = dateValue.getFullYear();
            const maxLength = 4;

            if (year.toString().length > maxLength) {
                this.value = prevValue1; // Восстанавливаем предыдущее значение
            } else {
                prevValue1 = this.value; // Сохраняем текущее значение
            }
        });
    </script>

    @routes

    <script>
        $(document).ready(function () {
            $('#fileInput').change(function () {
                const selectedFile = $(this).prop('files')[0];
                if (selectedFile) {
                    $('#message').val('Файл');
                } else {
                    $('#message').val('');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#file').change(function () {
                const selectedFile = $(this).prop('files')[0];
                if (selectedFile) {
                    $('#message').val('Файл');
                } else {
                    $('#message').val('');
                }
            });
        });

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#formMessage').submit(function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let fileInput = $('#file')[0];
                let selectedFile = fileInput.files[0];
                formData.append('file', selectedFile);

                $.ajax({
                    url: "{{ route('offers.chat.message.store', $offer->id) }}",
                    method: "POST",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        $('#message').val(' ');
                        $('#file').val('');

                        let fileUrl = route('user.downloadChat', {task: response.messages.id});
                        let del = route('tasks.messages.delete', {mess: response.messages.id});
                        let newMessage = `
                                <div class="chat">
                                    <div class="chat-body" style="margin-right: 10px">
                                        <div class="chat-message">
                                            <p>
                                                <span style="display: flex; justify-content: space-between;">
                                                            <b>${response.name}</b>
                                                            <a style="color: red" href="${del}"><i class="bi bi-trash"></i></a>
                                                        </span>
                                                <span style="margin-top: 10px">${response.messages.message}</span>
                                                ${response.messages.file !== null ? `
                                                        <div class="form-group">
                                                            <a href="${fileUrl}" download class="form-control text-bold">Просмотреть файл</a>
                                                        </div>
                                                    ` : ''}
                                                <span class="d-flex justify-content-end" style="font-size: 10px; margin-left: 100px; margin-top: 15px;margin-bottom: -25px">
                                                    ${response.created_at}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        `;

                        $('#block').append(newMessage);


                        let block = document.getElementById("block");
                        block.scrollTop = block.scrollHeight;

                    },
                    error: function (xhr, status, error) {
                        alert('Ошибка при отправке сообщения');
                    }
                });
            });
        });
    </script>

    <script>
        $('#from').change(function () {
            const to = $('#to')
            if ($(this).val() > to.val()) {

                let selectedOption = $('#project_id option:selected');
                let selectedClass = selectedOption.attr('class');

                let selectedDate = new Date(selectedClass);
                let toDate = new Date($(this).val());

                if (toDate > selectedDate) {
                    $('#error-message').show();
                    $(this).addClass('border-danger')

                    let formattedDate = selectedDate.toISOString().split('T')[0];

                    $(this).val(formattedDate)
                }

                to.addClass('border-danger')
                $('#button').attr('type', 'button');
            } else {
                $(this).removeClass('border-danger')
                to.removeClass('border-danger')
                $('#button').attr('type', 'submit');
            }
            updateErrorMessageVisibility();
        })

        $('#to').change(function () {
            const from = $('#from')
            if ($(this).val() < from.val()) {
                $(this).addClass('border-danger')
                from.addClass('border-danger')
                $('#button').attr('type', 'button');
            } else {
                $(this).removeClass('border-danger')
                from.removeClass('border-danger')
                $('#button').attr('type', 'submit');
            }
            updateErrorMessageVisibility();
        })

        function formatDate(date) {
            let year = date.getFullYear();
            let month = String(date.getMonth() + 1).padStart(2, '0');
            let day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        function formatDate1(dateStr) {
            const [day, month, year] = dateStr.split('-');
            const date = new Date(`${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`);
            return `${date.getDate()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getFullYear()}`;
        }

        $('#to').on('input', function () {
            let project_finish = formatDate1($('#project_finish').text());

            let selectedOption = $('#project_id option:selected');
            let selectedClass = selectedOption.attr('class');

            let selectedDate = new Date(selectedClass);
            let toDate = new Date($(this).val());

            if (toDate > selectedDate) {
                $('#error-message').show();
                $(this).addClass('border-danger')

                let formattedDate = selectedDate.toISOString().split('T')[0];

                $(this).val(formattedDate)
            } else {
                $(this).removeClass('border-danger')
                $('#error-message').hide();
                $('#button').attr('type', 'submit');
            }
            updateErrorMessageVisibility();
            let formattedDate = formatDate(toDate);
            console.log(formattedDate);
        });

        function updateErrorMessageVisibility() {
            const errorMessage = $('#error-message');
            const from = $('#from');
            const to = $('#to');
            if (from.hasClass('border-danger') || to.hasClass('border-danger')) {
                errorMessage.removeClass('d-none');
            } else {
                errorMessage.addClass('d-none');
            }
        }


    </script>
    <script>
        $(document).ready(function(){
            $('#reason').on('click', function() {
                $('#reason').hide();
                $('#reasonButton').show();
                $('#reasonSend').show();
                $('#sendButton').hide();
            });
        });
    </script>
@endsection


