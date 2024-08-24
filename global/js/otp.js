const inputs = document.querySelectorAll(".otp-field > input");
const button = document.querySelector(".btn");

window.addEventListener("load", () => inputs[0].focus());
button.setAttribute("disabled", "disabled");

inputs[0].addEventListener("paste", function (event) {
  event.preventDefault();

  const pastedValue = (event.clipboardData || window.clipboardData).getData(
    "text"
  );
  const otpLength = inputs.length;

  for (let i = 0; i < otpLength; i++) {
    if (i < pastedValue.length) {
      inputs[i].value = pastedValue[i];
      inputs[i].removeAttribute("disabled");
      inputs[i].focus;
    } else {
      inputs[i].value = ""; // Clear any remaining inputs
      inputs[i].focus;
    }
  }
});

inputs.forEach((input, index1) => {
  input.addEventListener("keyup", (e) => {
    const currentInput = input;
    const nextInput = input.nextElementSibling;
    const prevInput = input.previousElementSibling;

    if (currentInput.value.length > 1) {
      currentInput.value = "";
      return;
    }

    if (
      nextInput &&
      nextInput.hasAttribute("disabled") &&
      currentInput.value !== ""
    ) {
      nextInput.removeAttribute("disabled");
      nextInput.focus();
    }

    if (e.key === "Backspace") {
      inputs.forEach((input, index2) => {
        if (index1 <= index2 && prevInput) {
          input.setAttribute("disabled", true);
          input.value = "";
          prevInput.focus();
        }
      });
    }

    button.classList.remove("active");
    button.setAttribute("disabled", "disabled");

    const inputsNo = inputs.length;
    if (!inputs[inputsNo - 1].disabled && inputs[inputsNo - 1].value !== "") {
      button.classList.add("active");
      button.removeAttribute("disabled");

      return;
    }
  });
});






// Function to move focus to the next input field in OTP entry
function moveToNext(current, nextFieldID) {
  if (current.value.length >= current.maxLength) {
      document.getElementById(nextFieldID).focus();
  }
}

function verifyOTP() {
  // Retrieve OTP digits from input fields
  var otp1 = document.getElementById('otp1').value.toString();
  var otp2 = document.getElementById('otp2').value.toString();
  var otp3 = document.getElementById('otp3').value.toString();
  var otp4 = document.getElementById('otp4').value.toString();
  var otp5 = document.getElementById('otp5').value.toString();
  var otp6 = document.getElementById('otp6').value.toString();

  // Concatenate OTP digits into a single OTP string
  var otpEntered = otp1 + otp2 + otp3 + otp4 + otp5 + otp6;

  // Make an AJAX request to verify the OTP
  $.ajax({
    type: "POST",
    url: "otp_verify.php", // Adjust the URL according to your backend endpoint
    dataType: "json", // Expect JSON response from server
    data: {
      otp: otpEntered
    },
    success: function(response) {
      console.log(response); // Check the type and content of response here
      
      // Handle different types of responses
      if (response && response.status === "success") {
        // Redirect to success page on successful verification
        window.location.href = "index.php";
      } else {
        console.log(response);
        document.getElementById('otp-error').innerText = response.message || "Invalid OTP. Please try again.";
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      // Handle AJAX request errors
      console.log(errorThrown);
      document.getElementById('otp-error').innerText = "Error verifying OTP. Please try again later.";
    }
  });
}


