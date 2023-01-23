
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

  // add appointment remark
  $(document).on('click','#comment_form #add_comment',function(e) {
    $.ajax({
    type: "POST",
    url: base_url +'appointment/add_appointment_remark',
    dataType: 'json',
    data: $("#comment_form").serialize(), // serializes the form's elements.
    success: function(res) {
        if (res.response=="success"){
          location.reload();
            $("#comment_form .alert-danger").removeClass("alert-danger").addClass("alert-success");
            $("#comment_form .alert-success").css("display", "block");
            $("#comment_form .alert-success p").html(res.message);
            setTimeout(function(){
                    $("#file_form .alert-success").css("display", "none");
                },4000);

        }
         else{
            $("#comment_form .alert-success").removeClass("alert-success").addClass("alert-danger");
            $("#comment_form .alert-danger").css("display", "block");
            $("#comment_form .alert-danger p").html(res.message);
            setTimeout(function(){
                    $("#file_form .alert-danger").css("display", "none");
                },3000);
       }
    },
  });
});
  

// set appointment time
$('#addappointmentform .starttime').on('change', function () {
  $.ajax({

    type: "POST",

    url: base_url +  "appointment/set_appointment_time",

    dataType: 'json',

    data: $("#addappointmentform").serialize(),

    success: function(res) {

   if (res.response=="success"){

       $("#addappointmentform .alert-danger").removeClass("alert-danger").addClass("alert-success");

       $("#addappointmentform .alert-success").css("display", "block");

       $("#addappointmentform .alert-success p").html(res.message);

       setTimeout(function(){

        $("#addappointmentform .alert-success").css("display", "none");

      },3000);
   }

    else{

       $("#update_appointment_form .alert-success").removeClass("alert-success").addClass("alert-danger");

       $("#update_appointment_form .alert-danger").css("display", "block");

       $("#update_appointment_form .alert-danger p").html(res.message);
         $("html, body").animate({ scrollTop: 0 }, "slow");

       setTimeout(function(){

               $("#update_appointment_form .alert-danger").css("display", "none");

           },3000);


   }

},

});



});

// update status
$('#update_appointment_form .appt_status').on('change', function () {
  $.ajax({

    type: "POST",

    url: base_url +  "appointment/update_appointment_status",

    dataType: 'json',

    data: $("#update_appointment_form").serialize(),

    success: function(res) {

   if (res.response=="success"){

       $("#update_appointment_form .alert-danger").removeClass("alert-danger").addClass("alert-success");

       $("#update_appointment_form .alert-success").css("display", "block");

       $("#update_appointment_form .alert-success p").html(res.message);

       setTimeout(function(){

        $("#update_appointment_form .alert-success").css("display", "none");

      },3000);
   }

    else{

       $("#update_appointment_form .alert-success").removeClass("alert-success").addClass("alert-danger");

       $("#update_appointment_form .alert-danger").css("display", "block");

       $("#update_appointment_form .alert-danger p").html(res.message);
         $("html, body").animate({ scrollTop: 0 }, "slow");

       setTimeout(function(){

               $("#update_appointment_form .alert-danger").css("display", "none");

           },3000);


   }

},

});



});