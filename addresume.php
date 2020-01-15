<?php include('includes/header.php'); 
   include_once 'includes/fr.php';
?>
    <!-- END Navigation bar -->
    

    <form action="add.php" method="POST" enctype="multipart/form-data">

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
                <input type="file" name="image" class="dropify" data-default-file="assets/img/avatar.jpg">
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
                  $data=$stmt->fetch();
                  echo '<input type="text" readonly name="name" class="form-control input-lg" placeholder="'. $data['name'] .'">';

                }
                
                ?>
                
              </div>
              
              <div class="form-group">
                <input type="text" class="form-control" name="headline" placeholder="Headline (e.g. Front-end developer)">
              </div>

              <div class="form-group">
                <textarea class="form-control" name="des-about" rows="3" placeholder="Short description about you"></textarea>
              </div>

              <hr class="hr-lg">

              <h6>Basic information</h6>
              <div class="row">

                <div class="form-group col-xs-12 col-sm-6">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    <input type="text" name="location" class="form-control" placeholder="Location, e.g. Melon Park, CA">
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                    <input type="text" name="website" class="form-control" placeholder="Website address">
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                    <input type="text" name="salary" class="form-control" placeholder="Salary, e.g. 85">
                    <span class="input-group-addon">Per hour</span>
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                    <input type="text" name="age" class="form-control" placeholder="Age">
                    <span class="input-group-addon">Years old</span>
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" name="phone" class="form-control" placeholder="Phone number">
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="text" name="email" class="form-control" placeholder="Email address">
                  </div>
                </div>

              </div>

              <hr class="hr-lg">

              <h6>Tags list</h6>
              <div class="form-group">
                <input type="text" name="tags" value="HTML,CSS,Javascript" data-role="tagsinput" placeholder="Tag name">
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
                          <input type="text" name="degree" class="form-control" placeholder="Degree, e.g. Bachelor">
                        </div>

                        <div class="form-group">
                          <input type="text" name="major" class="form-control" placeholder="Major, e.g. Computer Science">
                        </div>
                        <div class="form-group">
                          <input type="text" name="school_name" class="form-control" placeholder="School name, e.g. Massachusetts Institute of Technology">
                        </div>

                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">Date from</span>
                            <input type="text" name="date_from" class="form-control" placeholder="e.g. 2012">
                            <span class="input-group-addon">Date to</span>
                            <input type="text" name="date_to" class="form-control" placeholder="e.g. 2016">
                          </div>
                        </div>

                        <div class="form-group">
                          <textarea class="form-control" name="e_description" rows="3" placeholder="Short description"></textarea>
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
                          <input type="text" name="company_name" class="form-control" placeholder="Company name">
                        </div>

                        <div class="form-group">
                          <input type="text" name="position" class="form-control" placeholder="Position, e.g. UI/UX Researcher">
                        </div>

                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">Date from</span>
                            <input type="text" name="date_from_c" class="form-control" placeholder="e.g. 2012">
                            <span class="input-group-addon">Date to</span>
                            <input type="text" name="date_to_c" class="form-control" placeholder="e.g. 2016">
                          </div>
                        </div>

                      </div>

                      <div class="col-xs-12">
                      <div class="form-group">
                          <textarea class="form-control" name="c_description" rows="3" placeholder="Short description"></textarea>
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
                          <h5>Please use , between skills</h5>
                          <input type="text" name="skills" class="form-control" placeholder="Skill name, e.g. HTML">
                        </div>
                      </div>

                      <div class="col-xs-12 col-sm-6">

                        <div class="form-group">
                          <div class="input-group">
                          <h5>Please use , between numbers</h5>
                            <input type="text" name="skill_proficiency" class="form-control" placeholder="Skill proficiency, e.g. 90">
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
              <button type="submit`" class="btn btn-success btn-xl btn-round" name="submit">Submit your resume</button></p>

          </div>
        </section>
        <!-- END Submit -->


      </main>
      <!-- END Main container -->

    </form>

    <?php include('includes/footer.php'); 
     
     ?>