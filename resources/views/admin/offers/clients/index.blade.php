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
                                @if(isset($user->avatar))
                                    <img style="border-radius: 50% " src="{{ \Illuminate\Support\Facades\Storage::url($user->avatar) }}" alt="" width="100" height="100" >
                                @else
                                    <img style="border-radius: 50% " src="{{ asset('assets/images/logo/favicon.svg') }}" alt="" width="100" height="100">
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="text-center">{{ $user->surname . ' ' . $user->name .' '. $user->lastname}}</h5>
                            <div>
                                <table class="mt-3" cellpadding="5">
                                    <tr>
                                        <th>Отправлено задач: </th>
                                        <th><span class="mx-2">{{ $user->offers_count }}</span></th>
                                    </tr>
                                    <tr>
                                        <th>Принято задач :</th>
                                        <th><span class="mx-2">{{ ($user->status2_count) ? $user->status2_count : 0 }}</span></th>
                                    </tr>
                                    <tr>
                                        <th>Проект: </th>
                                        <th><span class="mx-2"> 1</span></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('employee.client.show', $user->slug) }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('employee.client.edit', $user->slug) }}" class="btn btn-primary mx-2"><i class="bi bi-pencil"></i></a>
                                <a role="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$user->slug}}"><i class="bi bi-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="delete{{$user->slug}}" tabindex="-1" aria-labelledby="delete{{$user->slug}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('employee.client.destroy', $user->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="delete{{$user->slug}}">Предупреждение</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Точно хотите удалить <b>'{{ $user->surname . ' ' .$user->name.' ' .$user->lastname  }}'</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                    <button type="submit" class="btn btn-danger">Да</button>
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
                                    <input required type="text" name="name" tabindex="1" class="form-control"
                                           placeholder="Введите имя клиента" id="name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="form-label">Отчество Клиента</label>
                                    <input  type="text" name="lastname" tabindex="3" class="form-control"
                                            placeholder="Введите отчество" id="surname"
                                            value="{{ old('lastname') }}">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Пароль</label>
                                    <input type="password" name="password" tabindex="5" class="form-control" placeholder="Пароль"
                                           id="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="telegram_id" class="form-label">Телеграм id <span
                                            class="text-danger">*</span></label>
                                    <input required value="{{old('telegram_id')}}" tabindex="7" type="number" name="telegram_id"
                                           class="form-control" placeholder="Telegram id"
                                           id="telegram_id">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="surname" class="form-label">Фамилия Клиента<span
                                            class="text-danger">*</span></label>
                                    <input  type="text" name="surname" tabindex="2" class="form-control"
                                            placeholder="Введите фамилию" id="surname"
                                            value="{{ old('surname') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="login" class="form-label">Логин <span
                                            class="text-danger">*</span></label>
                                    <input required type="text" name="login" tabindex="4" class="form-control" placeholder="Login"
                                           id="login"
                                           value="{{ old('login') }}">
                                </div>
                                <div class="form-group">
                                    <label for="project_id" class="form-label">Проект</label>
                                    <select name="project_id" tabindex="6" class="form-select" id="" required>
                                        <option value="">Выберите проект</option>
                                        @foreach($projects as $project)
                                            <option value="{{$project->id}}">{{$project->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="form-label">Телефон <span
                                            class="text-danger">*</span></label>
                                    <input required type="text" tabindex="8" name="phone" class="form-control" placeholder="Телефон"
                                           id="phone" value="{{ old('phone') }}">
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" tabindex="10" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" tabindex="11" class="btn btn-primary" id="create">Добавить</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('script')
@endsection













