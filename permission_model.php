<?php


    require_once 'partials/db-connect.php';

    $sql = "Select * from module";
    $result = mysqli_query($conn, $sql);
    $module = array();

    while($row = mysqli_fetch_assoc($result))
    {
        $module[$row['id']] = $row['module_name'];
    }
    // print_r($module);

    $sql1 = "Select * from sub_module";
    $result1 = mysqli_query($conn, $sql1);
    // $num = mysqli_num_rows($result1);

    $sub_module = array();
    while($row1 = mysqli_fetch_assoc($result1))
    {
        $sub_module[] = array($row1['id'],$row1['mid'],$row1['name']);
    }
    
    // foreach($sub_module as $key=> $module_name)
    // {
        
    //     // echo $key;
    //     // echo "<br>";
    //     // echo $key;
    //     // echo "<br>";
    //     // echo $module_name;
    //     // echo "<br>";
    //     // echo "<br>";
    //   echo $module_name[$key][];
    //     echo "<br>";
        
    // }
    
// print_r($sub_module);
//     exit;


    
?>
