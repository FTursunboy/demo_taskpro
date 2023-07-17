
$('#to_1, #from_1, #user_id_1, #type_id_1').change(function () {
    let user_id_1 = $('#user_id_1').val();
    let from_1 = $('#from_1').val();
    let to_1 = $('#to_1').val();
    let time_1 = $('#time_1').val();

    $.get(`/tasks/public/control/${user_id_1}/${from_1}/${to_1}/${time_1}/`, function(response) {
        console.log(response);
        let kpi_1 = $('#id_type').children('option:selected')
        console.log(kpi_1)
        if (response.is_valid === false && kpi.text().toLowerCase() !== 'разовые' ) {
            $('#time_1').addClass('border-danger');
            $('#info_danger_1').text("У сотрудника " + response.user + " " + response.allowed + " свободных часов");
            $('#button_1').attr('type', 'button');
        } else {
            $('#button').attr('type', 'submit');
            $('#time_1').removeClass('border-danger');
            $('#info_danger').text(''); // Очищаем текст элемента
        }

    });
});

$('#time').on('input', function () {
    let user_id_1 = $('#user_id_1').val();
    let from_1 = $('#from_1').val();
    let to_1 = $('#to_1').val();
    let time_1 = $('#time_1').val();

    let kpi_1 = $('#id_type').children('option:selected')
    $.get(`/tasks/public/control/${user_id_1}/${from_1}/${to_1}/${time_1}/`, function(response) {
        console.log(response);
        if (response.is_valid === false && kpi_1.text().toLowerCase() !== 'разовые') {
            $('#time_1').addClass('border-danger');
            $('#info_danger_1').text("У сотрудника " + response.user + " " + response.allowed + " свободных часов");
            $('#button_1').attr('type', 'button');
        } else {
            $('#button_1').attr('type', 'submit');
            $('#time_1').removeClass('border-danger');
            $('#info_danger_1').text(''); // Очищаем текст элемента
        }

    });
});

