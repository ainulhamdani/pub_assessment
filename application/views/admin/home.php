<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1>BEATs Project</h1>
    </div>
    <hr>
    <div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="text-justify">
					<div class="col-md-12 col-sm-12 col-12">
				    	<div class="card">
				            <div class="card-body">
				            	<p>BEATs yang menjadi judul dari Project ini adalah akronim dari Beliefs, Emotions, Actions, and Thoughts (Kepercayaan, Emosi, Aksi, dan Pemikiran). Kami berargumen bahwa konektivitas dari kepercayaan, emosi, aksi, dan pemikiran yang mengalir dalam masyarakat melalui interaksi dan komunikasi membentuk sebuah kolektivitas yang kapabilitasnya melebihi dari sekedar kemampuan seseorang atau rata-rata kemampuan anggota komunitas. Untuk itu, secara garis besar project ini bertujuan untuk mengidentifikasi dan mengembangkan kecerdasan kolektif dalam komunitas masyarakat, seperti dusun dan desa, untuk membangun kemampuan kolaborasi masyarakat dalam menghadapi persoalan-persoalan kontekstual di wilayah tempat tinggalnya. </p>

				            	<p>Hal ini dilakukan dengan melakukan beberapa kegiatan bersama dengan masyarakat untuk mengidentifikasi faktor-faktor yang membangun kecerdasan kolektif, seperti pemetaan pola aliran BEATs diantara anggota masyarakat, mengadakan tes sensitivitas sosial, melakukan kegiatan kreativitas, kegiatan pengambilan keputusan, kegiatan resolusi konflik, dan kegiatan koordinasi psikomotor. Identifikasi ini pun akan dilanjutkan dengan program implementasi pengembangan kolaborasi masyarakat dalam menghadapi dan memecahkan permasalahan kontekstual berdasarkan temuan yang ada.</p>
				            	<?php if(empty($this->session->userdata('id_user'))&&$this->session->userdata('user_valid') == FALSE) { ?>
				            	<a href="<?=base_url()?>welcome/register" class="btn btn-primary btn-block">REGISTER</a>
				            	<a href="<?=base_url()?>welcome/login" class="btn btn-primary btn-block">LOGIN</a>
				            	<?php } ?>
				            </div>
				         </div>
				     </div>
				</div>
			</div>
		</div>
	</div>
<?php
$this->load->view("footer");