<div class="list-member-presence content">
	<input type="hidden" id="uri" value="<?php echo $this->uri->segment(2); ?>">
	<div class="title">
		<div class="title-img">
			<img src="<?php echo base_url('assets/images/icons/png/clipboard.png'); ?>">
		</div>
		<div class="title-text capitalize"><?php echo $member['first_name']; ?>'s Presences</div>
		<div class="date"><?php echo date('d M', time()); ?></div>
		<div class="clear"></div>
	</div>
	<table class="table table-striped capitalize">
		  <thead>
			<tr>
			  <th>#</th>
			  <th>Date</th>
			  <th>Time</th>
			  <th>Presence</th>
			  <th>Module/Concept</th>
			  <th class="align-center">Student's Presence</th>
			  <th>Kalab's Signature</th>
			</tr>
		  </thead>
		  <tbody>
		  	<?php
		  	if($presence)
		  	{
		  		$no = 1;
		  		foreach ($presence as $value)
		  		{
		  			?>
		  			<tr>
		  				<td><?php echo $no; ?></td>
		  				<td><?php echo date('d-M-Y', human_to_unix($value['presence_date'])); ?></td>
		  				<td><?php echo substr($value['presence_start_time'],0,5).'-'.substr($value['presence_end_time'],0,5); ?></td>
		  				<td>
		  					<?php
		  					if($member)
		  					{
		  						$data_member = array();
		  						foreach($member_active as $record)
		  						{
		  							$data_member[$record['user_ID']] = $record['first_name'];
		  						}
		  						
		  						echo $data_member[$value['presence_my_signature']]."'s presence";
		  					}
		  					?>
		  				</td>
		  				<td>
		  					<?php 
		  					if($module)
		  					{
		  						$decode = json_decode($module['option_value'], true);
		  						echo $decode[$value['presence_module']];
		  					}
		  					?>
		  				</td>
		  				<td class="align-center"><?php echo $value['presence_students_presence']; ?></td>
		  				<td><?php if($value['presence_kalab_signature'] == 'on'){ echo 'checked'; }else{ echo '-'; }?></td>

		  			</tr>
		  			<?php
		  			$no++;
		  		}
		  	}
		  	else
		  	{
		  		?>
		  		<tr>
		  			<td colspan="7" class="color-red">No presence found.</td>
		  		</tr>
		  		<?php
		  	}
		  	?>
		  </tbody>
		</table> 
		<div class="btn-option">
	        <a class="print-button" id="print-my-presence" data-url="<?php echo site_url('presence/member/'.$member['user_nicename'].'/printout'); ?>" title="Print"><img class="button-action" src="<?php echo base_url('assets/images/icons/png/printer.png'); ?>"></a>
	        <a class="export-button" id="excel-my-presence" data-url="<?php echo site_url('presence/member/'.$member['user_nicename'].'/export'); ?>" target="_blank" title="Export to excel"><img class="button-action" src="<?php echo base_url('assets/images/icons/png/excel.png'); ?>"></a>
	    </div>
</div>

