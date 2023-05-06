@extends('admin.layouts.app')

@section('title')
    Проекты
@endsection

@section('content')
    <div id="main">
        @include('.inc.messages')
        <div class="card">
            <div class="card-header">
                <a href="{{ route('project.index') }}" class="btn btn-outline-danger">
                    Назад
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('project.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-4">

                            <div class="form-group">
                                <label for="name">Имя проекта</label>
                                <input type="text" id="name" name="name" class="form-control mt-3" placeholder="Имя проекта" required>
                            </div>

                            <div class="form-group">
                                <label for="start">Дата начала проекта</label>
                                <input type="date" id="start" name="start" class="form-control mt-3" required>
                            </div>

                        </div>
                        <div class="col-4">

                            <div class="form-group">
                                <label for="time">Время</label>
                                <input type="number" id="time" name="time" class="form-control mt-3" placeholder="Время" required>
                            </div>


                            <div class="form-group">
                                <label for="finish">Дата окончания проекта</label>
                                <input type="date" id="finish" name="finish" class="form-control mt-3" required>
                            </div>

                        </div>
                        <div class="col-4">

                            <div class="form-group">
                                <label for="type">Тип</label>
                                <select id="type" name="type" class="form-select mt-3">
                                    <option value="" selected>Выбирите тип</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="comment">Комментария</label>
                                <textarea name="comment" id="comment" class="form-control mt-3"></textarea>
                            </div>
                            
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
