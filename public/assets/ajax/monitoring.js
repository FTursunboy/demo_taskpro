$(document).ready(function () {
    let status = $('#status_id');
    let user = $('#user_id');
    let client = $('#client_id');
    let project = $('#project_id');


    status.change(function () {
        ajaxResult('monitoring-tasks-status', status, user, client, project)
    });

    user.change(function () {

    });


    client.change(function () {

    });


    project.change(function () {

    });


    function ajaxResult(url, status_id, user_id, client_id, project_id) {
        $.get(`/${url}/${status_id.val()}/${user_id.val()}/${client_id.val()}/${project_id.val()}/`)
            .then((res) => {
                console.log(res)
            });
    }


});
