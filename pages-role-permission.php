<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    
    exit;
}
include 'permission_model.php';
if(isset($_SESSION['status']))
{
  // echo$_SESSION['status'];exit;
  if($_SESSION['status'] != "1")
  {
    $showAlert=$_SESSION['status'];
  }
  else{
    $showAlert=false;
  } 
}
else{
  $showAlert=false;
} 
?>



<!-- Html starts here -->

<!DOCTYPE html>
<html lang="en">

<head><title>Users -Companies</title></head>

<?php require 'partials\header.php'?>

<body>

  <?php require 'partials\nav.php'?>
  <?php require 'partials\sidebar.php'?>
  <?php


if($showAlert)
  {
    echo '<br><br><br><div class="alert alert-success alert-dismissible fade show" role="alert" style="user-select: auto;">
    <i class="bi bi-check-circle me-1" style="user-select: auto; margin-left: 300px;"></i>
    '.$showAlert.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="user-select: auto;"></button>
    </div>';

    $_SESSION['status']="1";
  }
?>

  <main id="main" class="main">
    <!-- Form Starts Here -->
  <form action="action-role-permission.php" method="post">
  <div class="card" style="user-select: auto;">
    <div class="card-body" style="user-select: auto;">
    <legend class="card-title" style="user-select: auto;">Roles Permissions</legend>

    <!-- Role Name Text box starts-->
    <div class="row mb-3" style="user-select: auto; margin-left: 0.5%">
      <legend class="col-sm-2 col-form-label" style="user-select: auto;">Role Name</legend> 
      <!-- <label for="inputText" class="col-sm-2 col-form-label" style="user-select: auto;">Text</label> -->
      <div class="col-sm-10" style="user-select: auto;">
        <input type="text" class="form-control" id = "type" name="role_id" style="user-select: auto; width: 50%" required>
      </div>
    </div>

    <!-- Permission Names starts -->
    <div class="card" style="user-select: auto;">
    <div class="card-body" style="user-select: auto;">
    <div class="row">
    <legend class="col-form-label  col-sm-2 pt-0 card-title" style="user-select: auto;"></legend>
    </div>
    <div class="row">
    <legend class="col-form-label  col-sm-2 pt-0 card-title " style="user-select: auto;"></legend>
    <div class="col">
    <legend class="col-form-label pt-0" style="user-select: auto; color:#012970 ; font-size: 16px;
    font-weight: 500;">Create</legend>
    </div>
    <div class="col">
    <legend class="col-form-label  pt-0" style="user-select: auto; color:#012970 ; font-size: 16px;
    font-weight: 500;">Read</legend>
    </div>
    <div class="col">
    <legend class="col-form-label pt-0" style="user-select: auto;color:#012970 ; font-size: 16px;
    font-weight: 500;">Update</legend>
    </div>
    <div class="col">
    <legend class="col-form-label pt-0" style="user-select: auto; color:#012970 ; font-size: 16px;
    font-weight: 500;">Delete</legend>
    </div>
    </div>

    <!-- Select all check boxes -->
    <div class="row pb-4" style="border:none; border-bottom: 4px solid #ebeef4;">
    <legend class="col-form-label col-sm-2 pt-0" style="user-select: auto;"></legend>
   
    <div class="col">
      <input class="form-check-input" type="checkbox" name = "allcreate" id="checkAllcreate"  value ="1" onclick ="all_create()" style="user-select: auto;">
    </div>

    <div class="col">  
      <input class="form-check-input" type="checkbox"  name = "allread" id="checkAllread" onclick="all_read()"style="user-select: auto;">
    </div>

    <div class="col">
      <input class="form-check-input" type="checkbox" name = "allupdate" id="checkAllupdate" onclick="all_update()"style="user-select: auto;">
    </div>

    <div class="col">
      <input class="form-check-input" type="checkbox" name = "alldelete" id="checkAlldelete" onclick="all_delete()" style="user-select: auto;">
    </div> 

  </div>
   <!-- Select all check boxes end here -->


  <?php 
    $m = 0;
    foreach ($module as $key=>$value)
    {
  ?>
  <div  style="border:none; border-bottom: 1px solid #ebeef4;">
    <h5 class="card-title" style="user-select: auto;"><?php echo $value; ?></h5>
    <?php
    $sm = 0;
    foreach($sub_module as $key1=> $module_name)
    {
     
      if($sub_module[$key1][1] == $key)
      {
        $createID = "create_id".$m.$sm;
        $readID = "read_id".$m.$sm;
        $updateID = "update_id".$m.$sm;
        $deleteID = "delete_id".$m.$sm;
        ?>
   
      <div class="row pb-4">
        <input type="hidden" name="fk_module_id<?php echo $m.$sm?>" value="<?php echo $key ?>" id="id_<?php echo $key ?>" ">
        <legend class="col-form-label col-sm-2 pt-0" style="user-select: auto;"><?php echo $sub_module[$key1][2] ;?> </legend>
        <div class="col">
        <input type='hidden' value='0' name = "<?php echo "create".$m.$sm;?>">
        <input class="form-check-input" type="checkbox" value='1' name = "<?php echo "create".$m.$sm;?>" id="<?php echo $createID;?>" style="user-select: auto;">
        </div>
        <div class="col">
        <input type='hidden' value='0' name = "<?php echo "read".$m.$sm;?>">
        <input class="form-check-input" type="checkbox" value='1'name = "<?php echo "read".$m.$sm;?>" id="<?php echo  $readID; ?>" style="user-select: auto;">
        </div>
        <div class="col">
        <input type='hidden' value='0' name = "<?php echo "update".$m.$sm;?>">
        <input class="form-check-input" type="checkbox" value='1' name = "<?php echo "update".$m.$sm;?>" id="<?php echo $updateID; ?>" style="user-select: auto;">
        </div>
        <div class="col">
        <input type='hidden' value='0' name = "<?php echo "delete".$m.$sm;?>">
        <input class="form-check-input" type="checkbox" value='1'name = "<?php echo "delete".$m.$sm;?>" id="<?php echo $deleteID ?>" style="user-select: auto;">
        </div>
      </div>
 
    <?php }$sm++;}?>
  
    </div>
  
    <?php $m++; }?>
    </div>
    <div class="text-center mb-4">
    <button type="submit" class="btn btn-primary rounded-pill " style="user-select: auto; ">Save</button>
    </div>
    </div>
    </form>
  </main>
  <!-- End #main -->

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

<!-- Permisson file -->
<script src="assets/permission.js"></script>

</body>

</html>