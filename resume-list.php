<?php include_once 'includes/header.php' ?>


    <!-- Page header -->
    <header class="page-header bg-img" style="background-image: url(upload/fr.jpg);">
      <div class="container page-name">
        <h1 class="text-center">Browse resumes</h1>
        <p class="lead text-center">Use following search box to find resumes that fits your position better</p>
      </div>

      <div class="container">
        <form action="#">

          <div class="row">
            <div class="form-group col-xs-12 col-sm-4">
              <input type="text" id="keyword" class="form-control" placeholder="Keyword: name, skills, or tags">
            </div>

            <div class="form-group col-xs-12 col-sm-4">
              <input type="text" id="location" class="form-control" placeholder="Location: city, state or zip">
            </div>

           

          </div>

          <div class="button-group">
            <div class="action-buttons">
              <button class="btn btn-primary" id="filter">Apply filter</button>
            </div>
          </div>

        </form>

      </div>

    </header>
    <!-- END Page header -->


    <!-- Main container -->
    <main>
      <section class="no-padding-top bg-alt">
        <div class="container">
          <div class="row">

            <?php 
            
            $limit = 5;
            $sql = "SELECT * FROM freelancer ORDER BY fid DESC";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $total_post = $stmt->rowCount();
            $total_pages = ceil($total_post/$limit);
            if (!isset($_GET['page'])) {
              $page=1;
            }else{
              $page=$_GET['page'];
            }
            $starting_limit =($page - 1) *$limit ;
            
            $sql2 = "SELECT *,CONCAT(`name`,' ',surname) as fullname FROM freelancer left join users on freelancer.user_id = users.id ORDER BY fid DESC LIMIT $starting_limit,$limit ";
            $stmt2= $conn->prepare($sql2);
            $stmt2->execute();
            $data=$stmt2->fetchALl();
            
           
            ?>
            
            <!-- Resume detail -->
            <div class="col-xs-12 search">
              <a class="item-block" href="resume-detail.php?detail=<?php echo $data[0]['fid'] ?>">
                <header>
                  <img class="resume-avatar" src="upload/<?php echo $data[0]['dev_img'] ?>" alt="">
                  <div class="hgroup">
                    <h4><?php echo $data[0]['fullname'] ?></h4>
                    <h5> <?php echo $data[0]['head'] ?> </h5>
                  </div>
                </header>

                <div class="item-body">
                  <p><?php echo $data[0]['description'] ?></p>

                  <div class="tag-list">
                  <?php $tag=explode(',',$data[0]['tags']); foreach ($tag as $tag) {
                      # code...
                    ?>
                    <span><?php echo $tag; ?> </span>
                   <?php  } ?>
                  </div>
                </div>

                <footer>
                  <ul class="details cols-3">
                    <li>
                      <i class="fa fa-map-marker"></i>
                      <span><?php echo $data[0]['location'] ?> </span>
                    </li>

                    <li>
                      <i class="fa fa-money"></i>
                      <span>$<?php echo $data[0]['salary'] ?>  / hour</span>
                    </li>

                    <li>
                      <i class="fa fa-certificate"></i>
                      <span><?php echo $data[0]['major'] ?> </span>
                    </li>
                  </ul>
                </footer>
              </a>
            </div>
            <!-- END Resume detail -->
          </div>

          <div class="row">
            <!-- Resume detail -->
            <?php $d=0; foreach ($data as $key=> $data) {
              if($key==0)
              {
                continue;
              }
              # code...
             ?>
            <div class="col-sm-12 col-md-6 search">
              <a class="item-block" href="resume-detail.php?detail=<?php echo $data['fid'] ?>">
                <header>
                  <img class="resume-avatar" src="upload/<?php echo $data['dev_img'] ?>" alt="">
                  <div class="hgroup">
                    <h4> <?php echo $data['fullname'] ?> </h4>
                    <h5> <?php echo $data['head'] ?> </h5>
                  </div>
                </header>

                <div class="item-body">
                  <p> <?php echo substr($data['description'],0,150) ?> </p>

                  <div class="tag-list">
                  <?php $tag=explode(',',$data['tags']); foreach ($tag as $tag) {
                      # code...
                    ?>
                    <span><?php echo $tag; ?> </span>
                   <?php  } ?>
                  </div>
                </div>

                <footer>
                  <ul class="details cols-2">
                    <li>
                      <i class="fa fa-map-marker"></i>
                      <span><?php echo $data['location'] ?></span>
                    </li>

                    <li>
                      <i class="fa fa-money"></i>
                      <span>$<?php echo $data['salary'] ?> / hour</span>
                    </li>
                  </ul>
                </footer>
              </a>
            </div>
            <!-- END Resume detail -->
<?php } ?>

         

          <div class="row">
         



          <!-- Page navigation -->
          <nav class="text-center">
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <i class="ti-angle-left"></i>
                </a>
              </li>
              <?php 
              
              for ($page=1; $page <= $total_pages; $page++) { 
                
              
              ?>

<li><a href="<?php echo "?page=$page"; ?>"><?php  echo $page; ?></a></li>

            <?php } ?>
             
              
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
let filter = document.getElementById('filter');
filter.addEventListener("click",(e) => {
  e.preventDefault();
  let keyword = document.getElementById('keyword').value;
  let location = document.getElementById('location').value;
  const resumefind = "resumefind.php";
  let formData = new FormData();
  formData.append("keyword",keyword);
  formData.append("location",location);

  fetch(resumefind,{
    method:"post",
    body:formData
  }).then((res) => res.json())
  .then((res) => insertJs(res))
  .catch((error) => console.log(error))

});

function insertJs (res) { 
  let search = document.querySelectorAll('.search');
  for (let i = 0; i < search.length; i++) {
    search[i].innerHTML="";
    }
    res.forEach(element => {
      let d= 0;
      let fid = element.fid;
      let head = element.head;
      let dev_img = element.dev_img;
      let description = element.description;
      let fullname = element.fullname;
      let location = element.location;
      let salary = element.salary;
      let major = element.major;

      let tags = element.tags;
      
      
      let splitetag = tags.split(",");

     
        

      search[d].innerHTML+=` <a class="item-block" href="resume-detail.php?detail=${fid}">
                <header>
                  <img class="resume-avatar" src="upload/${dev_img}" alt="">
                  <div class="hgroup">
                    <h4>${fullname}</h4>
                    <h5> ${head} </h5>
                  </div>
                </header>

                <div class="item-body">
                  <p>${description}</p>

                  <div class="tag-list">
                  
                    <span id="tag">${tags}</span>
                                 
                  </div>
                </div>

                <footer>
                  <ul class="details cols-3">
                    <li>
                      <i class="fa fa-map-marker"></i>
                      <span>${location} </span>
                    </li>

                    <li>
                      <i class="fa fa-money"></i>
                      <span>$${salary}  / hour</span>
                    </li>

                    <li>
                      <i class="fa fa-certificate"></i>
                      <span>${major} </span>
                    </li>
                  </ul>
                </footer>
              </a>`;


    });

 }

</script>


<?php  include_once "includes/footer.php";?>