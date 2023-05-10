$(document).ready(function () {
    let status = $('#status_id');
    let user = $('#user_id');
    let client = $('#client_id');
    let project = $('#project_id');

    status.change(function () {
        ajaxResult('monitoring-tasks-filter', status, user, client, project)
    });

    user.change(function () {
        ajaxResult('monitoring-tasks-filter', status, user, client, project)
    });


    client.change(function () {
        ajaxResult('monitoring-tasks-filter', status, user, client, project)
    });


    project.change(function () {
        ajaxResult('monitoring-tasks-filter', status, user, client, project)
    });

    function ajaxResult(url, status_id, user_id, client_id, project_id) {
        $.get(`/${url}/${status_id.val()}/${user_id.val()}/${client_id.val()}/${project_id.val()}/`)
            .then((res) => {
                console.log(res)
            });
    }

});
