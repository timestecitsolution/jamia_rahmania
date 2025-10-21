<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bell-o"></i><small> <?php echo $this->lang->line('manage_donar'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_donar_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'donation', 'doner')){ ?>
                             <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('donation/doner/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> </a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_donar"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> </a> </li>                          
                             <?php } ?>
                        <?php } ?> 
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_donar"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?></a> </li>                          
                        <?php } ?>
                            
                        <li class="li-class-list">
                           <?php if($this->session->userdata('role_id') == SUPER_ADMIN){  ?>                                 
                                <select  class="select2_mamun form-control col-md-7 col-xs-12" onchange="get_donar_by_school(this.value);">
                                        <option value="<?php echo site_url('donation/doner/index'); ?>">--<?php echo $this->lang->line('select_school'); ?>--</option> 
                                    <?php foreach($schools as $obj ){ ?>
                                        <option value="<?php echo site_url('donation/doner/index/'.$obj->id); ?>" <?php if(isset($filter_school_id) && $filter_school_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->school_name; ?></option>
                                    <?php } ?>   
                                </select>
                            <?php } ?>  
                        </li>     
                                               
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_donar_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>  
                                        <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo $this->lang->line('school'); ?></th>
                                        <?php } ?>
                                        <th><?php echo $this->lang->line('academic_year'); ?></th>
                                        <th> <?php echo $this->lang->line('donar_name'); ?></th>
                                        <th><?php echo $this->lang->line('contact_name'); ?> </th>
                                         <th><?php echo $this->lang->line('amount'); ?> </th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                           
                                    <?php $count = 1; if(isset($donars) && !empty($donars)){ ?>
                                        <?php foreach($donars as $obj){ ?>                                       
                                        <tr>
                                            <td><?php echo $count++; ?></td>  
                                            <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->school_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo $obj->session_year; ?></td>
                                            <td><?php echo $obj->doner_name; ?></td>
                                            <td><?php echo $obj->contact_name; ?></td>
                                            <td><?php echo $obj->amount; ?></td>
                                            <td>                                                      
                                                <?php if(has_permission(EDIT, 'donation', 'doner')){ ?>
                                                    <a href="<?php echo site_url('donation/doner/edit/'.$obj->id); ?>" title="<?php echo $this->lang->line('edit'); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                <?php } ?> 
                                                <?php if(has_permission(VIEW, 'donation', 'doner')){ ?>
                                                    <a  onclick="get_donar_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-donar-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'donation', 'doner')){ ?>    
                                                    <a href="<?php echo site_url('donation/doner/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_donar">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('donation/doner/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                             
                                <?php $this->load->view('layout/school_list_form'); ?>
                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doner_type"><?php echo $this->lang->line('donar_type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="select2_mamun form-control col-md-7 col-xs-12"  name="doner_type"  id="add_donation_category" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                          <?php $types = get_donar_types(); ?>
                                           <?php foreach($types as $key=>$value){ ?>
                                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                           <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('doner_type'); ?></div>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="donation_category"><?php echo $this->lang->line('donation_category'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="select2_mamun form-control col-md-7 col-xs-12"  name="donation_category"  id="add_donar_type" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                          <?php $category = get_donation_category(); ?>
                                           <?php foreach($category as $key=>$value){ ?>
                                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                           <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('donation_category'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doner_name"><?php echo $this->lang->line('donar_name'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="doner_name"  id="add_donar_name" value="<?php echo isset($post['doner_name']) ?  $post['doner_name'] : ''; ?>" placeholder=" <?php echo $this->lang->line('doner_name'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('doner_name'); ?></div>
                                    </div>
                                </div>

                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_name"><?php echo $this->lang->line('contact_name'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="contact_name"  id="add_contact_name" value="<?php echo isset($post['contact_name']) ?  $post['contact_name'] : ''; ?>" placeholder=" <?php echo $this->lang->line('contact_name'); ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('contact_name'); ?></div>
                                    </div>
                                </div>                             
                                        
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"><?php echo $this->lang->line('email'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="email"  id="add_email" value="<?php echo isset($post['email']) ?  $post['email'] : ''; ?>" placeholder=" <?php echo $this->lang->line('email'); ?>" type="email" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('email'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone"><?php echo $this->lang->line('phone'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="add_phone" value="<?php echo isset($post['phone']) ?  $post['phone'] : ''; ?>" placeholder="<?php echo $this->lang->line('phone'); ?>" required="required" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('phone'); ?></div>
                                    </div>
                                </div>
                                  
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"><?php echo $this->lang->line('amount'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="amount"  id="add_amount" value="<?php echo isset($post['amount']) ?  $post['amount'] : ''; ?>" placeholder="<?php echo $this->lang->line('amount'); ?>" required="required" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('amount'); ?></div>
                                    </div>
                                </div>
                               
                               <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"><?php echo $this->lang->line('address'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control" name="address" id="add_address" placeholder="<?php echo $this->lang->line('address'); ?>"><?php echo isset($post['address']) ?  $post['address'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('address'); ?></div>
                                    </div>
                                </div>  

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="donation_start_from"><?php echo $this->lang->line('from_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="donation_start_from"  id="add_date" value="<?php echo isset($post['donation_start_from']) ?  $post['donation_start_from'] : ''; ?>" placeholder="<?php echo $this->lang->line('from_date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('donation_start_from'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control" name="note" id="add_note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div> 
                                                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('donation/doner/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                            <div  class="tab-pane fade in <?php if(isset($edit)){ echo 'active'; }?>" id="tab_edit_donar">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('donation/doner/edit/'.$donar->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                    <?php $this->load->view('layout/school_list_edit_form'); ?> 
                                
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="donar_type"><?php echo $this->lang->line('donar_type'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="select2_mamun form-control col-md-7 col-xs-12"  name="doner_type"  id="edit_donar_type" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php $types = get_donar_types(); ?>
                                            <?php foreach($types as $key=>$value){ ?>
                                            <option value="<?php echo $key; ?>" <?php if($donar->doner_type == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('doner_type'); ?></div>
                                        </div>
                                    </div>


                                    <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="donation_category"><?php echo $this->lang->line('donation_category'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="select2_mamun form-control col-md-7 col-xs-12"  name="donation_category"  id="add_donar_type" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                          <?php $category = get_donation_category(); ?>
                                           <?php foreach($category as $key=>$value){ ?>
                                            <option value="<?php echo $key; ?>" <?php if($donar->donation_category == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                           <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('donation_category'); ?></div>
                                    </div>
                                    </div>

                                    <div class="item form-group"> 
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doner_name"> <?php echo $this->lang->line('donar_name'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="doner_name"  id="edit_donar_name" value="<?php echo isset($donar->doner_name) ?  $donar->doner_name : ''; ?>" placeholder="<?php echo $this->lang->line('donar_name'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('doner_name'); ?></div>
                                        </div>
                                    </div>

                                    <div class="item form-group"> 
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_name"><?php echo $this->lang->line('contact_name'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="contact_name"  id="edit_contact_name" value="<?php echo isset($donar->contact_name) ?  $donar->contact_name : ''; ?>" placeholder="<?php echo $this->lang->line('contact_name'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('contact_name'); ?></div>
                                        </div>
                                    </div>
                                                               
                                    <div class="item form-group"> 
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"> <?php echo $this->lang->line('email'); ?></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="email"  id="edit_email" value="<?php echo isset($donar->email) ?  $donar->email : ''; ?>" placeholder="<?php echo $this->lang->line('email'); ?>" type="email" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('email'); ?></div>
                                        </div>
                                    </div>
                                                                      
                                    <div class="item form-group">
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone"><?php echo $this->lang->line('phone'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="edit_phone" value="<?php echo isset($donar->phone) ?  $donar->phone : ''; ?>" placeholder="<?php echo $this->lang->line('phone'); ?>" required="required" type="number"  autocomplete="off">
                                         <div class="help-block"><?php echo form_error('phone'); ?></div>
                                       </div>
                                    </div>
                                     
                                    <div class="item form-group">
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"><?php echo $this->lang->line('amount'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="hidden" value="<?php echo isset($donar->amount) ?  $donar->amount : ''; ?>" name="old_amount" />
                                            <input  class="form-control col-md-7 col-xs-12"  name="amount"  id="edit_amount" value="<?php echo isset($donar->amount) ?  $donar->amount : ''; ?>" placeholder="<?php echo $this->lang->line('amount'); ?>" required="required" type="number" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('amount'); ?></div>
                                       </div>
                                    </div>
                                
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"><?php echo $this->lang->line('address'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea  class="form-control col-md-7 col-xs-12"  name="address"  id="edit_address"  placeholder="<?php echo $this->lang->line('address'); ?>"> <?php echo isset($donar->address) ?  $donar->address : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('address'); ?></div>
                                        </div>
                                    </div> 
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="edit_note"  placeholder="<?php echo $this->lang->line('note'); ?>"> <?php echo isset($donar->note) ?  $donar->note : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('note'); ?></div>
                                        </div>
                                    </div> 
                                
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <input type="hidden" value="<?php echo isset($donar) ? $donar->id : ''; ?>" id="id" name="id" />
                                            <a  href="<?php echo site_url('donation/doner/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
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


<div class="modal fade bs-donar-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_donar_data">            
        </div>       
      </div>
    </div>
</div>
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
<script type="text/javascript">
    $('#add_date').datepicker();     
    function get_donar_modal(id){
         
        $('.fn_donar_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('donation/doner/get_single_doner'); ?>",
          data   : {id : id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_donar_data').html(response);
             }
          }
       });
    }
</script>

 <script type="text/javascript">
 
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
      
    $("#add").validate();   
    $("#edit").validate();   

    function get_donar_by_school(url){          
        if(url){
            window.location.href = url; 
        }
    }    
</script> 
