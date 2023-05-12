//author: Ong Wi Lin

$(document).ready(function () {

    $(`#admin-set-password-form`).submit(function (admin) {
        admin.preventDefault();
        if ($(`#admin-set-password-form`)[0].checkValidity()) {
            var admin = preparePostData();
//            console.log(admin);
            post(
                '/TARUMT_Event_Ticketing/Controller/CtrlAdmin/AdminResetPassword.php',
                [
                    submitData('admin', admin),
                ],
                null,
                function () {
                    location.href = "../../BackOffice/Admin/AdminLogin.php";
//                    location.href = "../../BackOffice/Dashboard/BackOfficeDashboard.php";
                }
            );
        }
    });
});

function preparePostData() {
    
    var admin = JSON.stringify({
        mail: $('#mail').val(),
        password:$('#password-input').val()
    });

    console.log(admin);


    return admin;
}
