@extends('client.layouts.app')
@section('content')

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 order-md-1 order-last">
                            <h3>Сотрудники</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <a href="#" class="btn btn-outline-primary mb-2" data-bs-target="#store" data-bs-toggle="modal">
                                Добавить нового сотрудника
                            </a>
                        </div>

                    </div>
                </div>
                @include('inc.messages')
                <section class="section">
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
                                                    <th>Задачи:</th>
                                                    <th><span class="mx-2">{{ $user->taskClientCount($user->id) }}</span></th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{route('client.workers.show', $user->id)}}" class="btn btn-success mx-2"><i class="bi bi-eye"></i></a>

                                            <a href="{{ route('client.workers.edit', $user->slug) }}" class="btn btn-primary mx-2">
                                                <i class="bi bi-pencil"></i></a>
                                            <a role="button" class="btn btn-danger" data-bs-toggle="modal"
                                               data-bs-target="#delete{{$user->slug}}"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="delete{{$user->slug}}" tabindex="-1" aria-labelledby="delete{{$user->slug}}"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('client.workers.destroy', $user->slug) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="delete{{$user->slug}}">Предупреждение</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Точно хотите удалить
                                                <b>'{{ $user->surname.' '. $user->name.' '. $user->lastname }}'</b>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет
                                                </button>
                                                <button type="submit" class="btn btn-danger">Да, хочу уалить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <div class="modal fade" id="store" tabindex="-1" aria-labelledby="store" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('client.workers.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="employeeLabel">Добавления сотрудника</h1>
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
                                            <label for="name" class="form-label">Имя  Сотрудника <span
                                                    class="text-danger">*</span></label>
                                            <input required type="text" name="name" class="form-control"
                                                   placeholder="Введите имя сотрудника" id="name" value="{{ old('name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="form-label">Фамилия Сотрудника<span
                                                    class="text-danger">*</span></label>
                                            <input  type="text" name="surname" class="form-control"
                                                    placeholder="Введите фамилию" id="surname"
                                                    value="{{ old('surname') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname" class="form-label">Отчество Сотрудника<span
                                                    class="text-danger">*</span></label>
                                            <input  type="text" name="lastname" class="form-control"
                                                    placeholder="Введите отчество" id="lastname"
                                                    value="{{ old('lastname') }}" required>
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
                                                   id="password" required>
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


