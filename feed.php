<?php

session_start();
require "boot.php";
require "config.php";
require "nav.php";


echo $_SESSION['uname'];
echo $_SESSION['email'];
echo $_SESSION['phone'];
echo $_SESSION['id'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .maindiv {

            width: 100%;
            height: auto;
            background: url(back.jpg);
            background-size: cover;
            background-position: center;
            /* background-repeat: no-repeat; */
            background-attachment: fixed;
            filter: brightness(90%);
            z-index: -1;
            padding-top: 25vh;
            padding-bottom: 25vh;
        }

        .secdiv {
            width: 40%;

            margin: auto;
            border-radius: 5%;
            height: auto;
            padding: 50px;
            background-color: #f5f5f7;
        }

        form {
            padding: 50px;
        }

        @media only screen and (max-width: 1000px) {
            .secdiv {
                width: 95%!important;
            }
            .table{
            width: 50%!important;
            }
        }
    </style>
</head>

<body>
    <div class="maindiv">

        <div class="secdiv">
            <form action="task_back.php" method="post">
                <div class="form-outline">
                    <label class="form-label" for="form12">ADD TASK TO DO </label>
                    <input type="text" name="task" id="form12" class="form-control" placeholder="ADD TASK TO DO " /> <br>
                    <label class="form-label" for="date"> COMPLETION DATE </label>
                    <input type="date" class="form-control" name="ddate" id="" required>
                    <input style="margin-top:30px" class="btn btn-primary" type="submit" name="submit" value="ADD TASK">
                </div>
            </form>
            <table class="table align-middle mb-0 bg-white" style="border-collapse: collapse!important;overflow-x:auto!important;border-spacing: 0;">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Task</th>
                        <th>Completion Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tsel = "SELECT * FROM `tasks` WHERE `uname_id` = '" . $_SESSION['id'] . "'";
                    $tres = mysqli_query($conn, $tsel);
                    $tnum = mysqli_num_rows($tres);
                    if ($tnum > 0) {
                        $sr = 0;
                        while ($trow = mysqli_fetch_assoc($tres)) {

                            $task = $trow['task'];
                            $date = $trow['cdate'];
                            $status = $trow['status'];
                            $tid = $trow['task_id'];

                            if ($status == 0) {
                                $status = "IN PROGRESS";
                            } else {
                                $status = "COMPLETED";
                            }
                    ?>
                            <tr>
                                <td>
                                    <?php echo $sr += 1; ?>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1"><?php echo $task; ?></p>

                                </td>
                                <td>
                                    <p class="fw-normal mb-1"><?php echo $date; ?></p>

                                </td>
                                <td>
                                    <p class="fw-normal mb-1"><?php echo $status; ?></p>

                                </td>
                                <td>
                                    <a href="task_back.php?d=delete&tid=<?php echo $tid; ?>">
                                        <b><button type="button" class="btn btn-danger btn-rounded">DELETE</button></b></a>
                                    <br>
                                    <br>
                                    <a href="task_back.php?d=complete&tid=<?php echo $tid; ?>">
                                        <b> <button type="button" class="btn btn-success btn-rounded">COMPLETED</button></b>
                                    </a>
                                </td>
                            </tr>
                    <?php

                        }
                    } else {
                        echo "<h1>NO TASKS ADDED</h1>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>




</body>

</html>