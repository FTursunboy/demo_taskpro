@extends('admin.layouts.app')

@section('title')Мои планы@endsection


@section('content')
    <div id="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Планы {{ $user->name .' '. $user->surname}}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Сотрудники</a></li>
                            <li class="breadcrumb-item active" aria-current="page">План сотрудника</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <a href="{{ route('employee.index') }}" class="btn btn-danger">Назад</a>
                <div class="col-3 text-end">
                    <label for="day"><b>Выберите дату:</b></label>
                    <input type="date" id="day" class="form-control">
                </div>
            </div>
        </div>

        <section class="section">
            <table class="table table-hover" id="plan_table">
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Имя</th>
                    <th>Описание</th>
                    <th>Статус</th>
                    <th>Время (в часах)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($plans as $plan)
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
                            {{ $plan->hour }}
                        </td>
                    </tr>
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
                @endforeach
                </tbody>
            </table>
        </section>
    </div>

@endsection

@section('script')
    <script src="{{asset('assets/js/filter4.js')}}"></script>
    <script>
        $(document).ready(function () {
            var table = $('#plan_table').DataTable({
                initComplete: function () {

                },
            });

            $('#day').on('change', function () {
                filterDay()
            });

            function filterDay() {
                let day = $('#day').val();

                $.get(`/filter_day/${day}`, function (response) {
                    var table = $('#plan_table').DataTable();
                    console.log(response)
                    table.clear().draw();

                    if (response.plans.length > 0) {
                        buildTable(response.plans, table);
                        console.log(response)
                    }

                });
            }

            function buildTable(data, table) {
                $.each(data, function (i, item) {

                    table.row.add([
                        i + 1,
                        item.created_at,
                        item.name,
                        item.description,
                        item.status,
                        item.hour,
                    ]).draw(false);
                });
            }

        });

    </script>
@endsection
