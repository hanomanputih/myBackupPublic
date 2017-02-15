<div class="view-account content">
	<div class="title">
		<div class="title-img">
				<img src="<?php echo base_url('assets/images/icons/png/members.png'); ?>">
		</div>
		<div class="title-text capitalize"><?php echo @trim($member['first_name'].' '.$member['last_name']); ?></div>
		<div class="date"><?php echo date('d M', time()); ?></div>
		<div class="clear"></div>
	</div>
	<div class="row-fluid">
		<?php
		if($member)
		{
			?>
			<div class="span7">
				<form class="form-horizontal" action="" method="post">
					<input type="hidden" name="user-ID" value="<?php echo $member['user_ID']; ?>">
					<div class="control-group">
						<label class="control-label">Username</label>
						<div class="controls">
							<input type="text" name="username" id="username" placeholder="type here .." readonly value="<?php echo $member['user_nicename']; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">First Name</label>
						<div class="controls">
							<input type="text" name="first-name" id="first-name" class="capitalize" readonly placeholder="type here .." value="<?php echo $member['first_name']; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Last Name</label>
						<div class="controls">
							<input type="text" name="last-name" id="last-name" class="capitalize" readonly placeholder="type here .." value="<?php echo $member['last_name']; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Position</label>
						<div class="controls">
							<?php
							if($position)
							{
								$decode = json_decode($position['option_value'], true);
								?>
								<label class="radio checked">
						            <span class="icons"><span class="first-icon fui-radio-checked"></span>
						            	<span class="second-icon fui-radio-checked"></span>
						            </span>
						            <?php echo $decode[$member['position']]; ?>
						         </label>
								<?php
							}
							else
							{
								?>
								<div class="color-red">Position Unavailable</div>
								<?php
							}
							?>
						</div>
					</div>
					<?php
					if($this->session->userdata('user_ID') == $member['user_ID'])
					{
						?>
						<div class="control-group">
							<div class="controls">
								<a href="<?php echo site_url('account/'.$member['user_nicename']).'/edit' ?>" class="btn btn-primary">Edit</a>
							</div>
						</div>
						<?php
					}
					?>
				</form>
			</div>
			<?php
			if($member['user_ID'] != $this->session->userdata('user_ID'))
			{
				?>
				<div class="span5">
					<ul class="unstyled capitalize">
						<li><a href="<?php echo site_url('schedule/member/'.$member['user_nicename']); ?>"><?php echo $member['first_name']; ?>'s Schedules</a></li>
						<li><a href="<?php echo site_url('presence/member/'.$member['user_nicename']); ?>"><?php echo $member['first_name']; ?>'s Presences</a></li>
					</ul>
				</div>
				<?php
			}
			?>
			<?php
		}
		else
		{
			?>
			<div class="alert alert-error">
				<strong>Error!</strong> Member not found.
			</div>
			<?php
		}
		?>
	
	</div>
</div>
