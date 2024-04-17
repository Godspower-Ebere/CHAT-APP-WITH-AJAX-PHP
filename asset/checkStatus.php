<?php
include("connect.php");
$senderName=$_POST["senderName"];
$select=mysqli_query($connect,"SELECT * FROM account WHERE name<>'$senderName'");
while($row=mysqli_fetch_assoc($select)){
        $fname=$row["name"];
        $fimage=$row["image"];
        $fgender=$row["gender"];
        $fstatus=$row["status"];
        $fid=$row["id"];
        if($fimage==""){
            if ($fgender=="male"){
                $fimage="../upload/male.png";
            }
            if ($fgender=="female"){
                $fimage="../upload/female.png";
            }
        }
        if ($fstatus=="online"){
            echo "
            <a href='chat.php?id=$fid'>
            <li id='friend'>
                <div class='status me-3'>
                    <img src='../upload/$fimage'>
                    <i class='fas fa-circle'></i>
                </div>
                <div class='details'>
                    <div class='name'>
                        <h3 style='text-transform:capitalize;' class='text-white'>$fname</h3>
                        <i></i>
                    </div>
                </div>
            </li>
            </a>
            ";
           
        }
        if($fstatus=="offline"){
            echo "
            <a href='chat.php?id=$fid'>
            <li id='friendof'>
                <div class='status me-3'>
                    <img src='../upload/$fimage'>
                </div>
                <div class='details'>
                    <div class='name'>
                        <h3 style='text-transform:capitalize;' class='text-white'>$fname</h3>
                    </div>
                </div>
            </li>
            </a>
            ";
        }
        
    }
?>