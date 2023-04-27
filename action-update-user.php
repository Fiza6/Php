<?php
session_start();

if(isset($_POST["update_username"])){
    include 'partials\db-connect.php';
   
    $id = $_POST["id"];
    $name = $_POST["name"];
    $update_username=$_POST["update_username"];
   $user_type = $_POST["usertype"];
  
    
      if(empty($name) ||empty($update_username))
      {
        $_SESSION['status']="Please fill in all the fields";
        header("location: update-user.php");
      }
      else{
          
        $sql= "UPDATE `users` SET `name` = '$name', `username` = '$update_username' , `user_type` = '$user_type' WHERE `users`.`id` = '$id'";
        
        $result = mysqli_query($conn, $sql);
        
        if ($result){    
            
           $_SESSION['username']=$update_username;
            $_SESSION['status']="Successfully Updated";
            header("location: view-user.php");
         
        }
      }

}
?>