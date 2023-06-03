@extends('admin.layouts.app')

@section('title')
    Просмотр лида
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Просмотр лида</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('lead.index') }}">Лиды</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Просмотр лида</li>
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

                <a href="{{ route('lead.edit', $lead->id) }}" class="btn btn-outline-primary mx-2">
                    Изменить
                </a>

                <a href="{{ route('lead.edit', $lead->id) }}" class="btn btn-outline-primary mx-2">
                    Контакты
                </a>

                <a href="{{ route('lead.events', $lead->id) }}" class="btn btn-outline-primary mx-2">
                    Событие
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
                                <label for="fio">ФИО</label>
                                <input disabled type="text" id="fio" name="fio" tabindex="1" class="form-control mt-3"
                                        value="{{ $lead->contact?->fio }}" required>
                            </div>

                            <div class="form-group">
                                <label for="start">Телефон</label>
                                <input disabled  type="text" id="phone" name="phone" class="form-control mt-3" tabindex="4" value="{{ $lead->contact?->phone}}" required>
                            </div>

                            <div class="form-group">
                                <label for="">Стадие</label>
                                <input disabled type="text" class="form-control mt-3" value="{{$lead->status->name}}">
                            </div>

                        </div>
                        <div class="col-4">

                            <div class="form-group">
                                <label for="finish">Email</label>
                                <input disabled  type="text" id="email" name="email" class="form-control mt-3" tabindex="5" value="{{ $lead->contact->email  }}" required>
                            </div>

                            <div class="form-group">
                                <label for="">Источник лида</label>
                                <input disabled type="text" class="form-control mt-3" value="{{$lead->leadSource->name}}">
                            </div>

                            <div class="form-group">
                                <label for="">Описание</label>
                                <textarea disabled class="form-control mt-3" >{{$lead->description}}</textarea>
                            </div>

                        </div>
                        <div class="col-4">

                            <div class="form-group">
                                <label for="type">Адрес</label>
                                <input disabled type="text" name="address"  value="{{ $lead->contact?->address  }}" class="form-control mt-3" tabindex="6">
                            </div>

                            <div class="form-group">
                                <label for="">Состояние</label>
                                <input disabled type="text" class="form-control mt-3" value="{{$lead->state->name}}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>

    </script>
@endsection
