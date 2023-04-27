<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
   
    exit;
  }

  // include 'permission.php';
  // $mod_name = "branch";
  // permission($mod_name);
  // if (isset($_SESSION['delete']))
  // {
  //   // echo "success";exit;
  //   if($_SESSION['delete'] != "1")
  //   {
  //     // echo "success";exit;
  //     header("location: pages-error-404.php");
  //   }
  // }
  $login = false;
  $showAlert = false;
  $showError = false;
  $showRecord=false;
  if($_SERVER["REQUEST_METHOD"] == "GET"){
    
    $id=$_GET['id'];
  }
  include 'partials/db-connect.php';
  $sql= "DELETE FROM `branch` WHERE `branch`.`branch_number` = '$id'";
        $result = mysqli_query($conn, $sql);
        
        if ($result){    
         
         
            header("location:view-branch.php?success=true");
        }
 
?>