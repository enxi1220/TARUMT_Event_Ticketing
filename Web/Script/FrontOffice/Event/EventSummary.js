//author: Vinnie Chin Loh Xin

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Summary.php',
        null,
        function (success) {
            // console.log(success);
            var events = JSON.parse(success);
        }
    )
});



