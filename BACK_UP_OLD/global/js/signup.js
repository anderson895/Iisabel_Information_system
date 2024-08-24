$(document).ready(function () {
  const showAlert = (alertType, text) => {
    $(".alert").addClass(alertType).text(text);
    setTimeout(() => {
      $(".alert").removeClass(alertType).text("");
    }, 1000);
  };

  $("#frmSMEsSignUp").submit(function (e) {
    e.preventDefault();
    var name = $("#smesName").val();
    var address = $("#smesAddress").val();
    var username = $("#smesUsername").val();
    var password = $("#smesPassword").val();
    var smesType = $("#smesType").val();

    $.ajax({
      type: "POST",
      url: "../backend/Controller/post.php",
      data: {
        SubmitType: "SMEsSignUp",
        smesType: smesType,
        name: name,
        address: address,
        username: username,
        password: password,
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          window.location.reload();
        } else if (response == "Username is already existing!") {
          showAlert("alert-danger", response);
        } else {
          showAlert("alert-danger", "Signup Failed!");
        }
      },
    });
  });

  $("#frmTouristSignUp").submit(function (e) {
    e.preventDefault();
    var name = $("#touritstName").val();
    var username = $("#touristUsername").val();
    var password = $("#touristPassword").val();

    $.ajax({
      type: "POST",
      url: "../backend/Controller/post.php",
      data: {
        SubmitType: "TouristSignup",
        name: name,
        username: username,
        password: password,
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          window.location.reload();
        } else if (response == "Username is already existing!") {
          showAlert("alert-danger", response);
        } else {
          showAlert("alert-danger", "Signup Failed!");
        }
      },
    });
  });
});
