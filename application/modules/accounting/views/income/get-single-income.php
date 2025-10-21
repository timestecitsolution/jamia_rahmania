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
          <!-- <div class="col-md-6 col-sm-6 col-xs-6 invoice-col_"> 
                    <strong><?php echo $this->lang->line('doner'); ?>:</strong> <?php echo  $donar->doner_name; ?><br>  
                    <strong><?php echo $this->lang->line('donation_category'); ?>:</strong> <?php echo $donar->donation_category; ?><br>              
                    <strong><?php echo $this->lang->line('phone'); ?>:</strong> <?php echo $donar->doner_phone; ?> 
          </div> -->
          <div class="col-md-6 col-sm-6 col-xs-6 invoice-col">             
                <strong><?php echo $this->lang->line('invoice'); ?>: </strong> #<?php echo $income->custom_invoice_id; ?>                                                   
                <br><strong><?php echo $this->lang->line('status'); ?>:</strong> <?php echo get_paid_status($income->paid_status); ?>
                <br><strong><?php echo $this->lang->line('income_head'); ?>:</strong> <?php echo $income->head; ?>
          </div>
      </div>   
      
   </section>    
   <section class="content invoice"> 
       <!-- Table row -->
       <div class="row">
           <div class="col-xs-12 table">
           </div>
       </div>

       <div class="row">
           <div class="col-xs-12">
               <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:56%"><?php echo $this->lang->line('subtotal'); ?>:</th>
                                <td><?php echo $settings->currency_symbol; ?><?php echo $income->net_amount; ?></td>
                            </tr>
                            <?php if($income->paid_status == 'paid'){ ?>
                                <tr>
                                    <th><?php echo $this->lang->line('paid_date'); ?>:</th>
                                    <td><?php echo date($this->global_setting->date_format, strtotime($income->date)); ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th style="width:56%"><?php echo $this->lang->line('collector'); ?>:</th>
                                <td><?php echo $income->collector; ?></td>
                            </tr>
                            <tr>
                                <th style="width:56%"><?php echo $this->lang->line('note'); ?>:</th>
                                <td><?php echo $income->note; ?></td>
                            </tr>
                        </tbody>
                    </table>
               </div>
           </div>
       </div>

        <div class="row">
            <div class="col-xs-12"></div>
        </div>
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
            <?php if($income->paid_status != 'paid'){ ?>
                <a href="<?php echo site_url('accounting/payment/index/'.$income->inv_id); ?>"><button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> <?php echo $this->lang->line('pay_now'); ?></button></a>
            <?php } ?>
        </div>
    </div>
</section>