<style>
    .highlight-icon {
        color: red; /* Цвет иконки */

        padding: 5px; /* Отступы вокруг иконки */
        border-radius: 50%; /* Задание круглой формы */
    }
</style>

<header class='mb-3'>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mr-2" id="navbarSupportedContent">

                <a data-bs-toggle="offcanvas" data-bs-target="#ProjectOfCanvas"
                   aria-controls="ProjectOfCanvas" style="margin-left: 20px;"
                   role="button">
                    <i class="bi bi-wallet" style="font-size: 30px;"></i>
                </a>

                @if(count($birthdayUsers) > 1)
                    <div class="dropdown" style="margin-left: 300px;">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-menu d-flex">
                                <p>Ближайшие дни рождения: {{ count($birthdayUsers) }} сотрудника</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                            style="min-width: 11rem; margin-left: 300px">
                            <li>
                                <h6 class="dropdown-header">
                                    @foreach($birthdayUsers as $birthday)
                                        <p><b>{{ $birthday->name }}</b> - {{ date('d-m-Y' , strtotime($birthday->birthday))}} </p>
                                        <hr>
                                    @endforeach
                                </h6>
                            </li>
                        </ul>
                    </div>
                @else
                    <div style="margin-left: 300px;">
                    @foreach($birthdayUsers as $birthday)
                            <p>Ближайшее день рождение: <b>{{ $birthday->name }}</b> - {{ date('d-m-Y' , strtotime($birthday->birthday))}} </p>
                    @endforeach
                    </div>
                @endif

                <ul class="navbar-nav ms-auto mb-lg-0">

                    <li class="nav-item" style="margin-top: -10px;">


                        @if($command_task > 0)
                            <a data-bs-toggle="offcanvas" data-bs-target="#TeamLeadOfCanvas"
                               aria-controls="TeamLeadOfCanvas" style="margin-left: 20px;"
                               role="button"><i id="commandCount" style="font-size: 30px;" class="bi bi-people"></i></a>
                        @else
                            <a data-bs-toggle="offcanvas" data-bs-target="#TeamLeadOfCanvas"
                               aria-controls="TeamLeadOfCanvas" style="margin-left: 20px" role="button"><i
                                    style="font-size: 30px" class="bi bi-people"></i></a>
                        @endif
                        <style>
                            #commandCount {
                                animation: command 2s infinite;
                            }

                            @keyframes command {
                                0% {
                                    color: red;
                                }
                                50% {
                                    color: rgba(220, 12, 10, 0.2);
                                }
                                100% {
                                    color: red;
                                }
                            }
                        </style>
                    </li>

                    <li class="nav-item" style="margin-top: -10px; margin-right: 20px">
                        @if($ideas_count > 0 || $system_idea_count > 0)
                            <a  data-bs-toggle="offcanvas" data-bs-target="#ideasOfCanvas" aria-controls="ideasOfCanvas" style="margin-left: 20px;">
                                <i id="ideasCount" style="font-size: 30px;" class="bi bi-lightbulb-fill"></i>
                            </a>
                        @else
                            <a  data-bs-toggle="offcanvas" data-bs-target="#ideasOfCanvas" aria-controls="ideasOfCanvas" style="margin-left: 20px">
                                <i style="font-size: 30px" class="bi bi-lightbulb"></i>
                            </a>
                        @endif
                        <style>
                            #ideasCount {
                                animation: ideasCount 2s infinite;
                            }

                            @keyframes ideasCount {
                                0% {
                                    color: red;
                                }
                                50% {
                                    color: rgba(220, 12, 10, 0.2);
                                }
                                100% {
                                    color: red;
                                }
                            }
                        </style>
                    </li>

                    <li class="nav-item" style="margin-top: -10px; margin-right: 30px">
                        <a data-bs-toggle="offcanvas" data-bs-target="#TelegramOfCanvas"
                           aria-controls="TelegramOfCanvas" style="color: #6C757D; font-size: 18px" role="button"><i
                                style="color: #269EDA; font-size: 30px" class="bi bi-telegram"></i></a>
                    </li>

                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ Auth::user()->surname.' '. Auth::user()->name }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->getRoleNames()[0] }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    @if(Auth::user()->avatar)
                                        <img
                                            src="{{ asset('storage/'. Illuminate\Support\Facades\Auth::user()->avatar)}}">
                                    @else
                                        <img src="{{asset('assets/images/avatar-2.png')}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Привет, {{ Auth::user()->name }}
                                !</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i
                                    class="icon-mid bi bi-person me-2"></i>Мой профил</a></li>
                        <hr class="dropdown-divider">
                        <li><a role="button" class='dropdown-item' data-bs-toggle="modal"
                               data-bs-target="#staticBackdrop"><i
                                    class="icon-mid bi bi-box-arrow-left me-2"></i> Выход</a></li>
                    </ul>

                </div>

            </div>
        </div>
    </nav>
