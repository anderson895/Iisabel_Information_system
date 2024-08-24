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
    var email = $("#touristEmail").val();

    $.ajax({
        type: "POST",
        url: "../backend/Controller/post.php",
        data: {
            SubmitType: "TouristSignup",
            name: name,
            username: username,
            password: password,
            email: email,
        },
        success: function (response) {
            console.log(response);
            if (response.trim() === "200") {
               

                sendOTP(email); // Pass OTP and expiry to the function
            } else if (response.trim() === "Username is already existing!") {
                showAlert("alert-danger", response);
            } else if (response.trim() === "Email is already existing!") {
              showAlert("alert-danger", response);
            } else {
                console.log(response);
                showAlert("alert-danger", "Signup Failed!");
            }

        },
        error: function () {
            showAlert("alert-danger", "Error in AJAX request!");
        }
    });
});



// Function to send OTP
function sendOTP(email) {
  // Show loading indicator
  $('#loading-indicator').show();
  $('#btnSignup').hide();

  $.ajax({
      type: "POST",
      url: "../signupMailer.php",
      data: {
          email: email,
      },
      success: function (response) {
          console.log("OTP sent successfully:", response);
          // Redirect to otpverification.php upon successful OTP send
          window.location.href = "../otpverification.php";
      },
      error: function () {
          showAlert("alert-danger", "Failed to send OTP!");
      },
      complete: function () {
          // Hide loading indicator regardless of success or error
          $('#loading-indicator').hide();
          $('#btnSignup').show();
      }
  });
}






  

  


  
});
