<? include 'includes/header.php' ?>
    <!-- Page header -->
    <?php 
$id = $_SESSION['id'];
$detail = $_GET['detail'];
$sql = "SELECT * FROM `freelancer` left join users on freelancer.user_id = users.id
 where freelancer.fid = $detail;"; 
$stmt = $conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll();
foreach ($data as $data) {
  # code...

?>

    <header class="page-header bg-img" style="background-image: url(assets/img/free.jpg)">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-4">
            <img src="<?php echo "upload/".$data['dev_img']; ?>" alt="">
          </div>

          <div class="col-xs-12 col-sm-8 header-detail">
            <div class="hgroup">
              <h1><?php echo $data['name']; ?></h1>
              <h3><?php echo $data['head']; ?></h3>
            </div>
            <hr>
            <p class="lead"> <?php echo $data['description']; ?> </p>

            <ul class="details cols-2">
              <li>
                <i class="fa fa-map-marker"></i>
                <span><?php echo $data['location']; ?></span>
              </li>

              <li>
                <i class="fa fa-globe"></i>
                <a href="#"><?php echo $data['website']; ?></a>
              </li>

              <li>
                <i class="fa fa-money"></i>
                <span>$<?php echo $data['salary']; ?></span>
              </li>

              <li>
                <i class="fa fa-birthday-cake"></i>
                <span><?php echo $data['age']; ?>years-old</span>
              </li>

              <li>
                <i class="fa fa-phone"></i>
                <span><?php echo $data['phone']; ?></span>
              </li>

              <li>
                <i class="fa fa-envelope"></i>
                <a href="#"><?php echo $data['email']; ?></a>
              </li>
            </ul>

            <div class="tag-list">
            <?php $tags = explode(",",$data['tags']); 
              foreach($tags as $tag){
                echo "<span>".$tag."</span>";
              }
            ?>
              
             
            </div>
          </div>
        </div>

      
      </div>
    </header>
    <!-- END Page header -->


    <!-- Main container -->
    <main>


      <!-- Education -->
      <section>
        <div class="container">

          <header class="section-header">
            <span>Latest degrees</span>
            <h2>Education</h2>
          </header>
          
          <div class="row">
           

            <div class="col-xs-12">
              <div class="item-block">
                <header>
                  
                  <div class="hgroup">
                    <h4><?php echo $data['degree']; ?><small><?php echo $data['major']; ?></small></h4>
                    <h5><?php echo $data['school_name']; ?></h5>
                  </div>
                  <h6 class="time"><?php echo $data['date_from']; ?>- <?php echo $data['date_to']; ?></h6>
                </header>
                <div class="item-body">
                  <p><?php echo $data['e_description']; ?></p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>
      <!-- END Education -->


      <!-- Work Experience -->
      <section class="bg-alt">
        <div class="container">
          <header class="section-header">
            <span>Past positions</span>
            <h2>Work Experience</h2>
          </header>
          
          <div class="row">

            <!-- Work item -->
            <div class="col-xs-12">
              <div class="item-block">
                <header>
                  
                  <div class="hgroup">
                    <h4><?php echo $data['company_name']; ?></h4>
                    <h5><?php echo $data['position']; ?></h5>
                  </div>
                  <h6 class="time"><?php echo $data['date_from_c']; ?> - <?php echo $data['date_to_c']; ?> </h6>
                </header>
                <div class="item-body">
                  <p><?php echo $data['c_description']; ?> </p>
                  
                </div>
              </div>
            </div>
            <!-- END Work item -->


          


       

          </div>

        </div>
      </section>
      <!-- END Work Experience -->


      <!-- Skills -->
      <section>
        <div class="container">
          <header class="section-header">
            <span>Expertise Areas</span>
            <h2>Skills</h2>
          </header>
          
          <br>
          <ul class="skills cols-3">
          
          <?php 
    $skills = explode(",",$data['skills']);
    $skill_pro = explode(",",$data['skill_proficiency']);
    $k=0;
    foreach ($skills as $skill) {
      # code...
   
          ?>

            <li>
              <div>
                <span class="skill-name"><?php echo $skill; ?></span>
                <span class="skill-value"><?php echo $skill_pro[$k]; ?></span>
              </div>
              <div class="progress">
                <div class="progress-bar" <?php echo 'style="width:'.$skill_pro[$k].'%;"'; ?> ></div>
              </div>
            </li>

<?php $k++;  } ?>
       

          </ul>

        </div>
      </section>
      <!-- END Skills -->


    </main>
    <!-- END Main container -->
<?php } ?>
    <?php include('includes/footer.php'); ?>
