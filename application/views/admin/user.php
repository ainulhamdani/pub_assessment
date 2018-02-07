<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1>User List</h1>
    </div>
	<div class="col-md-12">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>#</th>
					<th>Full Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if(empty($users)){
					?>
					<tr>
						<td colspan="5"><center>--- no data ---</center></td>
					</tr>
					<?php
				}else{
					$no = 1;
					foreach ($users as $user) {
						?>

				<tr>
					<td><?=$no?></td>
					<td><?=$user->firstname?> <?=$user->lastname?></td>
					<td><?=$user->username?></td>
					<td><?=$user->email?></td>
					<td>
						<button type="button" class="btn btn-sm btn-warning">Edit</button>
						<button type="button" class="btn btn-sm btn-danger">Delete</button>
					</td>
				</tr>

						<?php
					}
				}
				?>
				
			</tbody>
		</table>
	</div>
<?php
$this->load->view("footer");