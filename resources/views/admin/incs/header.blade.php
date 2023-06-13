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

                <ul class="navbar-nav ms-auto mb-lg-0">

                    <li class="nav-item" style="margin-top: -10px;">
                        @if($command_task > 0)
                            <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Задача с Тим-лидом"   style="margin-left: 20px;"
                               href="{{route('tasks-team-leads.all-tasks')}}"><i id="commandCount" style="font-size: 30px;" class="bi bi-people"></i></a>
                        @else
                            <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Задача с Тим-лидом"  style="margin-left: 20px" href="{{route('tasks-team-leads.all-tasks')}}"><i
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
                                    color: rgba(220,12,10,0.2);
                                }
                                100% {
                                    color: red;
                                }
                            }
                        </style>
                    </li>

                    <li class="nav-item" style="margin-top: -10px; margin-right: 20px">
                        @if($ideas_count > 0)
                            <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Идеи сотрудников" style="margin-left: 20px;" href="{{route('admin.ideas')}}"><i  id="ideasCount" style="font-size: 30px;" class="bi bi-lightbulb-fill"></i></a>
                        @else
                            <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Идеи сотрудников" style="margin-left: 20px" href="{{route('admin.ideas')}}"><i style="font-size: 30px"
                                                                                            class="bi bi-lightbulb"></i></a>
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
                                        color: rgba(220,12,10,0.2);
                                    }
                                    100% {
                                        color: red;
                                    }
                                }
                            </style>
                    </li>

                    <li class="nav-item" style="margin-top: -10px; margin-right: 30px">
                        <a data-bs-toggle="offcanvas" data-bs-target="#TelegramOfCanvas" aria-controls="TelegramOfCanvas" style="color: #6C757D; font-size: 18px" role="button" ><i
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
<div class="offcanvas offcanvas-end"  data-bs-backdrop="static" tabindex="-1" id="TelegramOfCanvas" aria-labelledby="TelegramOfCanvas" style="width: 1000px">
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
