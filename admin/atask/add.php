
<?php
session_start();
if(!isset($_SESSION["aid"]))
{
	header("location:adminlogin.html");
   exit();
}
$uemail=htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
$upass=htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
//if empty password or username!
//alt isempty
if($uemail=="" || $upass=="")
{
  header("location:add.html");
  exit();
}
require("../../tasks/condb.php");

// Create a prepared statement to prevent SQL injection
$query = "INSERT INTO admin (email, password) VALUES (?, ?)";
$stmt = mysqli_prepare($dbcon, $query);
mysqli_stmt_bind_param($stmt, "ss", $uemail, $upass);
$result = mysqli_stmt_execute($stmt);

if($result)
{
  echo("<p style='color:green;position:absolute;left:250px;top:70px'> successfully added $uemail</p>");
 include("add.html");
  $dbcon->close();
  exit();
}  else {
echo("some thing want wrong please try again!");
$dbcon->close();
include("add.html");
}



?>
