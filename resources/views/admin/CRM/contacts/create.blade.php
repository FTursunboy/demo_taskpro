@extends('admin.layouts.app')

@section('title')
    Добавления контакта
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Добавление контакта</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">Контакты</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Добавление нового контакта</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <a href="{{ route('contact.index') }}" class="btn btn-outline-danger">
                    Назад
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="fio">ФИО <span
                                            class="text-danger">*</span></label>
                                <input type="text" id="fio" name="fio" tabindex="1" class="form-control mt-3"
                                       placeholder="Введите ФИО" value="{{ old('fio') }}" required>
                                @if($errors->has('fio')) <p
                                    style="color: red;">{{ $errors->first('fio') }}</p> @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Должность</label>
                                <input type="text" id="position" name="position" tabindex="4" class="form-control mt-3"
                                       placeholder="Должность" value="{{ old('position') }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="start">Телефон <span
                                        class="text-danger">*</span></label>
                                <input placeholder="Введите номер телефона" type="text" id="phone" name="phone" class="form-control mt-3" tabindex="2" value="{{ old('phone') }}" required>
                                @if($errors->has('phone')) <p
                                    style="color: red;">{{ $errors->first('phone') }}</p> @endif
                            </div>

                            <div class="form-group">
                                <label for="type">Адрес</label>
                                <input type="text" name="address" placeholder="Введите адрес" value="{{old('address')}}" tabindex="7" class="form-control mt-3">
                            </div>
                        </div>
                        <div class="col-4">

                            <div class="form-group">
                                <label for="finish">Email</label>
                                <input placeholder="Введите Email" type="text" id="email" name="email" class="form-control mt-3" tabindex="3" value="{{ old('email') }}" >
                            </div>
                            <div class="form-group">
                                <label for="client_id">Лиды</label>
                                @if(isset($leades))
                                    <select class="form-select mt-3" name="lead_id" id="leadId" tabindex="6">
                                        <option value="{{$leades->id}}" selected>{{$leades->contact->fio}}</option>
                                    </select>
                                @else
                                <select class="form-select mt-3" name="lead_id" id="leadId" tabindex="6">
                                    <option selected>Выберите лида</option>
                                    {{--                                    <option value="0">Добавить нового клиента</option>--}}
                                @foreach($leads as $lead)
                                        <option value="{{ $lead->id }}" >{{ $lead->contact->fio }}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" id="button" class="btn btn-outline-primary" tabindex="9">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{--    <div class="modal fade" id="employee" tabindex="-1" aria-labelledby="employee" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-lg">--}}
{{--            <div class="modal-content">--}}
{{--                <form action="{{ route('contact.client.addClient') }}" method="get" id="employee">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h1 class="modal-title fs-5" id="employeeLabel">Добавления клиента</h1>--}}
{{--                        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        @if ($errors->any())--}}
{{--                            <div class="alert alert-danger" id="err">--}}
{{--                                <ul>--}}
{{--                                    @foreach ($errors->all() as $error)--}}
{{--                                        <li>{{ $error }}</li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <script>--}}
{{--                                setInterval(() => {--}}
{{--                                    document.getElementById('err').remove()--}}
{{--                                }, 2500)--}}
{{--                            </script>--}}
{{--                        @endif--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name" class="form-label">Имя  Клиента <span--}}
{{--                                            class="text-danger">*</span></label>--}}
{{--                                    <input required type="text" name="name2" tabindex="1" class="form-control"--}}
{{--                                           placeholder="Введите имя клиента" id="name2" value="{{ old('name2') }}">--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="lastname" class="form-label">Отчество Клиента<span--}}
{{--                                            class="text-danger">*</span></label>--}}
{{--                                    <input  type="text" name="lastname2" tabindex="3" class="form-control"--}}
{{--                                            placeholder="Введите отчество" id="surname2"--}}
{{--                                            value="{{ old('lastname2') }}" required>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="password" class="form-label">Пароль</label>--}}
{{--                                    <input type="password" name="password" tabindex="5" class="form-control" placeholder="Пароль"--}}
{{--                                           id="password" required>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="telegram_id" class="form-label">Телеграм id</label>--}}
{{--                                    <input required value="{{old('telegram_id')}}" tabindex="7" type="number" name="telegram_id"--}}
{{--                                           class="form-control" placeholder="Telegram id"--}}
{{--                                           id="telegram_id">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="surname" class="form-label">Фамилия Клиента<span--}}
{{--                                            class="text-danger">*</span></label>--}}
{{--                                    <input  type="text" name="surname2" tabindex="2" class="form-control"--}}
{{--                                            placeholder="Введите фамилию" id="surname2"--}}
{{--                                            value="{{ old('surname2') }}" required>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="login" class="form-label">Логин <span--}}
{{--                                            class="text-danger">*</span></label>--}}
{{--                                    <input required type="text" name="login" tabindex="4" class="form-control" placeholder="Login"--}}
{{--                                           id="login"--}}
{{--                                           value="{{ old('login') }}">--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="project_id" class="form-label">Проект</label>--}}
{{--                                    <select name="project_id" tabindex="6" class="form-select" id="" required>--}}
{{--                                        <option value="">Выберите проект</option>--}}
{{--                                        @foreach($projects as $project)--}}
{{--                                            <option value="{{$project->id}}">{{$project->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="phone" class="form-label">Телефон <span--}}
{{--                                            class="text-danger">*</span></label>--}}
{{--                                    <input required type="text" tabindex="8" name="phone2" class="form-control" placeholder="Телефон"--}}
{{--                                           id="phone2" value="{{ old('phone2') }}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" tabindex="9" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModal()">Отмена</button>--}}
{{--                        <button type="submit" tabindex="10" class="btn btn-primary" id="create">Добавить</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{--    <script>--}}
{{--        function showModal() {--}}
{{--            var select = document.getElementById("clientId");--}}
{{--            var selectedValue = select.value;--}}

{{--            if (selectedValue === "0") {--}}
{{--                var modal = document.getElementById("employee");--}}
{{--                modal.classList.add("show");--}}
{{--                modal.style.display = "block";--}}
{{--                modal.setAttribute("aria-hidden", "false");--}}
{{--                document.body.classList.add("modal-open");--}}
{{--            }--}}
{{--        }--}}

{{--        function closeModal() {--}}
{{--            var modal = document.getElementById("employee");--}}
{{--            modal.classList.remove("show");--}}
{{--            modal.style.display = "none";--}}
{{--            modal.setAttribute("aria-hidden", "true");--}}
{{--            document.body.classList.remove("modal-open");--}}
{{--        }--}}

{{--        $(document).ready(function() {--}}
{{--            $("#employee form").submit(function(e) {--}}
{{--                e.preventDefault(); // Предотвращаем обычную отправку формы--}}

{{--                // Отправка данных формы с использованием AJAX--}}
{{--                $.ajax({--}}
{{--                    url: $(this).attr("action"),--}}
{{--                    method: "GET",--}}
{{--                    data: $(this).serialize(),--}}
{{--                    success: function(response) {--}}
{{--                        closeModal(); // Закрытие модального окна после успешной отправки--}}
{{--                        // Дополнительный код, который может быть выполнен после успешной отправки--}}
{{--                    },--}}
{{--                    error: function(error) {--}}
{{--                        // Обработка ошибок при отправке AJAX запроса--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

@endsection
