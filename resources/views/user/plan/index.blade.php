@extends('user.layouts.app')

@section('title')Мои планы@endsection


@section('content')
    <div id="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Мои планы</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Панель</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Мои планы</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('inc.messages')
        <a href="{{ route('user.index') }}" class="btn btn-danger">Назад</a>
        <a role="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#addNewPlanUsers" aria-controls="addNewPlanUsers">Добавить новый план</a>
        <section class="section">
            <div class="mt-5 p-5">
                <table class="table table-hover mt-5" id="example">
                    <thead>
                    <tr>
                        <th>Дата</th>
                        <th>Имя</th>
                        <th>Описание</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allPlan as $plan)
                        <tr class="{{ ($plan->status === 1) ? 'bg-light-success' : '' }}">
                            <td>{{ date('d-m-Y',strtotime($plan->date))  }}</td>
                            <td>{{ \Str::limit($plan->name, 30) }}</td>
                            <td>{{ \Str::limit($plan->description, 20) }}</td>
                            <td>
                                @if($plan->status === 1)
                                    <span class="badge bg-success p-2">Завершён</span>
                                @else
                                    <span class="badge bg-danger p-2">Не завершён</span>
                                @endif
                            </td>
                            <td width="200">
                                <a role="button" class="badge bg-success p-2" data-bs-toggle="offcanvas" data-bs-target="#showPlanUsers{{ $plan->id }}" aria-controls="showPlanUsers{{ $plan->id }}"><i class="bi bi-eye"></i></a>
                                @if($plan->status === 0)
                                    <a role="button" class="badge bg-warning p-2" data-bs-toggle="offcanvas" data-bs-target="#editPlanUsers{{ $plan->id }}" aria-controls="editPlanUsers{{ $plan->id }}"><i class="bi bi-pencil"></i></a>
                                    <a href="{{ route('plan.ready', $plan->id) }}" class="badge bg-primary p-2"><i class="bi bi-check"></i></a>
                                @endif
                                <a href="{{ route('plan.delete', $plan->id) }}" class="badge bg-danger p-2"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>

                        {{--  Show Plan Canvas Start  --}}
                        <div style="width: 70%" class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="showPlanUsers{{ $plan->id }}" aria-labelledby="showPlanUsers{{ $plan->id }}">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="showPlanUsers{{ $plan->id }}">{{ $plan->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="container">
                                        <div class="row mb-4">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="name">Название плана</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $plan->name }}" id="name" disabled tabindex="1">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="hour">Время (в часах)</label>
                                                    <input type="number" id="hour" class="form-control" value="{{ $plan->hour }}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="hour">Дата</label>
                                                    <input type="date" id="date1" class="form-control" value="{{ $plan->date }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="description">Описание плана</label>
                                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" disabled>{{ $plan->description }}</textarea>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        {{--  Show Plan Canvas End  --}}


                        {{--  Edit Plan Canvas Start  --}}
                        <div style="width: 70%" class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="editPlanUsers{{ $plan->id }}" aria-labelledby="editPlanUsers{{ $plan->id }}">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="editPlanUsers{{ $plan->id }}">{{ $plan->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="container">
                                    <form action="{{ route('plan.update', $plan->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row mb-4">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="name">Название плана</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Введите имя плана" id="name" required tabindex="1" value="{{ $plan->name }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="hour">Время (в часах)</label>
                                                    <input type="number" name="hour" id="hour"  class="form-control" placeholder="Введите час" required tabindex="2" value="{{ $plan->hour }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="date">Дата</label>
                                                    <input type="date" id="date" name="date" class="form-control" required tabindex="3" value="{{ $plan->date }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="description">Описание плана</label>
                                                <textarea name="description" id="description" cols="30" rows="5" class="form-control"  required tabindex="4">{{ $plan->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="submit" class="btn btn-primary">
                                                Обновит
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{--  Edit Plan Canvas End  --}}


                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    {{--  Create Plan Canvas Start  --}}
    <div style="width: 70%" class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="addNewPlanUsers" aria-labelledby="addNewPlanUsers">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="addNewPlanUsers">Добавить новый план на сегодня</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container">
                <form action="{{ route('plan.store') }}" method="POST">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Название плана</label>
                                <input type="text" name="name" class="form-control" placeholder="Введите имя плана" id="name" required tabindex="1">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="hour">Время (в часах)</label>
                                <input type="number" name="hour" id="hour" class="form-control" placeholder="Введите час" required tabindex="2">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="date">Дата</label>
                                <input type="date" id="date" name="date" class="form-control" required tabindex="3">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="description">Описание плана</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" required tabindex="4"></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary" id="submitPlan">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  Create Plan Canvas End  --}}
@endsection
@section('script')
    <script src="{{ asset('assets/js/filter3.js') }}"></script>
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
    <script>
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        const formattedDate = `${year}-${month}-${day}`;
        document.getElementById('date1').value = formattedDate;
    </script>
@endsection
