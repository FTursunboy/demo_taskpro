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
                <td class="text-center">{{$loop->iteration }}</td>
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
                var filterColumns = ['Исполнитель', 'Проект', 'Статус']; // Columns to add filters for

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

                    // Set the selected option based on the stored filter value
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
