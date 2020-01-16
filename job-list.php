<?php include_once 'includes/header.php' ?>

    <!-- Page header -->
    <header class="page-header bg-img" style="background-image: url(upload/fr.jpg);">
      <div class="container page-name my-5">
        <h1 class="text-center">Browse jobs</h1>
        <p class="lead text-center">Use following search box to find jobs that fits you better</p>
      </div>

      <div class="container">
        

          <div class="row">
            <div class="form-group col-xs-12 col-sm-4">
              <input type="text" id="job_title" class="form-control" placeholder="Keyword: job title, skills, or company">
            </div>

            <div class="form-group col-xs-12 col-sm-4">
              <input type="text" id="job_location" class="form-control" placeholder="Location: city, state or zip">
            </div>

            <div class="form-group col-xs-12 col-sm-4">
              <select id="selectcategory" class="form-control selectpicker" >
                <option selected>All categories</option>
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

          <div class="button-group">
            <div class="action-buttons">
              <button id="filter" class="btn btn-primary">Apply filter</button>
            </div>
          </div>

        

      </div>

    </header>
    <!-- END Page header -->


    <!-- Main container -->
    <main>
      <section class="no-padding-top bg-alt">
        <div class="container">
          <div class="row">

            


            <?php 
            $limit = 4;
            $sql2= "SELECT * FROM job_posts ORDER BY jid DESC";
            $stmt2 =$conn->prepare($sql2);
            $stmt2->execute();
            $total_result = $stmt2->rowCount();
            $totalpage=ceil($total_result/$limit);
            if (!isset($_GET['page'])) {
              $page=1;
            }else{
              $page=$_GET['page'];
            }
            $starting_limit = ($page-1) * $limit;

            $sql = "SELECT * FROM job_posts left join company on job_posts.company_id =company.cid WHERE job_posts.status =1 
            AND job_posts.is_filled = 0 ORDER BY jid 
            DESC LIMIT $starting_limit, $limit";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $data){

            
            ?>

            <!-- Job item -->
            <div class="col-xs-12 search">
              <a class="item-block" href="job-detail.php?jobdetail=<?php echo $data['jid'] ?>">
                <header>
                  <img src="upload/<?php echo $data['cover_img'] ?>" alt="">
                  <div class="hgroup">
                    <h4><?php echo $data['job_title'] ?></h4>
                    <h5> <?php echo $data['c_name'] ?> <span class="label label-success"> <?php echo $data['job_type'] ?> </span></h5>
                  </div>
                  <time datetime="2016-03-10 20:00"> <?php echo $data['created_at'] ?> </time>
                </header>

                <div class="item-body">
                  <p><?php echo substr($data['job_short'],0,333) ?></p>
                </div>

                <footer>
                  <ul class="details cols-3">
                    <li>
                      <i class="fa fa-map-marker"></i>
                      <span> <?php echo $data['job_location'] ?> </span>
                    </li>

                    <li>
                      <i class="fa fa-money"></i>
                      <span> $<?php echo $data['salary'] ?> / hourly </span>
                    </li>

                    <li>
                      <i class="fa fa-certificate"></i>
                      <span> <?php echo $data['degree'] ?> </span>
                    </li>
                  </ul>
                </footer>
              </a>
            </div>
            <!-- END Job item -->
<?php } ?>

          
           

            

            

          </div>


          <!-- Page navigation -->
          <nav class="text-center">
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <i class="ti-angle-left"></i>
                </a>
              </li>
              <?php for ($page=1; $page <= $totalpage; $page++) { 
        # code...
       ?>
                <li><a href="<?php echo "?page=$page"; ?>"><?php  echo $page; ?></a></li>
        <?php }?>
              <li>
                <a href="#" aria-label="Next">
                  <i class="ti-angle-right"></i>
                </a>
              </li>
            </ul>
          </nav>
          <!-- END Page navigation -->

        </div>
      </section>
    </main>
    <!-- END Main container -->
    <script>
      let filter = document.getElementById("filter");
      filter.addEventListener("click", (e) => {
        e.preventDefault();
        let job_title = document.getElementById("job_title").value;
        let job_location = document.getElementById("job_location").value;
        let selectcategory = document.getElementById("selectcategory").value;
    
        
        

        const findjob = "findjob.php";
        let formData = new FormData();
        


        formData.append("title",job_title);
        formData.append("location",job_location);
        formData.append("selectcategory",selectcategory);
        fetch(findjob,{
          method:"post",
          body:formData
        }).then((res) => res.json())
        .then((res) => insertRes(res))
        .catch((error) => console.log(error))

      });


        function insertRes(res) {


let search = document.querySelectorAll('.search');

for (let d = 0; d < search.length; d++) {
    search[d].innerHTML='';
    
  }
let jid,cover_img,job_title,location,job_type,job_short,created_at,job_salary,job_degree;
res.forEach(element => {
   jid = element.jid;
   cover_img = element.cover_img;
   job_title = element.job_title;
   job_location = element.job_location;
   job_type = element.job_type;
   job_short = element.job_short;
   created_at = element.created_at;
   job_salary = element.salary;
   job_degree = element.degree;
   let d = 0;


  search[d].innerHTML += `  
  <a class="item-block" href="job-detail.php?jobdetail=${jid}">
                <header>
                  <img src="upload/${cover_img}" alt="">
                  <div class="hgroup">
                    <h4>${job_title}</h4>
                    <h5> <span class="label label-success"> ${job_type} </span></h5>
                  </div>
                  <time datetime="2016-03-10 20:00"> ${created_at} </time>
                </header>

                <div class="item-body">
                  <p>${job_short.substr(0,333)}</p>
                </div>

                <footer>
                  <ul class="details cols-3">
                    <li>
                      <i class="fa fa-map-marker"></i>
                      <span> ${job_location}</span>
                    </li>

                    <li>
                      <i class="fa fa-money"></i>
                      <span> $${job_salary} / hourly </span>
                    </li>

                    <li>
                      <i class="fa fa-certificate"></i>
                      <span> ${job_degree} </span>
                    </li>
                  </ul>
                </footer>
              </a>
     
     `;
     d++;


});





}

    </script>

    <?php include_once 'includes/footer.php' ?>
