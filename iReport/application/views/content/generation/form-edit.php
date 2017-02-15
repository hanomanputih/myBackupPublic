<div class="edit-generations content">
	<div class="title">
		<div class="title-img">
			<img src="<?php echo base_url('assets/images/icons/png/members.png'); ?>">
		</div>
		<div class="title-text">Generations <?php echo $this->uri->segment(3); ?></div>
		<div class="date"><?php echo date('d M', time()); ?></div>
		<div class="clear"></div>
	</div>
	<div class="content-generation">
		<?php
		if($generations)
		{
			?>
			<form action="<?php echo site_url('generation/update'); ?>" method="post">
				<div class="row-fluid">
					<input type="hidden" name="generation" value="<?php echo $this->uri->segment(3); ?>">
					<div class="span4">
						<ul class="unstyled">
				<?php
					$generations = json_decode($generations['option_value'], true);

					$no = 1;
					foreach($members as $value)
					{
						$generation_idx = array_search($this->uri->segment(3),$generations);
						$active = '';
						if($generation_idx == @$value['generation'])
						{
							$active = 'checked';
						}
						?>
						<li>
							<label class="checkbox <?php echo $active; ?>" for="checkbox1">
	            				<span class="icons"><span class="first-icon fui-checkbox-unchecked"></span><span class="second-icon fui-checkbox-checked"></span></span><input type="checkbox" name="member[]" <?php echo $active; ?> value="<?php echo $value['user_ID']; ?>" data-toggle="checkbox">
	            				<?php echo $value['first_name'].' ('. $value['user_nicename'] .')'; ?>
	          				</label>
	      				</li>	
						<?php
						if($no % 15 == 0)
						{
							?>
									</ul>
								</div>
							<div class="span4">
								<ul class="unstyled">
							<?php
						}
						$no++;
					}
				?>	
						</ul>
					</div>
				</div>
				<button class="btn btn-primary" type="submit">Update</button>
				<a href="<?php echo site_url('generation'); ?>" class="btn" type="submit">Cancel</a>
				<div class="note">*Checklist Member</div>
			</form>
			<?php
		}
		else
		{
			?>
			<div class="alert alert-error">No list generation</div>
			<?php
		}
		?>
	</div>
</div>