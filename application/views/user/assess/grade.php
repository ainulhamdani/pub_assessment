<?php
$this->load->view("header");
$this->load->view("user/nav");
?>
<div class="page-header">
    <h1><?=$assessment->name?></h1>
</div>
<hr>
<?php 
if($assessment->show_progress){
    $max = $this->AssessModel->getTasksNum($assessment->id,true);
    $now = $max - $this->AssessModel->getUnansweredTasksNum($assessment->id,$this->session->userdata('userid'));
    $width = intval(($now/$max)*100);
    ?>
<div>
    <div>Progress</div>
    <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: <?=$width?>%;" aria-valuenow="<?=$now?>" aria-valuemin="0" aria-valuemax="<?=$max?>"><?=$now?></div>
    </div>
</div>
<hr>
<?php } ?>
<div class="col-md-12">
    <?php if($task==null){ ?>
    <div class="row">
        <div class="col-md-3 col-sm-12 col-12" style="min-height: 200px">
            <div class="card">
                <div class="card-header text-white bg-danger">No Task</div>
                <div class="card-body">
                    There is no task yet. Please check back later<br><br>
                </div>
            </div>
        </div>
    </div>
    <?php }else{ ?>
    <div class="row justify-content-md-center">
      <div class="col-12">
         <center><img src="<?=base_url()."asset/uploads/".$task->img_id?>" class="img-fluid" alt="Responsive image"></center>
     </div>
 </div>
 <hr>
 <div class="row">
    <div class="col-12">
        <div>
            <?php $this->Question->showQuestion($assessment->id,$task->id,$question->version); ?>
        </div>
    </div>
</div>
<?php } ?>
</div>
<script src="<?=base_url()?>asset/js/grading.js"></script>
<?php
$this->load->view("footer");