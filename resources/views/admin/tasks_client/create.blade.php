@extends('admin.layouts.app')

@section('title')
    Создание новой задачи
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Добавление задач</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('tasks_client.index') }}">Список задач</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Добавление задач</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('inc.messages')

        <div class="card">
            <div class="card-header">
                <a href="{{ route('tasks_client.index') }}" class="btn btn-outline-danger">
                    Назад
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('tasks_client.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">


                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" id="name" name="name" class="form-control mt-3"
                                       placeholder="Имя" value="{{ old('name') }}" tabindex="1" required>
                            </div>

                            <div class="form-group">
                                <label for="from">Дата начала задачи</label>
                                <input type="date" id="from" name="from" class="form-control mt-3"
                                       value="{{ old('from') }}" required tabindex="4">
                            </div>
                        </div>

                        <div class="col-4">

                            <div class="form-group">
                                <label for="client_id">Кому это задача</label>
                                <select id="client_id" name="client_id" class="form-select mt-3" tabindex="2" required>
                                    <option value="" selected>Выберите клиента </option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="to">Дата окончания задачи</label>
                                <input type="date" id="to" name="to" class="form-control mt-3" value="{{ old('to') }}"
                                       required tabindex="5">
                            </div>
                        </div>

                        <div class="col-4">

                            <div class="form-group d-none" id="type_id_group">
                            </div>
                            <div class="form-group">
                                <label for="comment">Комментария</label>
                                <textarea name="description" id="comment"
                                          class="form-control mt-3" tabindex="3" required>{{ old('comment') }}</textarea>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                                <div class="form-group">
                                <label for="file">Файл</label>
                                <input type="file" name="file" class="form-control mt-3" tabindex="6" id="file">
                            </div>
                        </div>
                        <div class="col-6"></div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" id="submit" class="btn btn-outline-primary" tabindex="7">Соxранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
