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
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a href="{{ route('all-tasks.new', \Illuminate\Support\Facades\Auth::id()) }}">
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
                                        <h6 class="font-extrabold mb-0">{{ $task['new'] }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a href="{{ route('all-tasks.inProgress')  }}">
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
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a href="{{ route('all-tasks.speed') }}">
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
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a href="{{ route('all-tasks.verificate_admin') }}">
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
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a href="{{ route('all-tasks.verificate_client') }}">
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

                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a href="{{ route('all-tasks.reject') }}">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon mb-2" style="background: red">
                                            <svg width="35px" height="35px" viewBox="0 0 48 48" version="1" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 48 48">
                                                <path fill="#FFFFFF" d="M24,6C14.1,6,6,14.1,6,24s8.1,18,18,18s18-8.1,18-18S33.9,6,24,6z M24,10c3.1,0,6,1.1,8.4,2.8L12.8,32.4 C11.1,30,10,27.1,10,24C10,16.3,16.3,10,24,10z M24,38c-3.1,0-6-1.1-8.4-2.8l19.6-19.6C36.9,18,38,20.9,38,24C38,31.7,31.7,38,24,38z"/>
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
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <a href="{{ route('all-tasks.success') }}">
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

                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="gauge">
                                <span style="font-size: 18px; float: right; margin-right: 40px">Оценка со стороны администратора</span>
                                <div class="gauge__body">
                                    <div class="gauge__fill"></div>
                                    <div id="counter"  class="gauge__cover"></div><span class="z-10">%</span>
                                    <div id="arrow" class="arrow"></div>
                                </div>
                                    <input id="testParam" type="hidden" min="0" value="{{ $admin_rating * 20 }}" max="100">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

@endsection

@section('script')
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

    </script>
@endsection


