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
                    <li class="nav-item" style="margin-top: -10px; margin-right: 20px">
                        <a data-bs-toggle="offcanvas" data-bs-target="#ideasOfCanvasUser"
                           aria-controls="ideasOfCanvasUser" style="margin-left: 20px;">
                            <i style="font-size: 30px;" class="bi bi-lightbulb-fill"></i>
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


{{--  Ideas  ofCanvas Start --}}
<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="ideasOfCanvasUser"
     aria-labelledby="ideasOfCanvasUser" style="width: 100%; height: 80%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="ideasOfCanvasUser">
            <span style="margin-right: 20px">Идеи</span>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#CreateIdeaModal">Добавить идея
            </button>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <div class="card-body">
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
                                <a data-bs-toggle="modal" data-bs-target="#ideasShowDashboardUserShow{{ $idea->id }}" class="badge bg-success" role="button"><i class="bi bi-eye"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#ideasShowDashboardUserEdit{{ $idea->id }}" class="badge bg-primary" role="button"><i class="bi bi-pencil"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#ideasShowDashboardUserDelete{{ $idea->id }}" class="badge bg-danger" role="button"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>

                        <!-- Modal Show Start -->
                        <div class="modal fade" id="ideasShowDashboardUserShow{{ $idea->id }}" data-bs-backdrop="static"
                             data-bs-keyboard="false" tabindex="-1" aria-labelledby="ideasShowDashboardUserShow{{ $idea->id }}"
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
                                                    <div style="margin-top: 30px" class="col md-3"><i
                                                                class="bi bi-paperclip"><a style="margin-left: 0px"
                                                                                           href="{{asset('/storage/' . $idea->file)}}">Просмотреть
                                                                файл</a></i>
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
                                                    <div class="form-group">
                                                        <label>Комментарий</label>
                                                        <textarea name="comment" class="form-control" rows="5"
                                                                  placeholder="Напишите комментарий ...">{{$idea->comments}}</textarea>
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
                        <div class="modal fade" id="ideasShowDashboardUserEdit{{ $idea->id }}" data-bs-backdrop="static"
                             data-bs-keyboard="false" tabindex="-1" aria-labelledby="ideasShowDashboardUserEdit{{ $idea->id }}"
                             aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="ideasShowDashboardUserEdit{{ $idea->id }}">
                                            Названия: {{\Str::limit($idea->title, 60)}}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('idea.idea.update', $idea->id) }}" enctype="multipart/form-data">
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
                                                        <div style="margin-top: 30px" class="col md-3"><i
                                                                    class="bi bi-paperclip"><a style="margin-left: 0px"
                                                                                               href="{{asset('/storage/' . $idea->file)}}">Просмотреть
                                                                    файл</a></i>
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
                                                        <div class="form-group">
                                                            <label>Комментарий</label>
                                                            <textarea name="comment" disabled class="form-control" rows="5"
                                                                      placeholder="Напишите комментарий ...">{{$idea->comments}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                                            <button type="submit" class="btn btn-primary">Обновить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit End -->



                        <!-- Modal Delete Start -->
                        <div class="modal fade" id="ideasShowDashboardUserDelete{{ $idea->id }}" data-bs-backdrop="static"
                             data-bs-keyboard="false" tabindex="-1" aria-labelledby="ideasShowDashboardUserDelete{{ $idea->id }}"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="ideasShowDashboardUserDelete{{ $idea->id }}">
                                            Названия: {{\Str::limit($idea->title, 60)}}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="{{ route('idea.idea.destroy', $idea->id) }}" enctype="multipart/form-data">
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
                        <td colspan="8" class="text-center fs-4">Пока нет идей</td>
                    @endforelse
                    </tbody>
                </table>
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
                <h1 class="modal-title fs-5" id="CreateIdeaModal">Добавить идею</h1>
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
                                <textarea name="title" class="form-control" rows="3"
                                          placeholder="Введите имя идеи ...">{{ old('title') }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Описание</label>
                                <textarea name="description" class="form-control" rows="3"
                                          placeholder="Введите описание идеи ...">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Плюсы</label>
                                <textarea name="pluses" class="form-control" rows="3"
                                          placeholder="Введите плюсы идеи ...">{{ old('pluses') }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Минусы</label>
                                <textarea name="minuses" class="form-control" rows="3"
                                          placeholder="Введите минусы идеи ...">{{ old('minuses') }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Бюджет</label>
                                <textarea name="budget" class="form-control" rows="4"
                                          placeholder="Введите бюджет ...">{{ old('budget') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Срок от:</label>
                            <div class="input-group date" id="reservationdate"
                                 data-target-input="nearest">
                                <input name="from" value="{{old('from')}}" placeholder="Введите срок"
                                       type="date"
                                       class="form-control datetimepicker-input"
                                       data-target="#reservationdate"/>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>До:</label>
                            <div class="input-group date" id="reservationdated"
                                 data-target-input="nearest">
                                <input value="{{old('to')}}" name="to" placeholder="Введите срок"
                                       type="date"
                                       class="form-control datetimepicker-input"
                                       data-target="#reservationdated"/>
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
{{--  Create Idea Modal End  --}}