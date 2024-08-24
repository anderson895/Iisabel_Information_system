<?php
include("components/header.php");
?>

<h4 class="page-title"><i class="bi bi-shop"></i> Store</h4>
<div class="container mt-4 table-container">
    <table class="table table-striped">
        <thead class="table-header">
            <tr>
                <th>#</th>
                <th>Store</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <?php
            $count = 1;
            $getSeller = $db->getSellers();
            while ($seller = $getSeller->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= $seller['STORE_NAME'] ?></td>
                    <td><?= $seller['ADDRESS'] ?></td>
                    <td>
                        <button class="btn <?= ($seller['STATUS'] == 1) ? 'btn-dark' : 'btn-success' ?> btn-deactivate-seller" data-newstatus="<?= ($seller['STATUS'] == 1) ? 0 : 1 ?>" data-id="<?= $seller['SELLER_ID'] ?>"><i class="bi bi-lock-fill"></i> <?= ($seller['STATUS'] == 1) ? 'Deactivate' : 'Activate' ?></button>
                    </td>
                </tr>
            <?php
                $count++;
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include("components/footer.php");
?>
<script>
    $(document).ready(function() {
        $('.nav-manage').addClass('nav-selected');
        $('.nav-products').addClass('nav-selected');
    });
</script>