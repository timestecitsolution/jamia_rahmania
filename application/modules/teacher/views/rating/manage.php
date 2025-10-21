<?php
$filter_school_id = 1;
?>
<script type="text/javascript">
    $(document).ready(function () {
       get_teacher_by_school(1);
    });
</script>

<?php
$currentYear = date('Y');
$currentMonth = date('m');  

$months = array();
for ($i = 0; $i < 12; $i++) 
{
    $monthValue = date('m-Y', strtotime("-$i month"));
    $monthText = date('M-Y', strtotime("-$i month")); // Abbreviated month name (e.g., Nov-2024)
    $months[$monthValue] = $monthText;  // Key = "11-2024", Value = "Nov-2024"
}

$data['months'] = $months;
$data['currentMonth'] = $currentMonth;
$data['currentYear'] = $currentYear;

$total_avg = 0;
$total_avg1 = 0;
$total_avg2 = 0;
$total_avg_all = 0;
$total_avg_avg = 0;

if(isset($ratings) && !empty($ratings)){ 
    $row_count = 0;
    foreach($ratings as $obj){ 
        $row_count++;
        $total_avg += $obj->avg_rating;
        $total_avg1 += $obj->avg_rating1;
        $total_avg2 += $obj->avg_rating2;
        $total_avg_all += $total_avg + $total_avg1 + $total_avg2;
    }
$total_avg = $total_avg /$row_count;
$total_avg1 = $total_avg1 /$row_count;
$total_avg2 = $total_avg2 /$row_count;
$total_avg_avg = $total_avg_all / ($row_count * 3);
}

