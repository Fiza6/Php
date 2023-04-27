<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
   header("location: pages-login.php");
  
   exit;
 } 

$login = false;
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/db-connect.php';
    $name = $_POST["name"];
    $useremail= $_POST["useremail"];
    $username = $_POST["username"];
    $usertype = $_POST["usertype"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
  
   
  
    // Check whether this username exists
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
      
        $showError = "Username Already Exists";
    }
    else{
        // $exists = false; 
        if(($password == $cpassword)){
            
            $sql = "INSERT INTO `users` ( `name`, `email`, `username`, `user_type`, `password`, `date_time`) VALUES ( '$name', '$useremail', '$username', '$usertype','$password', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result){
            $_SESSION['status'] = "Successfully Inserted";
           header("location: view-user.php");
           
            }
        }
        else{
            $showError = "Passwords do not match";
        }
    }
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head> <title>Pages / Register -Companies</title></head>
<?php require 'partials\header.php'?>
<body>

<?php require 'partials\nav.php'?>

<?php 
if($showError)
{
  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="user-select: auto;">
  <i class="bi bi-exclamation-triangle me-1" style="user-select: auto;"></i>'.$showError.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="user-select: auto;"></button>
  </div>';
}

if($showAlert)
{
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="user-select: auto;">
  <i class="bi bi-check-circle me-1" style="user-select: auto;"></i>
  Success!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="user-select: auto;"></button>
  </div>';
  echo '<style>.container{ display :none; }</style>';



}
?>
<?php require 'partials\sidebar.php'?>


  <main id="main" class="main">
 
  <div class="pagetitle">
                      <h1>Users</h1>
                      <nav>
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                          <li class="breadcrumb-item"><a href="view-user.php">Users</a></li>
                          <li class="breadcrumb-item active">Register New Users</li>
                        </ol>
                      </nav>
                    </div><!-- End Page Title -->
  
    <div class="container">
   
      <section class="section register d-flex flex-column align-items-center justify-content-center">
        <div class="container"> 
          

          <div class="row justify-content-center">
            <div class="col col-md-6 d-flex flex-column align-items-center justify-content-center">


           
              <div class="card mb-3">

                <div class="card-body">
               
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>
                 <!-- Insert Name Starts -->
                  <form autocomplete="off" class="row g-3 needs-validation" action="pages-register.php" method = "post"   >
                    <div class="col-12">
                      <label for="name" class="form-label">Your Name</label>
                      <input type="text" name="name" class="form-control" id="name"  value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>">
                      <div class="invalid-feedback" >Please, enter your name!</div>
                    </div>
                  <!-- Insert Name Ends -->

                    <div class="col-12">
                      <label for="useremail" class="form-label">Your Email</label>
                      <input type="email" name="useremail" class="form-control" id="useremail"  value="<?php echo isset($_POST["useremail"]) ? $_POST["useremail"] : ''; ?>" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>
                    <!-- Insert Email Ends -->
                    <div class="col-12">
                      <label for="username" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text"  name="username" class="form-control" id="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ''; ?>"  required>
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                   <!-- Insert Username Ends -->

                    <!-- Radio button starts-->
                    <div class="col-12">
                        <label for="usertype" class="form-label">User Type</label>
        
                        <div class="form-check" style="user-select: auto;">
                          <input class="form-check-input" type="radio" name="usertype" id="usertype" value="Admin" style="user-select: auto;" required>
                          <label class="form-check-label" for="usertype" style="user-select: auto;">
                            Admin
                          </label>
                        </div>
                      
                        <div class="form-check" style="user-select: auto;">
                          <input class="form-check-input" type="radio" name="usertype" id="usertype" value="User" style="user-select: auto;" required>
                          <label class="form-check-label" for="usertype" style="user-select: auto;">
                            User
                          </label>
                        </div>
                    </div>

                    <!-- Radio button Ends-->
                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                     <!-- Insert Password Ends -->
                    <div class="col-12">
                      <label for="cpassword" class="form-label">Confirm Password</label>
                      <input type="password" name="cpassword" class="form-control" id="cpassword" value="<?php echo isset($_POST["cpassword"]) ? $_POST["cpassword"] : ''; ?>" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                     <!-- Confirm Password Ends -->
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <!-- <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="pages-login.php">Log in</a></p>
                    </div> -->
                  </form>

                </div>
              </div>

            

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

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