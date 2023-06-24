<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="verClient"
     aria-labelledby="verClient" style="width: 100%; height: 80%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="ProjectOfCanvas">На проверке (Клиент)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <div class="card-body overflow-hidden">
                <div>
                    <table class="table table-hover mt-3 " cellpadding="5">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Название<span class="btn btn-right">></span></th>
                            <th>Описание</th>
                            <th class="text-center">Время</th>
                            <th class="text-center">От</th>
                            <th class="text-center">До</th>
                            <th class="text-center">Проект</th>
                            <th class="text-center">Автор</th>
                            <th class="text-center">Тип</th>
                            <th class="text-center">Статус</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasksVerClient as $task)
                            <tr>
                                <td class="text-center">{{ $loop->iteration  }}</td>
                                <td >{{ $task->name }}</td>
                                <td >{{ Str::limit($task->comment, 100) }}</td>
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
                                <td class="text-center">
                                    <a href="{{ route('all-tasks.show', $task->slug) }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

