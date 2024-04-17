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
    mysqli_query($connect,"UPDATE chat SET sender='$name'  WHERE sender='$senderName' ");
    mysqli_query($connect,"UPDATE chat SET reciever='$name'  WHERE reciever='$senderName' ");
    mysqli_query($connect,"UPDATE account SET name='$name',
     surname='$sname' , number='$number', password='$password', image='$image' WHERE id='$id' ");
}
if (isset($_GET["id"])){
    $friendid=$_GET["id"];
    $findfriend=mysqli_query($connect,"SELECT * FROM account WHERE id='$friendid'");
    $friendresult=mysqli_fetch_assoc($findfriend);
    $friendname=$friendresult["name"];
    $friendsurname=$friendresult["surname"];
    $friendimage=$friendresult["image"];
    $friendgender=$friendresult["gender"];
    $friendstatus=$friendresult["status"];
    if($friendimage==""){
        if ($friendgender=="male"){
            $friendimage="male.png";
        }
        else{
            $friendimage="female.png";
        }
    }
    
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
    <link rel="stylesheet" href="../css/chat.css">
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
        <div class="welcome" id="result">
            <div class='head'>
                <img src=<?php echo"../upload/$friendimage"?> alt=''>
                <h4 style='text-transform:capitalize;'><?php echo"$friendname $friendsurname"?></h4>
                <i style='text-transform:capitalize;' id="online"></i>
            </div>
            <div class='message'>
                    <ul id="show">

                    </ul>
                    <i class="fas fa-arrow-down" id="down"></i>
            </div>
            <div class='send'>
                <div class='cont' id='cont'>
                    <ul id='ul'>
                    <li>&#x1F600;</li>
                    <li>&#x1F601;</li>
                    <li>&#x1F602;</li>
                    <li>&#x1F603;</li>
                    <li>&#x1F604;</li>
                    <li>&#x1F605;</li>
                    <li>&#x1F606;</li>
                    <li>&#x1F607;</li>
                    <li>&#x1F608;</li>
                    <li>&#x1F609;</li>
                    <li>&#x1F60A;</li>
                    <li>&#x1F60B;</li>
                    <li>&#x1F60C;</li>
                    <li>&#x1F60D;</li>
                    <li>&#x1F60E;</li>
                    <li>&#x1F60F;</li>
                    <li>&#x1F610;</li>
                    <li>&#x1F611;</li>
                    <li>&#x1F612;</li>
                    <li>&#x1F613;</li>
                    <li>&#x1F614;</li>
                    <li>&#x1F615;</li>
                    <li>&#x1F616;</li>
                    <li>&#x1F617;</li>
                    <li>&#x1F618;</li>
                    <li>&#x1F619;</li>
                    <li>&#x1F61A;</li>
                    <li>&#x1F61B;</li>
                    <li>&#x1F61C;</li>
                    <li>&#x1F61D;</li>
                    <li>&#x1F61E;</li>
                    <li>&#x1F61F;</li>
                    <li>&#x1F620;</li>
                    <li>&#x1F621;</li>
                    <li>&#x1F622;</li>
                    <li>&#x1F623;</li>
                    <li>&#x1F624;</li>
                    <li>&#x1F625;</li>
                    <li>&#x1F626;</li>
                    <li>&#x1F627;</li>
                    <li>&#x1F628;</li>
                    <li>&#x1F629;</li>
                    <li>&#x1F62A;</li>
                    <li>&#x1F62B;</li>
                    <li>&#x1F62C;</li>
                    <li>&#x1F62D;</li>
                    <li>&#x1F62E;</li>
                    <li>&#x1F62F;</li>
                    <li>&#x1F630;</li>
                    <li>&#x1F631;</li>
                    <li>&#x1F632;</li>
                    <li>&#x1F633;</li>
                    <li>&#x1F634;</li>
                    <li>&#x1F635;</li>
                    <li>&#x1F636;</li>
                    <li>&#x1F637;</li>
                    <li>&#x1F638;</li>
                    <li>&#x1F639;</li>
                    <li>&#x1F63A;</li>
                    <li>&#x1F63B;</li>
                    <li>&#x1F63C;</li>
                    <li>&#x1F63D;</li>
                    <li>&#x1F63E;</li>
                    <li>&#x1F63F;</li>
                    <li>&#x1F640;</li>
                    <li>&#x1F641;</li>
                    <li>&#x1F642;</li>
                    <li>&#x1F643;</li>
                    <li>&#x1F644;</li>
                    </ul>
                </div>
                <button class='emoji' id='emoji'>&#x1F600;</button>
                <textarea class='' id='text'></textarea>
                <button class='fas fa-paper-plane shadow' id='insert'></button>
            </div>
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
    
    var cont=document.getElementById('cont');
    var ul=document.getElementById('ul');
    var emoji=document.getElementById('emoji');
    var text=document.getElementById('text');
    var button=document.getElementById('insert');
    var down=document.getElementById('down');
    var scroll=document.getElementById("show");
    
    setInterval(()=>{
        if (text.value==''){
            button.disabled=true;
        }
        else{
            button.disabled=false;
        }
        $.ajax({
        type:'post',
        url:'showdata.php',
        data:{
            senderid:<?php echo"$id"?>,
            recieverid:<?php echo"$friendid"?>,
        },
        success:(result)=>{
            $('#show').html(result);
        }   
    });
    },1000);
    
    emoji.addEventListener('click',()=>{
        if(cont.style.display=='none'){
            cont.style.display='block';
        }
        else{
            cont.style.display='none';
        }
    });                         
    ul.addEventListener('click',(event)=>{
        if (event.target.tagName=='LI'){
            text.value+=event.target.textContent;
        }
    });

    $('#insert').click(()=>{
        var msg=$('#text').val();
        var scroll=document.getElementById("show");
        $.ajax({
            type:'post',
            url:'insertMsg.php',
            data:{
                senderid:<?php echo"$id"?>,
                recieverid:<?php echo"$friendid"?>,
                message:msg
            },
            success:()=>{
                var message=document.getElementById('text');
                message.value='';
                $.ajax({
                    type:'post',
                    url:'showdata.php',
                    data:{
                        senderid:<?php echo"$id"?>,
                        recieverid:<?php echo"$friendid"?>,
                    },
                    success:(result)=>{
                        $('#show').html(result);
                        scroll.scrollTop=scroll.scrollHeight;
                    }
                });
                }
        }); 
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
    $.ajax({
        type:'post',
        url:'friendstatus.php',
        data:{
            id:'<?php echo"$friendid";?>'
        },
        success:(result)=>{
            $('#online').html(result);
        }
    });
    var h=scroll.scrollHeight;
    var t=scroll.scrollTop+700;
    if(t>=h){
        down.style.display="none";
    }
    else{
        down.style.display="block";
    }
}, 500);

down.addEventListener("click",()=>{
    scroll.scrollTop=scroll.scrollHeight;
})

</script>