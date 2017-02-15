<div class="list-schedule">
    <div class="title">
        <div class="title-img">
            <img src="<?php echo base_url('assets/images/icons/png/calendar.png'); ?>">
        </div>
        <div class="title-text">My Schedule</div>
        <div class="clear"></div>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
            <th>#</th>
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
      					<th><?php echo $val; ?></th>
                        <?php 
                        if($day)
                        {
                            foreach($day as $key => $value)
                            {
                                $data_schedule = json_decode($schedule['schedule_value'], true);
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
    <div class="btn-action">
        <a href="<?php echo site_url('schedule/me/edit'); ?>" class="btn btn-primary">Edit</a>
    </div>
    <div class="btn-option">
        <button class="btn" id="excel-my-schedule"></button>
        <button class="btn" id="print-my-schedule"></button>
    </div>
</div>