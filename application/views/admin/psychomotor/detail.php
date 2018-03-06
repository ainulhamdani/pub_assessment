<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1>Psychomotor</h1>
        <h3>This test will assess people psychomotor coordination</h3>
    </div>
    <hr>
    <div class="row">
		<div class="col-md-12">
			<div class="row">
		    	<?php
		    	if(empty($assessments)){
		    		?>
		    	<div class="col-md-3 col-sm-6 col-12" style="min-height: 200px">
			    	<div class="card">
			    		<div class="card-header text-white bg-danger">No Assessment</div>
			            <div class="card-body">
			            	There is no assessment.
			            </div>
			         </div>
			     </div>
		    		<?php
		    	}else{
		    		foreach ($assessments as $assessment) {
		    			?>
		    	
		    	<div class="col-md-3 col-sm-6 col-12" style="min-height: 200px">
		    		<a href="<?=base_url()?>assessment/psychomotor/detail/<?=$assessment->id?>">
				    	<div class="card">
			    		<div class="card-header text-white bg-success"><?=$assessment->assessment_id?></div>
				            <div class="card-body">
				            	
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