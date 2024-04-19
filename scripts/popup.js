function openLoginPopup() {
  console.log("Ok");

  document.getElementById("loginPopup").style.display = "block";
}
function closeLoginPopup() {
  document.getElementById("loginPopup").style.display = "none";
}
window.addEventListener("click", function (event) {
  if (event.target === document.getElementById("loginPopup")) {
    closeLoginPopup();
  }
});

function checkEmail() {
  var email = document.getElementById("verify-email").value;
  // console.log(email);
  $.ajax({
    type: "POST",
    url: "verify-email.php",
    data: {
      email: email,
    },
    success: function (response) {
      console.log(response)
      if (response == 1) {
        document.getElementById("emailExists").innerHTML = "";
      } else {
        document.getElementById("emailExists").innerHTML =
          "Email doesn't exists";
        // return false;
      }
    },
  });
}

// toggle profile
// function toggleBtn(){
//   var roleList = document.getElementsByClassName("role_lists");
//   roleList.classList.toggle('show');
// }

$(document).ready(function () {
  $("#toggleBtn").click(function () {
    $("#roleList").toggle();
  });
});

