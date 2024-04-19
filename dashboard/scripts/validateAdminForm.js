function validateAdminForm(value) {
  if (value) {
    var name = document.getElementById(value).value;

    console.log(name);
    document.getElementById(value + "Error").innerHTML = "";
  }
  if (value === "event-title") {
    console.log("yes");
    checkTitleExists(name, value);
  }
}

function checkTitleExists(eventTitle, value) {
  $.ajax({
    type: "POST",
    url: "check_title.php",
    data: {
      eventTitle: eventTitle,
    },
    success: function (response) {
      console.log(response);
      if (response === "1") {
        console.log(response);
        document.getElementById(value + "Error").innerHTML =
          "Title Already Exists!!";
      }
    },
  });
}
