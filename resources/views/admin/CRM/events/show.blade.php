@extends('admin.layouts.app')

@section('title')
{{ $event->name }}
@endsection

@section('content')
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
                            <li class="breadcrumb-item"><a href="{{ route('event.index') }}">Список события</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $event->name }}</li>
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
                <a href="{{ route('event.edit', $event->id) }}" class="btn btn-outline-primary mx-2">
                    Изменить
                </a>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="theme">Имя проекта</label>
                                <input type="text" id="theme" name="theme" class="form-control mt-3"
                                        value="{{ $event->themeEvent?->theme }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="date">Дата/Время</label>
                                <input type="text" id="date" name="date" class="form-control mt-3" value="{{ date('d.m.Y H:i', strtotime($event?->date)) }}" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type">Тип</label>
                                <input type="text" class="form-control mt-3" id="type" value="{{ $event->typeEvent?->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="contact_id">Контакт</label>
                                <input type="text" id="contact_id" name="contact_id" class="form-control mt-3" value="{{ $event->leads->contact?->fio . " - " . $event->leads->contact?->phone}}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea id="description" name="description" class="form-control mt-3" tabindex="3" disabled>{{ $event?->description }}</textarea>
                                </div>
                            </div>
                        </div>

                </div>
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
            } else {
                $(this).removeClass('border-danger')
                finish.removeClass('border-danger')
            }
        })
        $('#finish').change(function ()  {
            const start = $('#start')
            if ($(this).val() > start.val()) {
                $(this).addClass('border-danger')
                start.addClass('border-danger')
            } else {
                $(this).removeClass('border-danger')
                start.removeClass('border-danger')
            }
        })

    </script>
@endsection
