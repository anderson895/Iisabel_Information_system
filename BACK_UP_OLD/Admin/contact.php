<?php
include('components/header.php');
?>

<h4 class="page-title"><i class="bi bi-telephone-fill"></i> Contact</h4>
<div class="container mt-4 table-container">
    <table class="table table-striped">
        <thead class="table-header">
            <tr>
                <th>#</th>
                <th>Hotline Name</th>
                <th>Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <?php
            $count = 1;
            $getHotline = $db->getHotlines();
            while ($hotline = $getHotline->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= $hotline['HOTLINE_NAME'] ?></td>
                    <td><?= $hotline['NUMBER'] ?></td>
                    <td>
                        <button class="btn btn-success btnEditContact" data-id="<?= $hotline['HOTLINE_ID'] ?>" data-name="<?= $hotline['HOTLINE_NAME'] ?>" data-number="<?= $hotline['NUMBER'] ?>"><i class="bi bi-pen"></i>Edit</button>
                        <button class="btn btn-danger btnDeleteContact" data-id="<?= $hotline['HOTLINE_ID'] ?>"><i class="bi bi-trash-fill"></i>Delete</button>
                    </td>
                </tr>
            <?php
                $count++;
            }

            echo ($getHotline->num_rows <= 0) ? '<tr><td colspan="4" class="text-center">No Hotline Found.</td></tr>' : '';
            ?>
        </tbody>
    </table>
</div>
<button class="btn btn-dark btn-add-new" id="btnAddNewContact"><i class="bi bi-plus-square"></i> New Contact</button>

<?php
include('components/footer.php');
?>
<script>
    $(document).ready(function() {
        $('.nav-contact').addClass('nav-selected');
    });
</script>