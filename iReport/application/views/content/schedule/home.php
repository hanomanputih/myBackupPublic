<div class="list-schedule">
    <div class="title">
        <div class="title-img">
            <img src="<?php echo base_url('assets/images/icons/png/calendar.png'); ?>">
        </div>
        <div class="title-text">All Schedules</div>
        <div class="clear"></div>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="span2">#</th>
          <th>Monday</th>
          <th>Tuesday</th>
          <th>Wednesday</th>
          <th>Thursday</th>
          <th>Friday</th>
          <th>Saturday</th>
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
                                ?>
              					<td>
        			                <ul class="list-member">
                                        <?php
                                        if($all_schedule)
                                        {
                                            foreach($all_schedule as $result)
                                            {
                                                $data_schedule = json_decode($result['schedule_value'], true);
                                                $check_data = @in_array($key.'-'.$num, $data_schedule);
                                                if($check_data)
                                                {
                                                    ?>
                                                    <a href="<?php echo site_url('schedule/member/'.$result['user_nicename']); ?>"><li <?php if($result['user_ID'] == $this->session->userdata('user_ID')){ echo 'class="alert-info"'; } ?>><?php echo $result['first_name'].' '.$result['last_name']; ?></li></a>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
        			                </ul>
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
    <div class="btn-option">
            <a class="print-button" id="print-my-schedule" data-url="<?php echo site_url('schedule/printout'); ?>" title="Print"><img class="button-action" src="<?php echo base_url('assets/images/icons/png/printer.png'); ?>"></a>
            <a class="export-button" id="excel-my-schedule" data-url="<?php echo site_url('schedule/export'); ?>" target="_blank" title="Export to excel"><img class="button-action" src="<?php echo base_url('assets/images/icons/png/excel.png'); ?>"></a>
        </div>
</div>