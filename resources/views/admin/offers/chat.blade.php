@extends('admin.layouts.app')

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
                    <a href="{{ route('client.offers.index') }}" class="btn btn-outline-danger">Назад</a>
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
                                                            <span><b>{{$mess->sender?->name}}</b><br></span>
                                                            <span style="margin-top: 10px">{{ $mess->message }}</span>
                                                        @if($mess->file !== null)
                                                            <div class="form-group">
                                                                <a href="{{ route('client.offers.messages.download', $mess) }}" download class="form-control text-bold">Просмотреть
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
                                            <div class="chat chat-left id">
                                                <div class="chat-body">
                                                    <div class="chat-message">
                                                        <p>
                                                            <span><b>{{$mess->sender?->name}}</b><br></span>
                                                            <span style="margin-top: 10px">{{ $mess->message }}</span>
                                                        @if($mess->file !== null)
                                                            <div class="form-group">
                                                                <a href="{{ route('client.offers.messages.download', $mess) }}" download class="form-control text-bold">Просмотреть
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

                            @if($offer->user_id && $offer->status_id != 3)
                            <div class="card-footer">
                                <div class="message-form d-flex flex-direction-column align-items-center">
                                    <form class="w-100" action="{{ route('client.offers.chat.store', $offer->id) }}"
                                          method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-flex flex-grow-1 ml-4">
                                            <div class="input-group mb-3">
                                                <input type="text" name="message" class="form-control" placeholder="Сообщение..." id="message" required>
                                                <div class="col-3">
                                                    <input type="file" name="file" class="form-control" id="fileInput">
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

@endsection

@section('script')
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#fileInput').change(function() {
                        const selectedFile = $(this).prop('files')[0];
                        if (selectedFile) {
                            $('#message').val('Файл');
                        } else {
                            $('#message').val('');
                        }
                    });
                });
            </script>
@endsection
