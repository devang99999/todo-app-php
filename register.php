<?php
require_once("config.php");
require("boot.php");




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        .maindiv{

            width: 100%;
            height: 100vh;
            background:url(back.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            filter: brightness(90%);
            z-index: -1;
        }
       
        form{
            width: 20%;
            height: auto;
            background-color: #fff;
            margin: 0 auto;
            margin-top: 10%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 3px #000;
        }
    </style>
</head>
<body>
    <div class="maindiv">
       <center> <h1 style="color:#f5f5f7;font-weight:900; background:dodgerblue">WELCOME TO TODO APP</h1> </center>  

       <form action="" method="post">
           <legend class="btn btn-primary">USER REGISTRATION TODO APP</legend>
       <div class="mb-3">
  <label for="uname" class="form-label">ENTER USER NAME</label>
  <input type="text" class="form-control" id="formGroupExampleInput" name="uname" placeholder="ENTER USERNAME" required>
</div>
<div class="mb-3">
  <label for="pass" class="form-label">PASSWORD</label>
  <input type="password" class="form-control" id="formGroupExampleInput2" name="pass" placeholder="ENTER PASSWORD" required>
</div>
<div class="mb-3">
  <label for="cpass" class="form-label">CONFIRM PASSWORD</label>
  <input type="password" class="form-control" id="formGroupExampleInput2" name="cpass" placeholder="CONFIRM  PASSWORD" required>
</div>
<div class="mb-3">
  <label for="email" class="form-label">E-MAIL</label>
  <input type="email" class="form-control" id="formGroupExampleInput2" name="email" placeholder="ENTER EMAIL" required>
</div>
<div class="mb-3">
  <label for="phone" class="form-label">PHONE</label>
  <input type="number" class="form-control" id="formGroupExampleInput2" name="phone" placeholder="ENTER PHONE NUMBER" required>
</div>
<input class="btn btn-primary" type="submit" name="submit" value="submit">
<br>
        ALREADY A USER? <a href="index.php">REGISTER HERE</a>
       </form>

    </div>


    <?php
    
    if(isset($_POST['submit']))
    {
      
        $uname=$_POST['uname'];

        $pass=$_POST['pass'];
        $cpass=$_POST['cpass'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
      if($uname !="" || $pass!="" || $cpass!="" || $email!="" || $phone!="")

      {
          echo "<script>alert('Please fill all the fields')</script>";
      }
       if($pass!=$cpass)
      {
        echo "<script>alert('Password and Confirm Password should be same')</script>";
      }
      elseif(!preg_match("/^[a-zA-Z0-9]*$/",$uname))
      {
        echo "<script>alert('Username should be alphanumeric')</script>";
      }
      // elseif(!preg_match("/^[a-zA-Z0-9]*$/",$pass))
      // {
      //   echo "<script>alert('Password should be alphanumeric')</script>";
      // }
      // elseif(!preg_match("/^[a-zA-Z0-9]*$/",$cpass))
      // {
      //   echo "<script>alert('Confirm Password should be alphanumeric')</script>";
      // }
      elseif(!preg_match("/^[a-zA-Z0-9]*$/",$phone))
      {
        echo "<script>alert('Phone Number should be numeric')</script>";
      }
      elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        echo "<script>alert('Invalid Email')</script>";
      }

      else
      {
        $hpassword = hash('sha512', $pass);
        $sql="INSERT INTO `user`(`uname`, `password`, `phone`, `email`) VALUES ('$uname','$hpassword','$phone','$email')";
        echo $sql;
        $result=mysqli_query($conn,$sql);
        if($result)
        
       
        {
            echo "<script>alert('User Registered Successfully')</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
        else
        {
            echo "<script>alert('User Registration Failed')</script>";
        }
        }
      }
    ?>
</body>
</html>