<!DOCTYPE html>
<?php
require '../../Layout.php';
?>
<!-- author: Vinnie Chin Loh Xin -->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <div class="container p-5">
            <div class="row d-flex justify-content-center h-100 mt-5">
                <div class="col-3 card h-100 ">
                    <!-- Tab side navs -->
                    <div class="nav flex-column nav-tabs rounded" id="nav-tabs" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active ripple rounded-top" id="acc-overview-nav-tab" data-mdb-ripple-color="info" data-mdb-toggle="tab" role="tab" aria-controls="acc-overview" aria-selected="false"
                           href="#acc-overview"><i class="fas fa-user pe-3"></i>Profile Overview</a>

                        <a class="nav-link ripple" id="acc-edit-nav-tab" data-mdb-ripple-color="info" data-mdb-toggle="tab" role="tab" aria-controls="acc-edit" aria-selected="false"
                           href="#acc-edit"><i class="fas fa-user-edit pe-3"></i>Edit Account</a>

                        <a class="nav-link ripple" id="acc-changepass-nav-tab" data-mdb-ripple-color="info" data-mdb-toggle="tab" role="tab" aria-controls="acc-changepass" aria-selected="false"
                           href="#acc-changepass"><i class="fas fa-user-lock pe-3"></i>Change Password</a>

                        <a class="nav-link ripple" id="acc-delete-nav-tab" data-mdb-ripple-color="info" data-mdb-toggle="tab" role="tab" aria-controls="acc-delete" aria-selected="false"
                           href="#acc-delete"><i class="fas fa-user-times pe-3"></i>Delete Account</a>


                    </div>
                </div>


                <div class="col col-lg-9 "> 
                    <div class="card shadow profile-upper bg-dark text-white rounded-0 rounded-top">
                        <!--append profile upper-->
                    </div>

                    <!-- ------------------------------top ------------------------------ -->

                    <div class="card shadow text-black tab-content rounded-0 rounded-bottom">

                        <!--profile info tab pane-->

                        <!-- ------------------------------ Customer Edit ------------------------------ -->
                        <div class="tab-pane fade bg-light px-4 py-3 my-3" id="acc-edit" role="tabpanel" aria-labelledby="acc-edit-nav-tab">
                            <h3 class="lead">Edit Account</h3><hr class="mt-0 mb-3" />
                            <form class="row g-3 needs-validation mt-3" id="edit-acc-form" novalidate>
                                <!----- Name ----->
                                <!--                                <div class="col-md-6">
                                                                    <div class="form-outline">
                                                                        <input type="text" class="form-control" id="custEditUsername" required />
                                                                        <label for="custEditUsername" class="form-label">Username</label>
                                                                    </div>
                                                                </div>-->
                                <div class="col-md-12">
                                    <div class="form-outline">
                                        <input type="text" class="form-control" id="custEditName" required />
                                        <label for="custEditName" class="form-label">Full Name</label>
                                    </div>
                                </div>


                                <!----- Register-Email ----->
                                <div class="col-md-12">
                                    <div class="form-outline">
                                        <input type="email" class="form-control" id="custEditMail" value="${customer[0].mail}" required />
                                        <label class="form-label" for="custEditMail">Email</label>
                                    </div>
                                </div>

                                <!----- Phone ----->
                                <div class="col-md-12">
                                    <div class="form-outline">
                                        <input type="tel" id="custEditPhone" class="form-control" value="${customer[0].phone}" required/>
                                        <label class="form-label" for="custEditPhone">Phone</label>
                                    </div>
                                </div>

                                <!----- Save-Edit-Button ----->
                                <div class="d-flex justify-content-center mt-5">
                                    <button type="submit" class="btn btn-secondary btn-block w-25">Save Changes</button>
                                </div>
                            </form>
                        </div>


                        <!-- ----------------------------- Acc Change Password ----------------------------- -->

                        <div class="tab-pane fade bg-light p-3 mt-3 " id="acc-changepass" role="tabpanel" aria-labelledby="acc-changepass-nav-tab">

                            <h3 class="lead">Change Password</h3><hr class="mt-0" />
                            <form id="old-pwd-form" >
                                <div class="form-outline my-3">
                                    <input type="password" id="old-pwd" class="form-control " data-mdb-showcounter="true" maxlength="30" />
                                    <label class="form-label" for="old-pwd">Enter current password to continue</label>
                                    <div class="form-helper"></div>
                                </div>

                                <div class="d-flex justify-content-end align-items-center mt-5">
                                    <button type="button" id="custChangePwdBtn" class="btn btn-primary invisible" data-mdb-toggle="modal" data-mdb-target="#changePass-modal"></button>
                                    <button type="submit" class="btn btn-primary">Continue</button>
                                </div>
                            </form>

                        </div>
                        <!-- ----------------------------- Delete Account ----------------------------- -->

                        <div class="tab-pane fade bg-light p-3 mt-3 " id="acc-delete" role="tabpanel" aria-labelledby="acc-delete-nav-tab">

                            <h3 class="lead">Delete Account</h3><hr class="mt-0" />
                            <p>Once you have confirm delete this account it will be permanently and you won't be able to login with account anymore.</p> 

                            <form id="deactivate-acc-pwd-form">
                                <div class="form-outline my-3">
                                    <input type="password" id="deactivate-acc-pwd" class="form-control " data-mdb-showcounter="true" maxlength="30" />
                                    <label class="form-label" for="deactivate-acc-pwd">Enter your password to confirm</label>
                                    <div class="form-helper"></div>
                                </div>

                                <div class="d-flex justify-content-end align-items-center mt-4">
                                    <button type="button" id="custDeactivateBtn" class="btn btn-primary invisible" data-mdb-toggle="modal" data-mdb-target="#deAcc-modal"></button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                </div>
                            </form>

                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--modal-->
    
   
    <!-- -------------------------------------------------- Change Password Modal -------------------------------------------------- -->
    <div class="modal fade" id="changePass-modal" tabindex="-1" aria-labelledby="changePassModalLabel" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="changePassModalLabel">Change new Password</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="new-pwd-form">
                        <div class="form-outline mt-3">
                            <input type="password" id="new-pwd" class="form-control border-bottom" />
                            <label class="form-label" for="new-pwd">New Password</label>
                            <div class="form-helper"></div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Change</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- -------------------------------------------------- Delete Account Modal -------------------------------------------------- -->
    <div class="modal fade" id="deAcc-modal" tabindex="-1" aria-labelledby="deAccModalLabel" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="deAccModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Are you sure you want to delete your account?</div>
                <div class="modal-body fw-bold"><i class="fas fa-exclamation-triangle"></i> Note: This action can't be undone.</div>
                <div class="modal-footer">
                    <form id="deactivate-acc-form">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------------------------------------------- Log Out Modal -------------------------------------------------- -->

    <div class="modal fade" id="logOut-modal" tabindex="-1" aria-labelledby="logOutModalLabel" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="logOutModalLabel">Sure to Log Out?</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--<div class="modal-body">Sure to Log Out?</div>-->
                <div class="modal-footer">
                    <form id="custConfirmLogOut">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php
    require '../../Footer.php';
    ?>

    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/TARUMT_Event_Ticketing/Web/Script/FrontOffice/User/UserRead.js" type="text/javascript"></script>
    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/TARUMT_Event_Ticketing/Web/Script/FrontOffice/User/UserUpdate.js" type="text/javascript"></script>

</body>
</html>
