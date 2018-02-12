<?php
$this->load->view("header");
$this->load->view("user/nav");
?>
	<div class="page-header">
        <h1><?=$assessment->name?></h1>
    </div>
    <hr>
    <div class="col-md-12">
    	<div class="row justify-content-md-center">
    		<div class="col-12">
	    		<center><img src="<?=base_url()."asset/uploads/".$task->img_id?>" class="img-fluid" alt="Responsive image"></center>
	    	</div>
    	</div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div>
                    <?php $this->Question->showQuestion($assessment->id,$task->id,$question->id); ?>
                </div>
            </div>
        </div>
    </div>
<?php
$this->load->view("footer");