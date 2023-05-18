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
                            <li class="breadcrumb-item active" aria-current="page">Профиль - {{ $user->surname . ' ' . $user->name.' '. $user->lastname }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('inc.messages')

        <div class="row pt-4">
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h3>Список сотрудников</h3>
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ФИО</th>
                                <th>Должность</th>
                                <th>Телефон</th>
                                <th>Прогресс (макс: 1000)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $employee->surname. ' '. $employee->name.' '. $employee->lastname }}</td>
                                    <td>{{ $employee->position }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>
                                        @switch($employee->xp)
                                            @case($employee->xp > 0 && $employee->xp <= 99 )
                                            <div class="progress progress-success progress-sm" title="{{ $employee->xp }}xp">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $employee->xp / 10 }}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @break
                                            @case($employee->xp > 99 && $employee->xp < 299 )
                                            <div class="progress progress-success progress-sm" title="{{ $employee->xp }}xp">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $employee->xp / 10 }}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @break
                                            @case($employee->xp > 299 && $employee->xp < 700 )
                                            <div class="progress progress-success progress-sm" title="{{ $employee->xp }}xp">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $employee->xp / 10 }}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @break
                                            @case($employee->xp > 699 && $employee->xp < 1000 )
                                            <div class="progress progress-success progress-sm" title="{{ $employee->xp }}xp">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $employee->xp / 10 }}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @break
                                        @endswitch

                                    </td>
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
                            @if(isset($user->avatar))
                            <img style="border-radius: 50% " id="avatar" onclick="img()" src="{{ \Illuminate\Support\Facades\Storage::url($user->avatar) }}" alt="" width="100" height="100">
                            @else
                                <img style="border-radius: 50% " id="avatar" onclick="img()" src="{{ asset('assets/images/logo/favicon.svg') }}" alt="" width="100" height="100">
                            @endif
                        </div>

                        <div class="d-flex justify-content-center mb-3">
                        </div>

                    </div>
                    <div class="card-body">
                        <h5 class="text-center">{{ $user->surname . ' ' .$user->name .' '. $user->lastname}}.</h5>
                        <div>
                            <table class="mt-3" cellpadding="5">
                                <tr>
                                    <th>Проекты: </th>
                                    <th><span class="mx-2">{{ $user->projectCount() }}</span></th>
                                </tr>
                                <tr>
                                    <th>Клиенты :</th>
                                    <th><span class="mx-2">{{ $user->clientCount() }}</span></th>
                                </tr>
                                <tr>
                                    <th>Идеи :</th>
                                    <th><span class="mx-2"> {{ $user->ideaCountProfile() }}</span></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('profile.show', $user->id) }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary mx-2"><i class="bi bi-pencil"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
