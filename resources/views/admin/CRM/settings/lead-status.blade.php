@extends('admin.layouts.app')

@section('title')
    Стадие лида
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Стадие лида</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Стадие лида</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Создание стадие лида</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('setting.lead-status.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Имя:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-name" placeholder="Названиие" value="{{ old('name') }}" name="name" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Создать</button >
                                <button type="button" id="showToastPlacement"  data-bs-dismiss="modal" class="btn btn-secondary">Отмена</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('.inc.messages')
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('setting.index')}}" class="btn btn-outline-danger">
                        Назад
                    </a>
                    <a data-bs-toggle="modal" data-bs-target="#exampleModalStore" class="btn btn-outline-primary">
                        Добавить cтадие лида
                    </a>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-hover">
                        <thead>
                        <tr>
                            <th>Имя</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leadStatuses as $leadStatus)
                            <tr>
                                <td>{{ $leadStatus?->name }}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $leadStatus->id }}"><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                       data-bs-target="#delete{{$leadStatus->id}}"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade text-left" id="delete{{$leadStatus->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="delete{{$leadStatus->id}}" data-bs-backdrop="false" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <form action="{{ route('setting.lead-status.destroy', $leadStatus->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="delete{{$leadStatus->id}}">Предупреждение</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    Точно хотите удалить стадие лида?
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

                            <div class="modal fade" id="exampleModal{{ $leadStatus->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{$leadStatus->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('setting.lead-status.update', $leadStatus->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel{{$leadStatus->id}}">Изменение</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Название</label>
                                                    <input type="text" class="form-control" id="name" name="name" required value="{{ $leadStatus->name }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Обновить</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
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
@endsection


