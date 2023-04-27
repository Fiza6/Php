<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    
    exit;
}
include 'partials/db-connect.php';
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
$data_array = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data_array[$row['name']] = $row['email'];
}

// print_r ($data_array);

$row = mysqli_fetch_assoc($result);
foreach($data_array as $key=>$row)
{
    print_r($row['name']);
    echo"<br>";
}

?>