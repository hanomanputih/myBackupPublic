<div class="report content">
	<div class="title">
		<div class="title-img">
			<img src="<?php echo base_url('assets/images/icons/png/book.png'); ?>">
		</div>
		<div class="title-text">My Report</div>
		<div class="date"><?php echo Date('d M', time()); ?></div>
		<div class="clear"></div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<h6>My Presences</h6>
			<div class="form-horizontal capitalize">
				<?php
				if($member)
				{
					foreach($member as $record)
					{
						switch($record['user_ID'])
						{
							case $this->session->userdata('user_ID'):
								$presence_name = '<span class="color-green">My presences</span>';
								break;
							default:
								$presence_name = $record['first_name']."'s presences";
								break;
						}
						?>
						<div class="control-group">
				            <label class="control-label"><?php echo $presence_name; ?></label>
				            <div class="controls">
				              <label class="control-label align-left"><?php echo @$count[$record['user_nicename']]; ?> <span class="lowercase">time(s)</span></label>
				            </div>
				        </div>
						<?php
					}
				}
				?>
				<hr/>
				<div class="control-group">
		            <label class="control-label"><strong>Total Presences</strong></label>
		            <div class="controls">
		              <label class="control-label align-left"><?php echo @$count_my_presence; ?> <span class="lowercase">time(s)</span></label>
		            </div>
		        </div>
			</div>
		</div>
		<div class="span4">
			<h6>My Schedules</h6>
			<div class="form-horizontal capitalize">
			<?php
				$days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
				foreach($days as $key => $day)
				{
					?>
					<div class="control-group">
						<div class="control-label"><?php echo $day; ?></div>
						<div class="controls">
							<label class="control-label align-left"><?php echo @$count_schedule[$key]; ?> <span class="lowercase">time(s)</span></label>
						</div>
					</div>
					<?php
				}
			?>
			</div>
			<hr/>
			<div class="form-horizontal capitalize">
				<div class="control-group">
					<div class="control-label"><strong>total schedules</strong></div>
					<div class="controls">
						<label class="control-label align-left"><?php echo @$count_all_schedule; ?> <span class="lowercase">time(s)</span></label>
					</div>
				</div>
			</div>
		</div>
		<div class="span4">
			<h6>Member's Report</h6>
			<ul class="unstyled">
				<?php
				if($member)
				{
					foreach($member as $record)
					{
						?>
						<li class="capitalize"><a href="<?php echo site_url('report/'.$record['user_nicename']); ?>"><?php echo $record['first_name']; ?>'s Report</a></li>
						<?php
					}
				}
				?>
			</ul>
		</div>
	</div>
	<hr/>
	<div class="row-fluid">
		<div class="span12">
			<div class="summary">
				<p>
					According from your data presences and schedules, your total presences should be <strong><?php echo @($count_all_schedule * $count_module); ?> time(s)</strong>.
					<?php
					if(@($count_all_schedule * $count_module) == @$count_my_presence)
					{
						?>
						Welldone!, your data is <strong class="color-green">correct</strong>. Thanks ..
						<?php
					}
					else
					{
						?>
						In fact, your presences are <strong class="color-red"><?php echo @$count_my_presence; ?> time(s)</strong>. Please re-check your presences and schedules. Thanks ..
						<?php
					}
					?>
				</p>
			</div>
		</div>
	</div>
	
</div>