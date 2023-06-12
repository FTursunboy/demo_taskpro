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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#onePerson{{ $user->id }}">Написать
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="onePerson{{ $user->id }}" data-bs-backdrop="static"
                             data-bs-keyboard="false" tabindex="-1"
                             aria-labelledby="onePerson{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('telegram.sendOne', $user->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="onePerson{{ $user->id }}">Написать
                                                на {{ $user->surname .' '.$user->name}}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="CMC">СМС</label><textarea name="message" id="CMC"
                                                                                      class="form-control"
                                                                                      rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Отменить
                                            </button>
                                            <button type="submit" class="btn btn-primary">Отправить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('telegram.sendAll') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Написать всем</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="CMC">СМС</label><textarea name="message" id="CMC" class="form-control"
                                                                  rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
