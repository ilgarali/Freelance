
<?php 
include 'includes/header.php';
include_once 'includes/co.php';

?>

<!-- Page header -->
<header class="page-header bg-img size-lg my-" style="background-image: url(upload/hire.jpg); background-size: auto;background-repeat:no-repeat;  background-position: center top; ">
  <div class="container no-shadow" style="margin-top:105px;">
    <h1 class="text-center">Manage jobs</h1>
    <p class="lead text-center">Here's the list of your submitted jobs. You can edit or delete them, or even add a new one.</p>
  </div>
</header>
<!-- END Page header -->


<!-- Main container -->
<main>
  <section class="no-padding-top bg-alt">
    <div class="container">
      <div class="row">

        <div class="col-xs-12 text-right">
          <br>
          <a class="btn btn-primary btn-sm" href="job-add.php">Add new job</a>
        </div>


    <?php 
    
    $sessid = $_SESSION['id']; 
  
    
    



    $status = 1;
    $sql="SELECT * FROM job_posts left join users on job_posts.user_id = users.id 
    left join company on job_posts.company_id = company.cid 
    WHERE job_posts.user_id = $sessid AND job_posts.status = 1 ORDER BY job_posts.jid DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$sessid,$status]);
    $data=$stmt->fetchAll();
    
foreach ($data as $data) {
# code...

    
    ?>


        <!-- Job detail -->
        <div class="col-xs-12 <?php echo $data['jid'] ?>">
          <div class="item-block">
            <header>
              <a href="company-detail.php?detail=<?php echo $data['cid'] ?>"><img src="upload/<?php  echo $data['cover_img'] ?>" alt=""></a>
              <div class="hgroup">
                <h4><a href="job-detail.php?jobdetail=<?php echo $data['jid'] ?>"> <?php echo $data['job_title'] ?> </a></h4>
                <h5><a href="company-detail.php?detail=<?php echo $data['cid'] ?> "> <?php echo $data['c_name'] ?> </a></h5>
              </div>
              <div class="header-meta">
                <span class="location"><?php echo $data['job_location'] ?></span>
                <time datetime="2016-03-10 20:00"><?php echo $data['created_at'] ?></time>
              </div>
            </header>

            <footer>
              <!-- <p class="status"><strong>Status:</strong> Expires on 14 April</p> -->

              <div class="action-btn">
                <a class="btn btn-xs btn-gray" href="jobedit.php?jobedit=<?php echo $data['jid'] ?>">Edit</a>
                <?php 
                if ($data['is_filled'] != 1) {
                  echo ' <a class="btn btn-xs btn-success makefilled '. $data['jid'].' " id="'. $data['jid'].'"  href="#">Mark filled</a>';
                }
                
                ?>
                <a class="btn btn-xs btn-danger delete" id="<?php echo $data['jid'] ?>">Delete</a>
              </div>
            </footer>
          </div>
        </div>
        <!-- END Job detail -->

        <?php  } ?>
    


      
      </div>
    </div>
  </section>
</main>
<!-- END Main container -->

<script>
let deletejob = document.querySelectorAll('.delete');
for (let i = 0; i < deletejob.length; i++) {
deletejob[i].addEventListener('click',(e)=>{
e.preventDefault();
let getid = deletejob[i].getAttribute('id');
const jobDelete = 'job-delete.php';
let formData = new FormData();

formData.append('deletejob',getid);

fetch(jobDelete,{
  method:'post',
  body:formData
}).then((res) => res.json())
.then((res)=> {if (res.success) {
  toastr.success('You have deleted job post successfully','Success');
}})
.catch((error) => console.log(error))
let hasclass = document.getElementsByClassName(getid);
  
    

    for (let d = hasclass.length; d--;) {         
      hasclass[d].parentNode.removeChild(hasclass[d]);          
    }


});


}


let makefilled = document.querySelectorAll('.makefilled');


for (let j = 0; j < makefilled.length; j++) {
makefilled[j].addEventListener('click',(e) => {
e.preventDefault();
let fillid =  makefilled[j].getAttribute('id');
const jobfill = 'jobfill.php';
let makeFill = new FormData();
const filled = 1;
makeFill.append('fillid',fillid);
makeFill.append('is_filled',filled);

fetch(jobfill,{
method:'post',
body:makeFill
}).then((res)=> res.json())
.then((data)=>{ if (data.success) {
toastr.success('You have marked job filled successfully','Success');
}
})
.catch((error)=>{console.log(error);
toastr.error('Error','Something Went Wrong')
})
let hasclass = document.getElementsByClassName(fillid);
let displaynone = document.getElementById(fillid);
displaynone.style.display='none';




})



}



</script>


<?php 
include 'includes/footer.php';
?>