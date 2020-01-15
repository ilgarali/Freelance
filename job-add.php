<?php 
include 'includes/header.php';
include_once 'includes/co.php';
?>
    <!-- Page header -->
    <form id="jobAdd" class="my-5">
    <header class="page-header">
      <div class="container page-name">
        <h1 class="text-center">Add a new job</h1>
        <p class="lead text-center">Create a new vacancy for your company and put it online.</p>
      </div>

      <div class="container">

        <div class="row">
          <div class="form-group col-xs-12 col-sm-6">
            <input type="text" class="form-control input-lg" id="title" placeholder="Job title, e.g. Front-end developer">
          </div>

          <div class="form-group col-xs-12 col-sm-6">
            <select id="company" class="form-control selectpicker">

            <?php 
            $sesid = $_SESSION['id'];
            $sql="SELECT cid,c_name,`user_id` FROM company WHERE `user_id` = ? ";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$sesid]);
            $data=$stmt->fetchAll();
            foreach ($data as $data) {
              echo "<option id='".$data['cid']."'>" . $data['c_name'] ."</option>"; 
            }
            ?>
              
              
            </select>
            <a class="help-block" href="company-add.php">Add new company</a>
          </div>

          <div class="form-group col-xs-12">
            <textarea id="job_short" class="form-control" rows="3" placeholder="Short description"></textarea>
          </div>

          

          <div class="form-group col-xs-12 col-sm-6 col-md-4">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <input id="location" type="text" class="form-control" placeholder="Location, e.g. Melon Park, CA">
            </div>
          </div>

          <div class="form-group col-xs-12 col-sm-6 col-md-4">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
              <select id="job_type" class="form-control selectpicker">
                <option>Full time</option>
                <option>Part time</option>
                <option>Internship</option>
                <option>Freelance</option>
                <option>Remote</option>
              </select>
            </div>
          </div>

          <div class="form-group col-xs-12 col-sm-6 col-md-4">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-money"></i></span>
              <input id="salary" type="text" class="form-control" placeholder="Hourly Salary">
            </div>
          </div>

          <div class="form-group col-xs-12 col-sm-6 col-md-4">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
              <input id="working_hours" type="text" class="form-control" placeholder="Working hours, e.g. 40">
              <span class="input-group-addon">hours / week</span>
            </div>
          </div>

          <div class="form-group col-xs-12 col-sm-6 col-md-4">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-flask"></i></span>
              <input id="exprience" type="text" class="form-control" placeholder="Experience, e.g. 5">
              <span class="input-group-addon">Years</span>
            </div>
          </div>

          <div class="form-group col-xs-12 col-sm-6 col-md-4">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-certificate"></i></span>
              <select id="degree" class="form-control selectpicker" >
                <option>Postdoc</option>
                <option>Ph.D.</option>
                <option>Master</option>
                <option selected>Bachelor</option>
              </select>
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-6 col-md-4">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-certificate"></i></span>
              <select id="jobcategory" class="form-control selectpicker">
              <option selected>Select Job category</option>
                <option>Developer</option>
                <option>Designer</option>
                <option>Customer service</option>
                <option>Finance</option>
                <option>Healthcare</option>
                <option>Sale</option>
                <option>Marketing</option>
                <option>Information technology</option>
                <option>Others</option>
              </select>
            </div>
          </div>

        </div>

        <div class="button-group">
          <div class="action-buttons">
            <div class="upload-button">
              <button class="btn btn-block btn-primary">Choose a cover image</button>
              <input id="cover_img_file" type="file">
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

            <header class="section-header">
              <span>Description</span>
              <h2>Job detail</h2>
              <p>Write about your company, job description, skills required, benefits, etc.</p>
            </header>
            
            <textarea id="job_detail" class="summernote-editor"></textarea>

          </div>
        </section>
        <!-- END Job detail -->


        <!-- Submit -->
        <section class="bg-alt">
          <div class="container">
            <header class="section-header">
              <span>Are you done?</span>
              <h2>Submit Job</h2>
              <p>Please review your information once more and press the below button to put your job online.</p>
            </header>

            <p class="text-center"><button class="btn btn-success btn-xl btn-round">Submit your job</button></p>

          </div>
        </section>
        <!-- END Submit -->


    </main>
    </form>
    <!-- END Main container -->
<script>

 let jobAdd = document.getElementById('jobAdd');
 jobAdd.addEventListener('submit',(e) => {
  e.preventDefault();
  let title = document.getElementById('title').value;
  let company = document.getElementById('company');

  let option = company.options[company.selectedIndex].getAttribute('id');
  let job_short = document.getElementById('job_short').value;

  let job_type = document.getElementById('job_type').value;
  let salary = document.getElementById('salary').value;
  let location = document.getElementById('location').value;
 
  
  let working_hours =document.getElementById('working_hours').value;
  
  let exprience = document.getElementById('exprience').value;
  let degree =document.getElementById('degree').value;

  
  let job_detail = document.getElementById('job_detail').value;
  let cover_img_file = document.getElementById('cover_img_file');
  let user_id = "<?php echo $_SESSION['id'] ?>";
  let jobcategory = document.getElementById('jobcategory').value;
  const addForm = new FormData();
  const jobAddPHP = 'jobadd.php';

  addForm.append('title',title);
  addForm.append('jobcategory',jobcategory);
  addForm.append('option',option);
  addForm.append('job_short',job_short);

  addForm.append('job_type',job_type);
  addForm.append('salary',salary);
  addForm.append('working_hours',working_hours);
  addForm.append('exprience',exprience);

  addForm.append('location',location);
  addForm.append('degree',degree);
  addForm.append('job_detail',job_detail);
  addForm.append('cover_img_file',cover_img_file.files[0]);
  addForm.append('user_id',user_id);
  
  fetch(jobAddPHP,{
    method:'post',
    body:addForm
  }).then((res)=> res.json())
  .then((res) =>{ if (res.success) {
    toastr.success('You have added job info successfully.You are redirecting to company-manage page');
    setTimeout(() => {
      window.location.replace('job-manage.php')
    }, 2020);
  }} )
  .catch((error)=> {console.log(error);toastr.error('Error','Something Went Wrong')})



 });

</script>


<?php 
include 'includes/footer.php';

?>