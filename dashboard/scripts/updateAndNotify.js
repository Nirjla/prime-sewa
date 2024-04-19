function updateAndNotify(buttonId, status, id) {
  console.log(" ID:", id);
  $("#" + buttonId).text("Loading...");
  $.ajax({
    url: "updateAndNotify.php",
    data: { status: status, id: id },
    type: "POST",
    success: function (response) {
      $("#" + buttonId).hide();
      $("#message_" + id)
        .text(status === 1 ? "Accepted" : "Rejected")
        .show();
    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
    },
  });
}

$(document).ready(function () {
  $(".acceptButton").click(function () {
    var id = $(this).data("id");
    console.log(id);
    var buttonId = $(this).attr("id");
    updateAndNotify(buttonId, 1, id);
  });

  $(".rejectButton").click(function () {
    var id = $(this).data("id");
    var buttonId = $(this).attr("id");
    updateAndNotify(buttonId, 0, id);
  });
});
