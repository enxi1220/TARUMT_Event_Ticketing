//author: Vinnie Chin Loh Xin

$(document).ready(function () {

    $('#edit-acc-form').submit(function (event) {
        event.preventDefault();
        var user = stringifyUpdateData();
        console.log(user);
        post(
                '/TARUMT_Event_Ticketing/Controller/CtrlUser/Update.php',
                [
                    submitData('user', user)
                ],
                null,
                function () {

                    location.reload();
                }
        );
    });

    $('#old-pwd-form').submit(function (event) {
        event.preventDefault();

        var user = JSON.stringify({
            password: $(`#old-pwd`).val(),
            action: "validPwd"
        });
        console.log(user);
        post(
                '/TARUMT_Event_Ticketing/Controller/CtrlUser/Read.php',
                [
                    submitData('user', user)
                ],
                function () {
                    $('#old-pwd-form')[0].reset();
                    $('#custChangePwdBtn').click();
                },
                null
                );
    });


    $('#new-pwd-form').submit(function (event) {
        event.preventDefault();
        var user = JSON.stringify({

            password: $(`#new-pwd`).val(),
            action: "editPwd"
        });


        console.log(user);
        post(
                '/TARUMT_Event_Ticketing/Controller/CtrlUser/Update.php',
                [
                    submitData('user', user)
                ],
                null,
                function () {
                    $('#changePass-modal').modal('hide');
                }
        );
    });

    $('#resetPwd-mail-form').submit(function (event) {
        event.preventDefault();
        var user = JSON.stringify({

            mail: $(`#resetPwd-mail`).val(),
            action: "existingMail"
        });

        post(
                '/TARUMT_Event_Ticketing/Controller/CtrlUser/Read.php',
                [
                    submitData('user', user)
                ],
                function () {
                    $('#resetPwd-mail-form')[0].reset();
                    $('#otp-modal').modal("show");
                },
                null
                );
    });
    
    $('#reset-pwd-form').submit(function (event) {
        event.preventDefault();
        var user = JSON.stringify({

            password: $(`#reset-pwd`).val(),
            action: "resetPwd"
        });

        post(
                '/TARUMT_Event_Ticketing/Controller/CtrlUser/Update.php',
                [
                    submitData('user', user)
                ],
               null,
                 function () {
                    $('#reset-pwd-form')[0].reset();
                    $('#resetPwd-modal').modal("hide");
                }
                );
    });

    $('#otp-form').submit(function (event) {
        event.preventDefault();

        var otpNum = $('#otpNum').val();
        var action = "checkOTP";

//todo
        if (!otpNum) {
            errorPrompt(append("the OTP received."));

        } else {
            var user = JSON.stringify({
                otpNum: otpNum,
                action: action
            });

            post(
                    '/TARUMT_Event_Ticketing/Controller/CtrlUser/Read.php',
                    [
                        submitData('user', user)
                    ],
                    function () {
                        $('#otp-form')[0].reset();
                        $('#otp-modal').modal("hide");
                        $('#resetPwd-modal').modal("show");
                    },
                    null
                    );

        }

    });

    $('#deactivate-acc-pwd-form').submit(function (event) {
        event.preventDefault();
        var user = JSON.stringify({

            password: $(`#deactivate-acc-pwd`).val(),
            action: "validPwd"
        });
        post(
                '/TARUMT_Event_Ticketing/Controller/CtrlUser/Read.php',
                [
                    submitData('user', user)
                ],
                function () {
                    $('#deactivate-acc-pwd-form')[0].reset();
                    $('#custDeactivateBtn').click();
                },
                null
                );
    });

    $('#deactivate-acc-form').submit(function (event) {
        event.preventDefault();
        var user = JSON.stringify({

            action: "deactivate"
        });
        post(
                '/TARUMT_Event_Ticketing/Controller/CtrlUser/Update.php',
                [
                    submitData('user', user)
                ],
                null,
                function () {
                    $('#deactivate-acc-form').modal('hide');
                    location.href = `../Event/EventSummary.php`;

                }
        );
    });
});

function stringifyUpdateData() {
    return JSON.stringify({

        name: $(`#custEditName`).val(),
        mail: $(`#custEditMail`).val(),
        phone: $(`#custEditPhone`).val(),
        action: "editProfile"
    });
}



