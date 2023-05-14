@extends('client.layouts.app')

@section('title')
    Чат
@endsection

@section('content')


    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3></h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Панел</a></li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="row my-4">
                <div class="col-6">
                    <a href="{{ route('offers.index') }}" class="btn btn-outline-danger">Назад</a>
                </div>
            </div>
            <div class="row">
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
                                        <h6 class="mb-0">{{ $offer->user?->name }} {{ $offer->user?->surname }}</h6>
                                        <span class="text-xs">Online</span>
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
                                                            <span >{{$mess->sender?->name}}</span><span style="color: red; font-size: 11px"> {{date('d.m.Y H:i:s', strtotime($mess->created_at))}}<br></span>
                                                            {{ $mess->message }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="chat chat-left id">
                                                <div class="chat-body">
                                                    <div class="chat-message">
                                                        <p>
                                                            <span >{{$mess->sender?->name}}</span><span style="color: red; font-size: 11px"> {{date('d.m.Y H:i:s', strtotime($mess->created_at))}}<br></span>
                                                            {{ $mess->message }}
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
                                    <form class="w-100" action="{{ route('offers.message', $offer->id) }}"
                                          method="POST">
                                        @csrf
                                        <div class="d-flex flex-grow-1 ml-4">
                                            <div class="input-group mb-3">
                                                <input name="message" class="form-control"  id="message"
                                                          placeholder="Сообщение..." required>
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

@endsection
@section('script')
            <script>
                // Функция для получения сообщений с сервера
                function fetchMessages() {
                    $.ajax({
                        url: '{{ route('offers.messages', $offer->id) }}',
                        type: 'GET',
                        dataType: 'json',
                        success: function(messages) {
                            // Очистка содержимого чата
                            $('#chat').empty();

                            // Добавление сообщений в чат
                            messages.forEach(function(message) {
                                $('#chat').append('<div>' + message.message + '</div>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }

                // Обработчик отправки сообщения
                $('#message-form').submit(function(event) {
                    event.preventDefault();

                    var message = $('#message-input').val();

                    // Отправка сообщения через AJAX
                    $.ajax({
                        url: '{{ route('offers.messages.store', $offer->id) }}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            message: message
                        },
                        success: function(response) {
                            // Очистка поля ввода после успешной отправки
                            $('#message-input').val('');

                            // Обновление чата для отображения нового сообщения
                            fetchMessages();
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });

                // Загрузка сообщений при загрузке страницы
                $(document).ready(function() {
                    fetchMessages();
                });
            </script>
@endsection
