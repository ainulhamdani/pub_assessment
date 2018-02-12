<?php
$this->load->view("header");
$this->load->view("user/nav");
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
			            	There is no assessment. Please check back later<br><br>
			            </div>
			         </div>
			     </div>
		    		<?php
		    	}else{
		    		foreach ($assessments as $assess) {
		    			?>
		    	
		    	<div class="col-md-3 col-sm-12 col-12" style="min-height: 200px">
		    		<a href="<?=base_url()?>assessment/info/<?=$assess->id?>">
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