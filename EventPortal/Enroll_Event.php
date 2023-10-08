<!DOCTYPE html>
<html lang="en">

<head>
    <title>BCU Event Portal - Enroll</title>
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
    if (!isset($_SESSION['uid']) && ($_SESSION['utype'] == "student")) {
        echo "<script>window.location.replace('Login.php')</script>";
    } else {
        ?>
        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
            enctype="multipart/form-data">
            <div class="container mt-3 w-50 p-4 border border-primary rounded-3 shadow mb-5 bg-body-tertiary rounded">
                <h2 class="text-center text-primary">Enroll for Event</h2>
                <hr>

                <div class="mb-3">
                    <label for="event" class="form-label">Select Available Event</label>
                    <select id="event" name="event" class="form-control" required>
                        <option value="">Select Available Event</option>
                        <?php
                        $sql = "select eventid,ename from events";
                        $result = mysqli_query($con, $sql);
                        while ($rows = mysqli_fetch_array($result)) {
                            $eventid = $rows['eventid'];
                            $ename = $rows['ename'];
                            ?>
                            <option value="<?php echo $eventid ?>"><?php echo $ename ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group" style="text-align:center">
                    <div class="col-md-12">
                        <button id="update" name="update" class="w-50 btn btn-primary">Enroll</button>
                        <a href="Student_Home.php" class="btn btn-primary">Back</a>
                        <button id="clear" name="clear" class="btn btn-danger" type="reset">Clear</button>
                    </div>
                </div>
        </form>
        </div>
        <div>
            <?php
            $sql1 = "SELECT sid, reg_no FROM student WHERE email='" . $_SESSION['uid'] . "'";
            $result1 = mysqli_query($con, $sql1);
            if (!$result1) {
                echo "Database query error: " . mysqli_error($con);
            } else {
                if (mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $reg_no = $row['reg_no'];
                    $sql3 = "SELECT id, Reg_no, eventid, status FROM participant WHERE Reg_no='" . $reg_no . "'";
                    $result3 = mysqli_query($con, $sql3);
                    if (!$result3) {
                        echo "Database query error: " . mysqli_error($con);
                    } else {
                        echo '<div class="container mt-3 w-70 p-4 border border-primary rounded-3 shadow mb-5 bg-body-tertiary rounded"><h5 class="text-center test-success">Registered Events</h5><hr>';
                        echo '<table class="table table-bordered ">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Registration ID</th>';
                        echo '<th>Regtration No</th>';
                        echo '<th>Event ID</th>';
                        echo '<th>Status</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            if ($row3['status'] == 0) {
                                $status = "<span class='text-danger'>Applied</span>";
                            } else {
                                $status = "<span class='text-success'>Approved</span>";
                            }
                            echo '<tr>';
                            echo '<td>' . $row3['id'] . '</td>';
                            echo '<td>' . $row3['Reg_no'] . '</td>';
                            $sql6 = "select ename from events where eventid=" . $row3['eventid'];
                            $query6 = mysqli_query($con, $sql6);
                            if (mysqli_num_rows($query6) > 0) {
                                $row6 = mysqli_fetch_assoc($query6);
                                echo '<td>' . $row3['eventid'] . ' - ' . $row6['ename'] . '</td>';
                            }else{
                            echo '<td>' . $row3['eventid'] . '</td>';
                            }
                            echo '<td>' . $status . '</td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    }
                }
            }
            ?>
        </div>
        </div>
        <?php include('Footer.php') ?>
    </body>

    </html>

    <?php
    if (isset($_POST['update'])) {
        include 'Db_Con.php';
        $eventid = $_POST['event'];
        $sql4 = "SELECT sid, reg_no FROM student WHERE email='" . $_SESSION['uid'] . "'";
        $result4 = mysqli_query($con, $sql4);
        if (!$result4) {
            echo "Database query error: " . mysqli_error($con);
        } else {
            if (mysqli_num_rows($result1) > 0) {
                $row4 = mysqli_fetch_assoc($result4);
                $reg_no = $row4['reg_no'];
                $status = 0;
                $reg_no = mysqli_real_escape_string($con, $reg_no); // Sanitize input
                $eventid = mysqli_real_escape_string($con, $eventid); // Sanitize input
                $checkSql = "SELECT COUNT(*) AS count FROM participant WHERE Reg_no = '$reg_no' AND eventid = '$eventid'";
                $checkResult = mysqli_query($con, $checkSql);

                if (!$checkResult) {
                    echo "<script>alert(\"Registration Failed due to a database error. Please try again.\")</script>";
                } else {
                    $row = mysqli_fetch_assoc($checkResult);
                    $count = $row['count'];

                    if ($count > 0) {
                        echo "<script>alert(\"Registration already exists for Selected Event\")</script>";
                    } else {
                        $sql = "INSERT INTO participant (Reg_no, eventid, status) VALUES ('$reg_no', '$eventid', '$status')";
                        $result = mysqli_query($con, $sql);

                        if ($result) {
                            echo "<script>alert(\"Registration Successful...\")</script>";
                        } else {
                            echo "<script>alert(\"Registration Failed. Please try again.\")</script>";
                        }
                    }
                }
            } else {
                echo ("<script>alert(\"Student with ID " . $eventid . " does not exist\")</script>");
            }
        }
    }
    }
    ?>
</body>

</html>