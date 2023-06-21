@extends('admin.layouts.app')

@section('title')Сотрудники@endsection


@section('content')
    <div id="page-heading">
        <a href="{{ route('employee.create') }}" class="btn btn-outline-primary mb-2">
            Добавить нового сотрудника
        </a>
        @include('inc.messages')

        <section class="section">
            <div class="row pt-4">
                @foreach($users as $user)
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-center mb-3">
                                    @if(isset($user->avatar))
                                        <img style="border-radius: 50%; border: 3px solid #0dcaf0" src="{{ asset('storage/'.$user->avatar)}}" alt="" width="100" height="100" class="">
                                    @else
                                        <img style="border-radius: 50%; border: 3px solid #0dcaf0 " src="{{ asset('assets/images/logo/favicon.svg') }}" alt="" width="100" height="100">
                                    @endif
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
                                             style="width: {{ $user->xp }}%" aria-valuenow="{{ $user->xp }}"
                                             aria-valuemin="0"
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
                                             style="width: {{$user->xp/3}}%" aria-valuenow="{{ $user->xp }}"
                                             aria-valuemin="0"
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
                                             style="width: {{$user->xp / 7}}%" aria-valuenow="{{ $user->xp }}"
                                             aria-valuemin="0"
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
                                <h5 class="text-center">{{ $user->surname . ' ' . $user->name .' '. $user->lastname}}</h5>
                                <div>
                                    <table class="mt-3" cellpadding="5">
                                        <tr>
                                            <th>Задачи:</th>
                                            <th><span class="mx-2">{{ $user->taskCount($user->id) }}</span></th>
                                        </tr>
                                        <tr>
                                            <th>Готовые :</th>
                                            <th><span class="mx-2">{{ $user->taskSuccessCount($user->id) }}</span></th>
                                        </tr>
                                        <tr>
                                            <th>Идеи :</th>
                                            <th><span class="mx-2"> {{ $user->ideaCount($user->id) }}</span></th>
                                        </tr>

                                        <tr>
                                            <th>Статус :</th>
                                            <th>
                                                @if(Cache::has('user-is-online-' . $user->id))
                                                    <span class="text-center text-success mx-2"><b>Online</b></span>
                                                @else
                                                    <span class="text-center text-danger  mx-2"><b>Offline</b></span>
                                                @endif
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Последнее посещение :</th>
                                            <th>
                                                @if($user->last_seen !== null)
                                                    {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                                @endif
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('employee.show', $user->slug) }}" class="btn btn-success"><i
                                            class="bi bi-eye"></i></a>
                                    <a href="{{ route('employee.edit', $user->slug) }}" class="btn btn-primary mx-2"><i
                                            class="bi bi-pencil"></i></a>
                                    <a role="button" class="btn btn-danger" data-bs-toggle="modal"
                                       data-bs-target="#delete{{$user->slug}}"><i class="bi bi-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="delete{{$user->slug}}" tabindex="-1" aria-labelledby="delete{{$user->slug}}"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('employee.destroy', $user->slug) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="delete{{$user->slug}}">Предупреждение</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Точно хотите удалить
                                        <b>'{{ $user->surname.' '. $user->name.' '. $user->lastname }}'</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет
                                        </button>
                                        <button type="submit" class="btn btn-danger">Да, хочу уалить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
