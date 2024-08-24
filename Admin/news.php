<?php
include("components/header.php");
?>

<h4 class="page-title"><i class="bi bi-newspaper"></i> News Update</h4>
<div class="container mt-4 table-container">
    <table class="table table-striped">
        <thead class="table-header">
            <tr>
                <th>No.</th>
                <th>Event Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Date publish</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <?php
            $count = 1;
            $getNews = $db->getNews();
            while ($news = $getNews->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= $news['EVENT_NAME'] ?></td>
                    <td><?= date('F j, Y', strtotime($news['DATE'])) ?></td>
                    <td><?= date('g:i A', strtotime($news['TIME'])) ?></td>
                    <td> <?php
                            // Halimbawa ng petsa at oras mula sa database
                            $originalDateTime = $news['DATE_PUBLISH'];

                            // I-format ang petsa at oras sa nais na format (hal. June 20, 2024, 03:45 PM)
                           echo $formattedDateTime = date('F j, Y, g:i A', strtotime($originalDateTime));
                            ?></td>
                    <td>
                        <textarea hidden id="<?= $news['NEWS_ID'] ?>"><?= $news['MAP'] ?></textarea>
                        <button class="btn btn-success btnEditNews" data-id="<?= $news['NEWS_ID'] ?>" data-name="<?= $news['EVENT_NAME'] ?>" data-address="<?= $news['ADDRESS'] ?>" data-description="<?= $news['DESCRIPTION'] ?>" data-date="<?= $news['DATE'] ?>" data-time="<?= $news['TIME'] ?>"><i class="bi bi-pen"></i></button>
                        <button class="btn btn-danger btnDeleteNews" data-id="<?= $news['NEWS_ID'] ?>"><i class="bi bi-trash-fill"></i></button>
                    </td>
                </tr>
            <?php
                $count++;
            }

            echo ($getNews->num_rows <= 0) ? '<tr><td colspan="5" class="text-center">No News Found.</td></tr>' : '';
            ?>
        </tbody>
    </table>
</div>
<button class="btn btn-dark btn-add-new" id="btnAddNews"><i class="bi bi-plus-square"></i> Add News</button>
<?php
include("components/footer.php");
?>
<script>
    $(document).ready(function() {
        $('.nav-manage').addClass('nav-selected');
        $('.nav-news').addClass('nav-selected');
    });
</script>