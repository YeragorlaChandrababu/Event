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
    $eventeid = "";
    session_start();
    include 'Db_Con.php';
    if (!isset($_SESSION['uid']) && ($_SESSION['utype'] == "ec")) {
        echo "<script>window.location.replace('Login.php')</script>";
    } else {
        $sql = "SELECT coor_id, coor_name  FROM event_coordinator WHERE email='" . $_SESSION['uid'] . "'";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            echo "Database query error: " . mysqli_error($con);
        } else {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $coor_id = $row['coor_id'];
                $sql3 = "SELECT eventid, ename, winner_regno, runner_regno FROM events WHERE event_cid='" . $coor_id . "'";
                $result3 = mysqli_query($con, $sql3);

                if (!$result3) {
                    echo "Database query error: " . mysqli_error($con);
                } else {
                    if (mysqli_num_rows($result3) > 0) {
                        $row3 = mysqli_fetch_assoc($result3);
                        $sql4 = "SELECT id, Reg_no, eventid, status FROM participant WHERE eventid='" . $row3['eventid'] . "'";
                        $result4 = mysqli_query($con, $sql4);
                        ?>
                        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                            enctype="multipart/form-data">
                            <?php
                            if (!$result4) {
                                echo "Database query error: " . mysqli_error($con);
                            } else {
                                if (mysqli_num_rows($result4) > 0) {
                                    echo '<div class="container mt-3 w-70 p-4 border border-primary rounded-3 shadow mb-5 bg-body-tertiary rounded"><h2 class="text-center text-success">Announce Results for ' . $row3['ename'] . '</h2><hr>';
                                    echo '<table class="table table-bordered ">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Sl. No</th>';
                                    echo '<th>Event ID</th>';
                                    echo '<th>Event Name</th>';
                                    echo '<th>Winner</th>';
                                    echo '<th>Runner</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    $row4 = mysqli_fetch_assoc($result4);
                                        echo '<tr>';
                                        echo '<td>1</td>';
                                        $eventeid = $row4['eventid'];
                                        echo '<td>' . $row4['eventid'] . '</td>';
                                        echo '<td>' . $row3['ename'] . '</td>';
                                        echo '<td><select id="winner" name="winner" class="form-control">
                                        <option value="" required>Select Winner</option>';
                                        // $sql = "SELECT id, Reg_no, eventid, status FROM participant WHERE eventid='" . $row3['eventid'] . "'";
                                        $sql = "SELECT id, Reg_no, eventid FROM participant WHERE eventid='" . $row3['eventid'] . "' AND status = 1";
                                        $result = mysqli_query($con, $sql);
                                        while ($rows = mysqli_fetch_array($result)) {

                                            $winner_reg = $rows['Reg_no'];

                                            ?>
                                            <option value="<?php echo $winner_reg ?>"><?php echo $winner_reg ?></option>
                                            <?php
                                        }
                                        if ($row3['winner_regno']) {
                                            echo '</select><span>Current Winner: ' . $row3['winner_regno'] . '</span></div>';
                                        } else {
                                            echo '</select><span>Winner Not Announced</span></div>';
                                        }
                                        echo '</td>';
                                        echo '<td><select id="runner" name="runner" class="form-control required">
                                        <option value="">Select Runner</option>';
                                        $sql = "SELECT id, Reg_no, eventid FROM participant WHERE eventid='" . $row3['eventid'] . "' AND status = 1";
                                        $result = mysqli_query($con, $sql);
                                        while ($rows = mysqli_fetch_array($result)) {
                                            $runner_reg = $rows['Reg_no'];
                                            ?>
                                            <option value="<?php echo $runner_reg ?>"><?php echo $runner_reg ?></option>
                                            <?php
                                        }
                                        echo '</select>';
                                        if ($row3['runner_regno']) {
                                            echo '</select><span>Current Runner: ' . $row3['runner_regno'] . '</span></div>';
                                        } else {
                                            echo '</select><span>Runner Not Announced</span></div>';
                                        }
                                        echo '</td>';

                                        echo '</tr>';
                                    
                                    echo '</tbody>';
                                    echo '</table>';

                                    echo '<div class="form-group" style="text-align:center">
                    <label class="control-label" for="announce"></label>
                    <div class="col-md-6">
                        <button id="announce" name="announce" class="btn btn-primary m-3">Announce</button>';
                                    echo '<a href="CoOrdinator_Home.php" class="btn btn-primary">Back</a>';
                                    echo '</div></div>';

                                } else {
                                    echo 'Student Registrations not found!';
                                    echo '<a href="CoOrdinator_Home.php" class="btn btn-primary">Back</a>';

                                }
                            }
                    }
                }
            }
        }
    }
    if (isset($_POST['announce'])) {
        include 'Db_Con.php';
        $winner = $_POST['winner'];
        $runner = $_POST['runner'];
        if ($winner == $runner) {
            echo ("<script>alert(\"Winner and Runner Cannot be same...!\")</script>");
        } else {
            $sql9 = "update events set winner_regno='$winner', runner_regno='$runner' where eventid=" . $eventeid;
            $result9 = mysqli_query($con, $sql9);
            if ($result9) {
                echo ("<script>alert(\"Results updated successfully...\")</script>");
                sleep(2);
                header("Location: Announce_Res.php");
            } else {
                echo ("<script>alert(\"Result Updation Failed...\n\n Try Again\")</script>");
            }
            
        }
    }
    ?>

    </form>
    </div>
    <?php include('Footer.php') ?>
</body>

</html>