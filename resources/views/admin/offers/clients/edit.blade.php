@extends('admin.layouts.app')

@section('title')
    Изменение сотрудника
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $user->surname .' '.$user->name.' '.$user->lastname }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Список сотрудников</a>
                            </li>
                            <li class="breadcrumb-item active"
                                aria-current="page">{{ $user->surname .' '.$user->name.' '.$user->lastname }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        @include('inc.messages')
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('employee.client') }}" class="btn btn-outline-danger">
                        Назад
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('employee.client.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Имя <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control mt-3"
                                           value="{{ $user->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="role">Роль<span class="text-danger">*</span></label>
                                    <select id="role" name="role" class="form-select mt-3" required>
                                        <option value="" selected>Выбирите роль</option>
                                        @foreach($roles as $role)
                                            <option
                                                value="{{ $role->id }}" {{ ($role->name === 'client') ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="login">Логин<span class="text-danger">*</span></label>
                                    <input type="text" id="login" name="login" class="form-control mt-3"
                                           value="{{ $user->login }}" disabled>
                                </div>

                            </div>
                            <div class="col-4">

                                <div class="form-group">
                                    <label for="surname">Фамилия<span class="text-danger">*</span></label>
                                    <input type="text" id="surname" name="surname" class="form-control mt-3"
                                           value="{{ $user->surname }}"
                                           required>
                                </div>


                                <div class="form-group">
                                    <label for="phone">Телефон<span class="text-danger">*</span></label>
                                    <input type="text" id="phone" name="phone" class="form-control mt-3"
                                           value="{{ $user->phone }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Пароль (password)<span class="text-danger">*</span></label>
                                    <input type="password" id="password" name="password" class="form-control mt-3">
                                </div>

                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="lastname">Отчество<span class="text-danger">*</span></label>
                                    <input type="text" id="lastname" name="lastname" class="form-control mt-3"
                                           value="{{ $user->lastname }}" required>
                                </div>


                                <div class="form-group">
                                    <label for="project_id">Проект<span class="text-danger">*</span></label>
                                    <select id="project_id" name="project_id" class="form-select mt-3" required>
                                        <option value="" selected>Выбирите проект</option>
                                        @foreach($projects as $project)
                                            <option
                                                value="{{ $project->id }}" {{ ($project->id === $project_id->project_id) ? 'selected' : '' }}>{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="telegram_id">Телеграм ID<span class="text-danger">*</span></label>
                                    <input type="number" id="telegram_id" name="telegram_id" class="form-control mt-3"
                                           value="{{ $user->telegram_user_id }}" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-outline-primary">Изменить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

@endsection
