$(document).ready(function () {
  const showAlert = (alertType, text) => {
    $(".alert").addClass(alertType).text(text);
    setTimeout(() => {
      $(".alert").removeClass(alertType).text("");
    }, 1000);
  };

  var isPasswordShow = false;
  $("#btnShowPassword").click(function (e) {
    e.preventDefault();
    if (isPasswordShow) {
      $(".input-password").attr("type", "password");
      $(".show-password-icon").removeClass("bi-eye-fill");
      $(".show-password-icon").addClass("bi-eye-slash-fill");
    } else {
      $(".input-password").attr("type", "text");
      $(".show-password-icon").removeClass("bi-eye-slash-fill");
      $(".show-password-icon").addClass("bi-eye-fill");
    }

    isPasswordShow = !isPasswordShow;
  });

  $("#frmAdminLogin").submit(function (e) {
    e.preventDefault();
    var username = $("#adminUsername").val();
    var password = $("#adminPassword").val();

    $.ajax({
      type: "POST",
      url: "../backend/Controller/post.php",
      data: {
        SubmitType: "Login",
        UserType: "Admin",
        username: username,
        password: password,
      },
      success: function (response) {
        if (response == "200") {
          window.location.href = "dashboard.php";
        } else {
          showAlert("alert-danger", "Incorrect username or password");
        }
      },
    });
  });

  $("#frmSMEsLogin").submit(function (e) {
    e.preventDefault();
    var username = $("#smesUsername").val();
    var password = $("#smesPassword").val();
    var accountType = $("#smesAccountType").val();

    $.ajax({
      type: "POST",
      url: "../backend/Controller/post.php",
      data: {
        SubmitType: "Login",
        UserType: "SMEs",
        smesType: accountType,
        username: username,
        password: password,
      },
      success: function (response) {
        if (response == "200") {
          window.location.reload();
        } else {
          showAlert("alert-danger", "Incorrect username or password");
        }
      },
    });
  });

  $("#frmTouristLogin").submit(function (e) {
    e.preventDefault();
    var username = $("#touristUsername").val();
    var password = $("#touristPassword").val();

    $.ajax({
      type: "POST",
      url: "../backend/Controller/post.php",
      data: {
        SubmitType: "Login",
        UserType: "Tourist",
        username: username,
        password: password,
      },
      success: function (response) {
        if (response == "200") {
          window.location.reload();
        } else {
          showAlert("alert-danger", "Incorrect username or password");
        }
      },
    });
  });
});
