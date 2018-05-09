<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1>Facebook Bot <small>Schedule</small></h1>
    </div>
    <hr>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<?php 
				if(empty($dates)){

				?>
				<div class="col-md-3 col-sm-6 col-12" style="min-height: 200px">
				    	<div class="card">
			    		<div class="card-header text-white bg-danger">No Schedule</div>
				            <div class="card-body">

				            </div>
				         </div>
			     </div>
				<?php
				}else{
					foreach ($dates as $date) {
				?>
				<div class="col-md-3 col-sm-6 col-12" style="min-height: 200px">
		    		<a href="<?=base_url()?>bot/schedule/<?=$date->date?>">
				    	<div class="card">
			    		<div class="card-header text-white bg-success"><?=$date->date?></div>
				            <div class="card-body">

				            </div>
				         </div>
				     </a>
			     </div>
				<?php
				} }
				?>
		    </div>
		</div>
    </div>
<?php
$this->load->view("footer");