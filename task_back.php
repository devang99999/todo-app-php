<?php
    if(isset($_POST['submit']))
    {

        require('config.php');
        session_start();
        $task = $_POST['task'];
        $date = $_POST['ddate'];
        $task = mysqli_real_escape_string($conn, $task);
        $uname = $_SESSION['id'];
        $newname = uniqid('todo_task', true) . "." . $uname;
        $sql = "INSERT INTO `tasks`(`task_id`,`uname_id`,`task`,`cdate`) VALUES ('$newname','$uname','$task','$date')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('TASK ADDED SUCCESSFULLY')</script>";
            echo "<script>window.location.href='feed.php'</script>";
        } else {
            echo "<script>alert('TASK NOT ADDED')</script>";
            echo "<script>window.location.href='feed.php'</script>";
        }
        
    }




    if(@$_GET['d'] == "delete")
    {
        require('config.php');
        session_start();
        $uname = $_SESSION['id'];
        $tid = $_GET['tid'];
        $sql = "DELETE FROM `tasks` WHERE `task_id` = '$tid' AND `uname_id` = '$uname'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('TASK DELETED SUCCESSFULLY')</script>";
            echo "<script>window.location.href='feed.php'</script>";
        } else {
            echo "<script>alert('TASK NOT DELETED')</script>";
            echo "<script>window.location.href='feed.php'</script>";
        }
    }
    if(@$_GET['d'] == "complete")
    {
        require('config.php');
        session_start();
        $uname = $_SESSION['id'];
        $tid = $_GET['tid'];
        $sql = "UPDATE tasks SET status = 1 WHERE task_id = '$tid' AND uname_id = '$uname'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('CONGRATS YOU HAVE COMPLETED THE TASK🥳🎉🎊')</script>";
            echo "<script>window.location.href='feed.php'</script>";
        } else {
            echo "<script>alert('TASK NOT DELETED')</script>";
            echo "<script>window.location.href='feed.php'</script>";
        }
    }
    
    ?>
