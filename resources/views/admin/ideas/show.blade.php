@extends('user.layouts.app')
@section('content')
    <div id="app">

        <div id="main">

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Показ идеи</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Идеи</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Добавление</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card-body">
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
                                        <input disabled name="from" value="{{$idea->from}}"
                                               placeholder="Введите срок" type="text"
                                               class="form-control datetimepicker-input"
                                               data-target="#reservationdate"/>

                                        <div class="input-group-append" data-target="#reservationdate"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                            </div>
                                        </div>

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
                                        <input disabled name="to" value="{{$idea->to}}"
                                               placeholder="Введите срок"
                                               type="text" class="form-control datetimepicker-input"
                                               data-target="#reservationdated"/>

                                        <div disabled class="input-group-append"
                                             data-target="#reservationdated"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                            </div>
                                        </div>

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

                </section>
            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">

                </div>
            </footer>
        </div>
    </div>

    <div class="modal" id="store" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить тип</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('settings.project.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <div>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


