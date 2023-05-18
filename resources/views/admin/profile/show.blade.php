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
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('profile.index') }}">Профиль - {{ $user->surname . ' ' . $user->name.' '. $user->lastname }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Просмотр профиля</li>
            </ol>
        @include('inc.messages')
        <section class="section">
            <div class="card">
                <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    @if(isset($user->avatar))
                                        <img style="border-radius: 50% " id="avatar" onclick="img()" src="{{ \Illuminate\Support\Facades\Storage::url($user->avatar) }}" alt="" width="100" height="100">
                                    @else
                                        <img style="border-radius: 50% " id="avatar" onclick="img()" src="{{ asset('assets/images/logo/favicon.svg') }}" alt="" width="100" height="100">
                                    @endif
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
                </div>
            </div>
        </section>
    </div>


@endsection
