@extends('admin.layouts.app')

@section('title')
    Проекты
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Добавить новый проект</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Список проектов</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Добавить новый проект</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <a href="{{ route('project.index') }}" class="btn btn-outline-danger">
                    Назад
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">

                            <div class="form-group">
                                <label for="name">Имя проекта</label>
                                <input type="text" id="name" name="name" tabindex="1" class="form-control mt-3"
                                       placeholder="Имя проекта" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="start">Дата начала проекта</label>
                                <input type="date" id="start" name="start" class="form-control mt-3" tabindex="4" value="{{ old('start') }}" required>
                            </div>

                        </div>
                        <div class="col-4">

                            <div class="form-group">
                                <label for="time">Время</label>
                                <input type="number" id="time" name="time" class="form-control mt-3" tabindex="2" value="{{ old('time') }}" placeholder="Время">
                                @if($errors->has('time')) <p
                                    style="color: red;">{{ $errors->first('time') }}</p> @endif
                            </div>


                            <div class="form-group">
                                <label for="finish">Дата окончания проекта</label>
                                <input type="date" id="finish" name="finish" class="form-control mt-3" tabindex="5" value="{{ old('finish') }}" required>
                            </div>

                        </div>
                        <div class="col-4">

                            <div class="form-group">
                                <label for="type">Тип</label>
                                <select id="type" name="type_id" tabindex="3" class="form-select mt-3" required>
                                    <option value="" selected>Выберите тип</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">Тип</label>
                                <select id="type" name="types_id" tabindex="6" class="form-select mt-3" required>
                                    <option value="" selected>Выберите тип проекта</option>
                                    @foreach($typesOf as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="comment">Комментария</label>
                                <textarea name="comment" id="comment" class="form-control mt-3" tabindex="7">{{ old('comment') }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file">Файл</label>
                                    <input tabindex="7" type="file"  name="file" class="form-control mt-3" id="file">
                                </div>
                            </div>
                            <div class="col-6"></div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" id="button" class="btn btn-outline-primary" tabindex="8">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')


    <script>
        const fromInput = document.getElementById('start');
        let prevValue = fromInput.value;

        fromInput.addEventListener('input', function() {
            const dateValue = new Date(this.value);
            const year = dateValue.getFullYear();
            const maxLength = 4;

            if (year.toString().length > maxLength) {
                this.value = prevValue; // Восстанавливаем предыдущее значение
            } else {
                prevValue = this.value; // Сохраняем текущее значение
            }
        });
    </script>
    <script>
        const toInput = document.getElementById('finish');
        let prevValue1 = toInput.value;

        toInput.addEventListener('input', function() {
            const dateValue = new Date(this.value);
            const year = dateValue.getFullYear();
            const maxLength = 4;

            if (year.toString().length > maxLength) {
                this.value = prevValue1; // Восстанавливаем предыдущее значение
            } else {
                prevValue1 = this.value; // Сохраняем текущее значение
            }
        });
    </script>



    <script>
        $('#start').change(function ()  {
            const finish = $('#finish')
            if ($(this).val() > finish.val()) {
                $(this).addClass('border-danger')
                finish.addClass('border-danger')
                $('#button').attr('type', 'button');
            } else {
                $(this).removeClass('border-danger')
                finish.removeClass('border-danger')
                $('#button').attr('type', 'submit');
            }
        })
        $('#finish').change(function ()  {
            const start = $('#start')
            if ($(this).val() < start.val()) {
                $(this).addClass('border-danger')
                start.addClass('border-danger')
                $('#button').attr('type', 'button');
            } else {
                $(this).removeClass('border-danger')
                start.removeClass('border-danger')
                $('#button').attr('type', 'submit');
            }
        })
    </script>
@endsection
