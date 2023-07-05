@extends('user.layouts.app')

@section('title')
    Все задачи
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Все задачи</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Все задачи</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @include('inc.messages')

        <div class="row mt-4">
            <div class="col-12">
                <div id="tasks">
                    @include('user.all-tasks.tasks')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
        <script src="{{asset('assets/js/filter3.js')}}"></script>
        <script>
            $(document).ready(function () {
                var table = $('#example1').DataTable({
                    initComplete: function () {

                    },
                });

                $('#month').on('change', function () {
                    filterMonth()
                });

                function filterMonth() {
                    let month = $('#month').val();

                    $.get(`/tasks/public/all-task/public/monitoring-statistics-filter/${month}`, function (response) {
                        let tableBody = $('#tableBodyMonitoring');
                        table.clear().draw();
                        tableBody.empty()

                        if (response.statistics.length > 0) {
                            buildTable(response.months, tableBody);
                        }

                    });
                }

                function buildTable(data, tableBody) {
                    $.each(data, function (i, item) {
                        let row = `
                <tr>
                    <td class="text-center">${i + 1}</td>
                    <td>${item.name}</td>
                    <td class="text-center">${item.description}</td>
                    <td class="text-center">${item.from}</td>
                    <td class="text-center">${item.project.name}</td>
                    <td class="text-center">${item.project.author}</td>
                    <td class="text-center">${item.project.type}</td>
                    <td class="text-center">${item.project.status.name}</td>
                </tr>`;

                        tableBody.append(row);
                    });
                }


            });
        </script>
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
                var table = $('#example').DataTable({
                    "processing": true,
                    "stateSave": true
                });


                var statusParam = decodeURIComponent(window.location.pathname.split('/').pop());


                $("#example thead th").each(function(i) {

                    var th = $(this);
                    var filterColumns = ['Проект', 'Автор', 'Тип', 'Статус', 'Сотрудник'];

                    if (filterColumns.includes(th.text().trim())) {

                        if (th.text().trim() === 'Статус') {

                            var select = th.find('select');

                            select.val(statusParam);
                            select.trigger('change');
                        }
                    }
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

    <script src="{{ asset('assets/ajax/monitoring.js') }}"></script>

    <script src="{{asset('assets/js/search.js')}}"></script>
    <script src="{{asset('assets/js/datatable.js')}}"></script>




@endsection


