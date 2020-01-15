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
              <select class="form-control selectpicker" multiple>
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


            <div class="form-group col-xs-12 col-sm-4">
              <h6>Contract</h6>
              <div class="checkall-group">
                <div class="checkbox">
                  <input type="checkbox" id="contract1" name="contract" checked>
                  <label for="contract1">All types</label>
                </div>

                <div class="checkbox">
                  <input type="checkbox" id="contract2" name="contract">
                  <label for="contract2">Full-time <small>(354)</small></label>
                </div>

                <div class="checkbox">
                  <input type="checkbox" id="contract3" name="contract">
                  <label for="contract3">Part-time <small>(284)</small></label>
                </div>

                <div class="checkbox">
                  <input type="checkbox" id="contract4" name="contract">
                  <label for="contract4">Internship <small>(169)</small></label>
                </div>

                <div class="checkbox">
                  <input type="checkbox" id="contract5" name="contract">
                  <label for="contract5">Freelance <small>(480)</small></label>
                </div>
              </div>
            </div>


            <div class="form-group col-xs-12 col-sm-4">
              <h6>Hourly rate</h6>
              <div class="checkall-group">
                <div class="checkbox">
                  <input type="checkbox" id="rate1" name="rate" checked>
                  <label for="rate1">All rates</label>
                </div>

                <div class="checkbox">
                  <input type="checkbox" id="rate2" name="rate">
                  <label for="rate2">$0 - $50 <small>(364)</small></label>
                </div>

                <div class="checkbox">
                  <input type="checkbox" id="rate3" name="rate">
                  <label for="rate3">$50 - $100 <small>(684)</small></label>
                </div>

                <div class="checkbox">
                  <input type="checkbox" id="rate4" name="rate">
                  <label for="rate4">$100 - $200 <small>(195)</small></label>
                </div>

                <div class="checkbox">
                  <input type="checkbox" id="rate5" name="rate">
                  <label for="rate5">$200+ <small>(39)</small></label>
                </div>
              </div>
            </div>


            <div class="form-group col-xs-12 col-sm-4">
              <h6>Academic degree</h6>
              <div class="checkall-group">
                <div class="checkbox">
                  <input type="checkbox" id="degree1" name="degree" checked>
                  <label for="degree1">All degrees</label>
                </div>

                <div class="checkbox">
                  <input type="checkbox" id="degree2" name="degree">
                  <label for="degree2">Associate degree <small>(216)</small></label>
                </div>

                <div class="checkbox">
                  <input type="checkbox" id="degree3" name="degree">
                  <label for="degree3">Bachelor's degree <small>(569)</small></label>
                </div>

                <div class="checkbox">
                  <input type="checkbox" id="degree4" name="degree">
                  <label for="degree4">Master's degree <small>(439)</small></label>
                </div>

                <div class="checkbox">
                  <input type="checkbox" id="degree5" name="degree">
                  <label for="degree5">Doctoral degree <small>(84)</small></label>
                </div>
              </div>
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

            <div class="col-xs-12">
              <br>
              <h5>We found <strong>357</strong> matches, you're watching <i>10</i> to <i>20</i></h5>
            </div>


            <?php 
            $limit = 4;
            $sql2= "SELECT * FROM job_posts ORDER BY jid DESC";
            $stmt2 =$conn->prepare($sql2);
            $stmt2->execute();
            $total_result = $stmt2->rowCount();
            $page=ceil($total_result/$limit);
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
              <?php for ($page=1; $page <= $total_result; $page++) { 
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

        const findjob = "findindex.php";
        let formData = new FormData();
        formData.append("title",job_title);
        formData.append("location",job_location);

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
let jid,cover_img,job_title,location,job_type,job_short;
res.forEach(element => {
   jid = element.jid;
   cover_img = element.cover_img;
   job_title = element.job_title;
   job_location = element.job_location;
   job_type = element.job_type;
   job_short = element.job_short;
   let d = 0;


  search[d].innerHTML += `  

      <a class="item-block" href="job-detail.php?jobdetail=${jid}">
        <header>
          <img src="upload/${cover_img}" alt="">
          <div class="hgroup">
            <h4>${job_title}</h4>
            <h4>${job_short.substr(0,150)}</h4>
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

    <?php include_once 'includes/footer.php' ?>
