<?php include 'includes/header.php' ?>

    <!-- Page header -->

  <?php 
    $jobdetail = $_GET['jobdetail'];

    $sql="SELECT * FROM job_posts left join company on job_posts.company_id = company.cid
    
     WHERE jid=? ORDER BY jid DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$jobdetail]);
    $data=$stmt->fetchAll();
  foreach ($data as $data) {
    # code...
  
  ?>

    <header class="page-header bg-img size-lg" style="background-image: url(upload/<?php echo $data['img'] ?>)">
      <div class="container">
        <div class="header-detail">
          <img class="logo" src="upload/<?php  echo $data['cover_img'] ?>" alt="">
          <div class="hgroup">
            <h1> <?php  echo $data['job_title'] ?> </h1>
            <h3><a href="company-detail.php?detail=<?php  echo $data['cid'] ?>"><?php  echo $data['c_name'] ?></a></h3>
          </div>
          <time datetime="2016-03-03 20:00"><?php  echo $data['created_at'] ?></time>
          <hr>
          <p class="lead"><?php  echo $data['job_short'] ?></p>

          <ul class="details cols-3">
            <li>
              <i class="fa fa-map-marker"></i>
              <span><?php  echo $data['job_location'] ?></span>
            </li>

            <li>
              <i class="fa fa-briefcase"></i>
              <span><?php  echo $data['job_type'] ?></span>
            </li>

            <li>
              <i class="fa fa-money"></i>
              <span>$<?php  echo $data['salary'] ?>  / hourly</span>
            </li>

            <li>
              <i class="fa fa-clock-o"></i>
              <span><?php  echo $data['working_hours'] ?>h / week</span>
            </li>

            <li>
              <i class="fa fa-flask"></i>
              <span><?php  echo $data['exprience'] ?> years experience</span>
            </li>

            <li>
              <i class="fa fa-certificate"></i>
              <a href="#"> <?php  echo $data['degree'] ?> </a>
            </li>
          </ul>

          <div class="button-group">
            <ul class="social-icons">
              <li class="title">Share on</li>
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>

            <div class="action-buttons">
              
              <?php 
              
         

              if (isset($_SESSION['id'])) {
                     $sessid= $_SESSION['id'];
              $sql2 = "SELECT `type` FROM users WHERE id =? ";
              $stmt2=$conn->prepare($sql2);
              $stmt2->execute([$sessid]);
              $data2 = $stmt2->fetch();
               if ($data2['type'] != 0) {
                echo '<a class="btn btn-primary" href="#">Apply with linkedin</a>
                <a class="btn btn-success apply"  href="job-apply.php?apply='.$data['jid'].'">Apply now</a>
                ';
              }
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

      <!-- Job detail -->
      <section>
        <div class="container">

        <?php  echo $data['job_detail'] ?>

        </div>
      </section>
      <!-- END Job detail -->

    </main>

    <?php } ?>


   
    <!-- END Main container -->
    <?php include 'includes/footer.php' ?>