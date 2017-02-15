<div class="list-schedule">
    <div class="title">
        <div class="title-img">
            <img src="<?php echo base_url('assets/images/icons/png/calendar.png'); ?>">
        </div>
        <div class="title-text capitalize"><?php echo @$first_name; ?>'s Schedules</div>
        <div class="clear"></div>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
            <th class="span2">#</th>
            <th class="align-center">Monday</th>
            <th class="align-center">Tuesday</th>
            <th class="align-center">Wednesday</th>
            <th class="align-center">Thursday</th>
            <th class="align-center">Friday</th>
            <th class="align-center">Saturday</th>
        </tr>
      </thead>
      <tbody>
      	<?php
      		if(@$time)
      		{
      			$decode = json_decode($time['option_value'], true);
      			foreach($decode as $num => $val)
      			{
                    $day = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
      				?>
      				<tr>
      					<th class="align-center"><?php echo $val; ?></th>
                        <?php 
                        if($day)
                        {
                            foreach($day as $key => $value)
                            {
                                $data_schedule = json_decode($member_schedule['schedule_value'], true);
                                $check_data = @in_array($key.'-'.$num, $data_schedule);
                                if($check_data)
                                {
                                    ?>
                                    <td class="alert alert-info capitalize align-center">my schedule</td>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <td></td>
                                    <?php
                                }
                            }
                        }
                        ?>
      				</tr>
      				<?php
      			}
      		}
		?>
      </tbody>
    </table>
    <?php 
    if($this->session->userdata('position') < 3)
    {
        ?>
            <div class="btn-action">
                <a href="<?php echo site_url('schedule/member/'.$member.'/edit'); ?>" class="btn btn-primary">Edit</a>
            </div>
        <?php
    }
    ?>
    <div class="btn-option">
            <a class="print-button" id="print-my-schedule" data-url="<?php echo site_url('schedule/member/'.$member.'/printout'); ?>" title="Print"><img class="button-action" src="<?php echo base_url('assets/images/icons/png/printer.png'); ?>"></a>
            <a class="export-button" id="excel-my-schedule" data-url="<?php echo site_url('schedule/member/'.$member.'/export'); ?>" target="_blank" title="Export to excel"><img class="button-action" src="<?php echo base_url('assets/images/icons/png/excel.png'); ?>"></a>
        </div>
</div>