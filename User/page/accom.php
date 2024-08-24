<style>
    /* Custom styles for the scrollable div */
    .scrollable-div {
      max-height: 300px; /* Set the maximum height for the scrollable div */
      overflow-y: auto; /* Enable vertical scrollbar if needed */
      border: 1px solid #ddd; /* Add a border for styling */
      border-radius:10px;
      padding: 10px; /* Add padding for better appearance */
    }

    
  </style>




<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



<div class="container pt-3">
    <h4><i class="bi bi-building"></i> Accommodation</h4>
    <div class="container d-flex flex-wrap">
        <?php
        $getAccom = $db->getAccommodations();
        while ($accom = $getAccom->fetch_assoc()) {
            $getImage = $db->getSMEsImages($accom['ACCOM_ID']);
            if ($getImage->num_rows > 0) {
                $img = $getImage->fetch_assoc();
                $accomImgDisplay = '../backend/SMEsImg/' . $img['FILE_NAME'];
            } else {
                $accomImgDisplay = '../assets/system-img/logo.png';
            }
        ?>
            <button class="btnAccomContainer btn" data-id="<?= $accom['ACCOM_ID'] ?>" data-name="<?= $accom['ACCOM_NAME'] ?>" data-description="<?= $accom['DESCRIPTION'] ?>" data-address="<?= $accom['ADDRESS'] ?>" data-map='<?= $accom['MAP'] ?>' data-email='<?= $accom['EMAIL'] ?>' data-fb='<?= $accom['FACEBOOK_LINK'] ?>' data-ig='<?= $accom['INSTAGRAM_LINK'] ?>' data-number='<?= $accom['CONTACT_NO'] ?>'>
                <img src="<?= $accomImgDisplay ?>">
                <hr>
                <div>
                    <h6><?= $accom['ACCOM_NAME'] ?></h6>
                </div>
            </button>
        <?php
        }
        ?>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="viewAccommodationModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-card-image"></i> Accommodation Spot</h5>

                <input hidden type="text" id="accomodation_id">
            </div>
            <div>
                <div class="modal-body">
                    <div class="modal-lg-img-container text-center">
                        <img src="" class="modal-lg-img" id="accom-modal-lg-img">
                        <div id="accom-modal-sm-img-container">
                            <!--  -->
                        </div>
                    </div>
                    <hr>

                 

                    <div class="input-container">
                        <label>Accommodation Name</label>
                        <input type="text" readonly class="form-control" id="accom-modal-accom-name" value="">
                    </div>
                    <div class="input-container">
                        <label>Spot Description</label>
                        <input type="text" readonly class="form-control" id="accom-modal-accom-description" value="">
                    </div>
                    <div>
                        <div class="input-container">
                            <label>Email</label>
                            <input type="text" readonly id="accom-modal-email" class="form-control">
                        </div>
                        <div class="input-container">
                            <label>Contact no</label>
                            <input type="text" readonly id="accom-modal-contact-no" class="form-control">
                        </div>
                        <div class="input-container">
                            <label>Facebook</label>
                            <input type="text" readonly id="accom-modal-fb" class="form-control">
                        </div>
                        <div class="input-container">
                            <label>Instagram</label>
                            <input type="text" readonly id="accom-modal-ig" class="form-control">
                        </div>
                    </div>
                    <div class="input-container">
                        <label>Spot Address</label>
                        <input type="text" readonly class="form-control" id="accom-modal-accom-address" value="">
                    </div>
                    <hr>


<div class="container mt-5 mb-4">
    <h2>Reviews</h2>
    <div class="scrollable-div">
      <!-- Replace the content inside this div with your reviews, stars, and comments -->

     

<div id="reviews-container" style="display:none; "></div>

<!-- Your existing HTML content -->
<script>
$(document).ready(function () {
    $(".btnAccomContainer").click(function (e) {
        e.preventDefault();
        var accomodation_id = $(this).data('id');
        $.ajax({
            url: 'endpoint/fetch_reviews.php',
            method: 'POST',
            data: { accomodation_id: accomodation_id },
            success: function (data) {
                console.log(data);
                displayReviews(data);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching reviews:', status, error);
            }
        });
    });

    function displayReviews(reviews) {
    var reviewsContainer = $('#reviews-container');
    var scrollableDiv = $('.scrollable-div');

    // Check if reviews array is empty
    if (reviews.length === 0) {
        reviewsContainer.empty(); // Clear any existing content
        reviewsContainer.append('<p>No reviews available.</p>'); // Display no review message
        reviewsContainer.show(); // Show the container with the message
        scrollableDiv.css('border', 'none'); // Remove border from .scrollable-div
        return;
    }

    // Clear existing content
    reviewsContainer.empty();

    // Append new reviews
    $.each(reviews, function (index, review) {
        reviewsContainer.append(`
            <div class="review">
                <h4>${review.NAME}</h4>
                <p>Rate: ${generateStarButtons(review.RATE)}</p>
                <p>Comment: ${review.REVIEW}</p>
            </div>
        `);
    });

    // Show container and set border
    reviewsContainer.show();
    scrollableDiv.css('border', '1px solid #ccc'); // Set border for .scrollable-div
}




    function generateStarButtons(starCount) {
        let buttons = '';
        for (let i = 1; i <= 5; i++) {
            const activeClass = i <= starCount ? 'text-warning' : 'text-secondary';
            buttons += `<button style="width:20px;" type="button" class="btn ${activeClass} " data-id="${i}"><i class="bi bi-star"></i></button>`;
        }
        return buttons;
    }
});
</script>

     
      
      
      
      <!-- Add more reviews as needed -->
    </div>
  </div>
                    




                    <h6>Map Preview</h6>
                    <div id="accom-modal-map-preview-container" style="width: 350px; overflow:auto; margin:auto">

                    </div>
                </div>
                <div class="modal-footer">
                    <?php 
                    if($_SESSION){
                        echo '
                        <button type="submit" class="btn btn-primary" id="btnTsRate" data-id="" data-name="">Rate</button>
                        ';
                    }
                    ?>
                    
                  
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
                        <label>Reviews</label>
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

