<?php
require '../../Layout.php';
?>
<!-- author: Ong Yi Chween -->
<div class="p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">Update Category</h2>
        </div>
    </div>
    <form id="form-edit-category" class="needs-validation" novalidate  method="POST">
        <!--Category information -->
        <div class="row mb-4">
            <fieldset class="mb-3 border p-3">
                <legend class="w-auto">Category Information</legend>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="txt-name">Category Name*</label>
                                <input type="text" name="CategoryName" id="txt-name" class="form-control" required />
                                <div class="invalid-feedback">Required</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="txt-description">Description*</label>
                                <textarea type="text" id="txt-description" name="Description" maxlength="255" class="form-control" rows="3" required></textarea>
                                <div class="invalid-feedback">Required</div>
                            </div>
                        </div>
                    </div>
            </fieldset>
        </div>
        <!-- Action -->
        <div class="col d-flex justify-content-end mb-4">
            <a class="btn btn-secondary btn-floating float-end" title="Back" href="CategorySummary.php" role="button">
                <i class="fas fa-arrow-left"></i>
            </a>
            <button type="submit" id="btn-add-category" class="btn btn-primary btn-floating ms-4" title="Save">
                <i class="fas fa-floppy-disk"></i>
            </button>
        </div>
    </form>

</div>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Category/CategoryUpdate.js"></script>