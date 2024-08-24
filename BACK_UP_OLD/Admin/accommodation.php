<?php
include("components/header.php");
?>

<h4 class="page-title"><i class="bi bi-building"></i> Accommodation</h4>
<div class="container mt-4 table-container">
    <table class="table table-striped">
        <thead class="table-header">
            <tr>
                <th>#</th>
                <th>Accommodation</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <?php
            $count = 1;
            $getAccom = $db->getAccommodations();
            while ($accom = $getAccom->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= $accom['ACCOM_NAME'] ?></td>
                    <td><?= $accom['ADDRESS'] ?></td>
                    <td>
                        <button class="btn <?= ($accom['STATUS'] == 1) ? 'btn-dark' : 'btn-success' ?> btn-deactivate-accom" data-newstatus="<?= ($accom['STATUS'] == 1) ? 0 : 1 ?>" data-id="<?= $accom['ACCOM_ID'] ?>"><i class="bi bi-lock-fill"></i> <?= ($accom['STATUS'] == 1) ? 'Deactivate' : 'Activate' ?></button>
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
        $('.nav-accom').addClass('nav-selected');
    });
</script>