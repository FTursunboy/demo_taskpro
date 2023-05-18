@extends('admin.layouts.app')

@section('title'){{ $user->surname . ' ' . $user->name.' '. $user->lastname }}@endsection


@section('content')
    <div id="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $user->surname . ' ' . $user->name.' '. $user->lastname }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Сотрудники </a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $user->surname . ' ' . $user->name.' '. $user->lastname }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <a href="{{ route('employee.client') }}" class="btn btn-outline-danger mb-2">
            Назад
        </a>
        @include('inc.messages')

        <section class="section">
            <div class="row pt-4">
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Название задачи</th>
                                    <th>Ответсвенный сотрудник</th>
                                    <th>Статус</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($offers as $offer)
                                        <tr>
                                            <td>{{ $offer->name }}</td>
                                            <td>{{ $offer->user?->name }}</td>
                                            <td>{{ $offer->user?->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-center mb-3">
                                <img src="{{ asset('assets/images/avatar-2.png') }}" alt="" width="100" height="100">
                            </div>

                            @switch($user->xp)
                                @case($user->xp > 0 && $user->xp <= 99 )
                                <div>
                                    <div class="d-flex justify-content-end">
                                        {{ $user->xp }} / 100
                                    </div>
                                </div>
                                <div class="progress mt-3">
                                    <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                         style="width: {{ $user->xp }}%" aria-valuenow="{{ $user->xp }}" aria-valuemin="0"
                                         aria-valuemax="300"></div>
                                </div>
                                @break
                                @case($user->xp > 99 && $user->xp < 299 )
                                <div>
                                    <div class="d-flex justify-content-end">
                                        {{ $user->xp }} / 300 (xp)
                                    </div>
                                </div>
                                <div class="progress mt-3">
                                    <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                         style="width: {{$user->xp/3}}%" aria-valuenow="{{ $user->xp }}" aria-valuemin="0"
                                         aria-valuemax="300"></div>
                                </div>
                                @break
                                @case($user->xp > 299 && $user->xp < 700 )
                                <div>
                                    <div class="d-flex justify-content-end">
                                        {{ $user->xp }}xp / 700 (xp)
                                    </div>
                                </div>
                                <div class="progress mt-3">
                                    <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                         style="width: {{$user->xp / 7}}%" aria-valuenow="{{ $user->xp }}" aria-valuemin="0"
                                         aria-valuemax="700"></div>
                                </div>
                                @break
                                @case($user->xp > 699 && $user->xp < 1000 )
                                <div>
                                    <div class="d-flex justify-content-end">
                                        {{ $user->xp }} / 1000 (xp)
                                    </div>
                                </div>
                                <div class="progress mt-3">
                                    <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                         style="width: {{$user->xp / 10}}%" aria-valuenow="{{ $user->xp }}"
                                         aria-valuemin="0"
                                         aria-valuemax="1000"></div>
                                </div>
                                @break
                            @endswitch

                        </div>
                        <div class="card-body">
                            <h5 class="text-center">{{ $user->surname . ' ' .$user->name .' '. $user->lastname}}</h5>
                            <div>
                                <table class="mt-3" cellpadding="5">
                                    <tr>
                                        <th>Задачи:</th>
                                        <th><span class="mx-2">{{ $user->taskCount($user->id) }}</span></th>
                                    </tr>
                                    <tr>
                                        <th>Завершенный :</th>
                                        <th><span class="mx-2">{{ $user->taskSuccessCount($user->id) }}</span></th>
                                    </tr>
                                    <tr>
                                        <th>Идеи :</th>
                                        <th><span class="mx-2"> {{ $user->ideaCount($user->id) }}</span></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('employee.client.edit', $user->id) }}" class="btn btn-primary mx-2"><i class="bi bi-pencil"></i></a>
                                <a role="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$user->id}}"><i class="bi bi-trash"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" aria-labelledby="delete{{$user->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('employee.client.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="delete{{$user->id}}">Предупреждение</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Точно хотите удалить <b>'{{ $user->surname . ' ' .$user->name.' ' .$user->lastname  }}'</b>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Да, </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Список завершенных задач</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Имя</th>
                                    <th>Статус</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $task->to }}</td>
                                        <td>{{ $task->status->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>

@endsection
@section('script')

@endsection
