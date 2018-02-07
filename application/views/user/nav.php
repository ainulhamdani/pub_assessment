<nav class="navbar navbar-default navbar-inverse">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="<?=base_url()?>">BEATS</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li<?=($this->uri->segment(1)=='main'||$this->uri->segment(1)=='')?' class="active"':''?>><a href="<?=base_url()?>">Home</a></li>
	        <li<?=($this->uri->segment(1)=='assessment')?' class="active"':''?>><a href="<?=base_url()?>assessment">Assessment</a></li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Username <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">Profile</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="<?=base_url()?>welcome/logout">Logout</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>