<?php include 'includes/header.php'; ?>
    <!-- Page header -->
    <header class="page-header bg-img" style="background-image: url(upload/co.jpg);">
      <div class="container page-name">
        <h1 class="text-center">Browse companies</h1>
        <p class="lead text-center">Use following search box to find companies that fits you better</p>
      </div>

      <div class="container">
        <form id="searchForm">

          <div class="row">
            <div class="form-group col-xs-12 col-sm-4">
              <input id="keyword" type="text" class="form-control" placeholder="Keyword">
            </div>

            <div class="form-group col-xs-12 col-sm-4">
              <input id="location" type="text" class="form-control" placeholder="Location">
            </div>

            <div class="form-group col-xs-12 col-sm-4">
              <select class="form-control selectpicker" id="select" name="select" >

                <option selected>All categories</option>
        <?php 
        $sql="SELECT * FROM category";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $data= $stmt->fetchAll();
        
       
        foreach ($data as $data) {
          echo "<option value='".$data['id']."'>". $data['category_name'] ."</option>";
        }
        ?>                
                
               
              </select>
            </div>

          </div>

          <div class="button-group">
            <div class="action-buttons">
              <button id="filter" class="btn btn-primary">Apply filter</button>
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

            <div class="col-xs-12">
              <br>
              <h5>We found <strong>86</strong> matches, you're watching <i>10</i> to <i>15</i></h5>
            </div>

            <!-- Company detail -->

  <?php 
  $limit = 4;
$sql2 = "SELECT * FROM company ORDER BY cid DESC";
$stmt2=$conn->prepare($sql2);
$stmt2->execute();
$total_results = $stmt2->rowCount();
$total_pages = ceil($total_results/$limit);

if (!isset($_GET['page'])) {
  $page = 1;
} else{
  $page = $_GET['page'];
}
$starting_limit = ($page-1)*$limit;

  
  $sql = "SELECT * FROM company ORDER BY cid DESC LIMIT $starting_limit, $limit";
  $stmt=$conn->prepare($sql);
  $stmt->execute();
  $data = $stmt->fetchAll();
  foreach ($data as $data) {
    # code...
  
  ?>

            <div class="col-xs-12 search">
              <a class="item-block" href="company-detail.php?detail=<?php echo $data['cid']; ?> ">
                <header>
                  <img src="upload/<?php echo $data['img'] ?>" alt="">
                  <div class="hgroup">
                    <h4> <?php echo $data['c_name'] ?> </h4>
                    <h5><?php echo $data['headline'] ?></h5>
                  </div>
                 
                </header>

                <div class="item-body">
                  <p> <?php  $x = substr($data['c_des'],0,200); echo $x; ?></p>
                </div>
              </a>
            </div>
            <!-- END Company detail -->
<?php  } ?>



 




          


            <!-- Page navigation -->
            <nav class="text-center">
              <ul class="pagination">
                <li>
                  <a href="#" aria-label="Previous">
                    <i class="ti-angle-left"></i>
                  </a>
                </li>
      <?php for ($page=1; $page <= $total_pages; $page++) { 
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
        </div>
      </section>
    </main>
    <div id="container"></div>
    <!-- END Main container -->

        <script>
          
          

        let filterCompany = document.getElementById('filter');
        filterCompany.addEventListener('click',(e)=>{
          e.preventDefault();
          let keyword = document.getElementById('keyword').value;
          let location = document.getElementById('location').value;
          let select = document.getElementById('select').value;
         
          
          


          let formData = new FormData();
          formData.append('keyword',keyword);
          formData.append('location',location);
          formData.append('select',select);
          const searchPHP = 'co-search.php';

          fetch(searchPHP,{
            method:"post",
            body:formData
          }).then((res)=> res.json())
          .then((res) => {    insertRes(res)})
          .catch((error)=> console.log(error))
    

        });


        function insertRes(res) { 
        
        
        
        
          let search = document.querySelectorAll('.search');
          for (let d = 0; d < search.length; d++) {
            search[d].innerHTML ="";
            
          }
          
         res.forEach(element => {
           let headline = element.headline;
           let img = element.img;
           let id = element.cid;
           let c_name = element.c_name;
           let c_des = element.c_des;
           let d =0;

           
    
            
          
            search[d].innerHTML += `  
             <a class="item-block" href="company-detail.php?detail=${id} ">
               <header>
                 <img src="upload/${img}" alt="">
                 <div class="hgroup">
                   <h4>${c_name}</h4>
                   <h5>${headline}</h5>
                 </div>
                 
               </header>

               <div class="item-body">
                 <p>${c_des} </p>
               </div>
             </a>
          `;
       d++;
          


         });
  


         }

   // Add your javascript here

        </script>


    <?php include 'includes/footer.php'; ?>