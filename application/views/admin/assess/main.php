<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1>Assessment List</h1>
    </div>
    <hr>
    <div class="row">
		<div class="col-md-12">
			<div class="row">
		    	<?php
		    	if(empty($assessments)){
		    		?>
		    	<div class="col-md-3 col-sm-12 col-12" style="min-height: 200px">
			    	<div class="card">
			    		<div class="card-header text-white bg-danger">No Assessment</div>
			            <div class="card-body">
			            	There is no assessment. Please create one.<br><br>
			            	<button type="button" class="btn btn-sm btn-primary">Create</button>
			            </div>
			         </div>
			     </div>
		    		<?php
		    	}else{
		    		?>
		    	<div class="col-md-3 col-sm-12 col-12" style="min-height: 200px">
			    	<div class="card">
			    		<div class="card-header text-white bg-info">Create Assessment</div>
			            <div class="card-body">
			            	Create a new assessment<br><br>
			            	<a href="<?=base_url()?>assessment/create" type="button" class="btn btn-sm btn-primary">Create</a>
			            </div>
			         </div>
			     </div>
		    		<?php
		    		foreach ($assessments as $assess) {
		    			?>
		    	
		    	<div class="col-md-3 col-sm-12 col-12" style="min-height: 200px">
		    		<a href="<?=base_url()?>assessment/detail/<?=$assess->id?>">
				    	<div class="card">
			    			<div class="card-header text-white <?=$assess->is_active?"bg-success":"bg-secondary"?>"><?=$assess->name?></div>
				            <div class="card-body">
				            	<?=$assess->details?>
				            </div>
				         </div>
				     </a>
			     </div>
		    			<?php
		    		}
		    	}
		    	?>
		    </div>
	    </div>
	</div>
    	
<?php
$this->load->view("footer");