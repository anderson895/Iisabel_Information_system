<?php
include('components/header.php');
?>

<h4 class="page-title"><i class="bi bi-clipboard-check-fill"></i> Dashboard</h4>
<div class="input-container" style="width: 200px; position:absolute; right: 20px">
    <label>Sort By Date</label>
    <input type="date" class="form-control" id="db-sort" value="<?php echo date('Y-m-d'); ?>">
</div>
<div class="container mt-4 table-container dashboard-container" id="chartContainer" style="height: 70vh; width: 100%;">

</div>
<?php
include('components/footer.php');
?>
<script>
    $(document).ready(function() {
        $('.nav-dashboard').addClass('nav-selected');
    });
</script>