<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Время</th>
            <th>От</th>
            <th>До</th>
            <th>Проект</th>
            <th>Автор</th>
            <th>Тип</th>
            <th>Статус</th>
            <th class="text-center">Действия</th>
        </tr>
        </thead>
        <tbody id="tableBodyMonitoring">
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->created_at->format('d-m-Y') }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->time }}</td>
                <td>{{ date('d-m-Y', strtotime($task->from))  }}</td>
                <td>{{ date('d-m-Y', strtotime($task->to))  }}</td>
                <td>{{ $task->project->name  }}</td>
                <td>{{ $task->author->name  }}</td>
                <td>
                    @if($task->type === null)
                        От клиента
                    @elseif($task->type !== null)
                        {{ $task->type?->name }} {{  (isset($task->typeType?->name)) ? ' - '.$task->typeType?->name : '' }}
                    @endif
                </td>
                <td>{{ $task->status->name}}</td>
                <td class="text-center">
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
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
