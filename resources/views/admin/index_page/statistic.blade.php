<div class="col-md-12">
    <div class="card">
        <div class="card-header "></div>
        <div class="card-body overflow-auto">
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
                    <th class="text-center">ФИО</th>
                    <th class="text-center">Все задачи</th>
                    <th class="text-center">Долг</th>
                    <th class="text-center">В процессе</th>
                    <th class="text-center">Принято</th>
                    <th class="text-center">Готово</th>
                    <th class="text-center">Просроченное</th>
                    <th class="text-center">Ожидается</th>
                    <th class="text-center">Ожидается (Админ)</th>
                    <th class="text-center">Ожидается (Сотрудник)</th>
                    <th class="text-center">На проверку</th>
                    <th class="text-center">На проверке (У админа)</th>
                    <th class="text-center">На проверке (У клиента)</th>
                    <th class="text-center">Отклонено</th>
                    <th class="text-center">Отклонено (Администратором)</th>
                    <th class="text-center">Отклонено (Сотрудником)</th>
                </tr>
                </thead>
                <tbody id="tableBodyMonitoring">
                @foreach($statistics as $user)
                    <tr>
                        <td class="text-center">{{$user->id }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($user->name . " " . $user->surname, 50)  }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['total'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['debt'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['process'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['accept'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['ready'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['speed'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['expected'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['expectedAdmin'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['expectedUser'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['forVerification'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['forVerificationAdmin'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['forVerificationClient'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['rejected'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['rejectedAdmin'] }}</td>
                        <td class="text-center">{{ $user->usersCountTasks($user->id)['rejectedClient'] }}</td>
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
                tableBody.empty()

                if (response.statistics.length > 0) {
                    buildTable(response.statistics, tableBody);
                }

            });
        }

        function buildTable(data, tableBody) {
            $.each(data, function (i, item) {
                let row = `
                <tr>
                    <td class="text-center">${i + 1}</td>
                    <td>${item.user}</td>
                    <td class="text-center">${item.total !== null ? item.total : 0}</td>
                    <td class="text-center">${item.debt !== null ? item.debt : 0}</td>
                    <td class="text-center">${item.process !== null ? item.process : 0}</td>
                    <td class="text-center">${item.accept !== null ? item.accept : 0}</td>
                    <td class="text-center">${item.ready !== null ? item.ready : 0}</td>
                    <td class="text-center">${item.speed !== null ? item.speed : 0}</td>
                    <td class="text-center">${item.expected !== null ? item.expected : 0}</td>
                    <td class="text-center">${item.expectedAdmin !== null ? item.expectedAdmin : 0}</td>
                    <td class="text-center">${item.expectedUser !== null ? item.expectedUser : 0}</td>
                    <td class="text-center">${item.forVerification !== null ? item.forVerification : 0}</td>
                    <td class="text-center">${item.forVerificationAdmin !== null ? item.forVerificationAdmin : 0}</td>
                    <td class="text-center">${item.forVerificationClient !== null ? item.forVerificationClient : 0}</td>
                    <td class="text-center">${item.rejected !== null ? item.rejected : 0}</td>
                    <td class="text-center">${item.rejectedAdmin !== null ? item.rejectedAdmin : 0}</td>
                    <td class="text-center">${item.rejectedClient !== null ? item.rejectedClient : 0}</td>
                </tr>`;

                tableBody.append(row);
            });
        }


    });
</script>
