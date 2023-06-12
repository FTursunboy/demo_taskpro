@extends(auth()->user()->hasRole('crm') ? 'user.layouts.app' : 'admin.layouts.app')

@section('title')
    Лиды
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Лиды</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Лиды</li>
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
                            <a href="{{ route('lead.create') }}" class="btn btn-outline-primary">
                                Добавить лид
                            </a>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-select" name="status" id="status">
                                    <option value="0">фильтр по стадию</option>
                                    @foreach($statuses as $status)
                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-select" name="status" id="source">
                                    <option value="0">фильтр по источнику</option>
                                    @foreach($sources as $source)
                                        <option value="{{$source->id}}">{{$source->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-select" name="state" id="state">
                                    <option value="0">фильтр по состоянию</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card-body" style="overflow: auto;">
                    <table id="example" style="width: 100%" class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ФИО</th>
                            <th>Стадие</th>
                            <th>Источник</th>
                            <th>Состояние</th>
                            <th>Создал</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="tbody" >

                        @foreach($leads as $lead)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    @if ($lead->contact?->fio)
                                             {{ Str::limit($lead->contact?->fio, 20) }}
                                    @else
                                        <span style='color: lightcoral;'>Удалённый аккаунт</span>
                                    @endif
                                </td>
                                <td>
                                    @if($lead->status?->id === 5)
                                        <span style='color: lightcoral;'>{{$lead->status?->name}}</span>
                                    @else
                                        {{$lead->status?->name}}
                                    @endif
                                </td>
                                <td>{{ Str::limit($lead->leadSource?->name, 20) }}</td>
                                <td>{{ Str::limit($lead->state?->name, 20) }}</td>
                                <td>{{ Str::limit($lead->author, 20) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('lead.show', $lead->id)   }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('lead.edit', $lead->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                       data-bs-target="#delete{{$lead->id}}"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>


                            <div class="modal fade text-left" id="delete{{$lead->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="delete{{$lead->id}}" data-bs-backdrop="false" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <form action="{{ route('lead.destroy', $lead->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="delete{{$lead->id}}">Предупреждение</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    Точно хотите удалить лид?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Отмена</span>
                                                </button>
                                                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Удалить</span>
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

