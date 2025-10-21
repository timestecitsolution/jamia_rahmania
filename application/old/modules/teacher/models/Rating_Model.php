<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rating_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_teacher_list($school_id, $class_id){
           
       
        $this->db->select('S.teacher_id');
        $this->db->from('subjects AS S');
        $this->db->where('S.school_id', $school_id);
        $this->db->where_in('S.class_id', $class_id);

        $subjects = $this->db->get()->result();   
         
        $teacher_ids = array();
        if(isset($subjects) && !empty($subjects)){
            foreach($subjects as $obj){
              $teacher_ids[] = $obj->teacher_id;  
            }
        }
        
        // getting teacher for student subject wise
        $this->db->select('T.*, Su.name AS subject, Su.id as subject_id, U.role_id, S.school_name');
        $this->db->from('teachers AS T');
        // $this->db->join('departments AS D', 'D.id = T.department_id', 'left');        
        $this->db->join('subjects AS Su', 'Su.teacher_id = T.id');        
        $this->db->join('users AS U', 'U.id = T.user_id', 'left');
        $this->db->join('schools AS S', 'S.id = T.school_id', 'left'); 
        $this->db->where_in('T.id', $teacher_ids);
        
       if($this->session->userdata('role_id') == SUPER_ADMIN && $school_id){
            $this->db->where('T.school_id', $school_id);
        } 
        if($this->session->userdata('role_id') != SUPER_ADMIN){
           $this->db->where('T.school_id', $this->session->userdata('school_id'));
        }
        if(!empty($class_id))
        {
           $this->db->where('Su.class_id', $class_id); 
        }
        
        $this->db->where('T.status', 1);
        $this->db->order_by('T.id','DESC');
        return  $this->db->get()->result();  
              
    }
    
    
    public function get_teacher_rating_list($school_id = null, $academic_year_id = null, $techer_id = null){
        
        $this->db->select('R.*, SC.school_name, S.name AS student_name, T.name AS teacher, T.photo, D.title AS department');
        $this->db->from('ratings AS R');
        $this->db->join('students AS S', 'S.id = R.student_id', 'left');
        $this->db->join('teachers AS T', 'T.id = R.teacher_id', 'left');
        $this->db->join('departments AS D', 'D.id = T.department_id', 'left'); 
        $this->db->join('schools AS SC', 'SC.id = R.school_id', 'left'); 
        
        if($school_id){        
            $this->db->where('R.school_id', $school_id);
        }
        if($academic_year_id){        
            $this->db->where('R.academic_year_id', $academic_year_id);
        }  
        if($techer_id){        
            $this->db->where('R.teacher_id', $techer_id);
        }        
        return $this->db->get()->result();
    }

    
    public function get_teacher_rating_list_class_subjectwise($school_id = null, $academic_year_id = null, $teacher_id = null, $month_year = null)
    {
        $currentMonthYear = $month_year;
        $this->db->select('R.subject_id, 
                           R.class_id, 
                           R.section_id, 
                           R.month, 
                           R.teacher_id, 
                           T.name AS teacher,
                           C.name as class_name, 
                           S.name as section_name,
                           Su.name AS subject, 
                           AVG(R.rating) as avg_rating, 
                           AVG(R.rating1) as avg_rating1, 
                           AVG(R.rating2) as avg_rating2'); 

        $this->db->from('ratings AS R');
        $this->db->join('teachers AS T', 'T.id = R.teacher_id', 'left');
        $this->db->join('classes AS C', 'C.id = R.class_id');
        $this->db->join('sections AS S', 'S.id = R.section_id');
        $this->db->join('subjects AS Su', 'Su.teacher_id = T.id AND Su.class_id = R.class_id AND Su.id = R.subject_id', 'left');
        
        if ($school_id) {
            $this->db->where('R.school_id', $school_id);
        }
        if ($academic_year_id) {
            $this->db->where('R.academic_year_id', $academic_year_id);
        }
        if ($teacher_id) {
            $this->db->where('R.teacher_id', $teacher_id);
        }
        $this->db->where('R.month', $currentMonthYear);  
        $this->db->group_by('R.subject_id, R.class_id, R.section_id, R.month');
        
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_rating_list($teacher_id = null, $class_id = null, $section_id = null, $subject_id = null, $month = null, $academic_year_id = null){
        
        $this->db->select('R.subject_id, 
                           R.class_id, 
                           R.section_id, 
                           R.month, 
                           R.teacher_id, 
                           T.name AS teacher,
                           C.name as class_name, 
                           Se.name as section_name,
                           Su.name AS subject, 
                           S.name AS student_name,
                           R.comment,
                           R.rating,
                           R.rating1, 
                           R.rating2'); 

        $this->db->from('ratings AS R');
        $this->db->join('teachers AS T', 'T.id = R.teacher_id', 'left');
        $this->db->join('classes AS C', 'C.id = R.class_id');
        $this->db->join('sections AS Se', 'Se.id = R.section_id');
        $this->db->join('subjects AS Su', 'Su.teacher_id = T.id AND Su.class_id = R.class_id AND Su.id = R.subject_id', 'left');
        $this->db->join('students AS S', 'S.id = R.student_id', 'left');
        
        if($school_id){        
            $this->db->where('R.school_id', $school_id);
        }
        if($academic_year_id){        
            $this->db->where('R.academic_year_id', $academic_year_id);
        }  
        if($teacher_id){        
            $this->db->where('R.teacher_id', $teacher_id);
        }   
        if($class_id){        
            $this->db->where('R.class_id', $class_id);
        } 
        if($section_id){        
            $this->db->where('R.section_id', $section_id);
        } 
        if($subject_id){        
            $this->db->where('R.subject_id', $subject_id);
        } 
        if($month){        
            $this->db->where('R.month', $month);
        }
             
        return $this->db->get()->result();
    }

}
