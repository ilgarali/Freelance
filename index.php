<?php include 'includes/header.php';

?>


<!-- Site header -->
<header class="site-header size-lg text-center" style="background-image: url(assets/img/free.jpg)">
  <div class="container">
    <div class="col-xs-12">
      <br><br>
      <h2>We offer <mark>1,259</mark> job vacancies right now!</h2>
      <h5 class="font-alt">Find your desire one in a minute</h5>
      <br><br><br>
      <div class="header-job-search">
        <div class="input-keyword">
          <input type="text" id="title" class="form-control" placeholder="Job title, skills, or company">
        </div>

        <div class="input-location">
          <input type="text" id="location" class="form-control" placeholder="City, state or zip">
        </div>

        <div class="btn-search">
          <button class="btn btn-primary" id="find" type="submit">Find jobs</button>
          <a href="job-list.php">Advanced Job Search</a>
        </div>
      </div>
    </div>

  </div>
</header>
<!-- END Site header -->


<!-- Main container -->
<main>



  <!-- Recent jobs -->
  <section>
    <div class="container">
      <header class="section-header">
        <span>Latest</span>
        <h2>Recent jobs</h2>
      </header>

      <div class="row item-blocks-connected">

        <!-- Job item -->
        <?php
        $sql = "SELECT * FROM job_posts left join company on job_posts.company_id =company.cid WHERE job_posts.status =1 
            AND job_posts.is_filled = 0 ORDER BY jid  DESC LIMIT 5";

        $stmt = $conn->prepare($sql);
        $data = $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $data) {
          # code...


        ?>
          <div class="col-xs-12 search">
            <a class="item-block" href="job-detail.php?jobdetail=<?php echo $data['jid'] ?>">
              <header>
                <img src="upload/<?php echo $data['cover_img'] ?>" alt="">
                <div class="hgroup">
                  <h4><?php echo $data['job_title'] ?></h4>
                  <h5><?php echo $data['c_name'] ?></h5>
                </div>
                <div class="header-meta">
                  <span class="location"><?php echo $data['job_location'] ?></span>
                  <span class="label label-success"><?php echo $data['job_type'] ?></span>
                </div>
              </header>
            </a>
          </div>
          <!-- END Job item -->

        <?php } ?>



      </div>

      <br><br>
      <p class="text-center"><a class="btn btn-info" href="job-list.php">Browse all jobs</a></p>
    </div>
  </section>
  <!-- END Recent jobs -->


  <!-- Facts -->
  <section class="bg-img bg-repeat no-overlay section-sm" style="background-image: url(assets/img/bg-pattern.png)">
    <div class="container">

      <div class="row">
        <div class="counter col-md-3 col-sm-6">
          <p><span data-from="0" data-to="6890"></span>+</p>
          <h6>Jobs</h6>
        </div>

        <div class="counter col-md-3 col-sm-6">
          <p><span data-from="0" data-to="1200"></span>+</p>
          <h6>Members</h6>
        </div>

        <div class="counter col-md-3 col-sm-6">
          <p><span data-from="0" data-to="36800"></span>+</p>
          <h6>Resume</h6>
        </div>

        <div class="counter col-md-3 col-sm-6">
          <p><span data-from="0" data-to="15400"></span>+</p>
          <h6>Company</h6>
        </div>
      </div>

    </div>
  </section>
  <!-- END Facts -->


  <!-- How it works -->
  <section>
    <div class="container">

      <div class="col-sm-12 col-md-6">
        <header class="section-header text-left">
          <span>Workflow</span>
          <h2>How it works</h2>
        </header>

        <p class="lead">Pellentesque et pulvinar orci. Suspendisse sed euismod purus. Pellentesque nunc ex, ultrices eu enim non, consectetur interdum nisl. Nam congue interdum mauris, sed ultrices augue lacinia in. Praesent turpis purus, faucibus in tempor vel, dictum ac eros.</p>
        <p>Nulla quis felis et orci luctus semper sit amet id dui. Aenean ultricies lectus nunc, vel rhoncus odio sagittis eu. Sed at felis eu tortor mattis imperdiet et sed tortor. Nullam ac porttitor arcu. Vivamus tristique elit id tempor lacinia. Donec auctor at nibh eget tincidunt. Nulla facilisi. Nunc condimentum dictum mattis.</p>


        <br><br>
        <a class="btn btn-primary" href="page-typography.html">Learn more</a>
      </div>

      <div class="col-sm-12 col-md-6 hidden-xs hidden-sm">
        <br>
        <img class="center-block" src="assets/img/how-it-works.png" alt="how it works">
      </div>

    </div>
  </section>
  <!-- END How it works -->


  <!-- Newsletter -->
  <section class="bg-img text-center" style="background-image: url(assets/img/bg-facts.jpg)">
    <div class="container">
      <h2><strong>Subscribe</strong></h2>
      <h6 class="font-alt">Get weekly top new jobs delivered to your inbox</h6>
      <br><br>
      <form class="form-subscribe" >
        <div class="input-group">
          <input type="text" class="form-control input-lg" placeholder="Your eamil address">
          <span class="input-group-btn">
            <button class="btn btn-success btn-lg" type="submit">Subscribe</button>
          </span>
        </div>
      </form>
    </div>
  </section>
  <!-- END Newsletter -->


</main>
<!-- END Main container -->


<script>

  let find = document.getElementById('find');
  find.addEventListener('click', (e) => {
    e.preventDefault();
    let location = document.getElementById('location').value;
    let title = document.getElementById('title').value;
   


    const findindex = "findindex.php";
    let formData = new FormData();
    formData.append("location", location);
    formData.append("title", title);
    fetch(findindex, {
  method: 'POST',
  body: formData,
})
.then((response) => response.json())
.then((result) => {
 insertRes(result);
})
.catch((error) => {
  console.error('Error:', error);
});
    

        });





  
  function insertRes(res) {


let search = document.querySelectorAll('.search');

for (let d = 0; d < search.length; d++) {
    search[d].innerHTML='';
    
  }

res.forEach(element => {
  let jid = element.jid;
  let cover_img = element.cover_img;
  let job_title = element.job_title;
  let job_location = element.job_location;
  let job_type = element.job_type;
  let job_short = element.job_short;
  let d = 0;
 
  
  

  search[d].innerHTML += `  

      <a class="item-block" href="job-detail.php?jobdetail=${jid}">
        <header>
          <img src="upload/${cover_img}" alt="">
          <div class="hgroup">
            <h4>${job_title}</h4>
            <h4>${job_short.substr(0,100)}</h4>
          </div>
          <div class="header-meta">
            <span class="location">${job_location}</span>
            <span class="label label-success">${job_type}</span>
          </div>
        </header>
      </a>
  
     
     `;

d++;

  


});


}

</script>

<?php include 'includes/footer.php'; ?>