<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(0);
class Bulksmsbd {

    protected $sender_id_data;
    protected $api_data;
    protected $url_data;
    protected $status_data;

    public function __construct() {
        
        $ci = & get_instance();   
        $school_id = '';
        if($ci->session->userdata('school_id')){
            $school_id = $ci->session->userdata('school_id');
        }else{
            $school_id = $ci->input->post('school_id');
        }

        $ci->db->select('S.*');
        $ci->db->from('sms_settings AS S');     
        $ci->db->where('S.school_id', $school_id);     
        $setting = $ci->db->get()->row();
        
        $this->sender_id_data = $setting->bulksmsbd_senderid;
        $this->api_data = $setting->bulksmsbd_api_key;
        $this->url_data = $setting->bulksmsbd_url;
        $this->status_data = $setting->bulksmsbd_status;
    }

    function sms_send($phone, $message) {
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

?>