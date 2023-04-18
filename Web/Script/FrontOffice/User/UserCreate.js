    //author: Vinnie Chin Loh Xin

$(document).ready(function () {
    
    $('#sign-up-form').submit(function (event) {
        event.preventDefault()
        var user = stringifyData();
        console.log(user);
        post(
            '/TARUMT_Event_Ticketing/Controller/CtrlUser/Create.php',
            [
                submitData('user', user)
            ],
            null,
            function () {
               
                location.href = `../Event/EventSummary.php`;
            }
        );
    });
});



function stringifyData() {
    return JSON.stringify({
       
        username: $('#username').val(),
        name: $('#name').val(),
        mail: $('#mail').val(),
        phone: $('#phone').val(),
        password: $('#password').val()
    });
}

