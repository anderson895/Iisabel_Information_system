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
    <h4><i class="bi bi-card-image"></i> Tourist Spot</h4>
    <div class="tourist-spot-container container d-flex flex-wrap">
        <?php
        $getTouristSpot = $db->getTouristSpot();
        while ($ts = $getTouristSpot->fetch_assoc()) {
            $getImage = $db->getSMEsImages($ts['SPOT_ID']);
            if ($getImage->num_rows > 0) {
                $img = $getImage->fetch_assoc();
                $spotDisplayImg = '../backend/SMEsImg/' . $img['FILE_NAME'];
            } else {
                $spotDisplayImg = '../assets/system-img/logo.png';
            }
        ?>
            <button class="btnSpotContainer btn" data-id="<?= $ts['SPOT_ID'] ?>" data-name="<?= $ts['SPOT_NAME'] ?>" data-type="<?= $ts['SPOT_TYPE'] ?>" data-description="<?= $ts['DESCRIPTION'] ?>" data-address="<?= $ts['ADDRESS'] ?>" data-fee="<?= $ts['FEE'] ?>" data-map='<?= $ts['MAP'] ?>'>
                <img src="<?= $spotDisplayImg ?>">
                <hr>
                <div>
                    <h6><?= $ts['SPOT_NAME'] ?></h6>
                    <p>
                        Entrance Fee: <span class="text-success"><?= ($ts['FEE'] > 0) ? $ts['FEE'] : 'Free' ?></span>
                    </p>
                </div>
            </button>
        <?php
        }
        ?>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="viewSpotModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-card-image"></i> Tourist Spot</h5>
            </div>
            <div>
                <div class="modal-body">
                    <div class="modal-lg-img-container text-center">
                        <img src="" class="modal-lg-img" id="ts-modal-lg-img">
                        <div id="ts-modal-sm-img-container">
                            <!--  -->
                        </div>
                    </div>
                    <hr>
                    <div class="input-container">
                        <label>Spot Name</label>
                        <input type="text" readonly class="form-control" id="ts-modal-spot-name" value="">
                    </div>
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="input-container">
                            <label>Spot Type</label>
                            <input type="text" readonly class="form-control" id="ts-modal-spot-type" value="">
                        </div>

                        <div class="input-container">
                            <label>Spot Fee</label>
                            <input type="text" readonly class="form-control" id="ts-modal-spot-fee" value="">
                        </div>
                    </div>
                    <div class="input-container">
                        <label>Spot Description</label>
                        <input type="text" readonly class="form-control" id="ts-modal-spot-description" value="">
                    </div>
                    <div class="input-container">
                        <label>Spot Address</label>
                        <input type="text" readonly class="form-control" id="ts-modal-spot-address" value="">
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
    $(".btnSpotContainer").click(function (e) {
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
                    <div id="ts-modal-map-preview-container" style="width: 350px; overflow:auto; margin:auto">

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