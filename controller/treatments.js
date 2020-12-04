$(function () {
  $("#cancel_appointment_failure").hide();
  $("#cancel_appointment_success").hide();
});

function cancelAppointmentDoctor(id) {
  if (confirm("Are you sure you want to cancel the appointment?")) {
    $.ajax({
      method: "POST",
      url: "model/treatment.php",
      data: {
        "action": "cancelAppointment",
        "id": id
      },
    }).done(function (data) {
      var results = JSON.parse(data);
      if (results.state = "success") {
        $("#cancel_appointment_success").html("<strong>Success</strong>  " + results.message);
        $("#cancel_appointment_success").show();
        setTimeout(function () {
          location.reload();
        }, 2000);
      } else {
        $("#cancel_appointment_failure").html("<strong>Failure</strong>  " + results.message);
        $("#cancel_appointment_failure").show();
        setTimeout(function () {
          location.reload();
        }, 2000);
      }
    });
  }
}