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
            @if(!$project->is_active)
                <h5 style="margin-left: 100px" class="offcanvas-title" id="createtaskClient">Ваш договор СОПР не активен. Вы не можете отправить задачу</h5>
            @endif

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">
                    <li class="nav-item" style="margin-top: -10px; margin-right: 0px">
                        <a data-bs-toggle="offcanvas" data-bs-target="#creatTaskClient"
                           aria-controls="ideasOfCanvasUser" style="margin-left: 20px;">
                            <i style="font-size: 31px;" class="bi bi-plus-circle"></i>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-top: -10px; margin-right: 20px">
                        <a data-bs-toggle="offcanvas" data-bs-target="#ideasOfCanvasUser"
                           aria-controls="ideasOfCanvasUser" style="margin-left: 20px;">
                            <i style="font-size: 30px;" class="bi bi-lightbulb"></i>
                        </a>
                    </li>
                </ul>
                <div class="drop down">
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

                        <li><a class="dropdown-item" href="{{ route('client_profile.index')}}"><i


                                    class="icon-mid bi bi-person me-2"></i>Мой профиль</a></li>
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

<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="ideasOfCanvasUser"
     aria-labelledby="ideasOfCanvasUser" style="width: 100%; height: 80%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="ideasOfCanvasUser">
            <span style="margin-right: 20px">Идеи</span>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#CreateSystemIdeaModal">Добавить идею для системы
            </button>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Статус</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($systemIdeasOfDashboardClient as $idea)
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
                                    <td>
                                        <a data-bs-toggle="modal"
                                           data-bs-target="#SystemIdeasShowDashboardUserShow{{ $idea->id }}"
                                           class="badge bg-success" role="button"><i class="bi bi-eye"></i></a>
                                        <a data-bs-toggle="modal"
                                           data-bs-target="#SystemIdeasShowDashboardUserEdit{{ $idea->id }}"
                                           class="badge bg-primary" role="button"><i class="bi bi-pencil"></i></a>
                                        <a data-bs-toggle="modal"
                                           data-bs-target="#SystemIdeasShowDashboardUserDelete{{ $idea->id }}"
                                           class="badge bg-danger" role="button"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>

                                <!-- Modal Show Start -->
                                <div class="modal fade" id="SystemIdeasShowDashboardUserShow{{ $idea->id }}"
                                     data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1"
                                     aria-labelledby="SystemIdeasShowDashboardUserShow{{ $idea->id }}"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5"
                                                    id="SystemIdeasShowDashboardUserShow{{ $idea->id }}">
                                                    Названия: {{\Str::limit($idea->name, 60)}}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="#"
                                                      enctype="multipart/form-data" autocomplete="off">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <!-- textarea -->
                                                            <div class="form-group">
                                                                <label>Название</label>
                                                                <input disabled name="name" class="form-control"
                                                                       placeholder="Введите имя идеи ..."
                                                                       value="{{$idea->name}}">
                                                            </div>
                                                            @if($idea->comment)
                                                                <div class="form-group">
                                                                    <label>Комментарий</label>
                                                                    <textarea disabled name="comment"  class="form-control" rows="5"
                                                                    >{{$idea->comment}}</textarea>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Описание</label>
                                                                <textarea disabled name="description"
                                                                          class="form-control"
                                                                          rows="5"
                                                                          placeholder="Введите описание идеи ...">{{$idea->description}}</textarea>
                                                            </div>
                                                            <div style="margin-top: 30px" class="col md-3">
                                                                <i class="bi bi-paperclip">
                                                                    <a style="margin-left: 0px"
                                                                       href="{{ route('client.system-idea.downloadFile', $idea->id) }}"
                                                                       download>Просмотреть файл</a>
                                                                </i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                    Назад
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Show End -->



                                <!-- Modal Edit Start -->
                                <div class="modal fade" id="SystemIdeasShowDashboardUserEdit{{ $idea->id }}"
                                     data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1"
                                     aria-labelledby="SystemIdeasShowDashboardUserEdit{{ $idea->id }}"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5"
                                                    id="SystemIdeasShowDashboardUserEdit{{ $idea->id }}">
                                                    Названия: {{\Str::limit($idea->name, 60)}}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form method="POST"
                                                  action="{{ route('client.system-idea.update', $idea->id) }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <!-- textarea -->
                                                            <div class="form-group">
                                                                <label>Название</label>
                                                                <textarea name="name" class="form-control" rows="3"
                                                                          placeholder="Введите имя идеи ..."
                                                                          required>{{$idea->name}}</textarea>
                                                            </div>
                                                            @if($idea->comment)
                                                                <div class="form-group">
                                                                    <label>Комментарий</label>
                                                                    <textarea disabled name="comment"  class="form-control" rows="5"
                                                                    >{{$idea->comment}}</textarea>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Описание</label>
                                                                <textarea name="description" class="form-control"
                                                                          rows="5"
                                                                          placeholder="Введите описание идеи ..."
                                                                          required>{{$idea->description}}</textarea>
                                                            </div>
                                                            <div style="margin-top: 30px" class="col md-3">
                                                                <i class="bi bi-paperclip">
                                                                    <a style="margin-left: 0px"
                                                                       href="{{ route('client.system-idea.downloadFile', $idea->id) }}"
                                                                       download>Просмотреть файл</a>
                                                                </i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">
                                                        Отмена
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Обновить</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Edit End -->



                                <!-- Modal Delete Start -->
                                <div class="modal fade" id="SystemIdeasShowDashboardUserDelete{{ $idea->id }}"
                                     data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1"
                                     aria-labelledby="SystemIdeasShowDashboardUserDelete{{ $idea->id }}"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5"
                                                    id="SystemIdeasShowDashboardUserDelete{{ $idea->id }}">
                                                    Названия: {{\Str::limit($idea->name, 60)}}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form method="post"
                                                  action="{{ route('client.system-idea.destroy', $idea->id) }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <p class="text-center">Точно хотите удалить идею?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                        Назад
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        Удалить идею
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Delete End -->

                            @empty
                                <td colspan="5" class="text-center fs-4">Пока нет идей</td>
                            @endforelse
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{--  Ideas  ofCanvas Start  --}}


