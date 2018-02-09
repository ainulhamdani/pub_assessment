<?php
$this->load->view("header");
?>
<div class="row justify-content-center">
	<div class="col-lg-3 col-md-6 col-sm-6">
		<form class="form-signin" method="post" action="<?=site_url('welcome/register_do')?>">
			<center><h2 class="form-signin-heading">Register</h2></center>
			<hr>
			<div class="form-group">
				<label for="fullname">Full Name</label>
				<input type="text" class="form-control" id="fullname" name="fullname" aria-describedby="fnHelp" placeholder="Enter Full Name" required>
			</div>
			<div class="form-group">
				<label for="email">Email or Telephone Number</label>
				<input type="text" class="form-control" id="email" name="email" aria-describedby="emHelp" placeholder="Email or Telephone Number" required>
			</div>
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="username" aria-describedby="usHelp" placeholder="Enter Username" required>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" aria-describedby="psHelp" placeholder="Enter Your Password" required>
			</div>
			<div class="form-group">
				<label for="confirmpass">Confirm Password</label>
				<input type="password" class="form-control" id="confirmpass" name="confirmpass" aria-describedby="cpsHelp" placeholder="Confirm Your Password" required>
				<small id="passwordHelp" class="form-text"></small>
			</div>
			<div class="row justify-content-center">
				<button id="submit" type="submit" class="btn btn-primary">Register</button>
			</div>
			<input id="source" type="hidden" name="source" value="web">
			<input id="imageurl" type="hidden" name="imageurl">
			<input id="token" type="hidden" name="token">
			<input id="id" type="hidden" name="id">
		</form>
	</div>
</div>
<script type="text/javascript">
	$( document ).ready(function() {
		var data = {
			source:sessionStorage.getItem("source"),
			id:sessionStorage.getItem("id"),
			fullname:sessionStorage.getItem("fullname"),
			imageurl:sessionStorage.getItem("imageurl"),
			email:sessionStorage.getItem("email"),
			token:sessionStorage.getItem("token")
		};
		sessionStorage.clear();
		for (var key in data){
			if(data[key]!=null){
				$("#"+key).val(data[key]);
				$("#"+key).prop("readonly",true);
			}
		}

		$('#password, #confirmpass').on('keyup', function () {
		  if ($('#password').val() == $('#confirmpass').val()) {
		    $('#passwordHelp').html('Matching').css('color', 'green');
		    $('#submit').prop("disabled",false);
		  } else {
		    $('#passwordHelp').html('Not Matching').css('color', 'red');
		    $('#submit').prop("disabled",true);
		  }
		});
	});
	function onLoad() {
      gapi.load('auth2', function() {
        gapi.auth2.init().then(function (authInstance) {
	        // now auth2 is fully initialized
	        authInstance.signOut().then(function () {
	        // console.log("signed out");
	      });
	    });
	      
      });
    }
</script>

<?php
$this->load->view("footer");