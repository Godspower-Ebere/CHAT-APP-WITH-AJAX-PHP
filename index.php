<?php
include("asset/connect.php");
$echo="";
if(isset($_POST["submit"])){
    $name=$_POST["nameornumber"];
    $number=$_POST["nameornumber"];
    $password=$_POST["password"];

    $check=mysqli_query($connect,"SELECT * FROM account WHERE name='$name' AND password='$password' OR number='$number' AND password='$password'");
    if (mysqli_num_rows($check)>0){
        while($row=mysqli_fetch_assoc($check)){
            $id=$row["id"];
            session_start();
            $_SESSION["id"]=$id;
            if (isset($_SESSION["id"])){
                mysqli_query($connect,"UPDATE account SET status='online' WHERE id='$id'");
                header("location:asset/welcome.php");
            }
        }
    }
    else{
        $echo="<p class='alert alert-danger'>User Not Registered</p>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="rfresh" content="1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="fontawesome/css/solid.min.css">
    <link rel="icon" href="images/favicon.png">
</head>
<body>
    <div class="image">
    <img src="images/amibba-logo.png" alt="amibba-logo.png">
    </div>
   
   <form method="post">
    <h1 class="text-center fw-bold ">LOGIN</h1>
    <div><?php echo $echo ?></div>
    <input name="nameornumber" type="text"  placeholder="NAME OR PHONE NUMBER">
    <br>
    <input name="password" type="password"  placeholder="PASSWORD">
    <br>
    <input name="submit" type="submit" class="form-control btn button" value="LOGIN"> 
    <br>
    <p>Don't Have An Account? <a href="asset/sign-up.php">Create One.</a></p>
</form>
</body>
</html>
<script src="jquery/jquery.js"></script>