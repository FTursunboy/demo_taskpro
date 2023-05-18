@extends('admin.layouts.app')

@section('title')
    Профиль админа
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $user->surname .' '.$user->name.' '.$user->lastname }}</h3>
                </div>
            </div>
        </div>

        @include('inc.messages')
        <section class="section">
            <div class="card">
                <div class="card-body">
{{--                    <form action="{{ route('profile.update', auth()->id()) }}" method="POST" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        @method('PATCH')--}}
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <img id="avatar" onclick="img()" src="{{  \Illuminate\Support\Facades\Storage::url($user->avatar)  }}" alt="{{ $user->name }}" style="border-radius: 50%">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Имя <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" tabindex="1" class="form-control mt-3"
                                           value="{{ $user->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Отчество<span class="text-danger">*</span></label>
                                    <input type="text" id="lastname" name="lastname" tabindex="3" class="form-control mt-3" value="{{ $user->lastname }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="telegram_user_id">Телеграм id</label>
                                    <input required value="{{ $user->telegram_user_id }}" type="number" name="telegram_id"
                                           class="form-control mt-3" placeholder="Telegram id"
                                           id="telegram_id" disabled>
                                </div>

                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="surname">Фамилия<span class="text-danger">*</span></label>
                                    <input type="text" id="surname" name="surname" tabindex="2" class="form-control mt-3" value="{{ $user->surname }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="surname">Отдел<span class="text-danger">*</span></label>
                                    <input type="text" id="otdel_id" name="otdel_id" tabindex="2" class="form-control mt-3" value="{{ $otdel->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Телефон<span class="text-danger">*</span></label>
                                    <input type="text" id="phone" name="phone" tabindex="4" class="form-control mt-3" value="{{ $user->phone }}" disabled>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('profile.edit', $user->id) }}"><button type="submit" tabindex="8" class="btn btn-outline-primary">Изменить</button></a>
                            </div>
                        </div>
{{--                    </form>--}}
                </div>
            </div>
        </section>
    </div>

    <style>
        #avatar{
            width: 300px;
            height: 300px;
            transition: width 0.3s;
            cursor: pointer;
        }

        #avatar.large{
            width: 40%;
            height: 70%;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }
    </style>

    <script>
        function img(){
            var img = document.getElementById("avatar");
            img.classList.toggle("large")
        }
    </script>

@endsection
