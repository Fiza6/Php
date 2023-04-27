<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
   
    exit;
  }
  // include 'permission.php';
  // $mod_name = "sector";
  // permission($mod_name);
  // if (isset($_SESSION['read']))
  // {
  //   // echo "success";exit;
  //   if($_SESSION['read'] != "1")
  //   {
  //     // echo "success";exit;
  //     header("location: pages-error-404.php");
  //   }
  // }
  if(isset($_GET['success']))
  {
    if($_GET['success'] == "true")
    {
      $showAlert = true;
    }
  }
  else {
    $showAlert = false;
  }
  
  $showError = false;
  $showRecord=false;
  function view_sector()
  {  
       $x= $_SESSION['id'];
       
       

        include 'partials/db-connect.php';
        $sql = "SELECT sector.id,  sector.sector_name, sector.company_id , company.company_name  FROM sector INNER JOIN company ON sector.company_id = company.id WHERE sector.user_id=$x ";
        
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num > 0)
        {
        while($row = mysqli_fetch_assoc($result))
        { 
           echo'<tr><th scope="row">'.$row["id"].'</th>
          <td>'.$row["sector_name"].'</td>
          <td>'.$row["company_name"].'</td>';
          if (isset($_SESSION['update']))
              {
                // echo "success";exit;
                if($_SESSION['update'] == "1")
                {
                  echo'<td><button type="button" class="btn btn-warning rounded-pill" style="user-select: auto;"><a href= "update-sector.php? sid='.$row["id"].'">Update</a></button>';
                }
              }
            if (isset($_SESSION['delete']))
            {
              // echo "success";exit;
              if($_SESSION['delete'] == "1")
              {
                echo'<td><button type="button" class="btn btn-danger rounded-pill" style="user-select: auto;"><a href= "delete-sector.php? id='. $row["id"] .'">Delete</a></button></td>';

              }
            }
            echo'</tr>';
          }
        }
       
   
        
     }
     

         

?>

<!DOCTYPE html>
<html lang="en">
<head><title>Sectors / View Sectors -Companies</title></head>
<?php require 'partials\header.php'?>

<body>
  
  <?php require 'partials\nav.php'
  
  ?>
  <?php
 
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
      <h1>Sectors</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Sectors</li>
          <li class="breadcrumb-item active">View Sectors</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Sectors</h5>
              <!-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> -->

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sector Name</th>
                    <th scope="col">Company Name</th>
                    <?php
                    if(isset($_SESSION['update']) && isset($_SESSION['delete']))
                    {
                      if(($_SESSION['update']) == "1" || ($_SESSION['delete']) == "1"){
                        echo'<th scope="col">Action</th>';
                      }
                    }
                    ?>
                  
                  </tr>
                </thead>
                <tbody>
                  <?php view_sector();
                  ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

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