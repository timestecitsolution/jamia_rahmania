<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Donation_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    public function get_doners_by_type_and_category($type, $category) {
        $this->db->select('id, doner_name');
        $this->db->from('doner'); 
        $this->db->where('doner_type', $type);
        $this->db->where('donation_category', $category);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_doner_by_id($id)
    {
        return $this->db->get_where('doner', ['id' => $id])->row_array();
    }

    
    public function get_donation_list($school_id = null) {

        $this->db->select('D.*, AY.session_year, S.school_name');
        $this->db->from('donation_collection AS D');
        $this->db->join('schools AS S', 'S.id = D.school_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = D.academic_year_id', 'left');

        if ($this->session->userdata('role_id') == SUPER_ADMIN && $school_id) {
            $this->db->where('D.school_id', $school_id);
        }

        if ($this->session->userdata('role_id') != SUPER_ADMIN) {
            $this->db->where('D.school_id', $this->session->userdata('school_id'));
        }

        $this->db->where('S.status', 1);
        $this->db->order_by('D.id', 'DESC');
        return $this->db->get()->result();
    }

    public function get_single_donation($id) {

        $this->db->select('D.*, AY.session_year, S.school_name, S.id as school_id, doner.doner_name, doner.phone as doner_phone, I.custom_invoice_id, I.paid_status, I.month, I.date, I.gross_amount, D.donation_category, I.collector');
        $this->db->from('donation_collection AS D');
        $this->db->join('invoices AS I', 'I.id = D.invoice_id', 'left');
        $this->db->join('schools AS S', 'S.id = D.school_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = D.academic_year_id', 'left');
        $this->db->join('doner', 'doner.id = D.doner_id', 'left');
        $this->db->where('D.id', $id);
        return $this->db->get()->row();
    }
}
