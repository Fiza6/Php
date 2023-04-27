<?php

  function fetch_id($sql){
    include 'partials/db-connect.php';
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num > 0){
        $row = mysqli_fetch_assoc($result);
        return $row["id"];
    }
    else
    { 
        return "0";
    }
}

function permission($module_name){
        include 'partials/db-connect.php';

        $module_id = fetch_id("SELECT * from module  where module.module_name = '$module_name'");
        $usertype=$_SESSION['user_type'];
        $role_id  = fetch_id("SELECT * FROM sec_role WHERE sec_role.type = '$usertype'");
        $sql = "SELECT * from role_permission where role_id='$role_id' AND fk_module_id = '$module_id'";
        $result = mysqli_query($conn, $sql);
        if($result){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['create'] = $row['create'];
        $_SESSION['read'] = $row['read'];
        $_SESSION['update'] = $row['update'];
        $_SESSION['delete'] = $row['delete'];

        }
        
    }
?>