@extends('admin.layouts.app')

@section('title')
    Телеграмм
@endsection

@section('content')
    <div id="page-heading">

        @include('inc.messages')

        <div class="card">
            <div class="card-header">
                <a role="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                   data-bs-target="#staticBackdrop1">
                    Написать всем сразу
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Сотрудник</th>
                        <th>Телеграм ID</th>
                        <th class="text-center">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->surname.' '.$user->name }}</td>
                            <td>{{ $user->telegram_user_id }}</td>
                            <td class="text-center">

                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
