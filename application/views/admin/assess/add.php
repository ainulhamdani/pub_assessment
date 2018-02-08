<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1><?=$assessment->name?></h1>
    </div>
    <hr>
    <?php if($assessment->type==2) { ?>
    <div class="row">
	    <div class="col-md-12">
	    	<form action="<?=base_url()?>assessment/savetask" method="POST">
	    		<input type="hidden" name="id" value="<?=$assessment->id?>" />
	    		<input type="hidden" name="type" value="2" />
	    		<div class="row form-group">
	    			<div class="col-md-3 col-sm-3 col-12">Kode</div>
	    			<div class="col-md-9 col-sm-9 col-12"><input class="form-control" type="text" name="code" /></div>
	    		</div>
	    		<div class="row form-group">
	    			<div class="col-md-3 col-sm-3 col-12">Task</div>
	    			<div class="col-md-9 col-sm-9 col-12">
	    				<textarea name="value" class="form-control"></textarea>
	    			</div>
	    		</div>
	    		<div class="row form-group">
		    		<div class="col-md-3-offset-3 col-sm-12 col-12">
				      <button type="submit" class="btn btn-primary">Save</button>
				    </div>
				</div>
	    	</form>
	    </div>
	</div>
    <?php }elseif ($assessment->type==1) { ?>
    <div class="row">
	    <div class="col-md-12">
	    	<form action="<?=base_url()?>assessment/savetask" method="POST" enctype="multipart/form-data">
	    		<input type="hidden" name="id" value="<?=$assessment->id?>" />
	    		<input type="hidden" name="type" value="1" />
	    		<div class="row form-group">
	    			<div class="col-md-3 col-sm-3 col-12">Kode</div>
	    			<div class="col-md-9 col-sm-9 col-12"><input class="form-control" type="text" name="code" /></div>
	    		</div>
	    		<div class="row form-group">
	    			<div class="col-md-3 col-sm-3 col-12">Task</div>
	    			<div class="col-md-9 col-sm-9 col-12">
	    				<input class="form-control-file" type="file" name="value" />
	    			</div>
	    		</div>
	    		<div class="row form-group">
		    		<div class="col-md-3-offset-3 col-sm-12 col-12">
				      <button type="submit" class="btn btn-primary">Save</button>
				    </div>
				</div>
	    	</form>
	    </div>
	</div>
    <?php } ?>
<?php
$this->load->view("footer");