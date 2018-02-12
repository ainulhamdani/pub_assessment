<?php
$this->load->view("header");
$this->load->view("user/nav");
?>
	<div class="page-header">
        <h1><?=$assessment->name?></h1>
        <h3><?=$assessment->details?></h3>
    </div>
    <hr>
    <div class="col-md-12">
    	<div class="row">
    		<div class="col-12">
	    		<a href="<?=base_url()?>assessment/grade/<?=$assessment->id?>"><button class="form-control bg-primary text-white">GRADE ASSESSMENT</button></a>
	    	</div>
    	</div>
    </div>
    <hr>
<?php
$this->load->view("footer");