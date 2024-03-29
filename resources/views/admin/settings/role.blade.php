@extends('admin.layouts.app')
@section('title')
    Роли
@endsection


@section('content')


            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Типы проекта</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Настройки</li>
                                    <li class="breadcrumb-item active" aria-current="page">Роли</li>
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
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            <a class="badge badge-primary p-2 text-primary"
                                               href="{{route('settings.kpi', $role->id)}}"><i
                                                    class="nav-icon bi bi-eye"></i></a>
                                            <a class="badge badge-primary p-2 text-success" href="#"
                                               data-bs-toggle="modal" data-bs-target="#update{{ $role->id }}"><i
                                                    class="nav-icon bi bi-pencil"></i></a>
                                            <a class="badge badge-danger p-2 text-danger" href="#"
                                               data-bs-toggle="modal" data-bs-target="#delete{{ $role->id }}"><i
                                                    class="nav-icon bi bi-trash"></i></a>
                                        </td>
                                    </tr>

                                    <div class="modal" id="update{{$role->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Обновление рола</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <form action="{{route('settings.role.update', $role->id)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="role"></label>
                                                            <input type="text" id="role" value="{{$role->name}}"
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
                                    <div class="modal" id="delete{{$role->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Вы действительно хотите удалить?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <form action="{{route('settings.role.delete', $role->id)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="role"></label>
                                                            <input type="text" id="role" value="{{$role->name}}"
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
                <form action="{{route('settings.role.store')}}" method="post">
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


