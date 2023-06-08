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

        <a href="{{ route('employee.index') }}" class="btn btn-outline-danger mb-2">
            Назад
        </a>

        @if($user->getRoleNames()->contains('team-lead'))

{{--                             remove role in team-lead start       --}}

                        <a role="button" class="btn btn-outline-danger mb-2 mx-2" data-bs-toggle="modal"
                           data-bs-target="#deleteCommand">
                            Удалить с группу тимлидом
                        </a>
                        <div class="modal fade" id="deleteCommand" data-bs-backdrop="static"
                             data-bs-keyboard="false" tabindex="-1"
                             aria-labelledby="deleteCommand" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="deleteCommand">Предупреждение</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('employee.delete-command', $user->id) }}"
                                          method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <p class="text-center"> Точно хотите удалить группу</p>
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

{{--                             remove role in team-lead end       --}}

        @else
{{--                role to team-lead start--}}

                <a role="button" class="btn btn-outline-success mb-2 mx-2" data-bs-toggle="modal"
                   data-bs-target="#role">
                    Сделать тимлидом каманды
                </a>
                <!-- Modal -->
                <div class="modal fade" id="role" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                     aria-labelledby="role" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="role">Выберите роль</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form action="{{ route('employee.teamLead', $user->id) }}" method="POST">
                                @csrf
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="project">Выберите проект</label>
                                        <select name="project" id="project" required class="form-select">
                                            <option value="">Выберите проект</option>
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mt-4">
                                        <label for="role">Выберите роль</label>
                                        <select name="role" id="role" required class="form-select">
                                            <option value="">Выберите роль</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mt-4">
                                        <div>
                                            <label for="users">Выберите участники команда <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="mt-4 w-100">
                                            <select multiple id="users" class="" name="users[]" class="form-select">
                                                @foreach($users as $u)
                                                    @if($u->id !== \Illuminate\Support\Facades\Auth::user()->id)
                                                        <option
                                                            value="{{ $u->id }}">{{ $u->surname . ' ' . $u->name . ' ' . $u->lastname}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена
                                    </button>
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

{{--                role to team-lead end--}}
            @endif


        @if(!$user->getRoleNames()->contains('crm'))
            {{--     Role to CRM start     --}}
            <a role="button" class="btn btn-outline-primary mb-2" data-bs-toggle="modal" data-bs-target="#roleToCRM">
                Включить доступ к CRM
            </a>
            <!-- Modal -->
            <div class="modal fade" id="roleToCRM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="roleToCRM" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="roleToCRM">Включить доступ к CRM</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('employee.roleToCrm', $user->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                Вы точно хотите включить доступ к CRM
                                на {{ $user->surname. ' ' .$user->name. ' '. $user->lastname }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                <button type="submit" class="btn btn-primary">Включить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{--     Role to CRM end     --}}

        @else
            {{--      Remove trle to CRM start     --}}
            <a role="button" class="btn btn-outline-danger mb-2" data-bs-toggle="modal" data-bs-target="#removeRoleCRM">
                Отключить доступ к CRM
            </a>
            <!-- Modal -->
            <div class="modal fade" id="removeRoleCRM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="removeRoleCRM" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="removeRoleCRM">Отключить доступ к CRM</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('employee.removeRoleToCrm', $user->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                Вы точно хотите отключить доступ к CRM
                                на {{ $user->surname. ' ' .$user->name. ' '. $user->lastname }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                <button type="submit" class="btn btn-danger">Отключить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{--     Remove role to CRM end     --}}
        @endif
            @include('inc.messages')

            <section class="section">
                <div class="row pt-4">
                    <div class="col-9">
                        @if(!empty($user->getRoleNames()[1]))
                            <div class="row">
                                <div class="col-6">
                                    <h4>Участники</h4>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex justify-content-end">

                                        <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#addUser"><i class="bi bi-person-plus mx-3"></i>
                                            Добавить
                                            сотрпудник к камандой
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
                                                    <form
                                                        action="{{ route('employee.add-user-in-command', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group mt-4">
                                                                <label for="select_users_command">Выберите участники
                                                                    команда
                                                                    <span
                                                                        class="text-danger">*</span></label>
                                                                <select multiple id="users" class="" name="users[]"
                                                                        class="form-select">
                                                                    @foreach ($users as $u)
                                                                        @php
                                                                            $isInCommand = false;
                                                                        @endphp

                                                                        @foreach ($userCommand->myCommand($user->id) as $use)
                                                                            @if ($u->id === $use->id)
                                                                                @php
                                                                                    $isInCommand = true;
                                                                                    break;
                                                                                @endphp
                                                                            @endif
                                                                        @endforeach

                                                                        @if ($u->id !== $user->id && !$isInCommand)
                                                                            <option
                                                                                value="{{ $u->id }}">{{ $u->surname . ' ' . $u->name . ' ' . $u->lastname }}</option>
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
                                </div>
                            </div>




                            <table class="table table-hover bg-white rounded-4 mt-3">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>ФИО</th>
                                    <th>Проект</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userCommand->myCommand($user->id) as $use)
                                    @if($use->id !== $user->id)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $use->surname . ' ' . $use->name . ' ' . $use->lastname }}</td>
                                            <td>{{ $use->project }}</td>
                                            <td>
                                                <a role="button" data-bs-toggle="modal"
                                                   data-bs-target="#deleteFromCommand"
                                                   class="badge bg-danger"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteFromCommand" data-bs-backdrop="static"
                                             data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteFromCommand"
                                             aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="deleteFromCommand">Modal
                                                            title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <form
                                                        action="{{ route('employee.delete-from-command', [$use->id, $use->pro_id,$user->id]) }}"
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
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        @endif


                        <div class="card mt-4">
                            <div class="card-header">
                                <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">
                                    Задачи
                                </a>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Имя</th>
                                        <th>Тип</th>
                                        <th>От</th>
                                        <th>До</th>
                                        <th>Статус</th>
                                        <th>Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($project_tasks as $project_task)
                                        <tr>
                                            <td>{{ $project_task->name }}</td>
                                            <td>{{ ($project_task->type === null) ? "От клиента" : $project_task->type->name }}</td>
                                            <td>{{  \Carbon\Carbon::createFromFormat('Y-m-d', $project_task->from)->format('d-m-Y') }}</td>
                                            <td>{{  \Carbon\Carbon::createFromFormat('Y-m-d', $project_task->to)->format('d-m-Y') }}</td>
                                            @switch($project_task->status->id)
                                                @case($project_task->status->id === 1)
                                                <td><span
                                                        class="badge bg-warning">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                                @case($project_task->status->id === 2)
                                                <td><span
                                                        class="badge bg-success">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                                @case($project_task->status->id === 3)
                                                <td><span
                                                        class="badge bg-success">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                                @case($project_task->status->id === 4)
                                                <td><span
                                                        class="badge bg-primary">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                                @case($project_task->status->id === 5)
                                                <td><span
                                                        class="badge bg-danger">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                                @case($project_task->status->id === 6)
                                                <td>
                                                    <span
                                                        class="badge bg-light-info">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                                @case($project_task->status->id === 7)
                                                <td>
                                                    <span
                                                        class="badge bg-secondary">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                                @case($project_task->status->id === 8)
                                                <td><span
                                                        class="badge bg-warning">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                                @case($project_task->status->id === 9)
                                                <td><span
                                                        class="badge bg-warning">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                                @case($project_task->status->id === 10)
                                                <td>
                                                    <span
                                                        class="badge bg-light-info">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                                @case($project_task->status->id === 11)
                                                <td><span
                                                        class="badge bg-danger">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                                @case($project_task->status->id === 12)
                                                <td><span
                                                        class="badge bg-danger">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                                @case($project_task->status->id === 13)
                                                <td><span
                                                        class="badge bg-danger">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                                @case($project_task->status->id === 14)
                                                <td>
                                                    <span
                                                        class="badge bg-light-info">{{ $project_task->status->name }}</span>
                                                </td>
                                                @break
                                            @endswitch
                                            <td class="">
                                                <a href="{{ route('tasks.show', $project_task->id) }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                            </td>
                                        </tr>
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


                        <div class="card">
                            <div class="card-header">
                                <h5 class="text-center">Список завершенных задач</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Имя</th>
                                        <th>Статус</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($project_tasks as $task)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $task->to }}</td>
                                            <td>{{ $task->status->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">

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
