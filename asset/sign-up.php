<?php
include("connect.php");
$echo="";
if(isset($_POST["submit"])){
    $name=$_POST["name"];
    $surname=$_POST["surname"];
    $number=$_POST["number"];
    $gender=$_POST["gender"];
    $password=$_POST["password"];
    $confirmPassword=$_POST["confirmPassword"];
    $image=$_FILES["image"]["name"];
    $imagetmp=$_FILES["image"]["tmp_name"];
    move_uploaded_file($imagetmp,"../upload/$image");
    if (strlen($number)==11){
        if($password==$confirmPassword){
            $check=mysqli_query($connect,"SELECT * FROM account WHERE name='$name' AND surname='$surname' AND number='$number' AND gender='$gender' AND password='$password' AND image='$image' ");
            if (mysqli_num_rows($check)>0){
                $person=strtoupper($name);
                $echo="<p class='alert alert-danger'>$person You Have Already Created An Account Before Login <a href='../index.php'>Here</a></p>"; 
            }
            else{
                mysqli_query($connect,"INSERT INTO account VALUES('','$name','$surname','$number','$gender','$password','$image','offline')");
                $echo="<p class='alert alert-success'>Account Created Successfully !!!</p>";
            }
            
        }
        else{
            $echo="<p class='alert alert-danger'>Password Mismatched</p>";
        }
    }
    else{
        $echo="<p class='alert alert-danger'>Incorrect Phone Number</p>";
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
    <title>Sign-Up</title>
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../fontawesome/css/solid.min.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <div class="image">
    <img src="../images/amibba-logo.png" alt="amibba-logo.png">
    </div>
   
   <form method="post" enctype="multipart/form-data">
    <h1 class="text-center fw-bold ">Sign-Up</h1>
    <div><?php echo $echo?></div>
    <input name="name" type="text"  placeholder="NAME" required>
    <br>
    <input name="surname" type="text"  placeholder="SURNAME" required>
    <br>
    <input name="number" type="number"  placeholder="PHONE NUMBER" required>
    <br>
    <select name="gender" id="">
        <option value="" disabled>GENDER</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>
    <br>
    <input name="password" type="password"  placeholder="PASSWORD" required>
    <br>
    <input name="confirmPassword" type="password"  placeholder="CONFIRM PASSWORD" required>
    <br>
    <label for="" class="form-label">Image</label>
    <input name="image" type="file"  class="form-control image" >
    <br>
    <input name="submit" type="submit" class="form-control btn button" value="Sign-Up"> 
    <br>
    <p>Already have an account? <a href="../index.php">Login.</a></p>
</form>
</body>
</html>
<script src="jquery/jquery.js"></script>