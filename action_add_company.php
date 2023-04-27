<?php
session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){


        include 'partials/db-connect.php';
        $statusMsg = '';
        $company_name = $_POST["company_name"];
        $vat_number = $_POST["vat_number"]; 
        // $company_logo = $_POST["company_logo"];
        $session_id = $_SESSION["id"];

        
         // File upload path
         $targetDir = "uploads/";
         
         $fileName = basename($_FILES["company_logo"]["name"]);
         $targetFilePath = $targetDir . $fileName;
         $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        
        $sql = "Select * from company where company_name='$company_name'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 1){
        echo $showError = "Company Already Exists";exit;

        } 
        else
        {
        
            if(empty($company_name)||empty($vat_number)||empty($_POST["submit"]) && empty($_FILES["company_logo"]["name"]))
        {
            $showError="Please fill in all the fields";
        }
        else{
            
            // Allow certain file formats
            $allowTypes = array('jpg','png','jpeg');
            if(in_array($fileType, $allowTypes)){
              
                // Upload file to server
                if(move_uploaded_file($_FILES["company_logo"]["tmp_name"], $targetFilePath)){
                    $sql = "INSERT INTO `company` ( `company_name`,`vat_number`, `company_logo`,`user_id`) VALUES ('$company_name','$vat_number', '".$fileName."','$session_id')";
                    $result = mysqli_query($conn, $sql);
                    
                    if ($result){
                        header("location:view-company.php?success=true");
                    }
                    else{
                        $statusMsg = "File upload failed, please try again.";
                    }
                }
                else
                {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            }
           
        
                // Display status message
                echo $statusMsg;



            }
        }
        }
  

?>
