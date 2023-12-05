@extends('admin.layouts.app')
@section('title')Список задач@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/filter.css')}}">
    @endsection
@section('content')
    <style>
        .content{
            padding: 40px 0;
        }
        /*
        .filter-wrapper{
          padding: 30px 0;
        }*/

        .filter-checkbox{
            margin-left: 30px
        }
        .filter-checkbox:first-child{
            margin-left:0
        }
    </style>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Список задач клиентов</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('client.offers.index')}}">Список задач клиентов</a></li>

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            @if(isset($mess))
                                <div class="alert alert-success">
                                    {{$mess}}
                                </div>
                            @endif
                                @if(session('mess'))
                                    <div class="alert alert-success">
                                        Успешно отправлено
                                    </div>
                                @endif
                            @include('inc.messages')
                            <div>
                                <a href="{{ route( 'client.offers.create')  }}" class="btn btn-outline-primary">Добавить задачу</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-responsive" id="example">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Описание</th>
                                    <th>Исполнитель</th>
                                    <th>Проект</th>
                                    <th>Статус</th>
                                    <th>Дата создания</th>
                                    <th class="text-center">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($offers as $offer)
                                    <tr>
                                        <td width="20%">{{\Illuminate\Support\Str::limit($offer->name, 35)}}</td>
                                        <td width="15%">{{\Illuminate\Support\Str::limit($offer->description, 35)}}</td>
                                        @if($offer->user_id)
                                            <td>{{$offer->username}}</td>
                                        @else
                                            <td class="text-danger text-bold">Не распределен</td>
                                        @endif

                                        <td>{{$offer->project_name}}</td>

                                        @switch($offer->status)
                                            @case(1)
                                            <td><span class="badge bg-success p-2">{{$offer->status_name}}</span></td>
                                            @break
                                            @case(2)
                                            <td><span class="badge bg-primary p-2">{{$offer->status_name}}</span></td>
                                            @break
                                            @case(3)
                                            <td><span class="badge bg-success p-2">{{$offer->status_name}}</span></td>
                                            @break
                                            @case(4)
                                            <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span></td>
                                            @break
                                            @case(5)
                                            <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span></td>
                                            @break
                                            @case(6)
                                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#send{{$offer->id}}"><span class="badge bg-primary p-2">В ожидании проверки администратора</span></a></td>
                                            @break
                                            @case(7)
                                            <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span></td>
                                            @break
                                            @case(8)
                                            <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span></td>
                                            @break
                                            @case(9)
                                            <td><span class="badge bg-warning p-2">{{$offer->status_name}}</span></td>
                                            @break
                                            @case(10)
                                            <td><span class="badge bg-success p-2">{{$offer->status_name}}</span></td>
                                            @break
                                            @case(11)
                                            <td><span class="badge bg-danger p-2">{{$offer->status_name}}</span></td>
                                            @break
                                            @case(12)
                                            <td><a data-bs-target="#sendBack{{$offer->id}}" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">Отклонено (Сотрудник)</span></a></td>
                                            @break
                                            @case(13)
                                            <td><a data-bs-target="#sendBack{{$offer->id}}" data-bs-toggle="modal" href="#"><span class="badge bg-danger p-2">Отклонено (Клиент)</span></a></td>
                                            @break
                                            @case(14)
                                            <td><a href="#" data-bs-target="#send{{$offer->id}}" data-bs-toggle="modal"><span class="badge bg-success p-2">Задача сделана, отправьте клиенту на проверку</span></a></td>
                                            @break
                                        @endswitch
                                        <td>{{\Carbon\Carbon::parse($offer->created_at)->format('Y-m-d') }}</td>

                                    @if($offer->user_id)
                                            @if(isset($search))

                                                <td class="text-center">
                                                    <a class="badge bg-success p-2" href="{{ route('client.offers.show.search', ['offer' => $offer->slug, 'search' => $search]) }}">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$offer->id}}"><i class="bi bi-trash"></i></a>
                                                </td>
                                            @else
                                                <td class="text-center">
                                                    <a class="badge bg-success p-2" href="{{route('client.offers.show', $offer->slug)}}"><i class="bi bi-eye"></i></a>
                                                    <a class="badge bg-primary p-2" href="{{route('client.offers.edit', $offer->id)}}"><i class="bi bi-pencil"></i></a>
                                                    <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$offer->id}}"><i class="bi bi-trash"></i></a>
                                                </td>
                                            @endif

                                        @else
                                            @if(isset($search))

                                            <td class="text-center">
                                                <a class="badge bg-success p-2" href="{{ route('client.offers.show.search', ['offer' => $offer->slug, 'search' => $search]) }}">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$offer->id}}"><i class="bi bi-trash"></i></a><a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$offer->id}}"><i class="bi bi-trash"></i></a>
                                                                                           </td>
                                            @else
                                                <td class="text-center">
                                                    <a class="badge bg-success p-2" href="{{route('client.offers.show', $offer->slug)}}"><i class="bi bi-eye"></i></a>
                                                    <a class="badge bg-primary p-2" href="{{route('client.offers.edit', $offer->id)}}"><i class="bi bi-pencil"></i></a>
                                                    <a class="badge bg-danger p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete{{$offer->id}}"><i class="bi bi-trash"></i></a>
                                                </td>
                                            @endif
                                        @endif
                                    </tr>

                                    <div class="modal" tabindex="-1" id="delete{{$offer->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Вы действительно хотите удалить задачу</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                                    <a href="{{route('client.offers.delete', $offer->id)}}" class="btn btn-danger" >Удалить</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal" tabindex="-1" id="send{{$offer->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('client.offers.send.back', $offer->id)}}" method="post">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Отправление задачи на проверку</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" id="reasonSend" style="display: none">
                                                        <p>Вы действительно хотите отклонить задачу</p>
                                                        <textarea required name="reason" class="form-control" id="" cols="30" rows="2"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button  id="reason" type="button" class="btn btn-danger">Отклонить, Отправить заново</button>
                                                        <button  id="reasonButton" type="submit" class="btn btn-danger" style="display: none">Отклонить, Отправить заново</button>
                                                        <a href="{{route('client.offers.send.client', $offer->id)}}" class="btn btn-success" id="sendButton">Отправить</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal" tabindex="-1" id="sendBack{{$offer->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('client.offers.send.back', $offer->id)}}" method="post">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Задача отклонена</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Вы действительно хотите отправить задачу обратно сотруднику <span style="font-size: 20px" class="text-success">{{$offer->username}}</span></p>
                                                        <label for="reason1">
                                                            <textarea required name="reason1" class="form-control" id="" cols="60" rows="2"></textarea>
                                                        </label>
                                                    </div>
                                                    <div class="modal-footer" id="parent">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                                        <button type="submit" class="btn btn-success" >Отправить</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <td  colspan="7"><h1 class="text-center">Пока нет задач</h1></td>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div

@endsection
@section('script')
    <script src="{{asset('assets/js/filter3.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#reason').on('click', function() {
                $('#reason').hide();
                $('#reasonButton').show();
                $('#reasonSend').show();
                $('#sendButton').hide();
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                "processing": true,
                "stateSave": true // Включаем сохранение состояния
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
                var filterColumns = ['Проект', 'Статус', 'Исполнитель'];

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
                    // Сбрасываем фильтры и поиск
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


