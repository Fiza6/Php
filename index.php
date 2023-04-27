
<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: pages-login.php");
   
    exit;
  }
  $login = false;
  if(isset($_GET['login']))
  {
    if($_GET['login'] == "true")
    {
      $login = true;
    }

  }
  // include 'partials/db-connect.php';
  
?>
<!doctype html>
<html lang="en">
  
<?php require 'partials\header.php'?>

<body>
  
  <?php require 'partials\nav.php'?>
  <?php require 'partials\sidebar.php'?>

  <main id="main" class="main">

   
    <section class="section"  >

      <div class="row ">
      <div class="col-md-9 col-lg-8 " style ="width:65%;margin-left:13%; margin_bottom:0%;">
     
      
        <!-- <div class="col-lg-6"> -->
    <div class="card" >
            <div class="card-body">
              
              <span><h3 class="card-title" >Home</h3></span>
              
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Sectors</li>
                <li class="breadcrumb-item active">View Sectors</li>
              </ol>
           
              
              <!-- Slides with captions -->
              <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" style =" padding-top:0px; margin-top:2px;">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="assets/img/news-5.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Companies</h5>
                      <p>Read, Write or Update</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets/img/news-4.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Sectors</h5>
                      <p>Read, Write or Update</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets/img/news-3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Branch</h5>
                      <p>Read, Write or Update</p>
                    </div>
                  </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              </div><!-- End Slides with captions -->

            </div>
          </div>
           
</div>
</div>


</section>

  </main><!-- End #main -->
  <?php require 'partials/footer.php'?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>