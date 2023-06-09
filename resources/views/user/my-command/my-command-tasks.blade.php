<div class="table-responsive">
    <table id="example" class="table table-hover">
        <thead>
        <tr class="text-center">
            <th>#</th>
            <th>Задача</th>
            <th>Статус</th>
            <th>Исполнитель</th>
            <th>Проект</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody id="tableBodyMonitoring">
        @foreach($userListTasks as $task)
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $task->task }}</td>
                <td>{{ $task->sts }}</td>
                <td>{{ $task->surname . ' ' . $task->name. ' '. $task->lastname}}</td>
                <td>{{ $task->group}}</td>
                <td>
                    <a href="#" class="btn btn-success"><i class="bi bi-eye"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
