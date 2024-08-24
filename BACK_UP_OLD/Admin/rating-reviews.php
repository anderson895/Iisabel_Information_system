<?php
include('components/header.php');
?>

<h4 class="page-title"><i class="bi bi-hand-thumbs-up-fill"></i> Ratings & Reviews</h4>
<div class="container mt-4 table-container">
    <table class="table table-striped">
        <thead class="table-header">
            <tr>
                <th>#</th>
                <th>Rated By</th>
                <th>Rate Type</th>
                <th>Rating</th>
                <th>Review</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <?php
            $count = 1;
            $getRates = $db->getRates();
            while ($rate = $getRates->fetch_assoc()) {
                $getUser = $db->getTouristUsingId($rate['USER_ID']);
                $rater = 'Anonymous';
                if ($getUser->num_rows > 0) {
                    $user = $getUser->fetch_assoc();
                    $rater = $user['NAME'];
                }

                $smesId = $rate['SMES_ID'];
                if (strpos($smesId, 'SPOT') !== false) {
                    $getSmes = $db->getTouristSpotById($smesId);
                } elseif (strpos($smesId, 'accommodation') !== false) {
                    $getSmes = $db->checkSmesId('accommodation', $smesId);
                } elseif (strpos($smesId, 'restaurant') !== false) {
                    $getSmes = $db->checkSmesId('restaurant', $smesId);
                } elseif (strpos($smesId, 'seller') !== false) {
                    $getSmes = $db->checkSmesId('seller', $smesId);
                }

                $rateName = '';

                if ($getSmes->num_rows > 0) {
                    $smes = $getSmes->fetch_assoc();
                    if (strpos($smesId, 'SPOT') !== false) {
                        $rateName = $smes['SPOT_NAME'];
                    } elseif (strpos($smesId, 'accommodation') !== false) {
                        $rateName = $smes['ACCOM_NAME'];
                    } elseif (strpos($smesId, 'restaurant') !== false) {
                        $rateName = $smes['RESTO_NAME'];
                    } elseif (strpos($smesId, 'seller') !== false) {
                        $rateName = $smes['STORE_NAME'];
                    }
                }
            ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= $rater ?></td>
                    <td><?= $rateName ?></td>
                    <td><?= $rate['RATE'] ?></td>
                    <td><?= $rate['REVIEW'] ?></td>
                </tr>
            <?php
                $count++;
            }

            echo ($getRates->num_rows <= 0) ? '<tr><td colspan="4" class="text-center">No Rate Found.</td></tr>' : '';
            ?>
        </tbody>
    </table>
</div>

<?php
include('components/footer.php');
?>
<script>
    $(document).ready(function() {
        $('.nav-ratings').addClass('nav-selected');
    });
</script>