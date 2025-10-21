<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************founder_director_message.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : founder_director_message
 * @description     : Manage application founder_director_message text  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Founder_director_message extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->data['schools'] = $this->schools;
        $this->load->model('About_Model', 'about', true);        
        $this->load->model('superintendent_model', 'muhtamim', true);        
    }

        
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "General About" user interface                 
    *                    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {
        
        check_permission(VIEW); 
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){ 
             $this->data['edit'] = TRUE;
        }else{
            $this->data['list'] = TRUE;
        }  
        $this->data['muhtamim_message'] = $this->muhtamim->get_single('muhtamim_message', array('designation' => 'founder_director'));

        $this->layout->title($this->lang->line('founder_director_message') . ' | ' . SMS);
        $this->layout->view('founder_director_message/index', $this->data);
    }

        
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update " About Text" user interface                 
    *                    with populate "About Text" value 
    *                    and process to update "About Text" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

        check_permission(EDIT);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('frontend/founder_director_message/index');
        }
        
        if ($_POST) {
            $this->_prepare_about_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_about_data();
                $updated = $this->about->update('muhtamim_message', $data, array('id' => $this->input->post('id')));

                if ($updated) {    
                    
                    create_log('Has been updated a frontend founder director message page');
                    
                    success($this->lang->line('update_success'));
                    redirect('frontend/founder_director_message/index');
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('frontend/founder_director_message/edit/' . $this->input->post('id'));
                }
            } else {
                error($this->lang->line('update_failed'));
                $this->data['muhtamim_message'] = $this->muhtamim->get_single('muhtamim_message', array('designation' => 'founder_director'));

            }
        }
        
        if ($id) {
            $this->data['muhtamim_message'] = $this->muhtamim->get_single('muhtamim_message', array('designation' => 'founder_director'));

            if (!$this->data['muhtamim_message']) {
                redirect('frontend/founder_director_message/index');
            }
        }
        
        $this->data['edit'] = TRUE;
        $this->layout->title($this->lang->line('founder_director_message') . ' | ' . SMS);
        $this->layout->view('founder_director_message/index', $this->data);
    }
    
    
     /*****************Function get_single_school**********************************
     * @type            : Function
     * @function name   : get_single_frontend
     * @description     : "Load single frontend information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_superintendent(){
        
       $superintendent_id = $this->input->post('superintendent_id');       
       $this->data['muhtamim_message'] = $this->muhtamim->get_single('muhtamim_message', array('id' => $superintendent_id));
       echo $this->load->view('muhtamim_message/get-single-superintendent', $this->data);
    }


        
    /*****************Function _prepare_about_validation**********************************
    * @type            : Function
    * @function name   : _prepare_about_validation
    * @description     : Process "About Text" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_about_validation() {
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
        $this->form_validation->set_rules('message', $this->lang->line('message'), 'trim|required');
        $this->form_validation->set_rules('muhtamim_image', $this->lang->line('image'), 'trim|callback_about_image');
    }
    
    
    /*****************Function about_image**********************************
    * @type            : Function
    * @function name   : about_image
    * @description     : validate  about_image type/format                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function about_image() {
    if (!empty($_FILES['muhtamim_image']['name'])) {
        $file = $_FILES['muhtamim_image'];
        $tmp_name = $file['tmp_name'];

        if (!empty($tmp_name)) {
            list($width, $height) = getimagesize($tmp_name);

            if ($width > 600 || $height > 600) {
                $this->form_validation->set_message('about_image', $this->lang->line('please_check_image_dimension'));
                return FALSE;
            }

            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                $this->form_validation->set_message('about_image', $this->lang->line('select_valid_file_format'));
                return FALSE;
            }
        }
    }

    return TRUE;
}



       
    /*****************Function _get_posted_about_data**********************************
    * @type            : Function
    * @function name   : _get_posted_about_data
    * @description     : Prepare "About Text" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_about_data() {

        $items = array();
        $items[] = 'name';
        $items[] = 'message';            

        
        $data = elements($items, $_POST); 
        $data['designation'] = 'founder_director';
        $data['modified_at'] = date('Y-m-d H:i:s');
        $data['modified_by'] = logged_in_user_id();
         
        if (!empty($_FILES['muhtamim_image']['name'][0])) {
            $prev_image = $this->input->post('prev_about_image');
            if (!empty($prev_image)) {
                $path = 'assets/uploads/about/' . $prev_image;
            if (file_exists($path)) {
                    @unlink($path);
                }
            }


            $uploaded_images = $this->_upload_muhtamim_image();
            $data['img'] = implode(',', $uploaded_images);
        } else {
            $data['img'] = $this->input->post('prev_about_image');
        }


        return $data;
    }

           
    /*****************Function _upload_about_image**********************************
    * @type            : Function
    * @function name   : _upload_about_image
    * @description     : Process to upload about image in the server                  
    *                     and return image name   
    * @param           : null
    * @return          : $image string value 
    * ********************************************************** */
    private function _upload_muhtamim_image() {
    $uploaded = array();

    if (!empty($_FILES['muhtamim_image']['name'])) {
        $file = $_FILES['muhtamim_image'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $file_name = uniqid('about_') . '.' . $ext;
        $upload_path = 'assets/uploads/about/' . $file_name;

        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            $uploaded[] = $file_name;
        }
    }

    return $uploaded;
}


}