<?php
    $all_mark_array = [];
    
    function getNumberPosition($numbers, $target) {
        
        $uniqueSorted = array_unique($numbers);
        rsort($uniqueSorted);
        $position = array_search($target, $uniqueSorted);
        if ($position === false) {
            return "Number not found in the array.";
        }
        $position++; 
        $suffix = 'th';
        if (!in_array(($position % 100), [11, 12, 13])) {
            switch ($position % 10) {
                case 1: $suffix = 'st'; break;
                case 2: $suffix = 'nd'; break;
                case 3: $suffix = 'rd'; break;
            }
        }

        return "{$position}{$suffix}";
    }


?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-file-text-o"></i><small> Mark Print</small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
               
            <div class="x_content quick-link no-print">
                 <?php $this->load->view('quick-link-exam'); ?> 
            </div>      
            
            
            
            <div class="x_content no-print"> 
                <?php echo form_open_multipart(site_url('exam/mark/mark_print'), array('name' => 'mark', 'id' => 'mark', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">
                    
                    <div class="col-md-10 col-sm-10 col-xs-12">
                    
                    <?php $this->load->view('layout/school_list_filter'); ?>   
                        
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('exam'); ?>  <span class="required">*</span></div>
                            <select  class="select2_mamun form-control col-md-7 col-xs-12" name="exam_id" id="exam_id"  required="required">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php if(isset($exams) && !empty($exams)) { ?>
                                    <?php foreach ($exams as $obj) { ?>
                                    <option value="<?php echo $obj->id; ?>" <?php if(isset($exam_id) && $exam_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->title; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <div class="help-block"><?php echo form_error('exam_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('class'); ?>  <span class="required">*</span></div>
                            <?php $teacher_student_data = get_teacher_access_data('student'); ?>
                            <select  class="select2_mamun form-control col-md-7 col-xs-12" name="class_id" id="class_id"  required="required" onchange="get_section_subject_by_class(this.value,'','');">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php foreach ($classes as $obj) { ?>
                                    <?php if(isset($classes) && !empty($classes)) { ?>
                                    <?php if($this->session->userdata('role_id') == TEACHER && !in_array($obj->id, $teacher_student_data)){ continue; } ?>   
                                    <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <div class="help-block"><?php echo form_error('class_id'); ?></div>
                        </div>
                    </div>
                    
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('section'); ?></div>
                            <select  class="select2_mamun form-control col-md-7 col-xs-12" name="section_id" id="section_id">                                
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                            </select>
                            <div class="help-block"><?php echo form_error('section_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('subject'); ?>  <span class="required">*</span></div>
                            <select  class="select2_mamun form-control col-md-7 col-xs-12" name="subject_id" id="subject_id" required="required">                                
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                            </select>
                            <div class="help-block"><?php echo form_error('subject_id'); ?></div>
                        </div>
                    </div>
                    </div>
                
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

           <?php  if (isset($students) && !empty($students)) { ?>
            <!-- <div class="x_content">             
                <div class="row">
                    <div class="col-sm-4  col-sm-offset-4 layout-box">
                        <p>
                            <h4><?php echo $this->lang->line('exam_mark'); ?></h4>                            
                        </p>
                    </div>
                </div>            
            </div> -->
            <div class="x_content">             
                <div class="row">                                                      
                    <div class="col-sm-6  col-xs-6 col-sm-offset-3 col-xs-offset-3 layout-box">
                        <p> &nbsp;
                            <?php if(isset($school)){ ?>
                            <div><img   src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->logo; ?>" alt="" width="70" /></div>
                            <h4><?php echo $school->school_name; ?></h4>
                            <p> <?php echo $school->address; ?></p>
                            <?php } ?>
                            <h4 class="head-title_ ptint-title"><small> <?php echo $this->lang->line('exam_mark'); ?> </small></h4>                
                            <?php if(isset($academic_year)){ ?>
                            <div> &nbsp;
                            <?php echo $this->lang->line('academic_year'); ?>: <?php echo $academic_year; ?>
                            </div>
                            <?php } ?>
                            <div>
                            <?php if(isset($class)){ ?>
                            <?php echo $this->lang->line('class'); ?>: <?php echo $class; ?>
                            <?php } ?>
                            <?php if(isset($section)){ ?>
                            , <?php echo $this->lang->line('section'); ?>: <?php echo $section; ?>
                            <?php } ?>
                            </div>
                            <div>
                               <div>
                                    <?php if (isset($subjects) && !empty($subjects)) {
                                        echo $this->lang->line('exam') . ": " . $subjects[0]->exam . "<br>";

                                        $subject_names = array_map(function($item) {
                                            return $item->subject;
                                        }, $subjects);

                                        echo $this->lang->line('subject') . ": " . $subject_name->name;
                                    } ?>
                                </div>
                            </div>
                         </p>
                    </div>
                </div>            
            </div>
             <?php } ?>

             <?php 
             $flag_written = 0;
             $flag_tutorial = 0;
             $flag_practical = 0;
             $flag_viva = 0;
             $flag_total = 0;

            if(!empty($students ))
            {

              $student_marks = [];
                 foreach ($students as $obj) { 
                    $mark = get_exam_mark($school_id, $obj->student_id, $academic_year_id, $exam_id, $class_id, $section_id, $subject_id);
                    if(!empty($mark) && $mark->written_mark > 0  || !empty($mark) && $mark->written_obtain > 0)
                    {
                        $flag_written = 1;
                    }
                    if(!empty($mark) && $mark->tutorial_mark > 0  || !empty($mark) && $mark->tutorial_obtain > 0)
                    {
                        $flag_tutorial = 1;
                    }
                    if(!empty($mark) && $mark->practical_mark > 0  || !empty($mark) && $mark->practical_obtain > 0)
                    {
                        $flag_practical = 1;
                    }
                    if(!empty($mark) && $mark->viva_mark > 0  || !empty($mark) && $mark->viva_obtain > 0)
                    {
                        $flag_viva = 1;
                    }
                    if(!empty($mark) && $mark->exam_total_mark > 0  || !empty($mark) && $mark->obtain_total_mark > 0)
                    {
                        $flag_total = 1;
                    }


                    array_push($all_mark_array, $mark->obtain_total_mark);

                    $student_marks[] = [
                        'student' => $obj,
                        'mark' => $mark,
                        'obtain_total_mark' => !empty($mark) ? floatval($mark->obtain_total_mark) : 0
                    ];

                }
                usort($student_marks, function($a, $b) {
                    if ($b['obtain_total_mark'] == $a['obtain_total_mark']) {
                    return 0;
                }
                    return ($b['obtain_total_mark'] < $a['obtain_total_mark']) ? -1 : 1;
                });

            }?>
            
       
                   
                <div class="x_content ">    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th rowspan="2"><?php echo $this->lang->line('roll_no'); ?></th>
                                <th rowspan="2"><?php echo $this->lang->line('name'); ?></th>
                                <?php if($flag_written == 1)
                                { ?>
                                    <th colspan="2"><?php echo $this->lang->line('cq'); ?></th>
                                <?php } ?>
                                <?php if($flag_tutorial == 1)
                                { ?>                                           
                                <th colspan="2"><?php echo $this->lang->line('mcq'); ?></th> 
                                <?php } ?>                                      
                                <?php if($flag_practical == 1)
                                { ?>
                                <th colspan="2"><?php echo $this->lang->line('practical'); ?></th>  
                                <?php } ?>

                                <?php if($flag_viva == 1)
                                { ?>                                          
                                <th colspan="2"><?php echo $this->lang->line('viva'); ?></th>
                                <?php } ?> 

                                <?php if($flag_total == 1)
                                { ?>                                         
                                <th colspan="2"><?php echo $this->lang->line('total'); ?></th>    
                                <?php } ?>

                                <!-- <th rowspan="2"><?php //echo $this->lang->line('letter_grade'); ?></th>                                             -->
                                <th rowspan="2"><?php echo $this->lang->line('merit'); ?></th>                                            
                                <!-- <th><?php echo $this->lang->line('position_in_section'); ?></th>                                        -->
                            </tr>
                            <tr>   
                                <?php if($flag_written == 1)
                                { ?>                        
                                <th><?php echo $this->lang->line('mark'); ?></th>                                            
                                <th><?php echo $this->lang->line('obtain'); ?></th>  
                                <?php } ?>

                                <?php if($flag_tutorial == 1)
                                { ?>                                          
                                <th><?php echo $this->lang->line('mark'); ?></th>                                            
                                <th><?php echo $this->lang->line('obtain'); ?></th>  
                                <?php } ?>

                                <?php if($flag_practical == 1)
                                { ?>                                          
                                <th><?php echo $this->lang->line('mark'); ?></th>                                            
                                <th><?php echo $this->lang->line('obtain'); ?></th>  
                                <?php } ?>

                                <?php if($flag_viva == 1)
                                { ?>                                          
                                <th><?php echo $this->lang->line('mark'); ?></th>                                            
                                <th><?php echo $this->lang->line('obtain'); ?></th>    
                                <?php } ?>

                                <?php if($flag_total == 1)
                                { ?>                                        
                                <th><?php echo $this->lang->line('mark'); ?></th>                                            
                                <th><?php echo $this->lang->line('obtain'); ?></th>
                                <?php } ?>                                           
                            </tr>
                        </thead>
                        <tbody id="fn_mark">   
                            <?php
                            $count = 1;
                            if (isset($students) && !empty($students)) {
                                
                                ?>
                                <?php foreach ($students  as $obj) { ?>


                                <?php  $mark = get_exam_mark($school_id, $obj->student_id, $academic_year_id, $exam_id, $class_id, $section_id, $subject_id); ?>
                                <?php  
                                
                                $attendance = get_exam_attendance($school_id, $obj->student_id, $academic_year_id, $exam_id, $class_id, $section_id, $subject_id); 
                                ?>
                                    <tr>
                                        <td><?php echo $obj->roll_no; ?></td>
                                        <td><?php echo ucfirst($obj->student_name); ?></td>
                                        <?php if($flag_written == 1)
                                        { ?> 
                                        <td>
                                            <?php if(!empty($mark) && $mark->written_mark > 0){ echo $mark->written_mark; }else{ echo '';} ?>
                                        </td>
                                        <td>
                                            <?php if(!empty($mark) && $mark->written_obtain > 0 ){ echo $mark->written_obtain; }else{ echo ''; } ?>
                                        </td>
                                        <?php } ?>

                                        <?php if($flag_tutorial == 1)
                                        { ?> 
                                        <td>
                                            <?php if(!empty($mark) && $mark->tutorial_mark > 0){ echo $mark->tutorial_mark; }else{ echo '';} ?>
                                        </td>
                                        <td>
                                            <?php if(!empty($mark) && $mark->tutorial_obtain > 0 ){ echo $mark->tutorial_obtain; }else{ echo ''; } ?>
                                        </td>
                                        <?php } ?>

                                        <?php if($flag_practical == 1)
                                        { ?> 
                                        <td>
                                            <?php if(!empty($mark) && $mark->practical_mark > 0){ echo $mark->practical_mark; }else{ echo '';} ?>
                                        </td>
                                        <td>
                                            <?php if(!empty($mark) && $mark->practical_obtain > 0 ){ echo $mark->practical_obtain; }else{ echo ''; } ?>
                                        </td>
                                        <?php } ?>

                                        <?php if($flag_viva == 1)
                                        { ?> 
                                        <td>
                                           <?php if(!empty($mark) && $mark->viva_mark > 0){ echo $mark->viva_mark; }else{ echo '';} ?>
                                        </td>
                                        <td>
                                            <?php if(!empty($mark) && $mark->viva_obtain > 0 ){ echo $mark->viva_obtain; }else{ echo ''; } ?>
                                        </td>  
                                        <?php } ?>

                                        <?php if($flag_total == 1)
                                        { ?> 
                                        <td>
                                            <?php if(!empty($mark) && $mark->exam_total_mark > 0){ echo $mark->exam_total_mark; }else{ echo '';} ?>
                                        </td>
                                        <td>
                                            <?php if(!empty($mark) && $mark->obtain_total_mark > 0 ){ echo $mark->obtain_total_mark; }else{ echo ''; } ?>
                                        </td>   
                                        <?php } ?>

                                        <!-- <td>
                                            <?php if(!empty($mark) && $mark->obtain_total_mark > 0 )
                                            { ?>
                                            <?php foreach ($grades as $grade) { ?>
                                            <?php if(isset($mark) && $mark->grade_id == $grade->id || $mark->grade_id == 0){  ?><?php echo $grade->name; ?> [<?php echo $grade->point; ?>]
                                            <?php } }?>
                                            <?php }?>
                                        </td> -->
                                        <!-- <td>
                                            <?php if(!empty($mark) && $mark->remark != '' ){ echo $mark->remark; }else{ echo ''; } ?>
                                            
                                        </td> -->
                                        <td>
                                            <?php 
                                            if(!empty($mark->obtain_total_mark))
                                            {
                                                echo getNumberPosition($all_mark_array, $mark->obtain_total_mark);
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php }else{ ?>
                                    <tr>
                                        <td colspan="15" align="center"><?php echo $this->lang->line('no_data_found'); ?></td>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                
                


                <div class="row no-print">
                    <div class="col-xs-12 text-right">
                        <button class="btn btn-default " onclick="window.print();"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                    </div>
                </div>

                <div class="ln_solid"></div>

                
            
            
        </div>
    </div>
</div>
 
<!-- Super admin js START  -->
 <script type="text/javascript">
        
    $("document").ready(function() {
         <?php if(isset($school_id) && !empty($school_id)){ ?>               
            $(".fn_school_id").trigger('change');
         <?php } ?>
    });

    $('#mark_input_x').on('click', function(){
        var written_mark_num   = $('#written_mark_num').val(); 
        var tutorial_mark_num  = $('#tutorial_mark_num').val(); 
        var practical_mark_num = $('#practical_mark_num').val(); 
        var viva_mark_num      = $('#viva_mark_num').val(); 
        var exam_total_mark = 0;
        if( $('#written_mark_num').val().length != 0 )
        {
            $('.fn_written_mark').val(written_mark_num); 
            exam_total_mark += +written_mark_num;
        }

        if( $('#tutorial_mark_num').val().length != 0)
        {
            $('.fn_tutorial_mark').val(tutorial_mark_num); 
            exam_total_mark += +tutorial_mark_num;
            
        }
        if( $('#practical_mark_num').val().length != 0)
        {
            $('.fn_practical_mark').val(practical_mark_num);
            exam_total_mark += +practical_mark_num;
        }
        if( $('#viva_mark_num').val().length != 0)
        {
            $('.fn_viva_mark').val(viva_mark_num);
            exam_total_mark += +viva_mark_num;
        }
        
        $('.exam_total_mark').val(exam_total_mark); 
        
        
        
        

    });
    
    $('.fn_school_id').on('change', function(){
      
        var school_id = $(this).val();
        var exam_id = '';
        var class_id = '';
        
        <?php if(isset($school_id) && !empty($school_id)){ ?>
            exam_id =  '<?php echo $exam_id; ?>';           
            class_id =  '<?php echo $class_id; ?>';           
         <?php } ?> 
           
        if(!school_id){
           toastr.error('<?php echo $this->lang->line("select_school"); ?>');
           return false;
        }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_exam_by_school'); ?>",
            data   : { school_id:school_id, exam_id:exam_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                    $('#exam_id').html(response);  
                   get_class_by_school(school_id,class_id); 
               }
            }
        });
    }); 

   function get_class_by_school(school_id, class_id){       
         
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { school_id:school_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                    $('#class_id').html(response); 
               }
            }
        }); 
   }  
   
  </script>
<!-- Super admin js end -->

 <script type="text/javascript">     
  
    <?php if(isset($class_id) && isset($section_id)){ ?>
        get_section_subject_by_class('<?php echo $class_id; ?>', '<?php echo $section_id; ?>', '<?php echo $subject_id; ?>');
    <?php } ?>
    
    function get_section_subject_by_class(class_id, section_id, subject_id){       
        
        var school_id = $('#school_id').val();      
             
        if(!school_id){
           toastr.error('<?php echo $this->lang->line("select_school"); ?>');
           return false;
        } 
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : {school_id:school_id, class_id : class_id , section_id: section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#section_id').html(response);
               }
            }
        }); 
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_subject_by_class'); ?>",
            data   : {school_id:school_id, class_id : class_id , subject_id: subject_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#subject_id').html(response);
               }
            }
        });         
    }
  
  $(document).ready(function(){
  
       $('.fn_mark_total').keyup(function(){         
            var student_id = $(this).attr('itemid');
          var written_mark       = $('#written_mark_'+student_id).val() ?  parseFloat($('#written_mark_'+student_id).val()) : 0;
          var written_obtain     = $('#written_obtain_'+student_id).val() ? parseFloat($('#written_obtain_'+student_id).val()) : 0;
          var tutorial_mark      = $('#tutorial_mark_'+student_id).val() ? parseFloat($('#tutorial_mark_'+student_id).val()) : 0;
          var tutorial_obtain    = $('#tutorial_obtain_'+student_id).val() ? parseFloat($('#tutorial_obtain_'+student_id).val()) : 0;
          var practical_mark     = $('#practical_mark_'+student_id).val() ? parseFloat($('#practical_mark_'+student_id).val()) : 0;
          var practical_obtain   = $('#practical_obtain_'+student_id).val() ? parseFloat($('#practical_obtain_'+student_id).val()) : 0;
          var viva_mark          = $('#viva_mark_'+student_id).val() ? parseFloat($('#viva_mark_'+student_id).val()) : 0;
          var viva_obtain        = $('#viva_obtain_'+student_id).val() ? parseFloat($('#viva_obtain_'+student_id).val()) : 0;
          
          $('#exam_total_mark_'+student_id).val(written_mark+tutorial_mark+practical_mark+viva_mark);
          $('#obtain_total_mark_'+student_id).val(written_obtain+tutorial_obtain+practical_obtain+viva_obtain);
            var exam_total_mark = written_mark+tutorial_mark+practical_mark+viva_mark;
            var obtain_total_mark = written_obtain+tutorial_obtain+practical_obtain+viva_obtain;
            // get_grade(exam_total_mark, obtain_total_mark,student_id);                
       }); 
      
  }); 

  function get_grade(exam_total_mark, obtain_total_mark,student_id) 
  {
        var school_id = $('#school_id').val(); 
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_grade_by_mark'); ?>",
            data   : {exam_total_mark:exam_total_mark, obtain_total_mark : obtain_total_mark, school_id:school_id},               
            async  : false,
            success: function(response){   
            console.log(response);                                                
               if(response)
               {
                  $('#grade_id_'+student_id).html(response);
               }
            }
        }); 
  }
  
 $("#mark").validate();  
 $("#addmark").validate();  
</script>
<style>
#datatable-responsive label.error{display: none !important;}
</style>



