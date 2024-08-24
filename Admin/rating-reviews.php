<?php
include('components/header.php');
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



<h4 class="page-title"><i class="bi bi-hand-thumbs-up-fill"></i> Ratings & Reviews</h4>
<div class="container mt-4 table-container">
<button type="button" class="btn btn-success mb-4">Export </button>

    <table class="table table-striped" id="myTable">
        <thead class="table-header">
            <tr>
                <th>No.</th>
                <th>Rated By</th>
                <th>Rate Type</th>
                <th><center>Rating</th>
                <th>Review</th>
                <th>Action</th>
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
                    <!-- <td><?= $rate['RATE'] ?></td> -->
                    <td>
                        <input class="rateValue" hidden type="text" value="<?= $rate['RATE'] ?>" >
                        <div class="d-flex justify-content-center" style="width:100%;">
                            <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['RATE']>0){ echo 'active';} ?>" data-id="1"><i class="bi <?php if($rate['RATE']>0){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                            <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['RATE']>=2){ echo 'active';} ?>" data-id="2"><i class="bi <?php if($rate['RATE']>=2){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                            <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['RATE']>=3){ echo 'active';} ?>" data-id="3"><i class="bi <?php if($rate['RATE']>=3){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                            <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['RATE']>=4){ echo 'active';} ?>" data-id="4"><i class="bi <?php if($rate['RATE']>=4){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                            <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['RATE']>=5){ echo 'active';} ?>" data-id="5"><i class="bi <?php if($rate['RATE']>=5){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                        </div>
                    </td>
                   
                    <td><?= $rate['REVIEW'] ?></td>

                    <td>
                        <button type="button" 
                        class="btn btn-danger toglerDeleteComRev" 
                        data-bs-toggle="modal" 
                        data-bs-target="#modalDelete"
                        data-id=<?= $rate['ID'] ?>
                        
                        ><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            <?php
                $count++;
            }

            echo ($getRates->num_rows <= 0) ? '<tr><td colspan="6" class="text-center">No Rate Found.</td></tr>' : '';
            ?>
        </tbody>
    </table>
</div>



<!-- MODAL -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
      
      </div>
      <div class="modal-body">
       <h6 class="text-center">Are you sure to delete this review? </h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="btnConfirmDelete">Confirm</button>
      </div>
    </div>
  </div>
</div>

<script>
    // .toglerDeleteComRev

    $(document).ready(function(){
    // Click event
    $('.toglerDeleteComRev').click(function(){
        var id = $(this).attr('data-id');

        console.log(id);

        // Display a confirmation dialog
       
        $('#btnConfirmDelete').click(function(){
            $.ajax({
                url: "../backend/Controller/post.php",
                type: "POST",
                data: {
                    id: id,
                    SubmitType: 'deleteReviews'
                },
                success: function(data) {
                    console.log(data); // Log the data to console for demonstration

                    if(data=="success"){
                        location.reload()
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error("Error occurred:", error);
                }
            });
        });
        
    });
});


</script>



<script>
  // Kapag pindutin ang pindutan ng "Export"
document.querySelector('.btn.btn-success').addEventListener('click', function () {
    // Ikuha ang lahat ng mga hanay ng table
    var rows = document.querySelectorAll('#myTable tr');
    // Lumikha ng isang array upang magtipon ng data para sa bawat hanay
    var csv = [];
    // Para sa bawat hanay sa table, ikalap ang data
    for (var i = 0; i < rows.length; i++) {
        var row = [],
            cols = rows[i].querySelectorAll('td, th');
        // Para sa bawat kolum, kunin ang teksto at idagdag sa array na ito
        for (var j = 0; j < cols.length; j++) {
            // Check if the current column has a child with class "rateValue"
            var rateValue = cols[j].querySelector('.rateValue');
            if (rateValue !== null) {
                row.push(rateValue.value); // Push the value of the hidden input
            } else {
                row.push(cols[j].innerText); // Push the text content
            }
        }
        // Ilagay ang array ng hanay sa CSV array
        csv.push(row.join(","));
    }
    // Lumikha ng isang data URI para sa CSV string
    var csvContent = "data:text/csv;charset=utf-8," + csv.join("\n");
    // Lumikha ng isang hyperlink para sa pag-download
    var encodedUri = encodeURI(csvContent);
    var link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "ratings.csv");
    // Itago ang hyperlink, i-click ito, at pagkatapos ay alisin ito
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});

</script>


<?php
include('components/footer.php');
?>
<script>
    $(document).ready(function() {
        $('.nav-ratings').addClass('nav-selected');
    });













    
</script>

