<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
}
else{
  $loggedin = false;
}

include 'partials/db-connect.php';
include 'permission.php';
$logged_in_user=$_SESSION['id'];
$sql= "Select * FROM users WHERE id= '$logged_in_user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$current_page = basename($_SERVER['SCRIPT_NAME']);

?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="index.php">
      <i class="bi bi-grid"></i>
      <span>Home</span>
    </a>
  </li><!-- End Dashboard Nav -->

 
<?php
     permission("company"); 
     if (((isset($_SESSION['create'])) || isset($_SESSION['read']))){
      if (($_SESSION['create'] == "1")  || ($_SESSION['read'] == "1")){
        ?>
      <li class="nav-item">

        <a class="nav-link collapsed" data-bs-target="#company-nav"  data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Companies</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="company-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <?php if($_SESSION['read'] == "1"){?>
        <li>
          <a  href="view-company.php">
            <i class="bi bi-circle"></i><span>View Company</span>
          </a>
        </li>
        <?php } ?>
        <?php
        
          if($_SESSION['create'] == "1"){
        ?>
          <li>
            <a href="add-company.php">
              <i class="bi bi-circle"></i><span>Add Company</span>
            </a>
          </li>
      <?php }?>
    </ul>
  </li><!-- End Company Nav -->
<?php }} ?>

<?php
     permission("sector"); 
     if (((isset($_SESSION['create'])) || isset($_SESSION['read']))){
      if (($_SESSION['create'] == "1")  || ($_SESSION['read'] == "1")){
        ?>
 <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#sector-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Sectors</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="sector-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    <?php if($_SESSION['read'] == "1"){?>
      <li>
        <a href="view-sector.php">
          <i class="bi bi-circle"></i><span>View Sectors</span>
        </a>
      </li>
      <?php } ?>
        <?php if($_SESSION['create'] == "1"){ ?>
      <li>
        <a href="add-sector.php">
          <i class="bi bi-circle"></i><span>Add Sectors</span>
        </a>
      </li>
      <?php }?>
    </ul>
  </li><!-- End Sectors Nav -->
  <?php }} ?>
  <?php
     permission("branch"); 
     if (((isset($_SESSION['create'])) || isset($_SESSION['read']))){
      if (($_SESSION['create'] == "1")  || ($_SESSION['read'] == "1")){
        ?>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#branch-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-bar-chart"></i><span>Branch</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="branch-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    <?php if($_SESSION['read'] == "1"){?>
      <li>
        <a href="view-branch.php">
          <i class="bi bi-circle"></i><span>View Branch</span>
        </a>
      </li>
      <?php } ?>
        <?php
        
          if($_SESSION['create'] == "1"){
        ?>
      <li>
        <a href="add-branch.php">
          <i class="bi bi-circle"></i><span>Add Branch</span>
        </a>
      </li>
      <?php }?>
      
    </ul>
  </li><!-- End Branch Nav -->
  <?php }} ?>

  

  <li class="nav-heading">Pages</li>
<?php
  if($loggedin)
  {
   
     ?>
     <li class="nav-item">
      <a class="nav-link collapsed" href="users-profile.php">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
      </li><!-- End Profile Page Nav -->

<?php  if(($row["user_type"] == "Admin")||($row["user_type"] == "SuperAdmin")){?>
  <?php
     permission("user"); 
     if (((isset($_SESSION['create'])) || isset($_SESSION['read']))){
      if (($_SESSION['create'] == "1")  || ($_SESSION['read'] == "1")){
       if($_SESSION['read'] == "1"){?>
      <li class="nav-item">
      <a class="nav-link collapsed" href="view-user.php">
      <i class="bi bi-card-list"></i>
      <span>View Users</span>
      </a>
      </li><!-- End Register Page Nav -->
      <?php } ?>
      <?php if($_SESSION['create'] == "1"){?>
      <li class="nav-item">
      <a class="nav-link collapsed" href="pages-register.php">
      <i class="bi bi-card-list"></i>
      <span>Register new User</span>
      </a>
      </li><!-- End Register Page Nav -->
      <?php } ?>
      <?php }} ?>
      <li class="nav-item">
      <a class="nav-link collapsed" href="pages-role-permission.php">
      <i class="bi bi-card-list"></i>
      <span>Role Permission</span>
      </a>
      </li><!-- End Role Permission Page Nav -->

<?php
}}
if(!$loggedin)  
{
  ?>
    
      <li class="nav-item">
      <a class="nav-link collapsed" href="pages-login.php">
      <i class="bi bi-box-arrow-in-right"></i>
      <span>Login</span>
      </a>
      </li><!-- End Login Page Nav -->
      </ul>
<?php
    }
?>
 
</aside><!-- End Sidebar-->
