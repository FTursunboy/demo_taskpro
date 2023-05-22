@extends('admin.layouts.app')

@section('title')
    Тип задачи {{$taskTypeModel->name}}
@endsection
@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Kpi</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Настройки</li>
                            <li class="breadcrumb-item"><a href="{{ route('settings.task') }}">Тип</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$taskTypeModel->name}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    @if(session('mess'))
                        <div class="alert alert-success">
                            {{ session('mess') }}
                        </div>
                    @endif
                    <a href="{{ route('settings.task') }}" class="btn btn-danger">Назад</a>
                    <a href="#" data-bs-target="#store" data-bs-toggle="modal" class="btn btn-primary">Добавить</a>
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
                        @foreach($types as $type)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$type->name}}</td>
                                <td>
                                    <a class="badge badge-primary p-2 text-success" href="#" data-bs-toggle="modal"
                                       data-bs-target="#update{{ $type->id }}"><i class="nav-icon bi bi-pencil"></i></a>
                                    <a class="badge badge-danger p-2 text-danger" href="#" data-bs-toggle="modal"
                                       data-bs-target="#delete{{ $type->id }}"><i class="nav-icon bi bi-trash"></i></a>

                                </td>
                            </tr>

                            <div class="modal" id="update{{$type->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Обновление этапа</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('settings.kpi.update', $type->id)}}" method="post">
                                            @csrf
                                            @method('patch')
                                            <div class="modal-body">
                                                <div>
                                                    <div>
                                                        <input type="text" value="{{$type->name}}" name="name"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Отмена
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Отправить</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal" id="delete{{$type->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Вы действительно хотите удалить</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('settings.kpi.delete', $type->id)}}" method="get">
                                            <div class="modal-body">
                                                <div>
                                                    <div>
                                                        <input type="text" value="{{$type->name}}" name="name"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Отмена
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Отправить</button>
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
                    <h5 class="modal-title">Добавить тип</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('settings.kpi.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <div>
                                <select class="form-select" name="typetask" id="">
                                    @foreach($taskType as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <input type="text" name="name" class="form-control mt-2">
                            </div>
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


