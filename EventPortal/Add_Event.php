<!DOCTYPE html>
<html lang="en">

<head>
    <title>BCU Event Portal - Add Event</title>
    <link rel="shortcut icon" type="image" href="images/bcu_1.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(to bottom, rgba(144, 238, 144, 1), rgba(144, 238, 144, 0));
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>

<body>
    <?php
    include('Nav_Home.php');
    ?>
    <?php
    session_start();
    include 'Db_Con.php';
    if (!isset($_SESSION['uid']) && ($_SESSION['utype'] == "dc")) {
        echo "<script>window.location.replace('Login.php')</script>";
    } else {
        ?>
        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
            enctype="multipart/form-data">
            <div class="container mt-3 w-50 p-4 border border-primary rounded-3 shadow mb-5 bg-body-tertiary rounded">
                <h2 class="text-center text-primary">Add Event</h2>
                <hr>

                <div class="mb-3">
                    <label for="ename" class="form-label">Event Name</label>
                    <input id="ename" name="ename" type="text" placeholder="Event Name" class="form-control" required="">
                </div>
                <div class="mb-3">
                    <label for="event_coordinator" class="form-label">Select Event Coordinator</label>
                    <select id="event_coordinator" name="event_coordinator" class="form-control">
                        <option value="">Select Event</option>
                        <?php
                        $sql = "select coor_id,coor_name from event_coordinator where status <> 1";
                        $result = mysqli_query($con, $sql);
                        while ($rows = mysqli_fetch_array($result)) {

                            $event_cid = $rows['coor_id'];
                            $name = $rows['coor_name'];

                            ?>
                            <option value="<?php echo $event_cid ?>"><?php echo $name ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group" style="text-align:center">
                    <label class="control-label" for="register"></label>
                    <div class="col-md-12">
                        <button id="register" name="register" class="btn btn-primary">Add Event</button>
                        <a class="btn btn-primary" href="Admin_Home.php">Back</a>
                        <button id="clear" name="clear" class="btn btn-danger" type="reset">Clear</button>
                    </div>
                </div>
            </div>
        </form>
        <?php include('Footer.php') ?>
    </body>

    </html>

    <?php

    }
    ?>

<?php

if (isset($_POST['register'])) {
    include 'Db_Con.php';
    $ename = $_POST['ename'];
    $sql = "select * from events where ename='$ename'";
    $result = mysqli_query($con, $sql);
    $no_of_rows = mysqli_num_rows($result);
    if ($no_of_rows > 0) {
        echo ("<script>alert(\"Event name already exist!\")</script>");
    } else {
        $coor = $_POST['event_coordinator'];
        $sql = "insert into events(ename,event_cid) values('$ename','$coor')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $sql1 = "update event_coordinator set status=1 where coor_id=" . $coor;
            $result1 = mysqli_query($con, $sql1);
            if ($result1) {
                echo ("<script>alert(\"Event  Added Successfully...\")</script>");
            }
        } else {
            echo ("<script>alert(\"Event Addition Failed...\n\n Try Again\")</script>");
        }

    }
}

?>