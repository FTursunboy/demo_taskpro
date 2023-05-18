@extends('client.layouts.app')
@section('content')

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Задачи</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('offers.index')}}">Задачи</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                @include('inc.messages')
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" href="#" data-bs-target="#store" data-bs-toggle="modal" class="btn btn-success">Добавить</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Логин</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->lastname}}</td>
                                    <td>{{$user->login}}</td>
                                    <td>
                                        <a href="{{route('client.workers.show', $user->id)}}" class="badge bg-primary"><i class="bi bi-eye"></i></a>
                                        <a href="" class="badge bg-success"><i class="bi bi-pencil"></i></a>
                                        <a href="" class="badge bg-danger"><i class="bi bi-trash"></i></a>
                                    </td>
                                    </tr>
                                @empty
                                    <td  colspan="5"><h1 class="text-center">Пока нет сотрудников</h1></td>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
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
                                            <input  type="text" name="lastname" class="form-control"
                                                    placeholder="Введите фамилию" id="surname"
                                                    value="{{ old('surname') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="form-label">Email Сотрудника<span
                                                    class="text-danger">*</span></label>
                                            <input  type="email" name="email" class="form-control"
                                                    placeholder="Введите email" id="email"
                                                    value="{{ old('email') }}" required>
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


