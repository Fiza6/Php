<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: pages-login.php");
   
    exit;
  }

  // include 'permission.php';
  // $mod_name = "company";
  // permission($mod_name);
  // if (isset($_SESSION['create']))
  // {
  //   // echo "success";exit;
  //   if($_SESSION['create'] != "1")
  //   {
  //     // echo "success";exit;
  //     header("location: pages-error-404.php");
  //   }
  // }
  $showAlert = false;
  $showError = false;

   
       


          
?>

<!DOCTYPE html>
<html lang="en">
<head><title>Companies / Add Companies -Companies</title></head>
<?php require 'partials\header.php'?>

<body>


<?php require 'partials\nav.php'?>
<?php

  if($showError)
  {
    echo '<br><br><br><div class="alert alert-warning alert-dismissible fade show" role="alert" style="user-select: auto; ">
  <i class="bi bi-exclamation-triangle me-1" style="user-select: auto;margin-left: 300px; 
  "></i>'.$showError.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="user-select: auto;"></button>
  </div>';
  }
  
  if($showAlert)
  {
    echo '<br><br><br><div class="alert alert-success alert-dismissible fade show" role="alert" style="user-select: auto;">
  <i class="bi bi-check-circle me-1" style="user-select: auto; margin-left: 300px;"></i>
  Success!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="user-select: auto;"></button>
  </div>';
  }
  ?>

<?php require 'partials\sidebar.php'?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Company</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="view-company.php">Company</a></li>
          <li class="breadcrumb-item active">Add Company</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <!-- <div class="col-lg-6"> -->

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Company</h5>

              <!-- Company Form -->
              <form action = "action_add_company.php" method="post"  enctype="multipart/form-data" novalidate>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Company Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" name = "company_name" value="<?php echo isset($_POST["company_name"]) ? $_POST["company_name"] : ''; ?>">
                  </div>
                </div>
                <!-- End Company Name -->
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Vat Number</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name ="vat_number" value="<?php echo isset($_POST["vat_number"]) ? $_POST["vat_number"] : ''; ?>">
                  </div>
                </div>
                <!-- End Vat Number -->

                <div class="row mb-3" style="user-select: auto;">
                  <label for="inputNumber" class="col-sm-2 col-form-label" style="user-select: auto;">Company Logo</label>
                  <div class="col-sm-10" style="user-select: auto;">
                    <input class="form-control" type="file" id="formFile" style="user-select: auto;" name="company_logo" value="<?php echo isset($_POST["company_logo"]) ? $_POST["company_logo"] : ''; ?>">
                  </div>
                </div>
                <!-- End Company Logo -->
               
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Add</button>
                 
                </div>
              </form><!-- End Company Form -->

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