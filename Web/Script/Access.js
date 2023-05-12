//author: Vinnie Chin Loh Xin
$(document).ready(function () {

    get('/TARUMT_Event_Ticketing/Controller/CtrlUser/Read.php',
            [
                submitData('data', JSON.stringify({
                    action: "checkLogin"
                }))
            ],
            function (success) {
                if (success) {
                    $('.profile-dropdown').removeClass('invisible');
                    $('.sign-in-link').addClass('invisible');
                } else {
                    $('.profile-dropdown').addClass('invisible');
                    $('.sign-in-link').removeClass('invisible');
                }
            }
    );
});

function needLogin() {
    return new Promise(function (resolve, reject) {
        var data = JSON.stringify({
            action: "needLogin"
        });

        get('/TARUMT_Event_Ticketing/Controller/CtrlUser/Read.php', [
            submitData('data', data)
        ],
                function () {
                    resolve(true);
                },
                null,
                function () {
                    location.href = `/TARUMT_Event_Ticketing/Web/View/FrontOffice/User/SignIn.php`;
                    reject(false);
                }
        );

    });
}


//
//function needLogin() {
//
//// for page that need login
//    var data = JSON.stringify({
//        action: "needLogin"
//    });
//
//    get('/TARUMT_Event_Ticketing/Controller/CtrlUser/Read.php',
//            [
//                submitData('data', data)
//            ],
//            function(){
//               resolve(true);
//            },
//            null,
//            function () {
//                location.href = `/TARUMT_Event_Ticketing/Web/View/FrontOffice/User/SignIn.php`;
//            }
//    );
//}

function signOut() {

    var data = JSON.stringify({
        action: "signOut"
    });

    get('/TARUMT_Event_Ticketing/Controller/CtrlUser/Read.php',
            [
                submitData('data', data)
            ],
            null, null, null,
            function () {
                location.href = '/TARUMT_Event_Ticketing/Web/View/FrontOffice/Event/EventSummary.php';
            }
    );
    
}
