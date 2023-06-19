<div class="col-md-12">
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <div class="row">
                <div class="col-9"></div>
                <div class="col">
                    <div class="form-group">
                        <select class="form-select" name="month" id="month">
                            <option value="0">фильтр по месяцу</option>
                            <option value="1">Январь</option>
                            <option value="2">Февраль</option>
                            <option value="3">Март</option>
                            <option value="4">Апрель</option>
                            <option value="5">Май</option>
                            <option value="6">Июнь</option>
                            <option value="7">Июль</option>
                            <option value="8">Август</option>
                            <option value="9">Сентябрь</option>
                            <option value="10">Октябрь</option>
                            <option value="11">Ноябрь</option>
                            <option value="12">Декабрь</option>
                        </select>
                    </div>
                </div>
            </div>
            <table id="example" class="table table-border table-hover">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Имя</th>
                    <th class="text-center">Проект</th>
                    <th class="text-center">Автор</th>
                    <th class="text-center">Тип</th>
                    <th class="text-center">Статус</th>
                    <th class="text-center">КПД</th>
                    <th class="text-center">Сотрудник</th>
                    <th class="text-center">Действия</th>
                </tr>
                </thead>
                <tbody id="tableBodyMonitoring">
                @foreach($statistics as $task)
                    <tr>
                        <td class="text-center">{{$task->id }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($task->name, 50)  }}</td>
                        <td class="text-center">{{ $task->project->name  }}</td>
                        <td class="text-center">{{ $task->author->name  }}</td>
                        <td class="text-center">
                            @if($task->type === null)
                                От клиента
                            @elseif($task->type !== null)
                                {{ $task->type?->name }} {{  (isset($task->typeType?->name)) ? ' - '.$task->typeType?->name : '' }}
                            @endif
                        </td>

                        @switch($task->status->id)
                            @case(1)
                                <td class="text-center"><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                @break
                            @case(2)
                                <td class="text-center"><span class="badge bg-primary p-2">{{$task->status->name}}</span></td>
                                @break
                            @case(3)
                                <td class="text-center"><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                                @break
                            @case(4)
                                <td class="text-center"><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                                @break
                            @case(5)
                                <td class="text-center"><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                @break
                            @case(6)
                                <td class="text-center"><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                                @break
                            @case(7)
                                <td class="text-center"><span class="badge bg-danger p-2">{{$task->status->name}}</span></td>
                                @break
                            @case(8)
                                <td class="text-center"><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                @break
                            @case(9)
                                <td class="text-center"><span class="badge bg-warning p-2">Ожид. (Сотруд)</span></td>
                                @break
                            @case(10)
                                <td class="text-center"><span class="badge bg-success p-2">У клиента</span></td>
                                @break
                            @case(11)
                                <td class="text-center"><span class="badge bg-danger p-2">{{$task->status->name}}</span></td>
                                @break
                            @case(12)
                                <td class="text-center"><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                @break
                            @case(13)
                                <td class="text-center"><span class="badge bg-warning p-2">{{$task->status->name}}</span></td> @break
                            @case(14)
                                <td class="text-center"><span class="badge bg-warning p-2">{{$task->status->name}}</span></td> @break
                        @endswitch
                        <td class="text-center">{{$task->checkDate?->count}}</td>
                        <td class="text-center">{{ $task->user?->surname . ' ' . $task->user?->name}}</td>
                        <td class="text-center">
                            <a href="{{ route('mon.show', $task->id) }}" class="btn btn-success"><i
                                    class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@routes
<script>
    $(document).ready(function () {
        var table = $('#example').DataTable({
            initComplete: function () {

            },
        });

        $('#month').on('change', function () {
            filterStatistic()
        });

        function filterStatistic() {
            let month = $('#month').val();

            $.get(`/tasks/public/monitoring-statistics-filter/${month}`, function (response) {
                let tableBody = $('#tableBodyMonitoring');
                table.clear().draw();

                if (response.statistics.length > 0) {
                    buildTable(response.statistics, tableBody);
                }
            });
        }

        function buildTable(data, tableBody) {
            $.each(data, function (i, item) {
                let taskName = item.name.length > 50 ? `${item.name.substring(0, 50)}...` : item.name;
                let projectName = item.project.name;
                let authorName = item.author.name;
                let typeName = item.type ? item.type.name : 'От клиента';
                // let statusName = item.status.name;
                let checkDateCount = item.checkDate ? item.checkDate.count : 0;
                let userName = item.user.name;
                let statusColumn = '';
                switch (item.status.name) {
                    case 'Ожидается':
                    case 'Ожидается (Админ)':
                    case 'Ожидается (Сотрудник)':
                        statusColumn = '<td class="text-center"><span class="badge bg-warning p-2">' + item.status.name + '</span></td>';
                        break;
                    case 'В процессе':
                        statusColumn = '<td class="text-center"><span class="badge bg-primary p-2">' + item.status.name + '</span></td>';
                        break;
                    case 'Готов':
                    case 'Принято':
                    case 'На проверку':
                    case 'На проверке (У клиента)':
                    case 'На проверке (У админа)':
                        statusColumn = '<td class="text-center"><span class="badge bg-success p-2">' + item.status.name + '</span></td>';
                        break;
                    case 'Отклонено':
                    case 'Отклонено (Администратор)':
                    case 'Отклонено (Сотрудник)':
                    case 'Отклонено (Клиентом)':
                    case 'Просроченное':
                        statusColumn = '<td class="text-center"><span class="badge bg-danger p-2">' + item.status.name + '</span></td>';
                        break;


                }

                let show = route('mon.show', item.id);

                let row = `<tr>
                <td class="text-center">${i + 1}</td>
                <td class="text-center">${taskName}</td>
                <td class="text-center">${projectName}</td>
                <td class="text-center">${authorName}</td>
                <td class="text-center">${typeName}</td>
                ${statusColumn}
                <td class="text-center">${checkDateCount}</td>
                <td class="text-center">${userName}</td>
                <td class="text-center">
                    <a href="${show}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                </td>
            </tr>`;
                table.row.add($(row)).draw(); // Add the new row to the table
            });
        }
    });
</script>
