<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: pages-login.php");
    exit;
  }

if (isset($_SESSION['update'])){
  if($_SESSION['update'] != "1"){
    header("location: pages-error-404.php");
  }
}

if(isset($_GET["name"])){
  $branch_number=$_GET['id'];
  $name=$_GET["name"];
  $sid=$_GET["sid"];
}

elseif(isset($_GET["branch_name"])){
  $id=$_GET["id"];
  $branch_number=$_GET["branch_number"];
  $name=$_GET["branch_name"];
  $sid=$_GET["sector_id"];
}


$login = false;
$showAlert = false;
$showError = false;

// After update, this will work
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'partials/db-connect.php';
  $id           = $_POST["branch_number"];
  $branch_name  = $_POST["branch_name"];
  $sector_id    = $_POST["sector_id"];

    if(empty($branch_name)||empty($sector_id)){
      $showError="Please fill in all the fields";
    }
    else{
      $existSql       = "SELECT * FROM `branch` WHERE branch_name = '$branch_name'";
      $result         = mysqli_query($conn, $existSql);
      $numExistRows   = mysqli_num_rows($result);
      if($numExistRows > 0){
          $showError  = "Sector Already Exists";
      }
      else{
      $sql= "UPDATE `branch` SET `branch_name` = '$branch_name', `sector_id` = '$sector_id' WHERE `branch`.`branch_number` = '$id'";
      $result = mysqli_query($conn, $sql);
      
      if ($result){ 
          header("location:view-branch.php?success=true");
      }
    }
  }

}

   
?>
<!DOCTYPE html>
<html lang="en">
<head><title>Branches / Add Branches -Companies</title></head>
<?php require 'partials\header.php'?>

<body>
  <?php require 'partials\nav.php'?>
  <?php
  if($login)
  {
    echo '<br><br><br><div class="alert alert-success alert-dismissible fade show" role="alert" style="user-select: auto;">
    <i class="bi bi-check-circle me-1" style="user-select: auto; margin-left: 300px;"></i>Success!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="user-select: auto;"></button>
    </div>';
  }
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
      <h1>Branches</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Branches</li>
          <li class="breadcrumb-item active">Update Branch</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Update Branch</h5>

              <!-- Form -->
              <form action="update-branch.php" method="post"> 
              <input name="branch_number" type="hidden" class="form-control" id="branch_number" value="<?php  if($_SERVER["REQUEST_METHOD"] == "GET"){echo $branch_number;}?>" readonly="readonly">
              <div class="row mb-3" style="user-select: auto;">
                  <label class="col-sm-2 col-form-label" style="user-select: auto;">Select Company</label>
                  <div class="col-sm-10" style="user-select: auto;">
                  <?php
                    include 'partials/db-connect.php';
                    
                    // fetch selected company
                    $sqlz = "Select * from sector where id='$sid'";
                    $resultz = mysqli_query($conn, $sqlz);
                    $numz = mysqli_num_rows($resultz);
                    $rowz = mysqli_fetch_assoc($resultz);
                    $comp = $rowz["company_id"];

                    $sqls = "Select * from company where id='$comp'";
                    $results = mysqli_query($conn, $sqls);
                    $nums = mysqli_num_rows($results);
                    $rows = mysqli_fetch_assoc($results);
                    
                  ?>
                    <select id="company" onchange='reload() ' name ="company_id" class="form-select" aria-label="Default select example" style="user-select: auto;">
                      <option value="<?php if(isset($_GET['name'])){ echo $rows["id"];}  
    ?>" style="user-select: auto;"><?php if(isset($_GET['name'])){ echo $rows["company_name"] ;} else {echo 'Select company';} ?></option>

                      <?php
                        //fetch all companies
                        $sql = "Select * from company";
                        $result = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($result);
                          while($row = mysqli_fetch_assoc($result))
                        {
                      ?>
                      <option value="<?php echo $row["id"] ?>" style="user-select: auto;"> <?php if($_SERVER["REQUEST_METHOD"] == "GET"){ echo $row["company_name"];}?> </option>
                      <?php
                      }
                      ?>


                    </select>
                  </div>
                </div>

                <!-- company end -->
                <div class="row mb-3" style="display:none;">
                <label for="id" class="col-md-4 col-lg-3 col-form-label">ID</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="id" type="text" class="form-control" id="id" value="<?php  if($_SERVER["REQUEST_METHOD"] == "GET"){echo $comp;}?>" readonly="readonly">
                        </div>
                        </div>
                    <!-- pass companyid -->
                <div class="row mb-3" style="user-select: auto;">
                  <label class="col-sm-2 col-form-label" style="user-select: auto;">Select Sector</label>
                  <div class="col-sm-10" style="user-select: auto;">
                  
                  
                  <?php
                       
                  ?>
                    <select id="sector"  name ="sector_id" class="form-select" aria-label="Default select example" style="user-select: auto;">
                      <option value="<?php if(isset($_GET['name'])){echo $rowz["id"];}?>"style="user-select: auto;"><?php if(isset($_GET['name'])){ echo $rowz["sector_name"];} else { echo 'Select Sector';}?></option>
                      <?php
                        if(isset($_GET['cat']))
                        {
                        $cat=$_GET['cat'];
                        
                        $sql1 = "Select * from sector where company_id= '$cat'";
                        
                          
                        $result1 = mysqli_query($conn, $sql1);
                        $num1 = mysqli_num_rows($result1);
                        }
                          while($row1 = mysqli_fetch_assoc($result1))
                        {
                      ?>
                      <option value=" <?php echo $row1["id"] ?>" style="user-select: auto;"> <?php echo $row1["sector_name"]?> </option>
                      <?php
                      }
                      ?>


                    </select>
                  </div>
                </div>
                <!-- Sector end -->
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Branch Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" value="<?php echo $name;?>" name = "branch_name">
                  </div>
                </div>
            
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Update</button>
                 
                </div>
              </form><!-- End Horizontal Form -->

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