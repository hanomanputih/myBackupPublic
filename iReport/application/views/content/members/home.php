<div class="list-members content">
	<div class="title">
		<div class="title-img">
				<img src="<?php echo base_url('assets/images/icons/png/members.png'); ?>">
		</div>
		<div class="title-text">Members</div>
		<div class="date"><?php echo date('d M', time()); ?></div>
		<div class="clear"></div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>NIM</th>
				<th>Name</th>
				<th>Position</th>
				<th>Password</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			 if($members)
			{
				$no = 1;
				foreach($members as $result)
				{
					$pos_decode = json_decode($position['option_value'], true);
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><a href="<?php echo site_url('account/'.$result['user_nicename']); ?>"><?php echo $result['user_nicename']; ?></a></td>
					<td class="capitalize"><?php echo $result['first_name'].' '.$result['last_name']; ?></td>
					<td class="capitalize"><?php if(!empty($result['position'])){ echo $pos_decode[$result['position']]; } ?></td>
					<td>
						<?php
						if($result['position'] != 0)
						{
							?>
							<a href="#reset" class="reset-password" id="<?php echo $result['user_ID']; ?>"><span class="fui-radio-unchecked"></span>
							<?php
						}
						?>
						</td>
					<td>
						<?php
						if($result['position'] != 0)
						{
							?>
							<a href="<?php echo site_url('members/edit/'.$result['user_ID']); ?>" title="Edit"><span class="fui-new"></span></a>
							<?php
						}
						?>
						<?php
						if($result['user_ID'] != $this->session->userdata('user_ID'))
						{
							if($result['position'] != 0)
							{
							?>
							<a href="#delete" class="delete" id="<?php echo $result['user_ID']; ?>" title="Delete"><span class="fui-cross"></span></a>
							<?php
							}
						}
						?>
					</td>
				</tr>
				<?php
				$no++;
				}
			}
			?>
		</tbody>
	</table>
	<div class="button-action">
		<a href="<?php echo site_url('members/create')?>" class="btn btn-primary btn-member">Add New</a>
	</div>   
</div>

<div id="confirm" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4>Confirmation</h4>
  </div>
  <div class="modal-body align-center">
    <p>quetion here ..</p>
  	<form action="" method="post">
  		<input type="hidden" name="ID" id="ID">
    	<button type="submit" class="btn btn-danger">Yes</button>
    	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">No</a>
    </form>
  </div>
</div>



