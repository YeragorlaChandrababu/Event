<!DOCTYPE html>
<html lang="en">

<head>
    <title>BCU Event Portal - Approve</title>
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
    session_start();
    include 'Db_Con.php';

    if (!isset($_SESSION['uid']) || ($_SESSION['utype'] != "ec")) {
        echo "<script>window.location.replace('Login.php')</script>";
    } else {
        if (isset($_GET['id'])) {
            $registrationId = $_GET['id'];
            $updateSql = "UPDATE participant SET status = 1 WHERE id = '$registrationId'";
            $updateResult = mysqli_query($con, $updateSql);

            if ($updateResult) {
                echo '<script>alert("Registration approved successfully.");</script>';
                header("Location: Approve_Partic.php");
                exit;
            } else {
                echo "Failed to approve registration. Please try again.";
            }
        } else {
            $sql1 = "SELECT coor_id, coor_name  FROM event_coordinator WHERE email='" . $_SESSION['uid'] . "'";
            $result1 = mysqli_query($con, $sql1);

            if (!$result1) {
                echo "Database query error: " . mysqli_error($con);
            } else {
                if (mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $coor_id = $row['coor_id'];
                    $sql3 = "SELECT eventid, ename FROM events WHERE event_cid='" . $coor_id . "'";
                    $result3 = mysqli_query($con, $sql3);

                    if (!$result3) {
                        echo "Database query error: " . mysqli_error($con);
                    } else {
                        if (mysqli_num_rows($result3) > 0) {
                            $row3 = mysqli_fetch_assoc($result3);
                            $sql4 = "SELECT id, Reg_no, eventid, status FROM participant WHERE eventid='" . $row3['eventid'] . "'";
                            $result4 = mysqli_query($con, $sql4);

                            if (!$result4) {
                                echo "Database query error: " . mysqli_error($con);
                            } else {
                                if (mysqli_num_rows($result4) > 0) {
                                    echo '<div class="container mt-3 w-70 p-4 border border-primary rounded-3 shadow mb-5 bg-body-tertiary rounded"><h2 class="text-center text-success">Student Registraions for ' . $row3['ename'] . '</h2><hr>';
                                    echo '<table class="table table-bordered ">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Registration ID</th>';
                                    echo '<th>Registration No</th>';
                                    echo '<th>Event ID</th>';
                                    echo '<th>Status</th>';
                                    echo '<th>Approve</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    while ($row4 = mysqli_fetch_assoc($result4)) {
                                        if ($row4['status'] == 0) {
                                            $status = "Applied";
                                        } else {
                                            $status = "Approved";
                                        }
                                        $id = $row4['id'];

                                        echo '<tr>';
                                        echo '<td>' . $row4['id'] . '</td>';
                                        echo '<td>' . $row4['Reg_no'] . '</td>';
                                        echo '<td>' . $row4['eventid'] . '-' . $row3['ename'] . '</td>';
                                        echo '<td>' . $status . '</td>';
                                        echo '<td>';
                                        if ($status == 'Applied') {
                                            // Change the link to point to the same page with the "id" query parameter
                                            echo '<a class="btn btn-primary" href="?id=' . $id . '">Approve</a>';
                                        } else {
                                            echo '<a class="btn btn-success" disabled>Approved</a>';
                                        }
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '<a class="btn btn-primary" href="CoOrdinator_Home.php">Back</a>';

                                } else {
                                    echo 'Student Registrations not found!';

                                    echo '<a class="btn btn-primary" href="CoOrdinator_Home.php">Back</a>';

                                }
                            }
                        }
                    }
                }
            }
        }
    }
    ?>
    </div>
</body>
<?php include('Footer.php'); ?>

</html>