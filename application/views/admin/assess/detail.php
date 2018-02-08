<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1><?=$assessment->name?></h1>
        <h3><?=$assessment->details?></h3>
    </div>
    <hr>
    <div class="col-md-12">
    	<div class="row"><h4>Question</h4></div>
    	<div class="row">
    		<div class="col-12">
	    		<div class="form-group">
	    			<textarea class="form-control" rows="6" readonly><?=$question!=null?$question->text:""?></textarea>
	    		</div>
	    	</div>
    	</div>
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
			    		<div class="card-header text-white bg-danger">No Task</div>
			            <div class="card-body">
			            	There is no task. Please add one.<br><br>
			            	<a href="<?=base_url()."assessment/add_task/".$assessment->id?>" type="button" class="btn btn-sm btn-primary">Add</a>
			            </div>
			         </div>
			     </div>
		    		<?php
		    	}else{
		    		?>
		    	<div class="col-md-3 col-sm-6 col-12" style="min-height: 200px">
			    	<div class="card">
			    		<div class="card-header text-white bg-warning">Add Task</div>
			            <div class="card-body">
			            	Add a new task<br><br>
			            	<a href="<?=base_url()."assessment/add_task/".$assessment->id?>" type="button" class="btn btn-sm btn-primary">Add</a>
			            </div>
			         </div>
			     </div>
		    		<?php
		    		foreach ($tasks as $task) {
		    			?>
		    	
		    	<div class="col-md-3 col-sm-6 col-12" style="min-height: 200px">
				    	<div class="card">
			    		<div class="card-header text-white bg-info"><?=$task->img_id?></div>
				            <div class="card-body">
				            	<img class="img-thumbnail" alt="<?=$task->img_id?>" style="width: 200px; height: 200px;" src="<?=base_url()?>asset/uploads/<?=$task->img_id?>.jpg">
				            </div>
				         </div>
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