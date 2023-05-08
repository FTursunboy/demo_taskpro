@extends('admin.layouts.app')

@section('title')Сотрудники@endsection


@section('content')
    <div id="main">
        <a href="{{ route('employee.create') }}" class="btn btn-outline-primary mb-2">
            Добавить новый сотрудник
        </a>
        @include('inc.messages')

        <div class="row pt-4">
            @foreach($users as $user)
                <div class="col-4">
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
                                         style="width: {{$user->xp / 10}}%" aria-valuenow="{{ $user->xp }}" aria-valuemin="0"
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
                                            <th>Tasks: </th>
                                            <th><span class="mx-2">{{ $user->taskCount($user->id) }}</span></th>
                                        </tr>
                                        <tr>
                                            <th>success :</th>
                                            <th><span class="mx-2">{{ $user->taskSuccessCount($user->id) }}</span></th>
                                        </tr>
                                        <tr>
                                            <th>Idea :</th>
                                            <th><span class="mx-2"> {{ $user->ideaCount($user->id) }}</span></th>
                                        </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('employee.show', $user->id) }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                <a href="" class="btn btn-primary mx-2"><i class="bi bi-pencil"></i></a>
                                <a href="" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    </div>

@endsection
@section('script')

@endsection
