<?php
session_start();

 if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
   
    exit;
  }
  // include 'permission.php';
  // $mod_name = "sector";
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
  $showRecord=false;
  $session_id=$_SESSION['id'];
     
     
        if($_SERVER["REQUEST_METHOD"] == "POST"){
          include 'partials/db-connect.php';
           
            $sector_name = $_POST["sector_name"]; 
            $company_id = $_POST["company_id"];
          
             
            $sql = "Select * from sector where sector_name='$sector_name' AND user_id='$session_id'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 1){
            $showError = "Sector Already Exists";
            }    
            else
                {
                  if(empty($sector_name))
                    {
                      $showError="Please enter sector";
                    }
                    elseif(empty($company_id))
                    {
                      $showError="Please fill in company field";
                    }
              
                  else
                    {
          
                      $sql = "INSERT INTO `sector` ( `sector_name`,`company_id`,`user_id`) VALUES ('$sector_name', '$company_id','$session_id')";
                      $result = mysqli_query($conn, $sql);
                      if ($result){
                        header("location:view-sector.php?success=true");
                      }
                    }
              }
            
        }      

?>
<!DOCTYPE html>
<html lang="en">
<head><title>Sectors / Add Sectors -Companies</title></head>
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

  ?>

  <?php require 'partials\sidebar.php'?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Sectors</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Sectors</li>
          <li class="breadcrumb-item active">Add Sector</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <!-- <div class="col-lg-6"> -->

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Sector</h5>

              <!-- Horizontal Form -->
              <form action="add-sector.php" method="post" >
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Sector Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="sector_name" name = "sector_name">
                  </div>
                </div>
                
               
                <div class="row mb-3" style="user-select: auto;">
                  <label class="col-sm-2 col-form-label" style="user-select: auto;">Select Company</label>
                  <div class="col-sm-10" style="user-select: auto;">
                  
                  
                  <?php
                    include 'partials/db-connect.php';
                    $sql = "Select * from company where user_id='$session_id'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                  ?>
                    <select name ="company_id" class="form-select" aria-label="Default select example" style="user-select: auto;">
                      <option value="" style="user-select: auto;">Open this select menu</option>
                      <?php
                        
                          while($row = mysqli_fetch_assoc($result))
                        {
                      ?>
                      <option value="<?php echo $row["id"] ?>" style="user-select: auto;"> <?php echo $row["company_name"]?> </option>
                      <?php
                      }
                      ?>


                    </select>
                  </div>
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Add</button>
                 
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