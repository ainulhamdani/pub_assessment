<?php
$this->load->view("header-login");
?>
<div id="fb-root"></div>
<script>
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
<div class="row justify-content-center">
  <div class="col-lg-3 col-md-6 col-sm-6">
    <form class="form-signin" method="post" action="<?=site_url('welcome/login')?>">
      <center><h2 class="form-signin-heading">Public Assesment</h2></center>
      <hr>
      <label for="inputEmail" class="sr-only">Kode Staff</label>
      <input name="username" type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <span><?=$this->session->flashdata('error')?></span>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    </form>
  </div>
</div>
<div class="row"><hr></div>
<div class="row justify-content-center">
  <div class="col-lg-3 col-md-6 col-sm-6">
    <center><a href="<?=base_url()?>welcome/register">Register</a></center>
  </div>
</div>
<div class="row"><hr></div>
<div class="row justify-content-center">
  <div class="col-lg-3 col-md-6 col-sm-6">
    <center><div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" data-width="250" data-height="50" data-longtitle="true"></div></center>
  </div>
</div>
<div class="row"><hr></div>
<div class="row justify-content-center">
  <div class="col-lg-3 col-md-6 col-sm-6">
    <center><div class="fb-login-button" data-max-rows="1" onlogin="onLogIn()" data-size="large" data-button-type="login_with" data-width="250" data-scope="public_profile, email"></div></center>
  </div>
</div>
<div class="row"><hr></div>

<script>
  // Google sign in
  function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    var id_token = googleUser.getAuthResponse().id_token;
    var data = {
      id:profile.getId(),
      fullname:profile.getName(),
      imageurl:profile.getImageUrl(),
      email:profile.getEmail(),
      token:googleUser.getAuthResponse().id_token
    };
    $.post( "<?=base_url()?>welcome/oauth2callback", data )
    .done(function( data ) {
      console.log(data);
      data = $.parseJSON(data);
      if(data['code']==404){
        if (typeof(Storage) !== "undefined") {
          sessionStorage.setItem("source", "google");
          sessionStorage.setItem("id", profile.getId());
          sessionStorage.setItem("fullname", profile.getName());
          sessionStorage.setItem("imageurl", profile.getImageUrl());
          sessionStorage.setItem("email", profile.getEmail());
          sessionStorage.setItem("token", googleUser.getAuthResponse().id_token);
          window.location.href = "<?=base_url()?>welcome/register";
          // $(location).attr("href","<?=base_url()?>welcome/register");
        } else {
          alert("Sorry! No Web Storage support..");
        }
      }else if(data['code']==200){
        $(location).attr("href","<?=base_url()?>");
      }else if(data['code']==202){
        $(location).attr("href","<?=base_url()?>");
      }else{
        alert("code 500");
      }
    }
    );
  };

  // Facebook login
  function onLogIn() {
    FB.getLoginStatus(function(response) {
      fblogin(response);
    });
  }

  function fblogin(response){
    if (response.status === 'connected') {
      var fb_token = response.authResponse.accessToken;
      FB.api('/me?fields=id,link,gender,picture,name,email', function(response) {
        var data = {
          id:response.id,
          fullname:response.name,
          imageurl:response.picture.data.url,
          email:response.email,
          token:fb_token
        };
        $.post( "<?=base_url()?>welcome/fboauth2", data )
        .done(function( data ) {
          data = $.parseJSON(data);
          if(data['code']==404){
            if (typeof(Storage) !== "undefined") {
              sessionStorage.setItem("source", "facebook");
              sessionStorage.setItem("id", response.id);
              sessionStorage.setItem("fullname", response.name);
              sessionStorage.setItem("imageurl", response.picture.data.url);
              sessionStorage.setItem("email", response.email);
              sessionStorage.setItem("token", fb_token);
              $(location).attr("href","<?=base_url()?>welcome/register");
            } else {
              alert("Sorry! No Web Storage support..");
            }
          }else if(data['code']==200){
            $(location).attr("href","<?=base_url()?>");
          }else if(data['code']==202){
            $(location).attr("href","<?=base_url()?>");
          }else{
            alert("code 500");
          }
        }
        );
      });
    } 
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1722550147790150',
      cookie     : true,
      xfbml      : true,
      status     : true,
      version    : 'v2.8'
    });
  };
</script>

<?php
$this->load->view("footer");