@extends('user.layouts.app')
@section('title')
    Моя команда
@endsection

@section('content')

    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Моя команда</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Панель</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Моя команда</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('inc.messages')
        @include('user.my-command.create-task')


        <section class="section">

            @include('user.my-command.my-command-tasks')

        </section>

    </div>

@endsection

@section('script')



    <script>

        $(document).ready(function () {
            let user = $('#user');
            let project = $('#project');
            let table = $('#tableBodyMonitoringCommand');

            user.change(function () {
                ajaxResult('my-command', user, project)
            });
            project.change(function () {
                ajaxResult('my-command', user, project)
            });

            function ajaxResult(url, user_id, project_id) {
                table.empty();
                $.get(`tasks/public/${url}/${user_id.val()}/${project_id.val()}/`)
                    .then((res) => {
                        console.log(res)
                        console.log(`tasks/public/${url}/${user_id.val()}/${project_id.val()}/`)
                        if (res.status !== false) {
                            for (let i = 0; i < res.length; i++) {
                                let item = res[i];
                                table.append($('<tr>')
                                    .append($('<td>').text(item.id))
                                    .append($('<td>').text(item.name))
                                    .append($('<td>').text(item.status.name))
                                    .append($('<td>').text((item.user !== null) ? item.user.surname + ' ' + item.user.name  : ''))
                                    .append($('<td>').text(item.project.name))
                                    .append($('<td>')
                                        // .append($('<a>').attr('href', show).addClass('btn btn-success').append($('<i>').addClass('bi bi-eye')))
                                        // .append($('<a>').attr('href', edit).addClass('btn btn-primary mx-1').append($('<i>').addClass('bi bi-pencil ')))
                                    ).addClass('text-center'))
                            }

                        }

                    });
            }
            function formatDate(param) {
                const date = new Date(param);
                return `${date.getDate()}-${date.getMonth() + 1}-${date.getFullYear()}`;
            }

        });

    </script>



    <script src="{{asset('assets/js/search.js')}}"></script>
    <script src="{{asset('assets/js/datatable.js')}}"></script>

    <script>
        var table = $('#example').DataTable({
            initComplete: function () {

            },
        });
    </script>
    <script>
        const fromInput = document.getElementById('from');
        let prevValue = fromInput.value;

        fromInput.addEventListener('input', function() {
            const dateValue = new Date(this.value);
            const year = dateValue.getFullYear();
            const maxLength = 4;

            if (year.toString().length > maxLength) {
                this.value = prevValue; // Восстанавливаем предыдущее значение
            } else {
                prevValue = this.value; // Сохраняем текущее значение
            }
        });
    </script>
    <script>
        const toInput = document.getElementById('to');
        let prevValue1 = toInput.value;

        toInput.addEventListener('input', function() {
            const dateValue = new Date(this.value);
            const year = dateValue.getFullYear();
            const maxLength = 4;

            if (year.toString().length > maxLength) {
                this.value = prevValue1; // Восстанавливаем предыдущее значение
            } else {
                prevValue1 = this.value; // Сохраняем текущее значение
            }
        });
    </script>



    <script>
        $('#from').change(function () {
            const to = $('#to')
            if ($(this).val() > to.val()) {

                let selectedOption = $('#project_id option:selected');
                let selectedClass = selectedOption.attr('class');

                let selectedDate = new Date(selectedClass);
                let toDate = new Date($(this).val());

                if (toDate > selectedDate) {
                    $('#error-message').show();
                    $(this).addClass('border-danger')

                    let formattedDate = selectedDate.toISOString().split('T')[0];

                    $(this).val(formattedDate)
                }

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

                $('#label').removeClass('d-none');
                let kpi_id = $('<select tabindex="6"  required name="kpi_id" class="form-select mt-3"><option value="">Выберите месяц</option></select>');
                $('#type_id_group').append(kpi_id);

                $('#label1').removeClass('d-none');
                let percent = $('<input tabindex="9"  required type="number" oninput="checkMaxValue(this)" id="percent" step="any" name="percent" class="form-control mt-3">');
                $('#percent').append(percent);



                $.get(`tasks/kpi/${kpi.val()}/`).then((res) => {
                    for (let i = 0; i < res.length; i++) {
                        const item = res[i];
                        console.log(item.name);
                        kpi_id.append($('<option>').val(item.id).text(item.name));
                    }
                });




            } else {
                $('#type_id_group').empty();

                $('#percent').empty();

            }
        })
        function checkMaxValue(input) {
            var maxValue = 150;
            if (input.value > maxValue) {
                input.value = maxValue;

            }
        }

        $('#project_id').change(function() {
            let selectedOption = $('#project_id option:selected');
            let selectedClass = selectedOption.attr('class');


        });
        function formatDate(date) {
            let year = date.getFullYear();
            let month = String(date.getMonth() + 1).padStart(2, '0');
            let day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
        function formatDate1(dateStr) {
            const [day, month, year] = dateStr.split('-');
            const date = new Date(`${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`);


            return `${date.getDate()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getFullYear()}`;
        }

        $('#to').on('input', function() {
            let project_finish = formatDate1($('#project_finish').text());

            let selectedOption = $('#project_id option:selected');
            let selectedClass = selectedOption.attr('class');

            let selectedDate = new Date(selectedClass);
            let toDate = new Date($(this).val());

            if (toDate > selectedDate) {
                $('#error-message').show();
                $(this).addClass('border-danger')


                let formattedDate = selectedDate.toISOString().split('T')[0];

                $(this).val(formattedDate)


            } else {
                $(this).removeClass('border-danger')
                $('#error-message').hide();
                $('#button').attr('type', 'submit');


            }
            let formattedDate = formatDate(toDate);
            console.log(formattedDate);
        });

        $('#project_id').change(function() {

            $('#from').removeAttr('disabled');
            $('#to').removeAttr('disabled');

            let selectedOption = $('#project_id option:selected');
            let selectedClass = selectedOption.attr('class');
            console.log(selectedClass)
            $('#project_finish').text("Дата окончания выбранного проекта " +  selectedClass);

        });

        $('#file').on('change', function () {
            const file = this.files[0]; // выбранный файл
            const fileSizeInBytes = file.size; // размер файла в байтах
            const fileSizeInMegabytes = fileSizeInBytes / (1024 * 100024); // размер файла в мегабайтах
            if (fileSizeInMegabytes > 50) { // проверка на максимальный размер файла в мегабайтах
                alert('Выбранный файл слишком большой. Максимальный размер файла - 50 МБ');
                $(this).val('');
            }
        });


    </script>

@endsection
