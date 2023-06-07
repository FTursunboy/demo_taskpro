@extends('admin.layouts.app')

@section('title')
    Мониторинг
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Мониторинг</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Мониторинг</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @include('inc.messages')
        <div class="container mt-2">

            <div class="row d-flex justify-content-center">
                <div class="col-sm-10 col-md-2 col-lg-2">

                        <a href="{{ route('exel') }}" download class="btn btn-success"> Excel</a>

                </div>
                <div class="col-sm-10 col-md-2 col-lg-2">
                    @include('admin.monitoring.statuses')
                </div>
                {{--                <div class="col-sm-10 col-md-2 col-lg-2">--}}
                {{--                    @include('admin.monitoring.unstatuses')--}}
                {{--                </div>--}}
                <div class="col-sm-10 col-md-2 col-lg-2">
                    @include('admin.monitoring.users')
                </div>

                <div class="col-sm-10 col-md-2 col-lg-2">
                    @include('admin.monitoring.projects')

                </div>
                <div class="col-sm-12 col-md-3 col-lg-3">
                    @include('admin.monitoring.clients')
                </div>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-12">
                <div id="tasks">
                    @include('admin.monitoring.tasks')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
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
