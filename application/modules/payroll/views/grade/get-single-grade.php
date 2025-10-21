<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="18%"><?php echo $this->lang->line('school_name'); ?></th>
            <td width="32%"><?php echo $grade->school_name; ?></td>       
            <th width="18%"><?php echo $this->lang->line('grade_name'); ?></th>
            <td width="32%"><?php echo $grade->grade_name; ?></td>
        </tr>
              
        <tr>
            <th><?php echo $this->lang->line('basic_salary'); ?> </th>
            <td><?php echo $grade->basic_salary; ?></td>       
            <th><?php echo $this->lang->line('house_rent'); ?> </th>
            <td><?php echo $grade->house_rent; ?></td>
        </tr>
        <tr>
                  
            <th><?php echo $this->lang->line('medical_allowance'); ?></th>
            <td><?php echo $grade->medical; ?></td>
            <th><?php echo $this->lang->line('total_allowance'); ?></th>
            <td><?php echo $grade->total_allowance; ?></td>
        </tr>        
        <tr>
                 
            <th><?php echo $this->lang->line('gross_salary'); ?></th>
            <td><?php echo $grade->gross_salary; ?></td>
            <th><?php echo $this->lang->line('net_salary'); ?></th>
            <td><?php echo $grade->net_salary; ?></td>   
        <tr>     
            <th><?php echo $this->lang->line('note'); ?></th>
            <td><?php echo $grade->note; ?></td>
        </tr>               
    </tbody>
</table>
