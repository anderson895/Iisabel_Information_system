<?php
include('components/header.php');

?>


<link rel="stylesheet" href="css/Analytics.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<h4 class="page-title"><i class="bi bi-clipboard-check-fill"></i> Dashboard</h4>
<div class="input-container" style="width: 200px; position:absolute; right: 20px">
    <label>Sort By Date</label>
    <input type="date" class="form-control db-sort"  value="<?php echo date('Y-m-d'); ?>">
    
</div>




<br><br>


<div class="container">
    
    <div class="row">

    <div class="four col-md-2">
		<div class="counter-box" style="background-color:#FFBF00;">
        <i class="fa fa-user-circle-o text-white"></i>
        
			<span class="counter text-white" >
            <?php
        $getResto = $db->FetchTotalUser();
        $resto = $getResto->fetch_assoc();
        echo $resto['TotalCount'];
            ?>

            </span>
			<p class="text-white">Total User</p>
		</div>
	</div>


	<div class="four col-md-2">
		<div class="counter-box colored">
        <i class='fa fa-building-o fa-5x'></i>
			<span class="counter">
            <?php
        $getResto = $db->FetchAccomodation();
        $resto = $getResto->fetch_assoc();
        echo $resto['total'];
            ?>




            </span>
			<p>Accommodation</p>
		</div>
	</div>



	<div class="four col-md-2">
		<div class="counter-box colored">
		<i class='fa fa-users fa-5x ' ></i>
			<span class="counter">

            <?php
        $getResto = $db->FetchSeller();
        $resto = $getResto->fetch_assoc();
        echo $resto['total'];
            ?>
            
            </span>

			<p>SMEs</p>
		</div>
	</div>
	<div class="four col-md-2">
		<div class="counter-box colored">
        <i class='fa fa-cutlery fa-5x' ></i>
			<span class="counter">
                    <?php
                $getResto = $db->FetchRestaurant();
                $resto = $getResto->fetch_assoc();
                echo $resto['total'];
                    ?>

            </span>
			<p>Restaurant</p>
		</div>
	</div>
	<div class="four col-md-3">
		<div class="counter-box colored">
			<i class="fa  fa-user"></i>
			<span class="counter">

            <?php
                $getResto = $db->Fetchtourist();
                $resto = $getResto->fetch_assoc();
                echo $resto['total'];
                    ?>

            </span>
			<p>Tourist</p>
		</div>
	</div>
  </div>	
</div>





<div class="container mt-4 table-container dashboard-container" id="chartContainer" style="height: 70vh; width: 100%;"></div>

<div class="container mt-4 table-container dashboard-container" id="chartContainerPerMonth" style="height: 70vh; width: 100%;"></div>






<?php
include('components/footer.php');
?>
<script src="javascript/analyticsCounter.js"></script>

<script>
    $(document).ready(function() {
        $('.nav-dashboard').addClass('nav-selected');
    });
</script>