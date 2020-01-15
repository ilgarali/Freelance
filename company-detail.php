<?php 
include 'includes/header.php';

?>
  <?php 
      
      $id = $_SESSION['id'];
      $detail = $_GET['detail'];
      $sql = "SELECT * FROM `company` WHERE company.cid = ?"; 
      $stmt = $conn->prepare($sql);
      $stmt->execute([$detail]);
      $data = $stmt->fetchAll();
      foreach ($data as $data) {
       ?>
 
    <!-- Page header -->
    <header class="page-header bg-img size-lg" style="background-image: url(upload/<?php echo $data['img'] ?>)">
      <div class="container">

    
        <div class="header-detail">
          <img class="logo" src="upload/<?php echo $data['img'] ?>" alt="">
          <div class="hgroup">
            <h1><?php echo $data['c_name']; ?></h1>
            <h3><?php echo $data['headline']; ?></h3>
          </div>
          <hr>
          <p class="lead"><?php echo $data['c_des']; ?></p>

          <ul class="details cols-3">
            <li>
              <i class="fa fa-map-marker"></i>
              <span><?php echo $data['location']; ?></span>
            </li>

            <li>
              <i class="fa fa-globe"></i>
              <a href="#"><?php echo $data['website'] ?></a>
            </li>

            <li>
              <i class="fa fa-users"></i>
              <span><?php echo $data['employer']; ?></span>
            </li>

            <li>
              <i class="fa fa-birthday-cake"></i>
              <span><?php echo $data['founded']; ?></span>
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

          

        </div>

     
      </div>
    </header>
    <!-- END Page header -->


    <!-- Main container -->
    <main>


      <!-- Company detail -->
      <section>
        <div class="container">

          <header class="section-header">
            <span>About</span>
            <h2>Company detail</h2>
          </header>
          
          <p><?php echo $data['c_detail'] ?></p>
         

        </div>
      </section>
      <!-- END Company detail -->
      <?php } ?>

      <!-- Open positions -->
      <section id="open-positions" class="bg-alt">
        <div class="container">
          <header class="section-header">
            <span>vacancies</span>
            <h2>Open positions</h2>
          </header>
          
          <div class="row">


          <?php 
      
      $id = $_SESSION['id'];
      $detail2 = $_GET['detail'];
      $sql2 = "SELECT * FROM `job_posts` left join company on company.cid = job_posts.company_id WHERE company.cid = ?"; 
      $stmt2 = $conn->prepare($sql2);
      $stmt2->execute([$detail2]);
     
      $data2 = $stmt2->fetchAll();

      foreach ($data2 as $data2) {
       ?>
 
            <!-- Job item -->
            <div class="col-xs-12">
              <a class="item-block" href="job-detail.php?jobdetail=<?php echo $data2['jid'] ?>">
                <header>
                  <img src="upload/<?php echo $data2['cover_img'] ?>" alt="">
                  <div class="hgroup">
                    <h4> <?php echo $data2['job_title'] ?> </h4>
                    <h5><?php echo $data2['c_name'] ?> <span class="label label-success"><?php echo $data2['job_type'] ?></span></h5>
                  </div>
                  <time datetime="2016-03-10 20:00"><?php echo $data2['created_at'] ?></time>
                </header>

                <div class="item-body">
                  <p><?php echo $data2['job_short'] ?></p>
                </div>

                <footer>
                  <ul class="details cols-3">
                    <li>
                      <i class="fa fa-map-marker"></i>
                      <span> <?php echo $data2['job_location'] ?> </span>
                    </li>

                    <li>
                      <i class="fa fa-money"></i>
                      <span> $<?php echo $data2['salary'] ?> </span>
                    </li>

                    <li>
                      <i class="fa fa-certificate"></i>
                      <span> <?php echo $data2['degree'] ?> </span>
                    </li>
                  </ul>
                </footer>
              </a>
            </div>
            <!-- END Job item -->

      <?php }?>


          </div>

        </div>
      </section>
      <!-- END Open positions -->


    </main>
    <!-- END Main container -->
    <?php 
include 'includes/footer.php';

?>

    