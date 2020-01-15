<?php 
include 'includes/header.php';
include_once 'includes/co.php';

?>

    <!-- Page header -->
    <header class="page-header bg-img size-lg" style="background-image: url(assets/img/free.jpg)">
      <div class="container no-shadow">
        <h1 class="text-center">Manage companies</h1>
        <p class="lead text-center">Here's the list of your registered companies. You can edit or delete them, or even add a new one.</p>
      </div>
    </header>
    <!-- END Page header -->


    <!-- Main container -->
    <main>
      <section class="no-padding-top bg-alt">
        <div class="container">
          <div class="row item-blocks-condensed">

            <div class="col-xs-12 text-right">
              <br>
              <a class="btn btn-primary btn-sm" href="company-add.php">Add new company</a>
            </div>

            <!-- Company item -->
            <?php 
            $c_id = $_SESSION['id'];
           
            $sql ="SELECT *  FROM `company` left join users on company.user_id = users.id  WHERE company.user_id = $c_id ORDER BY cid DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach ($data as $data) {
              # code...
           
            ?>
            <div class="col-xs-12 <?php echo $data['cid']; ?>">
              <div class="item-block">
                <header>
                  <a href="company-detail.php?detail=<?php echo $data['cid']; ?>"><img src="upload/<?php echo $data['img'] ?>" alt=""></a>
                  <h5><?php echo $data['c_name'] ?></h5>
                  <div class="hgroup">
                  
                    <h4><a href="company-detail.php?detail=<?php echo $data['cid']; ?>"><?php echo $data['headline'] ?></a></h4>
                    <h5> <?php $x = substr($data['c_des'],0,150); echo $x;  ?><a href="company-detail.html#open-positions">
                      </a></h5>
                  </div>
                  <div class="action-btn">
                    <a class="btn btn-xs btn-gray" href="company-edit.php?edit=<?php echo $data['cid']; ?>">Edit</a>
                    <a class="btn btn-xs btn-danger delete"  id="<?php echo $data['cid']; ?>" href="#">Delete</a>
                  </div>
                </header>
              </div>
            </div>
            <!-- END Company item -->
            <?php  } ?>

         
        




          </div>
        </div>
      </section>
    </main>
    <!-- END Main container -->
<script>

const deleteid = document.querySelectorAll('.delete');
for (let i = 0; i < deleteid.length; i++) {
  deleteid[i].addEventListener('click',function (e) { 
    e.preventDefault();
    let hasid =  deleteid[i].getAttribute('id');
    const formData = new FormData();
    formData.append('id',hasid);
    const delphp = 'company-del.php';
    fetch(delphp,{
      method:"post",
      body: formData
    }).then((res) => res.json())
    .then((res) => { 
     
     if(res.success){
      toastr.success('You have deleted company successfully');
    }})
    .catch((error) => {console.log(error); toastr.error('Error','Something Went Wrong')})
    let hasclass = document.getElementsByClassName(hasid);
       
    
    
    for (let d = hasclass.length; d--;) {         
      hasclass[d].parentNode.removeChild(hasclass[d]);          
    }

    

});
  
}


</script>

    <?php 
include 'includes/footer.php';


?>