<? include 'includes/header.php';
include_once 'includes/co.php';
?>
    <form id="myForm">

      <!-- Page header -->
      <header class="page-header">
        <div class="container page-name">
          <h1 class="text-center">Add your company</h1>
          <p class="lead text-center">Create a profile for your company and put it online.</p>
        </div>

        <div class="container">

          <div class="row">
            <div class="col-xs-12">
              <div class="row">
                
                <div class="col-xs-12 col-sm-4 col-lg-2">
                  <div class="form-group">
                    <input id="img" type="file" name="img" class="dropify" data-default-file="assets/img/logo-default.png">
                    <span class="help-block">A square logo</span>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-8 col-lg-10">
                  <div class="form-group">
               
                    <input type="text" id="c_name" class="form-control input-lg" placeholder="Comapny name">
                  </div>
                  <div class="form-group">
                    <input type="text" id="headline" class="form-control" placeholder="Headline (e.g. Internet and computer software)">
                  </div>

                  <div class="form-group">
                    <textarea id="c_des" class="form-control" rows="3" placeholder="Short description"></textarea>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xs-12">
              <div class="row">

                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    <input type="text" id="location" class="form-control" placeholder="Location, e.g. Melon Park, CA">
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select id="employer" class="form-control selectpicker">
                      <option>0 - 9</option>
                      <option selected>10 - 99</option>
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
                    <input type="text" id="website" class="form-control" placeholder="Website address">
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                    <input type="text" id="founded" class="form-control" placeholder="Founded on, e.g. 2013">
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" id="phone" class="form-control" placeholder="Phone number">
                  </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="text" id="email" class="form-control" placeholder="Email address">
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
            
            <textarea id="c_detail" class="summernote-editor"></textarea>

          </div>
        </section>
        <!-- END Company detail -->


        <!-- Submit -->
        <section>
          <div class="container">
            <header class="section-header">
              <span>Are you done?</span>
              <h2>Submit it</h2>
              <p>Please review your information once more and press the below button to put your company online.</p>
            </header>

            <p class="text-center"><button id="send" name="submit"class="btn btn-success btn-xl btn-round">Submit your company</button></p>

          </div>
        </section>
        <!-- END Submit -->


      </main>
      <!-- END Main container -->

    </form>
  <script>




let myForm = document.getElementById('myForm');
myForm.addEventListener('submit',(e) => {
  e.preventDefault();
  let img = document.getElementById('img');
  let c_name = document.getElementById('c_name').value;
  
  let headline = document.getElementById('headline').value;
  let c_des = document.getElementById('c_des').value;
  
  let location = document.getElementById('location').value;
  let employer = document.getElementById('employer').value;


  let category = document.getElementById('category');
  
 let option = category.options[category.selectedIndex].getAttribute('id');



  let website = document.getElementById('website').value;
  let founded = document.getElementById('founded').value;
  let phone = document.getElementById('phone').value;
  let email = document.getElementById('email').value;
  let c_detail = document.getElementById('c_detail').value;

  
  const formData = new FormData();
formData.append('img',img.files[0]);
formData.append('c_name',c_name);

formData.append('headline',headline);
formData.append('c_des',c_des);

formData.append('location',location);
formData.append('employer',employer);

formData.append('option',option);
formData.append('website',website);

formData.append('founded',founded);
formData.append('phone',phone);

formData.append('email',email);
formData.append('c_detail',c_detail);

  
  const targetPHP = 'c_add.php';

  fetch(targetPHP,{
    method:"post",
    body:formData
    
  }).then((res)=>res.json())
  .then((res) => {if (res.success) {
    toastr.success('You have added company info successfully.You are redirecting to company-manage page');
    setTimeout(() => {
          window.location.replace("company-manage.php");
        }, 2020);
  }}
  )
  .catch((error)=>{console.log(error);toastr.error('Error','Something Went Wrong')})


});
  
  
  </script>


    <? include 'includes/footer.php'; ?>