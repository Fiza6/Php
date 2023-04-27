<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
   
    exit;
  }
  // include 'permission.php';
  // $mod_name = "user";
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

  if(isset($_SESSION['status']))
  {
    if($_SESSION['status'] != "1")
    {
        $showError = $_SESSION["status"];
    }
    else
        $showError = false;
  }
  else
     $showError = false;
//   Get id from view-uers page and retrieving the record from "Users" table in database
  if(isset($_GET['id'])){
    include 'partials/db-connect.php';
    $id=$_GET['id'];
    $sql = "SELECT * FROM users WHERE users.id= '$id'";
    $result=mysqli_query($conn, $sql);
    $getrow = mysqli_fetch_assoc($result);
  
    $name=$getrow["name"];
    $email=$getrow["email"];
    $update_username = $getrow["username"];
    $usertype = $getrow["user_type"];
    // $_SESSION['cn']=$cn;

  }



?>
<!DOCTYPE html>
<html lang="en">
<head> <title>Pages / Update -User</title></head>
<?php require 'partials\header.php'?>
<body>

<?php require 'partials\nav.php'?>

<?php 
if($showError)
{
  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="user-select: auto;">
  <i class="bi bi-exclamation-triangle me-1" style="user-select: auto;"></i>'.$showError.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="user-select: auto;"></button>
  </div>';
  $_SESSION['status']="1";
}


?>
<?php require 'partials\sidebar.php'?>


  <main id="main" class="main mt-0">
 
    <div class="container">

      <section class="section Update min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
          <!-- col-lg-4 d-flex flex-column -->
            <div class="   col-md-6 align-items-center justify-content-center">
<!-- 
              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Users</span>
                </a>
              </div>End Logo -->

               <!-- Headings Start -->
              <div class="card mb-3 ">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4 ">Update Account</h5>
                    <nav>
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="view-user.php">Users</a></li>
                    <li class="breadcrumb-item active">Update User</li>
                    </ol>
                    </nav>
                  </div>
                  <!-- Headings End -->


                 <!-- Update Name Starts -->
                 <?php
                 ?>
                  <form autocomplete="off"  action="action-update-user.php" class="row g-3 needs-validation" action="pages-Update.php" method = "post"   >
                  <input type="text" name="id" id="id" value="<?php if($_SERVER["REQUEST_METHOD"]== "GET"){
                        echo $id;
                      }
                      echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>" style="display:none" readonly>  
                  <div class="col-12"> 
                      <label for="name" class="form-label">Name</label>
                      <input type="text" name="name" class="form-control" id="name"  value="<?php 
                      if($_SERVER["REQUEST_METHOD"]== "GET"){
                        if(isset($name))
                        {echo $name;}
                      }
                      echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>" required>
                      <div class="invalid-feedback" >Please, enter name!</div>
                    </div>
                  <!-- Update Name Ends -->

                    <div class="col-12">
                      <label for="useremail" class="form-label">Email</label>
                      <input type="email" name="useremail" class="form-control" id="useremail"  
                      value="<?php
                      if($_SERVER["REQUEST_METHOD"]== "GET"){
                        if(isset($email)){
                            echo $email;
                        }
                      } 
                      echo isset($_POST["useremail"]) ? $_POST["useremail"] : ''; ?>" required readonly>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>
                    <!-- Update Email Ends -->
                    <div class="col-12">
                      <label for="username" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text"  name="update_username" class="form-control" id="update_username" 
                        value="<?php
                        if($_SERVER["REQUEST_METHOD"]== "GET"){
                            if(isset($update_username))echo $update_username;
                          }
                          elseif(isset($_POST["update_username"]))
                           echo isset($_POST["update_username"]) ? $_POST["update_username"] : ''; ?>"   required>
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                   <!-- Update Username Ends -->

                    <!-- Radio button starts-->
                    <div class="col-12">
                        <label for="usertype" class="form-label">User Type</label>
        
                        <div class="form-check" style="user-select: auto;">
                          <input class="form-check-input" type="radio" <?php
                          if($_SERVER["REQUEST_METHOD"]== "GET"){
                            if(isset($usertype)){
                            if($usertype == "Admin"){
                                echo 'checked=""'; 
                            }}
                          }
                        ?> name="usertype" id="usertype" 
                          value="Admin" style="user-select: auto;" required>
                          <label class="form-check-label" for="usertype" style="user-select: auto;">
                            Admin
                          </label>
                        </div>
                      
                        <div class="form-check" style="user-select: auto;">
                          <input class="form-check-input" type="radio" name="usertype" <?php
                          if($_SERVER["REQUEST_METHOD"]== "GET"){
                            if(isset($usertype))
                            {if($usertype == "User"){
                                echo 'checked=""'; 
                            }}
                          }
                        ?> id="usertype" value="User" style="user-select: auto;" required>
                          <label class="form-check-label" for="usertype" style="user-select: auto;">
                            User
                          </label>
                        </div>
                    </div>

                    <!-- Radio button Ends-->          
                    <div class="col-12">
                    <div class= "text-center">
                      <button class="btn btn-primary " type="submit">Update Account</button>
                    </div>
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