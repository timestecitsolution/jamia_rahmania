<style type="text/css">
    table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
}

 .drag {
     cursor: move; 
     cursor: grab;
     cursor: -moz-grab;
     cursor: -webkit-grab;
 }
 .drag:active {
     cursor: grabbing;
     cursor: -moz-grabbing;
     cursor: -webkit-grabbing;
 }
</style>
<div class="row" >
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bar-chart"></i><small> <?php echo $this->lang->line('tabulation_sheet'); ?></small></h3>                
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <?php $this->load->view('quick_report'); ?>   
            
             <div class="x_content filter-box no-print"> 
                <?php echo form_open_multipart(site_url('report/tabulation'), array('name' => 'tabulation', 'id' => 'tabulation', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">     
                    
                   <?php $this->load->view('layout/school_list_filter'); ?> 
                   <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('academic_year'); ?> <span class="red">*</span></div>
                            <select  class="select2_mamun form-control col-md-7 col-xs-12" name="academic_year_id" required="required" id="academic_year_id" onchange="get_exam(this.value, '');">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php foreach ($academic_years as $obj) { ?>
                                <?php $running = $obj->is_running ? ' ['.$this->lang->line('running_year').']' : ''; ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($academic_year_id) && $academic_year_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->session_year; echo $running; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                   <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('class'); ?> <span class="red">*</span></div>
                            <select  class="select2_mamun form-control col-md-7 col-xs-12" name="class_id" id="class_id" required="required" onchange="get_section_by_class('',this.value, '');">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php foreach ($classes as $obj) { ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-1 col-sm-2 col-xs-12">
                        <div class="item form-group">
                            <label for="group"><?php echo $this->lang->line('group'); ?><span class="red">*</span> </label>
                            <select  class="select2_mamun form-control col-md-7 col-xs-12" name="group" id="add_group" required="required">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                 <?php $groups = get_groups(); ?>
                                    <?php foreach($groups as $key=>$value){ ?>
                                    <option value="<?php echo $key; ?>" <?php echo isset($group_id) && $group_id == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                                <?php } ?>
                            </select>
                            <div class="help-block"><?php echo form_error('group'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('section'); ?></div>
                            <select  class="select2_mamun form-control col-md-7 col-xs-12" name="section_id" id="section_id">                                
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                            </select>
                        </div>
                    </div>  

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
                
                    <div class="col-md-1 col-sm-2 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <!-- position count start -->
            <!-- classwise -->
            <?php
            $student_array_mark = array();
            if(isset($examresult) && !empty($examresult))
            {
                foreach($examresult as $x => $obj)
                { 
                    $flag = 0;
                    $student_total = 0;
                    if(isset($subjects) && !empty($subjects))
                    { 
                        foreach($subjects as $key=>$subject)
                        {
                            $written = 0;
                            $mcq =   0;
                            $sub_total = 0;
                            $mark_total = 0;
                            $sub_mark = get_subject_exam_wise_markt($school_id,$academic_year_id,$exam_id,$class_id,$subject->id,'',$obj->student_id);
                            if(!empty($sub_mark))
                            {
                                $written = $sub_mark->written_obtain;
                                $mcq =   $sub_mark->tutorial_obtain;
                                $sub_total =  $written + $mcq;
                                $mark_total = $sub_mark->written_mark + $sub_mark->tutorial_mark;
                                
                                if($mark_total > 0)
                                {
                                    $n_grade = get_grade_by_mark_tabulation($mark_total, $sub_total, $school_id);
                                  
                                    if($n_grade == '0.00')
                                    {
                                        $flag = 1;
                                    }
                                }
                                else
                                {
                                    $flag = 1;
                                }
                                
                                
                            }
                            $student_total += $sub_total;
                        }
                    }
                    if(isset($group_subjects) && !empty($group_subjects))
                    { 
                        foreach($group_subjects as $key_grp=>$group_subject)
                        {
                            $written_grp = 0;
                            $mcq_grp =   0;
                            $sub_total_grp = 0;
                            $mark_total_grp = 0;
                            $sub_mark_grp = get_subject_exam_wise_markt($school_id,$academic_year_id,$exam_id,$class_id,$group_subject->id,'',$obj->student_id);
                            if(!empty($sub_mark_grp))
                            {
                                $written_grp = $sub_mark_grp->written_obtain;
                                $mcq_grp =   $sub_mark_grp->tutorial_obtain;
                                $sub_total_grp =  $written_grp + $mcq_grp;
                                $mark_total_grp = $sub_mark->written_mark + $sub_mark->tutorial_mark;
                                if($mark_total_grp > 0)
                                {
                                    $n_grade_grp = get_grade_by_mark_tabulation($mark_total_grp, $sub_total_grp, $school_id);
                                    if($n_grade_grp == '0.00')
                                    {
                                        $flag = 1;
                                    }
                                }
                                else
                                {
                                    $flag = 1;
                                }
                            }
                            $student_total += $sub_total_grp;
                        }
                    }
                  
                    if($flag == 0)
                    {
                        $student_array_mark[$x]['id'] = $obj->student_id;
                        $student_array_mark[$x]['mark'] = $student_total;
                    }
                    
                }
            }
            array_multisort( array_column($student_array_mark, "mark"), SORT_DESC, $student_array_mark );


           function searchForId($id, $array,$examresult) {
               foreach ($array as $key_search => $val) {
                   if ($val['id'] === $id) {
                        $rank = $key_search+1;
                        if($rank == 1)
                        {
                            return $rank.'st';
                        }
                        elseif($rank == 2)
                        {
                           return $rank.'nd'; 
                        }
                        elseif($rank == 3)
                        {
                           return $rank.'rd'; 
                        }
                        elseif($rank > 3 )
                        {
                            return $rank.'th';         
                        }
                        else
                        {
                            return '--'; 
                        }
                       
                   }
               }
               return null;
            }
            // $key = array_search(142, array_column($student_array_mark, 'id'));
            
            
            ?>
            <!-- classwise -->
            <!-- position count end -->

            <div class="x_content " id="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <?php if(isset($school) && !empty($school)){ ?>
                    <div class="x_content">             
                       <div class="row">
                           <div class="col-sm-3 col-xs-3">&nbsp;</div>
                           <div class="col-sm-6  col-xs-6 layout-box">
                                <div>
                                   <?php if($school->logo){ ?>
                                    <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->logo; ?>" alt="" /> 
                                 <?php }else if($school->frontend_logo){ ?>
                                    <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->frontend_logo; ?>" alt="" /> 
                                 <?php }else{ ?>                                                        
                                    <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $this->global_setting->brand_logo; ?>" alt=""  />
                                 <?php } ?>
                                   <h4><?php echo $school->school_name; ?></h4>
                                   <div><?php echo $school->address; ?></div>
                                   <h3 class="head-title ptint-title" style="width: 100%;"><i class="fa fa-bar-chart"></i><small>  <?php echo $this->lang->line('tabulation_sheet'); ?></small></h3>                
                                    <div class="clearfix">&nbsp;</div>  
                                   <?php if(isset($academic_year)){ ?>
                                   <div><?php echo $this->lang->line('academic_year'); ?>: <?php echo $academic_year; ?></div>
                                   <?php } ?>
                                   <div>
                                   <?php if(isset($class)){ ?>
                                   <?php echo $this->lang->line('class'); ?>: <?php echo $class; ?>
                                   <?php } ?>
                                   <?php if(isset($section)){ ?>
                                   , <?php echo $this->lang->line('section'); ?>: <?php echo $section; ?>
                                   <?php } ?>
                                   </div>                                   
                                   <div class="clearfix">&nbsp;</div>                                   
                                </div>
                            </div>
                            <div class="col-sm-3  col-xs-3">&nbsp;</div>
                       </div>            
                    </div>
                    <?php } ?>
               
                    <ul  class="nav nav-tabs bordered no-print">
                        <li class="active">
                            <a href="#tab_tabular"   role="tab" data-toggle="tab"   aria-expanded="true">
                                <i class="fa fa-list-ol"></i> <?php echo $this->lang->line('tabular'); ?> <?php echo $this->lang->line('report'); ?>
                            </a> 
                        </li>
                    </ul>
                    <br/>
                   
                    <div class="tab-content ">
                        <div  class="tab-pane fade in active" id="tab_tabular" >
                            <div class="x_content">
                            <table id="datatable-keytable " class="drag datatable-responsive table table-striped table-bordered dt-responsive nowrap overflow-auto" cellspacing="0" width="100%">
                                <thead >
                                    <tr>
                                        <th rowspan="2"><?php echo $this->lang->line('roll_no'); ?></th>
                                        <th rowspan="2"><?php echo $this->lang->line('name'); ?></th>
                                        <?php 
                                        if(isset($subjects) && !empty($subjects)){ 
                                            foreach($subjects as $key=>$subject){?>
                                            <th colspan="3"><?php echo $subject->name; ?></th> 
                                        <?php } }?>

                                        <?php 

                                        if(isset($group_subjects) && !empty($group_subjects)){ 
                                            foreach($group_subjects as $key_grp=>$group_subject){?>
                                            <th colspan="3"><?php echo $group_subject->name; ?></th> 
                                        <?php } }?>


                                        <th rowspan="2">Total Mark</th>
                                        <th rowspan="2">Class Position</th>
                                    </tr>
                                    <tr>
                                        <?php 
                                        if(isset($subjects) && !empty($subjects)){ 
                                            foreach($subjects as $key=>$subject){?>
                                            <th>Written</th>
                                            <th>MCQ</th>
                                            <th>Total Mark</th>
                                        <?php } }?>

                                        <?php 
                                        if(isset($group_subjects) && !empty($group_subjects)){ 
                                            foreach($group_subjects as $key_grp=>$group_subject){?>
                                            <th>Written</th>
                                            <th>MCQ</th>
                                            <th>Total Mark</th>
                                        <?php } }?>

                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php 
                                    
                                    $count = 1; if(isset($examresult) && !empty($examresult)){ ?>
                                        <?php foreach($examresult as $serial => $obj){ 
                                            $student_total_check = 0;
                                            if(isset($subjects) && !empty($subjects))
                                            { 
                                                foreach($subjects as $key=>$subject)
                                                {
                                                    $written = 0;
                                                    $mcq =   0;
                                                    $sub_total = 0;
                                                    $mark_total = 0;
                                                    $sub_mark = get_subject_exam_wise_markt($school_id,$academic_year_id,$exam_id,$class_id,$subject->id,'',$obj->student_id);
                                                    if(!empty($sub_mark))
                                                    {
                                                        $written = $sub_mark->written_obtain;
                                                        $mcq =   $sub_mark->tutorial_obtain;
                                                        $sub_total =  $written + $mcq;
                                                        $mark_total = $sub_mark->written_mark + $sub_mark->tutorial_mark;
                                                    }
                                                    $student_total_check += $sub_total;
                                                }
                                            }
                                            if(isset($group_subjects) && !empty($group_subjects))
                                            { 
                                                foreach($group_subjects as $key_grp=>$group_subject)
                                                {
                                                    $written_grp = 0;
                                                    $mcq_grp =   0;
                                                    $sub_total_grp = 0;
                                                    $mark_total_grp = 0;
                                                    $sub_mark_grp = get_subject_exam_wise_markt($school_id,$academic_year_id,$exam_id,$class_id,$group_subject->id,'',$obj->student_id);
                                                    if(!empty($sub_mark_grp))
                                                    {
                                                        $written_grp = $sub_mark_grp->written_obtain;
                                                        $mcq_grp =   $sub_mark_grp->tutorial_obtain;
                                                        $sub_total_grp =  $written_grp + $mcq_grp;
                                                        $mark_total_grp = $sub_mark->written_mark + $sub_mark->tutorial_mark;
                                                    }
                                                    $student_total_check += $sub_total_grp;
                                                }
                                            }

                                            
                                            $class_position = array_search($obj->student_id, array_column($student_array_mark, 'id')) ;
                                            $position = searchForId($obj->student_id,$student_array_mark,$examresult);
                                           
                                        ?>
                                        <tr>
                                            <?php
                                            if($student_total_check > 0)
                                            {
                                                $student_total = 0; ?>
                                            <td><?php echo $obj->roll_no; ?></td>
                                            <td><?php echo $obj->student; ?></td>
                                            
                                            <?php 
                                            if(isset($subjects) && !empty($subjects)){ 
                                                foreach($subjects as $key=>$subject){
                                                    $written = 0;
                                                    $mcq =   0;
                                                    $sub_total = 0;
                                                    $sub_mark = get_subject_exam_wise_markt($school_id,$academic_year_id,$exam_id,$class_id,$subject->id,'',$obj->student_id);
                                                    if(!empty($sub_mark))
                                                    {
                                                        $written = $sub_mark->written_obtain;
                                                        $mcq =   $sub_mark->tutorial_obtain;
                                                        $sub_total =  $written + $mcq;
                                                    }
                                                    $student_total += $sub_total;
                                                    ?>
                                                    <td><?php echo $written; ?></td>
                                                    <td><?php echo $mcq ; ?></td>
                                                    <td><?php echo $sub_total ; ?></td>
                                            <?php } }?>

                                            <?php 
                                            if(isset($group_subjects) && !empty($group_subjects)){ 
                                                foreach($group_subjects as $key_grp=>$group_subject){
                                                    $written_grp = 0;
                                                    $mcq_grp =   0;
                                                    $sub_total_grp = 0;
                                                    $sub_mark_grp = get_subject_exam_wise_markt($school_id,$academic_year_id,$exam_id,$class_id,$group_subject->id,'',$obj->student_id);
                                                    if(!empty($sub_mark_grp))
                                                    {
                                                        $written_grp = $sub_mark_grp->written_obtain;
                                                        $mcq_grp =   $sub_mark_grp->tutorial_obtain;
                                                        $sub_total_grp =  $written_grp + $mcq_grp;
                                                    }
                                                    $student_total += $sub_total_grp;

                                                    ?>
                                                    <td><?php echo $written_grp; ?></td>
                                                    <td><?php echo $mcq_grp ; ?></td>
                                                    <td><?php echo $sub_total_grp ; ?></td>
                                            <?php } }?>

                                            <td><?php echo $student_total; ?></td>
                                            <td><?php echo $position; ?></td>
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>                                        
                                    <?php }else{ ?>
                                        <tr><td colspan="12" class="text-center"><?php echo $this->lang->line('no_data_found'); ?></td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            
             <div class="row no-print">
                <div class="col-xs-12 text-right">
                    <button class="btn btn-default " onclick="printDiv()"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                </div>
            </div>
            
        </div>
    </div>
</div>
 <script>

function printDiv() {
     var printContents = document.getElementById("x_content").innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}




 const slider = document.querySelector('.drag');
 let mouseDown = false;
 let startX, scrollLeft;
 let startDragging = function (e) {
     mouseDown = true;
     startX = e.pageX - slider.offsetLeft;
     scrollLeft = slider.scrollLeft;
 };

 let stopDragging = function (event) {
     mouseDown = false;
 };

 slider.addEventListener('mousemove', (e) => {
     e.preventDefault();  if(!mouseDown) {
         return;
     }
     const x = e.pageX - slider.offsetLeft;
     const scroll = x - startX;
     slider.scrollLeft = scrollLeft - scroll;
 });

 slider.addEventListener('mousedown', startDragging, false);
 slider.addEventListener('mouseup', stopDragging, false);
 slider.addEventListener('mouseleave', stopDragging, false);
 </script>
 <script type="text/javascript">

    $("#examresult").validate(); 
    
        $("document").ready(function() {
         <?php if(isset($school_id) && !empty($school_id)){ ?>
            $(".fn_school_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_school_id').on('change', function(){
      
        var school_id = $(this).val();
        var class_id = '';
        var section_id = '';
        var academic_year_id = '';
        
        <?php if(isset($school_id) && !empty($school_id)){ ?>
            class_id =  '<?php echo $class_id; ?>';
            section_id =  '<?php echo $section_id; ?>';
            academic_year_id =  '<?php echo $academic_year_id; ?>'; 
         <?php } ?>          
        
        if(!school_id){
           toastr.error('<?php echo $this->lang->line("select_school"); ?>');
           return false;
        }
        
        get_academic_year_by_school(school_id, academic_year_id);
        get_class_by_school(school_id, class_id, section_id);
       
    });
    
    
        
    function get_academic_year_by_school(school_id, academic_year_id){       
         
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_academic_year_by_school'); ?>",
            data   : { school_id:school_id, academic_year_id :academic_year_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                    $('#academic_year_id').html(response); 
               }
            }
        });
   }  
    
    
    
    function get_class_by_school(school_id, class_id, section_id){       
        
        if(!school_id){
            school_id = $('#school_id').val();
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { school_id:school_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   $('#class_id').html(response);                                      
                   get_section_by_class(school_id, class_id, section_id);
               }
            }
        });         
    }
    
    function get_section_by_class(school_id, class_id, section_id){       
        
        if(!school_id){
            school_id = $('#school_id').val();
        }
        
               
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : { school_id:school_id, class_id : class_id , section_id: section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#section_id').html(response);
               }
            }
        });          
    }



    function get_exam(academic_year_id, school_id){       
        
        if(!school_id){
            school_id = $('#school_id').val();
        }
               
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_exam_by_academic_year_id'); ?>",
            data   : { school_id:school_id, academic_year_id : academic_year_id },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#exam_id').html(response);
               }
            }
        });          
    }


        
       
</script>
