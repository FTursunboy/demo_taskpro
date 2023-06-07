@extends(auth()->user()->hasRole('crm') ? 'user.layouts.app' : 'admin.layouts.app')

@section('title')
    Просмотр контакта
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Просмотр контакта</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">Контакты</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Просмотр контакта</li>
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
                <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-outline-primary">
                    Изменить контакт
                </a>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="fio">ФИО</label>
                                <input class="form-control mt-3" value="{{ $contact->fio }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Должность</label>
                                <input class="form-control mt-3" value="{{ $contact->position }}" disabled>
                            </div>
                        </div>
                        <div class="col-4">

                            <div class="form-group">
                                <label for="start">Телефон</label>
                                <input class="form-control mt-3" value="{{ $contact->phone }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="type">Адрес</label>
                                <input value="{{ $contact->address }}" class="form-control mt-3" disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="finish">Email</label>
                                <input class="form-control mt-3" tabindex="6" value="{{ $contact->email }}" disabled>
                            </div>
                            @if(isset($contact->client->name))
                            <div class="form-group">
                                <label for="finish">Клиент</label>
                                <input class="form-control mt-3" tabindex="6" value="{{ $contact->client->name }}" disabled>
                            </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