{{--  Create Idea Modal End  --}}
<div class="modal fade" id="CreateSystemIdeaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="CreateSystemIdeaModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="CreateSystemIdeaModal">Добавить идею для системы</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{route('client.system-idea.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Идея</label>
                                <input
                                    name="name"
                                    class="form-control"
                                    placeholder="Введите имя идеи ..."
                                    value="{{ old('name') }}"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Описание</label>
                                <textarea required name="description" class="form-control" rows="3"
                                          placeholder="Введите описание идеи ...">{{ old('description') }}</textarea>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Выберите файл</label>
                                <input type="file" name="file" class="form-control" id="exampleInputFile">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="creatTaskClient"
     aria-labelledby="createtaskClient" style="width: 100%; height: 80%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="createtaskClient">Новая задача</h5>
        @if(!$project->is_active)
            <h5 class="offcanvas-title" id="createtaskClient">Ваш договор СОПР не активен. Вы не можете отправить задачу</h5>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="container my-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9">
                    <form method="post" action="{{route('offers.store')}}"
                          enctype="multipart/form-data"
                          autocomplete="off">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Название задачи</label>
                                <textarea {{!$project->is_active ? 'disabled' : ''}} id="name" class="form-control"
                                          name="name"
                                          rows="5" required>{{ old('name') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ответственный сотрудник со стороны
                                    компании</label>
                                <input {{!$project->is_active ? 'disabled' : ''}} type="text"
                                       class="form-control"
                                       name="author_name" id="author_name"
                                       value="{{ auth()->user()->name ?? old('author_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Телефон ответсвенного сотрудника</label>
                                <input {{!$project->is_active ? 'disabled' : ''}} type="text"
                                       class="form-control"
                                       name="author_phone" id="author_phone"
                                       value="{{ auth()->user()->phone ?? old('author_phone') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Выберите файл</label>
                                <input {{!$project->is_active ? 'disabled' : ''}} type="file"
                                       class="form-control"
                                       name="file">
                            </div>
                            <div class="col-12">
                                <label for="your-message" class="form-label">Описание
                                    задачи</label>
                                <textarea {{!$project->is_active ? 'disabled' : ''}} id="description" class="form-control"
                                          name="description"
                                          rows="5">{{ old('description') }}</textarea>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <button  type="button" class="btn btn-success form-control"
                                        id="btnSend">
                                    Отправить
                                </button>
                            </div>
                            <script>
                                const btn = document.getElementById('btnSend')
                                btn.addEventListener('click', function () {
                                    const name = document.getElementById('name')
                                    const author_name = document.getElementById('author_name')
                                    const phone = document.getElementById('author_phone')
                                    if (name.value !== '' && author_name.value !== '' && phone.value !== '') {
                                        btn.type = 'submit';
                                        btn.click();
                                        btn.classList.add('disabled')
                                    } else {
                                        name.classList.add('border-danger')
                                        author_name.classList.add('border-danger')
                                        phone.classList.add('border-danger')
                                        btn.classList.remove('disabled')
                                    }
                                })
                            </script>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Create SystemIdead Modal End --}}
