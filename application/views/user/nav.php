
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
	<a class="navbar-brand" href="<?=base_url()?>">BEATS</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarCollapse">
		<ul class="navbar-nav mr-auto">
			<li<?=($this->uri->segment(1)=='main'||$this->uri->segment(1)=='')?' class="active"':''?>><a class="nav-link" href="<?=base_url()?>">Home</a></li>
			<li<?=($this->uri->segment(1)=='assessment')?' class="active"':''?>><a class="nav-link" href="<?=base_url()?>assessment">Assessment</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Username</a>
				<div class="dropdown-menu" aria-labelledby="dropdown08">
					<a class="dropdown-item" href="#">Profile</a>
					<a class="dropdown-item" onclick="signout()">Logout</a>
				</div>
			</li>
		</ul>
	</div>
</nav>
<script type="text/javascript">
	function signout() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        $(location).attr("href","<?=base_url()?>welcome/logout");
      });
    }

    function onLoad() {
      gapi.load('auth2', function() {
        gapi.auth2.init();
      });
    }
</script>