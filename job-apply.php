<?php
include_once 'includes/header.php';
?>

    <!-- Page header -->
    <?php 
    
    $apply = $_GET['apply'];
    $sql = "SELECT *, job_posts.job_location  as ttt FROM job_posts left join company on job_posts.company_id = company.cid WHERE jid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$apply]);
    $data = $stmt->fetchALl();
    foreach ($data as $data) {
      # code...
    }
    ?>
    <header class="page-header bg-img size-lg" style="background-image: url(upload/<?php echo $data['cover_img'] ?>)">
      <div class="container no-shadow">
        <h1 class="text-center">Apply for the job</h1>
        <p class="lead text-center">Apply with your online resume, create new resume for the job, or make a custom application.</p>

        <hr>

        <!-- Job detail -->
        <a class="item-block item-block-flat" href="job-detail.php?jobdetail=<?php echo $data['jid'] ?>">
          <header>
            <img src="upload/<?php echo $data['cover_img'] ?>" alt="">
            <div class="hgroup">
              <h4><?php echo $data['job_title'] ?></h4>
              <h5><?php echo $data['c_name'] ?></h5>
              <input type="hidden" id="companyid" value="<?php echo $data['cid'] ?>">
            </div>
            <div class="header-meta">
              <span class="location"><?php echo $data['ttt'] ?></span>
              <time datetime="2016-03-10 20:00">34 min ago</time>
            </div>
          </header>
        </a>
        <!-- END Job detail -->

        <div class="button-group">
          <div class="action-buttons">
            <a class="btn btn-gray" href="#sec-custom">Custom application</a>
            <a class="btn btn-primary" href="#sec-resume">Apply with a resume</a>
          </div>
        </div>

      </div>
    </header>
    <!-- END Page header -->


    <!-- Main container -->
    <main>


        <!-- Apply with resume -->
        <section id="sec-resume">
          <div class="container">

            <header class="section-header">
              <span>Apply with a resume</span>
              <h2>Select a resume</h2>
              <p>Applied for this job with one of your online available resumes</p>
            </header>
            

            <!-- Resume item -->

            
            
            <?php 
$id = $_SESSION['id'];
$sql = "SELECT * FROM `freelancer` left join users on freelancer.user_id = users.id where freelancer.user_id = ? ORDER BY freelancer.fid DESC"; 
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$data = $stmt->fetchAll();
foreach ($data as $data) {
  # code...

?>
            
            
            <div class="item-block">
              <header>
                <a href="resume-detail.php?detail=<?php echo $data['fid'] ?>"><img class="resume-avatar" src="upload/<?php echo $data['dev_img']; ?>" alt=""></a>
                <div class="hgroup">
                  <h4><a href="resume-detail.php?detail=<?php echo $data['fid'] ?>"> <?php echo $data['name'] ?> </a></h4>
                  <h5><?php echo $data['head'] ?></h5>
                </div>
                <div class="header-meta">
                  <span class="location"><?php echo $data['head'] ?></span>
                  <span class="rate"> <?php echo $data['salary'] ?> </span>
                </div>
              </header>

              <footer>
                <p class="status"><strong>Updated on:</strong> March 10, 2016</p>

                <div class="action-btn">
                  <a class="btn btn-xs btn-gray" href="resume-edit.php?edit=<?php echo  $data['fid']; ?>">Edit</a>
                  <a class="btn btn-xs btn-success apply" id="<?php  echo $data['fid'] ?>" href="#">Select</a>
                </div>
              </footer>
            </div>
            <!-- END Resume item -->

<?php } ?>
           


       


    </main>
    <!-- END Main container -->
    <script>
    
    let apply = document.querySelectorAll('.apply');
    for (let i = 0; i < apply.length; i++) {
      apply[i].addEventListener('click',(e) => {
        e.preventDefault();
        let resumeid = apply[i].getAttribute('id');
        let jobpostid = "<?php echo $_GET['apply'] ?>";
        let companyid = document.getElementById('companyid').value;

        console.log(companyid);
        
        const jobtoapply = "jobtoapply.php";
        formdata = new FormData();
        formdata.append("resumeid",resumeid);
        formdata.append("jobpostid",jobpostid);
        formdata.append("companyid",companyid);
        fetch(jobtoapply,{
          method:'post',
          body:formdata
        }).then((res)=> res.json())
  .then((res) =>{ if (res.success) {
    toastr.success('You have applied job  successfully.You are redirecting to home page');
    setTimeout(() => {
      window.location.replace('index.php')
    }, 2020);
  }} )
  .catch((error)=> {console.log(error);toastr.error('Error','Something Went Wrong')})

        
        
      });
      
    }   
    </script>

    <?php include_once 'includes/footer.php' ?>