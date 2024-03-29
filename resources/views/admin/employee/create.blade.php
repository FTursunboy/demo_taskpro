@extends('admin.layouts.app')

@section('title')
    Добавление нового сотрудника
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Добавление нового сотрудника</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Список сотрудников</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Добавление нового сотрудника</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if($settings->max_users < $userscount)
            <h3>Максимальное количество пользователей достигнуто, Вы не можете создать больше</h3>
        @endif
        @include('inc.messages')

        @if($userscount >= $settings->max_users)
            <h5 style="color: red">Максимальное количество пользователей достигнуто, Вы не можете создать больше</h5>
        @endif
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('employee.index') }}" class="btn btn-outline-danger">
                        Назад
                    </a>
                </div>
                @if($settings?->has_access == false)
                    <h4 style="margin-left: 30px; color: red" class="offcanvas-title" id="ProjectOfCanvas">Вы не можете создать сотрудника. Пополните баланс!</h4>
                @endif
                <div class="card-body">
                    <form action="{{ route('employee.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Имя <span class="text-danger">*</span></label>

                                    <input {{$userscount >= $settings->max_users ? 'disabled' : ''}} type="text" id="name" name="name" tabindex="1" class="form-control mt-3"

                                           value="{{ old('name') }}" required>
                                </div>


                                <div class="form-group">
                                    <label for="login">Логин<span class="text-danger">*</span></label>

                                    <input {{$userscount >= $settings->max_users ? 'disabled' : ''}} type="text" id="login" name="login" tabindex="4" class="form-control mt-3"

                                           value="{{ old('login') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="otdel_id">Отдел<span class="text-danger">*</span></label>

                                    <select {{$userscount >= $settings->max_users ? 'disabled' : ''}} id="otdel_id" tabindex="7" name="otdel_id" class="form-select mt-3"

                                            required>
                                        <option value="" selected>Выбирите отдел</option>
                                        @foreach($departs as $depart)
                                            <option
                                                value="{{ $depart->id }}">{{ $depart->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="birthday">День рождение</label>

                                    <input {{$userscount >= $settings->max_users ? 'disabled' : ''}} type="date" name="birthday" tabindex="10" id="bithday" class="form-control mt-3" value="{{ old('birthday') }}">

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="surname">Фамилия<span class="text-danger">*</span></label>

                                    <input {{$userscount >= $settings->max_users ? 'disabled' : ''}} type="text" tabindex="2" id="surname" name="surname"

                                           class="form-control mt-3" value="{{ old('surname') }}"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Телефон<span class="text-danger">*</span></label>

                                    <input {{$userscount >= $settings->max_users ? 'disabled' : ''}} type="text" id="phone" name="phone" tabindex="5" class="form-control mt-3"

                                           value="{{ old('phone') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Пароль<span class="text-danger">*</span></label>

                                    <input {{$userscount >= $settings->max_users ? 'disabled' : ''}} type="password" id="password" tabindex="8" name="password"

                                           class="form-control mt-3" value="{{ old('password') }}" required>
                                </div>

                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="lastname">Отчество</label>

                                    <input {{$userscount >= $settings->max_users ? 'disabled' : ''}} type="text" tabindex="3" id="lastname" name="lastname"

                                           class="form-control mt-3" value="{{ old('lastname') }}">
                                </div>

                                <div class="form-group">
                                    <label for="position">Должность<span class="text-danger">*</span></label>

                                    <input {{$userscount >= $settings->max_users ? 'disabled' : ''}} type="text" id="position" name="position" class="form-control mt-3"

                                           tabindex="6" value="{{ old('position') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="telegram_id">Телеграм ID<span class="text-danger">*</span></label>

                                    <input {{$userscount >= $settings->max_users ? 'disabled' : ''}} type="number" id="telegram_id" name="telegram_id" tabindex="9"

                                           class="form-control mt-3" value="{{ old('telegram_id') }}" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">

                                <button {{$userscount >= $settings->max_users ? 'disabled' : ''}} type="submit" class="btn btn-outline-primary" tabindex="10">Сохранить</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

@endsection
