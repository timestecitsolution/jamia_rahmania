<span><?php echo $this->lang->line('quick_link'); ?>:</span>             
<?php if(has_permission(VIEW, 'scholarship', 'donar')){ ?>
  | <a href="<?php echo site_url('donation/doner/index'); ?>"><?php echo $this->lang->line('doner'); ?></a>                  
<?php } ?> 
<?php if(has_permission(VIEW, 'scholarship', 'scholarship')){ ?>
  | <a href="<?php echo site_url('donation/collection/index'); ?>"><?php echo $this->lang->line('collection'); ?></a>                  
<?php } ?> 