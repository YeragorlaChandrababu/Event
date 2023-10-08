<!DOCTYPE html>
<html lang="en">

<head>
    <title>BCU Event Portal - Update Event</title>
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
                <h2 class="text-center text-primary">Update Event</h2>
                <hr>
                <div class="mb-3 row">
                    <label for="id" class="form-label">Event Id</label>
                    <div class="col-sm-9">
                        <input id="id" name="id" type="number" placeholder="Event Id" class="form-control" required>
                    </div>
                    <div class="col-sm-3">
                        <button id="retrieveData" name="retrieveData" class="btn btn-primary">Retrieve</button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="ename" class="form-label">Event Name</label>
                    <input id="ename" name="ename" type="text" placeholder="Enter Event Name" class="form-control"
                        aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Event Names(Like Cricket, Chess, Essay writing...etc.)</div>
                </div>
                <div class="mb-3">
                    <label for="selected_coor" class="form-label">Current Coordinator</label>
                    <input id="selected_coor" name="selected_coor" type="text" class="form-control"
                        aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Don't alter value</div>
                </div>
                <div class="mb-3">
                    <label for="event_coordinator" class="form-label">Select Coordinator to Change</label>
                    <select id="event_coordinator" name="event_coordinator" class="form-control">
                        <option value="">Select Event Coordinator</option>
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
                    <div class="col-md-12">
                        <button id="update" name="update" class="w-50 btn btn-primary">Update</button>
                        <a class="btn btn-primary" href="Admin_Home.php">Back</a>
                        <button id="clear" name="clear" class="btn btn-danger" type="reset">Clear</button>
                    </div>
                </div>
        </form>
        </div>
        <?php include('Footer.php') ?>
    </body>

    </html>
    <?php
    if (isset($_POST['retrieveData'])) {
        if (isset($_POST['id'])) {
            $eventid = mysqli_real_escape_string($con, $_POST['id']);
            $sql1 = "SELECT ename, event_cid FROM events WHERE eventid='$eventid'";
            $result1 = mysqli_query($con, $sql1);

            if (!$result1) {
                echo "Database query error: " . mysqli_error($con);
            } else {
                if (mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $data = array(
                        'name' => $row['ename'],
                        'event_cid' => $row['event_cid'],
                    );
                    echo "<script>";
                    echo "document.getElementById('id').value = '" . $eventid . "';";
                    echo "document.getElementById('ename').value = '" . $data['name'] . "';";
                    $sql2 = "select coor_name from event_coordinator where coor_id=" . $row['event_cid'];
                    $query2 = mysqli_query($con, $sql2);
                    if (mysqli_num_rows($query2) > 0) {
                        $row1 = mysqli_fetch_assoc($query2);
                        echo "document.getElementById('selected_coor').value = '" . $data['event_cid'] . " - " . $row1['coor_name'] . "';";
                    }
                    echo "</script>";
                } else {
                    echo "<script>alert('Event Not Present with Id: " . $eventid . "');</script>";
                }
            }
        }
    }

    if (isset($_POST['update'])) {
        include 'Db_Con.php';
        $eventid = $_POST['id'];
        $checkSql = "SELECT * FROM events WHERE eventid='$eventid'";
        $checkResult = mysqli_query($con, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            $name = $_POST['ename'];
            $currcoor = substr($_POST['selected_coor'], 0, 1);
            $coor = $_POST['event_coordinator'];
            $sql = "UPDATE events SET ename='$name', event_cid='$coor' WHERE eventid='$eventid'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $sql1 = "Update event_coordinator SET status=1 where coor_id=" . $coor;
                $sql2 = "Update event_coordinator SET status=0 where coor_id=" . $currcoor;
                $result1 = mysqli_query($con, $sql1);
                $result2 = mysqli_query($con, $sql2);
                if ($result1 and $result2) {
                    echo ("<script>alert(\"Event Updated Successfully...\")</script>");
                }
            } else {
                echo ("<script>alert(\"Event Update Failed...\n\n Try Again\")</script>");
            }
        } else {
            echo ("<script>alert(\"Event with ID " . $eventid . " does not exist\")</script>");
        }
    }
    }
    ?>