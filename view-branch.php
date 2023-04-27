<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
   
    exit;
  }
 
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
  
 
  $showRecord=false;

  // include 'permission.php';
  // $mod_name = "branch";
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
  function view_branch()
  {  
        $session_id= $_SESSION['id'];
        include 'partials/db-connect.php';
        $sql = "SELECT branch.branch_number, branch.branch_name,branch.sector_id, sector.sector_name  FROM branch INNER JOIN sector ON branch.sector_id = sector.id  WHERE branch.user_id = '$session_id' ";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        while($row = mysqli_fetch_assoc($result))
        { 
           echo'
          <tr><th scope="row">'.$row["branch_number"].'</th>
          <td>'.$row["branch_name"].'</td>
          <td>'.$row["sector_name"].'</td>';

          if (isset($_SESSION['update']))
          {
            // echo "success";exit;
            if($_SESSION['update'] == "1")
            {
              echo' <td><button type="button" class="btn btn-warning rounded-pill" style="user-select: auto;"><a href= "update-branch.php?'.'id='.$row["branch_number"].'">Update</a></button>';
            }
          }
        if (isset($_SESSION['delete']))
        {
          // echo "success";exit;
          if($_SESSION['delete'] == "1")
          {
            echo'<td><button type="button" class="btn btn-danger rounded-pill" style="user-select: auto;"><a href= "delete-branch.php? id='. $row["branch_number"] .'">Delete</a></button></td>';

          }
        }
        echo'</tr>';
   
        }
       
        
   
        
     }
     

         

?>
<!DOCTYPE html>
<html lang="en">
<head><title>Branches / View Branches -Companies</title></head>
<?php require 'partials\header.php'?>

<body>
  <?php require 'partials\nav.php'?>
  <?php require 'partials\sidebar.php'?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Branches</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Branches</li>
          <li class="breadcrumb-item active">View Branches</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Branches</h5>
              <!-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> -->

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                 
                    <th scope="col"> Id</th>
                    <th scope="col">Branch Name</th>
                    <th scope="col"> Sector Name</th>
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
                 <?php view_branch();?>
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