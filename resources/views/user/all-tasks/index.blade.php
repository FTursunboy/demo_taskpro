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
                var table = $('#example_1').DataTable({
                    initComplete: function () {

                    },
                });

                $('#month').on('change', function () {
                    filterMonth()
                });

                function filterMonth() {
                    let month = $('#month').val();

                    $.get(`/filter_month/${month}`, function (response) {
                        var table = $('#example_1').DataTable();

                        table.clear().draw();

                        if (response.tasks.length > 0) {
                            buildTable(response.tasks, table);
                        }

                    });
                }

                function buildTable(data, table) {
                    $.each(data, function (i, item) {
                        var routeName = 'all-tasks.show'; // Замените 'route.name' на фактическое имя маршрута в Laravel
                        var routeUrl = "{{ route('all-tasks.show', ':slug') }}"; // Замените 'route.name' на фактическое имя маршрута в Laravel
                        routeUrl = routeUrl.replace(':slug', item.slug); // Замените 'slug' на фактический параметр маршрута

                        table.row.add([
                            i + 1,
                            item.task_name,
                            item.task_description,
                            item.from,
                            item.to,
                            item.project,
                            item.author,
                            item.type,
                            item.status,
                            `<a href="${routeUrl}" class="btn btn-success"><i class="bi bi-eye"></i></a>`

                        ]).draw(false);
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
                var table = $('#example_1').DataTable({
                    "processing": true,
                    "stateSave": true
                });


                var statusParam = decodeURIComponent(window.location.pathname.split('/').pop());


                $("#example_1 thead th").each(function(i) {

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

                $("#example_1 thead th").each(function (i) {
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
                                $("#example_1 thead select").each(function () {
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

                        $("#example_1 thead select").val('');

                        $('#example_1_filter input').val('');
                    });

                var searchWrapper = $('#example_1_filter');
                searchWrapper.addClass('d-flex align-items-center');
                resetButton.addClass('ml-2');
                resetButton.appendTo(searchWrapper);

            });


        </script>

    <script src="{{ asset('assets/ajax/monitoring.js') }}"></script>

    <script src="{{asset('assets/js/search.js')}}"></script>
    <script src="{{asset('assets/js/datatable.js')}}"></script>




@endsection


