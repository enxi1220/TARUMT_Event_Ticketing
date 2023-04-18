//author: Vinnie Chin Loh Xin

$(document).ready(function () {

    $('#sign-in-form').submit(function (event) {
        event.preventDefault();
        var user = stringifySignInData();
        console.log(user);
        post(
                '/TARUMT_Event_Ticketing/Controller/CtrlUser/Read.php',
                [
                    submitData('user', user)
                ],
                null,
                function () {
                    
                    location.href = `../Event/EventSummary.php`;
                }
        );
    });
    
    if(window.location.href.includes("/UserRead.php")){
        needLogin();
        
        get(
            '/TARUMT_Event_Ticketing/Controller/CtrlUser/Read.php',
            null,
            function (success) {
                 displayUser(JSON.parse(success));
            }
    );
        
    }

});


function displayUser(userInfo) {

    var profileUpper = $(`
 
 <div class="row d-flex justify-content-between align-items-end pt-5 px-3">
                            <div class="col-md-6">
                                <h5 id="custUsername">${userInfo.username}</h5>
                                <p><span>Created on </span>: ${new Date(userInfo.createdDate).toLocaleDateString()} </p>
                            </div>

                            <div class="col-md-6 mb-3 d-flex justify-content-end">
                            
                                        <div class="pe-3">
                                            <p class="mb-1 h5">${userInfo.wishListQty}<i class="far fa-heart ms-2"></i></p>
                                            <p class="small mb-0">Wish List </p>
                                        </div>
                                 
                                        <div class="border-start ps-3 border-info">
                                            <p class="mb-1 h5">${userInfo.bookingQty}<i class="fas fa-ticket ms-2"></i></p>
                                            <p class="small mb-0">Orders Placed </p>
                                        </div>
                                   
                            </div>
                        </div>
`);

    $(`.profile-upper`).append(profileUpper);

    var profile = $(`<div class="tab-pane fade show active user-detail-container bg-light p-3 mt-3" role="tabpanel" aria-labelledby="acc-overview-nav-tab" id="acc-overview">
                                <h3 class="lead">Account Overview</h3><hr class="mt-0" />
                                <div class="col">
                                    <p><span>Name </span>: ${userInfo.name}</p>
                                    <p><span>Email </span>: ${userInfo.mail}</p>
                                    <p><span>Contact </span>: ${userInfo.phone}</p>
                                </div>
                            </div>
`);

    $(`.tab-content`).append(profile);

    $(`#custEditUsername`).val(userInfo.username);
    $(`#custEditName`).val(userInfo.name);
    $(`#custEditMail`).val(userInfo.mail);
    $(`#custEditPhone`).val(userInfo.phone);
}



function stringifySignInData() {
    return JSON.stringify({

        mail: $('#signInMail').val(),
        password: $('#signInPwd').val(),
        action:"signIn"
    });
}





