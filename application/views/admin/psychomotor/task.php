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
				<?php $this->PsychoModel->showTask($assessid,$taskid); ?>
		    </div>
		</div>
    </div>
<?php
$this->load->view("footer");