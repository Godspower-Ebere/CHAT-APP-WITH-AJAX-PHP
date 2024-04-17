<?php
include("connect.php");
session_start();
$id=$_SESSION["id"];
mysqli_query($connect,"UPDATE account SET status='offline' WHERE id='$id'");
session_destroy();
header("location:../index.php");
?>