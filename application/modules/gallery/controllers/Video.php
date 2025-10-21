<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Image.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Image
 * @description     : Manage school Image for guardian, student, teacher and employee.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Video extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Video_Model', 'video', true);       
    }


    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Gallery Image List" user interface                 
    *                      
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index($school_id = null) {

        // check_permission(VIEW);
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');        
            $this->data['videos'] = $this->video->get_video_list($school_id);
        }
        $this->data['videos'] = $this->video->get_video_list($school_id);
        $this->data['images'] = $this->video->get_image_list($school_id);
        $this->data['filter_school_id'] = $school_id;
        $this->data['schools'] = $this->schools;
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_gallery_video') . ' | ' . SMS);
        $this->layout->view('video/index', $this->data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Gallery Image" user interface                 
    *                    and process to store "Image" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        // check_permission(ADD);

        if ($_POST) {
            $this->_prepare_video_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_video_data();
                $insert_id = $this->video->insert('gallery_videos', $data);
                if ($insert_id) {                    
                    success($this->lang->line('insert_success'));
                    redirect('gallery/video/index/'.$data['school_id']);
                    
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('gallery/video/add');
                }
            } else {
                error($this->lang->line('insert_failed'));
                $this->data['post'] = $_POST;
            }
        }

        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');        
            $this->data['galleries'] = $this->video->get_list('galleries', $condition, '', '', '', 'id', 'ASC');
        }
        $this->data['videos'] = $this->video->get_video_list($school_id);
        $this->data['schools'] = $this->schools;
        
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add') . ' | ' . SMS);
        $this->layout->view('video/index', $this->data);
    }

    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Gallery Image" user interface                 
    *                    with populated "Gallery Image" value 
    *                    and process to update "Gallery Image" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

        // check_permission(EDIT);
        
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('gallery/video/index');
        }
        
        if ($_POST) {
            $this->_prepare_video_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_video_data();
                $updated = $this->video->update('gallery_videos', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    success($this->lang->line('update_success'));
                    redirect('gallery/video/index/'.$data['school_id']);
                    
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('gallery/video/edit/' . $this->input->post('id'));
                }
            } else {
                error($this->lang->line('insert_failed'));
                $this->data['video'] = $this->video->get_single('gallery_videos', array('id' => $this->input->post('id')));
            }
        }

        if ($id) {
            $this->data['video'] = $this->video->get_single('gallery_videos', array('id' => $id));

            if (!$this->data['video']) {
                redirect('gallery/video/index');
            }
        }

        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');        
            $this->data['galleries'] = $this->video->get_list('galleries', $condition, '', '', '', 'id', 'ASC');
        }
        $this->data['videos'] = $this->video->get_video_list($this->data['video']->school_id);
        $this->data['school_id'] = $this->data['video']->school_id;
        $this->data['filter_school_id'] = $this->data['video']->school_id;
        $this->data['schools'] = $this->schools;
        
        $this->data['edit'] = TRUE;
        $this->layout->title($this->lang->line('edit') . ' | ' . SMS);
        $this->layout->view('video/index', $this->data);
    }
    
    /*****************Function _prepare_video_validation**********************************
    * @type            : Function
    * @function name   : _prepare_video_validation
    * @description     : Process "gallery image" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_video_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        $this->form_validation->set_rules('school_id', $this->lang->line('school_name'), 'trim|required');
        $this->form_validation->set_rules('gallery_id', $this->lang->line('gallery'), 'trim|required');
        $this->form_validation->set_rules('youtube_embed', $this->lang->line('youtube_embed'), 'trim|required|callback_validate_embed_code');
    }

    public function validate_embed_code($str)
    {
        if (preg_match('/<iframe.*src="https:\/\/www\.youtube\.com\/embed\/.*".*><\/iframe>/', $str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validate_embed_code', 'শুধুমাত্র বৈধ YouTube embed কোড (iframe) দিন।');
            return FALSE;
        }
    }

    
    /*****************Function _get_posted_video_data**********************************
    * @type            : Function
    * @function name   : _get_posted_video_data
    * @description     : Prepare "gallery image" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_video_data() {

        $items = array();
        $items[] = 'school_id';
        $items[] = 'gallery_id';
        $items[] = 'youtube_embed';

        $data = elements($items, $_POST);
        $data['embed_code'] = $data['youtube_embed'];
        unset($data['youtube_embed']);
        
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

        return $data;
    }

    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Gallery image" from database                  
    *                    and unlink gallery image from server   
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        // check_permission(DELETE);
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('gallery/image/index');
        }
        
        $video = $this->video->get_single('gallery_videos', array('id' => $id));
        if ($this->video->delete('gallery_videos', array('id' => $id))) {
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('gallery/video/index/'.$image->school_id);
        
    }
}