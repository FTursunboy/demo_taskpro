$(document).ready(function () {
    // let unstatus = $('#unstatus_id');
    let status = $('#status_id');
    let user = $('#user_id');
    let client = $('#client_id');
    let project = $('#project_id');
    let table = $('#tableBodyMonitoring');

    status.change(function () {
        ajaxResult('monitoring-tasks-filter', status, user, client, project)
    });

    user.change(function () {
        ajaxResult('monitoring-tasks-filter', status, user, client, project)
    });


    client.change(function () {
        ajaxResult('monitoring-tasks-filter', status, user, client, project)
    });


    // unstatus.change(function () {
    //     ajaxResult('monitoring-tasks-filter', status, unstatus,user, client, project)
    // });

    project.change(function () {
        ajaxResult('monitoring-tasks-filter', status,user, client, project)
    });

    function ajaxResult(url, status_id, user_id, client_id, project_id) {
        table.empty();
        $.get(`tasks/public/${url}/${status_id.val()}/${user_id.val()}/${client_id.val()}/${project_id.val()}/`)
            .then((res) => {
                if (res.status !== false) {
                    for (let i = 0; i < res.length; i++) {
                        let item = res[i];
                        table.append($('<tr>')
                            .append($('<td>').text(formatDate(item.created_at)))
                            .append($('<td>').text(item.name))
                            .append($('<td>').text(item.time))
                            .append($('<td>').text(formatDate(item.from)))
                            .append($('<td>').text(formatDate(item.to)))
                            .append($('<td>').text(item.project.name))
                            .append($('<td>').text(item.author.surname + ' ' + item.author.name))
                            .append($('<td>').text(((item.type === '') ? 'От клиента' : (item.type !== null ? item.type.name : 'От клиента')) + ' ' + ((item.type_type !== null && item.type_type.name !== null) ? ' - ' + item.type_type.name : '')))
                            .append($('<td>').text(item.status.name))
                            .append($('<td>').text((item.user !== null) ? item.user.surname + ' ' + item.user.name  : '') )
                            .append($('<td>')
                                .append($('<a>').attr('href', `/tasks/show-task/${item.id}`).addClass('btn btn-success').append($('<i>').addClass('bi bi-eye')))
                                .append($('<a>').attr('href', `/tasks_client/edit-js/${item.id}`).addClass('btn btn-primary mx-1').append($('<i>').addClass('bi bi-pencil ')))
                            ).addClass('text-center'))
                    }

                }

            });
    }
    // function ajaxResult(url, status_id, unstatus_id, user_id, client_id, project_id) {
    //     table.empty();
    //     $.get(`tasks/public/${url}/${status_id.val()}/${unstatus_id.val()}/${user_id.val()}/${client_id.val()}/${project_id.val()}/`)
    //         .then((res) => {
    //             if (res.status !== false) {
    //                 for (let i = 0; i < res.length; i++) {
    //                     let item = res[i];
    //                     table.append($('<tr>')
    //                         .append($('<td>').text(formatDate(item.created_at)))
    //                         .append($('<td>').text(item.name))
    //                         .append($('<td>').text(item.time))
    //                         .append($('<td>').text(formatDate(item.from)))
    //                         .append($('<td>').text(formatDate(item.to)))
    //                         .append($('<td>').text(item.project.name))
    //                         .append($('<td>').text(item.author.surname + ' ' + item.author.name))
    //                         .append($('<td>').text(((item.type === '') ? 'От клиента' : (item.type !== null ? item.type.name : 'От клиента')) + ' ' + ((item.type_type !== null && item.type_type.name !== null) ? ' - ' + item.type_type.name : '')))
    //                         .append($('<td>').text(item.status.name))
    //                         .append($('<td>').text(item.unstatus.name)) // Добавьте эту строку для отображения названия unstatus
    //                         .append($('<td>')
    //                             .append($('<a>').attr('href', `/tasks/show-task/${item.id}`).addClass('btn btn-success').append($('<i>').addClass('bi bi-eye')))
    //                             .append($('<a>').attr('href', `/tasks_client/edit-js/${item.id}`).addClass('btn btn-primary mx-1').append($('<i>').addClass('bi bi-pencil ')))
    //                         ).addClass('text-center'))
    //                 }
    //             }
    //         });
    // }


    function formatDate(param) {
        const date = new Date(param);
        return `${date.getDate()}-${date.getMonth() + 1}-${date.getFullYear()}`;
    }

});
