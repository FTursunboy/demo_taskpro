@extends('user.layouts.app')

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
                                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Панель</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $task->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="row my-4">
                    <div class="col-6">
                        <a href="{{ route('user.index') }}" class="btn btn-outline-danger">Назад</a>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop{{ $task->id }}">Я сделал задачу
                        </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop{{ $task->id }}" data-bs-backdrop="static"
                         data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{ $task->id }}"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('task-list.ready', $task->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5"
                                            id="staticBackdropLabel{{ $task->id }}">{{ $task->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea class="form-control" name="success_desc" placeholder="Отчёт проделанной работы" required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Отмена
                                        </button>
                                        <button type="submit" class="btn btn-primary">Отправить!
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <p>
                        <button
                            class="btn btn-{{ ($task->status->name === "Принято") ? 'primary': 'info' }} w-100 collapsed"
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
                                    <label for="comment">Комментария</label>
                                    <textarea type="text" id="comment" class="form-control" disabled
                                              rows="1">{{ $task->comment }}</textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="sts">Статус</label>
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control  bg-{{($task->status->name === "Принято")?'success':'info'}} text-black"
                                               id="sts" value="{{ $task->status->name }}" disabled>
                                    </div>


                                    <div class="form-group">
                                        <label for="type">Тип</label>
                                        <input type="text" id="type" class="form-control"
                                               value="{{ $task->type?->name }} {{  (isset($task->typeType->name)) ? '- '.$task->typeType->name : '' }}"
                                               disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Автор</label>
                                        <input type="text" id="author" class="form-control"
                                               value="{{ $task->author->name .' '. $task->author->surname}}"
                                               disabled>
                                    </div>
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
                                        <h6 class="mb-0">Admin</h6>
                                        <span class="text-xs">Online</span>
                                    </div>
                                </div>
                            </div>
                                <div class="card-body pt-4 bg-grey" >
                                    <div class="chat-content" style="overflow-y: scroll; height: 300px" id="block">
                                        @foreach($messages as $mess)
                                            @if($mess->sender_id === \Illuminate\Support\Facades\Auth::id())
                                                <div class="chat">
                                                    <div class="chat-body" style="margin-right: 10px">
                                                        <div class="chat-message">
                                                            <p>
                                                                <span><b>{{$mess->sender?->name}}</b><br></span>
                                                                <span style="margin-top: 10px">{{ $mess->message }}</span>
                                                            @if($mess->file !== null)
                                                                <div class="form-group">
                                                                    <a href="{{ route('user.download', $task) }}" download class="form-control text-bold">Просмотреть
                                                                        файл</a>
                                                                </div>
                                                            @endif
                                                                <span class="d-flex justify-content-end" style="font-size: 11px; margin-left: 100px; margin-top: 15px;margin-bottom: -25px">
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
                                                                    <a href="{{ route('user.download', $task) }}" download class="form-control text-bold">Просмотреть
                                                                        файл</a>
                                                                </div>
                                                            @endif
                                                                <span class="d-flex justify-content-end" style="font-size: 11px; margin-left: 100px; margin-top: 15px;margin-bottom: -25px">
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
                            @if($task->status->id !== 3)
                                <div class="card-footer">
                                    <div class="message-form d-flex flex-direction-column align-items-center">
                                        <form id="formMessage" class="w-100" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="d-flex flex-grow-1 ml-4">
                                                <div class="input-group mb-3">
                                                    <input id="message" type="text" name="message" class="form-control"
                                                           placeholder="Сообщение..." required>
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
                            @endif
                        </div>
                    </div>
                </div>
            </section>
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
                    url: "{{ route('messages.messages', $task->id) }}",
                    method: "POST",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        $('#message').val(' ');
                        $('#file').val('');

                        let fileUrl = route('user.downloadChat', { task: response.messages.id });
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

