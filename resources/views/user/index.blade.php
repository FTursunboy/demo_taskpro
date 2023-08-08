@extends('user.layouts.app')

@section('title')
    Панель
@endsection

@section('content')

    <div id="page-heading">

        <section class="section">
            <div class="row">
                <div class="col-6 col-lg-3  col-md-">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a href="{{ route('all-tasks.index') }}">
                                <div class="row">
                                    <div
                                        class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42"
                                                 fill="currentColor" class="bi bi-card-checklist text-white"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                <path
                                                    d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Все задачи.</h6>
                                        <h6 class="font-extrabold mb-0">{{ $task['all'] }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6" id="new">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a data-bs-toggle="offcanvas" data-bs-target="#newTasks"
                               aria-controls="ProjectOfCanvas">
                                <div class="row">
                                    <div
                                        class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42"
                                                 fill="currentColor" class="bi bi-calendar-check text-white fs-2"
                                                 viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                      d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                                <path
                                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                                <path
                                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Новые задачи</h6>
                                        <h6 class="font-extrabold mb-0">{{ $new_tasks }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6" id="progress">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a data-bs-toggle="offcanvas" data-bs-target="#tasksInProgress"
                               aria-controls="tasksInProgress">
                                <div class="row">
                                    <div
                                        class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon mb-2" style="background: #eef511;">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 viewBox="0,0,256,256" width="32px" height="32px"
                                                 fill-rule="nonzero">
                                                <g fill="#ffffff" fill-rule="nonzero" stroke="none"
                                                   stroke-width="1" stroke-linecap="butt"
                                                   stroke-linejoin="miter" stroke-miterlimit="10"
                                                   stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                   font-weight="none" font-size="none" text-anchor="none"
                                                   style="mix-blend-mode: normal">
                                                    <g transform="scale(8,8)">
                                                        <path
                                                            d="M16,4c-6.61719,0 -12,5.38281 -12,12c0,6.61719 5.38281,12 12,12c6.61719,0 12,-5.38281 12,-12c0,-6.61719 -5.38281,-12 -12,-12zM16,6c5.53516,0 10,4.46484 10,10c0,5.53516 -4.46484,10 -10,10c-5.53516,0 -10,-4.46484 -10,-10c0,-5.53516 4.46484,-10 10,-10zM15,8v9h7v-2h-5v-7z"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">В процессе</h6>
                                        <h6 class="font-extrabold mb-0">{{ $task['inProgress'] }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6" id="inspeed">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a data-bs-toggle="offcanvas" data-bs-target="#speed"
                               aria-controls="speed">
                                <div class="row">
                                    <div
                                        class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 viewBox="0,0,256,256" width="32px" height="32px"
                                                 fill-rule="nonzero">
                                                <g fill="#ffffff" fill-rule="nonzero" stroke="none"
                                                   stroke-width="1" stroke-linecap="butt"
                                                   stroke-linejoin="miter" stroke-miterlimit="10"
                                                   stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                   font-weight="none" font-size="none" text-anchor="none"
                                                   style="mix-blend-mode: normal">
                                                    <g transform="scale(8,8)">
                                                        <path
                                                            d="M16,4c-6.61719,0 -12,5.38281 -12,12c0,6.61719 5.38281,12 12,12c6.61719,0 12,-5.38281 12,-12c0,-6.61719 -5.38281,-12 -12,-12zM16,6c5.53516,0 10,4.46484 10,10c0,5.53516 -4.46484,10 -10,10c-5.53516,0 -10,-4.46484 -10,-10c0,-5.53516 4.46484,-10 10,-10zM15,8v9h7v-2h-5v-7z"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Просроченные</h6>
                                        <h6 class="font-extrabold mb-0">{{ $task['speed'] }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6" id="admin">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a data-bs-toggle="offcanvas" data-bs-target="#verAdmin"
                               aria-controls="verAdmin">
                                <div class="row">
                                    <div
                                        class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon mb-2" style="background: #ab9b93;">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 viewBox="0,0,256,256" width="32px" height="32px"
                                                 fill-rule="nonzero">
                                                <g fill="#ffffff" fill-rule="nonzero" stroke="none"
                                                   stroke-width="1" stroke-linecap="butt"
                                                   stroke-linejoin="miter" stroke-miterlimit="10"
                                                   stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                   font-weight="none" font-size="none" text-anchor="none"
                                                   style="mix-blend-mode: normal">
                                                    <g transform="scale(8,8)">
                                                        <path
                                                            d="M16,4c-6.61719,0 -12,5.38281 -12,12c0,6.61719 5.38281,12 12,12c6.61719,0 12,-5.38281 12,-12c0,-6.61719 -5.38281,-12 -12,-12zM16,6c5.53516,0 10,4.46484 10,10c0,5.53516 -4.46484,10 -10,10c-5.53516,0 -10,-4.46484 -10,-10c0,-5.53516 4.46484,-10 10,-10zM15,8v9h7v-2h-5v-7z"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">На проверке <b>(Админ)</b></h6>
                                        <h6 class="font-extrabold mb-0">{{ $ver_admin }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6" id="client">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a data-bs-toggle="offcanvas" data-bs-target="#verClient"
                               aria-controls="verClient">
                                <div class="row">
                                    <div
                                        class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon mb-2" style="background: orange;">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 viewBox="0,0,256,256" width="32px" height="32px"
                                                 fill-rule="nonzero">
                                                <g fill="#ffffff" fill-rule="nonzero" stroke="none"
                                                   stroke-width="1" stroke-linecap="butt"
                                                   stroke-linejoin="miter" stroke-miterlimit="10"
                                                   stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                   font-weight="none" font-size="none" text-anchor="none"
                                                   style="mix-blend-mode: normal">
                                                    <g transform="scale(8,8)">
                                                        <path
                                                            d="M16,4c-6.61719,0 -12,5.38281 -12,12c0,6.61719 5.38281,12 12,12c6.61719,0 12,-5.38281 12,-12c0,-6.61719 -5.38281,-12 -12,-12zM16,6c5.53516,0 10,4.46484 10,10c0,5.53516 -4.46484,10 -10,10c-5.53516,0 -10,-4.46484 -10,-10c0,-5.53516 4.46484,-10 10,-10zM15,8v9h7v-2h-5v-7z"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">На проверке <b>(Клиент)</b></h6>
                                        <h6 class="font-extrabold mb-0">{{ $tasks_count }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6" id="rejectClient">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a data-bs-toggle="offcanvas" data-bs-target="#reject"
                            aria-controls="reject">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon mb-2" style="background: red">
                                            <svg width="35px" height="35px" viewBox="0 0 48 48" version="1"
                                                 xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 48 48">
                                                <path fill="#FFFFFF"
                                                      d="M24,6C14.1,6,6,14.1,6,24s8.1,18,18,18s18-8.1,18-18S33.9,6,24,6z M24,10c3.1,0,6,1.1,8.4,2.8L12.8,32.4 C11.1,30,10,27.1,10,24C10,16.3,16.3,10,24,10z M24,38c-3.1,0-6-1.1-8.4-2.8l19.6-19.6C36.9,18,38,20.9,38,24C38,31.7,31.7,38,24,38z"/>
                                            </svg>

                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Отклонено (Клиент)</h6>
                                        <h6 class="font-extrabold mb-0">{{ $rejectClientCount }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6" id="archiveTasks">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a data-bs-toggle="offcanvas" data-bs-target="#archive"
                               aria-controls="archive">
                                <div class="row">
                                    <div
                                        class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42"
                                                 fill="currentColor" class="bi bi-check2-all text-white"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                                <path
                                                    d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Архив</h6>
                                        <h6 class="font-extrabold mb-0">{{$task['success']}}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div>
                    <input type="hidden" value="{{$task['inProgress'] }}" id="taskProgressId">
                    <input type="hidden" value="{{$task['speed'] }}" id="taskSpeedId">
                    <input type="hidden" value="{{$ver_admin }}" id="taskVerAdminId">
                    <input type="hidden" value="{{$tasks_count }}" id="taskVerClientId">
                    <input type="hidden" value="{{$rejectClientCount }}" id="taskRejectId">
                    <input type="hidden" value="{{$task['success'] }}" id="tasksuccessId">
                </div>

{{--                <div class="col-6 col-lg-4 col-md-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body px-4 py-4-5">--}}
{{--                            <div class="gauge">--}}
{{--                                <span class="text-center" style="font-size: 18px; float: right; margin-right: 40px">Оценка со стороны администратора</span>--}}
{{--                                <div class="gauge__body">--}}
{{--                                    <div class="gauge__fill"></div>--}}
{{--                                    <div id="counter"  class="gauge__cover"></div><span class="z-10">%</span>--}}
{{--                                    <div id="arrow" class="arrow"></div>--}}
{{--                                </div>--}}
{{--                                    <input id="testParam" type="hidden" min="0" value="{{ $admin_rating * 20 }}" max="100">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="col-6 col-lg-4 col-md-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body px-4 py-4-5">--}}
{{--                            <div class="gauge">--}}
{{--                                <span style="font-size: 18px; float: right; margin-right: 40px">Оценка со стороны администратора</span>--}}
{{--                                <div class="gauge__body">--}}
{{--                                    <div class="gauge__fill"></div>--}}
{{--                                    <div id="counter"  class="gauge__cover"></div><span class="z-10">%</span>--}}
{{--                                    <div id="arrow" class="arrow"></div>--}}
{{--                                </div>--}}
{{--                                    <input id="testParam" type="hidden" min="0" value="{{ $admin_rating * 20 }}" max="100">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-4 col-lg-4-lg-4 col-md-4">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body px-4 py-4-5">--}}
{{--                            <p>Процент выполненных задач этого месяца</p>--}}
{{--                            <div class="card-body">--}}
{{--                                <div id="radialGradient"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


                <div class="col-xl-6">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title mb-0">Статистика задач</h4>
                        </div>
                        <div class="card-body">
                            <div id="column_chart_datalabel" data-colors='["#5156be"]' class="apex-charts" dir="ltr"></div>

                        <div class="card-body px-4 py-4-5">
                            <p class="text-center">Процент выполненных задач</p>
                            <div class="card-body" style="margin-top: -70px; margin-bottom: -70px">
                                <div id="radialGradient"></div>
                            </div>
                        </div>
                    </div>
                </div>

{{--                <div class="col-6 col-lg-4 col-md-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body px-4 py-4-5">--}}
{{--                            <div class="gauge_user">--}}
{{--                                <span class="text-center" style="font-size: 18px; float: right; margin-right: 40px">Оценка со стороны клиента</span>--}}
{{--                                <div class="gauge__body_user">--}}
{{--                                    <div class="gauge__fill_user"></div>--}}
{{--                                    <div id="counter_user"  class="gauge__cover_user"></div><span class="z-10">%</span>--}}
{{--                                    <div id="arrow_user" class="arrow_user"></div>--}}
{{--                                </div>--}}
{{--                                <input id="testParam_user" type="hidden" min="0" value="{{ $user_rating * 20 }}" max="100">--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!--end card-->--}}
{{--                </div>--}}

{{--                <div class="col-6 col-lg-4 col-md-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body px-4 py-4-5">--}}
{{--                            <div class="gauge_user">--}}
{{--                                <span style="font-size: 18px; float: right; margin-right: 40px">Оценка со стороны клиента</span>--}}
{{--                                <div class="gauge__body_user">--}}
{{--                                    <div class="gauge__fill_user"></div>--}}
{{--                                    <div id="counter_user"  class="gauge__cover_user"></div><span class="z-10">%</span>--}}
{{--                                    <div id="arrow_user" class="arrow_user"></div>--}}
{{--                                </div>--}}
{{--                                <input id="testParam_user" type="hidden" min="0" value="{{ $user_rating * 20 }}" max="100">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </section>
    </div>

    @include('user.pages.newTasks')
    @include('user.pages.tasksInProgress')
    @include('user.pages.speed')
    @include('user.pages.verAdmin')
    @include('user.pages.verClient')
    @include('user.pages.reject')
    @include('user.pages.archive')
    @include('user.vendor_scripts')

@endsection

@section('css')
<style>
    .gauge {
        width: 100%;
        max-width: 520px;
        font-family: "Roboto", sans-serif;
        font-size: 32px;
        color: #004033;
    }

    .gauge__body {
        width: 100%;
        height: 0;
        padding-bottom: 50%;
        background: #b4c0be;
        position: relative;
        border-top-left-radius: 100% 200%;
        border-top-right-radius: 100% 200%;
        overflow: hidden;
    }

    .gauge__fill {
        position: absolute;
        top: 100%;
        left: 0;
        width: inherit;
        height: 100%;
        background: #009578;
        transform-origin: center top;
        transform: rotate(0.25turn);
        transition: transform 0.2s ease-out;
    }

    .gauge__cover {
        width: 75%;
        height: 150%;
        background: #ffffff;
        border-radius: 50%;
        position: absolute;
        top: 25%;
        left: 50%;
        transform: translateX(-50%);

        /* Text */
        display: flex;
        align-items: center;
        justify-content: center;
        padding-bottom: 25%;
        box-sizing: border-box;
    }
    .gauge__fill {
        /* Добавьте следующую строку */
        background-image: linear-gradient(to left, red 5%, yellow 50%, green 100%);
    }

    .counter {
        font-weight: bold;
        font-size: 1.2em;
        color: #2c3e50;
        margin: 0.3em 0;
        z-index: 999;
    }

    .arrow {
        position: absolute;
        bottom: 5px;
        left: 50%;
        margin-left: -1px;
        width: 1px;
        height: 143px;
        border: 1px solid;
        border-color: #2c3e50;
        border-radius: 100% 100% 0 0;
        background-color: black;
        transform: rotate(-50deg);
        transform-origin: bottom center;
        transition: transform 0.8s;
        transition-timing-function: cubic-bezier(0.65, 1.95, 0.03, 0.32);
        z-index: 999;
    }

    .arrow:after {
        content: "";
        display: block;
        height: 14px;
        width: 14px;
        background-color: #2c3e50;
        border-radius: 100%;
        position: absolute;
        bottom: -1px;
        left: -6px;
        z-index: 999;
    }

    .gauge_user {
        width: 100%;
        max-width: 520px;
        font-family: "Roboto", sans-serif;
        font-size: 32px;
        color: #004033;
    }

    .gauge__body_user {
        width: 100%;
        height: 0;
        padding-bottom: 50%;
        background: #b4c0be;
        position: relative;
        border-top-left-radius: 100% 200%;
        border-top-right-radius: 100% 200%;
        overflow: hidden;
    }

    .gauge__fill_user {
        position: absolute;
        top: 100%;
        left: 0;
        width: inherit;
        height: 100%;
        background: #009578;
        transform-origin: center top;
        transform: rotate(0.25turn);
        transition: transform 0.2s ease-out;
    }

    .gauge__cover_user {
        width: 75%;
        height: 150%;
        background: #ffffff;
        border-radius: 50%;
        position: absolute;
        top: 25%;
        left: 50%;
        transform: translateX(-50%);

        /* Text */
        display: flex;
        align-items: center;
        justify-content: center;
        padding-bottom: 25%;
        box-sizing: border-box;
    }
    .gauge__fill_user {
        /* Добавьте следующую строку */
        background-image: linear-gradient(to left, red 5%, yellow 50%, green 100%);
    }

    .counter_user {
        font-weight: bold;
        font-size: 1.2em;
        color: #2c3e50;
        margin: 0.3em 0;
        z-index: 999;
    }

    .arrow_user {
        position: absolute;
        bottom: 5px;
        left: 50%;
        margin-left: -1px;
        width: 1px;
        height: 143px;
        border: 1px solid;
        border-color: #2c3e50;
        border-radius: 100% 100% 0 0;
        background-color: black;
        transform: rotate(-50deg);
        transform-origin: bottom center;
        transition: transform 0.8s;
        transition-timing-function: cubic-bezier(0.65, 1.95, 0.03, 0.32);
        z-index: 999;
    }

    .arrow_user:after {
        content: "";
        display: block;
        height: 14px;
        width: 14px;
        background-color: #2c3e50;
        border-radius: 100%;
        position: absolute;
        bottom: -1px;
        left: -6px;
        z-index: 999;
    }

    #new:hover{
        cursor: pointer;
    }
    #progress:hover{
        cursor: pointer;
    }
    #inspeed:hover{
        cursor: pointer;
    }
    #admin:hover{
        cursor: pointer;
    }
    #client:hover{
        cursor: pointer;
    }
    #rejectClient:hover{
        cursor: pointer;
    }
    #archiveTasks:hover{
        cursor: pointer;
    }

</style>
@endsection


@section('script')
{{--    <script src="{{asset('assets/extensions/apexcharts/apexcharts.min.js')}}"></script>--}}
{{--    <script src="{{asset('assets/js/pages/ui-apexchart.js')}}"></script>--}}
{{--    <script src="{{asset('assets1/libs/apexcharts/apexcharts.min.js')}}"></script>--}}

<script src="{{asset('assets/js/apexcharts.init.js')}}"></script>

    <script>

        var taskProgressId = parseInt(document.getElementById('taskProgressId').value);
        var taskSpeedId = parseInt(document.getElementById('taskSpeedId').value);
        var taskVerAdminId = parseInt(document.getElementById('taskVerAdminId').value);
        var taskVerClientId = parseInt(document.getElementById('taskVerClientId').value);
        var taskRejectId = parseInt(document.getElementById('taskRejectId').value);
        var taskSuccessId = parseInt(document.getElementById('tasksuccessId').value);

        var sum = taskProgressId + taskSpeedId + taskVerAdminId + taskVerClientId + taskRejectId + taskSuccessId;
        taskProgressId = parseFloat(((taskProgressId * 100) / sum).toFixed(2));
        taskSpeedId = parseFloat(((taskSpeedId * 100) / sum).toFixed(2));
        taskVerAdminId = parseFloat(((taskVerAdminId * 100) / sum).toFixed(2));
        taskVerClientId = parseFloat(((taskVerClientId * 100) / sum).toFixed(2));
        taskRejectId = parseFloat(((taskRejectId * 100) / sum).toFixed(2));
        taskSuccessId = parseFloat(((taskSuccessId * 100) / sum).toFixed(2));


var columnDatalabelColors = getChartColorsArray("#column_chart_datalabel");
var options = {
    chart: {
        height: 350,
        type: 'bar',
        toolbar: {
            show: false,
        }
    },
    plotOptions: {
        bar: {
            borderRadius: 10,
            dataLabels: {
                position: 'top', // top, center, bottom
            },
        }
    },
    dataLabels: {
        enabled: true,
        formatter: function (val) {
            return val + "%";
        },
        offsetY: -22,
        style: {
            fontSize: '12px',
            colors: ["#304758"]
        }
    },
    series: [{
        name: 'Процент',
        data: [taskSuccessId, taskProgressId, taskSpeedId, taskVerAdminId, taskVerClientId, taskRejectId]
    }],
    colors: columnDatalabelColors,
    grid: {
        borderColor: '#f1f1f1',
    },
    xaxis: {
        categories: ["Готовые", "В процессе", "Просроченные", "На проверке (Админ)", "На проверке (Клиент)", "Отклонено(Клиент)"],
        position: 'top',
        labels: {
            offsetY: -10,

        },
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        },
        crosshairs: {
            fill: {
                type: 'gradient',
                gradient: {
                    colorFrom: '#D8E3F0',
                    colorTo: '#BED1E6',
                    stops: [0, 100],
                    opacityFrom: 0.4,
                    opacityTo: 0.5,
                }
            }
        },
        tooltip: {
            enabled: true,
            offsetY: -35,
        }
    },

    yaxis: {
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false,
        },
        labels: {
            show: false,
            formatter: function (val) {
                return val + "%";
            }
        }
    },
}

var chart = new ApexCharts(
    document.querySelector("#column_chart_datalabel"),
    options
);

chart.render();

    </script>
    <script>
        const gaugeElement = document.querySelector(".gauge");

        function setGaugeValue(gauge, value) {
            if (value < 0 || value > 1) {
                return;
            }

            gauge.querySelector(".gauge__fill").style.transform = `rotate(${
                value / 2
            }turn)`;
            gauge.querySelector(".gauge__cover").textContent = `${Math.round(
                value * 100
            )}%`;
        }


        setGaugeValue(gaugeElement, 1);

        $(document).ready(function() {
            function setValue(_val) {
                var START = -90;
                var delta = 1.8;
                $('#counter').text(Math.round(_val * 10) / 10 + '%');
                deg = START + _val * delta;
                if (deg > 120) {
                    deg = 120;
                }
                $('#arrow').css({ "transform": 'rotate(' + deg + 'deg)' });
            };

            $("#testParam").change(function() {
                var value = $(this).val();
                setValue(value);
            }).change();
        });
        const gaugeElement_user = document.querySelector(".gauge_user");

        function setGaugeValue_user(gauge, value) {
            if (value < 0 || value > 1) {
                return;
            }

            gauge.querySelector(".gauge__fill_user").style.transform = `rotate(${
                value / 2
            }turn)`;
            gauge.querySelector(".gauge__cover_user").textContent = `${Math.round(
                value * 100
            )}%`;
        }


        setGaugeValue_user(gaugeElement_user, 1);

        $(document).ready(function() {
            function setValue_user(_val) {
                var START = -90;
                var delta = 1.8;
                $('#counter_user').text(Math.round(_val * 10) / 10 + '%');
                deg = START + _val * delta;
                if (deg > 120) {
                    deg = 120;
                }
                $('#arrow_user').css({ "transform": 'rotate(' + deg + 'deg)' });
            };

            $("#testParam_user").change(function() {
                var value = $(this).val();
                setValue_user(value);
            }).change();
        });

    </script>
@endsection

