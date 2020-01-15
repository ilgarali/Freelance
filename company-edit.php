     <? include('includes/header.php'); 
     include_once 'includes/co.php';
     ?>
    <form id="editForm" enctype="multipart/form-data">

      <!-- Page header -->
     <?php 
     $id = $_SESSION['id'];
     $edit = $_GET['edit'];
     $sql = "SELECT * FROM `company` left join users on company.user_id = users.id 
     where company.user_id = ? AND company.cid = ?"; 
     $stmt = $conn->prepare($sql);
     $stmt->execute([$id,$edit]);
     $data = $stmt->fetchAll();
     foreach ($data as $data) 
{

     
     ?>


      <header class="page-header">
        <div class="container page-name">
          <h1 class="text-center">Edit your company</h1>
          <p class="lead text-center">Create a profile for your company and put it online.</p>
        </div>

        <div class="container">

          <div class="row">
            <div class="col-xs-12">
              <div class="row">
                
                <div class="col-xs-12 col-sm-4 col-lg-2">
                  <div class="form-group">
                    <input type="file" id="img" name="img" class="dropify" data-default-file="upload/<?php echo $data['img'] ?>">
                    <span class="help-block">A square logo</span>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-8 col-lg-10">
                  <div class="form-group">
               
                    <input type="text" id="c_name" name="c_name"  class="form-control input-lg" value="<?php echo $data['c_name'] ?>">
                  </div>
                  <div class="form-group">
                    <input type="text" id="headline" name="headline" class="form-control" value="<?php echo $data['headline'] ?>">
                  </div>

                  <div class="form-group">
                    <textarea id="c_des" name="c_des" class="form-control" rows="3" ><?php echo $data['c_des'] ?></textarea>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xs-12">
              <div class="row">

                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    <input id="location" type="text" name="location" class="form-control" value="<?php echo $data['location'] ?>">
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select id="employer" name="employer" value="<?php echo $data['employer'] ?>" class="form-control selectpicker">
                      <option>0 - 9</option>
                      <option>10 - 99</option>
                      <option>100 - 999</option>
                      <option>1,000 - 9,999</option>
                      <option>10,000 - 99,999</option>
                      <option>100,000 - 999,999</option>
                    </select>
                    <span class="input-group-addon">Employer</span>
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
                    <select id="category" class="form-control selectpicker">
                      
                    <?php
                    $sql2 = "SELECT * FROM category";
                    $stmt2 =$conn->prepare($sql2);
                    $stmt2->execute();
                    $data2 = $stmt2->fetchAll();
                    foreach ($data2 as $data2) {
                      echo "<option class='option' id=".$data2['id'].">".$data2['category_name']."</option>";
                    }
                    ?>
                    
                      
                    </select>
                    <span class="input-group-addon">Categories</span>
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                    <input id="website" type="text" name="website" class="form-control" value="<?php echo $data['website'] ?>">
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                    <input id="founded" type="text" name="founded" class="form-control" value="<?php echo $data['founded'] ?>">
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input id="phone" type="text" name="phone" class="form-control" value="<?php echo $data['phone'] ?>">
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input id="email" type="text" name="email" class="form-control" value="<?php echo $data['email'] ?>">
                  </div>
                </div>

              </div>
            </div>


          </div>

       

        </div>
      </header>
      <!-- END Page header -->


      <!-- Main container -->
      <main>

            <!-- Company detail -->
        <section class=" bg-alt">
          <div class="container">

            <header class="section-header">
              <span>About</span>
              <h2>Company detail</h2>
              <p>Write about your company, culture, benefits of working there, etc.</p>
            </header>
            
            <textarea id="c_detail" name="c_detail" class="summernote-editor"><?php echo $data['c_detail'] ?></textarea>

          </div>
        </section>
        <!-- END Company detail -->
        <?php } ?>

        <!-- Submit -->
        <section>
          <div class="container">
            <header class="section-header">
              <span>Are you done?</span>
              <h2>Submit it</h2>
              <p>Please review your information once more and press the below button to put your company online.</p>
            </header>

            <p class="text-center"><button name="submit"class="btn btn-success btn-xl btn-round">Submit your company</button></p>
             <input type="hidden" name="id" id="edit" value="<?php echo $_GET['edit'] ?>">
          </div>
        </section>
        <!-- END Submit -->


      </main>
      <!-- END Main container -->

    </form>


<script>

const editForm = document.getElementById('editForm');
editForm.addEventListener('submit',function (e) { 
    e.preventDefault();
    const img = document.getElementById('img');
    const c_name = document.getElementById('c_name').value;
    const headline = document.getElementById('headline').value;
    const c_des = document.getElementById('c_des').value;
    const location = document.getElementById('location').value;
    const employer = document.getElementById('employer').value;
    const website = document.getElementById('website').value;
    const founded = document.getElementById('founded').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    const c_detail = document.getElementById('c_detail').value;
    const editid = document.getElementById('edit').value;
    
    let category = document.getElementById('category');
  
  let option = category.options[category.selectedIndex].getAttribute('id');
    const action = 'c_edit.php';
    const formData = new FormData();
    
    
 
  formData.append('img',img.files[0]);
    formData.append('c_name',c_name);
    formData.append('headline',headline);
    formData.append('c_des',c_des);
    formData.append('location',location);
    formData.append('employer',employer);
    formData.append('website',website);
    formData.append('founded',founded);
    formData.append('phone',phone);
    formData.append('email',email);
    formData.append('c_detail',c_detail);
    formData.append('editid',editid);
    formData.append('option',option);
    fetch(action,{
        method:'post',
        body:formData
    }).then((res)=> res.json())
    .then((res) => {if (res.success) {
        toastr.success('You have updated info successfully. You are redireecting to Company Mange page');
        setTimeout(() => {
      window.location.replace('company-manage.php')
    }, 2020);
       
       
    } })
    .catch((error) => {console.log(error); toastr.error('Error','Something Went Wrong')})
    



 });

</script>


    <? include 'includes/footer.php'; ?>