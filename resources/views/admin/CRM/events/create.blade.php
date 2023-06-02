@extends('admin.layouts.app')

@section('title')
    События
@endsection

@section('content')
    <link rel="stylesheet" href="{{asset('assets/css/select/select2.min.css')}}" >
    <link rel="stylesheet" href="{{asset('assets/css/select/style.css')}}" >

    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Добавить новое событие</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('event.index') }}">Список событий</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Добавить новое событие</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('event.index') }}" class="btn btn-outline-danger">
                    Назад
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('event.store') }}" method="POST" >
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="themeEvent_id">Тема событие <span
                                        class="text-danger">*</span></label>
                                <select tabindex="3" id="themeEvent_id" name="themeEvent_id" class="form-select mt-3" required>
                                    <option value="" tabindex="1" selected>Выберите тему событие</option>
                                    @foreach($themeEvents as $themeEvent)
                                        <option value="{{ $themeEvent->id }}">{{ $themeEvent->theme }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('themeEvent_id')) <p
                                    style="color: red;">{{ $errors->first('themeEvent_id') }}</p> @endif
                            </div>
                            <div class="form-group">
                                <label for="date">Дата <span
                                        class="text-danger">*</span></label>
                                <input type="datetime-local" id="date" name="date" class="form-control mt-3" tabindex="3" value="{{ old('date') }}" required>
                                @if($errors->has('date')) <p
                                    style="color: red;">{{ $errors->first('date') }}</p> @endif
                            </div>
                            <div class="form-group mt-1">
                                <label for="contact_id" class="mb-3">Контакт <span
                                        class="text-danger">*</span></label>
                                <select tabindex="5" id="select" name="contact_id" class="select" multiple required>
                                    @foreach($contacts as $contact)
                                        <option value="{{ $contact->id }}">{{ $contact->fio . " - " . $contact->phone}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('contact_id')) <p
                                    style="color: red;">{{ $errors->first('contact_id') }}</p> @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type">Тип <span
                                        class="text-danger">*</span></label>
                                <select id="type" name="type_event_id" tabindex="2" class="form-select mt-3" required>
                                    <option value="" selected>Выберите тип</option>
                                    @foreach($typeEvents as $typeEvent)
                                        <option value="{{ $typeEvent->id }}">{{ $typeEvent->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('type_event_id')) <p
                                    style="color: red;">{{ $errors->first('type_event_id') }}</p> @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Описание <span
                                        class="text-danger">*</span></label>
                                <textarea id="description" name="description" class="form-control mt-3" tabindex="4" required>{{ old('description') }}</textarea>
                            </div>
                            @if($errors->has('description')) <p
                                style="color: red;">{{ $errors->first('description') }}</p> @endif
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" id="button" class="btn btn-outline-primary" tabindex="6">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')

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
    <script src="{{ asset('/assets/js/select/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('/assets/js/select/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/select/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/select/app.js') }}"></script>
    <script src="{{ asset('/assets/js/select/moment.min.js') }}"></script>
    <script src="{{ asset('/assets/js/select/bootstrap-datetimepicker.min.js') }}"></script>
@endsection
