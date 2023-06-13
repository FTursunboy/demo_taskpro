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

                    <li class="nav-item" style="margin-top: -10px; margin-right: 10px">
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

                    <li class="nav-item" style="margin-top: -10px; margin-right: 10px">
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
                        <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Телеграм" style="color: #6C757D; font-size: 18px" href="{{route('telegram.index')}}">&nbsp;&nbsp; <i
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
