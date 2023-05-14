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
                                <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Панел</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $task->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="row my-4">
                    <div class="col-6">
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-danger">Назад</a>
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
                    <div class="collapse my-3" id="collapseExample{{ $task->id }}">
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
                                        <a href="#" download class="form-control text-bold">Просмотреть
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
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control  bg-primary text-white"
                                               id="sts" value="{{ $task->status?->name }}" disabled>
                                    </div>


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
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @if($task->status->name === "Принято")
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
                                        @if($mess->sender_id === \Illuminate\Support\Facades\Auth::id())
                                            <div class="chat">
                                                <div class="chat-body" style="margin-right: 10px">
                                                    <div class="chat-message">{{ $mess->message }}</div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="chat chat-left">
                                                <div class="chat-body">
                                                    <div class="chat-message">{{ $mess->message }}</div>
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
                                    <form class="w-100" action="{{ route('tasks.message', $task->id) }}"
                                          method="POST">
                                        @csrf
                                        <div class="d-flex flex-grow-1 ml-4">
                                            <div class="input-group mb-3">
                                                <textarea name="message" class="form-control" rows="1" id="message"
                                                          placeholder="Сообщение..." required></textarea>
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
                @endif
            </div>
        </div>

@endsection
