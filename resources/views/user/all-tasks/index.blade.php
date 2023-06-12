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

    <script>
        window.onload = function() {
            var selectElement = document.getElementById("status");
            var optionElements = selectElement.getElementsByTagName("option");

            for (var i = 0; i < optionElements.length; i++) {
                var option = optionElements[i];
                if (option.value === "0" && option.selected) {
                    option.style.color = "red"; // Change the color to your desired color
                }
            }

            selectElement.addEventListener("change", function() {
                for (var i = 0; i < optionElements.length; i++) {
                    var option = optionElements[i];
                    if (option.value === "0") {
                        option.style.color = option.selected ? "red" : "";
                    }
                }
            });
        };
    </script>
    @routes
    <script>

        $(document).ready(function () {

            var table = $('#example').DataTable({
                initComplete: function () {

                },
            });

            $('#status, #state, #source').on('change', function() {
                filterLeads()
            });

            function filterLeads() {
                let status = $('#status').val();
                let state = $('#state').val();
                let source = $('#source').val();

                $.get(`tasks/public/filter-leads/${status}/${state}/${source}`, function(responce) {
                    let table = $('#tbody').empty();
                    console.log(responce)
                    buildTable(responce.data, table)
                });



            }


            function buildTable(data, table) {
                $.each(data, function(i, item) {

                    let show = route('lead.show', item.id);
                    let edit = route('lead.edit', item.id)


                    let row = `<tr>
                  <td>${i + 1}</td>
                  <td>${item.contact_name}</td>
                  <td>${item.status}</td>
                  <td>${item.source}</td>
                  <td>${item.lead_state}</td>
                  <td>${item.author}</td>
                  <td class="text-center">
                    <a href="${show}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                   <a href="${edit}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
<a class="btn btn-danger" data-bs-toggle="modal"
                                       data-bs-target="#delete${item.id}"><i class="bi bi-trash"></i></a>
                  </td>
                </tr>`;
                    table.append(row);
                });
            }
        });

    </script>
@endsection


