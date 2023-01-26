  <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   class Appointment_Model extends CI_Model {

      function __construct() {

         parent::__construct();


      }

      public function insert($data) {

         if ($this->db->insert("tblappointment", $data)) {
            return true;

         }

      }
      
      public function insert_appointment_remark($data) {

         if ($this->db->insert("tblappointment_remark", $data)) {

            return true;

         }

      }

      //tblpoints
      public function insert_points($data) {

         if ($this->db->insert("tblpoints", $data)) {

            return true;

         }

      }

      // history of appointment
      public function view_appointment_history($project_id){ 

        $this->db->select('appointment.*, lead.*, user.firstname as m_fname, user.lastname as m_lname')->from('tblappointment as appointment')

        ->join('tbllead as lead', 'appointment.appt_project_id = lead.project_id', 'inner')
        ->join('tbluser as user', 'appointment.appt_closer_id = user.user_id', 'inner')

        ->where('lead.project_id', $project_id)
        ->order_by('appointment.appt_date_create','desc');

        $query=$this->db->get();

        return $query->result_array();

        $this->db->close();

      }  

      // history of appointment agent
      public function view_list_appointment($user_id){ 

        $this->db->select('appointment.*, lead.*, user.firstname as m_fname, user.lastname as m_lname, agent.firstname as a_fname,agent.lastname as a_name')->from('tblappointment as appointment')

        ->join('tbllead as lead', 'appointment.appt_project_id = lead.project_id', 'inner')
        ->join('tbluser as user', 'appointment.appt_closer_id = user.user_id', 'inner')
        ->join('tbluser as agent', 'appointment.appt_agent_id = agent.user_id', 'inner');

        if ($this->session->userdata['userlogin']['usertype'] == "Agent"){
            $this->db->where('appointment.appt_agent_id', $user_id);
        }
        else if($this->session->userdata['userlogin']['usertype'] == "Manager"){
            $this->db->where('appointment.appt_closer_id', $user_id);
        }
            $this->db->group_by('appointment.appt_project_id');
            $this->db->group_by('appointment.appt_schedule');
            $this->db->order_by('appointment.appt_date_create','desc');

        $query=$this->db->get();

        return $query->result_array();

        $this->db->close();

      } 
   
      public function view_appointment_detail($appt_id){ 

        $this->db->select('appointment.*, lead.*, user.firstname as m_fname, user.lastname as m_lname, agent.firstname as a_fname,agent.lastname as a_name')->from('tblappointment as appointment')

        ->join('tbllead as lead', 'appointment.appt_project_id = lead.project_id', 'inner')
        ->join('tbluser as user', 'appointment.appt_closer_id = user.user_id', 'inner')
        ->join('tbluser as agent', 'appointment.appt_agent_id = agent.user_id', 'inner')

        ->where('appointment.appt_id', $appt_id)
        ->group_by('appointment.appt_project_id')
        ->group_by('appointment.appt_schedule')
        ->order_by('appointment.appt_date_create','desc');

        $query=$this->db->get();

        return $query->result_array();

        $this->db->close();

      } 

      public function select_schedule_appointment($closer_id, $date, $time){ 
        $this->db->select('*')->from('tblappointment')
        ->where('appt_closer_id', $closer_id)
        ->where('appt_schedule', $date)
        ->where('appt_start_time', $time)
        ->where('appt_status !=', "Closed");
        // ->where('appt_start_time BETWEEN "'. date('H:i:s', strtotime($time)). '" and "'. date('H:i:s', strtotime($time)).'"');
        $query=$this->db->get();

        if ($query->num_rows() == 1){

            return true;

        }
        else{

            return false;

        }

      }

      public function select_schedule_exist_appointment($closer_id, $date){ 
        $this->db->select('*')->from('tblappointment')
        ->where('appt_closer_id', $closer_id)
        ->where('appt_schedule', $date)
        ->where('appt_status !=', "Closed");
        // ->where('appt_start_time BETWEEN "'. date('H:i:s', strtotime($time)). '" and "'. date('H:i:s', strtotime($time)).'"');
        $query=$this->db->get();

        if ($query->num_rows() > 0){
            return $query->row_array();

        }
        else{

            return false;

        }

      }
   
      public function select_appointment_remarks($appt_id){ 
        $this->db->select('*')->from('tblappointment_remark as remark')
        ->join('tbluser as user', 'user.user_id = remark.user_id')
        ->where('remark.appt_id', $appt_id);
        $query=$this->db->get();
        return $query->result_array();
        $this->db->close();
      }
      public function select_appointment_remark_status($appt_id){ 
        $this->db->select('*')->from('tblappointment_remark as remark')
        ->join('tbluser as user', 'user.user_id = remark.user_id')
        ->where('remark.appt_id', $appt_id);
        $query=$this->db->get();
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return false;

        }
        $this->db->close();
      }
      
      
      public function select_appointment_status($appt_id){ 
        $this->db->select('tblappointment.appt_status')->from('tblappointment')
        ->where('tblappointment.appt_id', $appt_id);
        $query=$this->db->get();
        if ($query->num_rows() > 0){
          return $query->row_array();
      }
        else{
           return false;

      }
        $this->db->close();
      }

   
      public function update_appointmet_status($data, $appt_id) { 

        $this->db->set($data); 

        $this->db->where("appt_id", $appt_id); 

        $this->db->update("tblappointment"); 

     }
    
     public function update_appointment_remark($appt_id) { 

      $this->db->set('status_remark', 1); 

      $this->db->where("appt_id", $appt_id); 

      $this->db->update("tblappointment_remark"); 

   }

      public function select_user_specify_notify(){

        $this->db->select('*')->from('tblcoaching')
        ->where_in('usertype', array('Production', 'Manager', 'Author Relation'))
        ->where('status_user', 'Active');

        $query=$this->db->get();

        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }
       public function select_user_specify_notify_all(){

        $this->db->select('*')->from('tblcoaching')
        ->where_in('usertype', array('Production', 'Manager', 'Author Relation', 'Admin'))
        ->where('status_user', 'Active');

        $query=$this->db->get();

        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

      public function select_user_specify_notify_remark(){

        $this->db->select('*')->from('tblcoaching')
        ->where_in('usertype', array('Production', 'Manager', 'Author Relation', 'Admin', 'Agent'))
        ->where('status_user', 'Active');

        $query=$this->db->get();

        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

        public function all_attendance_user(){

        $this->db->select('*')->from('tblcoaching')
        ->where_in('usertype', array('Manager', 'Human Resources', 'IT'))
        ->where('status_user', 'Active');

        $query=$this->db->get();

        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }




      public function select_user_agent_and_manager(){

        $this->db->select('*')->from('tblcoaching')
        ->where_in('usertype', array('Agent', 'Manager'))
        ->where('status_user', 'Active');

        $query=$this->db->get();

        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

       public function select_user_IT(){

        $this->db->select('*')->from('tblcoaching')
        ->where_in('usertype', array('IT'))
        ->where('status_user', 'Active');

        $query=$this->db->get();

        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

      public function select_user_interiordesigner(){

        $this->db->select('*')->from('tblcoaching')->where(array('usertype ' => 'Interior Designer', 'status_user' => 'Active'));

        $query=$this->db->get();



        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }


      public function select_user_agent(){

        $this->db->distinct()->select('*')->from('tblcoaching')->where(array('usertype ' => 'Agent', 'status_user' => 'Active'));

        $query=$this->db->get();



        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

         public function select_user_agent_manager(){

        $this->db->distinct()->select('*')->from('tblcoaching')->where('usertype', 'Manager')->or_where('usertype ','Agent')
        ->where('status_user', 'Active')->order_by('firstname', 'asc');

        $query=$this->db->get();



        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

       public function select_user_agent_sales(){

        $this->db->distinct()->select('*')->from('tblcoaching')->where(array('usertype ' => 'Agent', 'status_user' => 'Active'));

        $query=$this->db->get();



        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

      public function select_coaching_list($agent_name){

        $this->db->select('*')->from('tblcoaching')->where('agent_name', $agent_name);

        $query=$this->db->get();


        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

      public function view_assign_user($user_id){

        $this->db->select('user.*, assign_user.*')->from('tblcoaching as user')

        ->join('tblassignuser as assign_user', 'user.user_id = assign_user.user_id', 'inner')

        ->where('assign_user.user_id_assign', $user_id)
        ->where('user.usertype', 'Manager')

        ->order_by('assign_user.date_assign','ASC');

        $query=$this->db->get();



        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

         public function view_assign_agent($user_id){

        $this->db->select('user.*, assign_user.*')->from('tblcoaching as user')

        ->join('tblassignuser as assign_user', 'user.user_id = assign_user.user_id', 'inner')

        ->where('assign_user.user_id_assign', $user_id)
        ->where('user.usertype', 'Agent')

        ->order_by('assign_user.date_assign','ASC');

        $query=$this->db->get();



        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

       public function select_user_id($user_id){

        $this->db->select('*')->from('tblcoaching')->where(array('user_id ' => $user_id));

        $query=$this->db->get();



        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }
     public function select_coaching_user($agent_name){

        $this->db->select('*')->from('tblcoaching')->where(array('agent_name ' => $agent_name))->order_by('coaching_id','DESC')->limit(1);


        $query=$this->db->get();



        if ($query->num_rows() > 0){

          return $query->row_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }
      public function select_coaching_id($coaching_id){

        $this->db->select('*')->from('tblcoaching')->where(array('coaching_id ' => $coaching_id));


        $query=$this->db->get();



        if ($query->num_rows() > 0){

          return $query->row_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }
      public function select_code_user($user_id, $idle_code){

        $this->db->select('*')->from('tblcoaching')->where(array('user_id ' => $user_id, 'idle_code' => $idle_code));

        $query=$this->db->get();



        if ($query->num_rows() > 0){

          return true;

        }

        else{

            return false;

        }

        $this->db->close();

      }
      public function select_userassign_id($user_id){

        $this->db->select('*')->from('tblassignuser')->where(array('user_id ' => $user_id));

        $query=$this->db->get();



        if ($query->num_rows() == 1){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

      public function select_log_agent_history($user_id){

        $this->db->select('*')->from('tblcoachinglog')->where(array('user_id ' => $user_id));

        $query=$this->db->get();



        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

      public function select_duty_agent($user_id){

        $this->db->select('*')->from('tbltracker')->where(array('user_id ' => $user_id));

        $query=$this->db->get();



        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

      public function change_password($user_id, $password, $new_password){

        $key = $this->config->item('encryption_key');

        $salt1 = hash('sha512', $key . $password);

        $salt2 = hash('sha512', $password . $key);

        $hashed_password = hash('sha512', $salt1 . $password . $salt2);

        $this->db->select('*')->from('tblcoaching')->where(array('user_id ' => $user_id, 'password' => $hashed_password));

        $query = $this->db->get();

         if ($query->num_rows() > 0){

              return  $this->db->where(array('user_id ' => $user_id, 'password' => $hashed_password))->update('tblcoaching', array('password' => $new_password));

        }

        else{

          return false;

        }

        $this->db->close();

      }

      public function view_alluser(){

        $this->db->select('*')->from('tblcoaching');

        $query=$this->db->get();



        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

      public function update_evaluation_score($data, $criteria_id) { 

         $this->db->set($data); 

         $this->db->where("criteria_id", $criteria_id); 

         $this->db->update("tblcriteria"); 

      }

      public function update_evaluation_totalscore($data, $evaluation_id) { 

         $this->db->set($data); 

         $this->db->where("evaluation_id", $evaluation_id); 

         $this->db->update("tblevaluation"); 

      }  


      public function update_coaching($data, $coaching_id) { 

         $this->db->set($data); 

         $this->db->where("coaching_id", $coaching_id); 

         $this->db->update("tblcoaching"); 

      } 

       public function update_attempt($emailaddress) { 

         $this->db->set('attempt', 'attempt-1', FALSE); 

         $this->db->where("emailaddress", $emailaddress); 

         $this->db->update("tblcoaching"); 

      }

      public function update_userlog($emailaddress, $password) { 

         $this->db->set('log_date', 'NOW()', FALSE); 

         $this->db->set('userlogin', 'login'); 

         $this->db->where("emailaddress", $emailaddress);

         $this->db->where("password", $password);

         $this->db->update("tblcoaching"); 

      } 

      public function all_users(){

        $this->db->select('*')->from('tblcoaching');

        $query=$this->db->get();



        if ($query->num_rows() == 1){

          return $query->result_array();

        }

        else{

            return false;

        }

        $this->db->close();

      }

       public function get_emailaddress($emailaddress){

        $this->db->select('*')->from('tblcoaching')->where('emailaddress', $emailaddress);

        $query = $this->db->get();



        if ($query->num_rows() > 0){

            return $query->result();

        }

        else{

            return false;

        }

        $this->db->close();



      }

      public function reset_password($emailaddress, $password){

        $this->db->select('*')->from('tblcoaching')->where('emailaddress', $emailaddress);

        $query = $this->db->get();

         if ($query->num_rows() > 0){

              return  $this->db->where('emailaddress', $emailaddress)->update('tblcoaching', array('password' => $password));

        }

        else{

          return false;

        }

        $this->db->close();



      }


        public function select_user_penalty($user_id){
        $this->db->select('*')->from('tblpenalty')->where('user_id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0){
          return $query->result_array();
        }
        else{
            return false;
        }
        $this->db->close();
      }

        public function select_user_emailaddress($user_id){

        $this->db->select('emailaddress')->from('tblcoaching')->where('user_id', $user_id);

        $query=$this->db->get();

        if ($query->num_rows() > 0){

          return $query->result_array();

        }

        else{

            return false;

        }
    }


      //  public function view_evaluation($evaluation_id){ 

      //   $this->db->select('evaluation.*, criteria.*, points.*')->from('tblevaluation as evaluation')

      //   ->join('tblcriteria as criteria', 'evaluation.evaluation_id = criteria.evaluation_id', 'inner')
      //   ->join('tblpoints as points', 'evaluation.evaluation_id = points.evaluation_id', 'inner')
      //   ->where('evaluation.evaluation_id', $evaluation_id);
      //   // ->order_by('collection.collection_id','DESC');

      //   $query=$this->db->get();

      //   if ($query->num_rows() > 0){

      //      return $query->result_array();

      //   }
      //   else{

      //       return 'false';

      //   }

      //   $this->db->close();

      // }


       public function view_evaluation($evaluation_id){ 

        $this->db->select('*')->from('tblevaluation as evaluation')

        ->join('tbluser as user', 'evaluation.to_user_id = user.user_id', 'inner')

        ->where('evaluation_id', $evaluation_id);

        $query=$this->db->get();

        if ($query->num_rows() > 0){

           return $query->result_array();

        }
        else{

            return 'false';

        }

        $this->db->close();

      }

        public function view_evaluation_coaching($evaluation_id){ 

        $this->db->select('*')->from('tblevaluation as evaluation')

        ->join('tbluser as user', 'evaluation.to_user_id = user.user_id', 'inner')

        ->where('evaluation_id', $evaluation_id);

        $query=$this->db->get();

        if ($query->num_rows() > 0){

           return $query->row_array();

        }
        else{

            return 'false';

        }

        $this->db->close();

      }

       public function view_evaluation_agent($evaluation_id){ 

        $this->db->select('*')->from('tblevaluation as evaluation')

        ->join('tbluser as user', 'evaluation.from_user_id = user.user_id', 'inner')

        ->where('evaluation_id', $evaluation_id);

        $query=$this->db->get();

        if ($query->num_rows() > 0){

           return $query->result_array();

        }
        else{

            return 'false';

        }

        $this->db->close();

      }

       public function view_criteria($evaluation_id){ 

        $this->db->select('*')->from('tblcriteria')

        ->where('evaluation_id', $evaluation_id);

        $query=$this->db->get();

        if ($query->num_rows() > 0){

           return $query->result_array();

        }
        else{

            return 'false';

        }

        $this->db->close();

      }

       public function view_points($evaluation_id){ 

        $this->db->select('*')->from('tblpoints as points')

        ->join('tblcriteria as criteria', 'criteria.criteria_id = points.criteria_id', 'inner')

        ->where('criteria.evaluation_id', $evaluation_id);

        $query=$this->db->get();

        if ($query->num_rows() > 0){ 

           return $query->result_array();

        }
        else{

            return 'false';

        }

        $this->db->close();

      }

   }

?>

