<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1>Assessment List</h1>
    </div>
	<div class="col-md-12">
    	<?php
    	if(empty($assessments)){
    		?>
    	<div class="col-md-3 col-sm-12 col-xs-12" style="min-height: 200px">
	    	<div class="panel panel-danger">
	            <div class="panel-heading">
	            	<h3 class="panel-title">No Assessment</h3>
	            </div>
	            <div class="panel-body">
	            	There is no assessment. Please create one.<br><br>
	            	<button type="button" class="btn btn-sm btn-primary">Create</button>
	            </div>
	         </div>
	     </div>
    		<?php
    	}else{
    		?>
    	<div class="col-md-3 col-sm-12 col-xs-12" style="min-height: 200px">
	    	<div class="panel panel-warning">
	            <div class="panel-heading">
	            	<h3 class="panel-title">Create Assessment</h3>
	            </div>
	            <div class="panel-body">
	            	Create a new assessment<br><br>
	            	<a href="<?=base_url()?>assessment/create" type="button" class="btn btn-sm btn-primary">Create</a>
	            </div>
	         </div>
	     </div>
    		<?php
    		foreach ($assessments as $assess) {
    			?>
    	
    	<div class="col-md-3 col-sm-12 col-xs-12" style="min-height: 200px">
    		<a href="<?=base_url()?>assessment/detail/<?=$assess->id?>">
		    	<div class="panel panel-info">
		            <div class="panel-heading">
		            	<h3 class="panel-title"><?=$assess->name?></h3>
		            </div>
		            <div class="panel-body">
		            	<?=$assess->details?>
		            </div>
		         </div>
		     </a>
	     </div>
    			<?php
    		}
    	}
    	?>
    	
<?php
$this->load->view("footer");