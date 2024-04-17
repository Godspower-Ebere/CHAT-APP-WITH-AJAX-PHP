<?php
include("connect.php");
$id=$_GET["id"];
$reciever=$_GET["reciever"];

$check=mysqli_query($connect,"SELECT * FROM chat WHERE id='$id'");
$row=mysqli_fetch_assoc($check);
$msg=$row["message"];
if ($msg=="<i>This message was deleted</i>"){
    mysqli_query($connect,"DELETE  FROM chat WHERE id='$id'");
    header("location:chat.php? id=$reciever ");
}
else{
    mysqli_query($connect,"UPDATE chat SET message='<i>This message was deleted</i>', date='' WHERE id='$id'");
    header("location:chat.php? id=$reciever ");
}
?>