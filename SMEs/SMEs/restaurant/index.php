<?php
include('components/header.php');
?>
<div class="container card p-3 mb-2 mt-2" style="max-width: 600px;">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active disabled" href="#"><?= $resto['USERNAME'] ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" id="btnEditDetails">Edit</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../../../process/logout.php">Log Out</a>
        </li>
    </ul>
    <div class="d-flex flex-wrap justify-content-between mt-3">
        <div>
            <label style="font-size: 12px;">Resto Name</label>
            <h6><?= $resto['RESTO_NAME'] ?></h6>
        </div>
        <div>
            <label style="font-size: 12px;">Account Status</label>
            <?= ($resto['STATUS'] == 1) ? '<h6 class="text-success">Active</h6>' : '<h6 class="text-warning">Pending</h6>' ?>
        </div>
    </div>
    <hr>
    <div>
        <label style="font-size: 12px;">Description</label>
        <textarea class="form-control" readonly><?= ($resto['DESCRIPTION'] == '') ? 'No description provided' : $resto['DESCRIPTION'] ?></textarea>
    </div>
    <hr>
    <div>
        <label style="font-size: 12px;">Address</label>
        <input type="text" class="form-control" readonly value="<?= ($resto['ADDRESS'] == '') ? 'No address provided' : $resto['ADDRESS'] ?>">
    </div>
    <hr>
    <div>
        <label style="font-size: 12px;">Map</label>
        <div class="mt-4 container d-flex justify-content-center p-0" id="mapContainer" style="overflow-y: hidden;">
            <?= ($resto['MAP'] == '') ? '<div class="d-flex flex-column align-items-center"><h6>No Map Provided</h6></div>' : $resto['MAP'] ?>
        </div>
    </div>
    <hr>
    <div>
        <div>
            <label style="font-size: 12px;">Email</label>
            <p><i class="bi bi-envelope"></i> <?= ($resto['EMAIL'] == '') ? 'No email provided' : $resto['EMAIL'] ?></p>
        </div>
        <div>
            <label style="font-size: 12px;">Contact no.</label>
            <p><i class="bi bi-telephone"></i> <?= ($resto['CONTACT_NO'] == '') ? 'No number provided' : $resto['CONTACT_NO'] ?></p>
        </div>
        <div>
            <label style="font-size: 12px;">Facebook Link</label>
            <p><i class="bi bi-facebook"></i> <?= ($resto['FACEBOOK_LINK'] == '') ? 'No link provided' : '<a href="' . $resto['FACEBOOK_LINK'] . '" target="_blank" class="text-dark" style="text-decoration: none;">' . $resto['FACEBOOK_LINK'] . '</a>' ?></p>
        </div>
        <div>
            <label style="font-size: 12px;">Instagram Link</label>
            <p><i class="bi bi-instagram"></i> <?= ($resto['INSTAGRAM_LINK'] == '') ? 'No link provided' : '<a href="' . $resto['INSTAGRAM_LINK'] . '" target="_blank" class="text-dark" style="text-decoration: none;">' . $resto['INSTAGRAM_LINK'] . '</a>' ?></p>
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
            $getImages = $db->getSMEsImages($resto['RESTO_ID']);
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
                    <input type="hidden" value="EditRestoDetails" name="SubmitType">
                    <input type="hidden" value="<?= $resto['RESTO_ID'] ?>" name="restoId" id="restoId">
                    <div class="input-container">
                        <label for="restoName">Resto Name</label>
                        <input type="text" class="form-control" name="restoName" id="restoName" value="<?= $resto['RESTO_NAME'] ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="restoDescription">Description</label>
                        <textarea class="form-control" name="restoDescription" id="restoDescription" required><?= $resto['DESCRIPTION'] ?></textarea>
                    </div>
                    <div class="input-container">
                        <label for="restoAddress">Address</label>
                        <input type="text" class="form-control" name="restoAddress" id="restoAddress" value="<?= $resto['ADDRESS'] ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="restoMap">Map</label>
                        <textarea class="form-control" name="restoMap" id="restoMap" required><?= $resto['MAP'] ?></textarea>
                    </div>
                    <div class="input-container">
                        <label for="restoEmail">Email</label>
                        <input type="text" class="form-control" name="restoEmail" id="restoEmail" value="<?= $resto['EMAIL'] ?>">
                    </div>
                    <div class="input-container">
                        <label for="restoContactNo">Contact no.</label>
                        <input type="text" class="form-control" name="restoContactNo" id="restoContactNo" value="<?= $resto['CONTACT_NO'] ?>">
                    </div>
                    <div class="input-container">
                        <label for="restoFB">Facebook Link</label>
                        <input type="text" class="form-control" name="restoFB" id="restoFB" value="<?= $resto['FACEBOOK_LINK'] ?>">
                    </div>
                    <div class="input-container">
                        <label for="restoIG">Instagram Link</label>
                        <input type="text" class="form-control" name="restoIG" id="restoIG" value="<?= $resto['INSTAGRAM_LINK'] ?>">
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
                    <input type="hidden" value="SMEsUploadNewImage" name="SubmitType">
                    <input type="hidden" value="<?= $resto['RESTO_ID'] ?>" name="ID" id="restoId">
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
