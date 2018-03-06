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
		    	if(empty($tasks)){
		    		?>
		    	<div class="col-md-3 col-sm-6 col-12" style="min-height: 200px">
			    	<div class="card">
			    		<div class="card-header text-white bg-danger">No task</div>
			            <div class="card-body">
			            	There is no task.
			            </div>
			         </div>
			     </div>
		    		<?php
		    	}else{
		    		foreach ($tasks as $tasks) {
		    			?>
		    	
		    	<div class="col-md-3 col-sm-6 col-12" style="min-height: 200px">
		    		<a href="<?=base_url()?>assessment/psychomotor/detail/<?=$assessment->id?>/<?=$tasks->task_id?>">
				    	<div class="card">
			    		<div class="card-header text-white bg-success"><?=$tasks->task_id?></div>
				            <div class="card-body">
				            	<div>Start :</div>
				            	<div><?=$tasks->time_start?></div>
				            	<div>End : </div>
				            	<div><?=$tasks->time_end?></div>
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