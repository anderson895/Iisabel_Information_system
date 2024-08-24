<?php
include('components/header.php');
?>
<div class="container card p-3 mb-2 mt-2" style="max-width: 600px;">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active disabled" href="#"><?= $seller['USERNAME'] ?></a>
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
            <label style="font-size: 12px;">Store Name</label>
            <h6><?= $seller['STORE_NAME'] ?></h6>
        </div>
        <div>
            <label style="font-size: 12px;">Account Status</label>
            <?= ($seller['STATUS'] == 1) ? '<h6 class="text-success">Active</h6>' : '<h6 class="text-warning">Pending</h6>' ?>
        </div>
    </div>
    <hr>
    <div>
        <label style="font-size: 12px;">Address</label>
        <input type="text" class="form-control" readonly value="<?= ($seller['ADDRESS'] == '') ? 'No address provided' : $seller['ADDRESS'] ?>">
    </div>
    <hr>
    <div>
        <label style="font-size: 12px;">Map</label>
        <div class="mt-4 container d-flex justify-content-center p-0" id="mapContainer" style="overflow-y: hidden;">
            <?= ($seller['MAP'] == '') ? '<div class="d-flex flex-column align-items-center"><h6>No Map Provided</h6></div>' : $seller['MAP'] ?>
        </div>
    </div>
    <hr>
    <div>
        <div>
            <label style="font-size: 12px;">Email</label>
            <p><i class="bi bi-envelope"></i> <?= ($seller['EMAIL'] == '') ? 'No email provided' : $seller['EMAIL'] ?></p>
        </div>
        <div>
            <label style="font-size: 12px;">Contact no.</label>
            <p><i class="bi bi-telephone"></i> <?= ($seller['CONTACT_NO'] == '') ? 'No number provided' : $seller['CONTACT_NO'] ?></p>
        </div>
        <div>
            <label style="font-size: 12px;">Facebook Link</label>
            <p><i class="bi bi-facebook"></i> <?= ($seller['FACEBOOK_LINK'] == '') ? 'No link provided' : '<a href="' . $seller['FACEBOOK_LINK'] . '" target="_blank" class="text-dark" style="text-decoration: none;">' . $seller['FACEBOOK_LINK'] . '</a>' ?></p>
        </div>
        <div>
            <label style="font-size: 12px;">Instagram Link</label>
            <p><i class="bi bi-instagram"></i> <?= ($seller['INSTAGRAM_LINK'] == '') ? 'No link provided' : '<a href="' . $seller['INSTAGRAM_LINK'] . '" target="_blank" class="text-dark" style="text-decoration: none;">' . $seller['INSTAGRAM_LINK'] . '</a>' ?></p>
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
            $getImages = $db->getSMEsImages($seller['SELLER_ID']);
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
    <hr>
    <div class="products-container">
        <button id="addNewProduct" class="btn btn-success btn-add-new-prod"><i class="bi bi-plus-lg"></i> New Product</button>
        <h5>
            <center>Products</center>
        </h5>
        <div class="mt-5">
            <?php
            $getProducts = $db->getProducts($seller['SELLER_ID']);
            if ($getProducts->num_rows > 0) {
                while ($product = $getProducts->fetch_assoc()) {
            ?>
                    <hr>
                    <div class="container">
                        <button class="btn btn-danger btnDeleteProduct" data-id="<?= $product['PRODUCT_ID'] ?>" data-filename="<?= $product['PRODUCT_IMG'] ?>"><i class="bi bi-trash"></i> Delete</button>
                        <div class="text-center">
                            <img src="../../../backend/products-img/<?= $product['PRODUCT_IMG'] ?>" style="max-height: 150px; max-width: 150px">
                            <h6><?= $product['PRODUCT_NAME'] ?></h6>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <center class="text-danger">No Products Provided</center>
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
                    <input type="hidden" value="EditSellerDetails" name="SubmitType">
                    <input type="hidden" value="<?= $seller['SELLER_ID'] ?>" name="sellerId" id="sellerId">
                    <div class="input-container">
                        <label for="sellerName">Resto Name</label>
                        <input type="text" class="form-control" name="sellerName" id="sellerName" value="<?= $seller['STORE_NAME'] ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="sellerAddress">Address</label>
                        <input type="text" class="form-control" name="sellerAddress" id="sellerAddress" value="<?= $seller['ADDRESS'] ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="sellerMap">Map</label>
                        <textarea class="form-control" name="sellerMap" id="sellerMap" required><?= $seller['MAP'] ?></textarea>
                    </div>
                    <div class="input-container">
                        <label for="sellerEmail">Email</label>
                        <input type="text" class="form-control" name="sellerEmail" id="sellerEmail" value="<?= $seller['EMAIL'] ?>">
                    </div>
                    <div class="input-container">
                        <label for="sellerContactNo">Contact no.</label>
                        <input type="text" class="form-control" name="sellerContactNo" id="sellerContactNo" value="<?= $seller['CONTACT_NO'] ?>">
                    </div>
                    <div class="input-container">
                        <label for="sellerFB">Facebook Link</label>
                        <input type="text" class="form-control" name="sellerFB" id="sellerFB" value="<?= $seller['FACEBOOK_LINK'] ?>">
                    </div>
                    <div class="input-container">
                        <label for="sellerIG">Instagram Link</label>
                        <input type="text" class="form-control" name="sellerIG" id="sellerIG" value="<?= $seller['INSTAGRAM_LINK'] ?>">
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

<!-- Add Image Modal -->
<div class="modal" tabindex="-1" role="dialog" id="AddImageModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-cloud-arrow-up"></i> New Image</h5>
            </div>
            <form id="frmUploadImage">
                <div class="modal-body">
                    <input type="hidden" value="SMEsUploadNewImage" name="SubmitType">
                    <input type="hidden" value="<?= $seller['SELLER_ID'] ?>" name="ID" id="sellerId">
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
<!-- End of Add Image Modal -->

<!-- Add Product Modal -->
<div class="modal" tabindex="-1" role="dialog" id="AddProductModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-shop"></i> New Product</h5>
            </div>
            <form id="frmAddNewProduct">
                <div class="modal-body">
                    <input type="hidden" value="SMEsAddNewProduct" name="SubmitType">
                    <input type="hidden" value="<?= $seller['SELLER_ID'] ?>" name="ID" id="sellerId">
                    <div class="">
                        <label for="productImage" style="margin-left: 5px;">Upload Product Image Here:</label>
                        <input type="file" class="form-control mt-1" name="productImage" id="productImage" required accept="image/*">
                    </div>
                    <hr>
                    <div class="">
                        <label for="productName" style="margin-left: 5px;">Product Name:</label>
                        <input type="text" class="form-control mt-1" name="productName" id="productName" required>
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
<!-- End of Add Product Modal -->

<?php
include('components/footer.php');
