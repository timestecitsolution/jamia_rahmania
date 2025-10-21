<?php
$total_avg = 0;
$total_avg1 = 0;
$total_avg2 = 0;
$total_avg_all = 0;
$total_avg_avg = 0;
$row_count = 0;
if(isset($rating_list) && !empty($rating_list)){ 
    foreach($rating_list as $obj){ 
        $row_count++;
        $total_avg += $obj->rating;
        $total_avg1 += $obj->rating1;
        $total_avg2 += $obj->rating2;
        $total_avg_all += $total_avg + $total_avg1 + $total_avg2;
    }
}
$total_avg = $total_avg /$row_count;
$total_avg1 = $total_avg1 /$row_count;
$total_avg2 = $total_avg2 /$row_count;
$total_avg_avg = $total_avg_all / ($row_count * 3);
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
                    </ul>
                    <br/>
                    
                    <div class="tab-content">

                        <h4>
                            
                            <?php 

                                if(isset($rating_list) && !empty($rating_list)){ ?>

                                    <span style="font-weight: bold; color: #2a3f54;">Average Rating of <?=$rating_list[0]->teacher?>: </span>
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
                                        <th><?php echo $this->lang->line('student'); ?></th> 
                                        <th style="width:17%">How much importance does your teacher give to everyone's response in the class, including yours?</th> 
                                        <th style="width:17%">How capable is your teacher in explaining things to you?</th> 
                                        <th style="width:17%">Does your teacher maintain time in class?</th>  
                                        <th style="width:8%"><?php echo $this->lang->line('comment'); ?></th> 
                                    </tr>
                                </thead>
                                <tbody>   
                                    
                                    <?php $count = 1; if(isset($rating_list) && !empty($rating_list)){ ?>
                                        <?php foreach($rating_list as $obj){ ?> 
                                        
                                        <tr>
                                            <td><?php echo $count++; ?></td> 
                                            <td><?php echo $obj->teacher; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo $obj->section_name; ?></td>
                                            <td><?php echo $obj->subject; ?></td>
                                            <td><?php echo $obj->student_name; ?></td>
                                            <td>

                                                <?php 
                                                $rating_x = $obj->rating; 
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

                                                <span>(<?= number_format($obj->rating,2)?>)</span>
                                                
                                                    
                                                
                                            </td> 
                                            <td>
                                                
                                                <?php 
                                                $rating_x = $obj->rating1; 
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

                                                <span>(<?= number_format($obj->rating1,2)?>)</span>
                                                
                                            </td>
                                            <td>
                                                
                                                <?php 
                                                $rating_x = $obj->rating2; 
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

                                                <span>(<?= number_format($obj->rating2,2)?>)</span>
                                             
                                            </td>                                           
                                                                                        
                                            <td><?php echo  $obj->comment; ?></td>    
                                            
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>

                                        <tr>
                                            <td colspan="6"></td>
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

<div class="modal fade bs-rating-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_rating_data">            
        </div>       
      </div>
    </div>
</div>

<!-- datatable with buttons -->
<script type="text/javascript">
         
    function get_rating_modal(school_id, teacher_id, subject_id){
         
        $('.fn_rating_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('teacher/rating/get_rating_form'); ?>",
          data   : {school_id:school_id, teacher_id : teacher_id, subject_id : subject_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_rating_data').html(response);
             }
          }
       });
    }
</script>

 <script type="text/javascript">
     
    function get_rating(rate) {

        $('#rating').val(rate);

        for (i = 1; i <= 5; i++) {
            $("#rating_" + i).attr("style", "color:gray;");
        }

        for (i = 1; i <= rate; i++) {
            $("#rating_" + i).attr("style", "color:#ffb500f0;");
        }

    }

    function get_rating1(rate) {

        $('#rating1').val(rate);

        for (i = 1; i <= 5; i++) {
            $("#rating_1" + i).attr("style", "color:gray;");
        }

        for (i = 1; i <= rate; i++) {
            $("#rating_1" + i).attr("style", "color:#ffb500f0;");
        }

    }


    function get_rating2(rate) {

        $('#rating2').val(rate);

        for (i = 1; i <= 5; i++) {
            $("#rating_2" + i).attr("style", "color:gray;");
        }

        for (i = 1; i <= rate; i++) {
            $("#rating_2" + i).attr("style", "color:#ffb500f0;");
        }

    }
    
    function save_rating() {
      
        $.ajax({
            url: '<?php echo site_url('teacher/rating/save_rating'); ?>',
            type: "POST",
            data: { teacher_id : $('#teacher_id').val(), subject_id : $('#subject_id').val(), rating : $('#rating').val(), rating1 : $('#rating1').val(), rating2 : $('#rating2').val(), comment : $('#comment').val()},
            dataType: 'json',                    
            success: function (response) {
                if (response.status == "error") {
                    var message = "";
                    $.each(response.error, function (index, value) {
                        message += value;
                    });
                    toastr.error(message);
                } else {
                    toastr.success(response.success);
                    window.location.reload(true);
                }
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