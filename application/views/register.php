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
				<small id="emailHelp" class="form-text"></small>
			</div>
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="username" aria-describedby="usHelp" placeholder="Enter Username" required>
				<small id="usernameHelp" class="form-text"></small>
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

		var emailTypingTimer;
		var usernameTypingTimer;
		var doneTypingInterval = 1500;

		$('#email').on('keyup keydown change',function(){
			$('#emailHelp').html('');
			$('#email').removeClass("bg-success bg-danger text-white");
		    clearTimeout(emailTypingTimer);
		    if ($('#email').val()) {
		    	emailTypingTimer = setTimeout(emailDoneTyping.bind(null, $('#email').val()), doneTypingInterval);
		    }
		});
		$('#username').on('keyup keydown change',function(){
			$('#usernameHelp').html('');
			$('#username').removeClass("bg-success bg-danger text-white");
		    clearTimeout(usernameTypingTimer);
		    if ($('#username').val()) {
		    	usernameTypingTimer = setTimeout(usernameDoneTyping.bind(null, $('#username').val()), doneTypingInterval);
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

    function emailDoneTyping (email) {
	    $('#emailHelp').html('Checking.....');
	    $.post( "<?=base_url()?>user/checkemail/"+encodeURIComponent(email) )
        .done(function( data ) {
        	if(data==404){
        		$('#emailHelp').html('Email available!').css('color', 'green');
        		$('#email').removeClass("bg-danger text-white").addClass("bg-success text-white");
        		$('#submit').prop("disabled",false);
        	}else if(data==200){
        		$('#emailHelp').html('Email already used!').css('color', 'red');
        		$('#email').addClass("bg-danger text-white");
        		$('#submit').prop("disabled",true);
        	}
        });
	}

    function usernameDoneTyping (uname) {
	    $('#usernameHelp').html('Checking.....');
	    $.post( "<?=base_url()?>user/checkusername/"+encodeURIComponent(uname) )
        .done(function( data ) {
        	if(data==404){
        		$('#usernameHelp').html('Username available!').css('color', 'green');
        		$('#username').removeClass("bg-danger text-white").addClass("bg-success text-white");
        		$('#submit').prop("disabled",false);
        	}else if(data==200){
        		$('#usernameHelp').html('Username already used!').css('color', 'red');
        		$('#username').addClass("bg-danger text-white");
        		$('#submit').prop("disabled",true);
        	}
        });
	}
</script>

<?php
$this->load->view("footer");