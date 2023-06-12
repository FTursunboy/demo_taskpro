@extends(auth()->user()->hasRole('crm') ? 'user.layouts.app' : 'admin.layouts.app')

@section('title')
    События
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>События</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">События</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @include('.inc.messages')
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            @if(isset($lead))
                                <a href="{{route('lead.event.create', $lead->id)}}" class="btn btn-outline-primary">Добавить событие для выбранного лида</a>
                                @else
                            <a href="{{ route('event.create') }}" class="btn btn-outline-primary">
                                Добавить событие
                            </a>
                                @endif
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-select" name="theme" id="theme">
                                    <option value="0">Фильтр по теме</option>
                                    @foreach($themeEvents as $themeEvent)
                                        <option value="{{$themeEvent->id}}">{{$themeEvent->theme}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-select" name="type" id="type">
                                    <option value="0">Фильтр по типу</option>
                                    @foreach($typeEvents as $typeEvent)
                                        <option value="{{$typeEvent->id}}">{{$typeEvent->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-select" name="statuses" id="statuses">
                                    <option value="0">Фильтр по статусу</option>
                                    @foreach($eventStatuses as $eventStatus)
                                        <option value="{{$eventStatus->id}}">{{$eventStatus->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-hover">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Описание</th>
                            <th>Тема</th>
                            <th>Контакт</th>
                            <th>Дата</th>
                            <th>Время</th>
                            <th>Тип</th>
                            <th>Статус</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ Str::limit($event->description, 6)}}</td>
                                <td>{{ Str::limit($event->themeEvent?->theme, 15) }}</td>
                                <td>{{ Str::limit($event->leads?->contact->fio, 15) }}</td>
                                <td>{{ Str::limit(date('d.m.Y', strtotime($event->date)), 15) }}</td>
                                <td>{{ Str::limit(date('H:i', strtotime($event->date)), 15) }}</td>
                                <td>{{ Str::limit($event->typeEvent?->name, 15) }}</td>
                                <td>{{ Str::limit($event->eventStatus?->name, 15) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('event.show', $event->id)   }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('event.edit', $event->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                       data-bs-target="#delete{{$event->id}}"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade text-left" id="delete{{$event->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="delete{{$event->id}}" data-bs-backdrop="false" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <form action="{{ route('event.destroy', $event->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="delete{{$event->id}}">Предупреждение</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    Точно хотите удалить событие?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Нет</span>
                                                </button>
                                                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Да, точно</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>
@endsection
@section('script')
    <script src="{{asset('assets/js/search.js')}}"></script>
    <script src="{{asset('assets/js/datatable.js')}}"></script>
    @routes
    <script>
        $(document).ready(function () {



            var table = $('#example').DataTable({
                initComplete: function () {

                },
            });

            $('#theme, #type, #statuses').on('change', function() {
                filterLeads()
            });

            function filterLeads() {
                let theme = $('#theme').val();
                let type = $('#type').val();
                let statuses = $('#statuses').val();

                $.get(`tasks/public/filter-events/${theme}/${type}/${statuses}`, function(responce) {
                    let table = $('#tbody').empty();
                    buildTable(responce.data, table)
                });



            }


            function buildTable(data, table) {
                $.each(data, function(i, item) {

                    let show = route('event.show', item.id);
                    let edit = route('event.edit', item.id)


                    let date = new Date(item.date);

                    let day = `${date.getDate()}.0${date.getMonth() + 1}.${date.getFullYear()}`;
                    let time = `${date.getHours()}:${date.getMinutes()}`;


                    let row = `<tr>
                  <td>${i + 1}</td>
                  <td>${item.description}</td>
                  <td>${item.theme}</td>
                  <td>${item.fio}</td>
                  <td>${day}</td>
                  <td>${time}</td>
                  <td>${item.type}</td>
                  <td>${item.status}</td>
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
