<?php
session_start();
$showAlert = false;
$showError = false;
if(isset($_POST['newpassword'])){
   
    $logged_in_user=$_SESSION['username'];
 
    include ('partials\db-connect.php');
    $password = $_POST["password"];
    
    $newpassword =$_POST["newpassword"];
    $cnewpassword=$_POST["cnewpassword"];

  
    if(empty($password)||empty($newpassword)||empty($cnewpassword))
    {
      $showError="Please fill in all the fields";
    }
    
    
    else{              
      $sql = "Select * from users where username='$logged_in_user'"; 
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
      $row = mysqli_fetch_assoc($result);
      $id=$row["id"];
      $currentpassword=$row["password"];
      
      
      
      if($password==$currentpassword){ 
        if($newpassword== $cnewpassword)
         {
          $sql= "UPDATE `users` SET `password` = '$newpassword' WHERE `users`.`id` = '$id'";
          $result = mysqli_query($conn, $sql);
      
          if ($result){    
            header("location: users-profile.php?showAlert=true");
          }
          }
          else
           header("location: users-profile.php?showError=Passwordsdonotmatch");
        
      }
      else
      
      header("location: users-profile.php?showError=Incorrectpassword");
     
    }
  }
 

  ?>