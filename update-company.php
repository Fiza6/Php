
<?php
session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
      header("location: pages-login.php");
    
      exit;
    }
    // include 'permission.php';
    // $mod_name = "company";
    // permission($mod_name);
    if (isset($_SESSION['update']))
    {
      // echo "success";exit;
      if($_SESSION['update'] != "1")
      {
        // echo "success";exit;
        header("location: pages-error-404.php");
      }
    }
  $showAlert = false;
  $showError = false;
  $session_id=$_SESSION['id'];

  if(isset($_GET['cid'])){
    include 'partials/db-connect.php';
    $id=$_GET['cid'];
    $sql = "SELECT * FROM company WHERE company.id= '$id'";
    $result=mysqli_query($conn, $sql);
    $getrow = mysqli_fetch_assoc($result);
  
    $cn=$getrow["company_name"];
    $vt=$getrow["vat_number"];
    $imageURL = $getrow["company_logo"];
    $_SESSION['cn']=$cn;

  }
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/db-connect.php';
    $id = $_POST["id"];
    $company_name = $_POST["company_name"];
    $vat_number = $_POST["vat_number"]; 
    $cn=$_SESSION['cn'];

    $oldimage = $_POST["old_company_logo"];
    $newimage = basename($_FILES["company_logo"]["name"]);
    if(empty($newimage))
          {
            
            $company_logo = $oldimage;
          }
        else
          {
            $company_logo = $newimage;
          }

      $targetDir = "uploads/";
      $targetFilePath = $targetDir . $company_logo;
      $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

      if(empty($company_name)||empty($vat_number))
      {
        $showError="Please fill in all the fields";
      }
      else{
        // Check whether this company exists
       $existSql = "SELECT * FROM `company` WHERE company_name = '$company_name' AND company.user_id='$session_id'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        
        if($numExistRows > 0 && $company_name != $cn ){
  
          $showError = "Company Already Exists";
        
        }
        else{
          echo "success";
          
           
            $sql= "UPDATE `company` SET `company_name` = '$company_name', `vat_number` = 
            '$vat_number', `company_logo` = '".$company_logo."' WHERE `company`.`id` = '$id'";
            $result = mysqli_query($conn, $sql);
              
              if ($result){      
                move_uploaded_file($_FILES["company_logo"]["tmp_name"], $targetFilePath);
                header("location:view-company.php?success=true");
              }
            
      }
    }

  }

   
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
  echo'<style>form{display:none;}</style>';
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
          <li class="breadcrumb-item active">Update Company</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <!-- <div class="col-lg-6"> -->

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Update Company</h5>

              <!-- Company Form -->
              <form action = "update-company.php" method="post" enctype="multipart/form-data" novalidate>
             
                <div class="row mb-3" style="display:none;">
                        <label for="id" class="col-md-4 col-lg-3 col-form-label">ID</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="id" type="text" class="form-control" id="id" value="<?php echo $id;?>" readonly="readonly">
                        </div>
                        </div>
            <!-- End Company id -->
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Company Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" name = "company_name" value="<?php
                    if($_SERVER["REQUEST_METHOD"] == "GET"){ echo $cn ;} if($_SERVER["REQUEST_METHOD"] == "POST"){echo $company_name;}
                    ?>">
                  </div>
                </div>
                <!-- End Company Name -->
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Vat Number</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name ="vat_number" value="<?php if($_SERVER["REQUEST_METHOD"] == "GET"){ echo $vt;} if($_SERVER["REQUEST_METHOD"] == "POST"){echo $vat_number;}?>">
                  </div>
                </div>
                <!-- End Vat Number -->
                
                <div class="row mb-3" style="user-select: auto;">
                  <label for="inputNumber" class="col-sm-2 col-form-label" style="user-select: auto;">Company Logo</label>
                  
                  <div class="col-sm-10" style="user-select: auto;">
                  <a href="<?php echo $imageURL?>"><img src="<?php if($_SERVER["REQUEST_METHOD"] == "GET"){echo 'uploads/'.$imageURL;} elseif($_SERVER["REQUEST_METHOD"] == "POST"){echo 'uploads/'.$company_logo;}?>" alt=""  style="margin-left:22% ;height:50% ;width:50%;"/>
                  </a>
                </div>
                <input class="form-control" type="hidden" id="formFileold" style="user-select: auto;" name="old_company_logo"   value="<?php if($_SERVER["REQUEST_METHOD"] == "GET"){echo $imageURL;}?>" >
                <!-- End View Company Logo -->

               <div class="row mb-3" style="user-select: auto;">
                  <div class="col-sm-10" style="user-select: auto;">
                    <input class="form-control" type="file" id="formFile" style="user-select: auto;" name="company_logo"   value="<?php if($_SERVER["REQUEST_METHOD"] == "POST"){echo $company_logo;}?>" >
                  </div>
              </div>
               <!-- End Update Company Logo -->

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Update</button>  
                </div>
              </form>
              <!-- End Company Update Form -->
           
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