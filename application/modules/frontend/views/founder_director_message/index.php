<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa fa-desktop"></i><small> <?php echo $this->lang->line('founder_director_message'); ?></small></h3>
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
                    <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>     
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_about_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i>  <?php echo $this->lang->line('list'); ?></a> </li>
                    <?php } ?>  
                    <?php if(isset($edit)){ ?>
                        <li  class="active"><a href="#tab_edit_about"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?></a> </li>                          
                    <?php } ?>  
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_about_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                         <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <!-- <th><?php echo $this->lang->line('school'); ?></th> -->
                                        <?php } ?>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('message'); ?></th>
                                        <th><?php echo $this->lang->line('image'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($muhtamim_message) && !empty($muhtamim_message)){ ?>
                                        <?php //foreach($muhtamim_message as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <!-- <td><?php echo $obj->school_name; ?></td> -->
                                            <?php } ?>
                                            <td><?php echo $muhtamim_message->name; ?></td>
                                            <td><?php echo $muhtamim_message->message; ?></td>
                                            <td>
                                                <?php  
                                                if (!empty($muhtamim_message->img)) {
                                                    $images = explode(',', $muhtamim_message->img);
                                                    foreach ($images as $img) {
                                                        if (!empty($img)) {
                                                            echo '<img src="' . base_url('assets/uploads/about/' . $img) . '" alt="" width="100" style="margin:5px; border:1px solid #ddd; padding:2px;">';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'frontend', 'founder_director_message')){ ?>
                                                    <a href="<?php echo site_url('frontend/founder_director_message/edit/'.$muhtamim_message->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(VIEW, 'frontend', 'about')){ ?>
                                                    <a  onclick="get_frontend_modal(<?php echo $muhtamim_message->id; ?>);"  data-toggle="modal" data-target=".bs-frontend-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                <?php } ?>                                                 
                                            </td>
                                        </tr>
                                        <?php //} ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>


                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_about">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('frontend/founder_director_message/edit/'.$muhtamim_message->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>

                               <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('name'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" name="name" 
                                        placeholder="<?php echo $this->lang->line('title'); ?>" 
                                        value="<?php echo isset($muhtamim_message->name) ? $muhtamim_message->name : ''; ?>">
                                        <div class="help-block"><?php echo form_error('name'); ?></div>
                                    </div>
                                </div>
                                                                 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="message"><?php echo $this->lang->line('message'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="message"  id="edit_about_text" placeholder="<?php echo $this->lang->line('message'); ?>"><?php echo isset($muhtamim_message->message) ?  $muhtamim_message->message : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('message'); ?></div>
                                    </div>
                                </div>                                                         
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('image'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="prev_about_image" id="prev_about_image" value="<?php echo $muhtamim_message->img; ?>" />
                                        <?php 
                                            if (!empty($muhtamim_message->img)) {
                                                $images = explode(',', $muhtamim_message->img);
                                                foreach ($images as $img) {
                                                    if (!empty($img)) {
                                                        echo '<img src="' . base_url('assets/uploads/about/' . $img) . '" width="250" style="margin: 10px;">';
                                                    }
                                                }
                                            }
                                        ?>
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="muhtamim_image"  id="about_image" type="file">
                                        </div>
                                        <div class="text-info"><?php echo $this->lang->line('dimension'); ?>:- Max-W: 600px, Max-H: 600px</div>
                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                        <div class="help-block"><?php echo form_error('muhtamim_image'); ?></div>
                                    </div>
                                    <!-- Uploaded image previews -->
                                    <div id="preview_images" style="margin-top: 15px;"></div>
                                </div>
                                                         
                                                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($muhtamim_message) ? $muhtamim_message->id : $id; ?>" name="id" />
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-frontend-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('about_school'); ?></h4>
        </div>
        <div class="modal-body fn_frontend_data">            
        </div>       
      </div>
    </div>
</div>

<script type="text/javascript">
         
    function get_frontend_modal(superintendent_id){
         
        $('.fn_frontend_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('frontend/superintendent_message/get_single_superintendent'); ?>",
          data   : {superintendent_id : superintendent_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_frontend_data').html(response);
             }
          }
       });
    }
</script>


 <link href="<?php echo VENDOR_URL; ?>editor/jquery-te-1.4.0.css" rel="stylesheet">
 <script type="text/javascript" src="<?php echo VENDOR_URL; ?>editor/jquery-te-1.4.0.min.js"></script>
 <script type="text/javascript">
     
 $('#edit_about_text').jqte();
  
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
        search: true,         
        responsive: true
      });
    });
    
    $("#edit").validate();  
    

    // image preview
        document.getElementById('about_image').addEventListener('change', function (event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('preview_images');
        previewContainer.innerHTML = ''; // reset preview

        if (files.length > 4) {
            alert('You can upload a maximum of 4 images.');
            event.target.value = ""; // reset input
            return;
        }

        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '150px';
                    img.style.margin = '5px';
                    img.style.border = '1px solid #ccc';
                    img.style.padding = '3px';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    });
  </script> 
  
  <style type="text/css">
      .jqte_editor{height: 250px;}
  </style>
  
      