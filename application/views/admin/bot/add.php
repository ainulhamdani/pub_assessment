<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1>Facebook Bot <small>Add Schedule</small></h1>
    </div>
    <hr>
    <div class="row">
	    <div class="col-md-12">
	    	<form action="<?=base_url()?>bot/add_one" method="POST">
	    		<div class="row form-group">
	    			<div class="col-md-3 col-sm-3 col-12">Facebook ID</div>
	    			<div class="col-md-9 col-sm-9 col-12"><input class="form-control" type="text" name="fb_id" required /></div>
	    		</div>
	    		<div class="row form-group">
	    			<div class="col-md-3 col-sm-3 col-12">Facebook ID</div>
	    			<div class="col-md-9 col-sm-9 col-12"><input class="form-control" type="text" name="fb_name" required /></div>
	    		</div>
	    		<div class="row form-group">
	    			<div class="col-md-3 col-sm-3 col-12">Time</div>
	    			<div class="col-md-9 col-sm-9 col-12"><input class="form-control" type="time" name="time" required /></div>
	    		</div>
	    		<div class="row form-group">
	    			<div class="col-md-3 col-sm-3 col-12">Date</div>
	    			<div class="col-md-9 col-sm-9 col-12"><input class="form-control" type="date" name="date" required /></div>
	    		</div>
	    		<div class="row form-group">
	    			<div class="col-md-3 col-sm-3 col-12">Facebook ID</div>
	    			<div class="col-md-9 col-sm-9 col-12">
	    				<select class="form-control" name="bot_type" >
	    					<option value="Bot 1">Bot 1</option>
	    					<option value="Bot 2">Bot 2</option>
	    					<option value="Bot 3">Bot 3</option>
	    				</select>
	    			</div>
	    		</div>
	    		<div class="row form-group">
		    		<div class="col-md-12 col-sm-12 col-12">
				      <button type="submit" class="btn btn-primary btn-block">Save</button>
				    </div>
				</div>
	    	</form>
	    </div>
	</div>
<?php
$this->load->view("footer");