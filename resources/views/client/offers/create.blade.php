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
            @if(session('mess'))
                <div class="alert alert-success">
                    {{session('mess')}}
                </div>
            @endif

            <div class="row">
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
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-9">
                                        <form method="post" action="{{route('offers.store')}}"
                                              enctype="multipart/form-data"
                                              autocomplete="off">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Название задачи</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="name" id="name" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Ответственный сотрудник со стороны
                                                        компании</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="author_name" id="name" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Телефон ответсвенного сотрудника</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="author_phone" id="name" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Выберите файл</label>
                                                    <input type="file"
                                                           class="form-control"
                                                           name="file">
                                                </div>
                                                <div class="col-12">
                                                    <label for="your-message" class="form-label">Описание
                                                        задачи</label>
                                                    <textarea id="description" class="form-control"
                                                              name="description"
                                                              rows="5" required></textarea>
                                                </div>
                                                <div class="col-md-6">

                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-success form-control"
                                                            id="btnSend">
                                                        Отправить
                                                    </button>
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
                                            </div>
                                        </form>
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


