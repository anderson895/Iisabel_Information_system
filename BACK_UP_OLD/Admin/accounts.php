<?php
include('components/header.php');
?>

<h4 class="page-title"><i class="bi bi-people-fill"></i> Accounts</h4>
<div class="container mt-4 table-container">
    <table class="table table-striped">
        <thead class="table-header">
            <tr>
                <th>#</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <?php
            $count = 1;
            $getTourist = $db->getTourist();
            while ($tourist = $getTourist->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $tourist['USER_ID'] ?></td>
                    <td><?= $tourist['NAME'] ?></td>
                </tr>
            <?php
                $count++;
            }

            echo ($getTourist->num_rows <= 0) ? '<tr><td colspan="4" class="text-center">No Account Found.</td></tr>' : '';
            ?>
        </tbody>
    </table>
</div>

<?php
include('components/footer.php');
?>
<script>
    $(document).ready(function() {
        $('.nav-accounts').addClass('nav-selected');
    });
</script>