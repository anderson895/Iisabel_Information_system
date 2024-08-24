<div class="container pt-3">
    <h4><i class="bi bi-newspaper"></i> News Update</h4>
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
                        <div class="mt-4" style="width: 350px; height: 350px; overflow:auto; margin:auto">
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