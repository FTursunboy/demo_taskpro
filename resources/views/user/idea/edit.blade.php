@extends('user.layouts.app')
@section('title')
    $idea->title
@endsection

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>$idea->title</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('idea.ideas') }}">Идеи</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $idea->title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row ">
                <div class="row pt-4">
                    <div class="col-md-12">
                        @if($errors->any())
                            <div class="alert alert-danger w-100 text-center">Заполните
                                все поля
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-1">
                                        <a href="{{ route('idea.ideas') }}" class="btn btn-danger">Назад</a>
                                    </div>

                                </div>
                            </div>


                            @if(\Session::has('err'))
                                <div class="alert alert-danger mt-4">
                                    {{ \Session::get('err') }}
                                </div>
                        @endif
                        <!-- /.card-header -->
                            <div class="card-body">
                                <form method="post" action="{{route('idea.idea.update', $idea->id)}}"
                                      enctype="multipart/form-data"
                                      autocomplete="off ">
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <label>Идея</label>
                                                <textarea name="title" class="form-control" rows="3"
                                                          placeholder="Введите имя идеи ...">{{ $idea->title }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Описание</label>
                                                <textarea name="description" class="form-control" rows="3"
                                                          placeholder="Введите описание идеи ...">{{$idea->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Плюсы</label>
                                                <textarea name="pluses" class="form-control" rows="3"
                                                          placeholder="Введите плюсы идеи ...">{{ $idea->pluses }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Минусы</label>
                                                <textarea name="minuses" class="form-control" rows="3"
                                                          placeholder="Введите минусы идеи ...">{{ $idea->minuses }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <label>Бюджет</label>
                                                <textarea name="budget" class="form-control" rows="4"
                                                          placeholder="Введите бюджет ...">{{ $idea->budget }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Срок от:</label>
                                            <div class="input-group date" id="reservationdate"
                                                 data-target-input="nearest">
                                                <input name="from" value="{{$idea->from}}" placeholder="Введите срок"
                                                       type="date"
                                                       class="form-control datetimepicker-input"
                                                       data-target="#reservationdate"/>

                                            </div>


                                        </div>
                                        <div class="col-md-3">

                                            <label>До:</label>
                                            <div class="input-group date" id="reservationdated"
                                                 data-target-input="nearest">
                                                <input value="{{$idea->to}}" name="to" placeholder="Введите срок"
                                                       type="date"
                                                       class="form-control datetimepicker-input"
                                                       data-target="#reservationdated"/>


                                            </div>
                                        </div>


                                        <div class="d-flex justify-content-end mt-4">
                                            <button class="btn btn-primary">Отправить</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
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

                        <div class="form-group">
                            <input type="text" name="name" class="form-control">
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


