<?php
include("components/header.php");
?>

<h4 class="page-title"><i class="bi bi-card-image"></i> Tourist Spot</h4>
<div class="container mt-4 table-container">
    <table class="table table-striped">
        <thead class="table-header">
            <tr>
                <th>#</th>
                <th>Spot Name</th>
                <th>Spot Type</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <?php
            $count = 1;
            $getSpots = $db->getTouristSpot();
            while ($spot = $getSpots->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= $spot['SPOT_NAME'] ?></td>
                    <td><?= $spot['SPOT_TYPE'] ?></td>
                    <td><?= $spot['ADDRESS'] ?></td>
                    <td>
                        <textarea hidden id="<?= $spot['SPOT_ID'] ?>"><?= $spot['MAP'] ?></textarea>
                        <button class="btn btn-success btnEditSpot" data-id="<?= $spot['SPOT_ID'] ?>" data-name="<?= $spot['SPOT_NAME'] ?>" data-spottype="<?= $spot['SPOT_TYPE'] ?>" data-fee="<?= $spot['FEE'] ?>" data-address="<?= $spot['ADDRESS'] ?>" data-description="<?= $spot['DESCRIPTION'] ?>"><i class="bi bi-pen"></i> Edit</button>
                        <button class="btn btn-danger btnDeleteSpot" data-id="<?= $spot['SPOT_ID'] ?>"><i class="bi bi-trash-fill"></i> Delete</button>
                    </td>
                </tr>
            <?php
                $count++;
            }

            echo ($getSpots->num_rows <= 0) ? '<tr><td colspan="5" class="text-center">No Spot Found.</td></tr>' : '';
            ?>
        </tbody>
    </table>

    <button class="btn btn-dark btn-add-new" id="btnAddSpot"><i class="bi bi-plus-square"></i> Add Spot</button>
</div>
<?php
include("components/footer.php");
?>
<script>
    $(document).ready(function() {
        $('.nav-manage').addClass('nav-selected');
        $('.nav-spots').addClass('nav-selected');
    });
</script>