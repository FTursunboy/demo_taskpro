@extends('user.layouts.app')

@section('title')
    Добавить идею
@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Добавление идеи</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('idea.ideas') }}">Идеи</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Добавление</li>
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
                                <form method="post" action="{{route('idea.idea.store')}}" enctype="multipart/form-data"
                                      autocomplete="off ">
                                    @csrf
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


                                            <div class="form-group mt-5">
                                                <div class="input-group">
                                                    <label class="custom-file-label" for="exampleInputFile">Выберите
                                                        файл</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="file" class="form-control"
                                                               id="exampleInputFile">
                                                    </div>
                                                </div>
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
@endsection


