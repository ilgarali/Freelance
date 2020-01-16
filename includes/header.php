<?php 
include("includes/db.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Post a job position or create your online resume by TheJobs!">
    <meta name="keywords" content="">

    <title>TheJobs</title>

    <!-- Styles -->

    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/toastr.css" rel="stylesheet">
    <link href="assets/vendors/summernote/summernote.css" rel="stylesheet">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.ico">
  </head>

  <body class="nav-on-header smart-nav">

    <!-- Navigation bar -->
    <nav class="navbar">
      <div class="container">

        <!-- Logo -->
        <div class="pull-left">
          <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>

          <div class="logo-wrapper">
            <a class="logo" href="index.php"><img src="assets/img/logo.png" alt="logo"></a>
            <a class="logo-alt" href="index.php"><img src="assets/img/logo-alt.png" alt="logo-alt"></a>
          </div>

        </div>
        <!-- END Logo -->

        <!-- User account -->
        <div class="pull-right user-login">
          
          <?php
          
             
          if (!isset($_SESSION['id']) ) {
            echo '<a class="btn btn-sm btn-primary" href="login.php">Login</a> or <a href="register.php">register</a>';
            
          } 
          else{
            $id = $_SESSION['id'];
            $sql = "SELECT `name`,`type` FROM users WHERE id = '$id'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetch();
            echo '<a class="btn btn-sm btn-primary" href="">Welcome ' .$data['name']. '</a>';
            echo  '<a href="logout.php">Log Out</a>';
          }
          ?>

          
          
        </div>
        <!-- END User account -->
<!-- Navigation menu -->
<ul class="nav-menu">
          <li>
            <a class="active" href="index.php">Home</a>
         
          </li>
          <li>
            
            <ul>
          <?php 
         if (isset($id)) {
          if ($data['type'] == 1) {
            echo '<li><a href="job-list.php">Browse jobs</a></li>
           
   
            <li><a href="job-apply.php">Apply for job</a></li>';
          }
          elseif ($data['type'] == 0) {
            echo '       <li><a href="job-add.php">Post a job</a></li>
            <li><a href="job-manage.php">Manage jobs</a></li>
            <li><a href="job-candidates.php">Candidates</a></li>';
          }
          else{
            echo '<li><a href="job-list.php">Browse jobs - 1</a></li>
          
            <li><a href="job-detail.php">Job detail</a></li>
            <li><a href="job-apply.php">Apply for job</a></li>
            <li><a href="job-add.php">Post a job</a></li>
            <li><a href="job-manage.php">Manage jobs</a></li>
            <li><a href="job-candidates.php">Candidates</a></li>
            ';
            
              
            
          }
         }
        
          
          ?>

              
       


            </ul>
          </li>




          <li>


          <?php 
         if (isset($id)) {
          if ($data['type'] == 1) {
            echo '
            <a href="#">Resume</a>
            <ul>
              <li><a href="resume-list.php">Browse resumes</a></li>
              
              <li><a href="addresume.php">Create a resume</a></li>
              <li><a href="resume-manage.php">Manage resumes</a></li>
            </ul>
          </li>';
          }
          elseif ($data['type'] == 0) {
            echo ' 
            <li>
              <a href="#">Company</a>
              <ul>
                <li><a href="company-list.php">Browse companies</a></li>
                
                <li><a href="company-add.php">Create a company</a></li>
                <li><a href="company-manage.php">Manage companies</a></li>
              </ul>
            </li>';
          }
          elseif($data['type'] == 2){
            echo ' <a href="#">Resume</a>
            <ul>
              <li><a href="resume-list.php">Browse resumes</a></li>
              <li><a href="resume-detail.php">Resume detail</a></li>
              <li><a href="addresume.php">Create a resume</a></li>
              <li><a href="resume-manage.php">Manage resumes</a></li>
            </ul>
          </li>
          <li>
              <a href="#">Company</a>
              <ul>
                <li><a href="company-list.php">Browse companies</a></li>
                <li><a href="company-detail.php">Company detail</a></li>
                <li><a href="company-add.php">Create a company</a></li>
                <li><a href="company-manage.php">Manage companies</a></li>
              </ul>
            </li>
             <a href="back/admin.php">Admin Panel</a>
            ';
          }
         }
         else{
           echo '<li><a href="index.php">Please Register to use this feature</a></li>';
         }
          
          ?>
<?php 
if (isset($id)) {
  if ($data['type'] == 1 || $data['type'] == 0 ) {
    echo '<a href="messages.php">Messages</a>';
 
  }
}



?>


          <li>
            <a href="#">Pages</a>
            <ul>
              <li><a href="page-blog.php">Blog</a></li>
              <li><a href="page-post.php">Blog-post</a></li>
              <li><a href="page-about.php">About</a></li>
              <li><a href="page-contact.php">Contact</a></li>
              <li><a href="page-faq.php">FAQ</a></li>
              <li><a href="page-pricing.php">Pricing</a></li>
              <li><a href="page-typography.php">Typography</a></li>
              <li><a href="page-ui-elements.php">UI elements</a></li>
            </ul>
          </li>
        </ul>
          
        
        <!-- END Navigation menu -->

      </div>
    </nav>
    <!-- END Navigation bar -->
