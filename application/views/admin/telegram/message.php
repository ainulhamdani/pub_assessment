<?php
$this->load->view("header");
$this->load->view("admin/nav");
?>
	<div class="page-header">
        <h1>Telegram Bot <small>Message</small></h1>
    </div>
    <hr>
	<div class="row">
		<div class="container-fluid">
			<div class="row">
				<div id="user_list" class="col-md-3 pre-scrollable">
					<div class="list-group">
					<?php foreach ($users as $key => $user) { ?>
						<a id="u<?=$user->user_id?>" href="<?=base_url()?>telegram/message/u/<?=$user->user_id?>" class="list-group-item <?=$user->user_id==$active_user->user_id?"active":""?>">
							<h6 class="list-group-item-heading"><?=$user->first_name." ".$user->last_name?></h6>
						</a>
					<?php } ?>
					</div>
				</div>
				<div class="col-md-9">
					<div class="row h-75">
						<div class="col-md-12">
							<div id="msg_list" class="card h-100 pre-scrollable">
								<div class="card-body">
								<?php $i=0;$max=count($messages);foreach ($messages as $key => $msg) { ?>
									<div <?=++$i==$max?'id="last_msg"':""?> class="row">
										<div class="col">
											<div class="card <?=$msg->from_user==999999999?"float-right bg-primary text-white":""?>" style="width: 18rem;">
												<div class="card-body">
													<?=$msg->texts?>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<div class="row h-25">
						<div class="col-md-12">
							<form action="<?=base_url()?>telegram/message_send" method="POST">
							<div class="row">
									<div class="col-md-10"><textarea name="message" class="form-control" id="text" rows="1"></textarea></div>
									<div class="col-md-2 align-self-end"><button class="btn btn-info">Send</button></div>
									<input name="url" type="hidden" value="<?=uri_string()?>" />
									<input name="user_id" type="hidden" value="<?=$active_user->user_id?>" />
							</div>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
    </div>
	<script>
		var target = document.getElementById("last_msg");
		var parent = document.getElementById("msg_list");
		parent.scrollTop = target.offsetTop;
		var target2 = document.getElementById("u<?=$active_user->user_id?>");
		var parent2 = document.getElementById("user_list");
		parent2.scrollTop = target2.offsetTop;
	</script>
<?php
$this->load->view("footer");
