/* 
 * author : ONG WI LIN
 */

$(document).ready(function () {
    $(`#form-add-admin`).submit(function (admin) {
        admin.preventDefault();
        if ($(`#form-add-admin`)[0].checkValidity()) {
            var admin = preparePostData();
//            console.log(admin);
            post(
                '/TARUMT_Event_Ticketing/Controller/CtrlAdmin/Create.php',
                [
                    submitData('admin', admin)
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
    var admin = {
        name: $('#txt-name').val(),
        role: $(`#drop-down-role`).val(),
        phone: $('#txt-phone').val(),
        mail: $('#txt-mail').val()
    };
    return JSON.stringify(admin);
}




