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
                            <li class="breadcrumb-item"><a href="{{ route('mon.index') }}">Панель</a></li>
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
                                                             <span style="display: flex; justify-content: space-between;">
                                                            <b>{{$mess->sender?->name}}</b>
                                                            <a style="color: red" href="{{route('offers.messages.delete', $mess->id)}}"><i class="bi bi-trash"></i></a>
                                                        </span>
                                                            <span style="margin-top: 10px">{{ $mess->message }}</span>
                                                        @if($mess->file !== null)
                                                            <div class="form-group">
                                                                <a href="{{ route('offers.messages.download', $mess) }}" download class="form-control text-bold">Просмотреть
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
                                                                <a href="{{ route('offers.messages.download', $mess) }}" download class="form-control text-bold">Просмотреть
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
                                                <input name="message" class="form-control"  id="message"
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
                        </div>
                    </div>
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
                            url: "{{ route('offers.message', $offer->id) }}",
                            method: "POST",
                            data: formData,
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                console.log(response)
                                $('#message').val('');
                                $('#file').val('');

                                let fileUrl = route('offers.messages.download', { mess: response.messages.id });
                                let del = route('offers.messages.delete', { mess: response.messages.id });
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
@endsection
