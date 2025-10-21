<div class="x_content">
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
                                   <h3 class="head-title ptint-title" style="width: 100%;"><i class="fa fa-bar-chart"></i><small>  <?php echo $this->lang->line('exam_result_report'); ?></small></h3>                
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
                        <li class="active"><a href="#tab_tabular"   role="tab" data-toggle="tab"   aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('tabular'); ?> <?php echo $this->lang->line('report'); ?></a> </li>
                    </ul>
                    <br/>
                   
                    <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_tabular" >
                            <div class="x_content">
                            <table id="datatable-keytable" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('roll_no'); ?></th>
                                        <th><?php echo $this->lang->line('total_subject'); ?></th>                                            
                                        <th><?php echo $this->lang->line('exam_mark'); ?></th>                                            
                                        <th><?php echo $this->lang->line('obtain_mark'); ?></th> 
                                        <th ><?php echo $this->lang->line('percentage'); ?></th> 
                                        <th> <?php echo $this->lang->line('average_grade_point'); ?></th>                                            
                                        <th><?php echo $this->lang->line('letter_grade'); ?></th>                                            
                                        <th><?php echo $this->lang->line('status'); ?></th>                                            
                                        <th ><?php echo $this->lang->line('position_in_section'); ?></th>                                            
                                        <th ><?php echo $this->lang->line('position_in_class'); ?></th>   
                                        <th><?php echo $this->lang->line('remark'); ?></th>  
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php 
                                    
                                    $count = 1; if(isset($examresult) && !empty($examresult)){ ?>
                                        <?php foreach($examresult as $obj){ ?>
                                        <?php $class_position = get_student_position($school_id, $academic_year_id, $class_id, $obj->student_id); ?>    
                                        <?php $section_position = get_student_position($school_id, $academic_year_id, $class_id,$obj->student_id, $obj->section_id); ?> 
                                        <tr>
                                            <td><?php echo $obj->student; ?></td>
                                            <td><?php echo $obj->roll_no; ?></td>
                                            <td><?php echo $obj->total_subject; ?></td>
                                            <td><?php echo $obj->total_mark; ?></td>
                                            <td><?php echo $obj->total_obtain_mark; ?></td>
                                            <td><?php echo $obj->total_mark > 0 ? number_format(@$obj->total_obtain_mark/$obj->total_mark*100, 2) : 0; ?>%</td> 
                                            <td><?php echo $obj->avg_grade_point; ?></td>
                                            <td><?php echo $obj->grade; ?></td>
                                            <td><?php echo $this->lang->line($obj->result_status); ?></td>
                                            <td><?php echo $section_position; ?></td> 
                                            <td><?php echo $class_position; ?></td> 
                                            <td><?php echo $obj->remark; ?></td>
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