?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-star"></i><small> <?php echo $this->lang->line('manage_rating'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <div class="x_content quick-link">
               <?php $this->load->view('quick-link'); ?>              
            </div>
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">                    
                    <ul  class="nav nav-tabs bordered">
                        
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_rating_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('list'); ?></a> </li>
                            
                        <li class="li-class-list">
                            <?php echo form_open(site_url('teacher/rating/manage'), array('name' => 'filter', 'id' => 'filter', 'class'=>'form-horizontal form-label-left'), ''); ?>
                            <?php if($this->session->userdata('role_id') == SUPER_ADMIN){  ?>
                                    

                                    <select  class="select2_mamun form-control col-md-7 col-xs-12" style="width:auto;" name="school_id"  onchange="get_teacher_by_school(this.value, '');">
                                        <option value="">--<?php echo $this->lang->line('select_school'); ?>--</option> 
                                        <?php foreach($schools as $obj ){ ?>
                                         <option value="<?php echo $obj->id; ?>" <?php if(isset($filter_school_id) && $filter_school_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->school_name; ?></option>
                                        <?php } ?>   
                                    </select>

                                    <?php
                                        echo form_dropdown('month_year', $months, date('m-Y'), 'id="month_year" class="select2_mamun form-control col-md-7 col-xs-4" style="width:100px;"');
                                    ?>

                                    <select  class="select2_mamun form-control col-md-7 col-xs-12" id="filter_teacher_id" name="teacher_id"  style="width:150px;" onchange="this.form.submit();">
                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                    </select>

                                    

                                    
                            <?php }else{ ?>
                                <select  class="select2_mamun form-control col-md-7 col-xs-12" id="filter_teacher_id" name="teacher_id"  style="width:auto;" onchange="this.form.submit();">
                                    <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                    <?php foreach($teachers as $obj ){ ?>
                                     <option value="<?php echo $obj->id; ?>" <?php if(isset($filter_teacher_id) && $filter_teacher_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->school_name; ?></option>
                                    <?php } ?> 
                                </select>
                             <?php }?>
                            <?php echo form_close(); ?>
                        </li>
                    </ul>
                    
                    <br/>
                    
                    <div class="tab-content">
                        <h4>
                            
                            <?php 

                                if(isset($ratings) && !empty($ratings)){ ?>

                                    <span style="font-weight: bold; color: #2a3f54;">Average Rating of <?=$ratings[0]->teacher?>: </span>
                                    <?php 
                                    $rating_x = $total_avg_avg; 
                                    $fullStars = floor($rating_x);  
                                    $halfStar = ($rating_x - $fullStars) >= 0.5 ? 1 : 0;  
                                    $percent = $rating_x / 5 * 100;  

                                    if ($percent < 40) {
                                        $color = 'red';  
                                    } elseif ($percent >= 40 && $percent < 60) {
                                        $color = 'orange';  
                                    } elseif ($percent >= 60 && $percent < 80) {
                                        $color = 'blue';  
                                    } else {
                                        $color = 'green';  
                                    }

                                    for ($i = 1; $i <= 5; $i++) {  
                                        if ($i <= $fullStars) {
                                            $starColor = $color;  
                                        } elseif ($i == $fullStars + 1 && $halfStar) {
                                            $starColor = $color;  
                                        } else {
                                            $starColor = 'gray';  
                                        }
                                    ?>
                                        <span class="fa fa-star" style="color: <?php echo $starColor; ?>;font-size: 30px;"></span>
                                    <?php } ?>
                                    <span>(<?= number_format($total_avg_avg,2)?>)</span>

                            <?php } ?>


                            <span style="font-weight: bold; color: black;margin-left: 50px;">N.B*: </span>  
                            <span style="font-weight: bold; color: red;">Red:</span> Below 40%, 
                            <span style="font-weight: bold; color: orange;">Orange:</span> 40% - 59%, 
                            <span style="font-weight: bold; color: blue;">Blue:</span> 60% - 79%, 
                            <span style="font-weight: bold; color: green;">Green:</span> Above 80%
                       
                        </h4>

                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_rating_list" >
                            <div class="x_content">
                            <table id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('teacher'); ?></th> 
                                        <th><?php echo $this->lang->line('class'); ?></th> 
                                        <th><?php echo $this->lang->line('section'); ?></th> 
                                        <th><?php echo $this->lang->line('subject'); ?></th> 
                                        <th style="width:20%">How much importance does your teacher give to everyone's response in the class, including yours?</th> 
                                        <th style="width:20%">How capable is your teacher in explaining things to you?</th> 
                                        <th style="width:20%">Does your teacher maintain time in class?</th> 
                                                                                 
                                        <th><?php echo $this->lang->line('action'); ?></th> 
                                    </tr>
                                </thead>
                                <tbody>   
                                    
                                    <?php $count = 1; if(isset($ratings) && !empty($ratings)){ ?>
                                        <?php foreach($ratings as $obj){ ?> 
                                        <tr>
                                            <td><?php echo $count++; ?></td> 
                                            <td><?php echo $obj->teacher; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo $obj->section_name; ?></td>
                                            <td><?php echo $obj->subject; ?></td>
                                             
                                            <td>                                                
                                                <?php 
                                                $rating_x = $obj->avg_rating; 
                                                $fullStars = floor($rating_x);  
                                                $halfStar = ($rating_x - $fullStars) >= 0.5 ? 1 : 0;  
                                                $percent = $rating_x / 5 * 100;  

                                                if ($percent < 40) {
                                                    $color = 'red';  
                                                } elseif ($percent >= 40 && $percent < 60) {
                                                    $color = 'orange';  
                                                } elseif ($percent >= 60 && $percent < 80) {
                                                    $color = 'blue';  
                                                } else {
                                                    $color = 'green';  
                                                }

                                                for ($i = 1; $i <= 5; $i++) { ?>
                                                    <?php 
                                                    if ($i <= $fullStars) {
                                                        $starColor = $color;  
                                                    } elseif ($i == $fullStars + 1 && $halfStar) {
                                                        $starColor = $color;  // Half star color
                                                    } else {
                                                        $starColor = 'gray';  // Empty star color
                                                    }
                                                    ?>
                                                    <span class="fa fa-star" style="color: <?php echo $starColor; ?>;font-size: 30px;"></span>
                                                <?php } ?>

                                                <span>(<?= number_format($obj->avg_rating,2)?>)</span>
                                            </td> 
                                            <td>                                                
                                                <?php 
                                                $rating_x = $obj->avg_rating1; 
                                                $fullStars = floor($rating_x);  
                                                $halfStar = ($rating_x - $fullStars) >= 0.5 ? 1 : 0;  
                                                $percent = $rating_x / 5 * 100;  

                                                if ($percent < 40) {
                                                    $color = 'red';  
                                                } elseif ($percent >= 40 && $percent < 60) {
                                                    $color = 'orange';  
                                                } elseif ($percent >= 60 && $percent < 80) {
                                                    $color = 'blue';  
                                                } else {
                                                    $color = 'green';  
                                                }

                                                for ($i = 1; $i <= 5; $i++) { ?>
                                                    <?php 
                                                    if ($i <= $fullStars) {
                                                        $starColor = $color;  
                                                    } elseif ($i == $fullStars + 1 && $halfStar) {
                                                        $starColor = $color;  // Half star color
                                                    } else {
                                                        $starColor = 'gray';  // Empty star color
                                                    }
                                                    ?>
                                                    <span class="fa fa-star" style="color: <?php echo $starColor; ?>;font-size: 30px;"></span>
                                                <?php } ?>
 
                                                <span>(<?= number_format($obj->avg_rating1,2)?>)</span>                                            
                                            </td>   

                                            <td>                                                
                                                <?php 
                                                $rating_x = $obj->avg_rating2; 
                                                $fullStars = floor($rating_x);  
                                                $halfStar = ($rating_x - $fullStars) >= 0.5 ? 1 : 0;  
                                                $percent = $rating_x / 5 * 100;  

                                                if ($percent < 40) {
                                                    $color = 'red';  
                                                } elseif ($percent >= 40 && $percent < 60) {
                                                    $color = 'orange';  
                                                } elseif ($percent >= 60 && $percent < 80) {
                                                    $color = 'blue';  
                                                } else {
                                                    $color = 'green';  
                                                }

                                                for ($i = 1; $i <= 5; $i++) { ?>
                                                    <?php 
                                                    if ($i <= $fullStars) {
                                                        $starColor = $color;  
                                                    } elseif ($i == $fullStars + 1 && $halfStar) {
                                                        $starColor = $color;  // Half star color
                                                    } else {
                                                        $starColor = 'gray';  // Empty star color
                                                    }
                                                    ?>
                                                    <span class="fa fa-star" style="color: <?php echo $starColor; ?>;font-size: 30px;"></span>
                                                <?php } ?>
       
                                                <span>(<?= number_format($obj->avg_rating2,2)?>)</span>                                       
                                            </td>                                 
                                            
                                            <td>

                                                <a  href="<?php echo site_url('teacher/rating/view_rating/'.$obj->teacher_id.'/'.$obj->class_id.'/'.$obj->section_id.'/'.$obj->subject_id.'/'.$obj->month);?>"   class="btn btn-info btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?></a>
                                            </td>                                            
                                        </tr>
                                        
                                        <?php } ?>
                                    <?php } ?>

                                        <tr>
                                            <td colspan="5"></td>
                                            <td><span style="font-weight: bold; color: black;">Avg. Count = <?php echo number_format($total_avg,2)?></span></td>
                                            <td><span style="font-weight: bold; color: black;">Avg. Count = <?php echo number_format($total_avg1,2)?></span></td>
                                            <td><span style="font-weight: bold; color: black;">Avg. Count = <?php echo number_format($total_avg2,2)?></span></td>
                                            <td></td>
                                        </tr>
                                    
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <script type="text/javascript">
     
    function get_teacher_by_id(url){          
        if(url){
            window.location.href = url; 
        }
    }
    
    
    <?php if(isset($filter_teacher_id)){ ?>
        get_teacher_by_school('<?php echo $filter_school_id; ?>', '<?php echo $filter_teacher_id; ?>');
    <?php } ?>
    
    function get_teacher_by_school(school_id, teacher_id){        
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_teacher_by_school'); ?>",
            data   : { school_id : school_id, teacher_id : teacher_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                    $('#filter_teacher_id').html(response);                     
               }
            }
        });
    }


    
    function view_rating(teacher_id,class_id,section_id,subject_id,month,status) {
      
        $.ajax({
            url: '<?php echo site_url('teacher/rating/view_rating'); ?>',
            type: "POST",
            data: { teacher_id : teacher_id, class_id:class_id, section_id : section_id, subject_id : subject_id, month : month},                             
            success: function () {                
                
                window.location.reload(true);               
            },
            error: function () {}
        });
        
    };   
    function update_rating(rating_id, status) {
      
        $.ajax({
            url: '<?php echo site_url('teacher/rating/approve_rating'); ?>',
            type: "POST",
            data: { rating_id : rating_id, status:status},                             
            success: function () {                
                toastr.success('<?php echo $this->lang->line('update_success'); ?>');
                window.location.reload(true);               
            },
            error: function () {}
        });
        
    };
       
    $(document).ready(function() {
              
      $('#datatable-responsive').DataTable( {
          dom: 'Bfrtip',
          iDisplayLength: 15,
          buttons: [
              'copyHtml5',
              'excelHtml5',
              'csvHtml5',
              'pdfHtml5',
              'pageLength'
          ],
          search: true
      });
    });
     
</script>
<style type="text/css">
    .rating .fa{
        color:orange;        
    }
 </style> 