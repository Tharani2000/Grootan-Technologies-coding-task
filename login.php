<?php

$email = $_POST['Email'];
$password = $_POST['Password'];

$con = new mysqli("localhost","root","","project");
if($con->connect_error)
{
die("Failed to connect: ".$con->connect_error);
}
else
{
$stmt = $con->prepare("select * from register where Email = ?");
$stmt->bind_param("s",$email);
$stmt->execute();
$stmt_result=$stmt->get_result();
if($stmt_result->num_rows > 0)
{
$data=$stmt_result->fetch_assoc();
if($data["Password"] === $password)
{
echo "Login Successful";
header("Location: user.html");
exit();
}
else
{
echo "Invalid email or password";
}
}
else
{
echo "Invalid email or password";
}
}
?>