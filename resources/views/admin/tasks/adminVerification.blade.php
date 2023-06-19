@extends('admin.layouts.app')

@section('title')
    На проверке (Админ)
@endsection
@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>На проверке (Админ)</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.index') }}">Панель</a></li>
                            <li class="breadcrumb-item active" aria-current="page">На проверке</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('inc.messages')

        <a href="{{ route('mon.index') }}" class="btn btn-outline-primary mb-4">
            Назад
        </a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">
                                    @foreach($adminVerification as $task)
                                        <a class="nav-link {{ ($loop->index === 0) ? 'active': ''}}"
                                           id="v-pills-home-tab{{ $task->id }}" data-bs-toggle="pill"
                                           href="#v-pills-home{{ $task->id }}" role="tab"
                                           aria-controls="v-pills-home{{ $task->id }}"
                                           aria-selected="true">

                                            {{ \Illuminate\Support\Str::limit($task->name,30) }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    @foreach($adminVerification as $task)
                                        <div class="tab-pane fade {{( $loop->index === 0) ? 'active show' : '' }}"
                                             id="v-pills-home{{ $task->id }}" role="tabpanel"
                                             aria-labelledby="v-pills-home-tab{{ $task->id }}">
                                            <div class="row mb-4">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="name">Имя</label>
                                                        <input type="text" id="name" class="form-control"
                                                               value="{{ $task->name }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-4">

                                                    <div class="form-group">
                                                        <label for="user">Исполнитель</label>
                                                        <input type="text" id="user" class="form-control"
                                                               value="{{ $task->user->name }} {{ $task->user->surname }}"
                                                               disabled>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="sts">Статус</label>
                                                        @switch($task->status->id)
                                                            @case($task->status->id === 1)
                                                                <input type="text"
                                                                       class="form-control bg-warning text-black" id="sts"
                                                                       value="{{ $task->status->name }}" disabled>
                                                                @break

                                                            @case($task->status->id === 2)
                                                                <input type="text"
                                                                       class="form-control bg-primary text-white" id="sts"
                                                                       value="{{ $task->status->name }}" disabled>
                                                                @break

                                                            @case($task->status->id === 3)
                                                                <input type="text"
                                                                       class="form-control bg-success text-white" id="sts"
                                                                       value="{{ $task->status->name }}" disabled>
                                                                @break

                                                            @case($task->status->id === 4)
                                                                <input type="text"
                                                                       class="form-control bg-primary text-white" id="sts"
                                                                       value="В процессе" disabled>
                                                                @break

                                                            @case($task->status->id === 5)
                                                                <input type="text" class="form-control text-white" id="sts"
                                                                       value="{{ $task->status->name }}" disabled
                                                                       style="background-color: #fc0404">
                                                                @break

                                                            @case($task->status->id === 6)
                                                                <input type="text"
                                                                       class="form-control bg-secondary text-white" id="sts"
                                                                       value="{{ $task->status->name }}" disabled>
                                                                @break

                                                            @case($task->status->id === 7)
                                                                <input type="text" class="form-control bg-info text-black"
                                                                       id="sts" value="Просроченный" disabled>
                                                                @break

                                                            @case($task->status->id === 8)
                                                                <input type="text" class="form-control bg-info text-black"
                                                                       id="sts" value="{{ $task->status->name }}" disabled>
                                                                @break

                                                            @case($task->status->id === 9)
                                                                <input type="text"
                                                                       class="form-control bg-warning text-black" id="sts"
                                                                       value="{{ $task->status->name }}" disabled>
                                                                @break

                                                            @case($task->status->id === 10)
                                                                <input type="text" class="form-control bg-info text-black"
                                                                       id="sts" value="{{ $task->status->name }}" disabled>
                                                                @break

                                                            @case($task->status->id === 11)
                                                                <input type="text" class="form-control bg-info text-black"
                                                                       id="sts" value="{{ $task->status->name }}" disabled>
                                                                @break

                                                            @case($task->status->id === 12)
                                                                <input type="text" class="form-control bg-info text-black"
                                                                       id="sts" value="{{ $task->status->name }}" disabled>
                                                                @break

                                                            @case($task->status->id === 13)
                                                                <input type="text" class="form-control bg-info text-black"
                                                                       id="sts" value="{{ $task->status->name }}" disabled>
                                                                @break

                                                            @case($task->status->id === 14)
                                                                <input type="text" class="form-control bg-info text-black"
                                                                       id="sts" value="{{ $task->status->name }}" disabled>
                                                                @break
                                                        @endswitch
                                                    </div>
                                                </div>
                                            </div>
                                            @if($task->status_id === 5)
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="cancel">Причина</label>
                                                        <textarea id="cancel" class="form-control">{{ $task->cancel }}</textarea>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-4">
                                                    @if($task->status->id === 6 || $task->status->id === 14)
                                                        <a href=""
                                                           class="btn btn-outline-success w-100" data-bs-toggle="modal"
                                                           data-bs-target="#check{{$task->id}}">
                                                            <i class="bi bi-eye mx-2"></i>
                                                            Проверить задачу
                                                        </a>
                                                    @else
                                                        <a href="{{ route('tasks.show', $task->id) }}"
                                                           class="btn btn-outline-success w-100">
                                                            <i class="bi bi-eye mx-2"></i>
                                                            Просмотреть
                                                        </a>
                                                    @endif
                                                </div>
                                                @if($task->status->id === 5)
                                                    <div class="col-4">
                                                        <button type="button" class="btn btn-outline-primary w-100"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editRight{{$task->id}}">
                                                            <i class="bi bi-pencil"></i>
                                                            Изменить
                                                        </button>
                                                    </div>
                                                @elseif(
                                                    $task->status->id === 3 ||
                                                    $task->status->id === 6 ||
                                                    $task->status->id === 10 ||
                                                    $task->status->id === 14
                                                )
                                                    <div class="col-4">
                                                        <button type="button" class="btn btn-outline-primary w-100"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editWrong{{$task->id}}">
                                                            <i class="bi bi-pencil"></i>
                                                            Изменить
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="col-4">
                                                        <a href="{{route('tasks.edit', $task->id)}}"
                                                           class="btn btn-outline-primary w-100">
                                                            <i class="bi bi-pencil"></i>
                                                            Изменить
                                                        </a>
                                                    </div>
                                                @endif
                                                <div class="col-4">
                                                    <button type="button" class="btn btn-outline-danger w-100"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#delete{{$task->id}}">
                                                        <i class="bi bi-trash mx-2"></i>
                                                        Удалить
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="delete{{$task->id}}" data-bs-backdrop="static"
                                             data-bs-keyboard="false" tabindex="-1"
                                             aria-labelledby="delete{{$task->id}}" aria-hidden="true"
                                             style="z-index: 9990">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route('tasks.delete', $task->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="delete{{$task->id}}">
                                                                Предупреждение</h1>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Точно хотите удалить задачу?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Нет
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Да, удалить
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="editWrong{{$task->id}}" data-bs-backdrop="static"
                                             style="z-index: 9991"
                                             data-bs-keyboard="false" tabindex="-1"
                                             aria-labelledby="editWrong{{$task->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editWrong{{$task->id}}">
                                                            Предупреждение</h1>
                                                        <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-5">
                                                            Вы не можете изменить это задание!
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Закрыть
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="editRight{{$task->id}}" data-bs-backdrop="static"
                                             data-bs-keyboard="false" tabindex="-1" style="z-index: 9992"
                                             aria-labelledby="editRight{{$task->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{route('tasks.sendBack', $task->id,)}}"
                                                          method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editRight{{$task->id}}">
                                                                Предупреждение</h1>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div>
                                                                <div class="form-group">
                                                                    <label for="user">Сотрудник</label>
                                                                    <select name="user_id" id="user_id"
                                                                            class="form-select">
                                                                        @foreach($users as $user)
                                                                            <option value="{{ $user->id }}" {{ ($user->id === old('user_id') or $user->id === $task->user->id ) ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">
                                                                Перенаправить
                                                            </button>
                                                            <a href="{{route('tasks.edit', $task->id)}}"
                                                               class="btn btn-primary">
                                                                Изменить
                                                            </a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="check{{$task->id}}" data-bs-backdrop="static"
                                             data-bs-keyboard="false" tabindex="-1" style="z-index: 9994"
                                             aria-labelledby="check{{$task->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{route('tasks.sendBack1', $task->id,)}}"
                                                          method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-header">
                                                            <h1>Проверка</h1>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="employee">Отчёт о проделанной работе</label>
                                                                <textarea class="form-control"
                                                                          disabled>{{ $task->success_desc }} </textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="employee">Исполнители</label>
                                                                <select name="employee" id="employee"
                                                                        class="form-control">
                                                                    <option disabled value="0" selected>Выберите
                                                                        исполнители
                                                                    </option>
                                                                    @foreach($users as $user)
                                                                        <option value="{{ $user->id }}">{{ $user->surname .' ' . $user->name .' '.$user->lastname }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-warning">
                                                                Перенаправить
                                                            </button>
                                                            <button type="submit" class="btn btn-success">Готово
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
