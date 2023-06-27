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


    </div>
@endsection
@section('script')
    <script src="{{asset('assets/js/search.js')}}"></script>
    <script src="{{asset('assets/js/datatable.js')}}"></script>
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
        window.onload = function() {
            var selectElement = document.getElementById("status");
            var optionElements = selectElement.getElementsByTagName("option");

            for (var i = 0; i < optionElements.length; i++) {
                var option = optionElements[i];
                if (option.value === "0" && option.selected) {
                    option.style.color = "red";
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

            $('#month, #status, #state, #source').on('change', function() {
                filterLeads()
            });

            function filterLeads() {
                let month = $('#month').val();
                let status = $('#status').val();
                let state = $('#state').val();
                let source = $('#source').val();

                $.get(`tasks/public/filter-leads/${month}/${status}/${state}/${source}`, function(responce) {
                    let table = $('#tbody').empty();
                    console.log(responce);
                    buildTable(responce.data, table);
                });


            }


            function buildTable(data, table) {
                $.each(data, function(i, item) {

                    let show = route('lead.show', item.id);
                    let edit = route('lead.edit', item.id)


                    let row = `<tr>
                  <td>${i + 1}</td>
                  <td>${(item.contact_name)}</td>
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

