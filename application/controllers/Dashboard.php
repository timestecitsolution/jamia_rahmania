<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * ***************Dashboard.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Dashboard
 * @description     : This class used to showing basic statistics of whole application 
 *                    for logged in user.  
 * @author          : Codetroopers Team   
 * @url             : https://themeforest.net/user/codetroopers    
 * @support         : yousuf361@gmail.com 
 * @copyright       : Codetroopers Team   
 * ********************************************************** */

class Dashboard extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Dashboard_Model', 'dashboard', true);  
        
    }

    public $data = array();

    /*  * ***************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Default function, Load logged in user dashboard stattistics  
     * @param           : null 
     * @return          : null 
     * ********************************************************** */

    public function get_balance() {
        $url = "https://bulksmsbd.net/api/getBalanceApi";
        $api_key = "YJ9PZbAQYtoPYZM7bHoU";
        $api_key = "YJ9PZbAQYtoPYZM7bHoU11";
        $data = [
            "api_key" => $api_key
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }


    public function index() {
        
       // $sms = json_decode($this->get_balance());
        $today = date('d');
        $to_day = date('Y-m-d');

        $this->db->select('*');
        $this->db->from('text_messages');
        $this->db->where('sms_type', 'duefee');
        $this->db->like('created_at', $to_day);
        $sms_status_due = $this->db->get()->result(); 
        $sms_status_due = array();
        if(count($sms_status_due) == 0)
        {
          $today = 100;
          if($today == 10)
          {
            $this->auto_due_sms();
          } 
          else if($today == 15)
          {
            $this->auto_due_sms();
          }  
          else if($today == 20)
          {
            $this->auto_due_sms();
          }
          else if($today == 22)
          {
            $this->auto_due_sms();
          }
          else if($today == 25)
          {
            $this->auto_due_sms();
          }
          else
          {
            
          }

        }
        

        
        if(!empty($sms))
        {
          $this->data['sms_balance'] = $sms->balance;
        }
        else
        {
          $this->data['school'] = 0.00;
          $this->data['sms_balance'] = 0.00;
        }
        
        $school_id = $this->session->userdata('school_id');   
        $theme = $this->session->userdata('theme');
        
        $this->data['theme'] = $this->dashboard->get_single('themes', array('status' => 1, 'slug' => $theme));    
        

        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $this->data['school']   = $this->dashboard->get_single('schools', array('status'=>1, 'id'=>$school_id));
        }   
        //birthday start

        $teacher = $this->db->query('SELECT * FROM teachers WHERE DATE_FORMAT(dob,"%m-%d") = DATE_FORMAT(NOW(),"%m-%d")')->result();
        $student = $this->db->query('SELECT * FROM students WHERE DATE_FORMAT(dob,"%m-%d") = DATE_FORMAT(NOW(),"%m-%d")')->result(); 

        $this->data['birthday_today'] = count($teacher) + count($student);   
        if($this->data['birthday_today'] > 0)
        {
          if(count($teacher) > 0)
          {
            $scl_id = $teacher[0]->school_id;
          }
          if(count($student) > 0)
          {
            $scl_id = $student[0]->school_id;
          }
        

          $birthday_sms = $this->dashboard->get_birthday_sms($scl_id);

          // $birthday_sms = true;
            if(empty($birthday_sms))
            {
                
            
              if(count($student) > 0)
              {
                 
                foreach ($student as $student_key => $student_value) {
                  $school = $this->db->query('SELECT * FROM schools WHERE id = ?', $student_value->school_id);
                  $school = $school->row_array();
                  $body = "Happy Birthday Dear ". $student_value->name . "\n". "Best Wishes From" . "\n". "Manzorul Hoque";
                  $data['school_id'] = $student_value->school_id;
                  $data['role_id'] = '4';
                  $data['receiver_id'] = $student_value->id;
                  $data['sms_gateway'] = 'bulksmsbd';
                  $data['date'] = date('Y-m-d');
                  $data['academic_year_id'] = $school['academic_year_id'];
                  $data['sender_role_id'] = $this->session->userdata('role_id');
                  $data['body'] = $body;
                  $data['status'] = 1;
                  $data['created_at'] = date('Y-m-d H:i:s');
                  $data['created_by'] = logged_in_user_id();
                   
                  $this->sms_send($student_value->phone,$body, $student_value->school_id);
                  $x = $this->db->insert('birthday_smses', $data);
                  
                }
              }

              if(count($teacher) > 0)
              {
                foreach ($teacher as $teacher_key => $teacher_value) {
                  $school = $this->db->query('SELECT * FROM schools WHERE id = ?', $teacher_value->school_id);
                  $school = $school->row_array();
                  $body = "Happy Birthday Dear ". $teacher_value->name . "\n". "Best Wishes From" . "\n". "Manzorul Hoque";
                  $data['school_id'] = $teacher_value->school_id;
                  $data['role_id'] = 4;
                  $data['receiver_id'] = $teacher_value->id;
                  $data['sms_gateway'] = 'bulksmsbd';
                  $data['date'] = date('Y-m-d');
                  $data['academic_year_id'] = $school['academic_year_id'];
                  $data['sender_role_id'] = $this->session->userdata('role_id');
                  $data['body'] = $body;
                  $data['status'] = 1;
                  $data['created_at'] = date('Y-m-d H:i:s');
                  $data['created_by'] = logged_in_user_id();
                  
                  $this->sms_send($teacher_value->phone,$body, $teacher_value->school_id);
                  $this->db->insert('birthday_smses', $data);
                  
                }
              }

            }
        }

        //birthday end 


        $this->data['news'] = $this->dashboard->get_list('news', array('status' => 1, 'school_id'=>$school_id), '', '5', '', 'id', 'DESC');
        $this->data['notices'] = $this->dashboard->get_list('notices', array('status' => 1, 'school_id'=>$school_id), '', '5', '', 'id', 'DESC');
        $this->data['events'] = $this->dashboard->get_list('events', array('status' => 1, 'school_id'=>$school_id), '', '', '10', 'id', 'DESC');
        $this->data['holidays'] = $this->dashboard->get_list('holidays', array('status' => 1, 'school_id'=>$school_id), '', '10', '', 'id', 'DESC');
       
        
        $this->data['users'] = $this->dashboard->get_user_by_role($school_id);
        $this->data['students'] = $this->dashboard->get_student_by_class($school_id);

        $this->data['total_student'] = $this->dashboard->get_total_student($school_id);
        $this->data['total_guardian'] = $this->dashboard->get_total_guardian($school_id);
        $this->data['total_teacher'] = $this->dashboard->get_total_teacher($school_id);
        $this->data['total_employee'] = $this->dashboard->get_total_employee($school_id);
        $this->data['total_expenditure'] = $this->dashboard->get_total_expenditure($school_id);
        $this->data['total_expenditure_today'] = $this->dashboard->get_total_expenditure_today($school_id);
        $this->data['total_expenditure_month'] = $this->dashboard->get_total_expenditure_month($school_id);

        $this->data['total_income'] = $this->dashboard->get_total_income($school_id);
        $this->data['total_income_today'] = $this->dashboard->get_total_income_today($school_id);
        $this->data['total_income_month'] = $this->dashboard->get_total_income_month($school_id);
        
                 
        $this->data['sents'] = $this->dashboard->get_message_list($type = 'sent');
        $this->data['drafts'] = $this->dashboard->get_message_list($type = 'draft');
        $this->data['trashs'] = $this->dashboard->get_message_list($type = 'trash');
        $this->data['inboxs'] = $this->dashboard->get_message_list($type = 'inbox');
        $this->data['new'] = $this->dashboard->get_message_list($type = 'new');
        
        $this->data['school_setting'] = $this->school_setting;
        $this->data['schools'] = $this->schools;
        $this->data['global_setting'] = $this->dashboard->get_list('global_setting', array('id' => 1));
        
        $stats = array();
        
        foreach($this->data['schools'] as $obj){
            
            $arr = array();
            
            $total_class = $this->dashboard->get_total_class($obj->id);
            $total_student = $this->dashboard->get_total_student($obj->id);
            $total_teacher = $this->dashboard->get_total_teacher($obj->id);
            $total_employee = $this->dashboard->get_total_employee($obj->id);
            $total_income = $this->dashboard->get_total_income($obj->id);
            $total_expenditure = $this->dashboard->get_total_expenditure($obj->id);
            
            $arr[] = $total_class > 0 ? $total_class : 0;
            $arr[] = $total_student > 0 ? $total_student : 0;
            $arr[] = $total_teacher > 0 ? $total_teacher : 0;
            $arr[] = $total_employee > 0 ? $total_employee : 0;
            $arr[] = $total_income > 0 ? $total_income : 0;
            $arr[] = $total_expenditure > 0 ? $total_expenditure : 0;

            $stats[$obj->id] = $arr;
              
        } 
        
        $this->data['stats'] = $stats;
        
        $this->layout->title($this->lang->line('dashboard') . ' | ' . SMS);
        $this->layout->view('dashboard', $this->data);
        
    }

    public function auto_due_sms()
    {
        $school = 1;
        $dateObj = DateTime::createFromFormat('!m', date('m')); 
        $monthName = $dateObj->format('m'); 
        $month = $monthName.'-'.date('Y');
        // $month_name = date('F',$monthName).'-'.date('Y');
        $month_name = $monthName = date('F', mktime(0, 0, 0, $monthName, 10)).'-'.date('Y');
      
        $this->db->select('S.*');
        $this->db->from('invoices AS I');
        $this->db->join('students AS S', 'S.user_id = I.user_id', 'left');
        $this->db->where('I.school_id', $school);
        $this->db->where('I.paid_status', 'unpaid');
        $this->db->like('I.month', $month);
        $users = $this->db->get()->result(); 
        $school_info = $this->db->query('SELECT * FROM schools WHERE id = ?', $school)->row();
        $sms_info = $this->db->query('SELECT * FROM sms_templates WHERE id = ?', 40)->row();

        $meg = $sms_info->template;
                
                
        if (strpos($meg, '[month]') !== false) {
            $meg = str_replace('[month]', $month_name, $meg);
        }
        
        foreach ($users as $key => $value) {

          $message = $meg;
          $data['school_id']= 1;
          $data['role_id']= 3;
          $data['sender_role_id']= $this->session->userdata('role_id');
          $data['receivers']= $value->name;
          $data['academic_year_id']= $school_info->academic_year_id;
          $data['sms_gateway']= 'bulksmsbd';
          $data['sms_type']= 'duefee';
          $data['body']= $message;
          $data['status']= 1;
          $data['created_at'] = date('Y-m-d H:i:s');
          $data['created_by'] = logged_in_user_id();

          $insert_id = $this->db->insert('text_messages', $data);
          
          if ($insert_id) 
          {
              if(!empty($value->mother_phone))
              {
                $phone = $value->mother_phone;
              }
              if(!empty($value->father_phone))
              {
                $phone = $value->father_phone;
              }
              else
              {
                $phone = $value->phone;
              }
              $this->sms_send($phone, $message, $school);
        }
        
    }
  }

    private function sms_send($phone, $message, $school_id) {
        
       
        $this->db->select('S.*');
        $this->db->from('sms_settings AS S');     
        $this->db->where('S.school_id', $school_id);     
        $setting = $this->db->get()->row();
        
        $this->sender_id_data = $setting->bulksmsbd_senderid;
        $this->api_data = $setting->bulksmsbd_api_key;
        $this->url_data = $setting->bulksmsbd_url;
        $this->status_data = $setting->bulksmsbd_status;


        $url = "http://bulksmsbd.net/api/smsapi";
        $api_key = $this->api_data;
        $senderid = $this->sender_id_data;
        $number = $phone;
        $message = $message;
        $data = [
            "api_key" => $api_key,
            "senderid" => $senderid,
            "number" => $number,
            "message" => $message
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    
    
    public function get_search(){
        
        $school_id = $this->input->post('school_id');
        $keyword = $this->input->post('keyword');
        
        if(strlen($keyword) < 3){
          echo  $blank_str = '<div class="search-message-container">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <div class="search-message" style="padding: 6px;font-weight: bold;">'.$this->lang->line('type_atleast_3_characters').'</div>
                    </div>
                    <div class="clearfix"></div>
                </div>';
            die();
        }
        
        
        $blank_str = '<div class="search-message-container">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <div class="search-message" style="padding: 6px;font-weight: bold;">'.$this->lang->line('no_search_result_found').'</div>
                    </div>
                    <div class="clearfix"></div>
                </div>';
        
        
        $students = $this->dashboard->get_search_student($school_id, $keyword);
        $guardians = $this->dashboard->get_search_guardian($school_id, $keyword);
        $teachers = $this->dashboard->get_search_teacher($school_id, $keyword);
        $employees = $this->dashboard->get_search_employee($school_id, $keyword);
        
        $result_str = '';
            
        
        //===================   STUDENT ===========================================
        if(has_permission(VIEW, 'student', 'student')){
            
        if(!empty($students)){
            
           $result_str .= '<div class="col-md-12 col-sm-12 col-xs-12">
                                <div style="padding: 6px;font-weight: bold;background: #ecf7fb; margin-bottom: 5px;">'.$this->lang->line('student').'</div>
                            </div>
                            <div class="clearfix"></div>';
            
            foreach($students as $obj){
               $result_str .= '<div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                            <div class="well profile_view">
                              <div class="col-sm-12">
                                 <div class="left col-xs-3" style="padding: 0;">';
               
                                if($obj->photo != ''){
                        $result_str .= '<img src="'.UPLOAD_PATH.'student-photo/'.$obj->photo.'" alt="" class="img-circle img-responsive">';             
                                }else{
                        $result_str .= '<img src="'.IMG_URL.'default-user.png" alt="" class="img-circle img-responsive">'; 
                                }
                                  
                                
                        $result_str .= '</div>
                                <div class="right col-xs-9">
                                  <h3>'. substr($obj->name, 0, 22).'</h3>
                                  <hr/>
                                  <p><strong>'.$obj->session_year.'</strong></p>
                                  <ul class="list-unstyled_" style="padding-left:12px;">
                                        <li>'.$this->lang->line('class').' : '.$obj->class_name.', '.$this->lang->line('section').' : '.$obj->section.'</li>
                                        <li>'.$this->lang->line('roll_no').' : '.$obj->roll_no.'</li>
                                        <li>'.$this->lang->line('birth_date').' : '.date('M j, Y', strtotime($obj->dob)).'</li>
                                    </ul>
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-12 bottom text-center">
                                  <a href="'.site_url('student/view/'.$obj->id).'" type="button" class="btn btn-success btn-xs">
                                    <i class="fa fa-user"> </i> '.$this->lang->line('view_profile').'
                                  </a>                           
                              </div>
                            </div>
                          </div>'; 
            }
        }
                
        }
        //===================   GUARDIAN ===========================================
        if(has_permission(VIEW, 'guardian', 'guardian')){
            
        if(!empty($guardians)){
            
           $result_str .= '<div class="col-md-12 col-sm-12 col-xs-12">
                                <div style="padding: 6px;font-weight: bold;background: #ecf7fb; margin-bottom: 5px;">'.$this->lang->line('guardian').'</div>
                            </div>
                            <div class="clearfix"></div>';
            
            foreach($guardians as $obj){
               $result_str .= '<div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                            <div class="well profile_view">
                              <div class="col-sm-12">
                                 <div class="left col-xs-3" style="padding: 0;">';
               
                                if($obj->photo != ''){
                        $result_str .= '<img src="'.UPLOAD_PATH.'guardian-photo/'.$obj->photo.'" alt="" class="img-circle img-responsive">';             
                                }else{
                        $result_str .= '<img src="'.IMG_URL.'default-user.png" alt="" class="img-circle img-responsive">'; 
                                }
                                  
                                
                        $result_str .= '</div>
                                <div class="right col-xs-9">
                                  <h3>'. substr($obj->name, 0, 22).'</h3>
                                  <hr/>
                                  <p><strong>'.$obj->profession.'</strong></p>
                                  <ul class="list-unstyled">
                                    <li><i class="fa fa-phone"></i> '.$obj->phone.'</li>
                                    <li><i class="fa fa-envelope"></i> '.$obj->email.'</li>
                                  </ul>
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-12 bottom text-center">
                                  <a href="'.site_url('guardian/view/'.$obj->id).'" type="button" class="btn btn-success btn-xs">
                                    <i class="fa fa-user"> </i>  '.$this->lang->line('view_profile').'
                                  </a>                           
                              </div>
                            </div>
                          </div>'; 
            }
        }
        
        }        
        
        //===================   TEACHER ===========================================
        if(has_permission(VIEW, 'teacher', 'teacher')){
            
        if(!empty($teachers)){
            
           $result_str .= '<div class="col-md-12 col-sm-12 col-xs-12">
                                <div style="padding: 6px;font-weight: bold;background: #ecf7fb; margin-bottom: 5px;">'.$this->lang->line('teacher').'</div>
                            </div>
                            <div class="clearfix"></div>';
            
            foreach($teachers as $obj){
               $result_str .= '<div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                            <div class="well profile_view">
                              <div class="col-sm-12">
                                <div class="left col-xs-3" style="padding: 0;">';
                                if($obj->photo != ''){
                        $result_str .= '<img src="'.UPLOAD_PATH.'teacher-photo/'.$obj->photo.'" alt="" class="img-circle img-responsive">';             
                                }else{
                        $result_str .= '<img src="'.IMG_URL.'default-user.png" alt="" class="img-circle img-responsive">'; 
                                }
                                  
                                
                    $result_str .= '</div>
                                <div class="right col-xs-9">
                                  <h3>'.$obj->name.'</h3>
                                  <hr/>
                                  <p><strong>'.$obj->department.'</strong></p>
                                  <ul class="list-unstyled">
                                    <li><i class="fa fa-phone"></i> '.$obj->phone.'</li>
                                    <li><i class="fa fa-envelope"></i> '.$obj->email.'</li>
                                  </ul>
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-12 bottom text-center">
                                  <a href="'.site_url('teacher/view/'.$obj->id).'" type="button" class="btn btn-success btn-xs">
                                    <i class="fa fa-user"> </i> '.$this->lang->line('view_profile').'
                                  </a>                           
                              </div>
                            </div>
                          </div>'; 
            }
        }
        
        }        
        
        //===================   EMPLOYEE ===========================================
        if(has_permission(VIEW, 'hrm', 'employee')){
            
        if(!empty($employees)){
            
           $result_str .= '<div class="col-md-12 col-sm-12 col-xs-12">
                                <div style="padding: 6px;font-weight: bold;background: #ecf7fb; margin-bottom: 5px;">'.$this->lang->line('employee').'</div>
                            </div>
                            <div class="clearfix"></div>';
            
            foreach($employees as $obj){
               $result_str .= '<div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                            <div class="well profile_view">
                              <div class="col-sm-12">
                                <div class="left col-xs-3" style="padding: 0;">';
                                if($obj->photo != ''){
                        $result_str .= '<img src="'.UPLOAD_PATH.'employee-photo/'.$obj->photo.'" alt="" class="img-circle img-responsive">';             
                                }else{
                        $result_str .= '<img src="'.IMG_URL.'default-user.png" alt="" class="img-circle img-responsive">'; 
                                }
                                  
                                
                    $result_str .= '</div>
                                <div class="right col-xs-9">
                                  <h3>'.$obj->name.'</h3>
                                  <hr/>
                                  <p><strong>'.$obj->designation.'</strong></p>
                                  <ul class="list-unstyled">
                                    <li><i class="fa fa-phone"></i> '.$obj->phone.'</li>
                                    <li><i class="fa fa-envelope"></i> '.$obj->email.'</li>
                                  </ul>
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-12 bottom text-center">
                                  <a href="'.site_url('hrm/employee/view/'.$obj->id).'" type="button" class="btn btn-success btn-xs">
                                    <i class="fa fa-user"> </i>  '.$this->lang->line('view_profile').'
                                  </a>                           
                              </div>
                            </div>
                          </div>'; 
            }
        }
        
        }       
        
        $count_str = '<div class="search-message-container">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <div class="search-message" style="padding: 6px;font-weight: bold;"> '.(count($students)+ count($guardians)+count($teachers)+count($employees)).' '.$this->lang->line('search_result_found').'.</div>
                    </div>
                    <div class="clearfix"></div>
                </div>';
        
        
        if($result_str){            
           echo $count_str.$result_str;
            
        }else{
           echo $blank_str;
        }
       
    }
   
}
