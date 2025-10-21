<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('name'); ?></th>
            <td><?php echo $muhtamim_message->name; ?></td>
        </tr>        
        <tr>
            <th><?php echo $this->lang->line('message'); ?></th>
            <td><?php echo $muhtamim_message->message; ?></td>
        </tr>
        <?php if($muhtamim_message->img){ ?>
        <tr>
            <th><?php echo $this->lang->line('image'); ?></th>
            <td>                
                <img src="<?php echo UPLOAD_PATH; ?>/about/<?php echo $muhtamim_message->img; ?>" alt=""  class="img-responsive" /><br/><br/>
            </td>
        </tr>
         <?php } ?>
        <tr>
            <th><?php echo $this->lang->line('modified'); ?></th>
            <td><?php echo date($this->global_setting->date_format, strtotime($muhtamim_message->modified_at)); ?></td>
        </tr>        
    </tbody>
</table>
