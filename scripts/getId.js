$(document).ready(function () {
  $(".event_btn").click(function () {
    const userId = $(this).data("user-id");
    const eventId = $(this).data("event-id");
    //     console.log(userId);
    $(this).attr("disabled", "disabled");
    $.ajax({
      url: "insert-volunteer-request.php",
      method: "POST",
      data: {
        user_id: userId,
        event_id: eventId,
      },
      success: function (response) {
        console.log(response);
      },
      error: function (error) {
        console.error("Error:", error);
      },
    });
  });
});
