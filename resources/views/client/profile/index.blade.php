@extends('client.layouts.app')

@section('title')
    Профиль клиента
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

        <button type="button" class="btn btn-outline-primary mb-2 mt-2" data-bs-toggle="modal" data-bs-target="#changePassword">
            Изменить пароль
        </button>
        @include('inc.messages')
        <section class="section">
            <div class="row pt-4">
                <div class="col-9">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('client_profile.update.a') }}" method="POST" enctype="multipart/form-data">
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
                                            <label for="file">Изображение</label>
                                            <input type="file" name="avatar" tabindex="5" class="form-control mt-3" id="file">
                                        </div>

                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="lastname">Отчество<span class="text-danger">*</span></label>
                                            <input type="text" id="lastname" name="lastname" tabindex="3" class="form-control mt-3" value="{{ $user->lastname }}" required>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" tabindex="6" class="btn btn-outline-primary">Изменить</button>
                                    </div>
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

                            <div class="d-flex justify-content-center mb-3">
                            </div>

                        </div>
                        <div class="card-body">
                            <h5 class="text-center">{{ $user->surname . ' ' .$user->name .' '. $user->lastname}}.</h5>
                            <div>
                                <table class="mt-3" cellpadding="5">
                                    <tr>
                                        <th>Проекты: </th>
                                        <th><span class="mx-2">{{ $user->projectCount() }}</span></th>
                                    </tr>
                                    <tr>
                                        <th>Задачи: </th>
                                        <th><span class="mx-2">{{ $user->taskCount(auth()->id()) }}</span></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changePassword" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('client_profile.password') }}" method="POST">
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
