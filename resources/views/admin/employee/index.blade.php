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
                <table class="table table-hover">
                    <thead>
                        <th>#</th>
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Задачи</th>
                        <th>Готовыe</th>
                        <th>Статус</th>
                        <th>Действия</th>

                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$user->surname . ' ' . $user->name .' '. $user->lastname}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->taskCount($user->id)}} </td>
                        <td>{{$user->taskSuccessCount($user->id) }}</td>
                        <td>@if($user->deleted_at)
                           <span style="color: red; font-weight: bold">Неактивен</span>
                            @else
                            <span style="color: green; font-weight: bold">Активен</span>
                            @endif
                        </td>
                        @if($user->deleted_at)
                            <td></td>
                        @else
                            <td>
                                <a href="{{ route('employee.show', $user->slug) }}" class="btn btn-success"><i
                                        class="bi bi-eye"></i></a>
                                <a href="{{ route('employee.edit', $user->slug) }}" class="btn btn-primary mx-2"><i
                                        class="bi bi-pencil"></i></a>
                                <a role="button" class="btn btn-danger" data-bs-toggle="modal"
                                   data-bs-target="#delete{{$user->slug}}"><i class="bi bi-trash"></i></a>
                            </td>
                        @endif

                    </tr>
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
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>



@endsection
