@extends('admin.layouts.app')
@section('content')
    <div id="app">

        <div id="main">

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Kpi</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Настройки</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Kpi</li>
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
                                <a href="#" data-bs-target="#store" data-bs-toggle="modal" class="btn btn-primary">Добавить</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Название</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($types as $type)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$type->name}}</td>
                                        <td>
                                             <a class="badge badge-primary p-2 text-success" href="#" data-bs-toggle="modal" data-bs-target="#update{{ $type->id }}"><i class="nav-icon bi bi-pencil"></i></a>
                                            <a class="badge badge-danger p-2 text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete{{ $type->id }}"><i class="nav-icon bi bi-trash"></i></a>

                                        </td>
                                    </tr>

                                    <div class="modal" id="update{{$type->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Обноавление этапа</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{route('settings.task.update', $type->id)}}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="modal-body">
                                                        <div>
                                                            <div>
                                                                <input type="text" value="{{$type->name}}" name="name" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{route('settings.task.delete', $type->id)}}" method="get">
                                                    <div class="modal-body">
                                                        <div>
                                                            <div>
                                                                <input type="text" value="{{$type->name}}" name="name" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            <footer>
                <div class="footer clearfix mb-0 text-muted">

                </div>
            </footer>
        </div>
    </div>

    <div class="modal" id="store" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить тип</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('settings.task.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <div>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


