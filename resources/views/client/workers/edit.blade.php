@extends('client.layouts.app')

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
                            <li class="breadcrumb-item"><a href="{{ route('client.workers.index') }}">Список сотрудников</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $user->surname .' '.$user->name.' '.$user->lastname }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        @include('inc.messages')
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('client.workers.index') }}" class="btn btn-outline-danger">
                        Назад
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('client.workers.update', $user->slug) }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" id="phone" name="phone" tabindex="5" class="form-control mt-3" value="{{ $user->phone }}" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="surname">Фамилия<span class="text-danger">*</span></label>
                                    <input type="text" id="surname" name="surname" tabindex="2" class="form-control mt-3" value="{{ $user->surname }}"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Пароль (password)<span class="text-danger">*</span></label>
                                    <input type="password" id="password" name="password" tabindex="7" class="form-control mt-3" value="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="lastname">Отчество<span class="text-danger">*</span></label>
                                    <input type="text" id="lastname" name="lastname" tabindex="3" class="form-control mt-3" value="{{ $user->lastname }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="file">Изображение</label>
                                    <input type="file" name="avatar" tabindex="11" class="form-control mt-3" id="file">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-outline-primary" tabindex="12">Изменить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

@endsection
