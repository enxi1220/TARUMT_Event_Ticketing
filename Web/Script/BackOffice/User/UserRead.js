//author: Ong Yi Chween

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlUsers/Read.php',
        { userId: new URLSearchParams(window.location.search).get('userId') },
        function (success) {
            var user = JSON.parse(success);
            display(user);
        }
    )
});

function display(user) {
    $(`#txt-username`).val(user.username);
    $('#txt-name').val(user.name);
    $('#txt-phone').val(user.phone);
    $('#txt-mail').val(user.mail);
    $('#txt-status').val(user.status);
}
