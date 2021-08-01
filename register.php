<?php

$Fullname= $_POST['Fullname'];
$Email  = $_POST['Email'];
$Username = $_POST['Username'];
$Password = $_POST['Password'];




if (!empty($Fullname) || !empty($Email) || !empty($Username) || !empty($Password) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT Email From register Where Email = ? Limit 1";
  $INSERT = "INSERT Into register (Fullname , Email ,Username, Password )values(?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $Email);
     $stmt->execute();
     $stmt->bind_result($Email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $Fullname,$Email,$Username,$Password);
      $stmt->execute();
      echo "New record inserted sucessfully";
Header("Location:login.html");
exit();
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>