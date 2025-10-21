<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>               
            <th width="20%"><?php echo $this->lang->line('school_name'); ?></th>
            <td width="30%"><?php echo $donar->school_name; ?></td>                    
            <th width="20%"><?php echo $this->lang->line('session_year'); ?></th>
            <td width="30%"><?php echo $donar->session_year; ?></td>
        </tr>
        
        <tr>
            <th> <?php echo $this->lang->line('donar_type'); ?> </th>
            <td><?php echo $this->lang->line($donar->doner_type); ?></td> 
            <th> <?php echo $this->lang->line('donation_category'); ?> </th>
            <td><?php echo $this->lang->line($donar->donation_category); ?></td>    
        </tr>
           
        <tr>
            <th><?php echo $this->lang->line('donar_name'); ?></th>
            <td><?php echo $donar->doner_name; ?></td> 
            <th><?php echo $this->lang->line('contact_name'); ?> </th>
            <td><?php echo $donar->contact_name; ?></td>                
        </tr>
        
        <tr>
            <th><?php echo $this->lang->line('address'); ?> </th>
            <td><?php echo $donar->address; ?></td>  
            <th><?php echo $this->lang->line('email'); ?> </th>
            <td><?php echo $donar->email; ?></td>      
        </tr>
       
        <tr>
            <th><?php echo $this->lang->line('phone'); ?> </th>
            <td><?php echo $donar->phone; ?></td> 
            <th><?php echo $this->lang->line('amount'); ?> </th>
            <td><?php echo $donar->amount; ?></td>        
        </tr>      
        <tr>
            <th><?php echo $this->lang->line('note'); ?> </th>
            <td><?php echo $donar->note; ?></td> 
            <th><?php echo $this->lang->line('donation_start_date'); ?> </th>
            <td><?php echo $donar->donation_start_from; ?></td> 
        </tr>   
    </tbody>
</table>
