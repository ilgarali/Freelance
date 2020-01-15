<?php 
include 'includes/header.php';
include_once 'includes/co.php';
if (!isset( $_SESSION['id'])) {
   header("Location:index.php");
}
?>

    <!-- Page header -->
    <header class="page-header bg-img size-lg" style="background-image: url(upload/hire.jpg)">
      <div class="container page-name">
        <h1 class="text-center">Job Candidates</h1>
        <p class="lead text-center">Use following search box to find best candidates for your openning position</p>
      </div>

<?php 
$sessid = $_SESSION['id'];
$sql = "SELECT * FROM `apply` left join freelancer on apply.resumeid = freelancer.fid left join job_posts
 on `apply`.job_post_id = job_posts.jid left join company on apply.company_id = company.cid
 left join users on freelancer.user_id = users.id 
  WHERE job_posts.user_id = ? ORDER BY `apply`.appid DESC";
$stmt = $conn->prepare($sql);
$stmt->execute([$sessid]);
$data = $stmt->fetchAll();
foreach ($data as $data) {
  # code...

?>

      <div class="container">
        <h5>Applicants for</h5>
        <a class="item-block item-block-flat" href="job-detail.php?jobdetail=<?php echo $data['jid'] ?>">
          <header>
            <img src="upload/<?php echo $data['cover_img']; ?>" alt="">
            <div class="hgroup">
              <h4> <?php echo $data['job_title']; ?> </h4>
              <h5>  <?php echo $data['c_name']; ?></h5>
            </div>
            <div class="header-meta">
              <span class="location"> <?php echo $data['location']; ?> </span>
              <span class="label label-success"> <?php echo $data['job_type']; ?> </span>
            </div>
          </header>
        </a>
      </div>
    </header>
    <!-- END Page header -->


    <!-- Main container -->
    <main>
      <section class="no-padding-top bg-alt">
        <div class="container">
          <div class="row">


            <!-- Candidate item -->
            <div class="col-xs-12 <?php echo $data['appid']; ?>" >
              <div class="item-block">
                <header>
                  <a href="resume-detail.php?detail=<?php echo $data['fid'] ?>"><img class="resume-avatar" src="upload/<?php echo $data['dev_img'] ?>" alt=""></a>
                  <div class="hgroup">
                    <h4>
                      <a href="resume-detail.php?detail=<?php echo $data['fid'] ?>"> <?php echo $data['name'] . " "; echo $data['surname'] ?> </a>
                      <select class="form-control selectpicker label-style">
                        <option data-content="<span class='label label-default'>New</span>" selected>New</option>
                        <option data-content="<span class='label label-warning'>Contacted</span>">Contacted</option>
                        
                        <option data-content="<span class='label label-success'>Hired</span>">Hired</option>
                       
                      </select>
                    </h4>
                    <h5><?php echo $data['head']; ?></h5>
                  </div>
                  <div class="header-meta">
                    <span class="location"> <?php echo $data['job_location']; ?> </span>
                    <span class="rate">$<?php echo $data['salary'] ?></span>
                  </div>
                </header>

                <footer>
                  <div class="status"><strong>Applied on:</strong> <?php echo $data['applied_at'] ?></div>

                  <div class="action-btn">
                    
                    <a class="btn btn-xs btn-gray"  href="message-new.php?message=<?php echo $data['id'] ?>">Contact</a>
                    <a class="btn btn-xs btn-danger delete" id="<?php echo $data['appid']; ?>">Delete</a>
                  </div>
                </footer>
              </div>
            </div>
            <!-- END Candidate item -->

          </div>
        </div>
      </section>
    </main>
    <!-- END Main container -->
    <?php } ?>

<script>
let delcandidate = document.querySelectorAll('.delete');
for (let i = 0; i < delcandidate.length; i++) {
  delcandidate[i].addEventListener('click',(e) => {
    e.preventDefault();
    let getid = delcandidate[i].getAttribute('id');
    const delphp = "job-candelete.php";
    let formdata = new FormData();
    formdata.append("getid",getid);
    fetch(delphp,{
      method:"post",
      body:formdata
    }).then((res) => res.json())
    .then((res) => {if (res.res) {
      toastr.success('You have deleted candidate successfully.');
      
      
    }})
    .catch((error) => {console.log(error);toastr.error('Error','Something Went Wrong')})

    
    let hasid = document.getElementsByClassName(getid);
    for (let h = hasid.length; h--;) {
      hasid[h].parentNode.removeChild(hasid[h]);
      
    }
  })
  
}

</script>



    <?php 
include_once 'includes/footer.php';
?>