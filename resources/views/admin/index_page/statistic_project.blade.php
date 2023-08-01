@extends('admin.layouts.app')

@section('title')
    Статистика проектов
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $project?->name }}</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="card-body" style="overflow: auto;">
                        <div class="col-1">
                            <a href="{{ route('admin.index') }}" class="btn btn-outline-danger">Назад</a>
                        </div>
                        <table id="example" style="width: 100%" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ФИО</th>
                                    <th>Количество задач</th>
                                    <th>Готовые</th>
                                    <th>В процессе</th>
                                    <th>На проверке (клиент)</th>
                                    <th>На проверке (админ)</th>
                                    <th>Проссроченное</th>
                                    <th>Прочее</th>
                                </tr>
                            </thead>
                            <tbody id="tbody" >

                        @foreach($tasks as $task)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $task->user_name . ' ' . $task->user_surname }}</td>
                                <td>{{ $task->task_count }}</td>
                                <td>{{ $task->task_ready }}</td>
                                <td>{{ $task->task_process }}</td>
                                <td>{{ $task->task_ver_client }}</td>
                                <td>{{ $task->task_ver_admin }}</td>
                                <td>{{ $task->task_out_of_date }}</td>
                                <td>{{ $task->task_other }}</td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
