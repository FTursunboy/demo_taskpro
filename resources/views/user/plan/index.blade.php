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
        <a href="{{ route('user.index') }}" class="btn btn-danger {{ (count($myPlan) === 0) ? 'disabled' : '' }}">Назад</a>
        <a role="button" class="btn btn-success" data-bs-toggle="offcanvas" data-bs-target="#listPlanUsers" aria-controls="listPlanUsers">Мои планы на сегодня</a>
        <section class="section">
            <div >
                <div id="chart" class="row d-flex justify-content-center w-100" style="width: 100%"></div>
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
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Название плана</label>
                                <input type="text" name="name" class="form-control" placeholder="Введите имя плана" id="name" required tabindex="1">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hour">Время (в часах)</label>
                                <input type="number" min="1" max="{{ 8 - $myPlan->where('status', false)->pluck('hour')->sum() }}" step="0.5" name="hour" id="hour" class="form-control" placeholder="Введите час" required tabindex="2">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="description">Описание плана</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" required tabindex="3"></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-primary" id="submitPlan">
                            Сохранить
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{--  Create Plan Canvas End  --}}

    {{--  List Plan Canvas Start  --}}
    <div style="height: 70%" class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="listPlanUsers" aria-labelledby="listPlanUsers">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="listPlanUsers">
                Список планов на сегодня
                @if($myPlan->where('status', false)->pluck('hour')->sum() < 8 )
                <a style="margin-left: 30px" role="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#addNewPlanUsers" aria-controls="addNewPlanUsers">Добавить новый план на сегодня</a>
                @else
                <span class="bg-danger text-white px-3 py-1 rounded">У вас неосталось времени.</span>
                @endif
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">
            <table class="table table-hover">
                <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Имя</th>
                    <th>Описание</th>
                    <th>Час</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($myPlan as $plan)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Str::limit($plan->name, 30) }}</td>
                        <td>{{ \Str::limit($plan->description, 20) }}</td>
                        <td>{{ $plan->hour }}</td>
                        <td width="200">
                            <a href="{{ route('plan.ready', $plan->id) }}" class="badge bg-success p-2"><i class="bi bi-check"></i></a>
                            @if($plan->status === 0)
                                <a href="{{ route('plan.delete', $plan->id) }}" class="badge bg-danger p-2"><i class="bi bi-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{--  List Plan Canvas End  --}}


@endsection
@section('script')
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
    <script>
        var options = {
            chart:{
                type: 'bar',
                width:'70%',
                stacked: true,
            },
            series:[{
                name: 'Success',
                data: [44, 55, 41, 67, 22, 43, 21, 49]
            }, {
                name: 'Un success',
                data: [13, 23, 20, 8, 13, 27, 33, 12,]
            }],
            xaxis:{
                categories: [200,300,400,500,600]
            },
        }
        var chart = new ApexCharts(document.querySelector('#chart'), options)
        chart.render()
    </script>
    <script>
        $('#submitPlan').click(function (){
            $(this).attr('type', 'submit')
            $(this).click()
            $(this).addClass('d-none')
        });
    </script>
@endsection
