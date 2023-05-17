@extends('admin.layouts.app')
@section('title')
    Отдел
@endsection


@section('content')

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Отдел</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Настройки</li>
                                    <li class="breadcrumb-item active" aria-current="page">Отдел</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                @include('inc.messages')

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <a href="#" data-bs-target="#store" data-bs-toggle="modal"
                               class="btn btn-primary">Добавить</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                <tr>
                                    <th width="100">#</th>
                                    <th>Название</th>
                                    <th width="150">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($otdels as $depart)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$depart->name}}</td>
                                        <td>
                                            <a class="badge bg-success p-2 text-white"
                                               href="{{route('settings.kpi', $depart->id)}}"><i
                                                    class=" bi bi-eye"></i></a>
                                            <a class="badge bg-primary p-2 text-white" href="#"
                                               data-bs-toggle="modal" data-bs-target="#update{{ $depart->id }}"><i
                                                    class=" bi bi-pencil"></i></a>
                                            <a class="badge bg-danger p-2 text-white" href="#"
                                               data-bs-toggle="modal" data-bs-target="#delete{{ $depart->id }}"><i
                                                    class=" bi bi-trash"></i></a>
                                        </td>
                                    </tr>

                                    <div class="modal" id="update{{$depart->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Обновление роля</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <form action="{{route('settings.depart.update', $depart->id)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="role"></label>
                                                            <input type="text" id="role" value="{{$depart->name}}"
                                                                   name="name"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Отмена
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Отправить
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal" id="delete{{$depart->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Вы действительно хотите удалить?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <form action="{{route('settings.depart.delete', $depart->id)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="role"></label>
                                                            <input type="text" id="role" value="{{$depart->name}}"
                                                                   name="name"
                                                                   class="form-control" disabled>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Отмена
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Удалить
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>

    <div class="modal" id="store" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить роль</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('settings.depart.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role">Имя</label>
                            <input type="text" name="name" id="role" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


