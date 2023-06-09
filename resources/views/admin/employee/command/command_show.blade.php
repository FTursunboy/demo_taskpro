@extends('admin.layouts.app')

@section('title'){{ $user->surname . ' ' . $user->name.' '. $user->lastname }}@endsection

@section('content')
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
    <div id="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $user->surname . ' ' . $user->name.' '. $user->lastname }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Соотрудники </a></li>
                            <li class="breadcrumb-item active"
                                aria-current="page">{{ $user->surname . ' ' . $user->name.' '. $user->lastname }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </div>
    <div class="mb-2">
        <a href="{{ route('employee.show', $user->slug) }}" class="btn btn-outline-danger ">
            Назад
        </a>

        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addUser">
            Добавить сотрудник в камандой
        </button>
        <div class="modal fade" id="addUser" data-bs-backdrop="static"
             data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="addUser" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addUser">Выберите
                            сотрудник</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <form action="{{ route('employee.addUserInCommand', [$user->id, $project->id]) }}"
                          method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mt-4">
                                <label for="select_users_command">Выберите участники команда <span
                                            class="text-danger">*</span></label>
                                <select multiple id="users" class="" name="users[]"
                                        class="form-select">
                                    @foreach ($users as $u)
                                        @php
                                            $isInCommand = false;
                                        @endphp

                                        @foreach ($commands as $use)
                                            @if ($u->id === $use->id)
                                                @php
                                                    $isInCommand = true;
                                                    break;
                                                @endphp
                                            @endif
                                        @endforeach

                                        @if ($u->id !== $user->id && !$isInCommand)
                                            <option value="{{ $u->id }}">{{ $u->surname . ' ' . $u->name . ' ' . $u->lastname }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Отмена
                            </button>
                            <button type="submit" class="btn btn-primary">Добавить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('inc.messages')
    <section class="section">
        <div class="row pt-4">
            <div class="col-9">
                <h4 class="mb-3">Учатсники</h4>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="40px">#</th>
                                <th>ФИО</th>
                                <th width="100px">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($commands as $use)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $use->surname . ' ' . $use->name . ' ' . $use->lastname }}{{ ($use->id === $user->id) ? ' - (Тимлид)' : '' }}</td>
                                    <td>
                                        <a role="button" data-bs-toggle="modal"
                                           data-bs-target="#deleteFromCommand{{ $use->id }}"
                                           class="badge bg-danger"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteFromCommand{{ $use->id }}" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteFromCommand{{ $use->id }}"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deleteFromCommand{{ $use->id }}">Modal
                                                    title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form
                                                    action="{{ route('employee.deleteUserInGroup', [$user->id, $use->pro_id, $use->id]) }}"
                                                    method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    Точно хотите удалить из камандой?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Отмена
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">Да</button>
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


            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-center mb-3">
                            @if(isset($user->avatar))
                                <img style="border-radius: 50% " id="avatar" onclick="img()"
                                     src="{{ asset('storage/'.$user->avatar)}}" alt="" width="100" height="100">
                            @else
                                <img style="border-radius: 50% " id="avatar" onclick="img()"
                                     src="{{ asset('assets/images/logo/favicon.svg') }}" alt="" width="100"
                                     height="100">
                            @endif
                        </div>

                        @switch($user->xp)
                            @case($user->xp > 0 && $user->xp <= 99 )
                            <div>
                                <div class="d-flex justify-content-end">
                                    {{ $user->xp }} / 100
                                </div>
                            </div>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                     style="width: {{ $user->xp }}%" aria-valuenow="{{ $user->xp }}"
                                     aria-valuemin="0"
                                     aria-valuemax="300"></div>
                            </div>
                            @break
                            @case($user->xp > 99 && $user->xp < 299 )
                            <div>
                                <div class="d-flex justify-content-end">
                                    {{ $user->xp }} / 300 (xp)
                                </div>
                            </div>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                     style="width: {{$user->xp/3}}%" aria-valuenow="{{ $user->xp }}"
                                     aria-valuemin="0"
                                     aria-valuemax="300"></div>
                            </div>
                            @break
                            @case($user->xp > 299 && $user->xp < 700 )
                            <div>
                                <div class="d-flex justify-content-end">
                                    {{ $user->xp }}xp / 700 (xp)
                                </div>
                            </div>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                     style="width: {{$user->xp / 7}}%" aria-valuenow="{{ $user->xp }}"
                                     aria-valuemin="0"
                                     aria-valuemax="700"></div>
                            </div>
                            @break
                            @case($user->xp > 699 && $user->xp < 1000 )
                            <div>
                                <div class="d-flex justify-content-end">
                                    {{ $user->xp }} / 1000 (xp)
                                </div>
                            </div>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                     style="width: {{$user->xp / 10}}%" aria-valuenow="{{ $user->xp }}"
                                     aria-valuemin="0"
                                     aria-valuemax="1000"></div>
                            </div>
                            @break
                        @endswitch

                    </div>
                    <div class="card-body">
                        <h5 class="text-center">{{ $user->surname . ' ' .$user->name .' '. $user->lastname}}</h5>
                        <div>
                            <table class="mt-3" cellpadding="5">
                                <tr>
                                    <th>Задачи:</th>
                                    <th><span class="mx-2">{{ $user->taskCount($user->id) }}</span></th>
                                </tr>
                                <tr>
                                    <th>Завершенный :</th>
                                    <th><span class="mx-2">{{ $user->taskSuccessCount($user->id) }}</span></th>
                                </tr>
                                <tr>
                                    <th>Идеи :</th>
                                    <th><span class="mx-2"> {{ $user->ideaCount($user->id) }}</span></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('employee.edit', $user->slug) }}" class="btn btn-primary mx-2"><i
                                        class="bi bi-pencil"></i></a>
                            <a role="button" class="btn btn-danger" data-bs-toggle="modal"
                               data-bs-target="#delete{{$user->slug}}"><i class="bi bi-trash"></i></a>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="delete{{$user->slug}}" tabindex="-1"
                     aria-labelledby="delete{{$user->slug}}"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('employee.destroy', $user->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="delete{{$user->slug}}">Предупреждение</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Точно хотите удалить
                                    <b>'{{ $user->surname.' '. $user->name.' '. $user->lastname }}'</b>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет
                                    </button>
                                    <button type="submit" class="btn btn-danger">Да, хочу удалить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    </div>

@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('users', {
            rounded: true,    // default true
        })
    </script>
@endsection
