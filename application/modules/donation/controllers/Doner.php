<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Doner.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Doner
 * @class name      : Doner
 * @description     : Manage Doner.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Doner extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Doner_Model', 'doner', true);
    }

    /*     * ***************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load "donar List" user interface                 
     *                    listing    
     * @param           : integer value
     * @return          : null 
     * ********************************************************** */

    public function index($school_id = null) {

        check_permission(VIEW);
        $this->data['donars'] = $this->doner->get_doner_list($school_id);
        $this->data['filter_school_id'] = $school_id;
        $this->data['schools'] = $this->schools;

        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_donar') . ' | ' . SMS);
        $this->layout->view('doner/index', $this->data);
    }

    /*     * ***************Function add**********************************
     * @type            : Function
     * @function name   : add
     * @description     : Load "Add new doner" user interface                 
     *                    and process to store "Doner" into database 
     * @param           : null
     * @return          : null 
     * ********************************************************** */

    public function add() {

        check_permission(ADD);

        if ($_POST) {
            $this->_prepare_donar_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_donar_data();

                $insert_id = $this->doner->insert('doner', $data);
                if ($insert_id) {

                    // $this->__update_balance();
                    
                    create_log('Has been created a doner');
                    success($this->lang->line('insert_success'));
                    redirect('donation/doner/index/' . $data['school_id']);
                    
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('donation/doner/add');
                }
            } else {
                error($this->lang->line('insert_failed'));
                $this->data['post'] = $_POST;
                $this->data['school_id'] = $this->input->post('school_id');
                $this->data['filter_school_id'] = $this->input->post('school_id');
            }
        }

        $this->data['donars'] = $this->doner->get_doner_list();
        $this->data['schools'] = $this->schools;
        $this->data['add'] = TRUE;

        $this->layout->title($this->lang->line('add') . ' | ' . SMS);
        $this->layout->view('doner/index', $this->data);
    }

    /*     * ***************Function edit**********************************
     * @type            : Function
     * @function name   : edit
     * @description     : Load Update "donar" user interface                 
     *                    with populated "Donar" value 
     *                    and process to update "Donar" into database    
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */

    public function edit($id = null) {

        check_permission(EDIT);

        if (!is_numeric($id)) {
            error($this->lang->line('unexpected_error'));
            redirect('donation/doner/index');
        }

        if ($_POST) {
            $this->_prepare_donar_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_donar_data();
                $updated = $this->doner->update('doner', $data, array('id' => $this->input->post('id')));

                if ($updated) {

                    // $this->__update_balance();
                    
                    create_log('Has been updated a donar');
                    success($this->lang->line('update_success'));
                    redirect('donation/doner/index/' . $this->input->post('school_id'));
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('donation/doner/edit/' . $this->input->post('id'));
                }
            } else {
                error($this->lang->line('update_failed'));
                $this->data['donar'] = $this->doner->get_single_doner($this->input->post('id'));
            }
        }

        if ($id) {

            $this->data['donar'] = $this->doner->get_single_doner($id);
            if (!$this->data['donar']) {
                redirect('donation/doner/index');
            }
        }

        $this->data['donars'] = $this->doner->get_doner_list($this->data['donar']->school_id);


        $this->data['school_id'] = $this->data['donar']->school_id;
        $this->data['filter_school_id'] = $this->data['donar']->school_id;
        $this->data['schools'] = $this->schools;

        $this->data['edit'] = TRUE;
        $this->layout->title($this->lang->line('edit') . ' | ' . SMS);
        $this->layout->view('doner/index', $this->data);
    }

    /*     * ***************Function get_single_donar**********************************
     * @type            : Function
     * @function name   : get_single_donar
     * @description     : "Load single donar information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */

    public function get_single_doner() {

        $doner_id = $this->input->post('id');
        $this->data['donar'] = $this->doner->get_single_doner($doner_id);
        echo $this->load->view('doner/get-single-doner', $this->data);
    }

    /*     * ***************Function _prepare_donar_validation**********************************
     * @type            : Function
     * @function name   : _prepare_donar_validation
     * @description     : Process "Donar" user input data validation                 
     *                       
     * @param           : null
     * @return          : null 
     * ********************************************************** */

    private function _prepare_donar_validation() {

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        $this->form_validation->set_rules('school_id', $this->lang->line('school_name'), 'trim|required');
        $this->form_validation->set_rules('doner_type', $this->lang->line('doner_type'), 'trim|required');
        $this->form_validation->set_rules('doner_name', $this->lang->line('donar_name'), 'trim|required');
        $this->form_validation->set_rules('contact_name', $this->lang->line('contact_name'), 'trim');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required');
        $this->form_validation->set_rules('address', $this->lang->line('address'), 'trim');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required');
        $this->form_validation->set_rules('note', $this->lang->line('note'));
    }

    /*     * ***************Function _get_posted_donar_data**********************************
     * @type            : Function
     * @function name   : _get_posted_donar_data
     * @description     : Prepare "donar" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */

    private function _get_posted_donar_data() {

        $items = array();
        $items[] = 'school_id';
        $items[] = 'doner_type';
        $items[] = 'donation_category';
        $items[] = 'doner_name';
        $items[] = 'contact_name';
        $items[] = 'email';
        $items[] = 'phone';
        $items[] = 'address';
        $items[] = 'amount';
        $items[] = 'note';

        $data = elements($items, $_POST);
        $data['donation_start_from'] = date('Y-m-d', strtotime($this->input->post('donation_start_from')));
        $data['modified_at'] = date('Y-m-d H:i:s');
        $data['modified_by'] = logged_in_user_id();

        if ($this->input->post('id')) {
           
            $data['status'] = $this->input->post('status');
            
        } else {

            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
            

            $school = $this->doner->get_school_by_id($data['school_id']);

            if (!$school->academic_year_id) {
                error($this->lang->line('set_academic_year_for_school'));
                redirect('administrator/year/index');
            }

            $data['academic_year_id'] = $school->academic_year_id;
        }

        return $data;
    }
    

    /* ***************Function delete**********************************
     * @type            : Function
     * @function name   : delete
     * @description     : delete "donar" from database                 
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */

    public function delete($id = null) {

        check_permission(VIEW);

        if (!is_numeric($id)) {
            error($this->lang->line('unexpected_error'));
            redirect('donation/doner/index');
        }


        $doner = $this->doner->get_single('doner', array('id'=>$id));      
        
        if ($this->doner->delete('doner', array('id' => $id))) {
            
            success($this->lang->line('delete_success'));
            redirect('donation/doner/index/' . $doner->school_id);
            
        } else {
            error($this->lang->line('delete_failed'));
        }

        redirect('donation/doner/index');
    }
    
}