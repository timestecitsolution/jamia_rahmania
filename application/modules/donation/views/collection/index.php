<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bell-o"></i><small> <?php echo $this->lang->line('manage_donation'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link no-print">
                <?php $this->load->view('quick-link'); ?>              
            </div>
            
            <div class="x_content no-print">
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
                                                <?php if(has_permission(VIEW, 'donation', 'doner')){ ?>
                                                    <a  onclick="get_donation_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-donar-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'donation', 'doner')){ ?>    
                                                    <a href="<?php echo site_url('donation/collection/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
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
                               <?php echo form_open(site_url('donation/collection/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                             
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doner_name">
                                        <?php echo $this->lang->line('donar_name'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="select2_mamun form-control col-md-7 col-xs-12" name="doner_name" id="add_donar_name" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('doner_name'); ?></div>
                                    </div>
                                </div>
                                <input type="hidden" id="doner_id_hidden" name="doner_id">

                                <div class="item form-group" id="donation_cycle_wrapper" style="display: none;">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="donation_cycle"><?php echo $this->lang->line('donation_cycle'); ?><span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="select2_mamun form-control col-md-7 col-xs-12" name="donation_cycle[]" id="donation_cycle" multiple="multiple" required>
                                        </select>
                                        <div class="help-block"><?php echo form_error('donation_cycle'); ?></div>
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


                                <!-- For cheque Start-->
                                <div class=" fn_paid_status" style="<?php if(isset($post) && $post['paid_status'] == 'paid'){ echo 'display:block;';} ?>">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_method"><?php echo $this->lang->line('payment_method'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select  class="select2_mamun form-control col-md-7 col-xs-12"  name="payment_method"  id="payment_method" onchange="check_payment_method(this.value);" required>
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                <?php $payments = get_payment_methods(); ?>
                                                <?php foreach($payments as $key=>$value ){ ?>                                              
                                                    <?php if(!in_array($key, array('paypal', 'payumoney', 'ccavenue', 'paytm','stripe','paystack'))){ ?>
                                                        <option value="<?php echo $key; ?>" <?php if(isset($post) && $post['payment_method'] == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                    <?php } ?>  
                                                <?php } ?>                                            
                                            </select>
                                        <div class="help-block"><?php echo form_error('payment_method'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- For cheque Start-->
                                <div class="display fn_cheque" style="<?php if(isset($post) && $post['payment_method'] == 'cheque'){ echo 'display:block;';} ?>">
                                    
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank_name"><?php echo $this->lang->line('bank_name'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="bank_name"  id="single_bank_name" value="" placeholder="<?php echo $this->lang->line('bank_name'); ?> "  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('bank_name'); ?></div>
                                        </div>
                                    </div> 
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cheque_no"><?php echo $this->lang->line('cheque_number'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="cheque_no"  id="single_cheque_no" value="" placeholder="<?php echo $this->lang->line('cheque_number'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('cheque_no'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- For cheque End-->
                                
                                <!-- For bank_receipt Start-->
                                <div class="display fn_receipt" style="<?php if(isset($post) && $post['payment_method'] == 'receipt'){ echo 'display:block;';} ?>">
                                    
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank_receipt"><?php echo $this->lang->line('bank_receipt'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="bank_receipt"  id="single_bank_receipt" value="" placeholder="<?php echo $this->lang->line('bank_receipt'); ?> "  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('bank_receipt'); ?></div>
                                        </div>
                                    </div>                                     
                                </div>
                                <!-- For bank_receipt End-->


                                <!-- For mfs Start-->
                                <div class="display fn_mfs" style="<?php if(isset($post) && $post['payment_method'] == 'mfs'){ echo 'display:block;';} ?>">
                                    
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mfs_name"><?php echo $this->lang->line('mfs_name'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select  class="select2_mamun form-control col-md-7 col-xs-12"  name="mfs_name"  id="single_mfs_name">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                <?php $mfs_gateway = get_mfs_getway(); ?>
                                                <?php foreach($mfs_gateway as $key=>$value ){ ?>                                              
                                                    <option value="<?php echo $key; ?>" <?php if(isset($post) && $post['mfs_name'] == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                <?php } ?>                                            
                                            </select>
                                            <div class="help-block"><?php echo form_error('mfs_name'); ?></div>
                                        </div>
                                    </div>    
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mfs_transaction_id"><?php echo $this->lang->line('mfs_transaction_id'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="mfs_transaction_id"  id="single_mfs_transaction_id" value="" placeholder="<?php echo $this->lang->line('mfs_transaction_id'); ?> "  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mfs_transaction_id'); ?></div>
                                        </div>
                                    </div>                                  
                                </div>
                                <!-- For mfs End-->


                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date"><?php echo $this->lang->line('date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="donation_date"  id="add_date" value="<?php echo isset($post['donation_date']) ?  $post['donation_date'] : ''; ?>" placeholder="<?php echo $this->lang->line('date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('date'); ?></div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-donar-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header no-print">
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


function check_payment_method(payment_method) {
        if (payment_method == "cheque") {
            
            $('.fn_cheque').show();                
            $('.fn_receipt').hide();                
            $('.fn_mfs').hide();                
            $('#single_bank_name').prop('required', true);
            $('#single_cheque_no').prop('required', true);  
            $('#single_bank_receipt').prop('required', false);  
            
        }else if (payment_method == "receipt") {
            
            $('.fn_receipt').show();                
            $('.fn_cheque').hide(); 
            $('.fn_mfs').hide();      
            $('#single_bank_receipt').prop('required', true);
            $('#single_bank_name').prop('required', false);
            $('#single_cheque_no').prop('required', false);                

        }else if (payment_method == "mfs") {
            $('.fn_receipt').hide();                
            $('.fn_cheque').hide();
            $('.fn_mfs').show();       
            $('#single_mfs_name').prop('required', true);
            $('#single_mfs_transaction_id').prop('required', true);               

        } else{
            
            $('.fn_cheque').hide();  
            $('.fn_receipt').hide();  
            $('.fn_mfs').hide();  
            $('#single_bank_name').prop('required', false);
            $('#single_cheque_no').prop('required', false); 
            $('#single_bank_receipt').prop('required', false); 
        } 
    }
$(document).ready(function() {

    var response_amount = 0;
    $('#add_donation_category, #add_donar_type').on('change', function() {
        var doner_type = $('#add_donation_category').val();
        var donation_category = $('#add_donar_type').val();

        if (doner_type && donation_category) {
            $.ajax({
                url: "<?php echo base_url('donation/Collection/get_doner_names'); ?>",
                type: "POST",
                data: {
                    doner_type: doner_type,
                    donation_category: donation_category
                },
                dataType: "json",
                success: function(response) {
                    $('#add_donar_name').empty().append('<option value="">--Select--</option>');
                    $.each(response, function(key, value) {
                        $('#add_donar_name').append('<option value="'+ value +'" data-id="'+ key +'">'+ value +'</option>');

                    });
                    $('#doner_id_hidden').val('');
                }
            });
        } else {
            $('#add_donar_name').empty().append('<option value="">--Select--</option>');
            $('#doner_id_hidden').val('');
        }
    });

    function populateDonationCycle(type, paidCycles = []) {
        const cycleWrapper = $('#donation_cycle_wrapper');
        const cycleSelect = $('#donation_cycle');
        cycleSelect.empty();

        const now = new Date();
        const yearSuffix = now.getFullYear().toString().slice(-2); 

        if (type === 'Monthly') {
            const months = {
                'January': 'm1', 'February': 'm2', 'March': 'm3',
                'April': 'm4', 'May': 'm5', 'June': 'm6',
                'July': 'm7', 'August': 'm8', 'September': 'm9',
                'October': 'm10', 'November': 'm11', 'December': 'm12'
            };

            $.each(months, function (label, code) {
                const value = `${code}-${yearSuffix}`;
                if (!paidCycles.includes(value)) {
                    cycleSelect.append(new Option(label, value));
                }
            });
            cycleSelect.attr('multiple', 'multiple');
            cycleWrapper.show();

        } else if (type === 'Quarterly') {
        const quarters = {
            'January - March': 'q1',
            'April - June': 'q2',
            'July - September': 'q3',
            'October - December': 'q4'
        };

        $.each(quarters, function (label, code) {
            const value = `${code}-${yearSuffix}`;
            if (!paidCycles.includes(value)) {
                cycleSelect.append(new Option(label, value));
            }
        });
        cycleSelect.attr('multiple', 'multiple');
        cycleWrapper.show();

        } else if (type === 'Half Yearly') {
            const halves = {
                'January - June': 'h1',
                'July - December': 'h2'
            };

            $.each(halves, function (label, code) {
                const value = `${code}-${yearSuffix}`;
                if (!paidCycles.includes(value)) {
                    cycleSelect.append(new Option(label, value));
                }
            });
            cycleSelect.attr('multiple', 'multiple');
            cycleWrapper.show();

        } else if (type === 'Yearly') {
            let currentYear = now.getFullYear();
            let startYear = currentYear - 20;
            let endYear = currentYear + 20;

            for (let year = startYear; year <= endYear; year++) {
                const yearStr = year.toString();
                if (!paidCycles.includes(yearStr)) {
                    let isSelected = (year === currentYear);
                    cycleSelect.append(new Option(yearStr, yearStr, isSelected, isSelected));
                }
            }
            cycleSelect.attr('multiple', 'multiple');
            cycleWrapper.show();
        } else {
            cycleWrapper.hide();
            cycleSelect.empty();
        }
    }


        $('#add_donar_name').on('change', function () {
            var selectedId = $(this).find(':selected').data('id');
            $('#doner_id_hidden').val(selectedId);
            updateDonationCycle(); 
        });

        $('#add_donar_type').on('change', function () {
            updateDonationCycle(); 
        });

        function normalizePaidCycles(rawCycles) {
            const flatList = [];
            rawCycles.forEach(entry => {
                entry.split(',').forEach(cycle => {
                    flatList.push(cycle.trim());
                });
            });
            return flatList;
        }
        $('#donation_cycle').on('change', function () {
            var perMonthAmount = parseFloat(response_amount) || 0;
            var selectedMonths = $(this).val();
            var count = selectedMonths ? selectedMonths.length : 0;
            var total_amount = perMonthAmount * count; 
            $('#add_amount').val(parseFloat(total_amount));
        });



        // Common function to call AJAX and populate cycles
        function updateDonationCycle() {
            const selectedType = $('#add_donar_type').find('option:selected').text().trim();
            const selectedDonorId = $('#add_donar_name').find(':selected').data('id');

            if (!selectedType || !selectedDonorId) {
                $('#donation_cycle').empty();
                $('#donation_cycle_wrapper').hide();
                return;
            }

            $.ajax({
                url: '<?php echo base_url("donation/Collection/get_paid_cycles"); ?>',
                type: 'POST',
                data: {
                    donor_id: selectedDonorId,
                    type: selectedType
                },
                dataType: 'json',
                success: function (paidCycles) {
                    const normalized = normalizePaidCycles(paidCycles);
                    populateDonationCycle(selectedType, normalized);
                }
            });
        }


    

    $('#add_donar_name').on('change', function () {
        var doner_id = $('#doner_id_hidden').val();
            if (doner_id) {
                $.ajax({
                    url: '<?php echo base_url("donation/Collection/get_doner_details"); ?>',
                    type: 'POST',
                    data: {id: doner_id},
                    dataType: 'json',
                    success: function (response) {
                        response_amount = response.amount;
                        $('#add_contact_name').val(response.contact_name).prop('readonly', true);
                        $('#add_email').val(response.email).prop('readonly', true);
                        $('#add_phone').val(response.phone).prop('readonly', true);
                        $('#add_amount').val(response.amount).prop('readonly', true);
                        $('#add_address').val(response.address).prop('readonly', true);
                        $('#add_note').val(response.note).prop('readonly', false);
                    }
                });
            } else {
                $('#add_contact_name, #add_email, #add_phone, #add_address, #add_note').val('').prop('readonly', false);
            }
        });
});

         
    function get_donation_modal(id){
         
        $('.fn_donar_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('donation/collection/get_single_donation'); ?>",
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
