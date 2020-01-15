<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Post a job position or create your online resume by TheJobs!">
    <meta name="keywords" content="">

    <title>TheJobs - Register</title>
    <link href="assets/css/toastr.css" rel="stylesheet">

    <!-- Styles -->
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">

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
              <span class="input-group-addon"><i class="ti-user"></i></span>
              <input type="text" id="name" class="form-control" name="name" placeholder="Your name">
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="ti-user"></i></span>
              <input type="text" id="surname" class="form-control" name="surname" placeholder="Your surname">
            </div>
          </div>
          
          
          <hr class="hr-xs">

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="ti-email"></i></span>
              <input type="text" name="email" id="email" class="form-control" placeholder="Your email address">
            </div>
          </div>
          
          <hr class="hr-xs">

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="ti-unlock"></i></span>
              <input type="password" name="pass" id="pass" class="form-control" placeholder="Choose a password">
            </div>
          </div>
          <hr class="hr-xs">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="ti-unlock"></i></span>
              <input type="password" name="pass1" id="pass1" class="form-control" placeholder="Enter Password Again">
            </div>
          </div>

          <div class="form-group">
    <label for="exampleFormControlSelect1">Register as Freelancer or Employer</label>
    <select name="opt" class="form-control opt" id="exampleFormControlSelect1"> 
      <option id="0">Freelancer</option>
      <option id="1"> Employer </option>
      </select>
  </div>
 

          <button class="btn btn-primary btn-block" id="signup" type="submit">Sign up</button>

          <div class="login-footer">
            <h6>Or register with</h6>
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>

       
      </div>

      <div class="login-links">
        <p class="text-center">Already have an account? <a class="txt-brand" href="user-login.html">Login</a></p>
      </div>

    </main>


    <!-- Scripts -->
 
<script src="//code.jquery.com/jquery.min.js"></script>

<script src="assets/js/toastr.js"></script>
   
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
$(function () {


$("#signup").click(function (e) { 
  e.preventDefault();
  let name = $('#name').val().trim();
let surname = $('#surname').val().trim();
let email = $('#email').val().trim();
let pass = $('#pass').val().trim();
let pass1 = $('#pass1').val().trim();
let opt = $('.opt').val();

  
 
  
if(name.length > 4 && surname.length > 4 && email.length > 4 && pass.length > 5)
{
  $.ajax({
  type: "post",
  url: "toregister.php",
  data: {"name":name,"surname":surname,"email":email,"pass":pass,"pass1":pass1,"opt":opt},
  
  success: function (response) {
   let data = JSON.parse(response);
    if(data.status ==='success1'){
      toastr.success('Success');

    }
    else if(data.status ==='sucess2'){
      toastr.success('Success');

    }
    else{
      toastr.error('Error','Error Title')

    }
  },
  error: function (request, status, error) {
        console.log(request.responseText);
        console.log(error);
        
    },
});
}

else{
  alert('All Field Is Required');
}


});
  
});


</script>
    

  </body>
</html>
