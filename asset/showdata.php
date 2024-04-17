<?php
include("connect.php");
$sender=$_POST["senderid"];
$reciever=$_POST["recieverid"];

$Sresult=mysqli_query($connect,"SELECT * FROM account WHERE id='$sender'");
$Srow=mysqli_fetch_assoc($Sresult);
$senderName=$Srow["name"];

$Rresult=mysqli_query($connect,"SELECT * FROM account WHERE id='$reciever'");
$Rrow=mysqli_fetch_assoc($Rresult);
$recieverName=$Rrow["name"];

$chat=mysqli_query($connect,"SELECT * FROM chat WHERE sender='$senderName' AND reciever='$recieverName' OR sender='$recieverName' AND reciever='$senderName'");
while($row=mysqli_fetch_assoc($chat)){
$send=$row["sender"];   
$id=$row["id"]; 
$msg=$row["message"];
$date=$row["date"];
if ($send==$senderName){
    echo "
    <li class='right'>
        <div class='rightchat'>
            <p>$msg</p>
            <div class='delete'>
                <small>$date</small>
                <a href='delete.php?id=$id & reciever=$reciever'><i class='fas fa-trash-alt' id='bin'></i></a>
            </div>
        </div>
    </li>
    ";
    
}
if($send==$recieverName){
    echo "
    <li class='left'>
        <div class='leftchat'>
            <p>$msg</p>
            <div class='delete'>
                <small>$date</small>
                <a href='delete.php?id=$id & reciever=$reciever'><i class='fas fa-trash-alt' id='bin'></i></a>
            </div>
        </div>
    </li>
    ";
}
}
?>
