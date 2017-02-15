<div class="list-presence content">
	<input type="hidden" id="uri" value="<?php echo $this->uri->segment(2); ?>">
	<div class="title">
		<div class="title-img">
			<img src="<?php echo base_url('assets/images/icons/png/clipboard.png'); ?>">
		</div>
		<div class="title-text">My Presences</div>
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
			  <th class="align-center">Actions</th>
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
		  						foreach($member as $record)
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
		  				<td class="align-center">
							<a href="#delete" class="delete" id="<?php echo $value['presence_ID']; ?>" title="Delete"><span class="fui-cross color-red"></span></a>
						</td>

		  			</tr>
		  			<?php
		  			$no++;
		  		}
		  	}
		  	else
		  	{
		  		?>
		  		<tr>
		  			<td colspan="8" class="color-red">No presence found.</td>
		  		</tr>
		  		<?php
		  	}
		  	?>
		  </tbody>
		</table>
		<div class="btn-action">
			<button href="#fakelink" class="btn btn-danger btn-confirm" id="<?php echo $this->session->userdata('user_ID')?>">Delete All</button>
		</div>   
		<div class="btn-option">
	        <a class="print-button" id="print-my-presence" data-url="<?php echo site_url('presence/printout'); ?>" title="Print"><img class="button-action" src="<?php echo base_url('assets/images/icons/png/printer.png'); ?>"></a>
	        <a class="export-button" id="excel-my-presence" data-url="<?php echo site_url('presence/export'); ?>" target="_blank" title="Export to excel"><img class="button-action" src="<?php echo base_url('assets/images/icons/png/excel.png'); ?>"></a>
	    </div>
</div>


<!-- modal confirmation delete all presence -->
<div id="modal-confirmation" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4>Confirmation</h4>
	</div>
	<div class="modal-body align-center">
		<p>Are you sure want to delete all presences?</p>
		<form action="" method="post">
			<input type="hidden" name="ID" id="ID">
			<button type="submit" class="btn btn-danger" id="true">Yes</button>
			<a class="btn" data-dismiss="modal" aria-hidden="true">No</a>
		</form>
	</div>
</div>

<!-- modal confirmation delete presence -->
<div id="confirm" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4>Confirmation</h4>
	</div>
	<div class="modal-body align-center">
		<p>Are you sure want to delete this presence?</p>
		<form action="" method="post">
	  		<input type="hidden" name="ID" id="ID">
	    	<button type="submit" class="btn btn-danger">Yes</button>
	    	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">No</a>
	    </form>
	</div>
</div>

<!-- modal presence -->
<div id="modal-presence" class="modal hide fade">
  <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<div class="title">
		<div class="title-img">
			<img src="<?php echo base_url('assets/images/icons/png/clipboard.png'); ?>">
		</div>
		<div class="title-text">Add Presence</div>
		<div class="clear"></div>
	</div>
  </div>
  <div class="modal-body capitalize">
	<div class="form-presence">
		<form class="form-horizontal" method="post">
			<div class="control-group">
				<label class="control-label">Date</label>
				<div class="controls">
					<input type="date" id="date" name="date" required="">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Start Time</label>
				<div class="controls">
					<input type="time" id="start-time" name="start-time" required="">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">End Time</label>
				<div class="controls">
					<input type="time" id="end-time" name="end-time" required="">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Presence</label>
				<div class="controls">
					<select name="my-presence" id="my-presence" class="dropdown" required="">
						<?php
						if($member)
						{
							?>
							<option value="<?php echo $this->session->userdata('user_ID'); ?>">My Presence</option>
							<?php
							foreach($member as $record)
							{
								if($record['user_ID'] == $this->session->userdata('user_ID'))
								{
									continue;
								}
								?>
								<option value="<?php echo $record['user_ID']; ?>"><?php echo $record['first_name']; ?>'s Presence</option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Module/Concept</label>
				<div class="controls">
					<select name="concept" id="concept" class="dropdown" required="">
						<?php
						if($module)
						{
							$decode = json_decode($module['option_value'], true);
							foreach($decode as $num => $value)
							{
								?>
								<option value="<?php echo $num; ?>"><?php echo $value; ?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Student's Presence</label>
				<div class="controls">
					<select name="students-presence" id="students-presence" class="dropdown" required="">
						<?php
						for($i = 36; $i >0; $i--)
						{
							?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php
						}
						?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Kalab's Signature</label>
				<div class="controls">
					<label class="checkbox">
						<span class="icons">
							<span class="first-icon fui-checkbox-unchecked"></span>
							<span class="second-icon fui-checkbox-checked"></span>
						</span>
						<input type="checkbox" name="kalab-signature" id="kalab-signature" data-toggle="checkbox">
						Checked
					</label>
				</div>
			</div>
			<div class="control-group">
			  <div class="controls">
				<button type="submit" class="btn btn-primary">Submit</button>
				<a class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
			  </div>
			</div>
		</form>
	</div>
  </div>
</div>

<!-- modal information -->
<div id="info" class="modal hide fade">
	<div class="modal-body align-center">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<p>text here ...</p>
	</div>
</div>


<script type="text/javascript">
$(function(){
		$('.form-presence form').submit(function(){
			var dataSend = {
				'ID'				: '<?php echo $this->session->userdata("user_ID"); ?>', 
				'date'				: $('#date').val(),
				'start_time' 		: $('#start-time').val(),
				'end_time'			: $('#end-time').val(),
				'my_presence'		: $('select#my-presence option:selected').val(),
				'kalab_signature'	: $('input[name=kalab-signature]:checkbox:checked').val(),
				'module'			: $('select#concept option:selected').val(),
				'students_presence'	: $('select#students-presence option:selected').val()
			}
			$.ajax('<?php echo base_url("index.php/presence/ajax_insert_presence"); ?>',{
				data: dataSend,
				dataType: 'JSON',
				type: 'POST',
				beforeSend: function(){
					$('#info .modal-body p').html('');
				},
				success: function(e){
					if(e.stats)
					{
						window.location.href = BASE_URL + index_p +'/presence';
					}
					$('#info .modal-body p').html('<div class="'+e.cls+'">'+e.msg+'</div>');
				},
				error: function(){
					$('#info .modal-body p').html("<div class='color-red'>Sorry, there's problem with server. Please try again later");
				}
			})
			$('#info').modal('show');
			return false;
		});

		if($('#uri').val() == 'create')
		{
			$('#modal-presence').modal('show');
		}
	});
</script>
