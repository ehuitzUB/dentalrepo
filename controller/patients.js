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

function addPatient(bucket){
  if(bucket.action.value == "addPatient"){
    $.ajax({
      method: "POST",
      url: "model/patient.php",
      data: {action: 'addPatient', patient: bucket}
    }).done(function(data){
      var results = JSON.parse(data);
    });
  }
}

function validateAddPatientForm() {
  let bucket = document.forms["addPatientForm"];
  let flag = true;

  $("#errorPatientPassword").hide();
  $("#errorPatientConfirm").hide();
  $("#errorPatientFName").hide();
  $("#errorPatientLName").hide();

  var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
  
  if (bucket.userpasswd.value.match(passw)) {
    if (bucket.userpasswd.value !== bucket.confirmuserpasswd.value) {
      $("#errorPatientConfirm").show();
      $("#errorPatientConfirm").text("The two passwords do not match.");
      flag = false;
    }
  } else {
    $("#errorPatientPassword").show();
    $("#errorPatientPassword").text("Use 6-20 numbers and letters (capital and small).");
    flag = false;
  }
  
  var letters = /^[A-Za-z]+$/;
  
  if (bucket.patientLName.value.length > 32) {

    $("#errorPatientLName").show();
    $("#errorPatientLName").text("Last name must be smaller than 32 characters.");
    flag = false;
  } else if (!bucket.patientLName.value.match(letters)) {
    $("#errorPatientLName").show();
    $("#errorPatientLName").text("Last name can only be letters.");
    flag = false;
  }

  if (bucket.patientFName.value.length > 32) {
    $("#errorPatientFName").show();
    $("#errorPatientFName").text("First name must be smaller than 32 characters.");
    flag = false;
  } else if (!bucket.patientFName.value.match(letters)) {
    $("#errorPatientFName").show();
    $("#errorPatientFName").text("First name can only be letters.");
    flag = false;
  }
  // if(flag === true) {
  //   addPatient(bucket);
  // }
  return flag;
} 