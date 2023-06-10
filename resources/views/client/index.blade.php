@extends('client.layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Задачи</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('offers.index')}}">Задачи</a></li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @include('inc.messages')
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="example">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Статус</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tasks as $task)
                            <tr>

                                <td>{{$loop->iteration}}</td>
                                <td>{{$task->name}}</td>
                                <td>{{\Illuminate\Support\Str::limit($task->description, 20)}}</td>
                                @if($task->status->id == 1)
                                    <td><span class="badge bg-success p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 2)
                                    <td><span class="badge bg-primary p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 3)
                                    <td><span class="badge bg-success p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 4)
                                    <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 5)
                                    <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 6)
                                    <td><span class="badge bg-primary p-2">На проверке (У админа)</span>
                                    </td>
                                @elseif($task->status->id == 7)
                                    <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 8)
                                    <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 9)
                                    <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 10)
                                    <td><a href="#" data-bs-target="#send{{$task->id}}" data-bs-toggle="modal"><span
                                                class="badge bg-success p-2">Задача сделана, нажмите чтобы завершить</span></a>
                                    </td>
                                @elseif($task->status->id == 11)
                                    <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 12)
                                    <td><span class="badge bg-primary p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 13)
                                    <td><span class="badge bg-success p-2">{{$task->status->name}}</span>
                                    </td>
                                @elseif($task->status->id == 14)
                                    <td><span class="badge bg-success p-2">{{$task->status->name}}</span>
                                    </td>
                                @endif
                                <td>
                                    <a class="badge bg-success p-2" href="{{route('offers.show', $task->id)}}"><i
                                            class="bi bi-eye p-2"></i></a>
                                    <a class=" badge bg-primary p-2" href="{{route('offers.edit', $task->id)}}"><i
                                            class="bi bi-pencil"></i></a>
                                    <a class="badge bg-warning p-2" href="{{route('offers.chat', $task->id)}}"><i class="bi bi-chat"></i></a>

                                </td>
                            </tr>


                            <div class="modal" tabindex="-1" id="send{{$task->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Убедитесь что задача выполнена</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Вы действительно хотите закрыть задачу, если нет оптравьте заново</p>
                                            <hr>
                                            <h6 class="text-center">Поставьте оценку, за выполнение задачи!</h6>
                                            <div class="gezdvu">
                                                <div class="ponavues">

                                                    <label class="eysan">
                                                        <form id="scoreForm" action="{{route('score', $task->id)}}" method="post">
                                                            @csrf
                                                            <input type="radio"  name="rating" id="star1" value="1">
                                                            <input type="hidden" name="rating" id="star1" value="1">
                                                        </form>
                                                        <div class="face"></div>
                                                        <i class="far fa-star gasedun one-star"></i>
                                                    </label>


                                                    <label class="eysan">
                                                        <form id="scoreForm2" action="{{route('score', $task->id)}}" method="post">
                                                            @csrf
                                                            <input type="radio" name="rating" id="star2" value="2">
                                                            <input type="hidden" name="rating" id="star2" value="2">
                                                        </form>
                                                        <div class="face"></div>
                                                        <i class="far fa-star gasedun two-star"></i>
                                                    </label>


                                                    <label class="eysan">
                                                        <form id="scoreForm3" action="{{route('score', $task->id)}}" method="post">
                                                            @csrf
                                                            <input type="radio" name="rating" id="star3" value="3">
                                                            <input type="hidden" name="rating" id="star3" value="3">
                                                        </form>
                                                        <div class="face"></div>
                                                        <i class="far fa-star gasedun three-star"></i>
                                                    </label>

                                                    <label class="eysan">
                                                        <form id="scoreForm4" action="{{route('score', $task->id)}}" method="post">
                                                            @csrf
                                                            <input type="radio" name="rating" id="star4" value="4">
                                                            <input type="hidden" name="rating" id="star4" value="4">
                                                        </form>
                                                        <div class="face"></div>
                                                        <i class="far fa-star gasedun four-star"></i>
                                                    </label>


                                                    <label class="eysan">
                                                        <form id="scoreForm5" action="{{route('score', $task->id)}}" method="post">
                                                            @csrf
                                                            <input type="radio" name="rating" id="star5" value="5">
                                                            <input type="hidden" name="rating" id="star5" value="5">
                                                        </form>
                                                        <div class="face"></div>
                                                        <i class="far fa-star gasedun five-star"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{route('offers.decline', $task->id)}}" class="btn btn-danger">Отправить
                                                заново</a>
                                            <a href="{{route('offers.ready', $task->id)}}" class="btn btn-success">Завершить</a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        @empty
                            <td colspan="5"><h1 class="text-center">Пока нет завершенных задач</h1></td>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">

    <script>
        $(function() {
            $(document).on({
                mouseover: function (event) {
                    $(this).find('.far').addClass('star-over');
                    $(this).prevAll().find('.far').addClass('star-over');
                },
                mouseleave: function (event) {
                    $(this).find('.far').removeClass('star-over');
                    $(this).prevAll().find('.far').removeClass('star-over');
                }
            }, '.eysan');

            $(document).on('click', '.eysan', function () {
                if (!$(this).find('.gasedun').hasClass('eysan-active')) {
                    $(this).siblings().find('.star').addClass('far').removeClass('fas eysan-active');
                    $(this).find('.gasedun').addClass('eysan-active fas').removeClass('far star-over');
                    $(this).prevAll().find('.gasedun').addClass('fas').removeClass('far star-over');
                } else {
                }
            });


            $(document).ready(function () {
                $('.eysan  input[type="radio"]').on('click', function () {
                    $('#scoreForm').submit();
                });
            });
            $(document).ready(function () {
                $('.eysan input[type="radio"]').on('click', function () {
                    $('#scoreForm2').submit();
                });
            });
            $(document).ready(function () {
                $('.eysan input[type="radio"]').on('click', function () {
                    $('#scoreForm3').submit();
                });
            });
            $(document).ready(function () {
                $('.eysan input[type="radio"]').on('click', function () {
                    $('#scoreForm4').submit();
                });
            });
            $(document).ready(function () {
                $('.eysan input[type="radio"]').on('click', function () {
                    $('#scoreForm5').submit();
                });
            });
        });

    </script>

    <script src="{{asset('assets/js/filter3.js')}}"></script>


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
                .text('Обнулить')
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


