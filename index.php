<?php
session_start();
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
        @media only screen and (max-width: 1000px) {
            form{
            width: 95%!important;
            }
        }
    </style>
</head>
<body>
    <div class="maindiv">
       <center> <h1>WELCOME TO TODO APP</h1> </center>  

       <form action="" method="post">
           <legend class="btn btn-primary">USER LOGIN TODO APP</legend>
       <div class="mb-3">
  <label for="uname" class="form-label">ENTER USER NAME</label>
  <input type="text" class="form-control" id="formGroupExampleInput" name="uname" placeholder="ENTER USERNAME" required>
</div>
<div class="mb-3">
  <label for="pass" class="form-label">PASSWORD</label>
  <input type="password" class="form-control" id="formGroupExampleInput2" name="pass" placeholder="ENTER PASSWORD" required>
</div>
<input class="btn btn-primary" type="submit" name="submit" value="submit">
<br>
        NEW TO TODO APP? <a href="register.php">REGISTER HERE</a>
       </form>

    </div>


    <?php
    
    if(isset($_POST['submit']))
    {
      
        @$uname=$_POST['uname'];
        @$pass=$_POST['pass'];



        @$unche = mysqli_query($conn,"SELECT * FROM `user` WHERE `uname`='$uname'");
        @$unche1 = mysqli_num_rows($unche);
        if(@$unche1 == 0)
        {
            echo "<script>alert('INVALID USERNAME')</script>";
        }


        else if($unche1 >0) {
            @$hpassword = hash('sha512', $pass);
            @$que = "SELECT * FROM `user` WHERE `uname`='$uname' AND `password`='$hpassword'";
            echo $que;
            @$passche = mysqli_query($conn,$que);
            @$passche1 = mysqli_num_rows($passche);
            if(@$passche1 == 0)
            {
                echo "<script>alert('INVALID PASSWORD')</script>";
                @$fetuns = mysqli_fetch_assoc($unche);
                @$uname = $fetuns['uname'];
                @$email = $fetuns['email'];
                @$phone = $fetuns['phone'];
                @$id = $fetuns['id'];

            }
            else if($passche1 >0)

            { @$hpassword = hash('sha512', @$pass);
                @$passche = mysqli_query($conn,"SELECT * FROM `user` WHERE `uname`='$uname' AND `password`='$hpassword'");
                @$fetuns = mysqli_fetch_assoc($unche);
                @$uname = $fetuns['uname'];
                @$email = $fetuns['email'];
                @$phone = $fetuns['phone'];
                @$id = $fetuns['id'];
                

                @$_SESSION['uname']=$uname;
                @$_SESSION['email']=$email;
                @$_SESSION['phone']=$phone;
                @$_SESSION['id']=$id;
                @$_SESSION['login']=true;

                echo "<script>alert('LOGIN SUCCESSFULL')</script>";
                echo "<script>window.location.href='feed.php'</script>";

            }
        }

    }
    ?>
</body>
</html>