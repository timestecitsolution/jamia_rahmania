<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Mark.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Mark
 * @description     : Manage exam mark for student whose are attend in the exam.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Mark extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->helper('util');
        $this->load->model('Mark_Model', 'mark', true);   
        $this->load->model('Attendance_Model', 'attendance', true);  
        
        // need to check school subscription status
        if($this->session->userdata('role_id') != SUPER_ADMIN){                 
            if(!check_saas_status($this->session->userdata('school_id'), 'is_enable_exam_mark')){                        
              redirect('dashboard/index');
            }
        }
    }

    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Exam Mark List" user interface                 
    *                    with filter option  
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        check_permission(VIEW);
       

        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $exam_id = $this->input->post('exam_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $subject_id = $this->input->post('subject_id');

            if($_SESSION['role_id'] == 5)
            {
                $school_id = $_SESSION['school_id'];
            }

            $school = $this->mark->get_school_by_id($school_id);
            if(!$school->academic_year_id){
                error($this->lang->line('set_academic_year_for_school'));
                redirect('exam/mark/index');
            }
            
            $this->data['students'] = $this->mark->get_student_list($school_id, $exam_id, $class_id, $section_id, $subject_id, $school->academic_year_id);

            $condition = array(
                'school_id' => $school_id,
                'exam_id' => $exam_id,
                'class_id' => $class_id,
                'academic_year_id' => $school->academic_year_id,
                'subject_id' => $subject_id
            );
            
            if($section_id){
                $condition['section_id'] = $section_id;
            }

            $data = $condition;
            
            if (!empty($this->data['students'])) {

                foreach ($this->data['students'] as $obj) {

                    $condition['student_id'] = $obj->student_id;
                    $mark = $this->mark->get_single('marks', $condition);

                    if (empty($mark)) {
                        
                        $data['section_id'] = $obj->section_id;
                        $data['student_id'] = $obj->student_id;
                        $data['status'] = 1;
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $data['created_by'] = logged_in_user_id();
                        $this->mark->insert('marks', $data);
                    }
                }
            }

            $this->data['grades'] = $this->mark->get_list('grades', array('status' => 1, 'school_id'=>$school_id), '', '', '', 'id', 'ASC');
            
            $this->data['school_id'] = $school_id;
            $this->data['exam_id'] = $exam_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['subject_id'] = $subject_id;
            $this->data['academic_year_id'] = $school->academic_year_id;
                        
            $class = $this->mark->get_single('classes', array('id'=>$class_id));
            create_log('Has been process exam mark for class: '. $class->name);
            
        }
        
        
        $condition = array();
        $condition['status'] = 1;  
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $school = $this->mark->get_school_by_id($this->session->userdata('school_id'));
            $condition['school_id'] = $this->session->userdata('school_id');
            $this->data['classes'] = $this->mark->get_list('classes', $condition, '','', '', 'id', 'ASC');
            $condition['academic_year_id'] = $school->academic_year_id;
            $this->data['exams'] = $this->mark->get_list('exams', $condition, '', '', '', 'id', 'ASC');
        }  

        $this->layout->title($this->lang->line('manage_mark') . ' | ' . SMS);
        $this->layout->view('mark/index', $this->data);
    }

    
    public function mark_print() {

        check_permission(VIEW);
        

        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $exam_id = $this->input->post('exam_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $subject_id = $this->input->post('subject_id');

            if($_SESSION['role_id'] == 5)
            {
                $school_id = $_SESSION['school_id'];
            }

            $school = $this->mark->get_school_by_id($school_id);
            if(!$school->academic_year_id){
                error($this->lang->line('set_academic_year_for_school'));
                redirect('exam/mark/index');
            }
            
            $this->data['students'] = $this->mark->get_student_list_mark_print($school_id, $exam_id, $class_id, $section_id, $subject_id, $school->academic_year_id);

            $this->data['subjects'] = $this->mark->get_exam_wise_subject($exam_id);
            $this->data['subject_name'] = $this->mark->get_single('subjects', array('id' => $subject_id));
            // dump_data($this->data['students']);

            foreach ($this->data['students'] as $student) {
                $student->formatted_rank = format_rank_suffix($student->rank);
            }
            $condition = array(
                'school_id' => $school_id,
                'exam_id' => $exam_id,
                'class_id' => $class_id,
                'academic_year_id' => $school->academic_year_id,
                'subject_id' => $subject_id
            );
            
            if($section_id){
                $condition['section_id'] = $section_id;
            }

            $data = $condition;
            
            if (!empty($this->data['students'])) {

                foreach ($this->data['students'] as $obj) {

                    $condition['student_id'] = $obj->student_id;
                    $mark = $this->mark->get_single('marks', $condition);
                    if (empty($mark)) {
                        
                        $data['section_id'] = $obj->section_id;
                        $data['student_id'] = $obj->student_id;
                        $data['status'] = 1;
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $data['created_by'] = logged_in_user_id();
                        $this->mark->insert('marks', $data);
                    }
                }
            }

            $this->data['grades'] = $this->mark->get_list('grades', array('status' => 1, 'school_id'=>$school_id), '', '', '', 'id', 'ASC');
            
            $this->data['school_id'] = $school_id;
            $this->data['exam_id'] = $exam_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['subject_id'] = $subject_id;
            $this->data['academic_year_id'] = $school->academic_year_id;
            $this->data['class'] = $this->db->get_where('classes', array('id'=>$class_id))->row()->name;
            if($section_id != null){
                $this->data['section'] = $this->db->get_where('sections', array('id'=>$section_id))->row()->name;
            }
            $this->data['academic_year'] = $this->db->get_where('academic_years', array('id'=>$school->academic_year_id))->row()->session_year;
            $this->data['school'] = $school;
            $class = $this->mark->get_single('classes', array('id'=>$class_id));
            create_log('Has been process exam mark for class: '. $class->name);
            
        }
        
        
        $condition = array();
        $condition['status'] = 1;  
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $school = $this->mark->get_school_by_id($this->session->userdata('school_id'));
            $this->data['school'] = $school;
            $condition['school_id'] = $this->session->userdata('school_id');
            $this->data['classes'] = $this->mark->get_list('classes', $condition, '','', '', 'id', 'ASC');
            $condition['academic_year_id'] = $school->academic_year_id;
            $this->data['exams'] = $this->mark->get_list('exams', $condition, '', '', '', 'id', 'ASC');
        }  

        $this->layout->title('Mark Print' . ' | ' . SMS);
        $this->layout->view('mark/mark_print', $this->data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Process to store "Exam Mark" into database                
    *                     
    * @param           : null
    * @return          : null 
     * ********************************************************** */
    
    public function add() {

        check_permission(ADD);

        if ($_POST) {

          
            

            $school_id = $this->input->post('school_id');
            $exam_id = $this->input->post('exam_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $subject_id = $this->input->post('subject_id');

            $school = $this->mark->get_school_by_id($school_id);
            if(!$school->academic_year_id){
                error($this->lang->line('set_academic_year_for_school'));
                redirect('exam/mark/index');
            }
            
            $condition = array(
                'school_id' => $school_id,
                'exam_id' => $exam_id,
                'class_id' => $class_id,
                'academic_year_id' => $school->academic_year_id,
                'subject_id' => $subject_id
            );
            
            if($section_id){
                $condition['section_id'] = $section_id;
            }            

            $data = $condition;

            if (!empty($_POST['students'])) {
                
                foreach ($_POST['students'] as $key => $value) {
                    if($section_id)
                    {
                        $attendance = get_exam_attendance($school_id, $value, $school->academic_year_id, $exam_id, $class_id, $section_id, $subject_id);
                    }
                    else
                    {
                        $attendance = get_exam_attendance($school_id, $value, $school->academic_year_id, $exam_id, $class_id, '', $subject_id);
                    }
                    
                   
                    if($_POST['obtain_total_mark'][$value] > 0)
                    {
                        $status = 1;
                    }
                    else
                    {
                        $status = 0;
                    }
                    if($attendance==0 && $_POST['obtain_total_mark'][$value] >= 0)
                    {
                       
                        $condition_new['school_id'] = $school_id;
                        $condition_new['student_id'] = $value;
                        $condition_new['exam_id'] = $exam_id;
                        $condition_new['class_id'] = $class_id;
                        if($section_id){
                            $condition_new['section_id'] = $section_id;
                        }
                        $condition_new['subject_id'] = $subject_id;
                        $condition_new['academic_year_id'] = $school->academic_year_id;
                        $data_new['is_attend'] = $status;
                        $data_new['modified_at'] = date('Y-m-d H:i:s');
                        $data_new['modified_by'] = logged_in_user_id();
                        $this->attendance->update('exam_attendances', $data_new, $condition_new);
                    }

                    if(empty($attendance)  && $_POST['obtain_total_mark'][$value] >= 0  )
                    {

                        
                        $condition_new_x['school_id'] = $school_id;
                        $condition_new_x['student_id'] = $value;
                        $condition_new_x['exam_id'] = $exam_id;
                        $condition_new_x['class_id'] = $class_id;
                        if($section_id){
                            $condition_new_x['section_id'] = $section_id;
                        }
                        $condition_new_x['subject_id'] = $subject_id;
                        $condition_new_x['academic_year_id'] = $school->academic_year_id;
                        $condition_new_x['is_attend'] = $status ;
                        $condition_new_x['created_at'] = date('Y-m-d H:i:s');
                        $condition_new_x['created_by'] = logged_in_user_id();
                        $this->attendance->insert('exam_attendances', $condition_new_x);
                    }
                    

                    $condition['student_id'] = $value;
                    $data['written_mark'] = $_POST['written_mark'][$value];
                    $data['written_obtain'] = $_POST['written_obtain'][$value];
                    
                    $data['tutorial_mark'] = $_POST['tutorial_mark'][$value];
                    $data['tutorial_obtain'] = $_POST['tutorial_obtain'][$value];
                    
                    $data['practical_mark'] = $_POST['practical_mark'][$value];
                    $data['practical_obtain'] = $_POST['practical_obtain'][$value];
                    
                    $data['viva_mark'] = $_POST['viva_mark'][$value];
                    $data['viva_obtain'] = $_POST['viva_obtain'][$value];
                    
                    $data['exam_total_mark'] = $_POST['exam_total_mark'][$value];
                    $data['obtain_total_mark'] = $_POST['obtain_total_mark'][$value];

                    $flag = 0;
                    $mark_grades = $this->mark->get_list('grades', array('status'=>1, 'school_id'=>$school_id), '','', '', 'id', 'ASC'); 
                    if(!empty($data['written_mark']))
                    {
                        $conver_written_mark = ((float)$data['written_obtain'] / (float)$data['written_mark']) * 100;
                        if (!empty($mark_grades)) {
                            foreach ($mark_grades as $obj) {   
                                if($obj->mark_from <= $conver_written_mark && $obj->mark_to >= $conver_written_mark)
                                {
                                   
                                    if($obj->point == "0.00")
                                    {
                                        $flag = 1;
                                        $grade_id = $obj->id;
                                    }
                                }
                            }
                        }
                    }
                    
                    if(!empty($data['tutorial_mark']))
                    {
                        $conver_tutorial_mark = ((float)$data['tutorial_obtain'] / (float)$data['tutorial_mark']) * 100;


                        if (!empty($mark_grades) && $flag == 0) {
                            foreach ($mark_grades as $obj) {   
                                if($obj->mark_from <= $conver_tutorial_mark && $obj->mark_to >= $conver_tutorial_mark)
                                {
                                   
                                    if($obj->point == "0.00")
                                    {
                                        $flag = 1;
                                        $grade_id = $obj->id;
                                    }
                                }
                            }
                        }
                    }
                    
                    if(!empty($data['practical_mark']))
                    {
                        $conver_practical_mark = ((float)$data['practical_obtain'] / (float)$data['practical_mark']) * 100;
                        if (!empty($mark_grades) && $flag == 0) {
                            foreach ($mark_grades as $obj) {   
                                if($obj->mark_from <= $conver_practical_mark && $obj->mark_to >= $conver_practical_mark)
                                {
                                   
                                    if($obj->point == "0.00")
                                    {
                                        $flag = 1;
                                        $grade_id = $obj->id;
                                    }
                                }
                            }
                        }
                    }

                    
                    if(!empty($data['viva_mark']))
                    {
                        $conver_viva_mark = ((float)$data['viva_obtain'] / (float)$data['viva_mark']) * 100;
                        if (!empty($mark_grades) && $flag == 0) {
                            foreach ($mark_grades as $obj) {   
                                if($obj->mark_from <= $conver_viva_mark && $obj->mark_to >= $conver_viva_mark)
                                {
                                   
                                    if($obj->point == "0.00")
                                    {
                                        $flag = 1;
                                        $grade_id = $obj->id;
                                    }
                                }
                            }
                        }
                    }

                    $conver_mark = ((float)$data['obtain_total_mark'] / (float)$data['exam_total_mark']) * 100;

                    if (!empty($mark_grades) && $flag == 0) {
                        foreach ($mark_grades as $obj) {   
                            if($obj->mark_from <= $conver_mark && $obj->mark_to >= $conver_mark)
                            {
                                $grade_id = $obj->id;
                            }
                        }
                    }

                    
                    
                    $data['grade_id'] = $grade_id;                    
                    $data['remark'] = $_POST['remark'][$value];
                    
                    $data['status'] = 1;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['created_by'] = logged_in_user_id();
                    $this->mark->update('marks', $data, $condition);
                }
            }
            
            $class = $this->mark->get_single('classes', array('id'=>$class_id));
            create_log('Has been process exam mark and save for class: '. $class->name);
            
            success($this->lang->line('insert_success'));
            redirect('exam/mark/index');
        }
        $this->layout->title($this->lang->line('add')  . ' | ' . SMS);
        $this->layout->view('mark/index', $this->data);
    }
    public function add_old() {

        check_permission(ADD);

        if ($_POST) {

          
            

            $school_id = $this->input->post('school_id');
            $exam_id = $this->input->post('exam_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $subject_id = $this->input->post('subject_id');

            $school = $this->mark->get_school_by_id($school_id);
            if(!$school->academic_year_id){
                error($this->lang->line('set_academic_year_for_school'));
                redirect('exam/mark/index');
            }
            
            $condition = array(
                'school_id' => $school_id,
                'exam_id' => $exam_id,
                'class_id' => $class_id,
                'academic_year_id' => $school->academic_year_id,
                'subject_id' => $subject_id
            );
            
            if($section_id){
                $condition['section_id'] = $section_id;
            }            

            $data = $condition;

            if (!empty($_POST['students'])) {

                foreach ($_POST['students'] as $key => $value) {
                    if($section_id)
                    {
                        $attendance = get_exam_attendance($school_id, $value, $school->academic_year_id, $exam_id, $class_id, $section_id, $subject_id);
                    }
                    else
                    {
                        $attendance = get_exam_attendance($school_id, $value, $school->academic_year_id, $exam_id, $class_id, '', $subject_id);
                    }
                    
                   
            
                    if($attendance==0 && $_POST['obtain_total_mark'][$value] >= 0)
                    {
                        $status = 1;
                        $condition_new['school_id'] = $school_id;
                        $condition_new['student_id'] = $value;
                        $condition_new['exam_id'] = $exam_id;
                        $condition_new['class_id'] = $class_id;
                        if($section_id){
                            $condition_new['section_id'] = $section_id;
                        }
                        $condition_new['subject_id'] = $subject_id;
                        $condition_new['academic_year_id'] = $school->academic_year_id;
                        $data_new['is_attend'] = $status ? 1 : 0;
                        $data_new['modified_at'] = date('Y-m-d H:i:s');
                        $data_new['modified_by'] = logged_in_user_id();
                        $this->attendance->update('exam_attendances', $data_new, $condition_new);
                    }
                    

                    $condition['student_id'] = $value;
                    $data['written_mark'] = $_POST['written_mark'][$value];
                    $data['written_obtain'] = $_POST['written_obtain'][$value];
                    
                    $data['tutorial_mark'] = $_POST['tutorial_mark'][$value];
                    $data['tutorial_obtain'] = $_POST['tutorial_obtain'][$value];
                    
                    $data['practical_mark'] = $_POST['practical_mark'][$value];
                    $data['practical_obtain'] = $_POST['practical_obtain'][$value];
                    
                    $data['viva_mark'] = $_POST['viva_mark'][$value];
                    $data['viva_obtain'] = $_POST['viva_obtain'][$value];
                    
                    $data['exam_total_mark'] = $_POST['exam_total_mark'][$value];
                    $data['obtain_total_mark'] = $_POST['obtain_total_mark'][$value];

                    $conver_mark = ($data['obtain_total_mark'] / $data['exam_total_mark']) * 100;
         
                    $mark_grades = $this->mark->get_list('grades', array('status'=>1, 'school_id'=>$school_id), '','', '', 'id', 'ASC'); 

                    if (!empty($mark_grades)) {
                        foreach ($mark_grades as $obj) {   
                            if($obj->mark_from <= $conver_mark && $obj->mark_to >= $conver_mark)
                            {
                                $grade_id = $obj->id;
                            }
                        }
                    }
                    
                    $data['grade_id'] = $grade_id;                    
                    $data['remark'] = $_POST['remark'][$value];
                    
                    $data['status'] = 1;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['created_by'] = logged_in_user_id();
                    $this->mark->update('marks', $data, $condition);
                }
            }
            
            $class = $this->mark->get_single('classes', array('id'=>$class_id));
            create_log('Has been process exam mark and save for class: '. $class->name);
            
            success($this->lang->line('insert_success'));
            redirect('exam/mark/index');
        }

        $this->layout->title($this->lang->line('add')  . ' | ' . SMS);
        $this->layout->view('mark/index', $this->data);
    }

}
