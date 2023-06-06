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

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">

{{--                    <li class="nav-item dropdown me-1">--}}
{{--                        <a class="nav-link active dropdown-toggle text-gray-600" href="#"--}}
{{--                           data-bs-toggle="dropdown"--}}
{{--                           aria-expanded="false">--}}
{{--                            <i class='bi bi-envelope bi-sub fs-4'></i>--}}
{{--                        </a>--}}
{{--                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">--}}
{{--                            <li>--}}
{{--                                <h6 class="dropdown-header">Задачи</h6>--}}
{{--                            </li>--}}
{{--                            <li><a class="dropdown-item" href="#">Нет новой задачи</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

{{--                    <li class="nav-item dropdown me-3">--}}
{{--                        <a class="nav-link active dropdown-toggle text-gray-600" href="#"--}}
{{--                           data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">--}}
{{--                            <i class='bi bi-bell{{ (count($newMessage) > 0) ? '-fill' : '' }} fs-4 {{ (count($newMessage) > 0) ? 'highlight-icon' : '' }}'></i>--}}
{{--                        </a>--}}
{{--                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown"--}}
{{--                            aria-labelledby="dropdownMenuButton">--}}
{{--                            <li class="dropdown-header">--}}
{{--                                <h6>Новые сообщение</h6>--}}
{{--                            </li>--}}
{{--                            @foreach($newMessage as $mess)--}}

{{--                                <li class="dropdown-item notification-item">--}}
{{--                                    <a class="d-flex align-items-center" href="{{ route('task-list.removeNotification',$mess->task_id) }}">--}}
{{--                                        <div class="notification-icon">--}}
{{--                                            <i class="bi bi-bell text-primary"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="notification-text ms-4">--}}
{{--                                            <p class="notification-title font-bold">--}}
{{--                                                <b>SMS:</b>{{ \Str::limit($mess->message, 10)  }}</p>--}}
{{--                                            <p class="notification-subtitle font-thin text-sm d-flex">--}}
{{--                                                <b>Задача:</b>{{ $mess->tasks->name }}</p>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}

{{--                        </ul>--}}
{{--                    </li>--}}
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ \Illuminate\Support\Facades\Auth::user()->surname.' '. \Illuminate\Support\Facades\Auth::user()->name }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ \Illuminate\Support\Facades\Auth::user()->getRoleNames()[0] }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/'. Illuminate\Support\Facades\Auth::user()->avatar)}}">
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
                            <h6 class="dropdown-header">Привет, {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                !</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('user_profile.index', auth()->id())}}"><i
                                    class="icon-mid bi bi-person me-2"></i>Мой профиль</a></li>
                        <hr class="dropdown-divider">
                        <li><a role="button" class='dropdown-item' data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                                    class="icon-mid bi bi-box-arrow-left me-2"></i> Выход</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
