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


                            @if(\Session::has('err'))
                                <div class="alert alert-danger mt-4">
                                    {{ \Session::get('err') }}
                                </div>
                            @endif


                            <div class="container my-5">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-9">
                                        <form method="post" action="{{route('client.offers.update', $offer->id)}}"
                                              enctype="multipart/form-data"
                                              autocomplete="off">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Название задачи</label>
                                                    <textarea id="name" class="form-control"
                                                              name="name"
                                                              rows="5" required>{{$offer->name }}</textarea>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group mt-2">
                                                        <label class="form-label">Клиент</label>
                                                        <select name="client_id" class="form-control" required>
                                                            <option>Выберите клиента</option>
                                                            @foreach($clients as $client)
                                                                <option value="{{ $client->id }}" {{$client->id == $offer->client_id ? 'selected' : ''}}>{{ $client->surname . " " . $client->name . " " . $client->lastname}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <label for="your-message" class="form-label">Описание
                                                        задачи</label>
                                                    <textarea id="description" class="form-control"
                                                              name="description"
                                                              rows="5">{{ $offer->description }}</textarea>
                                                </div>
                                                <div class="col-md-6">

                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-success form-control"
                                                            id="btnSend">
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


