@extends('admin.layouts.app')

@section('title')
    {{ $task->name }}
@endsection

@section('content')


        <div id="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>{{ $task->name }}</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('mon.index') }}">Мониторинг</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Просмотр задачи</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            @if(session('mess'))
                <div class="alert alert-success">
                    Успешно изменено
                </div>
            @endif
            <div class="page-content">
                <div class="row my-4">
                    <div class="col-1">
                        <a href="{{ route('mon.index') }}" class="btn btn-outline-danger">Назад</a>
                    </div>
                    <div class="col-md-2">
                        <button data-bs-target="#history" data-bs-toggle="modal" class="btn btn-outline-success w-100 text-left">История задачи</button>
                    </div>
                    @if($task->status->id == 6)
                        <div class="col-md-2">
                            <button data-bs-target="#check{{$task->id}}" data-bs-toggle="modal" class="btn btn-success w-100 text-left">Проверить задачу</button>
                        </div>
                    @endif
                    @if($task->status->id == 5)
                        <div class="col-md-2">
                            <button data-bs-target="#sendBack{{$task->id}}" data-bs-toggle="modal" class="btn btn-danger w-100 text-left">Отклонено (Сотрудник)</button>
                        </div>
                    @endif
                    <div class="col-md-4 ms-auto d-flex justify-content-end">
                        <button data-bs-target="#delete{{$task->id}}" data-bs-toggle="modal" class="btn btn-outline-danger me-2">Удалить</button>
                        <a href="{{route('mon.edit', $task->id)}}" class="btn btn-outline-primary">Изменить</a>
                    </div>



                </div>

                <div class="row">
                    <p>
                        <button
                            class="btn btn-primary w-100 collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseExample{{ $task->id }}" aria-expanded="false"
                            aria-controls="collapseExample"><span
                                class="d-flex justify-content-start"><i
                                    class="bi bi-info-circle mx-2"></i> <span>{{ $task->name }}</span> </span>
                        </button>
                    </p>
                    <div class="collapse my-3 show" id="collapseExample{{ $task->id }}">
                        <div class="row p-3">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" id="name" class="form-control"
                                           value="{{ $task->name }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="user">Сотрудник</label>
                                    <input type="text" id="user" class="form-control"
                                           value="{{ $task->user->name }} {{ $task->user->surname }}"
                                           disabled>
                                </div>

                                <div class="form-group">
                                    <label for="from">От</label>
                                    <input type="text" id="from" class="form-control"
                                           value="{{ date('d-m-Y', strtotime($task->from)) }}" disabled>
                                </div>


                                @if($task->file !== null)
                                    <div class="form-group">
                                        <label for="file">Файл</label>
                                        <a href="{{ route('tasks.download', $task->id) }}" download class="form-control text-bold">Просмотреть
                                            файл</a>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="to">Файл</label>
                                        <input type="text" class="form-control" id="to"
                                               value="Нет файл" disabled>
                                    </div>
                                @endif
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="time">Время</label>
                                    <input type="text" id="time" class="form-control"
                                           value="{{$task->time}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="project">Проект</label>
                                    <input type="text" id="project" class="form-control"
                                           value="{{$task->project?->name}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="to">До</label>
                                    <input type="text" id="to" class="form-control"
                                           value="{{ date('d-m-Y', strtotime($task->to)) }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Коментария</label>
                                    <textarea type="text" id="comment" class="form-control" disabled
                                              rows="1">{{ $task->comment }}</textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="sts">Статус</label>
                                    @switch($task->status->id)
                                        @case($task->status->id === 1)
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-warning text-black"
                                                       id="sts" value="{{ $task->status->name }}"
                                                       disabled>
                                            </div>
                                            @break
                                        @case($task->status->id === 2)
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-success text-white"
                                                       id="sts" value="{{ $task->status->name }}"
                                                       disabled>
                                            </div>
                                            @break
                                        @case($task->status->id === 3)
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-success text-white"
                                                       id="sts" value="{{ $task->status->name }}"
                                                       disabled>
                                            </div>
                                            @break
                                        @case($task->status->id === 4)
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-primary text-white"
                                                       id="sts" value="{{ $task->status->name }}"
                                                       disabled>
                                            </div>
                                            @break
                                        @case($task->status->id === 5)
                                            <div class="form-group">
                                                <input type="text" class="form-control text-white" id="sts"
                                                       value="{{ $task->status->name }}" disabled
                                                       style="background-color: #fc0404">
                                            </div>
                                            @break
                                        @case($task->status->id === 6)
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-secondary text-white"
                                                       id="sts" value="{{ $task->status->name }}"
                                                       disabled>
                                            </div>
                                            @break
                                        @case($task->status->id === 7)
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="{{ $task->status->name }}" disabled>
                                            </div>
                                            @break
                                        @case($task->status->id === 8)
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="{{ $task->status->name }}" disabled>
                                            </div>
                                            @break
                                        @case($task->status->id === 9)
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-warning text-black" id="sts"
                                                       value="{{ $task->status->name }}" disabled>
                                            </div>
                                            @break
                                        @case($task->status->id === 10)
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="{{ $task->status->name }}" disabled>
                                            </div>
                                            @break
                                        @case($task->status->id === 11)
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="{{ $task->status->name }}" disabled>
                                            </div>
                                            @break
                                        @case($task->status->id === 12)
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="{{ $task->status->name }}" disabled>
                                            </div>
                                            @break
                                        @case($task->status->id === 13)
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="{{ $task->status->name }}" disabled>
                                            </div>
                                            @break
                                        @case($task->status->id === 14)
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  bg-info text-black" id="sts"
                                                       value="{{ $task->status->name }}" disabled>
                                            </div>
                                            @break
                                    @endswitch

                                    <div class="form-group">
                                        <label for="type">Тип</label>
                                        <input type="text" id="type" class="form-control"
                                               value="{{ $task->type?->name }} {{  (isset($task->typeType?->name)) ? '- '.$task->typeType?->name : '' }}"
                                               disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Автор</label>
                                        <input type="text" id="author" class="form-control"
                                               value="{{ $task->author?->name .' '. $task->author->surname}}"
                                               disabled>
                                    </div>
                                    @if($task->status_id === 5 || $task->status_id === 12)
                                        <div class="form-group">
                                            <label for="reason">Причина</label>
                                            <textarea
                                                id="reason"
                                                class="form-control"
                                                style="color: white;
                                                background: red;"
                                                disabled
                                            >{{ $task->cancel }}</textarea>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                    <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="media d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <img src="{{ asset('assets/images/faces/1.jpg')}}" alt="" srcset="">
                                        <span class="avatar-status bg-success"></span>
                                    </div>
                                    <div class="name flex-grow-1">
                                        <h6 class="mb-0">{{ $task->user->name }} {{ $task->user->surname }}</h6>
                                        <span class="text-xs">Online</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-4 bg-grey">
                                <div class="chat-content" style="overflow-y: scroll; height: 320px;" id="block">
                                    @foreach($messages as $mess)
                                        {{dump($mess->task)}}
                                        @if($mess->sender_id === \Illuminate\Support\Facades\Auth::id())
                                            <div class="chat">
                                                <div class="chat-body" style="margin-right: 10px">
                                                    <div class="chat-message">
                                                        <p>
                                                            <span><b>{{$mess->sender?->name}}</b><br></span>
                                                            <span style="margin-top: 10px">{{ $mess->message }}</span>
                                                        @if($mess->file !== null)
                                                            <div class="form-group">
                                                                <a href="{{ route('tasks.messages.download', $mess) }}" download class="form-control text-bold">Просмотреть
                                                                    файл</a>
                                                            </div>
                                                        @endif
                                                            <span class="d-flex justify-content-end" style="font-size: 10px; margin-left: 100px; margin-top: 15px;margin-bottom: -25px">
                                                                {{date('d.m.Y H:i:s', strtotime($mess->created_at))}}
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="chat chat-left">
                                                <div class="chat-body">
                                                    <div class="chat-message">
                                                        <p>
                                                            <span><b>{{$mess->sender?->name}}</b><br></span>
                                                            <span style="margin-top: 10px">{{ $mess->message }}</span>
                                                        @if($mess->file !== null)
                                                            <div class="form-group">
                                                                <a href="{{ route('tasks.messages.download', $mess) }}" download class="form-control text-bold">Просмотреть
                                                                    файл</a>
                                                            </div>
                                                        @endif
                                                            <span class="d-flex justify-content-end" style="font-size: 10px; margin-left: 100px; margin-top: 15px;margin-bottom: -25px">
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
                            <div class="card-footer">
                                <div class="message-form d-flex flex-direction-column align-items-center">
                                    <form id="formMessage" class="w-100" enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-flex flex-grow-1 ml-4">
                                            <div class="input-group mb-3">
                                                <input type="text" id="message" name="message" class="form-control" placeholder="Сообщение..." required>
                                                <div class="col-3">
                                                    <input type="file" name="file" class="form-control" id="file">
                                                </div>
                                                <button type="submit" class="btn btn-primary" id="messageBTN">
                                                    Отправить
                                                </button>
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
        <div class="modal" tabindex="-1" id="history">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Вся история задачи</h5>

                    </div>
                    <div class="modal-body">
                        <div class="row p-3">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist" style="border-radius: 20px">
                                    <li class="nav-item">
                                        <a style="border-radius: 5px; margin-top: -4px" class="nav-link active"
                                           id="custom-tabs-one-home-tab" data-bs-toggle="pill" href="#custom-tabs-one-home"
                                           role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">История задачи</a>
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
                                                    <td>{{$history->sender?->name }}
                                                        @if ($history->sender->hasRole('admin'))
                                                            (Админ)
                                                        @elseif ($history->sender->hasRole('user'))
                                                            (Сотрудник)
                                                        @elseif ($history->sender->hasRole('client') || $history->sender->hasRole('client-worker'))
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
                                                <td class="text-center">{{$task->created_at}}</td>
                                                <td class="text-center">{{$task->finish}}</td>
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
        <div class="modal fade" id="check{{$task->id}}" data-bs-backdrop="static"
             data-bs-keyboard="false" tabindex="-1" style="z-index: 9994"
             aria-labelledby="check{{$task->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{route('tasks.sendBack1', $task->id,)}}"
                          method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="modal-header">
                            <h1>Проверка</h1>
                            <button type="button" class="btn-close"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="employee">Отчёт о проделанной работе</label>
                                <textarea class="form-control"
                                          disabled>{{ $task->success_desc }} </textarea>
                            </div>
                            <div class="form-group">
                                <label for="employee">Исполнители</label>
                                <select name="employee" id="employee"
                                        class="form-control">
                                    <option disabled value="0" selected>Выберите
                                        исполнители
                                    </option>
                                    @foreach($users as $user)
                                        <option
                                            value="{{ $user->id }}">{{ $user->surname .' ' . $user->name .' '.$user->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">
                                Перенаправить
                            </button>
                            <button type="submit" class="btn btn-success">Готово
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal" id="delete{{$task->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Удадения задачи</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Действительно хотите удалить задачу</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('mon.delete', $task->id)}}" class="btn btn-danger" >Удалить задачу</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="sendBack{{$task->id}}" data-bs-backdrop="static"
             data-bs-keyboard="false" tabindex="-1" style="z-index: 9992"
             aria-labelledby="editRight{{$task->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{route('tasks.sendBack', $task->id,)}}"
                          method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editRight{{$task->id}}">
                                Предупреждение</h1>
                            <button type="button" class="btn-close"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="form-group">
                                    <label for="user">Сотрудник</label>
                                    <select name="user_id" id="user_id"
                                            class="form-select">
                                        @foreach($users as $user)
                                            <option
                                                value="{{ $user->id }}" {{ ($user->id === old('user_id') or $user->id === $task->user->id ) ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">
                                Перенаправить
                            </button>
                            <a href="{{route('mon.edit', $task->id)}}"
                               class="btn btn-primary">
                                Изменить
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('script')
    @routes
    <script>
        $(document).ready(function() {
            $('#file').change(function() {
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
                    url: "{{ route('tasks.message', $task->id) }}",
                    method: "POST",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        $('#message').val('');
                        $('#file').val('');

                        let fileUrl = route('tasks.messages.download', { mess: response.messages.id });
                        let newMessage = `
                                <div class="chat">
                                    <div class="chat-body" style="margin-right: 10px">
                                        <div class="chat-message">
                                            <p>
                                                <span><b>${response.name}</b><br></span>
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
@endsection
