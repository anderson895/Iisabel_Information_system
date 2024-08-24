<?php
include('components/header.php');
?>
<div class="container card p-3 mb-2 mt-2" style="max-width: 600px;">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active disabled" href="#"><?= $accom['USERNAME'] ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" id="btnEditDetails" data-id="<?= $accom['ACCOM_ID'] ?>" data-name="<?= $accom['ACCOM_NAME'] ?>" data-address="<?= $accom['ADDRESS'] ?>" data-description="<?= $accom['DESCRIPTION'] ?>" data-email="<?= $accom['EMAIL'] ?>" data-contactno="<?= $accom['CONTACT_NO'] ?>" data-fb="<?= $accom['FACEBOOK_LINK'] ?>" data-ig="<?= $accom['INSTAGRAM_LINK'] ?>">Edit</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../../../process/logout.php">Log Out</a>
        </li>
    </ul>
    <div class="d-flex flex-wrap justify-content-between mt-3">
        <div>
            <label style="font-size: 12px;">Accommodation Name</label>
            <h6><?= $accom['ACCOM_NAME'] ?></h6>
        </div>
        <div>
            <label style="font-size: 12px;">Account Status</label>
            <?= ($accom['STATUS'] == 1) ? '<h6 class="text-success">Active</h6>' : '<h6 class="text-warning">Pending</h6>' ?>
        </div>
    </div>
    <hr>
    <div>
        <label style="font-size: 12px;">Description</label>
        <textarea class="form-control" readonly><?= ($accom['DESCRIPTION'] == '') ? 'No description provided' : $accom['DESCRIPTION'] ?></textarea>
    </div>
    <hr>
    <div>
        <label style="font-size: 12px;">Address</label>
        <input type="text" class="form-control" readonly value="<?= ($accom['ADDRESS'] == '') ? 'No address provided' : $accom['ADDRESS'] ?>">
    </div>
    <hr>
    <div>
        <label style="font-size: 12px;">Map</label>
        <div class="mt-4 container d-flex justify-content-center p-0" id="mapContainer" style="overflow-y: hidden;">
            <?= ($accom['MAP'] == '') ? '<div class="d-flex flex-column align-items-center"><h6>No Map Yet</h6></div>' : $accom['MAP'] ?>
        </div>
    </div>
    <hr>
    <div>
        <div>
            <label style="font-size: 12px;">Email</label>
            <p><i class="bi bi-envelope"></i> <?= ($accom['EMAIL'] == '') ? 'No email provided' : $accom['EMAIL'] ?></p>
        </div>
        <div>
            <label style="font-size: 12px;">Contact no.</label>
            <p><i class="bi bi-telephone"></i> <?= ($accom['CONTACT_NO'] == '') ? 'No number provided' : $accom['CONTACT_NO'] ?></p>
        </div>
        <div>
            <label style="font-size: 12px;">Facebook Link</label>
            <p><i class="bi bi-facebook"></i> <?= ($accom['FACEBOOK_LINK'] == '') ? 'No link provided' : '<a href="' . $accom['FACEBOOK_LINK'] . '" target="_blank" class="text-dark" style="text-decoration: none;">' . $accom['FACEBOOK_LINK'] . '</a>' ?></p>
        </div>
        <div>
            <label style="font-size: 12px;">Instagram Link</label>
            <p><i class="bi bi-instagram"></i> <?= ($accom['INSTAGRAM_LINK'] == '') ? 'No link provided' : '<a href="' . $accom['INSTAGRAM_LINK'] . '" target="_blank" class="text-dark" style="text-decoration: none;">' . $accom['INSTAGRAM_LINK'] . '</a>' ?></p>
        </div>
    </div>
    <hr>
    <div class="image-main-container">
        <h5>
            <center>Photos</center>
        </h5>
        <button id="addNewImage" class="btn btn-success btn-add-new-img"><i class="bi bi-plus-lg"></i> New Image</button>
        <div class="mt-5">
            <?php
            $getImages = $db->getSMEsImages($accom['ACCOM_ID']);
            if ($getImages->num_rows > 0) {
                while ($img = $getImages->fetch_assoc()) {
            ?>
                    <div class="text-center img-container mt-2">
                        <img src="../../../backend/SMEsImg/<?= $img['FILE_NAME'] ?>">
                        <button class="btn btn-danger btnDeleteImg" data-id="<?= $img['ID'] ?>" data-filename="<?= $img['FILE_NAME'] ?>"><i class="bi bi-trash"></i> Delete</button>
                    </div>
                <?php
                }
            } else {
                ?>
                <center class="text-danger">No image provided</center>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal" tabindex="-1" role="dialog" id="EditDetailsModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil"></i> Edit Details</h5>
            </div>
            <form id="frmEditDetails">
                <div class="modal-body">
                    <input type="hidden" value="EditAccomDetails" name="SubmitType" id="accomId">
                    <input type="hidden" value="<?= $accom['ACCOM_ID'] ?>" name="accomId" id="accomId">
                    <div class="input-container">
                        <label for="accomName">Accommodation Name</label>
                        <input type="text" class="form-control" name="accomName" id="accomName" value="<?= $accom['ACCOM_NAME'] ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="accomDescription">Description</label>
                        <textarea class="form-control" name="accomDescription" id="accomDescription" required><?= $accom['DESCRIPTION'] ?></textarea>
                    </div>
                    <div class="input-container">
                        <label for="accomAddress">Address</label>
                        <input type="text" class="form-control" name="accomAddress" id="accomAddress" value="<?= $accom['ADDRESS'] ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="accomMap">Map</label>
                        <textarea class="form-control" name="accomMap" id="accomMap"><?= $accom['MAP'] ?></textarea>
                    </div>
                    <div class="input-container">
                        <label for="accomEmail">Email</label>
                        <input type="text" class="form-control" name="accomEmail" id="accomEmail" value="<?= $accom['EMAIL'] ?>">
                    </div>
                    <div class="input-container">
                        <label for="accomContactNo">Contact no.</label>
                        <input type="text" class="form-control" name="accomContactNo" id="accomContactNo" value="<?= $accom['CONTACT_NO'] ?>">
                    </div>
                    <div class="input-container">
                        <label for="accomFB">Facebook Link</label>
                        <input type="text" class="form-control" name="accomFB" id="accomFB" value="<?= $accom['FACEBOOK_LINK'] ?>">
                    </div>
                    <div class="input-container">
                        <label for="accomIG">Instagram Link</label>
                        <input type="text" class="form-control" name="accomIG" id="accomIG" value="<?= $accom['INSTAGRAM_LINK'] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Edit Modal -->
<div class="modal" tabindex="-1" role="dialog" id="AddImageModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-cloud-arrow-up"></i> New Image</h5>
            </div>
            <form id="frmUploadImage">
                <div class="modal-body">
                    <input type="hidden" value="SMEsUploadNewImage" name="SubmitType" id="accomId">
                    <input type="hidden" value="<?= $accom['ACCOM_ID'] ?>" name="ID" id="accomId">
                    <div class="">
                        <label for="accomImage" style="margin-left: 5px;">Upload Here:</label>
                        <input type="file" class="form-control mt-1" name="accomImage" id="accomImage" required accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Image Modal -->
<!-- End of Add Image Modal -->

<?php
include('components/footer.php');
