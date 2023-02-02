
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
$('#addappointmentform .closer_name, #addappointmentform .date_appointment').on('change', function () {
    $('#addappointmentform .starttime option').prop('disabled', false
      ).css("color", "#000000").css("background", "none");
      $.ajax({

        type: "POST",

        url: base_url +  "appointment/set_appointment_time",

        dataType: 'json',

        data: $("#addappointmentform").serialize(),

        success: function(res) {
        if (res.response=="success"){
          $('#addappointmentform  .starttime').each(function() {
            var val = res.start_time;
            for (var i = 0; i < val.length; i++) {
              $('#addappointmentform .starttime').find('option').filter(function() {
                return this.value === val[i].appt_start_time;
              }).prop('disabled', true).css("color", "#5b5555").css("background", "#661a1a");
            }
          });
        }
        // else{
        //     $('#addappointmentform .starttime option').prop('disabled', true);

        // }


      

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
             location.reload();


      },2000);
   }

    else{

       $("#update_appointment_form .alert-success").removeClass("alert-success").addClass("alert-danger");

       $("#update_appointment_form .alert-danger").css("display", "block");

       $("#update_appointment_form .alert-danger p").html(res.message);

       setTimeout(function(){

               $("#update_appointment_form .alert-danger").css("display", "none");

           },1000);


   }

},

});



});


//appointment view lead communication history

      // $(document).on('click','.viewleadremark_history_appt',function(e) {

      //       var project_id= $(this).data('project_id');
      //        //alert(project_id);
      //       dataEdit = 'project_id='+ project_id;
      //       var tr= '';
      //       var tr_status_lead= '';
      //       var tr_appointment= '';
      //             $.ajax({
      //             type:'GET',
      //             data:dataEdit,
      //             url: base_url +'dashboard/view_lead_remark_history/'+ project_id,
      //             dataType: 'json',
      //             success:function(data){
      //                 for (var i = 0; i < data.length; i++) {
      //                   tr += '<tr>'+
      //                             '<td>'+data[i].from_user+'</td>'+
      //                             '<td>'+data[i].from_usertype+'</td>'+
      //                             '<td>'+data[i].create_remark+'</td>'+
      //                             '<td>'+new Date(data[i].date_create_remark).toLocaleString([], { hour12: true})+'</td>'+
      //                          '</tr>'; 
      //                    }
      //                   $('#viewleadremarkhistorymodal .viewleadremarkhistory').html(tr);

      //                for (var i = 0; i < data.length; i++) {
      //                   tr_status_lead += '<tr>'+
      //                             '<td>'+data[i].firstname + ' ' + data[i].lastname +'</td>'+
      //                             '<td>'+data[i].collection_status+'</td>'+
      //                             '<td>'+new Date(data[i].alter_date_commitment).toLocaleString([], { hour12: true})+'</td>'+
      //                          '</tr>'; 
      //                    }
      //                   $('#viewleadremarkhistorymodal .viewlead_status_history').html(tr_status_lead);

      //                   for (var i = 0; i < data.length; i++) {
      //                     tr_appointment  += '<tr>'+
      //                              '<td><a href="'+base_url+'appointment" target="blank">'+data[i].m_fname + ' ' + data[i].m_lname +'</a></td>'+
      //                              '<td>'+moment(data[i].appt_schedule).format('YYYY/MM/DD')+'</td>'+
      //                              '<td>'+moment(data[i].appt_start_time, "HH:mm:ss").format('hh:mm a') + ' - ' + moment(data[i].appt_end_time, "HH:mm:ss").format('hh:mm A') +'</td>'+
      //                              '<td>'+data[i].appt_status+'</td>'+
      //                              '<td>'+moment(data[i].appt_date_creaE).format('YYYY/MM/DD hh:mm A')+'</td>'+
      //                               '</tr>'; 
      //                      }
      //                     $('#viewleadremarkhistorymodal .viewapointment_history').html(tr_appointment);
      //                   $(".viewleadremarkhistory td").filter(function() {
      //                           return $(this).text() == 'undefined';
      //                       }).closest("tr").remove();
      //                    $(".viewlead_status_history td").filter(function() {
      //                           return $(this).text() == 'undefined undefined';
      //                       }).closest("tr").remove();
      //                   $(".viewapointment_history td").filter(function() {
      //                         return $(this).text() == 'undefined undefined';
      //                     }).closest("tr").remove();
      //                    $('#historyremarkleadtable').DataTable({"sPaginationType": "listbox"});
      //                    $('#historylead_assigntable').DataTable({"sPaginationType": "listbox"});
      //                    $('#history_appointmenttable').DataTable({"sPaginationType": "listbox"});

      //             }
      //      });
      //  });



      // 