<?php 
include("connect.php");
session_start();
$sender=$_POST["senderid"];
$reciever=$_POST["recieverid"];
$message=$_POST["message"];

$Sresult=mysqli_query($connect,"SELECT * FROM account WHERE id='$sender'");
$Srow=mysqli_fetch_assoc($Sresult);
$senderName=$Srow["name"];

$Rresult=mysqli_query($connect,"SELECT * FROM account WHERE id='$reciever'");
$Rrow=mysqli_fetch_assoc($Rresult);
$recieverName=$Rrow["name"];

$date=date("h:i d/m/y");

mysqli_query($connect,"INSERT INTO chat VALUES('','$senderName','$recieverName','$message','$date')");

?>