@extends('admin.layouts.app')

@section('title')
    Мониторинг
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Мониторинг</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Мониторинг</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @if(session('mess'))
            <div class="alert alert-success">
                {{session('mess')}}
            </div>
        @endif
        <div class="row mt-12">
            <div id="controls" class="col-md-12">
                <a href="#" id="exportButton" class="btn btn-danger mb-4"> Excel</a>
                <label for=""> Название </label>
                <input type="checkbox" data-column-class="col-1" checked>
                <label for=""> Описание </label>
                <input type="checkbox" data-column-class="col-2" checked>
                <label for=""> От </label>
                <input type="checkbox" data-column-class="col-3" checked>
                <label for=""> До </label>
                <input type="checkbox" data-column-class="col-4" checked>
                <label for=""> Проект </label>
                <input type="checkbox" data-column-class="col-5" checked>
                <label for=""> Автор </label>
                <input type="checkbox" data-column-class="col-6" checked>
                <label for=""> Тип </label>
                <input type="checkbox" data-column-class="col-7" checked>
                <label for=""> Статус </label>
                <input type="checkbox" data-column-class="col-8" checked>
                <label for=""> КПД </label>
                <input type="checkbox" data-column-class="col-9" checked>
                <label for=""> Исполнитель </label>
                <input type="checkbox" data-column-class="col-10" checked>
                <label for=""> Действие </label>
                <input type="checkbox" data-column-class="col-11" checked>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table id="example" class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th data-td="td_one" class="col-1">Имя<span class="btn btn-right">></span></th>
                            <th data-td="td_four" class="col-2">Описание<span class="btn btn-right">></span></th>
                            <th data-td="td_two" class="col-3">От<span class="btn btn-right">></span></th>
                            <th data-td="td_three" class="col-4">До<span class="btn btn-right">></span></th>
                            <th class="col-5">Проект</th>
                            <th class="text-center col-6" >Автор</th>
                            <th class="text-center col-7" >Тип</th>
                            <th class="text-center col-8">Статус</th>
                            <th class="text-center col-9">КПД</th>
                            <th class="text-center col-10">Сотрудник</th>
                            <th class="text-center col-11">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="tableBodyMonitoring">
                        @foreach($tasks as $task)
                            <tr>
                                <td class="text-center">{{$task->id + 1000 }}</td>
                                <td class="col-1">{{ \Illuminate\Support\Str::limit($task->name, 50)  }}</td>
                                <td class="col-2">{{ $task->comment  }}</td>
                                <td class="col-3">{{ date('d-m-Y', strtotime($task->from))  }}</td>
                                <td class="col-4">{{ date('d-m-Y', strtotime($task->to))  }}</td>
                                <td class="col-5" class="text-center">{{ $task->project->name  }}</td>
                                <td class="col-6" class="text-center">{{ $task->author->name  }}</td>
                                <td class="text-center col-7">
                                    @if($task->type === null)
                                        От клиента
                                    @elseif($task->type !== null)
                                        {{ $task->type?->name }} {{  (isset($task->typeType?->name)) ? ' - '.$task->typeType?->name : '' }}
                                    @endif
                                </td>

                                @switch($task->status->id)
                                    @case(1)
                                        <td class="col-8"><span class="badge bg-warning p-2">Ожид. (Сотруд)</span></td>
                                        @break
                                    @case(2)
                                        <td class="col-8"><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                                        @break
                                    @case(3)
                                        <td class="col-8"><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                                        @break
                                    @case(4)
                                        <td class="col-8"><span class="badge bg-success p-2">В процессе</span></td>
                                        @break
                                    @case(5)
                                        <td class="col-8"><span class="badge bg-warning p-2">Отклон.(сотруд.)</span></td>
                                        @break
                                    @case(6)
                                        <td class="col-8"><span class="badge bg-success p-2">На проверке (Адм)</span></td>
                                        @break
                                    @case(7)
                                        <td class="col-8"><span class="badge bg-danger p-2">{{$task->status->name}}</span></td>
                                        @break
                                    @case(8)
                                        <td class="col-8"><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                        @break
                                    @case(9)
                                        <td class="col-8"><span class="badge bg-warning p-2">Ожид. (Сотруд)</span></td>
                                        @break
                                    @case(10)
                                        <td class="col-8"><span class="badge bg-success p-2">У клиента</span></td>
                                        @break
                                    @case(11)
                                        <td class="col-8"><span class="badge bg-danger p-2">{{$task->status->name}}</span></td>
                                        @break
                                    @case(12)
                                        <td class="col-8"><span class="badge bg-warning p-2">{{$task->status->name}}</span></td>
                                        @break
                                    @case(13)
                                        <td class="col-8"><span class="badge bg-danger p-2">Отклон.(клиент.)</span></td> @break
                                    @case(14)
                                        <td class="col-8"><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                        </td> @break
                                    @case(15)
                                        <td class="col-8"><span class="badge bg-green p-2">{{$task->status->name}}</span></td> @break
                                    @case(16)
                                        <td class="col-8"><span class="badge bg-success p-2">{{$task->status->name}}</span></td>
                                        @break
                                @endswitch
                                <td class="col-9" class="text-center">{{$task->checkDate?->count}}</td>
                                @if($task->user && $task->user?->deleted_at)
                                    <td  class="text-center col-10">Удаленный аккаунт</td>
                                @else
                                    <td class="text-center col-10">{{ $task->user ? $task->user->surname . ' ' . $task->user->name : '' }}</td>
                                @endif

                                <td class="text-center col-11">
                                    <a href="{{ route('mon.show', $task->slug) }}" class="btn btn-success"><i
                                            class="bi bi-eye"></i></a>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        const controls = document.getElementById('controls');
        controls.addEventListener('change', e => {
            toggleColumn(e.target.dataset.columnClass);
        });

        function toggleColumn(columnClass) {
            const cells = document.querySelectorAll(`.${columnClass}`);

            cells.forEach(cell => {
                cell.classList.toggle('hidden');
            });
        }


    </script>
    {{--    New export to js --}}
    <!-- Подключение библиотеки exceljs через CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>

    <script>
        // Function to export HTML table to Excel using exceljs
        function exportToExcel() {
            const table = document.getElementById('example');

            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet('Sheet 1');

            // Iterate through table rows and cells and add data to the worksheet
            table.querySelectorAll('tr').forEach((row) => {
                const rowData = [];
                row.querySelectorAll('td, th').forEach((cell) => {
                    rowData.push(cell.textContent);
                });
                worksheet.addRow(rowData);
            });

            // Create a blob from the workbook and save it as a .xlsx file
            workbook.xlsx.writeBuffer().then((buffer) => {
                const blob = new Blob([buffer], {type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'});
                const url = window.URL.createObjectURL(blob);

                const a = document.createElement('a');
                a.href = url;
                a.download = 'table-export.xlsx';

                // Trigger a click event on the link to download the file
                a.click();

                // Clean up
                window.URL.revokeObjectURL(url);
            });
        }

        // Attach the exportToExcel function to the button click event
        const exportButton = document.getElementById('exportButton');
        exportButton.addEventListener('click', exportToExcel);

    </script>







    <script src="{{asset('assets/js/filter3.js')}}"></script>
    <script src="{{asset('assets/js/table2excel.js')}}"></script>
    <script type="text/javascript">
        "use strict";

        let tMouse = {
            // isMouseDown
            // tMouse.target
            // tMouse.targetWidth
            // targetPosX
        };
        const eventNames = ["mousedown", "mouseup", "mousemove"];
        eventNames.forEach((e) => window.addEventListener(e, handle));

        function handle(e) {
            if (e.type === eventNames[0]) {
                tMouse.isMouseDown = true;
                let element = e.target.parentElement;
                if (!element.dataset[`td`]) return false;
                let th = document.querySelector(`th[data-td='${element.dataset[`td`]}']`);
                tMouse.target = th;
                tMouse.targetWidth = th.clientWidth;
                tMouse.targetPosX = th.getBoundingClientRect().x;
            }
            if (e.type === eventNames[1]) tMouse = {};
            if (e.type === eventNames[2]) {
                if (!tMouse.target || !tMouse.isMouseDown) return false;
                let size = (e.clientX - tMouse.targetWidth) - tMouse.targetPosX;
                tMouse.target.style.width = tMouse.targetWidth + size + "px";
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            document.getElementById('excel').addEventListener('click', function () {
                var table2excel = new Table2Excel();
                table2excel.export(document.querySelectorAll('#example'));
            })

        });

    </script>
    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                "processing": true,
                "stateSave": true
            });

            var statusParam = decodeURIComponent(window.location.pathname.split('/').pop());

            $("#example thead th").each(function (i) {
                var th = $(this);
                var filterColumns = ['Проект', 'Автор', 'Тип', 'Статус', 'Сотрудник'];


            });

            var filters = JSON.parse(localStorage.getItem('datatableFilters'));
            if (filters) {
                for (var i = 0; i < filters.length; i++) {
                    var filter = filters[i];
                    table.column(filter.columnIndex).search(filter.value);
                }
                table.draw();
            }

            $("#example thead th").each(function (i) {
                var th = $(this);
                var filterColumns = ['Проект', 'Автор', 'Тип', 'Статус', 'Сотрудник'];

                if (filterColumns.includes(th.text().trim())) {
                    var select = $('<select></select>')
                        .appendTo(th.empty())
                        .addClass('form-control')
                        .on('change', function () {
                            var columnIndex = i;
                            var value = $(this).val();
                            table.column(columnIndex).search(value).draw();

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


                    $('<option value="" selected>Все</option>').appendTo(select);

                    var options = table.column(i).data().unique().sort().toArray();

                    options = options.map(function (option) {
                        var tempElement = $('<div>').html(option);
                        return tempElement.text();
                    });

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

            var resetButton = $('<button></button>')
                .addClass('btn btn-primary')
                .text('X')
                .on('click', function () {

                    table
                        .search('')
                        .columns()
                        .search('')
                        .draw();


                    localStorage.removeItem('datatableFilters');

                    $("#example thead select").val('');

                    $('#example_filter input').val('');
                });

            var searchWrapper = $('#example_filter');
            searchWrapper.addClass('d-flex align-items-center');
            resetButton.addClass('ml-2');
            resetButton.appendTo(searchWrapper);
        });


    </script>

@endsection
