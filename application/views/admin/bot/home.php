<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1>Facebook Bot</h1>
    </div>
    <hr>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
		    	<div class="col-md-3 col-sm-6 col-12" style="min-height: 200px">
		    		<a href="<?=base_url()?>bot/add">
				    	<div class="card">
			    		<div class="card-header text-white bg-success">Add Schedule</div>
				            <div class="card-body">

				            </div>
				         </div>
				     </a>
			     </div>
		    	<div class="col-md-3 col-sm-6 col-12" style="min-height: 200px">
		    		<a href="<?=base_url()?>bot/upload">
				    	<div class="card">
			    		<div class="card-header text-white bg-success">Upload Schedule</div>
				            <div class="card-body">

				            </div>
				         </div>
				     </a>
			     </div>
			     <div class="col-md-3 col-sm-6 col-12" style="min-height: 200px">
		    		<a href="<?=base_url()?>bot/schedule">
				    	<div class="card">
			    		<div class="card-header text-white bg-success">See Schedule</div>
				            <div class="card-body">

				            </div>
				         </div>
				     </a>
			     </div>
		    </div>
		</div>
    </div>
<?php
$this->load->view("footer");