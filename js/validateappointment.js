
  // add appointment
  $(document).on('click','#addappointmentform #add_appointment',function(e) {
      $.ajax({

        type: "POST",

        url: base_url +  "appointment/add_appointment",

        dataType: 'json',

        data: $("#addappointmentform").serialize(),

        success: function(res) {

      if (res.response=="success"){

          $("#addappointmentform .alert-danger").removeClass("alert-danger").addClass("alert-success");

          $("#addappointmentform .alert-success").css("display", "block");

          $("#addappointmentform .alert-success p").html(res.message);


          setTimeout(function(){

                location.reload();

              }, 2000);



      }

        else{

          $("#addappointmentform .alert-success").removeClass("alert-success").addClass("alert-danger");

          $("#addappointmentform .alert-danger").css("display", "block");

          $("#addappointmentform .alert-danger p").html(res.message);

          setTimeout(function(){

                  $("#addappointmentform .alert-danger").css("display", "none");

              },3000);





      }

  },

  });
    
  });

  

      // Addd attendance form
$(document).on('change','#selectForm',function(e) {
//alert('success');

var form = document.getElementById("selectForm").value;

if(form == 'Company Evaluation'){
    $('#to_user1').prop('hidden', true);
    $('#to_user1').prop('disabled', true);
    $('#to_user2').prop('hidden', false);
    $('#to_user2').prop('disabled', false);
    $('#from_user1').prop('hidden', true);
    $('#from_user1').prop('disabled', true);
    $('#from_user2').prop('hidden', false);
    $('#from_user2').prop('disabled', false);
}
else if(form == 'Employee Evaluation'){
    $('#to_user1').prop('hidden', false);
    $('#to_user1').prop('disabled', false);
    $('#to_user2').prop('hidden', true);
    $('#to_user2').prop('disabled', true);
    $('#from_user1').prop('hidden', false);
    $('#from_user1').prop('disabled', false);
    $('#from_user2').prop('hidden', true);
    $('#from_user2').prop('disabled', true);
}

 });   