<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends MY_Controller {

  function __construct() {

         parent::__construct();

         date_default_timezone_set('Asia/Manila');

         modules::run("account/is_logged_in");

  }
  public function index($id=""){

      modules::run("account/is_logged_in");
      $records['notification_appointment']  = $this->Appointment_Model->view_notification_user($this->session->userdata['userlogin']['user_id']);
      $records['count_apointmentnotifications']  = $this->Appointment_Model->select_count_notification($this->session->userdata['userlogin']['user_id']);

      $records['count_apointmentnotifications']  = $this->Appointment_Model->select_count_notification($this->session->userdata['userlogin']['user_id']);
     if($this->session->userdata['userlogin']['usertype'] == "Manager"){

      $user_charge = $this->session->userdata['userlogin']['firstname'] .' '. $this->session->userdata['userlogin']['lastname'];
      $records['notifications']  = $this->Notification_Model->view_notification_user($this->session->userdata['userlogin']['user_id'], $user_charge, $this->session->userdata['userlogin']['usertype']);
      $records['count_notifications']  = $this->Notification_Model->select_count_notification($this->session->userdata['userlogin']['user_id'], $user_charge, $this->session->userdata['userlogin']['usertype']);
      $records['appointments']= $this->Appointment_Model->view_list_appointment($this->session->userdata['userlogin']['user_id']);
      $records['status_appointment']= $this->Appointment_Model->select_appointment_status($this->uri->segment(3));

         $this->load->view('appointment_list_manager', $records);
     
     }

     else if($this->session->userdata['userlogin']['usertype'] == "Agent"){

      $user_charge = $this->session->userdata['userlogin']['firstname'] .' '. $this->session->userdata['userlogin']['lastname'];
      $records['notifications']  = $this->Notification_Model->view_notification_user($this->session->userdata['userlogin']['user_id'], $user_charge, $this->session->userdata['userlogin']['usertype']);
      $records['count_notifications']  = $this->Notification_Model->select_count_notification($this->session->userdata['userlogin']['user_id'], $user_charge, $this->session->userdata['userlogin']['usertype']);
      $records['appointments']= $this->Appointment_Model->view_list_appointment($this->session->userdata['userlogin']['user_id']);
      $records['status_appointment']= $this->Appointment_Model->select_appointment_status($this->uri->segment(3));

      $this->load->view('appointment_list_agent', $records);
  
       }

    }

    public function appointment_detail($id=""){

      $records['notification_appointment']  = $this->Appointment_Model->view_notification_user($this->session->userdata['userlogin']['user_id']);
      $records['count_apointmentnotifications']  = $this->Appointment_Model->select_count_notification($this->session->userdata['userlogin']['user_id']);
      if($this->session->userdata['userlogin']['usertype'] == "Agent"){
   
       $user_charge = $this->session->userdata['userlogin']['firstname'] .' '. $this->session->userdata['userlogin']['lastname'];
       $records['notifications']  = $this->Notification_Model->view_notification_user($this->session->userdata['userlogin']['user_id'], $user_charge, $this->session->userdata['userlogin']['usertype']);
       $records['count_notifications']  = $this->Notification_Model->select_count_notification($this->session->userdata['userlogin']['user_id'], $user_charge, $this->session->userdata['userlogin']['usertype']);
       $records['appointments']= $this->Appointment_Model->view_appointment_detail($this->uri->segment(3));
       $records['comments'] = $this->Appointment_Model->select_appointment_remarks($this->uri->segment(3));
       $records['status_appointment']= $this->Appointment_Model->select_appointment_status($this->uri->segment(3));

 
       $this->load->view('appointment_detail_agent', $records);
 
      }
      else if($this->session->userdata['userlogin']['usertype'] == "Manager"){
   
        $user_charge = $this->session->userdata['userlogin']['firstname'] .' '. $this->session->userdata['userlogin']['lastname'];
        $records['notifications']  = $this->Notification_Model->view_notification_user($this->session->userdata['userlogin']['user_id'], $user_charge, $this->session->userdata['userlogin']['usertype']);
        $records['count_notifications']  = $this->Notification_Model->select_count_notification($this->session->userdata['userlogin']['user_id'], $user_charge, $this->session->userdata['userlogin']['usertype']);
        $records['appointments']= $this->Appointment_Model->view_appointment_detail($this->uri->segment(3));
        $records['comments'] = $this->Appointment_Model->select_appointment_remarks($this->uri->segment(3));
        $records['status_appointment']= $this->Appointment_Model->select_appointment_status($this->uri->segment(3));
 
  
        $this->load->view('appointment_detail_manager', $records);
  
       }
  
 
   }

   //add appointment
  public function add_appointment(){

    $user_charge = $this->session->userdata['userlogin']['firstname'] .' '. $this->session->userdata['userlogin']['lastname'];
    $get_time = $this->Appointment_Model->select_schedule_appointment($this->session->userdata['userlogin']['user_id'] ,$this->input->post('manager_id'), date('Y-m-d', strtotime($this->input->post('date_appointment'))), date("H:i:s", strtotime($this->input->post('starttime'))));

   $this->form_validation->set_rules('manager_id','Closer Name','trim|required|xss_clean');          

   $this->form_validation->set_rules('appointment_status','Appointment Status','trim|xss_clean|required');  


   $this->form_validation->set_rules('date_appointment','Date Appointment','trim|required|xss_clean');   

   $this->form_validation->set_rules('starttime','Time Appointment','trim|xss_clean|required');  


   if ($this->form_validation->run() == FALSE){
      echo json_encode(array("response" => "error", "message" => validation_errors()));
   } 
  else if($get_time == true){
     echo json_encode(array("response" => "error", "message" => "This time is not available to you. Please choose another appointment time."));
   }
 else{
     $data= array(
         'appt_closer_id' => $this->input->post('manager_id'),
         'appt_agent_id' => $this->session->userdata['userlogin']['user_id'],
         'appt_project_id' => $this->input->post('project_id'),
         'appt_schedule' => date('Y-m-d H:i:s',  strtotime($this->input->post('date_appointment'))),
         'appt_start_time' => date('H:i:s', strtotime($this->input->post('starttime'))),
         'appt_end_time' => date('H:i:s', strtotime('+30 minutes', strtotime($this->input->post('starttime')))),
         'appt_status'  =>  $this->input->post('appointment_status'),   
         'appt_date_create' => date('Y-m-d H:i:s')
       );

           $this->Appointment_Model->insert($data);
           echo json_encode(array("response" =>   "success", "message" => "Successfully Plotted Appointment Schedule"));

                  $data_notification= array(
                               'to_user_id' => $this->input->post('manager_id'),
                               'from_user' => $user_charge,
                               'id' => $this->db->insert_id(),
                               'message' => 'Added Schedule Appointment',
                               'link' =>  'direct',
                               'unread' => 1,
                               'date_notify' => date('Y-m-d H:i:s'),
                             );
                   $this->Appointment_Model->insertnotification_points($data_notification);
          
     }
  }


   public function add_appointment_remark(){

    $history_agent=array();

    $user_charge = $this->session->userdata['userlogin']['firstname'] .' '. $this->session->userdata['userlogin']['lastname'];

    $usertype = $this->session->userdata['userlogin']['usertype'];

    $this->form_validation->set_rules('remark','Remark','trim|required|xss_clean');        


  if ($this->form_validation->run() == FALSE){

       echo json_encode(array("response" => "error", "message" => validation_errors()));

  } 

  else{
        $receive_user_notify = $this->User_Model->select_user_specify_notify_remark($this->session->userdata['userlogin']['user_id']);
        $receive_agent_notification = $this->Lead_Model->select_project_id($this->input->post('project_id'));

       $data =  array(

                            'appt_id' => $this->input->post('appt_id'),
                            'user_id'  => $this->session->userdata['userlogin']['user_id'],
                            'appt_remark'  => $this->input->post('remark'),
                            'unread' => 1,

                        );

       $this->Appointment_Model->insert_appointment_remark($data);

            $data_notification= array(
              'to_user_id' => $this->session->userdata['userlogin']['usertype'] =="Agent" ? $this->input->post('manager_id') : $this->input->post('agent_id'),
              'from_user' => $user_charge,
              'id' => $this->db->insert_id(),
              'message' => 'Added Remark On Appointment',
              'link' =>   $this->agent->referrer(),
              'unread' => 1,
              'date_notify' => date('Y-m-d H:i:s'),
            );
            
            $this->Appointment_Model->insertnotification_points($data_notification);

            echo json_encode(array("response" =>   "success", "message" => "Successfully Added Remark", "redirect" => base_url('dashboard')));

      }
 }

 
 public function view_notification() { 
  $data=array();


  $records['notification_appointment']  = $this->Appointment_Model->view_notification_user($this->session->userdata['userlogin']['user_id']);
  $records['count_apointmentnotifications']  = $this->Appointment_Model->select_count_notification($this->session->userdata['userlogin']['user_id']);
  $this->Appointment_Model->update_notification($this->session->userdata['userlogin']['user_id']); 
   echo json_encode('success');

 }

 public function set_appointment_time(){

  $history_agent=array();

  $user_charge = $this->session->userdata['userlogin']['firstname'] .' '. $this->session->userdata['userlogin']['lastname'];

  $usertype = $this->session->userdata['userlogin']['usertype'];

   $get_time = $this->Appointment_Model->select_schedule_exist_appointment($this->input->post('manager_id'), date('Y-m-d', strtotime($this->input->post('date_appointment'))));

   if($get_time !=false){
      echo json_encode(array("response" => "success", "start_time" => $get_time));
   }
  else{
      echo json_encode(array("response" => "error", "start_time" => "00:00:00"));

  }

}


 public function update_appointment_status(){

  $history_agent=array();

  $user_charge = $this->session->userdata['userlogin']['firstname'] .' '. $this->session->userdata['userlogin']['lastname'];

  $usertype = $this->session->userdata['userlogin']['usertype'];



      $receive_user_notify = $this->User_Model->select_user_specify_notify_remark($this->session->userdata['userlogin']['user_id']);
      $receive_agent_notification = $this->Lead_Model->select_project_id($this->input->post('project_id'));

     $data =  array(

                          'appt_id' => $this->input->post('appt_id'),
                          'appt_status'  => $this->input->post('appt_status'),
                      );

     $this->Appointment_Model->update_appointmet_status($data, $this->input->post('appt_id'));

        $data_notification= array(
          'to_user_id' => $this->session->userdata['userlogin']['usertype'] =="Agent" ? $this->input->post('manager_id') : $this->input->post('agent_id'),
          'from_user' => $user_charge,
          'id' => $this->db->insert_id(),
          'message' => 'Updated Status On Appointment',
          'link' =>   $this->agent->referrer(),
          'unread' => 1,
          'date_notify' => date('Y-m-d H:i:s'),
        );
        
        $this->Appointment_Model->insertnotification_points($data_notification);

   
    
 
    echo json_encode(array("response" =>   "success", "message" => "Successfully Updated Appointment Status", "redirect" => base_url('dashboard')));

}


  public function companyEvaluation(){


     if($this->session->userdata['userlogin']['usertype'] == "Agent"){
  
      $user_charge = $this->session->userdata['userlogin']['firstname'] .' '. $this->session->userdata['userlogin']['lastname'];
      $records['notifications']  = $this->Notification_Model->view_notification_user($this->session->userdata['userlogin']['user_id'], $user_charge, $this->session->userdata['userlogin']['usertype']);
      $records['count_notifications']  = $this->Notification_Model->select_count_notification($this->session->userdata['userlogin']['user_id'], $user_charge, $this->session->userdata['userlogin']['usertype']);
      $records['team_evaluations']= $this->Evaluation_Model->view_companyevaluation_agent($this->session->userdata['userlogin']['user_id']);



      $this->load->view('company_evaluation_list_agent', $records);

     }

  }

   

  //add and/or update evaluation score
  public function add_evaluation_score(){
   $user_charge = $this->session->userdata['userlogin']['firstname'] .' '. $this->session->userdata['userlogin']['lastname'];
    $criterias = $this->input->post('criteria-id') ? $this->input->post('criteria-id') : array();

    $scoresum = $this->input->post('score') ? $this->input->post('score') : array();

    $evaluation_id = $this->input->post('evaluation_id');

    $class_comment = trim($this->input->post('class-comment'));

    $manager_comment = trim($this->input->post('manager-comment'));

    $total_points = $this->input->post('evaluation_points');

    $passing_score = $total_points * 0.8;



       $this->form_validation->set_rules('score[]','Score','trim|xss_clean|required'); 

       $this->form_validation->set_rules('criteria-id[]','Criteria Id','trim|xss_clean|required');   
      
       $get_last_id_criteria = array();
      
      if ($this->form_validation->run() == FALSE){
          echo json_encode(array("response" => "error", "message" => validation_errors()));
        }

       else{

            foreach ($criterias as $criteria => $i) {
                    $data = array(
                                   'score' => $scoresum[$criteria],                                   
                              );

                              $this->Evaluation_Model->update_evaluation_score($data, $i);

                    }
                    
                    $data1 = array(
                       'total_score' => array_sum($scoresum),
                             );
                
                             $this->Evaluation_Model->update_evaluation_totalscore($data1, $evaluation_id); 


            } 
             $user_notify = $this->Evaluation_Model->select_evaluation_id($evaluation_id); 
             $data_notification = array(

                     'from_user' => $user_charge,
                     'to_user' => 'All',
                     'message' => "Evaluated your Score",
                     'unread' => 1,
                     'date_notify' => date('Y-m-d H:i:s'),
                     'link' =>  dirname(base_url(uri_string())),
                     'to_user_id' => $user_notify['to_user_id'],
                     'from_usertype' => $this->session->userdata['userlogin']['usertype']
                   );
                  $this->Notification_Model->insert($data_notification);



            if (array_sum($scoresum) >= $passing_score) {
                
                 echo json_encode(array("response" => "success", "message" => "Evaluate score successfully submitted", "redirect" => base_url('evaluation')));
            }
            else{
                
                echo json_encode(array("response" => "success", "message" => "Evaluate score successfully submitted", "redirect" => base_url('coaching/coaching_form/'.$evaluation_id)));
            }
          
    }


}

?>