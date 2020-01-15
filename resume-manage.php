<?php include('includes/header.php'); 
   include_once 'includes/fr.php';
?>
    <!-- END Navigation bar -->


    <!-- Page header -->
    <header class="page-header bg-img size-lg" style="background-image: url(assets/img/free.jpg)">
      <div class="container no-shadow">
        <h1 class="text-center">Manage your resumes</h1>
        <p class="lead text-center">Here's the list of your created resumes. You can edit or delete them, or even add a new one.</p>
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
              <a class="btn btn-primary btn-sm" href="addresume.php">Add new resume</a>
            </div>

<?php 
$id = $_SESSION['id'];
$sql = "SELECT * FROM `freelancer` left join users on freelancer.user_id = users.id where freelancer.user_id = ? ORDER BY freelancer.fid DESC"; 
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$data = $stmt->fetchAll();
foreach ($data as $data) {
  # code...

?>
            <!-- Resume item -->
            <div class="col-xs-12 <?php echo  $data['fid']?>">
              <div class="item-block">
                <header>
                  <a href="resume-detail.php?detail=<?php echo $data['fid'] ?>"><img class="resume-avatar" 
                  src="upload/<?php echo $data['dev_img'] ?>" alt=""></a>
                  <div class="hgroup">
                    <h4><a href="resume-detail.php?detail=<?php echo $data['fid'] ?>"><?php echo $data['name']; ?></a></h4>
                    <h5><?php echo $data['head']; ?></h5>
                  </div>
                  <div class="header-meta">
                    <span class="location"><?php echo $data['location']; ?></span>
                    <span class="rate">$<?php echo $data['salary']; ?></span>
                  </div>
                </header>

                <footer>
                  <p class="status"><strong>Updated on:</strong> <?php echo $data['created_at'] ?></p>

                  <div class="action-btn">
                    
                    <a class="btn btn-xs btn-gray" href="resume-edit.php?edit=<?php echo  $data['fid']; ?>">Edit</a>
                    <a class="btn btn-xs btn-danger del" id="<?php echo  $data['fid']; ?>">Delete</a>
                  </div>
                </footer>
              </div>
            </div>
            <!-- END Resume item -->
<?php }
 ?>

         


          </div>
        </div>
      </section>
    </main>
    <!-- END Main container -->
    <script>



const deleteid = document.querySelectorAll('.del');
for (let i = 0; i < deleteid.length; i++) {
  deleteid[i].addEventListener('click',function (e) { 
    e.preventDefault();
    let hasid = this.getAttribute('id');
   console.log(hasid);
   
    
    const formData = new FormData();
    formData.append('id',hasid);
    const delphp = 'resaction.php';
    fetch(delphp,{
      method:"post",
      body: formData
    }).then((res) => res.json())
    .then((res) => { 
     
     if(res.success){
      toastr.success('You have deleted resume successfully');
    }})
    .catch((error) => {console.log(error); toastr.error('Error','Something Went Wrong')})
    let hasclass = document.getElementsByClassName(hasid);
       
   
    for (let d = hasclass.length; d--;) {         
      hasclass[d].parentNode.removeChild(hasclass[d]);          
    }

    

});
  
}

</script>

   <?php include('includes/footer.php'); ?>
