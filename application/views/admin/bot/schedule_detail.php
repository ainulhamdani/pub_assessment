<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1>Facebook Bot <small>Schedule: <?=$this->uri->segment(3)?></small></h1>
    </div>
    <hr>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>#</th>
							<th>Facebook Id</th>
							<th>FaceBook Name</th>
							<th>Time</th>
							<th>Bot Type</th>
							<th>Is Sent</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if(empty($schedules)){
							?>
							<tr>
								<td colspan="5"><center>--- no data ---</center></td>
							</tr>
							<?php
						}else{
							$no = 1;
							foreach ($schedules as $user) {
								?>

						<tr>
							<td><?=$no?></td>
							<td><?=$user->fb_id?></td>
							<td><?=$user->fb_name?></td>
							<td><?=$user->time?></td>
							<td><?=$user->bot_type?></td>
							<td><?=$user->is_sent==1?"Yes":"No"?></td>
							<td>
								<?php if(!$user->is_sent){ ?>
								<a type="button" class="btn btn-sm btn-warning">Edit</a>
								<a type="button" class="btn btn-sm btn-danger">Delete</a>
								<?php } ?>
							</td>
						</tr>

								<?php
							$no++;}
						}
						?>
						
					</tbody>
				</table>
		    </div>
		</div>
    </div>
<?php
$this->load->view("footer");