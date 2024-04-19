$(document).ready(function () {
      var eventDateInput = $("#event-date");
      var registerDeadline = $("#register-deadline");
      registerDeadline.prop("disabled", true);
      var currentDate = new Date().toISOString().split("T")[0];
      eventDateInput.prop("min", currentDate);
      registerDeadline.prop("min", currentDate);
      eventDateInput.on("change", function () {
        var selectedDate = eventDateInput.val();
        registerDeadline.prop("max", selectedDate);
        registerDeadline.prop('disabled',false)
      });
    });
    