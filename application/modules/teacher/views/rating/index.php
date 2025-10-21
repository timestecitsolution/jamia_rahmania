
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
                            


                            <span style="font-weight: bold; color: black;margin-left: 50px;">N.B*: </span>  
                            <span style="font-weight: bold; color: red;">Red:</span> Below 40%, 
                            <span style="font-weight: bold; color: orange;">Orange:</span> 40% - 59%, 
                            <span style="font-weight: bold; color: blue;">Blue:</span> 60% - 79%, 
                            <span style="font-weight: bold; color: green;">Green:</span> Above 80%
                       
                        </h4>
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_rating_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th> 
                                        <th><?php echo $this->lang->line('photo'); ?></th> 
                                        <th><?php echo $this->lang->line('teacher'); ?></th> 
                                        <th><?php echo $this->lang->line('subject'); ?></th> 
                                        <th style="width:20%">How much importance does your teacher give to everyone's response in the class, including yours?</th> 
                                        <th style="width:20%">How capable is your teacher in explaining things to you?</th> 
                                        <th style="width:20%">Does your teacher maintain time in class?</th>  
                                        <th style="width:10%"><?php echo $this->lang->line('comment'); ?></th> 
                                        <th><?php echo $this->lang->line('action'); ?></th> 
                                    </tr>
                                </thead>
                                <tbody>   
                                    
                                    <?php $count = 1; if(isset($teacher_list) && !empty($teacher_list)){ ?>
                                        <?php foreach($teacher_list as $obj){ ?> 
                                        <?php $rating = get_teacher_rating_subject_wise($obj->id,$obj->subject_id); ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td> 
                                            <td>
                                                <?php  if($obj->photo != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>/teacher-photo/<?php echo $obj->photo; ?>" alt="" width="50" /> 
                                                <?php }else{ ?>
                                                <img src="<?php echo IMG_URL; ?>/default-user.png" alt="" width="50" /> 
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $obj->name; ?></td>
                                            <td><?php echo $obj->subject; ?></td>
                                            <td>
                                                <?php if(isset($rating) && !empty($rating)){ ?>
                                                    <?php 
                                                    $rating_x = $rating->rating; 
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

                                                    <span>(<?= number_format($rating->rating,2)?>)</span>
                                                    
                                                <?php } ?>
                                            </td> 
                                            <td>
                                                <?php if(isset($rating) && !empty($rating)){ ?>
                                                    <?php 
                                                    $rating_x = $rating->rating1; 
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

                                                    <span>(<?= number_format($rating->rating1,2)?>)</span>
                                                    
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if(isset($rating) && !empty($rating)){ ?>
                                                    <?php 
                                                    $rating_x = $rating->rating2; 
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

                                                    <span>(<?= number_format($rating->rating2,2)?>)</span>
                                                    
                                                <?php } ?>
                                            </td>                                           
                                                                                        
                                            <td><?php echo isset($rating) ? $rating->comment : ''; ?></td>    
                                            <td>
                                                <?php if(empty($rating)){ ?>
                                                    <?php if(has_permission(ADD, 'teacher', 'rating')){ ?>                                                   
                                                        <a  onclick="get_rating_modal('<?php echo $obj->school_id; ?>', '<?php echo $obj->id; ?>', '<?php echo $obj->subject_id; ?>');"  data-toggle="modal" data-target=".bs-rating-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-star"></i> <?php echo $this->lang->line('rate'); ?></a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td> 
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
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