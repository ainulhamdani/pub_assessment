<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1><?=$assessment->name?></h1>
        <h3><?=$assessment->details?></h3>
    </div>
    <div class="col-md-12">
    	<div class="row"><h4>Question</h4></div>
    	<div class="row">
    		<div class="well"><?=$question!=null?$question->text:""?></div>
    	</div>
    </div>
    <div class="col-md-12">
    	<?php
    	if(empty($tasks)){
    		?>
    	<div class="col-md-3 col-sm-6 col-xs-12" style="min-height: 200px">
	    	<div class="panel panel-danger">
	            <div class="panel-heading">
	            	<h3 class="panel-title">No Task</h3>
	            </div>
	            <div class="panel-body">
	            	There is no task. Please add one.<br><br>
	            	<a href="<?=base_url()."assessment/add_task/".$assessment->id?>" type="button" class="btn btn-sm btn-primary">Add</a>
	            </div>
	         </div>
	     </div>
    		<?php
    	}else{
    		?>
    	<div class="col-md-3 col-sm-6 col-xs-12" style="min-height: 200px">
	    	<div class="panel panel-warning">
	            <div class="panel-heading">
	            	<h3 class="panel-title">Add Task</h3>
	            </div>
	            <div class="panel-body">
	            	Add a new task<br><br>
	            	<a href="<?=base_url()."assessment/add_task/".$assessment->id?>" type="button" class="btn btn-sm btn-primary">Add</a>
	            </div>
	         </div>
	     </div>
    		<?php
    		foreach ($tasks as $task) {
    			?>
    	
    	<div class="col-md-3 col-sm-6 col-xs-12" style="min-height: 200px">
		    	<div class="panel panel-info">
		            <div class="panel-heading">
		            	<h3 class="panel-title"><?=$task->img_id?></h3>
		            </div>
		            <div class="panel-body">
		            	<img class="img-thumbnail" alt="<?=$task->img_id?>" style="width: 200px; height: 200px;" src="<?=base_url()?>asset/uploads/<?=$task->img_id?>.jpg">
		            </div>
		         </div>
	     </div>
    			<?php
    		}
    	}
    	?>
    </div>
<?php
$this->load->view("footer");