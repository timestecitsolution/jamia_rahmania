<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Donation.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Donation
 * @description     : Manage donation for all type of student payment.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Collection extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Donation_Model', 'donation', true);        
    }

    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Donation List" user interface                 
    *                    listing    
    * @param           : integer value
    * @return          : null 
    * ********************************************************** */
    public function index( $school_id  = null ) {
        
        check_permission(VIEW);
        $this->data['donars'] = $this->donation->get_donation_list($school_id);
        $this->data['filter_school_id'] = $school_id;
        $this->data['schools'] = $this->schools;

        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_donation') . ' | ' . SMS);
        $this->layout->view('donation/collection/index', $this->data);
        
    }
    /*     * ***************Function get_single_donation**********************************
     * @type            : Function
     * @function name   : get_single_donation
     * @description     : "Load single donation information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */

     public function get_single_donation() {

        $doner_id = $this->input->post('id');
        $this->data['donar'] = $this->donation->get_single_donation($doner_id);
        $school_id = $this->data['donar']->school_id;
        $this->data['settings']   = $this->donation->get_school_by_id($school_id);
        echo $this->load->view('collection/get-single-donation', $this->data);
    }
    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new donation" user interface                 
    *                    and process to store "Donation" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);

        if ($_POST) {
            $this->_prepare_donation_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_donation_data();
                $invoice_data = $this->_save_invoice($data);
                $invoice_id = $this->donation->insert('invoices', $invoice_data);
                $data['invoice_id'] = $invoice_id;
                $insert_id = $this->donation->insert('donation_collection', $data);
                $this->_save_transaction($data);
                if ($insert_id) {                   
                    create_log('Donation has been collected');                     
                    success($this->lang->line('insert_success'));
                    redirect('donation/collection/index/'.$data['school_id']);
                    
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('donation/collection/add');
                }
            } else {
                error($this->lang->line('insert_failed'));
                $this->data['post'] = $_POST;
                $this->data['school_id'] = $this->input->post('school_id');        
                $this->data['filter_school_id'] = $this->input->post('school_id');   
            }
        }
        
        $this->layout->title($this->lang->line('add') . ' | ' . SMS);
        $this->layout->view('index', $this->data);
    }
           
     /*****************Function get_doner_names**********************************
     * @type            : Function
     * @function name   : get_doner_names
     * @description     : "Load single doner information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */


     public function get_doner_names() {
        $doner_type = $this->input->post('doner_type');
        $donation_category = $this->input->post('donation_category');
    
        $doners = $this->donation->get_doners_by_type_and_category($doner_type, $donation_category);
        $data = [];
        foreach ($doners as $doner) {
            $data[$doner->id] = $doner->doner_name;
        }
    
        echo json_encode($data);
    }

    public function get_paid_cycles()
    {
        $donor_id = $this->input->post('donor_id');

        $this->db->select('donation_cycle');
        $this->db->from('donation_collection');
        $this->db->where('doner_id', $donor_id);

        $query = $this->db->get();
        $paid = array();

        foreach ($query->result() as $row) {
            $paid[] = $row->donation_cycle;
        }
        echo json_encode($paid);
    }



    public function get_doner_details()
    {
        $doner_id = $this->input->post('id');
        $doner = $this->donation->get_doner_by_id($doner_id);
        echo json_encode($doner);
    }

    
    /*****************Function _prepare_donation_validation**********************************
    * @type            : Function
    * @function name   : _prepare_donation_validation
    * @description     : Process "donation" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_donation_validation() {
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        $this->form_validation->set_rules('school_id', $this->lang->line('school_name'), 'trim|required');
        $this->form_validation->set_rules('doner_type', $this->lang->line('doner_type'), 'trim|required');
        $this->form_validation->set_rules('doner_name', $this->lang->line('donar_name'), 'trim|required');
        // $this->form_validation->set_rules('donation_cycle[]', $this->lang->line('donation_cycle'), 'trim|required');
        $this->form_validation->set_rules('contact_name', $this->lang->line('contact_name'), 'trim');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required');
        $this->form_validation->set_rules('address', $this->lang->line('address'), 'trim');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required');
        $this->form_validation->set_rules('donation_date', $this->lang->line('date'), 'trim|required');
        $this->form_validation->set_rules('note', $this->lang->line('note'));
        
    }

/*****************Function _save_invoice**********************************
     * @type            : Function
     * @function name   : _save_invoice
     * @description     : invoice data save into database 
     *                    while add donation data into database                
     *                       
     * @param           : $data array value
     * @return          : $inv 
     * ********************************************************** */
    private function _save_invoice($data){
        $inv = array();
        $inv['school_id'] = $data['school_id'];
        $inv['custom_invoice_id'] = $this->donation->get_custom_id('invoices', 'INV');
        $inv['academic_year_id'] = $data['academic_year_id'];
        $inv['invoice_type'] = 'donation';
        $inv['month'] = $data['donation_cycle'];
        $inv['gross_amount'] = $data['amount'];
        $inv['net_amount'] = $data['amount'];
        $inv['total_payable'] = $data['amount'];
        $inv['paid_status'] = 'paid';
        $inv['date'] = $data['donation_date'];
        $inv['note'] = $data['note'];
        $inv['status'] = 1;
        $inv['collector'] = $data['collector'];
        $inv['modified_at'] = date('Y-m-d H:i:s');
        $inv['modified_by'] = logged_in_user_id();
        $inv['created_at'] = $data['created_at'];
        $inv['created_by'] = $data['created_by'];
        return $inv;
    }

     // common    
    /*****************Function _save_transaction**********************************
     * @type            : Function
     * @function name   : _save_transaction
     * @description     : transaction data save/update into database 
     *                    while add/update income data into database                
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    private function _save_transaction($data){
            $txn = array();
            $txn['school_id'] = $data['school_id'];  
            $txn['amount'] = $data['amount'];  
            $txn['note'] = $data['note'];
            $txn['invoice_id'] = $data['invoice_id'];
            $txn['payment_date'] = $data['donation_date'];
            $txn['payment_method'] = $this->input->post('payment_method');
            $txn['bank_name'] = $this->input->post('bank_name');
            $txn['cheque_no'] = $this->input->post('cheque_no');
            $txn['mfs_name'] = $this->input->post('mfs_name');
            $txn['mfs_transaction_id'] = $this->input->post('mfs_transaction_id');

            if ($this->input->post('id')) 
            {

                $txn['modified_at'] = date('Y-m-d H:i:s');
                $txn['modified_by'] = logged_in_user_id();
                $this->donation->update('transactions', $txn, array('invoice_id'=>$this->input->post('id')));

            } 
            else 
            {            

                // $txn['invoice_id'] = $data['invoice_id'];
                $txn['status'] = 1;
                $txn['academic_year_id'] = $data['academic_year_id'];            
                $txn['created_at'] = $data['created_at'];
                $txn['created_by'] = $data['created_by'];
                $this->donation->insert('transactions', $txn);

            }        
    }
    
    /*****************Function _get_posted_donation_data**********************************
    * @type            : Function
    * @function name   : _get_posted_donation_data
    * @description     : Prepare "donation" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */

    private function _get_posted_donation_data() {
        $items = array(
            'school_id', 
            'doner_type', 
            'donation_category', 
            'donation_cycle',
            'doner_name', 
            'contact_name',  
            'email', 
            'phone', 
            'address',
            'amount', 
            'donation_date', 
            'note', 
            'doner_id',
            'collector'
        );
    
        $data = elements($items, $_POST);
        $data['collector'] = $this->session->userdata('username');
        
        if ($data['donation_category'] == 'one_time') {
            $data['donation_cycle'] = 'one_time';

            $general_fund = array(
                'general_fund' => $data['amount']
            );

            $general_fund_prev_amount = general_fund();
            $updated_general_fund = $general_fund_prev_amount->general_fund + $general_fund['general_fund'];
            $this->donation->update('global_setting', array('general_fund' => $updated_general_fund), array('id' => 1));
        } elseif($data['donation_category'] == 'zakat'){
            $data['donation_cycle'] = 'zakat';
            $zakat_fund = array(
                'zakat_fund' => $data['amount']
            );
            $zakat_fund_prev_amount = zakat_fund();
            $updated_zakat_fund = $zakat_fund_prev_amount->zakat_fund + $zakat_fund['zakat_fund'];
            $this->donation->update('global_setting', array('zakat_fund' => $updated_zakat_fund), array('id' => 1));
        }elseif($data['donation_category'] == 'boarding'){
            $data['donation_cycle'] = 'boarding';
            $boarding_fund = array(
                'boarding_fund' => $data['amount']
            );
            $boarding_fund_prev_amount = boarding_fund();
            $updated_boarding_fund = $boarding_fund_prev_amount->boarding_fund + $boarding_fund['boarding_fund'];
            $this->donation->update('global_setting', array('boarding_fund' => $updated_boarding_fund), array('id' => 1));
        }else {
            if (!empty($data['donation_cycle']) && is_array($data['donation_cycle'])) {
                $data['donation_cycle'] = implode(',', array_map('trim', $data['donation_cycle']));
            } else {
                $data['donation_cycle'] = '';
            }
            $general_fund = array(
                'general_fund' => $data['amount']
            );
            $general_fund_prev_amount = general_fund();
            $updated_general_fund = $general_fund_prev_amount->general_fund + $general_fund['general_fund'];
            $this->donation->update('global_setting', array('general_fund' => $updated_general_fund), array('id' => 1));
        }

        $data['donation_date'] = date('Y-m-d', strtotime($this->input->post('donation_date')));
        $data['modified_at'] = date('Y-m-d H:i:s');
        $data['modified_by'] = logged_in_user_id();
        $data['status'] = 'paid';
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();


        $school = $this->donation->get_school_by_id($data['school_id']);

            if (!$school->academic_year_id) {
                error($this->lang->line('set_academic_year_for_school'));
                redirect('administrator/year/index');
            }

        $data['academic_year_id'] = $school->academic_year_id;
        return $data;
    }
    
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "donation" from database                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    
    public function delete($id = null) {

        check_permission(VIEW);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('donation/collection/index');
        }
        
        $donation = $this->donation->get_single('donation_collection', array('id' => $id));
        $this->donation->delete('transactions', array('invoice_id' => $donation->invoice_id));
        $this->donation->delete('invoices', array('id' => $donation->invoice_id));
        $donation_data = $this->donation->get_single_donation($id);
        if ($this->donation->delete('donation_collection', array('id' => $id))) { 
            if($donation_data->donation_category == 'zakat'){
                $zakat_fund_prev_amount = zakat_fund();
                $updated_zakat_fund = $zakat_fund_prev_amount->zakat_fund - $donation_data->amount;
                $this->donation->update('global_setting', array('zakat_fund' => $updated_zakat_fund), array('id' => 1));
            }elseif($donation_data->donation_category == 'boarding'){
                $boarding_fund_prev_amount = boarding_fund();
                $updated_boarding_fund = $boarding_fund_prev_amount->boarding_fund - $donation_data->amount;
                $this->donation->update('global_setting', array('boarding_fund' => $updated_boarding_fund), array('id' => 1));
            }else{
                $general_fund_prev_amount = general_fund();
                $updated_general_fund = $general_fund_prev_amount->general_fund - $donation_data->amount;
                $this->donation->update('global_setting', array('general_fund' => $updated_general_fund), array('id' => 1));
            }

            success($this->lang->line('delete_success'));
            redirect('donation/collection/index/'.$donation->school_id);
            
        } else {
            error($this->lang->line('delete_failed'));
        }
        
        redirect('donation/collection/index');
    }
}
