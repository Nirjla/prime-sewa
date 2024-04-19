function updateStatusAndNotify(status, id) {
  $.ajax({
    url: "update-status-and-notify.php",
    method: "POST",
    data: {
      status: status,
      id: id,
    },
    success: function (response) {
      console.log(response);
      $("#" + id)
        .parents("tr")
        .remove();
      // if (status === 1) {
      //   window.location.href =
      //     "http://localhost/prime-sewa/dashboard/volunteers.php";
      // }
    },
    error: function (error) {
      console.error("error", error);
    },
  });
}
