<div class="list-generations content">
	<div class="title">
		<div class="title-img">
			<img src="<?php echo base_url('assets/images/icons/png/members.png'); ?>">
		</div>
		<div class="title-text">Generations</div>
		<div class="date"><?php echo date('d M', time()); ?></div>
		<div class="clear"></div>
	</div>
	<div class="content-generation">
		<?php
		if($generations)
		{
			?>
			<div class="row-fluid">
			<?php
				$decode = json_decode($generations['option_value']);
				foreach($decode as $num => $val)
				{
		 			if($num == $active_generation['option_value'])
		 			{
					?>
					<div class="span12">
				 		<div class="title-generation">
				 			<?php
				 				?>
						 		<div class="left-title"><a href="<?php echo site_url('generation/edit/'.$val); ?>"><strong>Update</strong></a></div>
				 				<?php
				 			?>
				 			<div class="right-title"><?php echo $val; ?></div>
				 			<div class="clear"></div>
				 		</div>
					 		<?php
					 		if($active_users)
					 		{
					 			$no = 1;
					 			?>
						 		<div class="span3">
					 				<ul class="unstyled">
					 			<?php
					 			foreach($active_users as $record)
					 			{
					 				?>
					 				<li><a href="<?php echo site_url('account/'.$record['user_nicename']); ?>"><span class="capitalize"><?php echo trim($record['first_name'].' '.$record['last_name']); ?></span> <span><?php echo '('.$record['user_nicename'].')'; ?></span></a></li>
					 				<?php
					 				if($no % 5 == 0)
					 				{
					 					?>
					 						</ul>
						 				</div>
						 				<div class="span3">
						 					<ul class="unstyled">
					 					<?php
					 				}
					 				$no++;
					 			}
					 			?>
					 				</ul>
				 				</div>
					 			<?php
					 		}
					 		?>
				 	</div>
					<?php
		 			}
				}
			?>	
			</div>
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