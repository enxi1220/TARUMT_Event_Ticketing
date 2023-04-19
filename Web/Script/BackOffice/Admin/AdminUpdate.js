//author: Lim En Xi

$(document).ready(function () {

    $(`#form-edit-admin`).submit(function (admin) {
        admin.preventDefault();
        if ($(`#form-edit-admin`)[0].checkValidity()) {
            var admin = preparePostData();
            console.log(admin);
            post(
                '/TARUMT_Event_Ticketing/Controller/CtrlAdmin/AdminUpdate.php',
                [
                    submitData('admin', admin),
//                    submitData('poster', $('#txt-poster')[0].files[0]),
                ],
                null,
                function () {
                    location.href = "AdminSummary.php";
                }
            );
        }
    });
});

function preparePostData() {
    var admin = JSON.stringify({
        admin_id: new URLSearchParams(window.location.search).get('admin_id'),
        name: $('#name').val(),
        username: $('#username').val(),
        role: $(`#roleDdl`).val(),
        status: $(`#statusDdl`).val(),
        phone: $('#phone').val(),
        mail: $('#mail').val()
        
    });

    return admin;
}
