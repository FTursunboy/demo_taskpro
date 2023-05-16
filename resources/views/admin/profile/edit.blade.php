@extends('admin.layouts.app')

@section('title')
    Профиль админа
@endsection

@section('content')

    <div class="card-header">
        <a href="{{ route('profile.index') }}" class="btn btn-outline-danger">
            Назад
        </a>
    </div>

    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $user->surname .' '.$user->name.' '.$user->lastname }}</h3>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-outline-primary mb-2 mt-2" data-bs-toggle="modal" data-bs-target="#changePassword">
            Изменить пароль
        </button>

            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('profile.index') }}">Профиль - {{ $user->surname . ' ' . $user->name.' '. $user->lastname }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Обновление профиля</li>
                </ol>
            </nav>
        @include('inc.messages')
        <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('profile.update', auth()->id()) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Имя <span class="text-danger">*</span></label>
                                            <input type="text" id="name" name="name" tabindex="1" class="form-control mt-3"
                                                   value="{{ $user->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Телефон<span class="text-danger">*</span></label>
                                            <input type="text" id="phone" name="phone" tabindex="4" class="form-control mt-3" value="{{ $user->phone }}" required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="surname">Фамилия<span class="text-danger">*</span></label>
                                            <input type="text" id="surname" name="surname" tabindex="2" class="form-control mt-3" value="{{ $user->surname }}"
                                                   required>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname">Отдел<span class="text-danger">*</span></label>
                                            <select name="otdel_id" id="otdel_id" tabindex="5" class="form-control mt-3">
                                                <option value="{{ $otdel->id }}" selected>{{ $otdel->name }}</option>
                                                @foreach($otdels as $otdel)
                                                    <option value="{{ $otdel->id }}">{{ $otdel->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="lastname">Отчество<span class="text-danger">*</span></label>
                                            <input type="text" id="lastname" name="lastname" tabindex="3" class="form-control mt-3" value="{{ $user->lastname }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telegram_user_id">Телеграм id</label>
                                            <input required value="{{ $user->telegram_user_id }}" tabindex="6" type="number" name="telegram_id"
                                                   class="form-control mt-3" placeholder="Telegram id"
                                                   id="telegram_id">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="file">Изображение</label>
                                                <input type="file" name="avatar" tabindex="7" class="form-control mt-3" id="file">
                                            </div>
                                        </div>
                                        <div class="col-6"></div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" tabindex="8" class="btn btn-outline-primary">Обновить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
        </section>
    </div>
    <div class="modal fade" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changePassword" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('edit_profile.password') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="changePassword">Изменить пароль</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="oldPassword">Старый пароль <span class="text-danger">*</span></label>
                                    <input type="password" name="oldPassword" id="oldPassword" class="form-control" placeholder="Введите старый пароль">
                                </div>
                                <div class="form-group">
                                    <label for="password">Новый пароль <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Введите новый пароль">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Павторите пароль <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Повторите новый пароль">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
