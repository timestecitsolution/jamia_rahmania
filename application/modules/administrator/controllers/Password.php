<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Password.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Password
 * @description     : Reset users password by System administrator.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Password extends MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
         $this->load->model('Administrator_Model', 'administrator', true);
         $this->data['roles'] = $this->administrator->get_list('roles', array('status' => 1, 'is_super_admin'=>0), '','', '', 'id', 'ASC');
    }


    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load reset password user interface                 
    *                    and reset user password processing    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */ 
   public function index() {

       check_permission(EDIT);
       
        if($_POST){
            
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
            $this->form_validation->set_rules('role_id', $this->lang->line('user'). ' ' .$this->lang->line('type'), 'trim|required');
            
            if($this->input->post('role_id') == STUDENT){
                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');  
            }
            
            $this->form_validation->set_rules('user_id', $this->lang->line('user'), 'trim|required');
            $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required|min_length[5]|max_length[30]');
            $this->form_validation->set_rules('conf_password', $this->lang->line('password').' '.$this->lang->line('confirm'), 'trim|required|matches[password]');
            
             if ($this->form_validation->run() === TRUE) {
                $data['password']      = md5($this->input->post('password'));
                $data['temp_password'] = base64_encode($this->input->post('password'));
                $data['modified_at'] = date('Y-m-d H:i:s');
                $data['modified_by'] = logged_in_user_id();
                
                $this->administrator->update('users', $data, array('id'=> $this->input->post('user_id')));
                success($this->lang->line('update_success'));


                
                $user = $this->administrator->get_single('users', array('id' => $this->input->post('user_id')));

                if($this->input->post('role_id') == STUDENT || $this->input->post('role_id') == GUARDIAN)
                {

                    $school =  $this->db->get_where('schools', array('id'=>$user->school_id))->row();

                    if($this->input->post('role_id') == STUDENT)
                    {
                        $user_info = $this->db->get_where('students', array('user_id'=>$user->id))->row();
                    }
                    else
                    {
                        $user_info = $this->db->get_where('guardians', array('user_id'=>$user->id))->row();
                    }
                   

                    $sms_body = 'Your MH Academy User Name- '.$user->username.' & Password- '.$this->input->post('password').' URL - http://mhacademybd.com/mhacademy/login';

                    $sms_data['school_id'] = $user->school_id;
                    $sms_data['role_id'] = $user->role_id;
                    $sms_data['sender_role_id'] = 1;
                    $sms_data['receivers'] = $user->username;
                    $sms_data['academic_year_id'] = $school->academic_year_id; 
                    $sms_data['sms_gateway'] = 'bulksmsbd';
                    $sms_data['sms_type'] = 6;
                    $sms_data['body'] = $sms_body;
                    $sms_data['status'] = 1;
                    $sms_data['created_at'] = date('Y-m-d H:i:s');
                    $sms_data['created_by'] = logged_in_user_id();
                    
                    $x = $this->db->insert('text_messages', $sms_data);
                   
                    if($x)
                    {
                        $this->sms_send($user_info->phone,$sms_body, $user->school_id);
                    }
                   
                }
                create_log('Has been updated password for user : '. $user->username);
                redirect('administrator/password/index');
             }else{
                 error($this->lang->line('update_failed'));
             }
        }
        
        $this->data['classes'] = $this->administrator->get_list('classes', array('status' => 1), '','', '', 'id', 'ASC');
        $this->layout->title($this->lang->line('reset_user_password'). ' | ' . SMS);
        $this->layout->view('password/index', $this->data);
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
    
}
