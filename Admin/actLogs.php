<?php
include("components/header.php");
?>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<!-- Include DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


<script>
    $(document).ready(function () {
        let table = new DataTable('#myTable');
    });
</script>


<h4 class="page-title"><i class="bi bi-building"></i> Activity Logs</h4>
<div class="container mt-4 table-container">

<!-- <button type="button" class="btn btn-success mb-4">Export </button> -->

    <table class="table table-striped" id="myTable">
        <thead class="table-header">
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Description</th>
                <th>Date</th>
               
                
            </tr>
        </thead>
        <tbody class="table-body">
            <?php
            $count = 1;
            $getActlog = $db->getActivityLogs();
            while ($log = $getActlog->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= $log['log_username'] ?></td>
                    <td><?= $log['activity_description'] ?></td>
                    <td><?= date('F j, Y, g:i a', strtotime($log['date_added'])) ?></td>

                 
                   
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





<!-- 


<script src='javascript/generateExcel.js'></script> -->