//author: Ong Wi Lin

$(document).ready(function () {

    $(`#admin-login-form`).submit(function (admin) {
        admin.preventDefault();
        if ($(`#admin-login-form`)[0].checkValidity()) {
            var admin = preparePostData();
            console.log(admin);
            post(
                '/TARUMT_Event_Ticketing/Controller/CtrlAdmin/AdminLogin.php',
                [
                    submitData('admin', admin),
                ],
                null,
                function () {
                    location.href = "../../BackOffice/Dashboard/BackOfficeDashboard.php";
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
