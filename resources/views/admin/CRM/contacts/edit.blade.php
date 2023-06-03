@extends('admin.layouts.app')

@section('title')
    Обновление контакта
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Обновление контакта</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">Контакты</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Обновление контакта</li>
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
                <form action="{{ route('contact.update', $contact->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="fio">ФИО <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="fio" name="fio" tabindex="1" class="form-control mt-3"
                                       value="{{ $contact->fio }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Должность</label>
                                <input type="text" id="position" name="position" tabindex="4" class="form-control mt-3"
                                       value="{{ $contact->position }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="start">Телефон <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" class="form-control mt-3" tabindex="2" value="{{ $contact->phone }}" required>
                            </div>

                            <div class="form-group">
                                <label for="type">Адрес</label>
                                <input type="text" name="address" value="{{ $contact->address }}" tabindex="7" class="form-control mt-3">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="finish">Email</label>
                                <input type="text" id="email" name="email" class="form-control mt-3" tabindex="3" value="{{ $contact->email }}" >
                            </div>
                            <div class="form-group">
                                <label for="lead_id">Лиды</label>
                                <select class="form-select mt-3" name="lead_id" id="leadId" tabindex="6" onchange="showModal()">
                                    <option selected disabled>Выберите лида</option>
                                    @foreach($leads as $lead)
                                        <option value="{{ $lead->id }}" {{ $lead->id === $contact->lead_id  ? 'selected' : '' }}>{{ $lead->contact->fio }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" id="button" class="btn btn-outline-primary" tabindex="9">Обновить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
