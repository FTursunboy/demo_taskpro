@extends('user.layouts.app')

@section('title'){{ $user->surname . ' ' . $user->name.' '. $user->lastname }}@endsection


@section('content')
    <div id="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Профиль</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Профиль /</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            
            <div class="row">
                <div class="col-9">

                    <button type="button" class="btn btn-outline-primary mb-3 mt-2" data-bs-toggle="modal" data-bs-target="#changePassword">
                        Изменить пароль
                    </button>

                    @include('inc.messages')

                    <div class="card">
                        <div class="card-header">
                            <h3>Список сотрудников</h3>
                        </div>
                        <div class="card-body">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ФИО</th>
                                    <th>Должность</th>
                                    <th>Телефон</th>
                                    <th>Прогресс (макс: 1000)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr style=" {{ ($employee->id === \Illuminate\Support\Facades\Auth::user()->id) ? "background-color: rgba(66,93,190,0.27)" : ''  }}" >
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $employee->surname. ' '. $employee->name.' '. $employee->lastname }}</td>
                                        <td>{{ $employee->position }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>
                                            @switch($employee->xp)
                                                @case($employee->xp > 0 && $employee->xp <= 99 )
                                                    <div class="progress progress-success progress-sm" title="{{ $employee->xp }}xp">
                                                        <div class="progress-bar" role="progressbar" style="width: {{ $employee->xp / 10 }}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    @break
                                                @case($employee->xp > 99 && $employee->xp < 299 )
                                                    <div class="progress progress-success progress-sm" title="{{ $employee->xp }}xp">
                                                        <div class="progress-bar" role="progressbar" style="width: {{ $employee->xp / 10 }}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    @break
                                                @case($employee->xp > 299 && $employee->xp < 700 )
                                                    <div class="progress progress-success progress-sm" title="{{ $employee->xp }}xp">
                                                        <div class="progress-bar" role="progressbar" style="width: {{ $employee->xp / 10 }}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    @break
                                                @case($employee->xp > 699 && $employee->xp < 1000 )
                                                    <div class="progress progress-success progress-sm" title="{{ $employee->xp }}xp">
                                                        <div class="progress-bar" role="progressbar" style="width: {{ $employee->xp / 10 }}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    @break
                                            @endswitch

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div id="page-heading">
                        <p>
                            <button
                                class="btn btn-primary w-100 collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseExample{{ $user->id }}" aria-expanded="false"
                                aria-controls="collapseExample"><span
                                    class="d-flex justify-content-start"><i
                                        class="bi bi-info-circle mx-2"></i> <span>Изменение профиля</span> </span>
                            </button>
                        </p>
                      <div class="collapse my-3" id="collapseExample{{ $user->id }}">
                        <section class="section">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('user_profile.update.a') }}" method="POST" enctype="multipart/form-data">
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
                                                    <label for="login">Логин<span class="text-danger">*</span></label>
                                                    <input type="text" id="login" name="login" tabindex="4" class="form-control mt-3"
                                                           value="{{ $user->login }}" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="otdel_id">Отдел<span class="text-danger">*</span></label>
                                                    <select id="otdel_id" name="otdel_id" tabindex="7" class="form-select mt-3" required disabled>
                                                        @foreach($departs as $depart)
                                                            <option value="{{ $depart->id }}" {{ ($depart->id === $user->otdel_id) ? 'selected' : '' }}>{{ $depart->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">

                                                <div class="form-group">
                                                    <label for="surname">Фамилия<span class="text-danger">*</span></label>
                                                    <input type="text" id="surname" name="surname" tabindex="2" class="form-control mt-3" value="{{ $user->surname }}"
                                                           required>
                                                </div>


                                                <div class="form-group">
                                                    <label for="phone">Телефон<span class="text-danger">*</span></label>
                                                    <input type="text" id="phone" name="phone" tabindex="5" class="form-control mt-3" value="{{ $user->phone }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="telegram_id">Телеграм ID<span class="text-danger">*</span></label>
                                                    <input type="number" id="telegram_id" name="telegram_user_id" tabindex="8" class="form-control mt-3" value="{{ $user->telegram_user_id }}" disabled>
                                                </div>

                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="lastname">Отчество<span class="text-danger">*</span></label>
                                                    <input type="text" id="lastname" name="lastname" tabindex="3" class="form-control mt-3" value="{{ $user->lastname }}" required>
                                                </div>


                                                <div class="form-group">
                                                    <label for="position">Должность<span class="text-danger">*</span></label>
                                                    <input type="text" id="position" name="position" tabindex="6" class="form-control mt-3" value="{{ $user->position }}" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="file">Изображение</label>
                                                    <input type="file" name="avatar" tabindex="10" class="form-control mt-3" id="file">
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="submit" tabindex="11" class="btn btn-outline-primary">Изменить</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                      </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changePassword" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('user_profile.password') }}" method="POST">
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
                                                <label for="password_confirmation">Повторите пароль <span class="text-danger">*</span></label>
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

                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-center mb-3">
                                @if(isset(Auth::user()->avatar))
                                    <img style="border-radius: 50% " id="avatar" onclick="img()" src="{{ asset('storage/'.\Illuminate\Support\Facades\Auth::user()->avatar)}}" alt="" width="100" height="100">
                                @else
                                    <img style="border-radius: 50% " id="avatar" onclick="img()" src="{{ asset('assets/images/logo/favicon.svg') }}" alt="" width="100" height="100">
                                @endif
                            </div>

                            @switch($user->xp)
                                @case($user->xp > 0 && $user->xp <= 99 )
                                    <div>
                                        <div class="d-flex justify-content-end">
                                            {{ $user->xp }} / 100
                                        </div>
                                    </div>
                                    <div class="progress mt-3">
                                        <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                             style="width: {{ $user->xp }}%" aria-valuenow="{{ $user->xp }}"
                                             aria-valuemin="0"
                                             aria-valuemax="300"></div>
                                    </div>
                                    @break
                                @case($user->xp > 99 && $user->xp < 299 )
                                    <div>
                                        <div class="d-flex justify-content-end">
                                            {{ $user->xp }} / 300 (xp)
                                        </div>
                                    </div>
                                    <div class="progress mt-3">
                                        <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                             style="width: {{$user->xp/3}}%" aria-valuenow="{{ $user->xp }}"
                                             aria-valuemin="0"
                                             aria-valuemax="300"></div>
                                    </div>
                                    @break
                                @case($user->xp > 299 && $user->xp < 700 )
                                    <div>
                                        <div class="d-flex justify-content-end">
                                            {{ $user->xp }}xp / 700 (xp)
                                        </div>
                                    </div>
                                    <div class="progress mt-3">
                                        <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                             style="width: {{$user->xp / 7}}%" aria-valuenow="{{ $user->xp }}"
                                             aria-valuemin="0"
                                             aria-valuemax="700"></div>
                                    </div>
                                    @break
                                @case($user->xp > 699 && $user->xp < 1000 )
                                    <div>
                                        <div class="d-flex justify-content-end">
                                            {{ $user->xp }} / 1000 (xp)
                                        </div>
                                    </div>
                                    <div class="progress mt-3">
                                        <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                             style="width: {{$user->xp / 10}}%" aria-valuenow="{{ $user->xp }}"
                                             aria-valuemin="0"
                                             aria-valuemax="1000"></div>
                                    </div>
                                    @break
                            @endswitch

                        </div>
                        <div class="card-body">
                            <h5 class="text-center">{{ $user->surname . ' ' . $user->name .' '. $user->lastname}}</h5>
                            <div>
                                <table class="mt-3" cellpadding="5">
                                    <tr>
                                        <th>Задачи:</th>
                                        <th><span class="mx-2">{{ $user->taskCount($user->id) }}</span></th>
                                    </tr>
                                    <tr>
                                        <th>Готовые :</th>
                                        <th><span class="mx-2">{{ $user->taskSuccessCount($user->id) }}</span></th>
                                    </tr>
                                    <tr>
                                        <th>Идеи :</th>
                                        <th><span class="mx-2"> {{ $user->ideaCount($user->id) }}</span></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
