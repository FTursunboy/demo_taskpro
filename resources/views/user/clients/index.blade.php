@extends('user.layouts.app')

@section('title')Клиенты@endsection

@section('content')
    <div id="page-heading">
       

        <div class="row pt-4">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Проект</th>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{$user->project }}</td>
                        <td>{{ $user->surname . ' ' . $user->name .' '. $user->lastname}}</td>
                        <td>{{$user->phone}}</td>
                        <td>@if(Cache::has('user-is-online-' . $user?->id))
                                <span class="text-center text-success mx-2"><b>Online</b></span>
                            @else
                                <span class="text-center text-danger  mx-2"><b>Offline</b>
                                                     @if($user->last_seen !== null)
                                        <span class="text-gray-600"> - {{ \Carbon\Carbon::parse($user?->last_seen)->diffForHumans() }}</span>
                                    @endif
                                                </span>
                            @endif</td>
                    </tr>

                    @endforeach
                </tbody>

            </table>
        </div>


    </div>




@endsection
