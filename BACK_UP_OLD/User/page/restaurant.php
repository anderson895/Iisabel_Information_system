<div class="container pt-3">
    <h4><i class="bi bi-egg-fried"></i> Restaurant</h4>
    <div class="container d-flex flex-wrap">
        <?php
        $getResto = $db->getResto();
        while ($resto = $getResto->fetch_assoc()) {
            $getImage = $db->getSMEsImages($resto['RESTO_ID']);
            if ($getImage->num_rows > 0) {
                $img = $getImage->fetch_assoc();
                $restoImgDisplay = '../backend/SMEsImg/' . $img['FILE_NAME'];
            } else {
                $restoImgDisplay = '../assets/system-img/logo.png';
            }
        ?>
            <button class="btnRestoContainer btn" 
            data-id="<?= $resto['RESTO_ID'] ?>" 
            data-name="<?= $resto['RESTO_NAME'] ?>" 
            data-description="<?= $resto['DESCRIPTION'] ?>" 
            data-address="<?= $resto['ADDRESS'] ?>" 
            data-map='<?= $resto['MAP'] ?>' 
            data-email='<?= $resto['EMAIL'] ?>' 
            data-fb='<?= $resto['FACEBOOK_LINK'] ?>' 
            data-ig='<?= $resto['INSTAGRAM_LINK'] ?>' data-number='<?= $resto['CONTACT_NO'] ?>'>
                <img src="<?= $restoImgDisplay ?>">
                <hr>
                <div>
                    <h6><?= $resto['RESTO_NAME'] ?></h6>
                </div>
            </button>
        <?php
        }
        ?>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="viewRestaurantModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-egg-fried"></i> Restaurant</h5>
            </div>
            <div>
                <div class="modal-body">
                    <div class="modal-lg-img-container text-center">
                        <img src="" class="modal-lg-img" id="resto-modal-lg-img">
                        <div id="resto-modal-sm-img-container">
                            <!--  -->
                        </div>
                    </div>
                    <hr>
                    <div class="input-container">
                        <label>Accommodation Name</label>
                        <input type="text" readonly class="form-control" id="resto-modal-resto-name" value="">
                    </div>
                    <div class="input-container">
                        <label>Spot Description</label>
                        <input type="text" readonly class="form-control" id="resto-modal-resto-description" value="">
                    </div>
                    <div>
                        <div class="input-container">
                            <label>Email</label>
                            <input type="text" readonly id="resto-modal-email" class="form-control">
                        </div>
                        <div class="input-container">
                            <label>Contact no</label>
                            <input type="text" readonly id="resto-modal-contact-no" class="form-control">
                        </div>
                        <div class="input-container">
                            <label>Facebook</label>
                            <input type="text" readonly id="resto-modal-fb" class="form-control">
                        </div>
                        <div class="input-container">
                            <label>Instagram</label>
                            <input type="text" readonly id="resto-modal-ig" class="form-control">
                        </div>
                    </div>
                    <div class="input-container">
                        <label>Resto Address</label>
                        <input type="text" readonly class="form-control" id="resto-modal-resto-address" value="">
                    </div>
                    <hr>
                    <h6>Map Preview</h6>
                    <div id="resto-modal-map-preview-container" style="width: 350px; overflow:auto; margin:auto">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnTsRate" data-id="" data-name="">Rate</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="rateTsModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-card-image"></i> <span id="tsReviewName"></span></h5>
            </div>
            <form id="tsFrmRate">
                <div class="modal-body">
                    <input type="hidden" name="id" id="ts-frm-Id">
                    <input type="hidden" name="star" id="tsfrmStar" value="0">
                    <center id="tsStarsContainer">
                        <button type="button" class="btn text-warning btnTsFrmStar" data-id="1"><i class="bi bi-star"></i></button>
                        <button type="button" class="btn text-warning btnTsFrmStar" data-id="2"><i class="bi bi-star"></i></button>
                        <button type="button" class="btn text-warning btnTsFrmStar" data-id="3"><i class="bi bi-star"></i></button>
                        <button type="button" class="btn text-warning btnTsFrmStar" data-id="4"><i class="bi bi-star"></i></button>
                        <button type="button" class="btn text-warning btnTsFrmStar" data-id="5"><i class="bi bi-star"></i></button>
                    </center>
                    <div class="input-container">
                        <label>Review</label>
                        <textarea id="tsFrmModalReview" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>