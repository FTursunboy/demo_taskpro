$(document).ready(function () {
    const status = $('#status_id');
    const user = $('#user_id');
    const client = $('#client_id');
    const project = $('#project_id');


    status.change(function () {
        ajaxResult('monitoring-tasks-status',status, user, client, project)
    });

    user.change(function () {

    });


    client.change(function () {

    });


    project.change(function () {

    });


    function ajaxResult(url,status_id, user_id, project_id, client_id) {
        $.get(`/${url}/${status_id.val()}/${user_id.val()}/${client_id.val()}/${project.val()}/`)
            .then((res) => {
                console.log(res)
            });
    }


});
