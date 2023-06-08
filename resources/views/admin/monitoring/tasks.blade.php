<div class="table-responsive">
    <table id="example" class="table table-hover">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th >Имя</th>
            <th class="text-center">Время</th>
            <th class="text-center">От</th>
            <th class="text-center">До</th>
            <th class="text-center">Проект</th>
            <th class="text-center">Автор</th>
            <th class="text-center">Тип</th>
            <th class="text-center">Статус</th>
            <th class="text-center">Сотрудник</th>
            <th class="text-center">Действия</th>
        </tr>
        </thead>
        <tbody id="tableBodyMonitoring">
        @foreach($tasks as $task)
            <tr>
                <td class="text-center">{{ $task->created_at->format('d-m-Y') }}</td>
                <td >{{ $task->name }}</td>
                <td class="text-center">{{ $task->time }}</td>
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
                <td class="text-center">{{ $task->status->name}}</td>
                <td class="text-center">{{ $task->user?->surname . ' ' . $task->user?->name}}</td>
                <td class="text-center">
                    <a href="{{ route('mon.show', $task->id) }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('mon.edit', $task->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>

</div>
