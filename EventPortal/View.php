<?php
session_start();
include 'Db_Con.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BCU Event Portal - Admin</title>
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
<?php
include('Nav_Home.php');
?>
<?php
include 'Db_Con.php';
$view = $_GET['view'];
if (!isset($_SESSION['uid']) && ($_SESSION['utype'] == "dc")) {
    echo "<script>window.location.replace('Login.php')</script>";
} else {
    if ($view == 'events') {
        include 'Db_Con.php';
        $sql = "select eventid, ename, event_cid,winner_regno, runner_regno from $view";
        $query = mysqli_query($con, $sql);
        if (mysqli_num_rows($query) > 0) {
            echo '<div class="container mt-5"><h2>Events</h2>';
            echo '<table class="table table-hover table-striped table-bordered">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th>Event ID</th>';
            echo '<th>Event Name</th>';
            echo '<th>Event Coordinator</th>';
            echo '<th>Winner Reg Number</th>';
            echo '<th>Runner Reg Number</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_assoc($query)) {
                echo '<tr>';
                echo '<td>' . $row['eventid'] . '</td>';
                echo '<td>' . $row['ename'] . '</td>';
                $sql2 = "select coor_name, email, phoneno from event_coordinator where coor_id=" . $row['event_cid'];
                $query2 = mysqli_query($con, $sql2);
                if (mysqli_num_rows($query2) > 0) {
                    $row1 = mysqli_fetch_assoc($query2);
                    echo '<td>' . $row['event_cid'] . ' - ' . $row1['coor_name'] . ', ' . $row1['email'] . ', ' . $row1['phoneno'] . '</td>';
                }
                echo '<td>' . $row['winner_regno'] . '</td>';
                echo '<td>' . $row['runner_regno'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '<a class="btn btn-primary" href="Admin_Home.php">Back</a></div>';
        } else {
            echo '<div class="container mt-5"><h2>Events</h2><p>No records found<p>';
            if (isset($_SERVER['HTTP_REFERER'])) {
                $referrer = $_SERVER['HTTP_REFERER'];
                echo '<a href="' . $referrer . '" class="btn btn-primary">Back</a>';
            } else {
                echo '<a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>';
            }
            '</div>';
        }
    } else if ($view == 'event_coordinator') {
        $sql_co = "select coor_id,coor_name,email,phoneno, status from event_coordinator";
        $query_co = mysqli_query($con, $sql_co);
        if (mysqli_num_rows($query_co) > 0) {
            echo '<div class="container mt-5"><h2>Coordinators</h2>';
            echo '<table class="table-hover table table-striped table-bordered">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th>Coordinator ID</th>';
            echo '<th>Coordinator Name</th>';
            echo '<th>Email</th>';
            echo '<th>Phone Number</th>';
            echo '<th>Status</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_assoc($query_co)) {
                echo '<tr>';
                echo '<td>' . $row['coor_id'] . '</td>';
                echo '<td>' . $row['coor_name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['phoneno'] . '</td>';
                if($row['status']==1){
                    echo '<td><p class="text-danger">Assigned</p></td>';
                }else{
                    echo '<td><p class="text-success">Available</p></td>';
                }
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            if (isset($_SERVER['HTTP_REFERER'])) {
                $referrer = $_SERVER['HTTP_REFERER'];
                echo '<a href="' . $referrer . '" class="btn btn-primary">Back</a>';
            } else {
                echo '<a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>';
            }
            '</div>';
        } else {
            echo '<div class="container mt-5"><h2>Coordinators</h2><p>No records found</p>';
            if (isset($_SERVER['HTTP_REFERER'])) {
                $referrer = $_SERVER['HTTP_REFERER'];
                echo '<a href="' . $referrer . '" class="btn btn-primary">Back</a>';
            } else {
                echo '<a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>';
            }
            '</div>';
        }
    } else if ($view == 'student') {
        $sql_co = "select sid,reg_no,name,email,phone,college, cource from student";
        $query_co = mysqli_query($con, $sql_co);
        if (mysqli_num_rows($query_co) > 0) {
            echo '<div class="container mt-5"><h2>Students</h2>';
            echo '<table class="table-hover table table-striped table-bordered">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th>Student ID</th>';
            echo '<th>Registration No</th>';
            echo '<th>Name</th>';
            echo '<th>Email</th>';
            echo '<th>Phone Number</th>';
            echo '<th>College</th>';
            echo '<th>Course</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_assoc($query_co)) {
                echo '<tr>';
                echo '<td>' . $row['sid'] . '</td>';
                echo '<td>' . $row['reg_no'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['phone'] . '</td>';
                echo '<td>' . $row['college'] . '</td>';
                echo '<td>' . $row['cource'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            if (isset($_SERVER['HTTP_REFERER'])) {
                $referrer = $_SERVER['HTTP_REFERER'];
                echo '<a href="' . $referrer . '" class="btn btn-primary">Back</a>';
            } else {
                echo '<a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>';
            }
            '</div>';
        } else {
            echo '<div class="container mt-5"><h2>Students</h2><p>No records found</p>';
            if (isset($_SERVER['HTTP_REFERER'])) {
                $referrer = $_SERVER['HTTP_REFERER'];
                echo '<a href="' . $referrer . '" class="btn btn-primary">Back</a>';
            } else {
                echo '<a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>';
            }
            '</div>';
        }
    }
?>
<?php
}
include('Footer.php')
    ?>