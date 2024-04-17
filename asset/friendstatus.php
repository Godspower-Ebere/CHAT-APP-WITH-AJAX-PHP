<?php
include("connect.php");
$recieverid=$_POST["id"];
$result=mysqli_query($connect,"SELECT * FROM account WHERE id='$recieverid'");
$row=mysqli_fetch_assoc($result);
$status=$row["status"];
if ($status=="online"){
    echo "<b style='color:greenyellow;'>$status</b>";
}
else{
    echo "<b style='color:red;'>$status</b>";
}
?>