<div class="create-member content">
	<div class="title">
		<div class="title-img">
				<img src="<?php echo base_url('assets/images/icons/png/members.png'); ?>">
		</div>
		<div class="title-text">Create Member</div>
		<div class="date"><?php echo date('d M', time()); ?></div>
		<div class="clear"></div>
	</div>
	<div class="row">
		<div class="span7">
			<form class="form-horizontal" action="<?php echo site_url('members/proccess')?>" method="post">
				<div class="control-group">
					<label class="control-label">Username</label>
					<div class="controls">
						<input type="text" name="username" id="username" placeholder="type here .." value="<?php echo set_value('username'); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
						<input type="password" name="password" id="password" placeholder="type here .." >
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Confirm Password</label>
					<div class="controls">
						<input type="password" name="confirm" id="confirm" placeholder="type here .." >
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">First Name</label>
					<div class="controls">
						<input type="text" name="first-name" id="first-name" placeholder="type here .." value="<?php echo set_value('first-name'); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Last Name</label>
					<div class="controls">
						<input type="text" name="last-name" id="last-name" placeholder="type here .." value="<?php echo set_value('last-name'); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Position</label>
					<div class="controls">
						<?php
						if($position)
						{
							$decode = json_decode($position['option_value'], true);
							foreach($decode as $num => $val)
							{
								if($num != 0)
								{
								?>
								<label class="radio">
						            <span class="icons"><span class="first-icon fui-radio-unchecked"></span>
						            	<span class="second-icon fui-radio-checked"></span>
						            </span>
						            <input type="radio" name="position" value="<?php echo $num; ?>" data-toggle="radio" >
						            <?php echo $val; ?>
						         </label>
								<?php
								}
							}
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
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-primary">Submit</button>
						<a href="<?php echo site_url('members'); ?>" class="btn">Cancel</a>
					</div>
				</div>
			</form>
		</div>
		<div class="span5">
			<div class="<?php echo $class; ?>"><?php echo $msg; ?></div>
		</div>
	</div>
</div>
