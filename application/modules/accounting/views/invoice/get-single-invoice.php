<section class="content invoice profile_img layout-box">
       <!-- title row -->
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 invoice-header_ text-center" style="text-align: center !important;">
               <?php if($settings->logo){ ?>
                  <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $settings->logo; ?>" alt="" width="100" /> 
               <?php }else if($settings->front_logo){ ?>
                  <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $settings->front_logo; ?>" alt="" width="100"/> 
               <?php }else{ ?>                                                        
                  <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $settings->brand_logo; ?>" alt="" width="100"/>
               <?php } ?> 
          </div>
      </div>
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 invoice-header_" style="text-align: center !important;">             
                <h3><?php echo $settings->school_name; ?></h3>
                 <?php echo $settings->address; ?>
                <br><?php echo $this->lang->line('phone'); ?>: <?php echo $settings->phone; ?>,
                <?php echo $this->lang->line('email'); ?>: <?php echo $settings->email; ?>              
          </div>            
      </div>
       <div class="row"><hr/></div>
      <!-- info row -->
      <div class="row invoice-info">          
          <div class="col-md-6 col-sm-6 col-xs-6 invoice-col_"> 
                <strong><?php echo $this->lang->line('student'); ?>:</strong>              
               <?php
                    $student = $this->db->get_where('students' , array('user_id' => $invoice->user_id))->row();
                    $student_info = $this->db->get_where('enrollments', array('student_id' => $student->id, 'class_id' => $invoice->class_id))->row();
                    $class = $this->db->get_where('classes', array('id' => $invoice->class_id))->row();
                    $section = $this->db->get_where('sections', array('id' => $student_info->section_id))->row();                   
                    $user = get_user_by_role($invoice->role_id, $invoice->user_id);
                    
                if(!empty($user)){    
                ?>
                    <strong><?php echo $this->lang->line('sale_to'); ?>:</strong> <?php echo  $user->name; ?> [<?php echo  $user->role; ?>]<br>                
                    <?php
                    $class_name = get_class_by_id($invoice->school_id, $invoice->class_id);
                    $section_name = get_section_by_id($invoice->school_id, $invoice->class_id,$invoice->section_id);
                                                                    
                    if($invoice->role_id == STUDENT){
                        echo '<strong>'.$this->lang->line('class').':</strong> '.$class->name.', <strong>'. $this->lang->line('section').':</strong> '.$section->name.', <strong>'. $this->lang->line('roll_no'). ':</strong>'. $user->roll_no . ']<br>';
                    }
                    ?>
                    <strong><?php echo $this->lang->line('phone'); ?>:</strong> <?php echo $user->phone; ?> 
                
                <?php } ?>
          </div>
          <!-- /.col -->
          <div class="col-md-6 col-sm-6 col-xs-6 invoice-col">             
                <strong><?php echo $this->lang->line('invoice'); ?>: </strong> #<?php echo $invoice->custom_invoice_id; ?>                                                   
                <br><strong><?php echo $this->lang->line('status'); ?>:</strong> <?php echo get_paid_status($invoice->paid_status); ?>
                <?php
               

                $month_value = $invoice->month;
                $month_value = json_decode($month_value);
                $text_month = "";
                foreach ($month_value as $key => $value) {
                  $month = date_create_from_format('!m-Y',$value)->format('M-Y');
                  $text_month .= $month.',';
                }
                $text_month = rtrim($text_month,',');

               
                ?>
                <br><strong><?php echo $this->lang->line('month'); ?>:</strong> <?php echo $text_month; ?>
                <br><strong><?php echo $this->lang->line('date'); ?>:</strong> <?php echo date($this->global_setting->date_format, strtotime($invoice->date)); ?>
          </div>
          <!-- /.col -->
      </div>   
      
   </section>    
   <section class="content invoice"> 
       <!-- Table row -->
       <div class="row">
           <div class="col-xs-12 table">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('sl_no'); ?></th>
                            <th><?php echo $this->lang->line('fee_type'); ?></th>
                            <th><?php echo $this->lang->line('gross_amount'); ?></th>
                            <th><?php echo $this->lang->line('discount'); ?></th>
                            <th><?php echo $this->lang->line('net_amount'); ?></th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php if(isset($invoice_items) && !empty($invoice_items)){ ?>
                            <?php $counter = 1; foreach($invoice_items as $item){ ?>
                            <tr>
                                <td  style="width:10%"><?php echo $counter++; ?></td>
                                <td  style="width:25%"> <?php echo $item->title; ?></td>
                                <td> <?php echo $settings->currency_symbol; ?><?php echo $item->gross_amount; ?></td>
                                <td><?php echo $settings->currency_symbol; ?><?php echo round($item->discount,2); ?></td>
                                <td><?php echo $settings->currency_symbol; ?><?php echo round($item->net_amount, 2); ?></td>
                            </tr> 
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
           </div>
           <!-- /.col -->
       </div>

       <div class="row">
           <!-- accepted payments column -->
           <!--<div class="col-xs-6">-->
           <!--    <p class="lead"><?php echo $this->lang->line('payment_method'); ?>:</p>-->
           <!--    <img src="<?php echo IMG_URL; ?>visa.png" alt="Visa">-->
           <!--    <img src="<?php echo IMG_URL; ?>mastercard.png" alt="Mastercard">-->
           <!--    <img src="<?php echo IMG_URL; ?>american-express.png" alt="American Express">-->
           <!--    <img src="<?php echo IMG_URL; ?>paypal.png" alt="Paypal">                       -->
           <!--</div>-->
           <!-- /.col -->
           <div class="col-xs-12">
               <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:56%"><?php echo $this->lang->line('subtotal'); ?>:</th>
                                <td><?php echo $settings->currency_symbol; ?><?php echo $invoice->gross_amount; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $this->lang->line('discount'); ?></th>
                                <td><?php echo $settings->currency_symbol; ?><?php  echo $invoice->inv_discount; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $this->lang->line('total'); ?>:</th>
                                <td><?php echo $settings->currency_symbol; ?><?php echo $invoice->total_payable; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $this->lang->line('paid_amount'); ?>:</th>
                                <td><?php echo $settings->currency_symbol; ?><?php 
                                if($invoice->paid_status == 'paid'){
                                    if ($invoice->zakat_eligibility == 1) {
                                        echo $invoice->partial_payment_amount;
                                    }else{
                                        echo $invoice->total_payable;
                                    }
                                }else{
                                    echo $invoice->partial_payment_amount ? $invoice->partial_payment_amount : 0.00; 
                                }
                                ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $this->lang->line('due_amount');?></th>
                                <td><span class="btn-danger" style="padding: 5px;border-radius: 4px;"><?php echo $settings->currency_symbol; ?><?php 
                                if($invoice->paid_status == 'paid'){
                                    echo '0';
                                }else{
                                    echo $invoice->total_payable-$invoice->partial_payment_amount; 
                                }
                                ?></span></td>
                            </tr>
                            <?php if ($invoice->zakat_eligibility == 1) { ?>
                            <tr>
                                <th><?php echo $this->lang->line('amount_recieved_from_zakat') ?></th>
                                <td><span class="btn-danger" style="padding: 5px;border-radius: 4px;"><?php echo $settings->currency_symbol; ?><?php echo $invoice->amount_recieved_from_zakat; ?></span></td>
                            </tr>
                            <?php } ?>
                            <?php if($invoice->paid_status == 'paid'){ ?>
                                <tr>
                                    <th><?php echo $this->lang->line('paid_date'); ?>:</th>
                                    <td><?php echo date($this->global_setting->date_format, strtotime($invoice->date)); ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th><?php echo $this->lang->line('collector'); ?>:</th>
                                <td><?php echo ($invoice->collector); ?></td>
                            </tr>
                             <tr>
                                <th><?php echo $this->lang->line('note'); ?>:</th>
                                <td><?php echo ($invoice->note); ?></td>
                            </tr>
                        </tbody>
                    </table>
               </div>
           </div>
           <!-- /.col -->
       </div>
       <!-- /.row -->

        <div class="row">
            <div class="col-xs-12"></div>
        </div>
       <!-- /.row -->
       <div class="row">       
           <p class="white text-center">
                <?php if(isset($settings->footer) && $settings->footer != ''){ ?>
                   <?php echo $settings->footer; ?>
                <?php }else{ ?>
                   <?php echo 'Copyright © '. date('Y').' <a target="_blank" href="https://codecanyon.net/user/codetroopers">Codetroopers Team.</a> All rights reserved.'; ?> 
                <?php } ?>
           </p> 
       </div>

   </section>  
  
       
<!-- this row will not appear when printing -->
<section>
    <div class="row no-print">
        <div class="col-xs-12">
            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
            <?php if($invoice->paid_status != 'paid'){ ?>
                <a href="<?php echo site_url('accounting/payment/index/'.$invoice->inv_id); ?>"><button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> <?php echo $this->lang->line('pay_now'); ?></button></a>
            <?php } ?>
        </div>
    </div>
</section>