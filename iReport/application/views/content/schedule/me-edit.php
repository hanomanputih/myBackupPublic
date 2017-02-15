<div class="list-schedule">
    <div class="title">
        <div class="title-img">
            <img src="<?php echo base_url('assets/images/icons/png/calendar.png'); ?>">
        </div>
        <div class="title-text">My Schedules</div>
        <div class="clear"></div>
    </div>
    <form action="<?php echo site_url('schedule/me/update'); ?>" method="post">
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
                                foreach ($day as $key => $value)
                                {
                                    $checked = '';
                                    $data_schedule = json_decode($schedule['schedule_value'], true);
                                    $check_data = @in_array($key.'-'.$num, $data_schedule);
                                    if($check_data)
                                    {
                                        $checked = 'checked';
                                    }
                                    ?>
                                    <td>
                                        <label class="checkbox <?php echo $checked; ?>">
                                            <span class="icons">
                                                <span class="first-icon fui-checkbox-unchecked"></span>
                                                <span class="second-icon fui-checkbox-checked"></span>
                                            </span>
                                            <input type="checkbox" value="<?php echo $key; ?>-<?php echo $num; ?>" name="schd[]" <?php echo $checked; ?> data-toggle="checkbox">
                                            My Schedule
                                         </label>
                                    </td>
                                    <?php
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
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>