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

        <a role="button" class="btn btn-primary mb-4" data-bs-toggle="offcanvas" data-bs-target="#creatTaskClient"
           aria-controls="creatTaskClient">Добавить</a>

        <section class="section">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th data-td="td_one">Название<span class="btn btn-right">></span></th>
                                <th>Описание</th>
                                <th>Статус</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tasks as $task)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{\Str::limit($task->name,50)}}</td>
                                    <td>{{\Str::limit($task->description,50)}}</td>
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
                                        <td><span class="badge bg-primary p-2">В процессе</span>
                                        </td>
                                    @elseif($task->status->id == 8)
                                        <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                        </td>
                                    @elseif($task->status->id == 9)
                                        <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                        </td>
                                    @elseif($task->status->id == 10)
                                        <td><span
                                                    class="badge bg-success p-2">На проверке (У клиента)</span></a>
                                        </td>
                                    @elseif($task->status->id == 11)
                                        <td><span class="badge bg-danger p-2">{{$task->status->name}}</span>
                                        </td>
                                    @elseif($task->status->id == 12)
                                        <td><span class="badge bg-danger p-2">{{$task->status->name}}</span>
                                        </td>
                                    @elseif($task->status->id == 13)
                                        <td><span class="badge bg-danger p-2">{{$task->status->name}}</span>
                                        </td>
                                    @elseif($task->status->id == 14)
                                        <td><span class="badge bg-warning p-2">{{$task->status->name}}</span>
                                        </td>
                                    @endif
                                    <td>
                                        <a class="badge bg-success p-2" href="{{ route('offers.show', $task->slug) }}"><i
                                                class="bi bi-eye"></i></a>
                                        <a data-bs-toggle="offcanvas" data-bs-target="#EditTaskClient{{ $task->id }}"
                                           aria-controls="EditTaskClient{{ $task->id }}" class=" badge bg-primary p-2" href="{{route('offers.edit', $task->id)}}"><i
                                                class="bi bi-pencil"></i></a>
{{--                                        <a class=" badge bg-warning p-2" href="{{route('offers.chat', $task->id)}}"><i--}}
{{--                                                class="bi bi-chat"></i></a>--}}
                                    </td>
                                </tr>




                                {{--  EditTaskClient  ofCanvas Start --}}
                                <div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="EditTaskClient{{ $task->id }}"
                                     aria-labelledby="EditTaskClient{{ $task->id }}" style="width: 100%; height: 80%;">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="EditTaskClient{{ $task->id }}">{{ $task->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <div class="container my-5">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-lg-9">
                                                    <form method="post" action="{{route('offers.update', $task->id)}}"
                                                          enctype="multipart/form-data"
                                                          autocomplete="off">
                                                        @csrf
                                                        @method('patch')
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Название задачи</label>
                                                                <textarea id="name" class="form-control"
                                                                          name="name"
                                                                          rows="5" required>{{ $task->name }}</textarea>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Ответственный сотрудник со стороны
                                                                    компании</label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       name="author_name" id="author_name"
                                                                       value="{{ $task->author_name }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Телефон ответственного сотрудника</label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       name="author_phone" id="author_phone"
                                                                       value="{{ $task->author_phone }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Выберите файл</label>
                                                                <input type="file"
                                                                       class="form-control"
                                                                       name="file">
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="your-message" class="form-label">Описание
                                                                    задачи</label>
                                                                <textarea id="description" class="form-control"
                                                                          name="description"
                                                                          rows="5">{{ $task->description }}</textarea>
                                                            </div>
                                                            <div class="col-md-6">

                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-12">
                                                                <button type="submit" class="btn btn-success form-control">
                                                                    Обновить
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <td colspan="5"><h1 class="text-center">Пока нет задач</h1></td>
                            @endforelse

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

        </section>
    </div>



    {{--  creatTaskClient  ofCanvas Start --}}
    <div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="creatTaskClient"
         aria-labelledby="createtaskClient" style="width: 100%; height: 80%;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="createtaskClient">Новая задача</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container my-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-9">
                        <form method="post" action="{{route('offers.store')}}"
                              enctype="multipart/form-data"
                              autocomplete="off">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Название задачи</label>
                                    <textarea id="name" class="form-control"
                                              name="name"
                                              rows="5" required>{{ old('name') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Ответственный сотрудник со стороны
                                        компании</label>
                                    <input type="text"
                                           class="form-control"
                                           name="author_name" id="author_name"
                                           value="{{ auth()->user()->name ?? old('author_name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Телефон ответсвенного сотрудника</label>
                                    <input type="text"
                                           class="form-control"
                                           name="author_phone" id="author_phone"
                                           value="{{ auth()->user()->phone ?? old('author_phone') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Выберите файл</label>
                                    <input type="file"
                                           class="form-control"
                                           name="file">
                                </div>
                                <div class="col-12">
                                    <label for="your-message" class="form-label">Описание
                                        задачи</label>
                                    <textarea id="description" class="form-control"
                                              name="description"
                                              rows="5">{{ old('description') }}</textarea>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <button type="button" class="btn btn-success form-control"
                                            id="btnSend">
                                        Отправить
                                    </button>
                                </div>
                                <script>
                                    const btn = document.getElementById('btnSend')
                                    btn.addEventListener('click', function () {
                                        const name = document.getElementById('name')
                                        const author_name = document.getElementById('author_name')
                                        const phone = document.getElementById('author_phone')
                                        if (name.value !== '' && author_name.value !== '' && phone.value !== '') {
                                            btn.type = 'submit';
                                            btn.click();
                                            btn.classList.add('disabled')
                                        } else {
                                            name.classList.add('border-danger')
                                            author_name.classList.add('border-danger')
                                            phone.classList.add('border-danger')
                                            btn.classList.remove('disabled')
                                        }
                                    })
                                </script>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  creatTaskClient  ofCanvas Start  --}}



@endsection
@section('script')
    <script src="{{asset('assets/js/filter3.js')}}"></script>

    <script>
        function toggleSendBack() {
            const sendBackButton = document.getElementById('send_back');
            const sendBackSubmitButton = document.getElementById('send_back_submit');
            const dRBlock = document.getElementById('d_r');
            const end = document.getElementById('end');

            sendBackButton.style.display = 'none';
            sendBackSubmitButton.style.display = 'inline-block';
            dRBlock.style.display = 'block';
            end.style.display = 'none';
        }

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
                var filterColumns = ['Статус'];

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
        for (let i = 1; i <= numModals; i++) {
            const modalId = `RatingReason${i}`;
            const textareaContainerId = `textareaContainer${i}`;
            const reasonId = `reason${i}`;

            const reasons = document.querySelectorAll(`#${modalId} input[name="reason"]`);
            const textareaContainer = document.querySelector(`#${textareaContainerId}`);
            const reasontext = document.querySelector(`#${reasonId}`);

            reasons.forEach(reason => {
                reason.addEventListener('change', function () {
                    if (reason.value === 'Другое' && reason.checked) {
                        textareaContainer.style.display = 'block';
                        reasontext.setAttribute('name', 'reason');
                        reasontext.setAttribute('required', 'required');
                    } else {
                        textareaContainer.style.display = 'none';
                        reasontext.removeAttribute('name');
                        reasontext.removeAttribute('required');
                    }
                });
            });
        }

    </script>
@endsection

