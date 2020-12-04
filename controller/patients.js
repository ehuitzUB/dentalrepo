$(function () {
  $("#delete_patient_failure").hide();
  $("#delete_patient_success").hide();
});

function deletePatient(id) {
  if (confirm("Are you sure you wish to delete account " + id + "?")) {
    $.ajax({
      method: "POST",
      url: "model/patient.php",
      data: {
        "action": "delete",
        "id": id
      },
    }).done(function (data) {
      var results = JSON.parse(data);
      if (results.state = "success") {
        $("#delete_patient_success").html("<strong>Success</strong>  " + results.message);
        $("#delete_patient_success").show();
        setTimeout(function () {
          location.reload();
        }, 2000);
      } else {
        $("#delete_patient_failure").html("<strong>Failure</strong>  " + results.message);
        $("#delete_patient_failure").show();
        setTimeout(function () {
          location.reload();
        }, 2000);
      }
    });
  }
}