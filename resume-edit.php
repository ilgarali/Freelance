<? include('includes/header.php');
include_once 'includes/fr.php';
?>
    <!-- Page header -->
    <?php 
$id = $_SESSION['id'];
$detail = $_GET['edit'];
$sql = "SELECT * FROM `freelancer` left join users on freelancer.user_id = users.id
 where freelancer.user_id = $id and freelancer.fid = $detail;"; 
$stmt = $conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll();
foreach ($data as $data) {
  # code...

?>

<form action="edit.php" method="POST" enctype="multipart/form-data">

<!-- Page header -->
<header class="page-header">
  <div class="container page-name">
    <h1 class="text-center">Add your resume</h1>
    <p class="lead text-center">Create your resume and put it online.</p>
  </div>

  <div class="container">

    <div class="row">
      <div class="col-xs-12 col-sm-4">
        <div class="form-group">
          <input type="file" name="image" value="upload/<?php echo $data['dev_img'] ?>" class="dropify" data-default-file="upload/<?php echo $data['dev_img'] ?>">
          <span class="help-block">Please choose a 4:6 profile picture.</span>
        </div>
      </div>

      <div class="col-xs-12 col-sm-8">
        <div class="form-group">
          <?php 
          if (isset($_SESSION['id'])) {
            $id=$_SESSION['id'];
            $sql = "SELECT name FROM users WHERE id ='$id'";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $data1=$stmt->fetch();
            echo '<input type="text" readonly  name="name" class="form-control input-lg" placeholder="'. $data1['name'] .'">';

          }
          
          ?>
          
        </div>
        
        <div class="form-group">
          <input type="text" class="form-control" name="headline" value="<?php echo $data['headline']; ?>">
        </div>

        <div class="form-group">
          <textarea class="form-control" name="des-about" rows="3" ><?php echo $data['description']; ?></textarea>
        </div>

        <hr class="hr-lg">

        <h6>Basic information</h6>
        <div class="row">

          <div class="form-group col-xs-12 col-sm-6">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <input type="text" name="location" class="form-control" value="<?php echo $data['location']; ?>">
            </div>
          </div>

          <div class="form-group col-xs-12 col-sm-6">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-globe"></i></span>
              <input type="text" name="website" class="form-control" value="<?php echo $data['website']; ?>">
            </div>
          </div>

          <div class="form-group col-xs-12 col-sm-6">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-usd"></i></span>
              <input type="text" name="salary" class="form-control" value="<?php echo $data['salary']; ?>">
              <span class="input-group-addon">Per hour</span>
            </div>
          </div>

          <div class="form-group col-xs-12 col-sm-6">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
              <input type="text" name="age" class="form-control" value="<?php echo $data['age']; ?>">
              <span class="input-group-addon">Years old</span>
            </div>
          </div>

          <div class="form-group col-xs-12 col-sm-6">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="text" name="phone" class="form-control" value="<?php echo $data['phone']; ?>">
            </div>
          </div>

          <div class="form-group col-xs-12 col-sm-6">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
              <input type="text" name="email" class="form-control" value="<?php echo $data['email']; ?>">
            </div>
          </div>

        </div>

        <hr class="hr-lg">

        <h6>Tags list</h6>
        <div class="form-group">
          <input type="text" name="tags" data-role="tagsinput" value="<?php echo $data['tags']; ?>">
          <span class="help-block">Write tag name and press enter</span>
        </div>

      </div>
    </div>


  </div>
</header>
<!-- END Page header -->


<!-- Main container -->
<main>


 


  <!-- Education -->
  <section class=" bg-alt">
    <div class="container">

      <header class="section-header">
        <span>Latest degrees</span>
        <h2>Education</h2>
      </header>
      
      <div class="row">

        <div class="col-xs-12">
          <div class="item-block">
            <div class="item-form">

           

              <div class="row">
               

                <div class="col-md-12">
                  <div class="form-group">
                    <input type="text" name="degree" class="form-control" value="<?php echo $data['degree']; ?>">
                  </div>

                  <div class="form-group">
                    <input type="text" name="major" class="form-control" value="<?php echo $data['major']; ?>">
                  </div>
                  <div class="form-group">
                    <input type="text" name="school_name" class="form-control" value="<?php echo $data['school_name']; ?>">
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">Date from</span>
                      <input type="text" name="date_from" class="form-control" value="<?php echo $data['date_from']; ?>">
                      <span class="input-group-addon">Date to</span>
                      <input type="text" name="date_to" class="form-control" value="<?php echo $data['date_to']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <textarea class="form-control" name="e_description" rows="3" ><?php echo $data['e_description']; ?></textarea>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>


       

      </div>
    </div>
  </section>
  <!-- END Education -->


  <!-- Work Experience -->
  <section>
    <div class="container">
      <header class="section-header">
        <span>Past positions</span>
        <h2>Work Experience</h2>
      </header>
      
      <div class="row">

        <div class="col-xs-12">
          <div class="item-block">
            <div class="item-form">

      

              <div class="row">
               

                <div class="col-md-12 col-sm-8">
                  <div class="form-group">
                    <input type="text" name="company_name" class="form-control" value="<?php echo $data['company_name']; ?>">
                  </div>

                  <div class="form-group">
                    <input type="text" name="position" class="form-control" value="<?php echo $data['position']; ?>">
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">Date from</span>
                      <input type="text" name="date_from_c" class="form-control" value="<?php echo $data['date_from_c']; ?>">
                      <span class="input-group-addon">Date to</span>
                      <input type="text" name="date_to_c" class="form-control" value="<?php echo $data['date_to_c']; ?>">
                    </div>
                  </div>

                </div>

                <div class="col-xs-12">
                <div class="form-group">
                    <textarea class="form-control" name="c_description" rows="3"><?php echo $data['c_description']; ?></textarea>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

      

      

      </div>

    </div>
  </section>
  <!-- END Work Experience -->


  <!-- Skills -->
  <section class=" bg-alt">
    <div class="container">
      <header class="section-header">
        <span>Expertise Areas</span>
        <h2>Skills</h2>
      </header>
      
      <div class="row">

        <div class="col-xs-12">
          <div class="item-block">
            <div class="item-form">

 

              <div class="row">
                <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                    <input type="text" name="skills" class="form-control" value="<?php echo $data['skills']; ?>">
                  </div>
                </div>

                <div class="col-xs-12 col-sm-6">

                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" name="skill_proficiency" class="form-control" value="<?php echo $data['skill_proficiency']; ?>">
                      <span class="input-group-addon">%</span>
                    </div>
                  </div>

                </div>
              </div>

            </div>
          </div>
        </div>



      </div>

    </div>
  </section>
  <!-- END Skills -->



  <!-- Submit -->
  <section class=" bg-img" style="background-image: url(assets/img/bg-facts.jpg);">
    <div class="container">
      <header class="section-header">
        <span>Are you done?</span>
        <h2>Submit resume</h2>
        <p>Please review your information once more and press the below button to put your resume online.</p>
      </header>

      <p class="text-center">
        <input type="hidden" name="fid" value="<?php echo $data['fid'] ?>">
        <button type="submit" class="btn btn-success btn-xl btn-round" name="submit">Submit your resume</button></p>

    </div>
  </section>
  <!-- END Submit -->


</main>
<!-- END Main container -->

</form>

    <!-- END Main container -->
<?php } ?>
    <?php include('includes/footer.php'); ?>
