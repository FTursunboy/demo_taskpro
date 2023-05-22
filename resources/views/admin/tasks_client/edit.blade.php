@extends('admin.layouts.app')

@section('title')
    Изменение задачи
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Изменение задач</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('tasks_client.index') }}">Список задач</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Изменение задач</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('inc.messages')

        <div class="card">
            <div class="card-header">
                <a href="{{ route('tasks_client.index') }}" class="btn btn-outline-danger">
                    Назад
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('tasks_client.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-4">


                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" id="name" name="name" class="form-control mt-3"
                                       placeholder="Имя" value="{{ old('name', $task->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="from">Дата начала задачи</label>
                                <input type="date" id="from" name="from" class="form-control mt-3"
                                       value="{{ old('from', $task->from) }}" required>
                            </div>
                        </div>

                        <div class="col-4">

                            <div class="form-group">
                                <label for="client_id">Клиент</label>
                                <select id="client_id" name="client_id" class="form-select mt-3" required>
                                    <option value="" selected>Выберите клиента </option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="to">Дата окончания задачи</label>
                                <input type="date" id="to" name="to" class="form-control mt-3" value="{{ old('to', $task->to) }}"
                                       required>
                            </div>
                        </div>


                        <div class="col-4">


                            <div class="form-group d-none" id="type_id_group">
                                <label for="kpi_id">Вид KPI</label>
                                <select name="kpi_id" id="kpi_id" class="form-select mt-3"></select>
                            </div>

                            <div class="form-group">
                                <label for="comment">Комментария</label>
                                <textarea name="description" id="comment"
                                          class="form-control mt-3">{{ old('description', $task->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                                <div class="form-group">
                                <label for="file">Файл</label>
                                <input type="file" name="file" class="form-control mt-3" id="file">
                            </div>
                        </div>
                        <div class="col-6"></div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" id="button" class="btn btn-outline-primary">Обновить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $('#from').change(function () {
            const to = $('#to')
            if ($(this).val() > to.val()) {
                $(this).addClass('border-danger')
                to.addClass('border-danger')
                $('#button').attr('type', 'button');
            } else {
                $(this).removeClass('border-danger')
                to.removeClass('border-danger')
                $('#button').attr('type', 'submit');
            }
        })
        $('#to').change(function () {
            const from = $('#from')
            if ($(this).val() < from.val()) {
                $(this).addClass('border-danger')
                from.addClass('border-danger')
                $('#button').attr('type', 'button');
            } else {
                $(this).removeClass('border-danger')
                from.removeClass('border-danger')
                $('#button').attr('type', 'submit');
            }
        })

        $('#type_id').change(function () {
            let kpi = $(this).children('option:selected')
            if (kpi.text().toLowerCase() === 'kpi') {
                let kpiType = $('#kpi_id').empty();
                $.get(`tasks/kpi/${kpi.val()}/`).then((res) => {
                    for (let i = 0; i < res.length; i++) {
                        const item = res[i]
                        console.log(item.name)
                        kpiType.append($('<option>').val(item.id).text(item.name))
                    }
                })
                $('#type_id_group').removeClass('d-none')
            } else {
                $('#type_id_group').addClass('d-none')
            }
        })
    </script>
@endsection
