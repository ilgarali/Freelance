<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Post a job position or create your online resume by TheJobs!">
    <meta name="keywords" content="">

    <title>TheJobs - Login</title>

    <!-- Styles -->
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/toastr.css" rel="stylesheet">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.ico">
  </head>

  <body class="login-page">


    <main>

      <div class="login-block">
        <img src="assets/img/logo.png" alt="">
        <h1>Log into your account</h1>

        

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="ti-email"></i></span>
              <input type="text" name="email" id="email" class="form-control" placeholder="Email">
            </div>
          </div>
          
          <hr class="hr-xs">

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="ti-unlock"></i></span>
              <input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
            </div>
          </div>

          <button class="btn btn-primary btn-block" name="submit" id="login" type="submit">Login</button>

          <div class="login-footer">
            <h6>Or login with</h6>
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>

       
      </div>

      <div class="login-links">
        <a class="pull-left" href="user-forget-pass.html">Forget Password?</a>
        <a class="pull-right" href="register.php">Register an account</a>
      </div>

    </main>

 
    <script src="//code.jquery.com/jquery.min.js"></script>

<script src="assets/js/toastr.js"></script>
   
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
$("#login").click(function (e) { 
  let email = $('#email').val().trim();
  let pass = $('#pass').val().trim();

  $.ajax({
    type: "post",
    url: "tologin.php",
    data: {"email":email,"pass":pass},
    
    success: function (response) {
      let data = JSON.parse(response);
      if(data.status === 'success')
      {
        toastr.success('You have successfully loged in. You are redirecting home page');
        setTimeout(() => {
          window.location.replace("index.php");
        }, 1501);
      }
      else{
        toastr.error('Error','Something went wrong');
      }

    },
    error: function (request, status, error) {
        console.log(request.responseText);
        console.log(error);
        
    },
  });
  
});

</script>
    <!-- Scripts -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/custom.js"></script>

  </body>
</html>
