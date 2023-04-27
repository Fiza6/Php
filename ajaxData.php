<?php 
// Include the database config file 
include 'partials/db-connect.php'; 
 
if(!empty($_POST["company_id"])){ 
    // Fetch state data based on the specific company 
    $query = "SELECT * FROM sector WHERE company_id = ".$_POST['company_id']; // ." ORDER BY sector_name ASC"
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);
    echo'<script> console.log('.$num.')</script>';
    if($num > 0){ 
         echo'<script> console.log('.$_POST["company_id"].')</script>';
        echo '<option value="">Select Sector</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['id'].'">'.$row['sector_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Sector not available</option>'; 
    } 
}
?>