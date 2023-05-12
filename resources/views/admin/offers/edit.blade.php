@extends('admin.layouts.app')
@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Задачи</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('offers.index')}}">Задачи</a></li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('offers.create')}}" class="btn btn-primary">Добавить</a>
                    @include('inc.messages')
                </div>
                <div class="card-body">
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
                                                <a href="{{ route('offers.index') }}" class="btn btn-danger">Назад</a>
                                            </div>

                                        </div>
                                    </div>


                                    @if(\Session::has('err'))
                                        <div class="alert alert-danger mt-4">
                                            {{ \Session::get('err') }}
                                        </div>
                                    @endif

                                    <div class="container my-5">
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <form method="post"
                                                      action="{{route('client.offers.send.user', $offer->id)}}"
                                                      enctype="multipart/form-data"
                                                      autocomplete="off">
                                                    @csrf
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Название задачи</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="name" id="name"
                                                                   value="{{$offer->name}}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Ответственный
                                                                сотрудник</label>
                                                            <select class="form-control" name="user_id" id="">

                                                                @foreach($users as $user)
                                                                    <option
                                                                        value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Ответсвенный сотрудник со
                                                                стороны компании</label>
                                                            <input value="{{$offer->author_name}}" disabled
                                                                   type="text"
                                                                   class="form-control"
                                                                   name="author_name" id="name" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Телефон ответсвенного
                                                                сотрудника</label>
                                                            <input value="{{$offer->author_phone}}" disabled
                                                                   type="text"
                                                                   class="form-control"
                                                                   name="author_phone" id="name" required>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">От</label>
                                                            <input
                                                                value="{{$offer->from}}" type="date"
                                                                class="form-control"
                                                                name="from">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">До</label>
                                                            <input
                                                                value="{{$offer->to}}" type="date"
                                                                class="form-control"
                                                                name="to">
                                                        </div>
                                                        @if($offer->file !== null)
                                                            <div class="col-md-6">
                                                                <a style="margin-left: 0px" download
                                                                   href="{{route('offers.download', $offer->id)}}">Просмотреть
                                                                    файл</a>
                                                            </div>
                                                        @endif
                                                        <div class="col-12">
                                                            <label for="your-message" class="form-label">Описание
                                                                задачи</label>
                                                            <textarea disabled id="description"
                                                                      class="form-control"
                                                                      name="description"
                                                                      rows="5"
                                                                      required>{{$offer->description}} </textarea>
                                                        </div>
                                                        <div class="col-md-6">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-6">
                                                            <button name="action" value="accept"
                                                                    class="btn btn-success form-control">
                                                                Отправить
                                                            </button>
                                                        </div>
                                                        <div class="col-6">
                                                            <button name="action" value="decline"
                                                                    class="btn btn-danger form-control">
                                                                Отклонить
                                                            </button>
                                                        </div>
                                                        <script>
                                                            const btn = document.getElementById('btnSend')
                                                            btn.addEventListener('click', function () {
                                                                const name = document.getElementById('name').value
                                                                const description = document.getElementById('description').value
                                                                if (name !== '' && description !== '') {
                                                                    btn.type = 'submit';
                                                                    btn.click();
                                                                    btn.classList.add('disabled')
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
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>



@endsection


