<div id="sidebar" class="{{ request()->is('monitoring-tasks') ? '':'active'}}">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('admin.index') }}"><img src="{{asset('assets/images/logo/logo2.svg')}}" alt="Logo"
                                                              srcset=""></a>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20"
                         preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                           stroke-linejoin="round">
                            <path
                                d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                        <label class="form-check-label" for="toggle-dark"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                         preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor"
                              d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path>
                    </svg>
                </div>
                <div class="sidebar-toggler ">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Меню</li>
                <li class="sidebar-item {{ (request()->is('dashboard-admin') or request()->is('dashboard-admin/*'))  ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Панель</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('tasks') or request()->is('tasks/*'))  ? 'active' : '' }}">
                    <a href="{{ route('tasks.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Задачи</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('projects') or request()->is('projects/*'))  ? 'active' : '' }}">
                    <a href="{{ route('project.index') }}" class='sidebar-link'>
                        <i class="bi bi-hexagon-fill"></i>
                        <span>Проекты</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('monitoring-tasks') or request()->is('monitoring-tasks/*') or request()->is('monitoring/edit/*') or request()->is('monitoring/show-task/*'))  ? 'active' : '' }}">
                    <a href="{{ route('mon.index') }}" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Мониторинг</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('admin/ideas') or request()->is('admin/ideas/*'))  ? 'active' : '' }}">
                    <a href="{{route('admin.ideas')}}" class='sidebar-link'>
                        <i class="bi bi-journal-check"></i>
                        <span>Идеи</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub {{ (request()->is('clients/offers') or request()->is('clients/offers/*') or request()->is('client') or request()->is('client/*') or request()->is('tasks_client') or request()->is('tasks_client/*')) ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Партнеры
                            @if($offers_count > 0)
            <span class="offers-count">
                <span style="font-size: 13px; color: red">{{$offers_count}}</span>
            </span>
                            @endif
        </span>
                        @if($offers_count > 0)
                        <div class="notification-dot"></div>
                        @endif
                    </a>


                <style>
                    .sidebar-link {
                        position: relative;
                    }

                    .notification-dot {
                        position: absolute;
                        top: 50%;
                        right: -10px;
                        transform: translate(50%, -50%);
                        width: 10px;
                        height: 10px;
                        background-color: red;
                        border-radius: 50%;
                        animation: blink-animation 1s infinite;
                    }

                    @keyframes blink-animation {
                        0% {
                            opacity: 1;
                        }
                        50% {
                            opacity: 0;
                        }
                        100% {
                            opacity: 1;
                        }
                    }

                    .offers-count {
                        margin-left: 5px;
                    }
                </style>

                <ul class="submenu {{ (request()->is('clients/offers') or request()->is('clients/offers/*') or request()->is('client')or request()->is('client/*') or request()->is('tasks_client')or request()->is('tasks_client/*'))  ? 'active' : '' }}">
                        <li class="submenu-item {{ (request()->is('clients/offers') or request()->is('clients/offers/*'))  ? 'active' : '' }}">
                            <a href="{{route('client.offers.index')}}">Список задач</a>
                        </li>
                        <li class="submenu-item {{ (request()->is('client')or request()->is('client/*'))  ? 'active' : '' }}">
                            <a href="{{route('employee.client')}}">Клиенты</a>
                        </li>
                        <li class="submenu-item {{ (request()->is('tasks_client')or request()->is('tasks_client/*'))  ? 'active' : '' }}">
                            <a href="{{route('tasks_client.index')}}">Задачи клиента</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  {{ (request()->is('employees') or request()->is('employees/*'))  ? 'active' : '' }}">
                    <a href="{{ route('employee.index') }}" class='sidebar-link'>
                        <i class="bi bi-people"></i>
                        <span>Сотрудники</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub {{ (request()->is('settings/project') or request()->is('settings/project/*') or request()->is('settings/task')or request()->is('settings/task/*') or request()->is('settings/kpi')or request()->is('settings/kpi/*')or request()->is('settings/role')or request()->is('settings/role/*')or request()->is('settings/depart')or request()->is('settings/depart/*'))  ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Настройки</span>
                    </a>
                    <ul class="submenu {{ (request()->is('settings/project') or request()->is('settings/project/*') or request()->is('settings/task') or request()->is('settings/task/*') or request()->is('settings/kpi') or request()->is('settings/kpi/*')or request()->is('settings/role') or request()->is('settings/role/*')or request()->is('settings/depart') or request()->is('settings/depart/*'))  ? 'active' : '' }}">
{{--                        <li class="submenu-item {{ (request()->is('settings/role') or request()->is('settings/role/*'))  ? 'active' : '' }}">--}}
{{--                            <a href="{{ route('settings.role') }}">Роли</a>--}}
{{--                        </li>--}}
                        <li class="submenu-item {{ (request()->is('settings/depart') or request()->is('settings/depart/*'))  ? 'active' : '' }}">
                            <a href="{{ route('settings.depart') }}">Отдел</a>
                        </li>
                        <li class="submenu-item {{ (request()->is('settings/task') or request()->is('settings/task/*') or request()->is('settings/kpi') or request()->is('settings/kpi/*'))  ? 'active' : '' }}">
                            <a href="{{route('settings.task')}}">Задачи</a>
                        </li>
                        <li class="submenu-item {{ (request()->is('settings/project') or request()->is('settings/project/*'))  ? 'active' : '' }}">
                            <a href="{{route('settings.project')}}">Проекты</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{ (request()->is('telegram') or request()->is('telegram/*'))  ? 'active' : '' }}">
                    <a href="{{ route('telegram.index') }}" class='sidebar-link'>
                        <i class="bi bi-pentagon-fill"></i>
                        <span>Телеграмм</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('profile') or request()->is('profile/*'))  ? 'active' : '' }}">
                    <a href="{{ route('profile.index') }}" class='sidebar-link'>
                        <i class="bi bi-egg-fill"></i>
                        <span>Профиль</span>
                    </a>
                </li>


                <li class="sidebar-item  has-sub {{ (request()->is('lead') or request()->is('lead/*')or request()->is('contact')or request()->is('contact/*')or request()->is('event')or request()->is('event/*') or request()->is('calendar') or request()->is('calendar/*') or request()->is('setting') or request()->is('setting/*'))  ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>CRM</span>
                    </a>
                    <ul class="submenu {{ (request()->is('lead') or request()->is('lead/*') or request()->is('contact') or request()->is('contact/*') or request()->is('event') or request()->is('event/*') or request()->is('calendar') or request()->is('calendar/*') or request()->is('setting') or request()->is('setting/*'))  ? 'active' : '' }}">
                        <li class="submenu-item {{( request()->is('lead') or request()->is('lead/*')) ? 'active' : ''}} " >
                            <a href="{{route('lead.index')}}">Лиды</a>
                        </li>
                        <li class="submenu-item {{( request()->is('contact') or request()->is('contact/*')) ? 'active' : ''}}">
                            <a href="{{ route('contact.index') }}">Контакты</a>
                        </li>
                        <li class="submenu-item {{( request()->is('event') or request()->is('event/*')) ? 'active' : ''}}">
                            <a href="{{ route('event.index') }}">События</a>
                        </li>
                        <li class="submenu-item {{( request()->is('calendar') or request()->is('calendar/*')) ? 'active' : ''}} ">
                            <a href="{{route('calendar')}}">Календарь</a>
                        </li>
                        <li class="submenu-item {{( request()->is('setting') or request()->is('setting/*')) ? 'active' : ''}} ">
                            <a href="{{route('setting.index')}}">Настройки</a>
                        </li>
                    </ul>
                </li>


                <li
                        class="sidebar-item">
                    <a role="button" class='sidebar-link' data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="bi bi-door-open"></i>
                        <span>Выход</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Предупреждение</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Точно хотите выйти?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <a href="{{ route('logout') }}" class="btn btn-danger">Да</a>
            </div>
        </div>
    </div>
</div>
