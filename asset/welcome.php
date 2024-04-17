<?php
include("connect.php");
session_start();
$id=$_SESSION["id"];
$_SESSION["id"]=$id;
if (isset($_SESSION["id"])){
    $check=mysqli_query($connect,"SELECT * FROM account WHERE id='$id' ");
    $fetch=mysqli_fetch_assoc($check);

    $senderName=$fetch["name"];
    $senderSName=$fetch["surname"];
    $senderNumber=$fetch["number"];
    $senderPassword=$fetch["password"];

    $caps=strtoupper($senderName);
    $title="Welcome $caps";
    $senderimg=$fetch["image"];
    $sendergend=$fetch["gender"];
    if ($senderimg==""){
        if ($sendergend=="male"){
            $senderimg="../upload/male.png";
        }
        if ($sendergend=="female"){ 
            $senderimg="../upload/female.png";
        }
    }
    else{
        $senderimg="../upload/$senderimg";
    }
}
else{
    header("location:../index.php");
}
if(isset($_POST["submit"])){
    $name=$_POST["name"];
    $sname=$_POST["sname"];
    $number=$_POST["number"];
    $password=$_POST["password"];
    $image=$_FILES["image"]["name"];
    $imagetmp=$_FILES["image"]["tmp_name"];
    move_uploaded_file($imagetmp,"../upload/$image");
    mysqli_query($connect,"UPDATE account SET name='$name', surname='$sname' , number='$number', password='$password', image='$image' WHERE id='$id' ");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="../jquery/jquery.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="rfresh" content="1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="../css/welcome.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../fontawesome/css/solid.min.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <div class="container-fluid cont ">
        <div class="friends">
            <div class="head">
                <img id="settingbtn2" src=<?php echo $senderimg?> title=<?php echo $senderName?> alt="">
                <div class="tool">
                    <a title="Logout" href="logout.php"><i class="fas fa-sign-out-alt text-danger logout"></i></a>
                   <i title="settings" class="fas fa-gear"  id="settingbtn"></i>
                </div>
            </div>
            <ul class="friends" id="status">
                
            </ul>
            <div class="setting shadow" id="setting">
                <i class="fas fa-arrow-left left " id="back"></i>
                <div class="details shadow">
                    <img src=<?php echo $senderimg?> alt="">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input name="name" id="name"  value=<?php echo $senderName ?> class="form-control" type="text" placeholder="Update Your Name">
                        <br>
                        <input name="sname" id="sname" value=<?php echo $senderSName ?> class="form-control" type="text" placeholder="Update Your Surname">
                        <br>
                        <input name="number" id="number" value=<?php echo $senderNumber ?> class="form-control" type="number" placeholder="Update Your Number">
                        <br>
                        <input name="password" id="password" value=<?php echo $senderPassword ?> class="form-control" type="password" placeholder="Update Your Password">
                        <br>
                        <input name="image" id="image" class="form-control" type="file">
                        <br>    
                        <input name="submit" class="form-control btn button" type="submit" value="Save Changes">
                    </form>
                </div>
            </div>
        </div>
        <div class="welcome">
           <img src="../images/amibba-logo.png" alt="">
        </div>
    </div>
</body>
</html>

<script>
    var back=document.getElementById("back");
    var settingbtn=document.getElementById("settingbtn");
    var settingbtn2=document.getElementById("settingbtn2");
    var setting=document.getElementById("setting");
    back.addEventListener("click",()=>{
        setting.style.left="-100%";
        setting.style.opacity="0";
    });
    settingbtn.addEventListener("click",()=>{
        setting.style.left="0%";
        setting.style.opacity="1";
    })
    settingbtn2.addEventListener("click",()=>{
        setting.style.left="0%";
        setting.style.opacity="1";
    });
    setInterval(() => {
    $.ajax({
        type:'post',
        url:'checkStatus.php',
        data:{
            senderName:'<?php echo"$senderName"?>'
        },
        success:(result)=>{
            $('#status').html(result);
        }
    });
}, 500);
</script>
