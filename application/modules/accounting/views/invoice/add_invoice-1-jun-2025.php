<style type="text/css">
    #exTab2 h3 
    {
      color : white;
      background-color: #428bca;
      padding : 5px 15px;
    }
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-calculator"></i><small> <?php echo $this->lang->line('manage_invoice'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
           
            <div class="x_content quick-link no-print">
                <?php $this->load->view('quick-link'); ?>  
            </div>
            

            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    <div class="tab-content  no-print">
                        
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('accounting/invoice/add'), array('name' => 'single', 'id' => 'single', 'class'=>'form-horizontal form-label-left','method'=> 'post'), ''); 
                               ?>
                                
                                <?php $this->load->view('layout/school_list_form'); ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="select2_mamun form-control col-md-7 col-xs-12"  name="class_id"  id="class_id" required="required" onchange="get_student_by_class(this.value, '');" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php if(isset($classes) && !empty($classes)){ ?>
                                                <?php foreach($classes as $obj ){ ?>
                                                    

                                                    <option value="<?php echo $obj->id; ?>" <?php echo isset($auto_class_id) && $auto_class_id == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="student_id"><?php echo $this->lang->line('student'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="select2_mamun form-control col-md-7 col-xs-12"  name="student_id"  id="student_id" required="required" onchange="reset_form_data()">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                    </div>
                                </div>

                                
                                    
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="income_head_id"><?php echo $this->lang->line('fee_type'); ?><span class="required"> *</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 fn_single_fee_item">
                                         <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                        
                                         <?php }else{ ?>
                                            
                                            <?php if(isset($income_heads) && !empty($income_heads)){ ?>
                                                <?php foreach($income_heads as $obj ){ ?>
                                                    <input onclick="get_single_fee_amount(<?php echo $obj->id; ?>)" type="checkbox" name="income_head_id[<?php echo $obj->id; ?>]" id="income_head_id_<?php echo $obj->id; ?>" class="fn_income_head_id" value="<?php echo $obj->id; ?>" > <?php echo $obj->title; ?>
                                                    <br/>
                                                <?php } ?> 
                                            <?php } ?> 
                                         <?php } ?>
                                        
                                        
                                        <div class="help-block"><?php echo form_error('income_head_id'); ?></div>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="item form-group month_show display">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_month"><?php echo $this->lang->line('month'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php
                                        $array_months = months();
                                        foreach ($array_months as $key => $hostel) {
                                                $array_m[$key] = $hostel;
                                        }
                                        echo form_dropdown("month[]", $array_m, set_value("month"), "id='month' multiple class='js-example-basic-multiple col-md-7 col-xs-12 form-control select2' placeholder='Month'");
                                        ?>
                                        <div class="help-block"><?php echo form_error('month'); ?></div>
                                    </div>
                                </div>  


                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"><?php echo $this->lang->line('fee_amount'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12" readonly="readonly"  name="amount"  id="amount" value="<?php echo isset($post['amount']) ?  $post['amount'] : '0.00'; ?>" placeholder="<?php echo $this->lang->line('fee_amount'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('amount'); ?></div>
                                    </div>
                                </div>                                
                                                
                                
                                
                                <div class="item form-group display" >
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_applicable_discount"><?php echo $this->lang->line('is_applicable_discount'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="select2_mamun form-control col-md-7 col-xs-12" name="is_applicable_discount" id="is_applicable_discount" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                            <option value="1" selected ><?php echo $this->lang->line('yes'); ?></option>                                           
                                            <option value="0"><?php echo $this->lang->line('no'); ?></option>                                           
                                        </select>
                                        <div class="help-block"><?php echo form_error('is_applicable_discount'); ?></div>
                                    </div>
                                </div>

                                

                                <div class="student_default_discount" >
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Default <?php echo $this->lang->line('discount'); ?></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input readonly class="form-control col-md-7 col-xs-12 default_discount"  name="default_discount" id="default_discount_val"   value="0.00" placeholder="<?php echo $this->lang->line('default_discount'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('default_discount'); ?></div>
                                    </div>
                                    </div>
                                </div>

                                <div class=" discount_div" style="<?php if(isset($post) && $post['discount']>0){ echo 'display:block;';} ?>">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount"><?php echo $this->lang->line('discount'); ?></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12 discount"  name="" id="discount_val"   value="<?php echo isset($post['discount']) ?  $post['discount'] : ''; ?>" placeholder="<?php echo $this->lang->line('discount'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('discount'); ?></div>
                                    </div>
                                    </div>
                                </div>


                                <div class="discount_div" style="<?php if(isset($post) && $post['discount']>0){ echo 'display:block;';} ?>">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Total <?php echo $this->lang->line('discount'); ?></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input readonly class="form-control col-md-7 col-xs-12 discount"  name="discount" id="discount_val_total"   value="0.00" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('discount'); ?></div>
                                    </div>
                                    </div>
                                </div>


                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="net_amount">Net Amount</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12" readonly="readonly"  name=""  id="net_amount" value="<?php echo isset($post['amount']) ?  ($post['amount']-$post['discount']) : '0.00'; ?>" placeholder="Net Amount" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('amount'); ?></div>
                                    </div>
                                </div> 

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prev_due_amount">Previous Due Amount</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12" readonly="readonly"  name="prev_due_amount"  id="prev_due_amount" value="<?php echo isset($post['amount']) ?  ($post['amount']-$post['discount']) : '0.00'; ?>" placeholder="Previous Due Amount" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('prev_due_amount'); ?></div>
                                    </div>
                                </div> 

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_payable">Total Payable(Net + Previous due)</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12" readonly="readonly"  name="total_payable"  id="total_payable" value="<?php echo isset($post['amount']) ?  ($post['amount']-$post['discount']) : '0.00'; ?>" placeholder="Net Amount" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('amount'); ?></div>
                                    </div>
                                </div> 

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="due_amount"><?php echo $this->lang->line('due_amount'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12" readonly="readonly"  name="due_amount"  id="due_amount" value="<?php echo isset($post['due_amount']) ?  ($post['amount']-$post['partial_payment_amount']) : '0.00'; ?>" placeholder="Due Amount" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('due_amount'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group" id="zakat_amount_div" style="display:none">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount_recieved_from_zakat"><?php echo $this->lang->line('amount_recieved_from_zakat'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12" readonly="readonly"  name="amount_recieved_from_zakat"  id="amount_recieved_from_zakat" value="<?php echo isset($post['amount_recieved_from_zakat']) ?  ($post['amount']-$post['partial_payment_amount']) : '0.00'; ?>" placeholder="Amount Recieved from Zakat" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('amount_recieved_from_zakat'); ?></div>
                                    </div>
                                </div>
                                <?php 
                                    $zakat_fund_data = zakat_fund(); 
                                    $zakat_fund_amount = isset($zakat_fund_data->zakat_fund) ? $zakat_fund_data->zakat_fund : 0;
                                    $is_disabled = ($zakat_fund_amount == 0 || $zakat_fund_amount === null);
                                ?>
                                <div class="item form-group" id="zakat_eligibility_container" style="display:none;">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_eligible_for_zakat"><?php echo $this->lang->line('is_eligible_for_zakat'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" id="zakat_eligibility" name="zakat_eligibility" type="checkbox" role="switch" value="1" <?php echo $is_disabled ? 'disabled' : ''; ?>> <span>Zakat fund amount: <?php echo $zakat_fund_amount;?></span>
                                            <?php if ($is_disabled): ?>
                                                <div class="help-block">Zakat fund amount is 0. Eligibility selection is disabled.</div>
                                            <?php endif; ?>
                                        </div> 
                                    </div>  
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paid_status"><?php echo $this->lang->line('paid_status'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="select2_mamun form-control col-md-7 col-xs-12" name="paid_status" id="paid_status"   onchange="check_paid_status(this.value);">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                            <option value="paid" ><?php echo $this->lang->line('paid'); ?></option>                                           
                                            <option value="unpaid"><?php echo $this->lang->line('unpaid'); ?></option>
                                            <option value="partially_paid"><?php echo $this->lang->line('partial_payment'); ?></option>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('paid_status'); ?></div>
                                    </div>
                                </div>

                                <div class="partial_payment_div" id="partial_payment_div" style="display:none">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="partial_payment_amount"><?php echo $this->lang->line('partial_payment_amount'); ?><span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12 discount"  name="partial_payment_amount" id="partial_payment_amount"   value="<?php echo isset($post['partial_payment_amount']) ?  $post['partial_payment_amount'] : ''; ?>" placeholder="<?php echo $this->lang->line('partial_payment_amount'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('partial_payment_amount'); ?></div>
                                    </div>
                                    </div>
                                </div>

                                <?php
                                    // $post['payment_method'] = 'cash';
                                ?>
                                <!-- For cheque Start-->
                                <div class=" fn_paid_status" style="<?php if(isset($post) && $post['paid_status'] == 'paid'){ echo 'display:block;';} ?>">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_method"><?php echo $this->lang->line('payment_method'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select  class="select2_mamun form-control col-md-7 col-xs-12"  name="payment_method"  id="payment_method" onchange="check_payment_method(this.value);">
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
                                            <input  class="form-control col-md-7 col-xs-12"  name="mfs_name"  id="single_mfs_name" value="" placeholder="<?php echo $this->lang->line('mfs_name'); ?> "  type="text" autocomplete="off">
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="single" name="type" />
                                        <a href="<?php echo site_url('accounting/invoice/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
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


<?php $this->load->view('invoice-modal'); ?> 

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- bootstrap-datetimepicker -->
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 
<script type="text/javascript"> 

    var discountId = 0;
    var array1 = [];
     array2 = [];


    $("#month").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months",
        numberOfMonths: 2
    });

    $(document).ready(function() {
        reset_form_data();
        $('.js-example-basic-multiple').select2();
        $('#discount_val').val('0.00');
        $('.student_default_discount').hide();

    });

    $('#zakat_eligibility').on('change', function () {
        if ($(this).is(':checked')) {
            $('#discount_val').val('800.00');
            $('#partial_payment_div').show();
            $('#zakat_amount_div').show();
            $('#partial_payment_amount').prop('required', true);
            
            $('#paid_status').val('paid').trigger('change');
            $('#paid_status').prop('disabled', true);
            calculate_fees();  
            calculate_net_amount()          
            if ($('#paid_status_hidden').length === 0) {
                $('<input>').attr({
                    type: 'hidden',
                    id: 'paid_status_hidden',
                    name: 'paid_status',
                    value: 'paid'
                }).appendTo('form');
            } else {
                $('#paid_status_hidden').val('paid');
            }
        } else {
            $('#partial_payment_div').hide();
            $('#zakat_amount_div').hide();
            $('#partial_payment_amount').prop('required', false);
            $('#discount_val').val('0.00');
            $('#discount_val_total').val('0.00');
            $('#net_amount').val('0.00');
            $('#total_payable').val('0.00');


            $('#paid_status').prop('disabled', false);
            $('#paid_status').val(''); 
            
            if ($('#paid_status_hidden').length > 0) {
                $('#paid_status_hidden').remove();
            }
        }
    });


    function check_paid_status(paid_status) {
        if (paid_status == "paid") {  
           if ($('#zakat_eligibility').is(':checked')) {
                $('#partial_payment_div').show();
                $('#partial_payment_amount').prop('required', true);
            } else {
                $('#partial_payment_div').hide();
                $('#partial_payment_amount').prop('required', false);
            }
            $('.fn_paid_status').show();
            $('#payment_method').prop('required', true);
        } else if(paid_status == "partially_paid"){
            $('#partial_payment_div').show();
            $('#partial_payment_amount').prop('required', true);
        }else{
            
            
            $('.fn_cheque').hide();          
            $('.fn_cheque').hide();          
            $('.fn_receipt').hide();          
            $('.fn_receipt').hide();          
            $('.fn_mfs').hide();          
            $('.fn_mfs').hide();          
            $('.fn_paid_status').hide();  
            $('.fn_paid_status').hide();  
            $('#partial_payment_div').hide();  
            $('#payment_method').prop('required', false);  
            $('#payment_method').prop('required', false);               
            $('#partial_payment_amount').prop('required', false);
        }
        
        
        $("select#payment_method").prop('selectedIndex', 0);
        $("select#payment_method").prop('selectedIndex', 0);
    }
    $('#partial_payment_amount').on('change', function(){
        var total_payable = parseFloat($('#total_payable').val());
        var partial_amount = parseFloat($('#partial_payment_amount').val());
        var prev_due_amount = parseFloat($('#prev_due_amount').val());

        $('#partial_payment_amount').val(partial_amount.toFixed(2));
        $('#prev_due_amount').val(prev_due_amount.toFixed(2));


        if(total_payable <= partial_amount){
            alert("Partial amount is higher than net amount");
            $('#partial_payment_amount').val('');
        }
        if (partial_amount <= prev_due_amount) {
            alert("Partial amount must be higher than previous due amount");
            $('#partial_payment_amount').val('');
        }

    }) 
              
    function check_payment_method(payment_method) {

        if (payment_method == "cheque") {
            
            $('.fn_cheque').show();                
            $('.fn_receipt').hide();                
            $('.fn_mfs').hide();                
            $('#bank_name').prop('required', true);
            $('#cheque_no').prop('required', true);  
            $('#bank_receipt').prop('required', false);  
            
        }else if (payment_method == "receipt") {
            
            $('.fn_receipt').show();                
            $('.fn_cheque').hide(); 
            $('.fn_mfs').hide();      
            $('#bank_receipt').prop('required', true);
            $('#bank_name').prop('required', false);
            $('#cheque_no').prop('required', false);                

        }else if (payment_method == "mfs") {
            
            $('.fn_receipt').hide();                
            $('.fn_cheque').hide();
            $('.fn_mfs').show();       
            $('#mfs_name').prop('required', true);
            $('#mfs_transaction_id').prop('required', true);               

        } else{
            
            $('.fn_cheque').hide();  
            $('.fn_receipt').hide();  
            $('.fn_mfs').hide();  
            $('#bank_name').prop('required', false);
            $('#cheque_no').prop('required', false); 
            $('#bank_receipt').prop('required', false); 
        } 
    }
          
    $('.fn_school_id').on('change', function(){
      
        var school_id = $(this).val();
        var class_id = '';       
        var auto_class_id = '<?php echo $auto_class_id; ?>';       
        if(!school_id){
           toastr.error('<?php echo $this->lang->line("select_school"); ?>');
           return false;
        }
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { school_id:school_id, class_id:class_id, auto_class_id:auto_class_id },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                     
                   $('#class_id').html(response); 
               }
               get_single_fee_type_by_school(school_id);
               get_bulk_fee_type_by_school(school_id);
            }
        });
    }); 

    $('#discount_val').on('keyup', function(){
        calculate_fees();
    });


    $('#student_id').on('change', function () {
        var student_id = $(this).val();
        
        student_id_change(student_id);
    });

    function student_id_change(student_id)
    {
        
        var school_id = $('.fn_school_id').val();
        discountId = $(this).find(':selected').data('discount');
         
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/invoice/get_month_by_student'); ?>",
            data   : {school_id:school_id, student_id : student_id},               
            async  : false,
            success: function(response){    
                const res = JSON.parse(response);   
                if(res.html) {
                    $('#month').html(res.html); 
                }

                if (res.zakat_eligible == 1) {
                    $('#zakat_eligibility_container').show();  
                } else {
                    $('#zakat_eligibility_container').hide(); 
                }
            }
        });

        if (student_id !== '') {
            $.ajax({
                url: '<?php echo site_url("accounting/invoice/get_latest_due_amount"); ?>',
                type: 'POST',
                data: {student_id: student_id},
                dataType: 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        var due = parseFloat(response.due_amount);
                        $('#prev_due_amount').val(isNaN(due) ? '0.00' : due.toFixed(2));
                    } else {
                        alert(response.message);
                        $('#prev_due_amount').val('0.00');
                    }
                }
            });
        }
    }

    $(document).ready(function () {
            $(document).on('change', '.fn_income_head_id', function () {
                calculate_net_amount();
            });

            $('#month').on('change', function () {
                calculate_net_amount();
            });
            $('#discount_val').on('keyup', function(){
                calculate_net_amount();
            });

            var auto_class_id = '<?php echo $auto_class_id; ?>';
            var auto_student_id = '<?php echo $auto_student_id; ?>';

            if(auto_class_id !== "" && auto_student_id !== "")
            {
                
                get_student_by_class(auto_class_id,auto_student_id);
                student_id_change(auto_student_id);
            }
            
        });

        function calculate_net_amount() {
            var net_amount = parseFloat($('#net_amount').val());
            var prev_due_amount = $('#prev_due_amount').val();

            var total_payable = parseFloat((net_amount + parseFloat(prev_due_amount)));
            $('#total_payable').val(total_payable);
        }


    $('#is_applicable_discount').on('change', function(){
      
        var is_applicable_discount = $(this).val();
        
        if(is_applicable_discount==1)
        {
            $('.discount_div').show();    
        }
        else
        {
            $('.discount_div').hide();
            $('.discount').val(0);     
        }
        
    }); 


    $('#month').on('change', function(){

        calculate_fees();
    });   
    $('#partial_payment_amount').on('keyup', function(){
            due_amount();
    });
    $('#discount_val').on('keyup', function(){
            due_amount();
    });
    $('#paid_status').on('change', function(){
        var paid_status = $('#paid_status').val();
        if(paid_status == "paid"){
            $('#due_amount').val('0.00');
        } else if(paid_status == "unpaid"){
            var net_amount = parseFloat($('#net_amount').val()) || 0;
            var prev_due_amount = parseFloat($('#prev_due_amount').val()) || 0;
            var total_payable = (net_amount + prev_due_amount) ;
            $('#due_amount').val(total_payable.toFixed(2));
        } else {
            due_amount();
        }
    });
    function due_amount(){
        var net_amount = parseFloat($('#net_amount').val()) || 0;
        var prev_due_amount = parseFloat($('#prev_due_amount').val()) || 0;
        var discount_val = parseFloat($('#discount_val').val()) || 0;

        var total_payable = net_amount + prev_due_amount;
        var partial_amount = parseFloat($('#partial_payment_amount').val()) || 0;
        var due_amount = total_payable - partial_amount;

        if ($('#zakat_eligibility').is(':checked')) {
            $('#due_amount').val('0.00');
            $('#amount_recieved_from_zakat').val(isNaN(due_amount) ? '0.00' : due_amount.toFixed(2));
        } else {
            $('#due_amount').val(isNaN(due_amount) ? '0.00' : due_amount.toFixed(2));
            $('#amount_recieved_from_zakat').val(''); 
        }
    }  
    function calculate_fees()
    {
        var student_id = $('#student_id').val(); 
        var class_id = $('#class_id').val(); 
        var school_id = $('.fn_school_id').val();
        var income_head_id = $('.fn_income_head_id').val();
        var month = $('#month').val()|| [];
        var number_of_month = month.length;
        var discount_val = $('#discount_val').val();
       
        var selectedFees = []; 

        $('.fn_income_head_id:checked').each(function () {
            selectedFees.push($(this).val()); 
        });

        var amount_ajax = 0;
        var x = 0;
        var discount_amount = 0;

        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/invoice/get_all_fee_amount'); ?>",
            data   : {school_id:school_id, student_id : student_id, class_id:class_id, income_head_id:selectedFees, month:month, number_of_month:number_of_month , discount_val:discount_val},
            async  : false,
            success: function(response){                                                   
               if(response)
               {     
                     amount_ajax  = response;
                    x = amount_ajax - discount_val;
                    if(parseFloat(discount_val) > parseFloat(amount_ajax) )
                    {
                        alert("Discount amount is higher than fees");
                        $('#zakat_eligibility').prop('checked', false);
                        $('#partial_payment_div').hide();
                        $('#zakat_amount_div').hide();
                        $('#partial_payment_amount').prop('required', false);
                        $('#paid_status').val('').trigger('change');
                        $('#paid_status').prop('disabled', false);
                        $('#discount_val').val(0);
                        $('#discount_val_total').val(0);
                        $('#amount').val(amount_ajax);
                        $('#net_amount').val(amount_ajax);
                    }
                    else
                    {
                        $('#amount').val(amount_ajax);
                        $('#net_amount').val(x);
                    }
               }
            }
        });

        $('#default_discount_val').val(0);

        if(discountId > 0)
        {
            $('.student_default_discount').show();
            $.ajax({       
                type   : "POST",
                url    : "<?php echo site_url('accounting/invoice/get_discount_type'); ?>",
                data   : {discountId:discountId},
                async  : false,
                dataType: "json",
                success: function(response1){                                                   
                   if(response1)
                   {     
                        var discount_type = response1.discount_type;
                         discount_amount = response1.amount;
                        var amount_all_stu = 0;

                        if(discount_type === 'flat')
                        {
                            amount_all_stu = x - discount_amount;
                        }
                        else
                        {
                           var y = (discount_amount * amount_ajax) / 100;
                           amount_all_stu = x - y;
                           discount_amount = y;
                        }
                        
                            
                        
                        
                        $('#net_amount').val(amount_all_stu);
                        $('#default_discount_val').val(discount_amount);


                   }
                }
            });
        }

        $('#discount_val_total').val(parseFloat(discount_val)+parseFloat(discount_amount));
        

    }

    // single
    function get_student_by_class(class_id, student_id){       
        
        var school_id = $('.fn_school_id').val();
               
        if(!school_id){
           toastr.error('<?php echo $this->lang->line("select_school"); ?>');
           return false;
        }
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/invoice/get_student_by_class'); ?>",
            data   : {school_id:school_id, class_id : class_id , student_id : student_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {     
                    $('#student_id').html(response); 
               }
            }
        });                 
        
   }
   
   
  // single  
   function get_single_fee_type_by_school(school_id){
   
    $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/invoice/get_single_fee_type_by_school'); ?>",
            data   : { school_id:school_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                    $('.fn_single_fee_item').html(response);
               }
            }
        });   
   }
   
    // single
    function get_single_fee_amount(income_head_id){
            
        var student_id = $('#student_id').val(); 
        var class_id = $('#class_id').val(); 
        var school_id = $('.fn_school_id').val();
        var amount = $('#amount').val();
        var month = $('#month').val()|| [];

        var number_of_month = month.length;
        var check_status = '';
        var count = 0;
        
        if(!student_id){            
            toastr.error('<?php echo $this->lang->line('select_student'); ?>');
            $('#income_head_id_'+income_head_id).prop('checked', false);
            return false;
        }
        
        if($('#income_head_id_'+income_head_id).is(":checked")){
            check_status = true;           
        }else{
            check_status = false;
        }         
   
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/invoice/get_single_fee_amount'); ?>",
            data   : { school_id : school_id, income_head_id : income_head_id, class_id : class_id,  student_id:student_id, amount:amount, check_status:check_status,number_of_month:number_of_month, month:month},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                    // if(number_of_month==0)
                    // {
                    //     $('#amount').val(amount);                     
                    //     $('#net_amount').val(amount); 
                    // }
                    // else
                    // {
                    //     $('#amount').val(response);                     
                    //     $('#net_amount').val(response); 
                    // }

                    calculate_fees();
                                       
               }
            }
        });  

        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/invoice/get_month_info'); ?>",
            data   : { school_id : school_id, income_head_id : income_head_id},               
            async  : false,
            success: function(response){                                                   
               if (check_status == true && response == 1) 
               {
                    array1.push(income_head_id);
                  
               }
               else if(check_status == false && response == 1)
               {
                    let indexToRemove = array1.indexOf(income_head_id); 
                    if (indexToRemove !== -1) 
                    { 
                        array1.splice(indexToRemove, 1); 
                    }
               }
               else{}

               if (array1 !== null && array1 !== undefined) {
                     count = array1.length;
                }
                
             
               if(count > 0)
               {
                    $('.month_show').show(); 
               }
               else
               {
                    $('.month_show').hide(); 
               }


            }
        });
   }
   
   
   
   //common
   function reset_form_data(){
      $('.fn_income_head_id').prop('checked', false);
      $('#amount').val('0.00');
      $('#discount_val').val('0.00');
      $('#month').val('');
      $('#is_applicable_discount').prop('selectedIndex', 0);
      $('#paid_status').prop('selectedIndex', 0);
      $('#payment_method').prop('selectedIndex', 0);
      $('#fn_student_container').html('');
      $('.fn_check_button').hide();
   }
   
   
   
 /* Bulk invoice */ 
    function get_bulk_fee_type_by_school(school_id){
   
    $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/invoice/get_bulk_fee_type_by_school'); ?>",
            data   : { school_id:school_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                    $('.fn_bulk_fee_item').html(response);
               }
            }
        });   
   }
   
    function get_bulk_fee_amount(income_head_id){
            
        var school_id = $('.fn_school_id').val();
        var class_id = $('#class_id').val(); 
        var check_status = '';
        
        if(!class_id){            
            toastr.error('<?php echo $this->lang->line('select_class'); ?>');
            $('#income_head_id_'+income_head_id).prop('checked', false);
            return false;
        }
        
        if($('#income_head_id_'+income_head_id).is(":checked")){
            check_status = true;           
        }else{
            check_status = false;
        }  
        
        var head_ids = [];     
        $("input[name^='income_head_id']").each(function() {  
            if($(this).is(':checked')){
                head_ids += $(this).attr('itemid')+',';
             }
        });
       
                
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/invoice/get_bulk_fee_amount'); ?>",
            data   : { school_id:school_id, class_id:class_id, head_ids:head_ids},               
            async  : false,
            success: function(response){                                                   
               if(response == 'ay')
               {  
                    toastr.error('<?php echo $this->lang->line('set_academic_year_for_school'); ?>');
                    reset_form_data();                    
               }else{
                   $('#fn_student_container').html(response);
                   $('.fn_check_button').show(); 
               }
            }
        });  
    }

   // bulk
   $('#check_all').on('click', function(){
        $('#fn_student_container').children().find('input[type="checkbox"]').prop('checked', true);;
   });
   $('#uncheck_all').on('click', function(){
        $('#fn_student_container').children().find('input[type="checkbox"]').prop('checked', false);;
   });
  
 </script>
 
 
 
 <!-- datatable with buttons -->
 <script type="text/javascript">
        $(document).ready(function() {
          $('.datatable-responsive').DataTable( {
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
        
    $("#single").validate();     
    $("#edit").validate(); 
    $("#bulk").validate();      
    
     function get_invoice_by_school(url){          
        if(url){
            window.location.href = url; 
        }
    }  
    
</script><style type="text/css">
    #exTab2 h3 
    {
      color : white;
      background-color: #428bca;
      padding : 5px 15px;
    }
</style>

