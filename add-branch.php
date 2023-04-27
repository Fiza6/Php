<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: pages-login.php");
   
    exit;
  }

  $login      = false;
  $showAlert  = false;
  $showError  = false;
  $x          = $_SESSION['id'];
  
  // When Branch is Added
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/db-connect.php';
     
      $branch_name = $_POST["branch_name"];
      $sector_id = $_POST["sector_id"];   
      $sql = "Select * from branch where branch_name='$branch_name'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
      if ($num == 1){
      $showError = "Branch Already Exists";
      }    
      else
          {
            if(empty($branch_name))
              {
                $showError="Please enter branch";
              }
              elseif(empty($sector_id))
              {
                $showError="Please fill in sector field";
              }
        
            else
              {
    
                $sql = "INSERT INTO `branch` ( `branch_name`,`sector_id`,`user_id`) VALUES ('$branch_name', '$sector_id','$x')";
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
          <li class="breadcrumb-item active">Add Branch</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Branch</h5>

              <!-- Form -->
              <form action="add-branch.php" method="post">
                <div class="row mb-3" style="user-select: auto;">
                  <label class="col-sm-2 col-form-label" style="user-select: auto;">Select Company</label>
                  <div class="col-sm-10" style="user-select: auto;">
                  
                  
                  <?php
                    include 'partials/db-connect.php';
                    $sql = "Select * from company where user_id='$x'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                  ?>
                  <!-- Company DropDown -->
                    <select id="company" name ="company_id" class="form-select" aria-label="Default select example" style="user-select: auto;">
                      <option value="" style="user-select: auto;">-----</option>
                      <?php
                      if($num > 0){ 
                          while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row["id"] ?>" style="user-select: auto;"> 
                            <?php echo $row["company_name"];?> 
                            </option>
                      <?php }}
                      else{ 
                        echo '<option value="">Company not available</option>'; 
                      } 
                      ?>
                    </select>
                  </div>
                </div>
                <!-- Sector Drop Down -->
                <div class="row mb-3" style="user-select: auto;">
                  <label class="col-sm-2 col-form-label" style="user-select: auto;">Select Sector</label>
                   <div class="col-sm-10"  style="user-select: auto;">
                    <select id="sector"  name ="sector_id" class="form-select" aria-label="Default select example" style="user-select: auto;">
                      <option value="" style="user-select: auto;">------</option>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                      <script>
                          $(document).ready(function(){
                              $('#company').on('change', function(){
                                  var companyID = $(this).val();
                                  console.log(companyID);
                                  if(companyID){
                                      $.ajax({
                                          type:'POST',
                                          url:'ajaxData.php',
                                          data:'company_id='+companyID,
                                          success:function(html){
                                              $('#sector').html(html);
                                              // $('#city').html('<option value="">Select state first</option>'); 
                                          }
                                      }); 
                                  }else{
                                      $('#sector').html('<option value="">Select company first</option>');
                                      // $('#city').html('<option value="">Select state first</option>'); 
                                  }
                              });
                          });
                          </script>
                    </select>
                  </div>
                </div>

                <!-- Branch DropDown -->
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Branch Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" name = "branch_name">
                  </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>

              </form><!-- End of Form -->
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