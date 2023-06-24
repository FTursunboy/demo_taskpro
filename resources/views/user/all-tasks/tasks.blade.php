<div class="table-responsive">
    <table id="example" class="table table-hover">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th data-td="td_one">Название<span class="btn btn-right">></span></th>
            <th data-td="td_two">Описание<span class="btn btn-right">></span></th>
            <th class="text-center" data-td="td_three">От<span class="btn btn-right">></span></th>
            <th class="text-center" data-td="td_four">До<span class="btn btn-right">></span></th>
            <th class="text-center">Проект</th>
            <th class="text-center">Автор</th>
            <th class="text-center">Тип</th>
            <th class="text-center">Статус</th>
            <th class="text-center">Действия</th>
        </tr>
        </thead>
        <tbody id="tableBodyMonitoring">
        @foreach($tasks as $task)
            <tr>
                <td class="text-center">{{ $loop->iteration  }}</td>
                <td >{{ $task->name }}</td>
                <td >{{ Str::limit($task->comment, 100) }}</td>
                <td class="text-center">{{ date('d-m-Y', strtotime($task->from))  }}</td>
                <td class="text-center">{{ date('d-m-Y', strtotime($task->to))  }}</td>
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
                        <td><span class="badge bg-warning p-2">Ожидаеться</span></td>
                        @break
                    @case(2)
                        <td><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                        @break
                    @case(3)
                        <td><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                        @break
                    @case(4)
                        <td><span class="badge bg-success p-2">В процессе</span></td>
                        @break
                    @case(5)
                        <td><span class="badge bg-warning p-2">Отклон.(сотруд.)</span></td>
                        @break
                    @case(6)
                        <td><span class="badge bg-success p-2">На проверке (Адм)</span></td>
                        @break
                    @case(7)
                        <td><span class="badge bg-danger p-2">{{$task->status->name}}</span></td>
                        @break
                    @case(8)
                        <td><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                        @break
                    @case(9)
                        <td><span class="badge bg-warning p-2">Ожид. (Сотруд)</span></td>
                        @break
                    @case(10)
                        <td><span class="badge bg-success p-2">У клиента</span></td>
                        @break
                    @case(11)
                        <td><span class="badge bg-danger p-2">{{$task->status->name}}</span></td>
                        @break
                    @case(12)
                        <td><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                        @break
                    @case(13)
                        <td><span class="badge bg-danger p-2">Отклон.(клиент.)</span></td> @break
                    @case(14)
                        <td><span class="badge bg-warning p-2">{{$task->status->name}}</span></td> @break
                @endswitch
                <td class="text-center">
                    <a href="{{ route('all-tasks.show', $task->slug) }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
{{--                    <a href="{{ route('mon.edit', $task->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>--}}
{{--                    <a role="button"  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $task->id }}"><i class="bi bi-trash"></i></a>--}}
                </td>
            </tr>

{{--            <div class="modal fade" id="delete{{ $task->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"--}}
{{--                 aria-labelledby="delete{{ $task->id }}" aria-hidden="true">--}}
{{--                <div class="modal-dialog modal-dialog-centered">--}}
{{--                    <div class="modal-content">--}}
{{--                        <form action="{{ route('tasks.delete', $task->id) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <div class="modal-header">--}}
{{--                                <h1 class="modal-title fs-5" id="delete{{ $task->id }}">Предупреждение</h1>--}}
{{--                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}
{{--                                Точно хотите удалть задачу?--}}
{{--                            </div>--}}
{{--                            <div class="modal-footer">--}}
{{--                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>--}}
{{--                                <button type="submit" class="btn btn-primary">Да. точно</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        @endforeach
        </tbody>
    </table>

</div>
