@extends('client.layouts.app')
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
                            <div class="container">
                                <div class="row d-flex justify-content-center w-100">
                                    <div class="col-lg-9">
                                        @include('inc.messages')

                                        <p>
                                            <button
                                                class="btn btn-primary w-100"
                                                type="button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#history" aria-expanded="false"
                                                aria-controls="collapseExample"><span
                                                    class="d-flex justify-content-start"><i
                                                        class="bi bi-info-circle mx-2"></i> <span
                                                        class="text-center"> Вся история задачи </span> </span>
                                            </button>
                                        </p>

                                    </div>
                                </div>
                            </div>
                                        <div class="container my-5">
                                            <div class="row   d-flex justify-content-center align-items-center">
                                                <div class="col-lg-9">
                                                    <form method="post" action="{{route('offers.store')}}"
                                                          enctype="multipart/form-data"
                                                          autocomplete="off">
                                                        @csrf
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Название
                                                                    задачи</label>
                                                                <input disabled type="text"
                                                                       class="form-control"
                                                                       name="name" id="name"
                                                                       value="{{$offer->name}}"
                                                                       required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Ответственный
                                                                    сотрудник</label>
                                                                <input placeholder="Сотрудник будет установлен"
                                                                       disabled
                                                                       type="text"
                                                                       class="form-control"
                                                                       name="user_id" id="name"
                                                                       value="{{$offer->user?->name}}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Ответсвенный сотрудник
                                                                    со стороны
                                                                    компании</label>
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
                                                                <input placeholder="Дата будет установлена"
                                                                       value="{{$offer->from}}" disabled
                                                                       type="date"
                                                                       class="form-control"
                                                                       name="from">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">До</label>
                                                                <input placeholder="Дата будет установлена"
                                                                       value="{{$offer->to}}" disabled
                                                                       type="date"
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
                                                            <div class="col-12">
                                                                <a href="{{route('offers.index')}}"
                                                                   class="btn btn-success form-control">
                                                                    Назад
                                                                </a>
                                                                <script>
                                                                    const btn = document.getElementById('btnSend')
                                                                    btn.addEventListener('click', function () {
                                                                        const name = document.getElementById('name').value
                                                                        const description = document.getElementById('description').value
                                                                        if (name !== '' && description !== '') {
                                                                            btn.type = 'submit';
                                                                            btn.click();
                                                                            btn.classList.add('disabled')
                                                                        } else {
                                                                            btn.classList.add('disabled')
                                                                        }
                                                                    })
                                                                </script>
                                                            </div>
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
            </div>
        </section>

    </div>


    <div class="modal"  tabindex="-1" id="history">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Вся история задачи</h5>

                </div>
                <div class="modal-body">
                    <div class="row p-3">

                        <table class="table table-striped" id="table1">
                            <thead>
                            <th>Дата</th>
                            <th>Совершил действия</th>
                            <th>Статус</th>
                            </thead>
                            <tbody>

                            @foreach($histories as $history)

                                <tr>
                                    <td>{{date('d.m.Y H:i:s', strtotime($history->created_at))}}</td>
                                    <td>{{$history->user->name }}</td>
                                    <td>{{$history->status?->name}} {{ $history->user->hasRole('admin') ? '(Админ)' : ($history->user->hasRole('user') ? '(Сотрудник)' : ($history->user->hasRole('client') ? '(Клиент)' : 'Роль не определена')) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


