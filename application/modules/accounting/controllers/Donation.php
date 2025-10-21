<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Incomehead.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Donation
 * @description     : Manage all income type/head/title as per accounting term.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Donation extends MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
         $this->load->model('Donation_Model', 'donationhead', true); 
         
          // need to check school subscription status
        // if($this->session->userdata('role_id') != SUPER_ADMIN){                 
        //     if(!check_saas_status($this->session->userdata('school_id'), 'is_enable_accounting')){                        
        //       redirect('dashboard/index');
        //     }
        // }
    }

    
    
     /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load "Income Head List" user interface                 
     *                     
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function index($school_id = null) {
        
        // check_permission(VIEW);
            
        // $this->data['incomeheads'] = $this->incomehead->get_incomehead_list($school_id);  
        // $this->data['filter_school_id'] = $school_id;
        // $this->data['schools'] = $this->schools;
        
        // $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_donation'). ' | ' . SMS);
        $this->layout->view('donation/index', $this->data);
    }

    public function add() {

        // check_permission(ADD);
        if ($_POST) {
            $this->_prepare_donation_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_donationhead_data();
                $insert_id = $this->donationhead->insert('donation_head', $data);
                if ($insert_id) {
                    create_log('Has been created a donation head : '. $data['title']);                    
                    success($this->lang->line('insert_success'));
                    redirect('accounting/donation/index/'.$data['school_id']);
                    
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('accounting/donation/add');
                }
            } else {
                error($this->lang->line('insert_failed'));
                $this->data['post'] = $_POST;
            }
        }

        $this->data['incomeheads'] = $this->donationhead->get_incomehead_list();  
        $this->data['schools'] = $this->schools;
        
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add'). ' | ' . SMS);
        $this->layout->view('donation/index', $this->data);
    }
    private function _get_posted_donationhead_data() {

        $items = array();
        $items[] = 'school_id';
        $items[] = 'title';
        $data = elements($items, $_POST);  
    
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['head_type'] = 'donation';
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();                       
        }

        return $data;
    }
    private function _prepare_donation_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('school_id', $this->lang->line('school_name'), 'trim|required');   
        $this->form_validation->set_rules('title', $this->lang->line('title'), 'trim|required|callback_title');   
    }

    public function title()
   {             
      if($this->input->post('id') == '')
      {   
          $donationhead = $this->donationhead->duplicate_check($this->input->post('school_id'), $this->input->post('title'), 'income'); 
         
          if($donationhead){
                $this->form_validation->set_message('title', $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }          
      }else if($this->input->post('id') != ''){   
         $donationhead = $this->donationhead->duplicate_check($this->input->post('school_id'), $this->input->post('title'), 'income', $this->input->post('id')); 
          if($donationhead){
                $this->form_validation->set_message('title', $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }
      }   
   }

   
}