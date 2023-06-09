@extends('admin.layouts.app')

@section('title')
    Задачи
@endsection
@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Список задач</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Список задач</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>




        <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary mb-4">
            Добавить задачу
        </a>
        <div class="row">
            @if(session('mess'))
                <div class="alert alert-success">
                    Успешно отправлено
                </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <table id="example" class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Название</th>
                                <th class="text-center">До</th>
                                <th class="text-center">Проект</th>
                                <th class="text-center">Статус</th>
                                <th class="text-center">Сотрудник</th>
                                <th class="text-center">Действия</th>
                            </tr>
                            </thead>
                            <tbody id="tableBodyMonitoring">
                            @foreach($tasks as $task)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($task->name, 50) }}</td>
                                    <td class="text-center">{{ date('d-m-Y', strtotime($task->to))  }}</td>
                                    <td class="text-center">{{ $task->project->name  }}</td>
                                    @switch($task->status->id)
                                        @case(1)
                                        <td><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                        @break
                                        @case(2)
                                        <td><span class="badge bg-primary p-2">{{$task->status->name}}</span></td>
                                        @break
                                        @case(3)
                                        <td><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                                        @break
                                        @case(4)
                                        <td><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                                        @break
                                        @case(5)
                                        <td><span class="badge bg-danger p-2">{{$task->status->name}}</span></td>
                                        @break
                                        @case(6)
                                        <td><a href="#" data-bs-toggle="modal" data-bs-target="#check{{$task->id}}"><span class="badge bg-primary p-2">На проверку</span></a></td>
                                        @break
                                        @case(7)
                                        <td><span class="badge bg-danger p-2">{{$task->status->name}}</span></td>
                                        @break
                                        @case(8)
                                        <td><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                        @break
                                        @case(9)
                                        <td><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                        @break
                                        @case(10)
                                        <td><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                                        @break
                                        @case(11)
                                        <td><span class="badge bg-danger p-2">{{$task->status->name}}</span></td>
                                        @break
                                        @case(12)
                                        <td><a data-bs-target="#sendBack{{$offer->id}}" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">Отклонено (Сотрудник)</span></a></td>
                                        @break
                                        @case(13)
                                        <td><a data-bs-target="#sendBack{{$offer->id}}" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">Отклонено (Клиент)</span></a></td>
                                        @break
                                        @case(14)
                                        <td><a href="#" data-bs-target="#send{{$offer->id}}" data-bs-toggle="modal"><span class="badge bg-success p-2"></span>На проверку</a></td>
                                        @break
                                    @endswitch
                                    <td class="text-center">{{ $task->user?->surname . ' ' . $task->user?->name}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-success"><i
                                                class="bi bi-eye"></i></a>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary"><i
                                                class="bi bi-pencil"></i></a>

                                    </td>
                                </tr>



                                <div class="modal fade" id="delete{{$task->id}}" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1"
                                     aria-labelledby="delete{{$task->id}}" aria-hidden="true"
                                     style="z-index: 9990">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('tasks.delete', $task->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="delete{{$task->id}}">
                                                        Предупреждение</h1>
                                                    <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            </div>
                                            @if($task->status_id === 5)
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="cancel">Причина</label>
                                                        <textarea id="cancel" class="form-control" disabled>{{ $task->cancel }}</textarea>
                                                    </div>
                                                <div class="modal-body">
                                                    Точно хотите удалить задачу?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Нет
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Да, удалить
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="editWrong{{$task->id}}" data-bs-backdrop="static"
                                     style="z-index: 9991"
                                     data-bs-keyboard="false" tabindex="-1"
                                     aria-labelledby="editWrong{{$task->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editWrong{{$task->id}}">
                                                    Предупреждение</h1>
                                                <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-5">
                                                    Вы не можете изменить это задание!
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Закрыть
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="editRight{{$task->id}}" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1" style="z-index: 9992"
                                     aria-labelledby="editRight{{$task->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{route('tasks.sendBack', $task->id,)}}"
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editRight{{$task->id}}">
                                                        Предупреждение</h1>
                                                    <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        <div class="form-group">
                                                            <label for="user">Сотрудник</label>
                                                            <select name="user_id" id="user_id"
                                                                    class="form-select">
                                                                @foreach($users as $user)
                                                                    <option
                                                                        value="{{ $user->id }}" {{ ($user->id === old('user_id') or $user->id === $task->user->id ) ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">
                                                        Перенаправить
                                                    </button>
                                                    <a href="{{route('tasks.edit', $task->id)}}"
                                                       class="btn btn-primary">
                                                        Изменить
                                                    </a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="check{{$task->id}}" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1" style="z-index: 9994"
                                     aria-labelledby="check{{$task->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{route('tasks.sendBack1', $task->id,)}}"
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-header">
                                                    <h1>Проверка</h1>
                                                    <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="employee">Отчёт о проделанной работе</label>
                                                        <textarea class="form-control"
                                                                  disabled>{{ $task->success_desc }} </textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="employee">Исполнители</label>
                                                        <select name="employee" id="employee"
                                                                class="form-control">
                                                            <option disabled value="0" selected>Выберите
                                                                исполнители
                                                            </option>
                                                            @foreach($users as $user)
                                                                <option
                                                                    value="{{ $user->id }}">{{ $user->surname .' ' . $user->name .' '.$user->lastname }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-warning">
                                                        Перенаправить
                                                    </button>
                                                    <button type="submit" class="btn btn-success">Готово
                                                    </button>
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
        </div>
    </div>
    </div>
    </div>

@endsection
@section('script')
    <script src="{{asset('assets/js/filter3.js')}}"></script>




    <script>
        $(document).ready(function () {

            var table = $('#example').DataTable({
                "processing": true,
                "stateSave": true // Включаем сохранение состояния
            });
            // Apply filters from localStorage on page load
            var filters = JSON.parse(localStorage.getItem('datatableFilters'));
            if (filters) {
                for (var i = 0; i < filters.length; i++) {
                    var filter = filters[i];
                    table.column(filter.columnIndex).search(filter.value);
                }
                table.draw();
            }

            // Add event listeners to update filters and save them in localStorage
            $("#example thead th").each(function (i) {
                var th = $(this);
                var filterColumns = ['Сотрудник', 'Проект', 'Статус']; // Columns to add filters for

                if (filterColumns.includes(th.text().trim())) {
                    var select = $('<select></select>')
                        .appendTo(th.empty())
                        .addClass('form-control')
                        .on('change', function () {
                            var columnIndex = i;
                            var value = $(this).val();
                            table.column(columnIndex).search(value).draw();

                            // Save filters in localStorage
                            var filters = [];
                            $("#example thead select").each(function () {
                                var filter = {
                                    columnIndex: $(this).closest('th').index(),
                                    value: $(this).val()
                                };
                                filters.push(filter);
                            });
                            localStorage.setItem('datatableFilters', JSON.stringify(filters));
                        });

                    // Add default option of "Все" (All)
                    $('<option value="" selected>Все</option>').appendTo(select);

                    // Get unique options for the column
                    var options = table.column(i).data().unique().sort().toArray();

                    // Remove HTML tags from options
                    options = options.map(function (option) {
                        var tempElement = $('<div>').html(option);
                        return tempElement.text();
                    });

                    // Remove duplicate options
                    var uniqueOptions = [];
                    options.forEach(function (option) {
                        if (!uniqueOptions.includes(option)) {
                            uniqueOptions.push(option);
                            var optionText = option === null ? 'Нет данных' : option;
                            var optionElement = $('<option></option>').attr('value', option).text(optionText);
                            select.append(optionElement);
                        }
                    });


                    var storedFilters = JSON.parse(localStorage.getItem('datatableFilters'));
                    if (storedFilters) {
                        var storedFilter = storedFilters.find(function (filter) {
                            return filter.columnIndex === i;
                        });
                        if (storedFilter) {
                            select.val(storedFilter.value);
                        }
                    }
                }
            });
        });

    </script>
@endsection
