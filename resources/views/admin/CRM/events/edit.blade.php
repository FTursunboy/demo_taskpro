@extends('admin.layouts.app')

@section('title')
    {{ $event->name }}
@endsection

@section('content')
    <link rel="stylesheet" href="{{asset('assets/css/select/select2.min.css')}}" >
    <link rel="stylesheet" href="{{asset('assets/css/select/style.css')}}" >

    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $event->name }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('event.index') }}">Панел</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('event.index') }}">Список проектов</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $event->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        @include('inc.messages')

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('event.index') }}" class="btn btn-outline-danger">
                        Назад
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('event.update', $event->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-6">

                                <div class="form-group">
                                    <label for="themeEvent_id">Тема событие <span
                                            class="text-danger">*</span></label>
                                    <select tabindex="3" id="themeEvent_id" name="themeEvent_id" class="form-select mt-3" required>
                                        <option value="" tabindex="3" selected>Выберите тему событие</option>
                                        @foreach($themeEvents as $themeEvent)
                                            <option value="{{ $themeEvent->id }}" {{($themeEvent->id === $event->themeEvent->id) ? 'selected' : ''}}>{{ $themeEvent->theme }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('themeEvent_id')) <p
                                        style="color: red;">{{ $errors->first('themeEvent_id') }}</p> @endif
                                </div>
                                <div class="form-group mt-3">
                                    <label for="lead_id" class="mb-2">Лид <span
                                            class="text-danger">*</span></label>
                                    <select tabindex="3" id="lead_id" name="lead_id" class="select" multiple>
                                        @foreach($leads as $lead)
                                            <option value="{{ $lead->id }}" {{($lead->id === $event->leads?->id) ? 'selected' : ''}} >{{ $lead->contact->fio}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('lead_id')) <p
                                        style="color: red;">{{ $errors->first('lead_id') }}</p> @endif
                                </div>
                            </div>
                            <div class="col-6">

                                <div class="form-group">
                                    <label for="type">Тип <span
                                            class="text-danger">*</span></label>
                                    <select id="type" name="type_event_id" tabindex="4" class="form-select mt-3" required>
                                        <option value="" selected>Выберите тип</option>
                                         @foreach($typeEvents as $typeEvent)
                                            <option value="{{ $typeEvent->id }}" {{ $typeEvent->id === $event->typeEvent->id  ? 'selected' : '' }} >{{ $typeEvent->name }}</option>
                                         @endforeach
                                    </select>
                                    @if($errors->has('type_event_id')) <p
                                        style="color: red;">{{ $errors->first('type_event_id') }}</p> @endif
                                </div>

                                <div class="form-group">
                                    <label for="date">Время <span
                                            class="text-danger">*</span></label>
                                    <input type="datetime-local" id="date" name="date" class="form-control mt-3" tabindex="2" value="{{date('Y-m-d H:i:s', strtotime($event->date)) }}" required>
                                </div>
                                @if($errors->has('date')) <p
                                    style="color: red;">{{ $errors->first('date') }}</p> @endif
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">Описание</label>
                                        <textarea id="description" name="description" class="form-control mt-3" tabindex="3">{{ $event->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" tabindex="9" id="button" class="btn btn-outline-primary">Обновить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#select').on('change', function() {
                if ($('#select option:selected').length > 0) {
                    $('#select').removeAttr('multiple');
                } else {
                    $('#select').attr('multiple', 'multiple');
                }
            });
        });
    </script>
    <script src="{{ asset('/assets/js/select/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('/assets/js/select/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/select/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/select/app.js') }}"></script>
    <script src="{{ asset('/assets/js/select/moment.min.js') }}"></script>
    <script src="{{ asset('/assets/js/select/bootstrap-datetimepicker.min.js') }}"></script>
@endsection
