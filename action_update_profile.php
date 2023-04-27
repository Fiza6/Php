<?php
session_start();
$showAlert = false;
$showError = false;


if(isset($_POST["username"])){
  include 'partials\db-connect.php';
    $id = $_POST["id"];
    $name = $_POST["name"];
    $username = $_POST["username"];
  
    
      if(empty($name)||empty($username))
      {
        header("location: users-profile.php?showError=error");
      }
      else{
          
        $sql= "UPDATE `users` SET `name` = '$name', `username` = '$username' WHERE `users`.`id` = '$id'";
        
        $result = mysqli_query($conn, $sql);
        
        if ($result){    
            
           $_SESSION['username']=$username;
           
            header("location: users-profile.php?showAlert=profileupdated");
         
        }
      }
    }
    

?>