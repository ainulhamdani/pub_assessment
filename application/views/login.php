
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Public Assesment - BEATS Project</title>

  <link rel="stylesheet" href="<?=base_url()?>asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>asset/css/style.css">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="<?=site_url('welcome/login')?>">
          <center><h2 class="form-signin-heading">Public Assesment</h2></center>
          <hr>
        <label for="inputEmail" class="sr-only">Kode Staff</label>
        <input name="username" type="text" id="inputEmail" class="form-control" placeholder="Kode Staff" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <span><?=$this->session->flashdata('error')?></span>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>

    </div> <!-- /container -->
    <footer class="footer">
      <div class="container">
          <center>Summit Institute of Development</center>
          <center>&copy; 2018</center>
      </div>
    </footer>
  </body>
</html>
