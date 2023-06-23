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
                    <li class="nav-item" style="margin-top: -10px; margin-right: 10px"" >
                        <a data-bs-toggle="offcanvas" data-bs-target="#ProjectOfCanvas"
                           aria-controls="ProjectOfCanvas" style="margin-left: 10px;"
                           role="button">
                            <i class="bi bi-wallet" style="font-size: 31px;"></i>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-top: -10px; margin-right: 10px">
                        <a data-bs-toggle="offcanvas" data-bs-target="#ideasOfCanvasUser"
                           aria-controls="ideasOfCanvasUser">
                            <i id="ideasCount" style="font-size: 30px;"  class="bi bi-lightbulb"></i>
                        </a>
                    </li>

                    <li class="nav-item" style="margin-top: -10px; margin-right: 20px">
                        <a data-bs-toggle="offcanvas" data-bs-target="#notesUserList"
                           aria-controls="notesUserList">
                            <i style="font-size: 30px;" class="bi bi-journal-check"></i>
                        </a>
                    </li>
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
                        <li><a role="button" class='dropdown-item' data-bs-toggle="modal"
                               data-bs-target="#staticBackdrop"><i
                                        class="icon-mid bi bi-box-arrow-left me-2"></i> Выход</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>



{{--  Notes  ofCanvas Start --}}
<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="notesUserList"
     aria-labelledby="notesUserList" style="width: 40%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="notesUserList">
            <span style="margin-right: 20px">Заметка</span>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#createNotesUsers">Новая заметка
            </button>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Заметка</th>
                <th width="30" class="text-center">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notes as $note)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $note->note }}</td>
                <td width="30" class="text-center">
                    <a role="button" class="badge bg-primary" data-bs-toggle="modal" data-bs-target="#updateNoteUsers{{ $note->id }}"><i class="bi bi-pencil"></i></a>
                    <a role="button" class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#deleteNoteUsers{{ $note->id }}"><i class="bi bi-trash"></i></a>
                </td>
            </tr>

            <div class="modal fade" id="updateNoteUsers{{ $note->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateNoteUsers{{ $note->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="updateNoteUsers{{ $note->id }}">{{ $note->note }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('notes.update', $note->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <label for="note">Заметка</label>
                                <textarea name="note" id="note" cols="30" rows="5" class="form-control" required>{{ $note->note }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="deleteNoteUsers{{ $note->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteNoteUsers{{ $note->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteNoteUsers{{ $note->id }}">{{ $note->note }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('notes.delete', $note->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <label for="note">Заметка</label>
                                <textarea name="note" id="note" cols="30" rows="5" class="form-control" disabled>{{ $note->note }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                <button type="submit" class="btn btn-danger">Удалит</button>
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

<!-- Modal -->
<div class="modal fade" id="createNotesUsers" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createNotesUsers" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createNotesUsers">Добавить новая заметка</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('notes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label for="note">Новая заметка</label>
                    <textarea name="note" id="note" cols="30" rows="5" class="form-control" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--  Notes  ofCanvas Start  --}}





{{--  Ideas  ofCanvas Start --}}
<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="ideasOfCanvasUser"
     aria-labelledby="ideasOfCanvasUser" style="width: 100%; height: 80%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="ideasOfCanvasUser">
            <span style="margin-right: 20px">Идеи</span>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#CreateIdeaModal">Добавить идею
            </button>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#CreateSystemIdeaModal">Добавить идею для системы
            </button>
        </h5>
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
                                   role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Идея</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="margin-top: -4px" id="custom-tabs-one-profile-tab"
                                   data-bs-toggle="pill" href="#custom-tabs-one-profile" role="tab"
                                   aria-controls="custom-tabs-one-profile" aria-selected="false">Системная идея</a>
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
                                        <th>Сотрудник</th>
                                        <th>Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($ideasOfDashboardUser as $idea)
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
                                                <a data-bs-toggle="modal" data-bs-target="#ideasShowDashboardUserShow{{ $idea->id }}"
                                                   class="badge bg-success" role="button"><i class="bi bi-eye"></i></a>
                                                <a data-bs-toggle="modal" data-bs-target="#ideasShowDashboardUserEdit{{ $idea->id }}"
                                                   class="badge bg-primary" role="button"><i class="bi bi-pencil"></i></a>

                                            </td>
                                        </tr>

                                        <!-- Modal Show Start -->
                                        <div class="modal fade" id="ideasShowDashboardUserShow{{ $idea->id }}" data-bs-backdrop="static"
                                             data-bs-keyboard="false" tabindex="-1"
                                             aria-labelledby="ideasShowDashboardUserShow{{ $idea->id }}"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="ideasShowDashboardUserShow{{ $idea->id }}">
                                                            Названия: {{\Str::limit($idea->title, 60)}}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
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
                                                                        <textarea disabled name="description" class="form-control"
                                                                                  rows="5"
                                                                                  placeholder="Введите описание идеи ...">{{$idea->description}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Срок от:</label>
                                                                    <div class="input-group date" id="reservationdate"
                                                                         data-target-input="nearest">
                                                                        <input disabled name="from" value="{{$idea->from}}" type="text"
                                                                               class="form-control"/>

                                                                    </div>
                                                                    <div style="margin-top: 30px" class="col md-3">
                                                                        <i class="bi bi-paperclip">
                                                                            <a style="margin-left: 0px" href="{{ route('idea.idea.downloadFile', $idea->id) }}" download>Просмотреть файл</a>
                                                                        </i>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-3">

                                                                    <label>До:</label>
                                                                    <div class="input-group date" id="reservationdated"
                                                                         data-target-input="nearest">
                                                                        <input type="text" disabled name="to" value="{{$idea->to}}"
                                                                               class="form-control"/>


                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    @if($idea->comment)
                                                                        <div class="form-group">
                                                                            <label>Комментарий</label>
                                                                            <textarea disabled name="comment"  class="form-control" rows="5"
                                                                            >{{$idea->comment}}</textarea>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Назад
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Show End -->



                                        <!-- Modal Edit Start -->
                                        <div class="modal fade" id="ideasShowDashboardUserEdit{{ $idea->id }}" data-bs-backdrop="static"
                                             data-bs-keyboard="false" tabindex="-1"
                                             aria-labelledby="ideasShowDashboardUserEdit{{ $idea->id }}"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="ideasShowDashboardUserEdit{{ $idea->id }}">
                                                            Названия: {{\Str::limit($idea->title, 60)}}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST" action="{{ route('idea.idea.update', $idea->id) }}"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <!-- textarea -->
                                                                    <div class="form-group">
                                                                        <label>Идея</label>
                                                                        <textarea name="title" class="form-control" rows="3"
                                                                                  placeholder="Введите имя идеи ...">{{$idea->title}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <!-- textarea -->
                                                                    <div class="form-group">
                                                                        <label>Бюджет</label>
                                                                        <textarea name="budget" class="form-control" rows="3"
                                                                                  placeholder="Введите бюджет ...">{{$idea->budget}}</textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Плюсы</label>
                                                                        <textarea name="pluses" class="form-control" rows="3"
                                                                                  placeholder="Введите плюсы идеи ...">{{$idea->pluses}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Минусы</label>
                                                                        <textarea name="minuses" class="form-control" rows="3"
                                                                                  placeholder="Введите минусы идеи ...">{{$idea->minuses}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Описание</label>
                                                                        <textarea name="description" class="form-control"
                                                                                  rows="5"
                                                                                  placeholder="Введите описание идеи ...">{{$idea->description}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Срок от:</label>
                                                                    <div class="input-group date" id="reservationdate"
                                                                         data-target-input="nearest">
                                                                        <input name="from" value="{{$idea->from}}" type="text"
                                                                               class="form-control"/>

                                                                    </div>
                                                                    <div style="margin-top: 30px" class="col md-3">
                                                                        <i class="bi bi-paperclip">
                                                                            <a style="margin-left: 0px" href="{{ route('idea.idea.downloadFile', $idea->id) }}" download>Просмотреть файл</a>
                                                                        </i>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-3">

                                                                    <label>До:</label>
                                                                    <div class="input-group date" id="reservationdated"
                                                                         data-target-input="nearest">
                                                                        <input type="text" name="to" value="{{$idea->to}}"
                                                                               class="form-control"/>


                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    @if($idea->comment)
                                                                        <div class="form-group">
                                                                            <label>Комментарий</label>
                                                                            <textarea disabled name="comment"  class="form-control" rows="5"
                                                                            >{{$idea->comment}}</textarea>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
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

                                        <!-- Modal Delete End -->


                                    @empty
                                        <td colspan="8" class="text-center fs-4">Пока нет идей</td>
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
                                        <th>Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($systemIdeasOfDashboardUser as $idea)
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
                                                <a data-bs-toggle="modal" data-bs-target="#SystemIdeasShowDashboardUserShow{{ $idea->id }}"
                                                   class="badge bg-success" role="button"><i class="bi bi-eye"></i></a>
                                                <a data-bs-toggle="modal" data-bs-target="#SystemIdeasShowDashboardUserEdit{{ $idea->id }}"
                                                   class="badge bg-primary" role="button"><i class="bi bi-pencil"></i></a>

                                            </td>
                                        </tr>

                                        <!-- Modal Show Start -->
                                        <div class="modal fade" id="SystemIdeasShowDashboardUserShow{{ $idea->id }}" data-bs-backdrop="static"
                                             data-bs-keyboard="false" tabindex="-1"
                                             aria-labelledby="SystemIdeasShowDashboardUserShow{{ $idea->id }}"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="SystemIdeasShowDashboardUserShow{{ $idea->id }}">
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
                                                                                  placeholder="Введите имя идеи ..." value="{{$idea->name}}">
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
                                                                        <textarea disabled name="description" class="form-control"
                                                                                  rows="5"
                                                                                  placeholder="Введите описание идеи ..." >{{$idea->description}}</textarea>
                                                                    </div>
                                                                    <div style="margin-top: 30px" class="col md-3">
                                                                        <i class="bi bi-paperclip">
                                                                            <a href="{{ route('idea.system.downloadFileUser', $idea->id) }}" download>Просмотреть файл</a>
                                                                        </i>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Назад
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Show End -->



                                        <!-- Modal Edit Start -->
                                        <div class="modal fade" id="SystemIdeasShowDashboardUserEdit{{ $idea->id }}" data-bs-backdrop="static"
                                             data-bs-keyboard="false" tabindex="-1"
                                             aria-labelledby="SystemIdeasShowDashboardUserEdit{{ $idea->id }}"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="SystemIdeasShowDashboardUserEdit{{ $idea->id }}">
                                                            Названия: {{\Str::limit($idea->name, 60)}}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST" action="{{ route('idea.system.ideas.update', $idea->id) }}"
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
                                                                                  placeholder="Введите имя идеи ..." required>{{$idea->name}}</textarea>
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
                                                                                  placeholder="Введите описание идеи ..." required>{{$idea->description}}</textarea>
                                                                    </div>
                                                                    <div style="margin-top: 30px" class="col md-3">
                                                                        <i class="bi bi-paperclip">
                                                                            <a style="margin-left: 0px" href="{{ route('idea.system.downloadFileUser', $idea->id) }}" download>Просмотреть файл</a>
                                                                        </i>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
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
                                                        <h1 class="modal-title fs-5" id="SystemIdeasShowDashboardUserDelete{{ $idea->id }}">
                                                            Названия: {{\Str::limit($idea->name, 60)}}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" action="{{ route('idea.system.ideas.destroy', $idea->id) }}"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">
                                                            <p class="text-center">Точно хотите удалить идею?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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
        </div>
    </div>
</div>
{{--  Ideas  ofCanvas Start  --}}


{{--  Create Idea Modal Start  --}}
<div class="modal fade" id="CreateIdeaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="CreateIdeaModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="CreateIdeaModal">Добавить идею для системы</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{route('idea.idea.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Идея</label>
                                <textarea required name="title" class="form-control" rows="3"
                                          placeholder="Введите имя идеи ...">{{ old('title') }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Описание</label>
                                <textarea required name="description" class="form-control" rows="3"
                                          placeholder="Введите описание идеи ...">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Плюсы</label>
                                <textarea required name="pluses" class="form-control" rows="3"
                                          placeholder="Введите плюсы идеи ...">{{ old('pluses') }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Минусы</label>
                                <textarea required name="minuses" class="form-control" rows="3"
                                          placeholder="Введите минусы идеи ...">{{ old('minuses') }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Бюджет</label>
                                <textarea required name="budget" class="form-control" rows="4"
                                          placeholder="Введите бюджет ...">{{ old('budget') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Срок от:</label>
                            <input required name="from" value="{{old('from')}}" type="date" class="form-control"/>

                        </div>
                        <div class="col-md-3">
                            <label>До:</label>
                            <input required value="{{old('to')}}" name="to" type="date" class="form-control"/>
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

{{--  Create Idea Modal End  --}}
<div class="modal fade" id="CreateSystemIdeaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="CreateSystemIdeaModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="CreateSystemIdeaModal">Добавить идею</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('idea.system.ideas.store') }}" enctype="multipart/form-data">
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

{{-- Create SystemIdead Modal End --}}


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
                            <th class="text-center">Готовые</th>
                            <th class="text-center">В процессе</th>
                            <th class="text-center" style="width: 130px;">На проверке (У клиента)</th>
                            <th class="text-center" style="width: 130px;">На проверке (У админа)</th>
                            <th class="text-center" style="width: 130px;">Просроченное</th>
                            <th class="text-center" style="width: 130px;">Прочее</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projectTasksOfDashboardUser->unique('project_id') as $task)
                            <tr class="">
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $task?->project?->name}}</td>
                                <td class="text-center">{{ $task?->project?->count_task_user()}}</td>
                                <td class="text-center">{{ $task?->project?->count_ready_user() }}</td>
                                <td class="text-center">{{ $task?->project?->count_process_user() }}</td>
                                <td class="text-center">{{ $task?->project?->count_verificateClient_user() }}</td>
                                <td class="text-center">{{ $task?->project?->count_verificateAdmin_user() }}</td>
                                <td class="text-center">{{ $task?->project?->count_outOfDate_user() }}</td>
                                <td class="text-center">{{ $task?->project?->count_other_user() }}</td>
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


