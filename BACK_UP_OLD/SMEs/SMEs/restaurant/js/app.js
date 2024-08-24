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

  $("#btnEditDetails").click(function (e) {
    e.preventDefault();
    $("#EditDetailsModal").modal("show");
  });

  $(".btnCloseModal").click(function (e) {
    e.preventDefault();
    closeModal();
  });

  $("#frmEditDetails").submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "../../../backend/Controller/post.php",
      data: formData,
      success: function (response) {
        console.log(response);
        closeModal();
        if (response == "200") {
          showAlert("alert-success", "Editing Success!");
          setTimeout(() => {
            window.location.reload();
          }, 1000);
        } else {
          showAlert("alert-danger", "Editing Failed!");
        }
      },
    });
  });

  $("#addNewImage").click(function (e) {
    e.preventDefault();
    $("#AddImageModal").modal("show");
  });

  $("#frmUploadImage").submit(function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
      type: "POST",
      url: "../../../backend/Controller/post.php",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(response);
        closeModal();
        if (response == "200") {
          showAlert("alert-success", "Image Uploaded!");
          setTimeout(() => {
            window.location.reload();
          }, 1000);
        } else {
          showAlert("alert-danger", "Uploading Failed!");
        }
      },
    });
  });

  $(".btnDeleteImg").click(function (e) {
    e.preventDefault();
    console.log($(this).data("id"));
    console.log($(this).data("filename"));
    $.ajax({
      type: "POST",
      url: "../../../backend/Controller/post.php",
      data: {
        SubmitType: "DeleteSMEsImage",
        id: $(this).data("id"),
        fileName: $(this).data("filename"),
      },
      success: function (response) {
        console.log(response);
        closeModal();
        if (response == "200") {
          showAlert("alert-success", "Image Deleted!");
          setTimeout(() => {
            window.location.reload();
          }, 1000);
        } else {
          showAlert("alert-danger", "Deleting Failed!");
        }
      },
    });
  });
});
