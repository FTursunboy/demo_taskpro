@extends(auth()->user()->hasRole('crm') ? 'user.layouts.app' : 'admin.layouts.app')

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
                <a href="{{ route('contact.lead.create', $lead->id) }}" class="btn btn-outline-primary mx-2">
                    Добавить контакт
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
                                <textarea cols="10" rows="3" class="form-control mt-3" disabled>{{ $lead->contact?->fio }}</textarea>
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
                                <textarea cols="10" rows="3" class="form-control mt-3" disabled>{{ $lead->contact->email }}</textarea>
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
{{--                                <input disabled type="text" name="address"  value="{{ $lead->contact?->address  }}" class="form-control mt-3" tabindex="6">--}}
                                <textarea cols="10" rows="3" disabled class="form-control mt-3">{{ $lead->contact?->address }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Состояние</label>
                                <input disabled type="text" class="form-control mt-3" value="{{$lead->state->name}}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
            <div class="card-body col-md-5" style="overflow: auto;">
                <h2 class="text-center">Список контактов лида</h2>
                <table id="example" class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Адрес</th>
                        <th>Лид</th>

                        <th class="text-center">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lead->contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ Str::limit($contact?->fio, 20) }}</td>
                            <td>{{ $contact?->phone }}</td>
                            <td>{{ $contact?->address }}</td>
                            <td>{{ Str::limit($contact?->fio, 20) }}</td>

                            <td class="text-center">
                                <a href="{{ route('contact.show', $contact->id)   }}" class="badge bg-success p-2"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('contact.edit', $contact->id) }}" class="badge bg-primary p-2"><i class="bi bi-pencil"></i></a>
                                <a class="badge bg-danger p-2" data-bs-toggle="modal"
                                   data-bs-target="#delete{{$contact->id}}"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>

                        <div class="modal fade text-left" id="delete{{$contact->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="delete{{$contact->id}}" data-bs-backdrop="false" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <form action="{{ route('contact.destroy', $contact->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="delete{{$contact->id}}">Предупреждение</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Точно хотите удалить контакт?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Нет</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Да</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
                <div class="card-body col-md-6" style="overflow: auto;">
                    <h2 class="text-center">Список событый лида</h2>
                    <table id="example" class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Тема</th>
                            <th>Тип</th>
                            <th>Статус</th>
                            <th class="text-center">Действия</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ Str::limit($event->themeEvent?->theme, 15) }}</td>
                            <td>{{ Str::limit($event->typeEvent?->name, 15) }}</td>
                            <td>{{ Str::limit($event->eventStatus?->name, 15) }}</td>
                            <td class="text-center">
                                <a href="{{ route('event.show', $event->id) }}" class="badge bg-success p-2"><i class="bi bi-eye"></i></a>

                                <a href="{{ route('event.edit', $event->id) }}" class="badge bg-primary p-2"><i class="bi bi-pencil"></i></a>
                                <a class="badge bg-danger p-2" data-bs-toggle="modal"
                                   data-bs-target="#delete{{$event->id}}"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>

                        <div class="modal fade text-left" id="delete{{$event->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="delete{{$event->id}}" data-bs-backdrop="false" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <form action="{{ route('event.destroy', $event->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="delete{{$event->id}}">Предупреждение</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Точно хотите удалить событие?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Нет</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Да, точно</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>

    </script>
@endsection
