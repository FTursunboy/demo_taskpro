@extends(auth()->user()->hasRole('crm') ? 'user.layouts.app' : 'admin.layouts.app')

@section('title')
    Добавления лид
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Добавление лид</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('lead.index') }}">Лиды</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Добавление нового лида</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('lead.index') }}" class="btn btn-outline-danger">
                    Назад
                </a>
            </div>
            @if($errors->any())
                @foreach($errors as $error)
                    {{$error}}
                @endforeach
                @endif
            <div class="card-body">
                <form action="{{ route('lead.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="fio">ФИО <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="fio" name="fio" tabindex="1" class="form-control mt-3"
                                       placeholder="Введите ФИО" value="{{ old('fio') }}"  required>
                                @if($errors->has('fio')) <p
                                    style="color: red;">{{ $errors->first('fio') }}</p> @endif
                            </div>
                            <div class="form-group">
                                <label for="start">Телефон <span
                                        class="text-danger">*</span></label>
                                <input placeholder="Введите номер телефона" type="text" id="phone" name="phone" class="form-control mt-3" tabindex="4" value="{{ old('phone') }}" required>
                                @if($errors->has('phone')) <p
                                    style="color: red;">{{ $errors->first('phone') }}</p> @endif
                            </div>
                            <div class="form-group">
                                <label for="">Стадии<span
                                        class="text-danger">*</span></label>
                                <select id="type" name="status_id" tabindex="7" class="form-select mt-3" required>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('status_id')) <p style="color: red;">{{ $errors->first('status_id') }}</p> @endif
                            </div>

                            <div class="form-group" id="is_client">
                                <label for="is_client" class="custom-label">Сохранение контакта</label>
                                <input type="checkbox" class="custom-control-input" name="is_client">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="finish">Email</label>
                                <input placeholder="Введите Email" type="text" id="email" name="email" class="form-control mt-3" tabindex="2" value="{{ old('email') }}" >
                            </div>
                            <div class="form-group">
                                <label for="">Источник лида
                                    <span class="text-danger">*</span></label>
                                <select  id="type" name="source_id" tabindex="5" class="form-select mt-3" required>
                                    <option value="">Выберите источник</option>
                                    @foreach($sources as $source)
                                        <option value="{{ $source->id }}">{{ $source->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('source_id')) <p
                                    style="color: red;">{{ $errors->first('source_id') }}</p> @endif
                            </div>
                             <div class="form-group col-12">
                                  <label for="description">Описание</label>
                                 <textarea id="description" name="description" class="form-control mt-3" tabindex="8" value="{{ old('description') }}" ></textarea>
                             </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="type">Адрес</label>
                                <input type="text" name="address" placeholder="Введите адрес" value="{{old('address')}}" class="form-control mt-3" tabindex="3">
                            </div>
                            <div class="form-group">
                                <label for="">Состояние
                                    <span class="text-danger">*</span></label>
                                <select id="type" name="state_id" tabindex="6" class="form-select mt-3" required>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('state_id')) <p
                                    style="color: red;">{{ $errors->first('state_id') }}</p> @endif
                            </div>
                        </div>
                        <div class="row d-none" id="company">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Компания</label>
                                    <input type="text" class="form-control mt-3" name="company" placeholder="Введите компанию">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Должность</label>
                                    <input type="text" name="position" placeholder="Должность" class="form-control mt-3">
                                </div>
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
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#type').change(function() {
                if ($(this).val() !== '1') {
                    $('#is_client').addClass('d-none');
                    $('#is_client input[type="checkbox"]').prop('checked', false);
                    $('#company').addClass('d-none');
                } else {
                    $('#is_client').removeClass('d-none');
                }
            });

            $('#is_client input[type="checkbox"]').change(function() {
                if ($(this).is(':checked')) {
                    $('#company').removeClass('d-none');
                } else {
                    $('#company').addClass('d-none');
                }
            });
        });


    </script>
@endsection
