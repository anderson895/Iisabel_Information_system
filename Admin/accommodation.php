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


<h4 class="page-title"><i class="bi bi-building"></i> Accommodation</h4>
<div class="container mt-4 table-container">

<button type="button" class="btn btn-success mb-4">Export </button>

    <table class="table table-striped" id="myTable">
        <thead class="table-header">
            <tr>
                <th>No.</th>
                <th>Accommodation</th>
                <th>Address</th>
                <th>Reason for Deactivation</th>
                <th>Status</th>
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
                    <td><?php if($accom['jDeactReason']){echo $accom['jDeactReason'];}else{ echo "N/A";}  ?></td>
                    <td><?php
                      if ($accom['STATUS'] == 1) {
                          echo '<span style="color: green;">Active</span>';
                      } else {
                          echo '<span style="color: red;">Inactive</span>';
                      }
                      ?>
                      </td>
                    <td>
                      
                        <button data-bs-toggle="modal" data-bs-target="#ModalAccom" class="toglerStatus btn <?= ($accom['STATUS'] == 1) ? 'btn-dark' : 'btn-success' ?>" data-newstatus="<?= ($accom['STATUS'] == 1) ? 0 : 1 ?>" data-id="<?= $accom['ACCOM_ID'] ?>"><i class="bi bi-lock-fill"></i> <?= ($accom['STATUS'] == 1) ? 'Deactivate' : 'Activate' ?></button>
                    </td>
                </tr>
            <?php
                $count++;
            }
            ?>
        </tbody>
    </table>
</div>



















<div class="modal fade" id="ModalAccom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Warning </h6>
       
      </div>
      <div class="modal-body">
      Are you sure to <span class="newstatus"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary btnConfirmUpdateStatus">Confirm</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="ModalDeactivation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Warning </h6>
       
      </div>
      <div class="modal-body">
        <h6>Reason:</h6>
      <textarea class="form-control" name="reasonInputted" id="reasonInputted" cols="10" rows="5"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary btnConfirmDeactivation">Confirm</button>
      </div>
    </div>
  </div>
</div>






<?php
include("components/footer.php");
?>
<script>

$(document).ready(function () {

const showAlert = (alertType, text) => {
  $(".alert").addClass(alertType).text(text);
  setTimeout(() => {
    $(".alert").removeClass(alertType).text("");
  }, 1000);
};

const closeModal = () => {
  $(".modal").modal("hide");
};

$(".toglerStatus").on("click", function () {
  var id = $(this).attr('data-id');
  var newstatus = $(this).attr('data-newstatus');

  console.log(newstatus);

  if (newstatus == 0) {
    $('.newstatus').text('Deactivate ?');

    $(".btnConfirmUpdateStatus").off('click').on('click', function () {
      $("#ModalDeactivation").modal('show');

      $(".btnConfirmDeactivation").off('click').on('click', function () {

        var reasonInputted = $('#reasonInputted').val();
        console.log(reasonInputted);

        $.ajax({
          type: "POST",
          url: "../backend/Controller/post.php",
          data: {
            SubmitType: "SMEsChangeStatusDeactivation",
            table: 'accommodation',
            id: id,
            newStatus: newstatus,
            reasonInputted: reasonInputted,
          },
          success: function (response) {
            console.log(response);
            closeModal();
            if (response == "200") {
              showAlert("alert-success", "Status Changed!");
              window.location.reload();
            } else {
              showAlert("alert-danger", "Failed to Change Status");
            }
          },
        });

      });
    });
  } else {
    $('.newstatus').text('Activate ?');
    $(".btnConfirmUpdateStatus").off('click').on('click', function () {

      $.ajax({
        type: "POST",
        url: "../backend/Controller/post.php",
        data: {
          SubmitType: "SMEsChangeStatus",
          table: 'accommodation',
          id: id,
          newStatus: newstatus,
          reasonInputted: '',
        },
        success: function (response) {
          console.log(response);
          closeModal();
          if (response == "200") {
            showAlert("alert-success", "Status Changed!");
            window.location.reload();
          } else {
            showAlert("alert-danger", "Failed to Change Status");
          }
        },
      });

    });
  }
});
});






    $(document).ready(function() {
        $('.nav-manage').addClass('nav-selected');
        $('.nav-accom').addClass('nav-selected');
    });
</script>





<script src='javascript/generateExcel.js'></script>