</header>


{{--  Telegram ofcanvas  --}}
<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="TelegramOfCanvas"
     aria-labelledby="TelegramOfCanvas" style="width: 1000px">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="TelegramOfCanvas">Телеграм</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <a role="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#telegramAll">
            Написать всем сразу
        </a>
        <div class="modal fade" id="telegramAll" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="telegramAll" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('telegram.sendAll') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="telegramAll">Написать всем</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="CMC">СМС</label><textarea name="message" id="CMC" class="form-control"
                                                                      rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>ФИО</th>
                <th width="150">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($usersTelegram as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->surname .' '.$user->name.' '. $user->lastname }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#onePerson{{ $user->id }}">Написать
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="onePerson{{ $user->id }}" data-bs-backdrop="static"
                     data-bs-keyboard="false" tabindex="-1"
                     aria-labelledby="onePerson{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('telegram.sendOne', $user->id) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="onePerson{{ $user->id }}">Написать
                                        на {{ $user->surname .' '.$user->name}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="CMC">СМС</label><textarea name="message" id="CMC"
                                                                              class="form-control"
                                                                              rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Отменить
                                    </button>
                                    <button type="submit" class="btn btn-primary">Отправить</button>
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
{{--  Telegram ofcanvas  end  --}}




{{--  TeamLead tasks ofCanvas Start --}}
<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="TeamLeadOfCanvas"
     aria-labelledby="TeamLeadOfCanvas" style="width: 100%; height: 80%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="TelegramOfCanvas">Список задач</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Задача</th>
                        <th>Проект</th>
                        <th>Исполнитель</th>
                        <th>Тимлид</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($tasksTeamLeads)>0)
                        @foreach($tasksTeamLeads as $task)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Str::limit($task->task_name, 20) }}</td>
                                <td>{{ $task->project }}</td>
                                <td>{{ $task->author_task_surname . ' ' . $task->author_task_name }}</td>
                                <td>{{ $task->author_surname . ' ' . $task->author_name }}</td>
                                <td>
                                    <a role="button" class="btn btn-success" data-bs-toggle="modal"
                                       data-bs-target="#taskTeamLead{{ $task->task_id }}"><i
                                            class="bi bi-eye"></i></a>
                                    {{--                                    <a  href="{{ route('tasks-team-leads.show', $task->task_slug) }}" class="btn btn-success "><i class="bi bi-eye"></i></a>--}}
                                    <a href="{{ route('tasks-team-leads.acceptTaskCommand', $task->task_slug) }}"
                                       class="btn btn-primary"><i class="bi bi-check"></i></a>
                                    <a href="{{ route('tasks-team-leads.declineTaskCommand', $task->task_slug) }}" class="btn btn-danger"><i class="bi bi-x"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="taskTeamLead{{ $task->task_id }}"
                                 data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                 aria-labelledby="taskTeamLead{{ $task->task_id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="taskTeamLead{{ $task->task_id }}">
                                                Информация
                                                <a href="{{ route('tasks-team-leads.acceptTaskCommand', $task->task_slug) }}" class="btn btn-primary">Принять</a>
                                                <a href="{{ route('tasks-team-leads.declineTaskCommand', $task->task_slug) }}" class="btn btn-danger">Отклонить</a>
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="name">Имя</label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="{{ $task->task_name }}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="user_id">Кому это задача</label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="{{ $task->author_surname . " " . $task->author_name }}"
                                                               disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="from">Дата начала задачи</label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="{{ $task->from }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="time">Время</label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="{{ $task->time }}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="project_id">Проект</label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="{{ $task->project }}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="to">Дата окончания задачи <span
                                                                id="project_finish"
                                                                style="color: red"></span> </label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="{{ $task->to }}" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="type_id">Тип</label>
                                                        <input type="text" class="form-control mt-3"
                                                               value="{{ $task->type }}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="comment">Комментария</label>
                                                        <textarea tabindex="10" name="comment" id="comment"
                                                                  rows="4"
                                                                  class="form-control mt-3"
                                                                  disabled>{{ $task->comment }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Отмена
                                            </button>
                                            {{--                                                            <button type="submit" class="btn btn-primary">Understood</button>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <td colspan="7" class="bg-secondary"><h3 class="text-center text-white">Пока нет задач</h3></td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{--  TeamLead tasks ofCanvas Start  --}}




{{--  Ideas  ofCanvas Start --}}
<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="ideasOfCanvas"
     aria-labelledby="TeamLeadOfCanvas" style="width: 100%; height: 80%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="TelegramOfCanvas">Список идеи</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <div class="card-body">
                <div class="row p-3">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist" style="border-radius: 20px">
                            <li class="nav-item">
                                <a style="border-radius: 5px; margin-top: -4px" class="nav-link active"
                                   id="custom-tabs-one-home-tab" data-bs-toggle="pill" href="#custom-tabs-one-home"
                                   role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Идея <span style="color:#ff0000;">{{ ($ideas_count > 0) ? '- ('.$ideas_count.')' : '' }}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="margin-top: -4px" id="custom-tabs-one-profile-tab"
                                   data-bs-toggle="pill" href="#custom-tabs-one-profile" role="tab"
                                   aria-controls="custom-tabs-one-profile" aria-selected="false">Системная идея <span style="color:#ff0000;">{{($system_idea_count > 0) ? '- ('.$system_idea_count.')' : ''  }}</span></a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-home-tab">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Название</th>
                                        <th>От</th>
                                        <th>До</th>
                                        <th>Описание</th>
                                        <th>Статус</th>
                                        <th>Автор</th>
                                        <th>Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($ideasOfDashboard as $idea)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{\Str::limit($idea->title, 20)}}</td>
                                            <td>{{$idea->from}}</td>
                                            <td>{{$idea->to}}</td>
                                            <td>{{\Illuminate\Support\Str::limit($idea->description, 20)}}</td>
                                            <td>
                                                @switch($idea->status->id)
                                                    @case($idea->status->id === 1)
                                                        {{$idea->status->name}}
                                                        @break

                                                    @case($idea->status->id === 2)
                                                        {{$idea->status->name}}
                                                        @break

                                                    @case($idea->status->id === 3)
                                                        {{$idea->status->name}}
                                                        @break

                                                    @case($idea->status->id === 4)
                                                        {{$idea->status->name}}
                                                        @break

                                                    @case($idea->status->id === 5)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 6)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 7)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 8)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 9)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 10)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 11)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 12)
                                                        {{$idea->status->name}} @break

                                                    @case($idea->status->id === 13)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 14)
                                                        {{$idea->status->name}} @break
                                                    @case($idea->status->id === 15)
                                                        {{$idea->status->name}} @break
                                                @endswitch
                                            </td>
                                            <td>{{$idea->user->surname . ' '.$idea->user->name }}</td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#ideasShowDashboard{{ $idea->id }}" class="badge bg-primary" role="button"><i class="bi bi-eye"></i></a>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="ideasShowDashboard{{ $idea->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ideasShowDashboard{{ $idea->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="ideasShowDashboard{{ $idea->id }}">Названия: {{\Str::limit($idea->title, 60)}}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('admin.ideas.update', $idea->id) }}"
                                                              enctype="multipart/form-data" autocomplete="off">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <!-- textarea -->
                                                                    <div class="form-group">
                                                                        <label>Идея</label>
                                                                        <textarea disabled name="title" class="form-control" rows="3"
                                                                                  placeholder="Введите имя идеи ...">{{$idea->title}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <!-- textarea -->
                                                                    <div class="form-group">
                                                                        <label>Бюджет</label>
                                                                        <textarea disabled name="budget" class="form-control" rows="3"
                                                                                  placeholder="Введите бюджет ...">{{$idea->budget}}</textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Плюсы</label>
                                                                        <textarea disabled name="pluses" class="form-control" rows="3"
                                                                                  placeholder="Введите плюсы идеи ...">{{$idea->pluses}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Минусы</label>
                                                                        <textarea disabled name="minuses" class="form-control" rows="3"
                                                                                  placeholder="Введите минусы идеи ...">{{$idea->minuses}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Описание</label>
                                                                        <textarea disabled name="description" class="form-control" rows="5"
                                                                                  placeholder="Введите описание идеи ...">{{$idea->description}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Срок от:</label>
                                                                    <div class="input-group date" id="reservationdate"
                                                                         data-target-input="nearest">
                                                                        <input disabled name="from" value="{{$idea->from}}" type="text" class="form-control"/>

                                                                    </div>
                                                                    <div style="margin-top: 30px" class="col md-3">
                                                                        <i class="bi bi-paperclip">
                                                                            <a style="margin-left: 0px" href="{{ route('admin.ideas.downloadFile', $idea->id) }}" download>Просмотреть файл</a>
                                                                        </i>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-3">

                                                                    <label>До:</label>
                                                                    <div class="input-group date" id="reservationdated"
                                                                         data-target-input="nearest">
                                                                        <input type="text" disabled name="to" value="{{$idea->to}}" class="form-control"/>


                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Комментарий</label>
                                                                        <textarea name="comment" class="form-control" rows="5"
                                                                                  placeholder="Напишите комментарий ...">{{$idea->comments}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if($idea->status->id ==1)
                                                            <div class="float-right">
                                                                <button typeof="button" class="btn btn-success" name="action" value="accept" type="submit"
                                                                        id="accept">Принять
                                                                </button>
                                                                <button typeof="button" class="btn btn-danger" name="action" value="decline" type="submit"
                                                                        id="decline">Отклонить
                                                                </button>
                                                                <button typeof="button" class="btn btn-warning" name="action" value="update" type="submit"
                                                                        id="inWork">На доработку
                                                                </button>
                                                            </div>
                                                            @endif
                                                            <script>
                                                                const btn = document.getElementById('accept')
                                                                btn.addEventListener('click', function () {
                                                                    btn.type = 'submit';
                                                                    btn.click();
                                                                    btn.classList.add('disabled')
                                                                })
                                                                const decline = document.getElementById('decline')
                                                                decline.addEventListener('click', function () {
                                                                    decline.type = 'submit';
                                                                    decline.click();
                                                                    decline.classList.add('disabled')

                                                                })
                                                                const inWork = document.getElementById('inWork')
                                                                inWork.addEventListener('click', function () {
                                                                    inWork.type = 'submit';
                                                                    inWork.click();
                                                                    inWork.classList.add('disabled')
                                                                })
                                                            </script>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Назад</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <td colspan="8" class="text-center ">Пока нет идей</td>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-profile-tab">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Название</th>
                                        <th>Описание</th>
                                        <th>Статус</th>
                                        <th>Автор</th>
                                        <th>Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($systemIdeasOfDashboard as $idea)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{\Str::limit($idea->name, 20)}}</td>
                                            <td>{{\Illuminate\Support\Str::limit($idea->description, 20)}}</td>
                                            <td>
                                                @switch($idea->status->id)
                                                    @case($idea->status->id === 1)
                                                        {{$idea->status->name}}
                                                        @break

                                                    @case($idea->status->id === 2)
                                                        {{$idea->status->name}}
                                                        @break

                                                    @case($idea->status->id === 3)
                                                        {{$idea->status->name}}
                                                        @break

                                                    @case($idea->status->id === 4)
                                                        {{$idea->status->name}}
                                                        @break

                                                    @case($idea->status->id === 5)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 6)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 7)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 8)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 9)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 10)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 11)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 12)
                                                        {{$idea->status->name}} @break

                                                    @case($idea->status->id === 13)
                                                        {{$idea->status->name}}@break

                                                    @case($idea->status->id === 14)
                                                        {{$idea->status->name}} @break
                                                    @case($idea->status->id === 15)
                                                        {{$idea->status->name}} @break
                                                @endswitch
                                            </td>
                                            <td>{{$idea->user->surname . ' '.$idea->user->name }}</td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#SystemIdeasShowDashboard{{ $idea->id }}" class="badge bg-primary" role="button"><i class="bi bi-eye"></i></a>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="SystemIdeasShowDashboard{{ $idea->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="SystemIdeasShowDashboard{{ $idea->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="SystemIdeasShowDashboard{{ $idea->id }}">Названия: {{\Str::limit($idea->title, 60)}}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('admin.system-ideas.update', $idea->id) }}"
                                                              enctype="multipart/form-data" autocomplete="off">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <!-- textarea -->
                                                                    <div class="form-group">
                                                                        <label>Название</label>
                                                                        <input disabled name="name" class="form-control"
                                                                               placeholder="Введите имя идеи ..." value="{{$idea->name}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Комментарий</label>
                                                                        <textarea name="comment"  class="form-control" rows="5"
                                                                        >{{$idea->comment}}</textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Описание</label>
                                                                        <textarea disabled name="description" class="form-control"
                                                                                  rows="5"
                                                                                  placeholder="Введите описание идеи ..." >{{$idea->description}}</textarea>
                                                                    </div>
                                                                    <div style="margin-top: 30px" class="col md-3">
                                                                        <i class="bi bi-paperclip">
                                                                            <a style="margin-left: 0px" href="{{ route('admin.system-ideas.downloadFile', $idea->id) }}" download>Просмотреть файл</a>
                                                                        </i>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        @if($idea->status->id == 1)
                                                            <div class="float-right">

                                                                <button typeof="button" class="btn btn-success" name="action" value="accept" type="submit"
                                                                        id="accept">Принять
                                                                </button>
                                                                <button typeof="button" class="btn btn-danger" name="action" value="decline" type="submit"
                                                                        id="decline">Отклонить
                                                                </button>
                                                                <button typeof="button" class="btn btn-warning" name="action" value="update" type="submit"
                                                                        id="inWork">На доработку
                                                                </button>
                                                            </div>
                                                            @endif
                                                            <script>
                                                                const btn = document.getElementById('accept')
                                                                btn.addEventListener('click', function () {
                                                                    btn.type = 'submit';
                                                                    btn.click();
                                                                    btn.classList.add('disabled')
                                                                })
                                                                const decline = document.getElementById('decline')
                                                                decline.addEventListener('click', function () {
                                                                    decline.type = 'submit';
                                                                    decline.click();
                                                                    decline.classList.add('disabled')

                                                                })
                                                                const inWork = document.getElementById('inWork')
                                                                inWork.addEventListener('click', function () {
                                                                    inWork.type = 'submit';
                                                                    inWork.click();
                                                                    inWork.classList.add('disabled')
                                                                })
                                                            </script>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Назад</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <td colspan="6" class="text-center ">Пока нет идей</td>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--  Ideas  ofCanvas Start  --}}




{{--  Project  --}}
<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="ProjectOfCanvas"
     aria-labelledby="ProjectOfCanvas" style="width: 100%; height: 80%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="ProjectOfCanvas">Проекты</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <div class="card-body overflow-hidden">
                    <div>
                        <table class="table table-hover mt-3 " cellpadding="5">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Название</th>
                                <th class="text-center">Количество задач</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasksOfDashboard as $task)
                                <tr class="">
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $task->name }}</td>
                                    <td class="text-center">{{ $task->count_task() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
{{--  Project ofcanvas  end  --}}


