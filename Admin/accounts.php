<?php
include('components/header.php');
?>

<h4 class="page-title"><i class="bi bi-people-fill"></i> Accounts</h4>
<div class="container mt-4 table-container">
    <table id="accountsTable" class="table table-striped">
        <thead class="table-header">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date of Last visit</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <?php
            $count = 1;
            $getTourist = $db->getTourist();
            while ($tourist = $getTourist->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= 'TOURIST-' . $tourist['SORT_ID'] . $tourist['USER_ID']; ?></td>
                    <td><?= $tourist['NAME'] ?></td>
                    <td><?= $tourist['EMAIL'] ?></td>
                    <td>
                        <?php
                        if ($tourist['LAST_VISIT'] != null) {
                            echo date('Y-m-d', strtotime($tourist['LAST_VISIT']));
                        } else {
                            echo "No visit";
                        }
                        ?>
                    </td>
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script>
    $(document).ready(function() {
        $('#accountsTable').DataTable();
        $('.nav-accounts').addClass('nav-selected');
    });
</script>
