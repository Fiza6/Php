<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: pages-login.php");
 
  exit;
} 


if(isset($_GET['showAlert']))
{
    if(($_GET['showAlert'] == "true") || ($_GET['showAlert'] == "profileupdated"))
    {
      $showAlert=true;
    }
  
}
else
  {
    $showAlert=false;
  }

if(isset($_GET['showError']))
{
    if($_GET['showError']== "Passwordsdonotmatch" )
    {
      $showError="Passwords do not match";
    }
    elseif($_GET['showError']== "Incorrectpassword" )
    {
      $showError="Incorrect password";
    }

    elseif($_GET['showError']== "error" )
    {
      $showError="Please fill in all fields";
    }
}
else
$showError=false;
$logged_in_user_id=$_SESSION['id'];
$logged_in_username=$_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Users / Profile </title>

</head>
<?php require 'partials\header.php'?>
<body>

  <?php require 'partials\nav.php'?>

  <?php
 
  if($showError)
  {
    echo '<br><br><br><div class="alert alert-warning alert-dismissible fade show" role="alert" style="user-select: auto; ">
  <i class="bi bi-exclamation-triangle me-1" style="user-select: auto;margin-left: 300px; 
  "></i>'.$showError.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"  style="user-select: auto;"></button>
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
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2><?php echo $logged_in_username;?></h2>
              
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>

                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                
                  

                  <h5 class="card-title">Profile Details</h5>
                  <?php
                    $sql= "Select * FROM users WHERE users.id= '$logged_in_user_id'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result);
                  ?>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row["name"];?></div>
                  </div>
                  
  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row["email"];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Username</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row["username"];?></div>
                  </div>


                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="action_update_profile.php" method = "post">
                 
                    

                    <div class="row mb-3" style="display:none;">
                      <label for="id" class="col-md-4 col-lg-3 col-form-label">ID</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="id" type="text" class="form-control" id="id" value="<?php echo $row["id"];?>" readonly="readonly">
                      </div>
                    </div>
                    

                    <div class="row mb-3">
                      <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="name" value="<?php echo $row["name"];?>">
                      </div>
                    </div>

                  

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="email" value="<?php echo $row["email"];?>" readonly>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="username" type="text" class="form-control" id="username" value="<?php echo $row["username"];?>">
                      </div>
                    </div>

               

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                <?php a:?>
                  <form action="action_change_password.php" method="post">

                    <div class="row mb-3">
                      <label for="password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="password">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newpassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newpassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="cnewpassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="cnewpassword" type="password" class="form-control" id="cnewpassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit"  class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

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