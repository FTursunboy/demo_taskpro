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
                            <li class="breadcrumb-item"><a href="{{route('client.offers.index')}}">Задачи</a></li>
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
                                        <a href="{{ route('client.offers.index') }}" class="btn btn-danger">Назад</a>

                                    </div>
                                </div>
                            </div>
                            @if($settings?->has_access == false)
                                <h4 style="margin-left: 30px; color: red" class="offcanvas-title" id="ProjectOfCanvas">Вы не можете создать задачу от имени клиента. Пополните баланс!</h4>
                            @endif

                            @if(\Session::has('err'))
                                <div class="alert alert-danger mt-4">
                                    {{ \Session::get('err') }}
                                </div>
                            @endif


                            <div class="container my-5">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-9">
                                        <form method="post" action="{{route('client.offers.store')}}"
                                              enctype="multipart/form-data"
                                              autocomplete="off">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Название задачи</label>
                                                    <textarea {{$settings?->has_access ? '' : 'disabled'}} id="name" class="form-control"
                                                              name="name"
                                                              rows="5" required>{{ old('name') }}</textarea>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group mt-2">
                                                        <label class="form-label">Клиент</label>
                                                            <select  {{$settings?->has_access ? '' : 'disabled'}} id="client_id" name="client_id" class="form-control" required>
                                                                <option>Выберите клиента</option>
                                                                @foreach($offers as $offer)
                                                                    <option value="{{ $offer->id }}">{{ $offer->surname . " " . $offer->name . " " . $offer->lastname}}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Ответственный сотрудник со стороны
                                                            компании</label>
                                                        <input {{$settings?->has_access ? '' : 'disabled'}} type="text"
                                                               class="form-control"
                                                               name="author_name" id="author_name"
                                                               value="{{ old('author_name') }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Телефон ответсвенного сотрудника</label>
                                                    <input {{$settings?->has_access ? '' : 'disabled'}} type="text"
                                                           class="form-control"
                                                           name="author_phone" id="author_phone"
                                                           value="{{ old('author_phone') }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Выберите файл</label>
                                                    <input {{$settings?->has_access ? '' : 'disabled'}} type="file"
                                                           class="form-control"
                                                           name="file">
                                                </div>
                                                <div class="col-12">
                                                    <label for="your-message" class="form-label">Описание
                                                        задачи</label>
                                                    <textarea {{$settings?->has_access ? '' : 'disabled'}} id="description" class="form-control"
                                                              name="description"
                                                              rows="5">{{ old('description') }}</textarea>
                                                </div>
                                                <div class="col-md-6">

                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <button {{$settings?->has_access ? '' : 'disabled'}} type="submit" class="btn btn-success form-control"
                                                            id="btnSend" onclick="btnSendFn()">
                                                        Отправить
                                                    </button>
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
@section('script')
    <script>
        var counter = 0;

        function btnSendFn()
        {
            counter++

            if (counter === 2){
                var button = document.getElementById('btnSend')
                button.type = "button"
            }
        }


        $('#client_id').change(function () {
            let kpi = $(this).children('option:selected')

                $.get(`/tasks/public/getClientName/${kpi.val()}/`).then((res) => {
                    $('#author_name').val(res.name)
                    $('#author_phone').val(res.phone)
                });


        })

    </script>
@endsection


