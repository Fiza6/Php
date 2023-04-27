<?php
session_start();

    include 'partials/db-connect.php';
    include 'permission_model.php';

    function fetch($sql){
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

    
    function create($sql){
        include 'partials/db-connect.php';
        $result = mysqli_query($conn, $sql);
        if($result){
            return true;
        }
        else{
            return false;
        }
          
    }
    
    function update($sql){
        include 'partials/db-connect.php';
        $result = mysqli_query($conn, $sql);  
        if($result){
            return true;
        }        
        else{
            return false;
        }
    }



    // Create/fetch role id
    $role_type= $_POST["role_id"];
    $is_exist = fetch("SELECT * FROM sec_role WHERE sec_role.type = '$role_type'");
    //If role does not exist insert it into sec_role table
    if($is_exist == "0"){
        create("INSERT INTO `sec_role` ( `type`) VALUES ('$role_type')");
        $role_id = fetch("SELECT * FROM sec_role WHERE sec_role.type = '$role_type'");
    }
    else{
        //fetch its id and use this id for updating role_permission table
        $role_id = $is_exist;
    }
    
    $m = 0;
    $message = false;
    foreach ($module as $key=>$value){
        
        $sm = 0;
        foreach($sub_module as $key1=> $module_name){
            if($sub_module[$key1][1] == $key){
           
                //Creating variables for values posted by role permission form 
                $fk_module_id = $_POST["fk_module_id$m$sm"];
                $create = $_POST["create$m$sm"];
                $read= $_POST["read$m$sm"];
                $update= $_POST["update$m$sm"];
                $delete= $_POST["delete$m$sm"];
                
                $exist_role = fetch("SELECT * FROM role_permission WHERE fk_module_id = '$fk_module_id' AND role_id ='$role_id'");
                
                if($exist_role == "0"){
                    $message = create("INSERT INTO `role_permission` ( `fk_module_id`, `role_id`, `create`, `read`, `update`, `delete`) VALUES ( '$fk_module_id', '$role_id', '$create', '$read', '$update', '$delete');");
                } 
                    else{
                        //fetch its id and use this id for updating role_permission table
                        $id = $exist_role;
                        $message = update("UPDATE `role_permission` SET `create` = '$create' , `read` = '$read' , `update` = '$update' , `delete` = '$delete' WHERE `role_permission`.`id` = '$id';");
                        
                    }
        }

       $sm++; }
    $m++;}
    if($message){
       $_SESSION['status'] = "Successfully done";
       header("Location: pages-role-permission.php");
    }
    else
    {
       $_SESSION['status'] = "Something went wrong";
       header("Location: pages-role-permission.php");
    }
     




    
    
?>