
$('#to, #from, #user_id, #type_id').change(function () {
    let user_id = $('#user_id').val();
    let from = $('#from').val();
    let to = $('#to').val();
    let time = $('#time').val();

    $.get(`/tasks/public/control/${user_id}/${from}/${to}/${time}/`, function(response) {
        console.log(response);
        let kpi = $('#type_id').children('option:selected')
        console.log(kpi)
        if (response.is_valid === false && kpi.text().toLowerCase() !== 'разовые' ) {
            $('#time').addClass('border-danger');
            $('#info_danger').text("У сотрудника " + response.user + " " + response.allowed + " свободных часов");
            $('#button').attr('type', 'button');
        } else {
            $('#button').attr('type', 'submit');
            $('#time').removeClass('border-danger');
            $('#info_danger').text(''); // Очищаем текст элемента
        }

    });
});

$('#time').on('input', function () {
    let user_id = $('#user_id').val();
    let from = $('#from').val();
    let to = $('#to').val();
    let time = $('#time').val();
    let kpi = $('#type_id').children('option:selected')
    $.get(`/tasks/public/control/${user_id}/${from}/${to}/${time}`, function(response) {
        console.log(response);
        if (response.is_valid === false && kpi.text().toLowerCase() !== 'разовые') {
            $('#time').addClass('border-danger');
            $('#info_danger').text("У сотрудника " + response.user + " " + response.allowed + " свободных часов");
            $('#button').attr('type', 'button');
        } else {
            $('#button').attr('type', 'submit');
            $('#time').removeClass('border-danger');
            $('#info_danger').text(''); // Очищаем текст элемента
        }

    });
});

