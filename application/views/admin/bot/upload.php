<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1>Facebook Bot <small>Upload Schedule</small></h1>
    </div>
    <hr>
	<div class="row">
		<div class="col-md-12">
			<form action="<?=base_url()?>bot/save_schedule" method="POST" enctype="multipart/form-data">
	    		<div class="row form-group">
	    			<div class="col-md-3 col-sm-3 col-12">Template</div>
	    			<div class="col-md-9 col-sm-9 col-12">Please use this template : <a href="<?=base_url()?>bot/template">Download</a></div>
	    		</div>
	    		<div class="row form-group">
	    			<div class="col-md-3 col-sm-3 col-12">Upload</div>
	    			<div class="col-md-9 col-sm-9 col-12">
	    				<input class="form-control-file" type="file" name="userfile" multiple />
	    			</div>
	    		</div>
	    		<div class="row form-group">
		    		<div class="col-md-3-offset-3 col-sm-12 col-12">
				      <button type="submit" name="fileSubmit" class="btn btn-primary" value="UPLOAD">Save</button>
				    </div>
				</div>
	    	</form>
		</div>
    </div>
<?php
$this->load->view("footer");