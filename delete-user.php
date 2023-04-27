<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
   
    exit;
  }


  // include 'permission.php';
  // $mod_name = "user";
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
  include 'partials/db-connect.php';
 
  if($_SERVER["REQUEST_METHOD"] == "GET"){
    
    $id=$_GET['id'];

  }

  // Function  to delete records
  function delete($table,$column,$user_id)
  {
    include 'partials/db-connect.php';
  
   $sql= "SELECT * FROM `$table` WHERE `$table`.$column='$user_id'";
        $result = mysqli_query($conn, $sql);
        $num =  $num = mysqli_num_rows($result);
        if ($num > 0){
         
           $sql= "DELETE FROM `$table` WHERE `$table`.`$column` = '$user_id'";
           $result = mysqli_query($conn, $sql);
           if($result)
           {
            return true;
           }
           else
           return false;
        }
        else 
        return true;
  } //Function Ended
         
  // Assigning values to functions's arguments
        $table_name = "branch";
        $column_name = "user_id";
        //Calling the function to delete Sectors
        if( delete($table_name, $column_name,$id) == false){
          $_SESSION['status']="There was problem in deleting branches ";
          header("location: view-user.php");
        }

        else{
              // Assigning values to functions's arguments
              $table_name = "sector";
              $column_name = "user_id";
              //Calling the function to delete Sectors
              if( delete($table_name, $column_name,$id) == false){
                $_SESSION['status']="There was problem in deleting sectors of the user";
                header("location: view-user.php");
              }
              else 
                {
                  // Assigning values to functions's arguments
                    $table_name = "company";
                    $column_name = "user_id";
                    //Calling the function to delete Company
                    if( delete($table_name, $column_name,$id) == false){
                      $_SESSION['status']="There was problem in deleting companies of the user";
                      header("location: view-user.php");
                  } 
                  else{
                    // Assigning values to functions's arguments
                    $table_name = "users";
                    $column_name = "id";
                    //Calling the function to delete Company
                    if( delete($table_name, $column_name,$id) == false){
                      $_SESSION['status']="There was problem in deleting the user";
                      header("location: view-user.php");
                    } 
                    else{
                    $_SESSION['status'] = "Selected user has been sucessfully Deleted";
                      header("location: view-user.php");
                    }

                  }

                }
      }


       
 
?>