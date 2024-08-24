<div class="container pt-3">
    <h4><i class="bi bi-newspaper"></i> News Update</h4>


    <!--<div class="container">-->

    <!--    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">-->
    <!--    <div class="carousel-inner">-->
    <!--        <div class="carousel-item active" data-bs-interval="4000">-->
    <!--        <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: First slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#555" dy=".3em">First slide</text></svg>-->
    <!--        </div>-->
    <!--        <div class="carousel-item" data-bs-interval="2000">-->
    <!--        <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Second slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#666"></rect><text x="50%" y="50%" fill="#444" dy=".3em">Second slide</text></svg>-->
    <!--        </div>-->
    <!--        <div class="carousel-item">-->
    <!--        <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Third slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#555"></rect><text x="50%" y="50%" fill="#333" dy=".3em">Third slide</text></svg>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">-->
    <!--        <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
    <!--        <span class="visually-hidden">Previous</span>-->
    <!--    </button>-->
    <!--    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">-->
    <!--        <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
    <!--        <span class="visually-hidden">Next</span>-->
    <!--    </button>-->
    <!--    </div>-->

    <!--</div>-->
    
    <div class="container">
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="4000">
                <img src="../maam_abi_img/1.jpg" class="d-block w-100" alt="First slide">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="../maam_abi_img/2.jpg" class="d-block w-100" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img src="../maam_abi_img/3.jpg" class="d-block w-100" alt="Third slide">
            </div>
            
             <div class="carousel-item">
                <img src="../maam_abi_img/4.jpg" class="d-block w-100" alt="fourth slide">
            </div>
            
     <div class="carousel-item">
                <img src="../maam_abi_img/5.jpg" class="d-block w-100" alt="fifth slide">
            </div>
            
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>




    <div class="container all-contacts-container d-flex justify-content-around flex-wrap mt-3">
        <?php
        $getNews = $db->getNews();
        while ($news = $getNews->fetch_assoc()) {
            $getImage = $db->getSMEsImages($news['NEWS_ID']);
            $miniImages = [];
            if ($getImage->num_rows > 0) {
                while ($image = $getImage->fetch_assoc()) {
                    $data = "../backend/SMEsImg/" . $image['FILE_NAME'];
                    $miniImages[] = $data;
                }

                $mainImage = $miniImages[0];
            } else {
                $mainImage = "../assets/system-img/logo.png";
            }

        ?>
            <div class="container card p-3 news-container mt-3 mb-3">
                <div class="news-image-container">
                    <div class="main-image-container text-center">
                        <img src="<?= $mainImage ?>" class="<?= $news['NEWS_ID'] ?>">
                    </div>
                    <div class="mini-images-button-container text-center mt-2">
                        <?php
                        foreach ($miniImages as $img) {
                        ?>
                            <button class="btnChangeImage btn" data-url="<?= $img ?>" data-id="<?= $news['NEWS_ID'] ?>"><img src="<?= $img ?>"></button>
                        <?php
                        }
                        ?>
                    </div>
                    <hr>
                    <div>

                    <div class="input-container mb-4">
                            <i>Date Published :
                            <?php
                            // Halimbawa ng petsa at oras mula sa database
                            $originalDateTime = $news['DATE_PUBLISH'];

                            // I-format ang petsa at oras sa nais na format (hal. June 20, 2024, 03:45 PM)
                            $formattedDateTime = date('F j, Y, g:i A', strtotime($originalDateTime));
                            ?>

                           <?= $formattedDateTime ?></i>
                        </div>

                        <h4><?= $news['EVENT_NAME'] ?></h4>
                        <div class="input-container">
                            <label>Description</label>
                            <input type="text" class="form-control" readonly value="<?= $news['DESCRIPTION'] ?>">
                        </div>
                        <div class="input-container">
                            <label>Date and Time</label>
                            <input type="text" class="form-control" readonly value="<?= date('F j, Y g:i A', strtotime($news['DATE'] . ' ' . $news['TIME'])) ?>">
                        </div>
                        <div class="input-container">
                            <label>Location</label>
                            <input type="text" class="form-control" readonly value="<?= $news['ADDRESS'] ?>">
                        </div>

                       

                        <hr>
                        <h6>Map Preview:</h6>
                        <div class="mt-4" style="width: 100%; height: 100%; overflow:auto; margin:auto">
                            <?= $news['MAP'] ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }

        if ($getNews->num_rows < 1) {
        ?>
            <center class="text-danger">No News.</center>
        <?php
        }
        ?>
    </div>
</div>