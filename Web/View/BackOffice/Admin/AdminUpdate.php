<section style="background-color: #eee;">
<?php
require '../../Layout.php';
?>
    <div class="container-xl px-4 mt-4">

    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header" style="background-color: rgba(33, 40, 50, 0.03)">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button">Upload new image</button>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header" style="background-color: rgba(33, 40, 50, 0.03)">Account Details</div>
                <div class="card-body">
                    <form id="form-edit-admin" class="needs-validation" novalidate method="POST">
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="name">Full name</label>
                                <input class="form-control" id="name" type="text" placeholder="Enter your full name" value="Valerie" required >
                                <div class="invalid-feedback">Required</div>

                            </div>
                            <!-- Form Group (username)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="username">Username</label>
                                <input class="form-control" id="username" type="text" placeholder="Enter your username" value="Luna"  required >
                                <div class="invalid-feedback">Required</div>
                            </div>
                        </div>
                       
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="mail">Email address</label>
                            <input class="form-control" id="mail" type="email" placeholder="Enter your email address" value="name@example.com"  required >
                            <div class="invalid-feedback">Required</div>

                        </div>
                        <!-- Form Group (phone)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="phone">Phone</label>
                            <input class="form-control" id="phone" type="tel" placeholder="Enter your phone" value="0123456789"  required >
                            <div class="invalid-feedback">Required</div>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="role">Role</label>
                                <select name="role" class="form-control" id="roleDdl">
<!--                                    <option value="Staff">Staff</option>
                                    <option value="Admin">Admin</option>-->
                                  </select>
                            </div>
                            <!-- Form Group (status)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="status">Status</label>
                                <!--<input class="form-control" id="status" type="text" name="status" placeholder="Enter your status" value="Activate">-->
                                <select name="status" class="form-control"  id="statusDdl" >
<!--                                    <option value="Activate">Activate</option>
                                    <option value="Deactivate">Deactivate</option>-->
                                  </select>
                            </div>
                        </div>
                        <!-- Save changes button-->
<!--                        <button class="btn btn-primary" type="button">Save changes</button>-->
                        <button type="submit" class="btn btn-primary" title="Save">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
</section>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Admin/AdminUpdate.js" type="text/javascript"></script>
<script src="../../../Script/BackOffice/Admin/AdminRead.js" type="text/javascript"></script>
