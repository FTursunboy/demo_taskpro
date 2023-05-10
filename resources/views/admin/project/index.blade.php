@extends('admin.layouts.app')

@section('title')
    Проекты
@endsection

@section('content')
    <div id="main">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Проекти</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Проекти</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('.inc.messages')
        <div class="card">
            <div class="card-header">
                <a href="{{ route('project.create') }}" class="btn btn-outline-primary">
                    Добавить проект
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Время</th>
                        <th>Тип</th>
                        <th>От</th>
                        <th>До</th>
                        <th>Тип проекта</th>
                        <th>Статус</th>
                        <th class="text-center">Действия</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->time }}</td>
                            <td>{{ $project->type->name }}</td>
                            <td>{{  \Carbon\Carbon::createFromFormat('Y-m-d', $project->start)->format('d-m-Y') }}</td>
                            <td>{{  \Carbon\Carbon::createFromFormat('Y-m-d', $project->finish)->format('d-m-Y') }}</td>
                            <td>{{ $project->types?->name }}</td>
                            <td>{{ $project->status->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('project.show', $project->id)   }}" class="badge bg-success"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('project.edit', $project->id) }}" class="badge bg-primary"><i class="bi bi-pencil"></i></a>
                                <a class="badge bg-danger" data-bs-toggle="modal"
                                   data-bs-target="#delete{{$project->id}}"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>

                        <div class="modal fade text-left" id="delete{{$project->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="delete{{$project->id}}" data-bs-backdrop="false" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <form action="{{ route('project.destroy', $project->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="delete{{$project->id}}">Предупреждение</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Точно хотите удалит проект?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Нет, я пошутил</span>
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
@endsection
