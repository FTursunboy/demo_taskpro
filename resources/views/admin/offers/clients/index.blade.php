@extends('admin.layouts.app')

@section('title')Клиенты@endsection


@section('content')
    <div id="page-heading">
        <a href="#" data-bs-target="#employee" data-bs-toggle="modal" class="btn btn-outline-primary mb-2">
            Добавить нового клиента
        </a>
        @include('inc.messages')

        <div class="row pt-4">
            @foreach($users as $user)
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-center mb-3">
                                <img src="{{ asset('assets/images/avatar-2.png') }}" alt="" width="100" height="100">
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
                                         style="width: {{ $user->xp }}%" aria-valuenow="{{ $user->xp }}" aria-valuemin="0"
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
                                         style="width: {{$user->xp/3}}%" aria-valuenow="{{ $user->xp }}" aria-valuemin="0"
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
                                         style="width: {{$user->xp / 7}}%" aria-valuenow="{{ $user->xp }}" aria-valuemin="0"
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
                                         style="width: {{$user->xp / 10}}%" aria-valuenow="{{ $user->xp }}" aria-valuemin="0"
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
                                        <th>Tasks: </th>
                                        <th><span class="mx-2">{{ $user->taskCount($user->id) }}</span></th>
                                    </tr>
                                    <tr>
                                        <th>success :</th>
                                        <th><span class="mx-2">{{ $user->taskSuccessCount($user->id) }}</span></th>
                                    </tr>
                                    <tr>
                                        <th>Idea :</th>
                                        <th><span class="mx-2"> {{ $user->ideaCount($user->id) }}</span></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('employee.client.show', $user->id) }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('employee.client.edit', $user->id) }}" class="btn btn-primary mx-2"><i class="bi bi-pencil"></i></a>
                                <a role="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$user->id}}"><i class="bi bi-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" aria-labelledby="delete{{$user->id}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('employee.client.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="delete{{$user->id}}">Предупреждение</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Точно хотите удалить <b>'{{ $user->surname . ' ' .$user->name.' ' .$user->lastname  }}'</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Да, </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>


    </div>

    @if (count($errors) > 0)

        <script type="text/javascript">
            @if ($errors->has('name')||$errors->has('login') || $errors->has('password') || $errors->has('role') || $errors->has('login') || $errors->has('otdel') || $errors->has('surname') || $errors->has('phone') || $errors->has('position') || $errors->has('telegram_id'))
            document.addEventListener('DOMContentLoaded', function () {
                $('#employee').modal('show');
            });
            @endif
        </script>
    @endif





    <div class="modal fade" id="employee" tabindex="-1" aria-labelledby="employee" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('employee.client.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="employeeLabel">Добавления клиента</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger" id="err">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <script>
                                setInterval(() => {
                                    document.getElementById('err').remove()
                                }, 2500)
                            </script>
                        @endif
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Имя  Клиента <span
                                            class="text-danger">*</span></label>
                                    <input required type="text" name="name" class="form-control"
                                           placeholder="Введите имя клиента" id="name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="surname" class="form-label">Фамилия Клиента<span
                                            class="text-danger">*</span></label>
                                    <input  type="text" name="lastname" class="form-control"
                                            placeholder="Введите фамилию" id="surname"
                                            value="{{ old('surname') }}">
                                </div>
                                <div class="form-group">
                                    <label for="telegram_id" class="form-label">Телеграм id</label>
                                    <input required value="{{old('telegram_id')}}" type="number" name="telegram_id"
                                           class="form-control" placeholder="Telegram id"
                                           id="telegram_id">
                                </div>
                                <div class="form-group">
                                    <select name="project_id" class="form-select" id="">
                                        <option value="">Выберите проект</option>
                                        @foreach($projects as $project)
                                            <option value="{{$project->id}}">{{$project->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="login" class="form-label">Логин <span
                                            class="text-danger">*</span></label>
                                    <input required type="text" name="login" class="form-control" placeholder="Login"
                                           id="login"
                                           value="{{ old('login') }}">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Пароль</label>
                                    <input type="password" name="password" class="form-control" placeholder="Пароль"
                                           id="password">
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="form-label">Телефон <span
                                            class="text-danger">*</span></label>
                                    <input required type="text" name="phone" class="form-control" placeholder="Телефон"
                                           id="phone" value="{{ old('phone') }}">
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary" id="create">Добавить</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('script')
@endsection













